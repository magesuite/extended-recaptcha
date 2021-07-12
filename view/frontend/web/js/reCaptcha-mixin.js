define([
    'jquery',
    'Magento_ReCaptchaFrontendUi/js/registry'
], function ($, registry) {
    'use strict';

    return function (origin) {
        return origin.extend({
            initialize: function () {
                this._super();

                $(document).on('ajax:addToCart', function() {
                    var i,
                        captchaList = registry.captchaList(),
                        tokenFieldsList = registry.tokenFields();

                    for (i = 0; i < captchaList.length; i++) {
                        // eslint-disable-next-line no-undef
                        grecaptcha.reset(captchaList[i]);

                        if (tokenFieldsList[i]) {
                            tokenFieldsList[i].value = '';
                        }
                    }
                });

                return this;
            },
            /**
             * Deffer loading recaptcha in case onsubmit attribute exists
             * Add data-deferred-recaptcha="true" to forms to allow deferred recapctcha
             * Add onsubmit="return false;" to forms to prevent sending it until form is focused and recaptacha script is loaded
            */
            _loadApi: function() {
                var $container = $('#' + this.getReCaptchaId() + '-container');
                var $parentForm = $container.parents('form');
                var deferredRecaptcha = $parentForm.attr('data-deferred-recaptcha');

                if(deferredRecaptcha) {
                    var parentMethod = this._super.bind(this);

                    var initializeRecaptcha = function() {
                        parentMethod();    
                        $(window).on('recaptchaapiready', function() {
                            $parentForm.removeAttr('onsubmit');
                            $parentForm.off('focus', 'input, textarea', initializeRecaptcha);
                        });
                    };

                    $parentForm.on('focus', 'input, textarea', initializeRecaptcha);
                } else {
                    this._super();
                }
            },
        });
    };
});

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
             * Set Deferred recaptcha settings in admin panel to true
            */
            _loadApi: function() {
                var $container = $('#' + this.getReCaptchaId() + '-container');
                var $parentForm = $container.parents('form');
                var deferredRecaptcha = $container.parents('.cs-google-recaptcha').attr('data-deferred-recaptcha');

                if(deferredRecaptcha) {
                    var parentMethod = this._super.bind(this);

                    var initializeRecaptcha = function() {
                        $parentForm.off('hover, focus, touchstart', 'input, textarea', initializeRecaptcha);
                        parentMethod();    
                    };

                    $parentForm.on('hover, focus, touchstart', 'input, textarea', initializeRecaptcha);
                } else {
                    this._super();
                }
            },
        });
    };
});

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
        });
    };
});

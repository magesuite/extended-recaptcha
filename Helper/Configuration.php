<?php

declare(strict_types=1);

namespace MageSuite\ExtendedRecaptcha\Helper;

class Configuration extends \Magento\Framework\App\Helper\AbstractHelper
{
    const RECAPTCHA_CUSTOM_NOTE_ENABLED = 'recaptcha_frontend/type_for/custom_note_enabled';
    const RECAPTCHA_CUSTOM_NOTE_TEXT = 'recaptcha_frontend/type_for/custom_note_text';
    const RECAPTCHA_DEFERRED_SCRIPTS = 'recaptcha_frontend/type_for/deferred_scripts_enabled';
    const RECAPTCHA_ADD_TO_CART_PROTECTION_MODE = 'recaptcha_frontend/type_for/add_to_cart_protection_mode';

    public function isRecaptchaCustomNoteEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::RECAPTCHA_CUSTOM_NOTE_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getRecaptchaCustomNote($storeId = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::RECAPTCHA_CUSTOM_NOTE_TEXT,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isDeferredRecaptchaEnabled($storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::RECAPTCHA_DEFERRED_SCRIPTS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getAddToCartProtectionMode(): string
    {
        return (string)$this->scopeConfig->getValue(self::RECAPTCHA_ADD_TO_CART_PROTECTION_MODE);
    }
}

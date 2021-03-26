<?php
namespace MageSuite\ExtendedRecaptcha\Helper;

class Configuration extends \Magento\Framework\App\Helper\AbstractHelper
{
    const RECAPTCHA_CUSTOM_NOTE_ENABLED = 'recaptcha_frontend/type_for/custom_note_enabled';

    const RECAPTCHA_CUSTOM_NOTE_TEXT = 'recaptcha_frontend/type_for/custom_note_text';

    public function isRecaptchaCustomNoteEnabled()
    {
        return $this->scopeConfig->getValue(self::RECAPTCHA_CUSTOM_NOTE_ENABLED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getRecaptchaCustomNote()
    {
        return $this->scopeConfig->getValue(self::RECAPTCHA_CUSTOM_NOTE_TEXT, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}

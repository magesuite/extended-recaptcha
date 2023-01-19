<?php
namespace MageSuite\ExtendedRecaptcha\ViewModel;

class ReCaptcha implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \MageSuite\ExtendedRecaptcha\Helper\Configuration
     */
    protected $configuration;
    /**
     * @var \Magento\ReCaptchaUi\Model\CaptchaTypeResolverInterface
     */
    protected $captchaTypeResolver;

    public function __construct(
        \MageSuite\ExtendedRecaptcha\Helper\Configuration $configuration,
        \Magento\ReCaptchaUi\Model\CaptchaTypeResolverInterface $captchaTypeResolver
    ) {
        $this->configuration = $configuration;
        $this->captchaTypeResolver = $captchaTypeResolver;
    }

    public function isRecaptchaCustomNoteEnabled()
    {
        return $this->configuration->isRecaptchaCustomNoteEnabled();
    }

    public function getRecaptchaNote()
    {
        return $this->configuration->getRecaptchaCustomNote();
    }

    public function isInvisibleRecaptcha($key)
    {
        $recaptchaType = $this->captchaTypeResolver->getCaptchaTypeFor($key);

        if ($recaptchaType != 'recaptcha') {
            return true;
        }

        return false;
    }
}

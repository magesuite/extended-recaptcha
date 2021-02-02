<?php
namespace MageSuite\ExtendedRecaptcha\ViewModel;

class ReCaptcha implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \MageSuite\ExtendedRecaptcha\Helper\Configuration
     */
    protected $configuration;

    public function __construct(\MageSuite\ExtendedRecaptcha\Helper\Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getRecaptchaNote()
    {
        if (!$this->configuration->isRecaptchaCustomNoteEnabled()) {
            return null;
        }

        return $this->configuration->getRecaptchaCustomNote();
    }
}

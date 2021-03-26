<?php

declare(strict_types=1);

namespace MageSuite\ExtendedRecaptcha\Block\Product\View;

class ReCaptcha extends \Magento\ReCaptchaUi\Block\ReCaptcha
{
    /**
     * @var \MageSuite\ExtendedRecaptcha\Model\IsCaptchaEnabledProduct
     */
    protected $isCaptchaEnabledProduct;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\ReCaptchaUi\Model\UiConfigResolverInterface $captchaUiConfigResolver,
        \Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface $isCaptchaEnabled,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        \MageSuite\ExtendedRecaptcha\Model\IsCaptchaEnabledProduct $isCaptchaEnabledProduct,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->isCaptchaEnabledProduct = $isCaptchaEnabledProduct;
        $this->registry = $registry;
        parent::__construct($context, $captchaUiConfigResolver, $isCaptchaEnabled, $serializer, $data);
    }

    /**
     * @return \Magento\Catalog\Model\Product|null
     */
    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\InputException
     */
    public function toHtml()
    {
        $product = $this->getProduct();

        if (!$product || !$this->isCaptchaEnabledProduct->isCaptchaEnabledFor($product)) {
            return '';
        }

        return parent::toHtml();
    }
}

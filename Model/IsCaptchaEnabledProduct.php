<?php

declare(strict_types=1);

namespace MageSuite\ExtendedRecaptcha\Model;

class IsCaptchaEnabledProduct
{
    /**
     * @var \Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface
     */
    protected $isCaptchaEnabled;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\ProductFactory
     */
    protected $productFactory;

    /**
     * @var \MageSuite\ExtendedRecaptcha\Helper\Configuration
     */
    protected $configuration;

    public function __construct(
        \Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface $isCaptchaEnabled,
        \Magento\Catalog\Model\ResourceModel\ProductFactory $productFactory,
        \MageSuite\ExtendedRecaptcha\Helper\Configuration $configuration
    ) {
        $this->isCaptchaEnabled = $isCaptchaEnabled;
        $this->productFactory = $productFactory;
        $this->configuration = $configuration;
    }

    /**
     * @param Magento\Catalog\Api\Data\ProductInterface|int $product
     * @return bool
     * @throws \Magento\Framework\Exception\InputException
     */
    public function isCaptchaEnabledFor($product): bool
    {
        if (!$this->isCaptchaEnabled->isCaptchaEnabledFor('add_to_cart')) {
            return false;
        }

        if ($this->isGlobalProtectionMode()) {
            return true;
        }

        return $this->getProductAttributeValue($product);
    }

    protected function isGlobalProtectionMode(): bool
    {
        return $this->configuration->getAddToCartProtectionMode() == \MageSuite\ExtendedRecaptcha\Model\Config\Source\ProtectionMode::MODE_GLOBAL;
    }

    protected function getProductAttributeValue($product): bool
    {
        if (!$product instanceof \Magento\Catalog\Api\Data\ProductInterface) {
            $productResource = $this->productFactory->create();
            $hasRecaptcha = $productResource->getAttributeRawValue(
                (int)$product,
                'has_recaptcha',
                \Magento\Store\Model\Store::DEFAULT_STORE_ID
            );
        } else {
            $hasRecaptcha = $product->getData('has_recaptcha');
        }

        return (bool)$hasRecaptcha;
    }
}

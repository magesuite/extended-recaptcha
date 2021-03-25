<?php

namespace MageSuite\ExtendedRecaptcha\Model\Config\Source;

class ProtectionMode implements \Magento\Framework\Option\ArrayInterface
{
    const MODE_PRODUCT_ATTRIBUTE = 'product_attribute';
    const MODE_GLOBAL = 'global';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::MODE_PRODUCT_ATTRIBUTE, 'label' => __('Product Attribute')],
            ['value' => self::MODE_GLOBAL, 'label' => __('Global')]
        ];
    }
}

<?php

namespace MageSuite\ExtendedRecaptcha\Setup\Patch\Data;

class AddProductAttribute implements \Magento\Framework\Setup\Patch\DataPatchInterface
{
    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * @var \Magento\Catalog\Setup\CategorySetupFactory
     */
    protected $categorySetupFactory;

    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Catalog\Setup\CategorySetupFactory $categorySetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function apply()
    {
        $categorySetup = $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'has_recaptcha',
            [
                'type' => 'int',
                'label' => 'Has reCAPTCHA',
                'input' => 'boolean',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => 1,
                'required' => 0,
                'user_defined' => 1,
                'default' => '',
                'searchable' => 0,
                'filterable' => 0,
                'filterable_in_search' => 0,
                'comparable' => 0,
                'visible_on_front' => 1,
                'used_in_product_listing' => 1,
                'unique' => 0,
                'group' => 'General'
            ]
        );
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}

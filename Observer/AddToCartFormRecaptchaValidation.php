<?php

declare(strict_types=1);

namespace MageSuite\ExtendedRecaptcha\Observer;

class AddToCartFormRecaptchaValidation implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\Framework\UrlInterface|UrlInterface
     */
    protected $url;

    /**
     * @var \MageSuite\ExtendedRecaptcha\Model\IsCaptchaEnabledProduct
     */
    protected $isCaptchaEnabledProduct;

    /**
     * @var \Magento\ReCaptchaUi\Model\RequestHandlerInterface|RequestHandlerInterface
     */
    protected $requestHandler;

    public function __construct(
        \Magento\Framework\UrlInterface $url,
        \MageSuite\ExtendedRecaptcha\Model\IsCaptchaEnabledProduct $isCaptchaEnabledProduct,
        \Magento\ReCaptchaUi\Model\RequestHandlerInterface $requestHandler
    ) {
        $this->url = $url;
        $this->isCaptchaEnabledProduct = $isCaptchaEnabledProduct;
        $this->requestHandler = $requestHandler;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(\Magento\Framework\Event\Observer $observer): void
    {
        $controller = $observer->getControllerAction();
        $request = $controller->getRequest();
        $productId = (int)$request->getParam('product');

        if (!$this->isCaptchaEnabledProduct->isCaptchaEnabledFor($productId)) {
            return;
        }

        $response = $controller->getResponse();
        $redirectOnFailureUrl = $this->url->getUrl('*/*/index');
        $this->requestHandler->execute('add_to_cart', $request, $response, $redirectOnFailureUrl);
    }
}

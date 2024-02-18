<?php
namespace Risecommerce\TierpriceDisable\Observer\Salesrule;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Catalog\Model\ProductRepository;
use Psr\Log\LoggerInterface;

class ValidatorProcess implements ObserverInterface
{
    protected $productRepository;
    protected $logger;

    public function __construct(
        ProductRepository $productRepository,
        LoggerInterface $logger
    ) {
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $item = $observer->getEvent()->getItem();
        $quote = $item->getQuote();
        
        $couponCode = $quote->getCouponCode();
        if ($couponCode) {
            foreach ($quote->getAllVisibleItems() as $quoteItem) {
                $product = $quoteItem->getProduct();
                $productId = $product->getId();
               
                try {
                    $tierPrices = $product->getTierPrices();
                    if (!empty($tierPrices)) {
                        // Disable tier pricing for the item
                        $quoteItem->setCustomPrice($product->getFinalPrice());
                        $quoteItem->setOriginalCustomPrice($product->getFinalPrice());
                        $quoteItem->setMessage(__('Tier pricing has been disabled because a coupon has been applied..'));
                        
                    }
                } catch (\Exception $e) {
                    $this->logger->critical($e->getMessage());
                }
             
            }
            // Apply coupon code
            // $quote->setCouponCode($couponCode)->collectTotals()->save();
        }
    }
}

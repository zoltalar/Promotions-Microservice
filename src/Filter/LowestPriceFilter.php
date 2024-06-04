<?php

namespace App\Filter;

use App\DTO\PriceInquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifier\Factory\PriceModifierFactoryInterface;

class LowestPriceFilter implements PromotionFilterInterface
{
    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory) {}
    
    public function apply(
        PriceInquiryInterface $inquiry,
        array $promotions
    ): PriceInquiryInterface 
    {
        $price = $inquiry->getProduct()->getPrice();
        $inquiry->setPrice($price);
        $quantity = $inquiry->getQuantity();
        $lowestPrice = $price * $quantity;
        
        foreach ($promotions as $promotion) {
            
            if ( ! $promotion instanceof Promotion) {
                continue;
            }
            
            $priceModifier = $this->priceModifierFactory->create($promotion->getType());
            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $inquiry);
        
            if ($modifiedPrice < $lowestPrice) {
                $inquiry->setDiscountedPrice($modifiedPrice);
                $inquiry->setPromotionId($promotion->getId());
                $inquiry->setPromotionName($promotion->getName());
                
                $lowestPrice = $modifiedPrice;
            }
        }
        
        return $inquiry;
    }
}

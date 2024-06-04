<?php

namespace App\Filter\Modifier;

use App\DTO\PriceInquiryInterface;
use App\Entity\Promotion;

class EvenItemsMultiplier implements PriceModifierInterface
{
    public function modify(
        float $price,
        int $quantity,
        Promotion $promotion,
        PriceInquiryInterface $inquiry
    ): float
    {
        if ($quantity >= 2) {
            $oddCount = $quantity % 2;
            $evenCount = $quantity - $oddCount;
            
            return (($evenCount * $price) * $promotion->getAdjustment()) + ($oddCount * $price);
        }
        
        return $price * $quantity;
    }
}

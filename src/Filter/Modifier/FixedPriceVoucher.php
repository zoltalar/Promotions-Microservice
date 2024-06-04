<?php

namespace App\Filter\Modifier;

use App\DTO\PriceInquiryInterface;
use App\Entity\Promotion;

class FixedPriceVoucher implements PriceModifierInterface
{
    public function modify(
        float $price,
        int $quantity,
        Promotion $promotion,
        PriceInquiryInterface $inquiry
    ): float
    {
        if ($inquiry->getVoucherCode() === $promotion->getCriteria()['code']) {
            return $promotion->getAdjustment() * $quantity;
        }
        
        return $price * $quantity;
    }
}

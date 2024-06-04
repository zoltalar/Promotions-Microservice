<?php

namespace App\Filter;

use App\DTO\PriceInquiryInterface;

class LowestPriceFilter implements PromotionFilterInterface
{
    public function apply(
        PriceInquiryInterface $inquiry,
        array $promotions
    ): PriceInquiryInterface 
    {
        return $inquiry
            ->setPrice(50.00)
            ->setDiscountedPrice(19.99);
    }
}

<?php

namespace App\Filter;

use App\DTO\PromotionInquiryInterface;

class LowestPriceFilter implements PromotionFilterInterface
{
    public function apply(
        PromotionInquiryInterface $inquiry,
        array $promotions
    ): PromotionInquiryInterface 
    {
        return $inquiry
            ->setPromotionId(1)
            ->setPromotionName('Buy one get one free!');
    }
}

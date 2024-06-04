<?php

namespace App\Filter;

use App\DTO\PromotionInquiryInterface;

interface PromotionFilterInterface
{
    public function apply(
        PromotionInquiryInterface $inquiry, 
        array $promotions
    ): PromotionInquiryInterface;
}
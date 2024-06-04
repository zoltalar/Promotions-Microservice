<?php

namespace App\Filter;

use App\DTO\PriceInquiryInterface;

interface PromotionFilterInterface
{
    public function apply(
        PriceInquiryInterface $inquiry, 
        array $promotions
    ): PriceInquiryInterface;
}
<?php

namespace App\Filter\Modifier;

use App\DTO\PriceInquiryInterface;
use App\Entity\Promotion;

interface PriceModifierInterface
{
    public function modify(
        float $price,
        int $quantity,
        Promotion $promotion,
        PriceInquiryInterface $inquiry
    ): float;
}
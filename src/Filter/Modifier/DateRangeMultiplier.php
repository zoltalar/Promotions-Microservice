<?php

namespace App\Filter\Modifier;

use App\DTO\PriceInquiryInterface;
use App\Entity\Promotion;
use DateTime;

class DateRangeMultiplier implements PriceModifierInterface
{
    public function modify(
        float $price,
        int $quantity,
        Promotion $promotion,
        PriceInquiryInterface $inquiry
    ): float
    {
        $requestDate = new DateTime($inquiry->getRequestDate());
        $from = new DateTime($promotion->getCriteria()['from']);
        $to = new DateTime($promotion->getCriteria()['to']);
        
        if ($requestDate >= $from && $requestDate <= $to) {
            return ($price * $quantity) * $promotion->getAdjustment();
        }
        
        return $price * $quantity;
    }
}

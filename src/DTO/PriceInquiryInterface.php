<?php

namespace App\DTO;

interface PriceInquiryInterface extends PromotionInquiryInterface
{
    public function getQuantity(): ?int;
    
    public function setQuantity(?int $quantity): static;
    
    public function getPrice(): ?float;
    
    public function setPrice(?float $price): static;
    
    public function getDiscountedPrice(): ?float;
    
    public function setDiscountedPrice(?float $discountedPrice): static;
}
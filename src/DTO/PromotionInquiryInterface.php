<?php

interface PromotionInquiryInterface
{
    public function getPromotionId(): ?int;
    
    public function setPromotionId(?int $promotionId): static;
    
    public function getPromotionName(): ?string;
    
    public function setPromotionName(?string $promotionName): static;
}
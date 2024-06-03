<?php

namespace App\DTO;

final class LowestPriceInquiry implements PromotionInquiryInterface
{
    private ?int $productId;
    
    private ?int $quantity;
    
    private ?string $countryName;
    
    private ?string $voucherCode;
    
    private ?string $requestDate;
    
    private ?float $price;
    
    private ?float $discountedPrice;
    
    private ?int $promotionId;
    
    private ?string $promotionName;
    
    // --------------------------------------------------
    // Accessors and Mutators
    // --------------------------------------------------
    
    public function getProductId(): ?int
    {
        return $this->productId;
    }
    
    public function setProductId(?int $productId): static
    {
        $this->productId = $productId;
        
        return $this;
    }
    
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    
    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;
        
        return $this;
    }
    
    public function getCountryName(): ?string
    {
        return $this->countryName;
    }
    
    public function setCountryName(?string $countryName): static
    {
        $this->countryName = $countryName;
        
        return $this;
    }
    
    public function getVoucherCode(): ?string
    {
        return $this->voucherCode;
    }
    
    public function setVoucherCode(?string $voucherCode): static
    {
        $this->voucherCode = $voucherCode;
        
        return $this;
    }
    
    public function getRequestDate(): ?string
    {
        return $this->requestDate;
    }
    
    public function setRequestDate(?string $requestDate): static
    {
        $this->requestDate = $requestDate;
        
        return $this;
    }
    
    public function getPrice(): ?float
    {
        return $this->price;
    }
    
    public function setPrice(?float $price): static
    {
        $this->price = $price;
        
        return $this;
    }
    
    public function getDiscountedPrice(): ?float
    {
        return $this->discountedPrice;
    }
    
    public function setDiscountedPrice(?float $discountedPrice): static
    {
        $this->discountedPrice = $discountedPrice;
        
        return $this;
    }
    
    public function getPromotionId(): ?int
    {
        return $this->promotionId;
    }
    
    public function setPromotionId(?int $promotionId): static
    {
        $this->promotionId = $promotionId;
        
        return $this;
    }
    
    public function getPromotionName(): ?string
    {
        return $this->promotionName;
    }
    
    public function setPromotionName(?string $promotionName): static
    {
        $this->promotionName = $promotionName;
        
        return $this;
    }
}
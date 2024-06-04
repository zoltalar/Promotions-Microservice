<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceInquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\LowestPriceFilter;
use App\Tests\ServiceTestCase;

class LowestPriceFilterTest extends ServiceTestCase
{
    public function testLowestPriceFilter(): void
    {
        $product = new Product();
        $product->setPrice(49.99);
        
        $inquiry = new LowestPriceInquiry();
        $inquiry->setProduct($product);
        $inquiry->setQuantity(5);
        
        $promotions = $this->getPromotionsDataProvider();
        
        $lowestPriceFilter = $this->container->get(LowestPriceFilter::class);
        $modifiedInquiry = $lowestPriceFilter->apply($inquiry, $promotions);
        
        $this->assertEquals(50.00, $modifiedInquiry->getPrice());
        $this->assertEquals(19.99, $modifiedInquiry->getDiscountedPrice());
    }
    
    public function getPromotionsDataProvider(): array
    {
        $promotion1 = new Promotion();
        $promotion1->setName('Black Friday half price sale');
        $promotion1->setAdjustment(0.5);
        $promotion1->setCriteria(['from' => '2024-11-25', 'to' => '2024-11-28']);
        $promotion1->setType('date_range_multiplier');
        
        $promotion2 = new Promotion();
        $promotion2->setName('Voucher OU812');
        $promotion2->setAdjustment(100);
        $promotion2->setCriteria(['code' => 'OU812']);
        $promotion2->setType('fixed_price_voucher');
        
        $promotion3 = new Promotion();
        $promotion3->setName('Buy one get one free');
        $promotion3->setAdjustment(0.5);
        $promotion3->setCriteria(['min_quantity' => 2]);
        $promotion3->setType('even_items_multiplier');
        
        return [
            $promotion1,
            $promotion2,
            $promotion3
        ];
    }
}

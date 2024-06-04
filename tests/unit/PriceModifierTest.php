<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceInquiry;
use App\Entity\Promotion;
use App\Filter\Modifier\DateRangeMultiplier;
use App\Filter\Modifier\EvenItemsMultiplier;
use App\Filter\Modifier\FixedPriceVoucher;
use App\Tests\ServiceTestCase;

class PriceModifierTest extends ServiceTestCase
{
    public function testDateRangeMultiplier(): void
    {
        $inquiry = new LowestPriceInquiry();
        $inquiry->setQuantity(5);
        $inquiry->setRequestDate('2024-11-27');
        
        $promotion = new Promotion();
        $promotion->setName('Black Friday half price sale');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(['from' => '2024-11-25', 'to' => '2024-11-28']);
        $promotion->setType('date_range_multiplier');
        
        $dateRangeMultiplier = new DateRangeMultiplier();
        $modifiedPrice = $dateRangeMultiplier->modify(100.00, $inquiry->getQuantity(), $promotion, $inquiry);
        
        $this->assertEquals(250, $modifiedPrice);
    }
    
    public function testFixedPriceVoucher(): void
    {
        $inquiry = new LowestPriceInquiry();
        $inquiry->setQuantity(5);
        $inquiry->setVoucherCode('OU812');
        
        $promotion = new Promotion();
        $promotion->setName('Voucher OU812');
        $promotion->setAdjustment(100);
        $promotion->setCriteria(['code' => 'OU812']);
        $promotion->setType('fixed_price_voucher');
        
        $fixedPriceVoucher = new FixedPriceVoucher();
        $modifiedPrice = $fixedPriceVoucher->modify(150.00, $inquiry->getQuantity(), $promotion, $inquiry);
        
        $this->assertEquals(500, $modifiedPrice);
    }
    
    public function testEvenItemsMultiplier(): void
    {
        $inquiry = new LowestPriceInquiry();
        $inquiry->setQuantity(5);
        
        $promotion = new Promotion();
        $promotion->setName('Buy one get one free');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(['minimum_quantity' => 2]);
        $promotion->setType('even_items_multiplier');
        
        $evenItemsMultiplier = new EvenItemsMultiplier();
        $modifiedPrice = $evenItemsMultiplier->modify(100.00, $inquiry->getQuantity(), $promotion, $inquiry);
        
        $this->assertEquals(300, $modifiedPrice);
    }
}

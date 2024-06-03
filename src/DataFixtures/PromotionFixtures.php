<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PromotionFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $promotion = new Promotion();
        $promotion->setName('Black Friday half price sale');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(['from' => '2024-11-25', 'to' => '2024-11-28']);
        $promotion->setType('date_range_multiplier');
        
        $manager->persist($promotion);
        
        $promotion = new Promotion();
        $promotion->setName('Voucher OU812');
        $promotion->setAdjustment(100);
        $promotion->setCriteria(['code' => 'OU812']);
        $promotion->setType('fixed_price_voucher');
        
        $manager->persist($promotion);
        
        $promotion = new Promotion();
        $promotion->setName('Buy one get one free');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(['min_quantity' => 2]);
        $promotion->setType('even_items_multiplier');
        
        $manager->persist($promotion);
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 2;
    }
}

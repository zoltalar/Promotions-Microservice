<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setPrice(49.99);
                
        $manager->persist($product);
        
        $product = new Product();
        $product->setPrice(129.99);
        
        $manager->persist($product);        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}

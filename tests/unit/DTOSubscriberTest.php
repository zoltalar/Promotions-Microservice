<?php

namespace App\Tests\Unit;

use App\DTO\LowestPriceInquiry;
use App\Event\AfterDTOCreatedEvent;
use App\Tests\ServiceTestCase;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class DTOSubscriberTest extends ServiceTestCase
{
    public function testValidateDTO(): void
    {
        $dto = new LowestPriceInquiry();
        $dto->setQuantity(-5);
        
        $event = new AfterDTOCreatedEvent($dto);
        $dispatcher = $this->container->get('event_dispatcher');
    
        $this->expectException(ValidationFailedException::class);
        
        $dispatcher->dispatch($event, $event::NAME);
    }
}

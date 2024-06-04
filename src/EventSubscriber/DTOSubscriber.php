<?php

namespace App\EventSubscriber;

use App\Event\AfterDTOCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class DTOSubscriber implements EventSubscriberInterface
{
    public function __construct(private ValidatorInterface $validator) {}
    
    public static function getSubscribedEvents(): array
    {
        return [AfterDTOCreatedEvent::NAME => 'validateDTO'];
    }
    
    public function validateDTO(AfterDTOCreatedEvent $event): void
    {
        $dto = $event->getDTO();
        $errors = $this->validator->validate($dto);
        
        if (count($errors) > 0) {
            throw new ValidationFailedException('Validation error!', $errors);
        }
    }
}

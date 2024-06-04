<?php

namespace App\Service\Serializer;

use App\Event\AfterDTOCreatedEvent;
use Override;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class DTOSerializer implements SerializerInterface
{
    private SerializerInterface $serializer;
    
    private EventDispatcherInterface $eventDispatcher;
    
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer(
                nameConverter: new CamelCaseToSnakeCaseNameConverter()
            )],
            [new JsonEncoder()]
        );
        
        $this->eventDispatcher = $eventDispatcher;
    }

    #[Override]
    public function serialize(mixed $data, string $format, array $context = []): string 
    {
        $context[AbstractNormalizer::IGNORED_ATTRIBUTES] = ['product'];
                
        return $this->serializer->serialize($data, $format, $context);
    }
    
    #[Override]
    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed 
    {
        $dto = $this->serializer->deserialize($data, $type, $format, $context);        
        
        $event = new AfterDTOCreatedEvent($dto);
        $this->eventDispatcher->dispatch($event, $event::NAME);
        
        return $dto;
    }
}

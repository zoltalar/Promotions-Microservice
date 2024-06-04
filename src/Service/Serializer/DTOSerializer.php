<?php

namespace App\Service\Serializer;

use Override;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class DTOSerializer implements SerializerInterface
{
    private SerializerInterface $serializer;
    
    public function __construct()
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer(
                nameConverter: new CamelCaseToSnakeCaseNameConverter()
            )],
            [new JsonEncoder()]
        );
    }
    
    #[Override]
    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed 
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    #[Override]
    public function serialize(mixed $data, string $format, array $context = []): string 
    {
        $context[AbstractNormalizer::IGNORED_ATTRIBUTES] = ['product'];
        
        return $this->serializer->serialize($data, $format, $context);
    }
}

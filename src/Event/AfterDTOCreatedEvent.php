<?php

namespace App\Event;

use App\DTO\PriceInquiryInterface;
use Symfony\Contracts\EventDispatcher\Event as EventContract;

class AfterDTOCreatedEvent extends EventContract
{
    public const NAME = 'dto.created';
    
    public function __construct(protected PriceInquiryInterface $dto) {}
    
    public function getDTO(): PriceInquiryInterface
    {
        return $this->dto;
    }
}
<?php

namespace App\DTO;

use Ramsey\Uuid\UuidInterface;

class EquipmentDemandRequestDTO
{
    public \DateTimeImmutable $date;

    public UuidInterface $station;

    public int $page = 0;

    public int $limit = 20;
}

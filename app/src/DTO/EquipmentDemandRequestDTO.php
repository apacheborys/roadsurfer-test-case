<?php

namespace App\DTO;

use Ramsey\Uuid\UuidInterface;

class EquipmentDemandRequestDTO
{
    public \DateTimeImmutable $startDate;

    public \DateTimeImmutable $endDate;

    public UuidInterface $station;

    public int $page = 0;

    public int $limit = 20;
}

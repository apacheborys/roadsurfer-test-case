<?php

namespace App\Entity;

use App\Enum\CampervanState;
use App\Enum\CampervanType;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class Campervan
{
    private UuidInterface $id;

    private string $plateNumber;

    private array $metaData;

    private CampervanType $type;

    private Money $price;

    private CampervanState $state;

    private ?Station $station;
}

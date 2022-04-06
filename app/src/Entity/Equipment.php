<?php

namespace App\Entity;

use App\Enum\EquipmentState;
use App\Enum\EquipmentType;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class Equipment
{
    private UuidInterface $id;

    private EquipmentType $type;

    private Money $price;

    private array $metaData;

    private EquipmentState $state;

    private ?Station $station;
}

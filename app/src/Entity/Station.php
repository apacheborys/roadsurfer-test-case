<?php

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

class Station
{
    private UuidInterface $id;

    private Location $location;

    private array $metaData;

    /** @var Campervan[] */
    private iterable $availableCampers;

    /** @var Equipment[] */
    private iterable $equipment;
}

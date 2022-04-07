<?php

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

class Location
{
    private UuidInterface $id;

    private float $longitude;

    private float $latitude;
}

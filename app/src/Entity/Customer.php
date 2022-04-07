<?php

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

class Customer
{
    private UuidInterface $id;

    private array $metaData;
}

<?php

namespace App\Entity;

use App\Enum\BookingState;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

class Booking
{
    private UuidInterface $id;

    private Customer $customer;

    private Collection $campers;

    private Collection $equipments;

    private Station $startStation;

    private Station $endStation;

    private \DatePeriod $period;

    private array $metaData;

    private BookingState $state;
}

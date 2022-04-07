<?php

namespace App\Entity;

use App\Enum\BookingState;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Booking
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private UuidInterface $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Customer")
     */
    private Customer $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Campervan", mappedBy="booking")
     */
    private Collection $campers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Equipment", mappedBy="booking")
     */
    private Collection $equipments;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Station")
     */
    private Station $startStation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Station")
     */
    private Station $endStation;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DatePeriod $period;

    /**
     * @ORM\Column(type="json")
     */
    private array $metaData;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private BookingState $state;
}

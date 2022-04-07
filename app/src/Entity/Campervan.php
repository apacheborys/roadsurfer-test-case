<?php

namespace App\Entity;

use App\Enum\CampervanState;
use App\Enum\CampervanType;
use Money\Money;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Campervan
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private string $plateNumber;

    /**
     * @ORM\Column(type="json")
     */
    private array $metaData;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private CampervanType $type;

    /**
     * @ORM\Embedded(class="Money\Money")
     */
    private Money $price;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private CampervanState $state;

    /**
     * @ORM\Column(nullable=true)
     * @ORM\OneToMany(targetEntity="App\Entity\Station", mappedBy="campervan")
     */
    private ?Station $station;
}

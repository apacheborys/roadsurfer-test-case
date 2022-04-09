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
     * @ORM\Column(type="string", enumType="App\Enum\CampervanType")
     */
    private CampervanType $type;

    /**
     * @ORM\Embedded(class="Money\Money")
     */
    private Money $price;

    /**
     * @ORM\Column(type="string", enumType="App\Enum\CampervanState")
     */
    private CampervanState $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Station")
     */
    private ?Station $station;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): Campervan
    {
        $this->id = $id;
        return $this;
    }

    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    public function setPlateNumber(string $plateNumber): Campervan
    {
        $this->plateNumber = $plateNumber;
        return $this;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function setMetaData(array $metaData): Campervan
    {
        $this->metaData = $metaData;
        return $this;
    }

    public function getType(): CampervanType
    {
        return $this->type;
    }

    public function setType(CampervanType $type): Campervan
    {
        $this->type = $type;
        return $this;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): Campervan
    {
        $this->price = $price;
        return $this;
    }

    public function getState(): CampervanState
    {
        return $this->state;
    }

    public function setState(CampervanState $state): Campervan
    {
        $this->state = $state;
        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): Campervan
    {
        $this->station = $station;
        return $this;
    }
}

<?php

namespace App\Entity;

use App\Enum\EquipmentState;
use App\Enum\EquipmentType;
use Money\Money;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Equipment
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="string", enumType="App\Enum\EquipmentType")
     */
    private EquipmentType $type;

    /**
     * @ORM\Embedded(class="Money\Money")
     */
    private Money $price;

    /**
     * @ORM\Column(type="json")
     */
    private array $metaData;

    /**
     * @ORM\Column(type="string", enumType="App\Enum\EquipmentState")
     */
    private EquipmentState $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Station")
     */
    private ?Station $station;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order")
     */
    private ?Order $order;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): Equipment
    {
        $this->id = $id;
        return $this;
    }

    public function getType(): EquipmentType
    {
        return $this->type;
    }

    public function setType(EquipmentType $type): Equipment
    {
        $this->type = $type;
        return $this;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): Equipment
    {
        $this->price = $price;
        return $this;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function setMetaData(array $metaData): Equipment
    {
        $this->metaData = $metaData;
        return $this;
    }

    public function getState(): EquipmentState
    {
        return $this->state;
    }

    public function setState(EquipmentState $state): Equipment
    {
        $this->state = $state;
        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): Equipment
    {
        $this->station = $station;
        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): Equipment
    {
        $this->order = $order;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'type' => $this->type,
            'price' => (array) $this->price,
            'metaData' => $this->metaData,
            'state' => $this->state,
            'station' => $this->station?->getId()->toString(),
            'order' => $this->order?->getId()->toString(),
        ];
    }
}

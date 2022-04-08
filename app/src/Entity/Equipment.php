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
     * @ORM\Column(type="string", length=16)
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
     * @ORM\Column(type="string", length=16)
     */
    private EquipmentState $state;

    /**
     * @ORM\Column(nullable=true)
     * @ORM\OneToMany(targetEntity="App\Entity\Station", mappedBy="equipment")
     */
    private ?Station $station;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order")
     */
    private ?Order $order;

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

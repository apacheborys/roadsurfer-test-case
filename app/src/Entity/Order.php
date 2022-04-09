<?php

namespace App\Entity;

use App\Enum\OrderState;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
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
     * @ORM\OneToMany(targetEntity="App\Entity\Campervan", mappedBy="order")
     */
    private Collection $campers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Equipment", mappedBy="order")
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
    private \DateTimeImmutable $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeImmutable $endDate;

    /**
     * @ORM\Column(type="json")
     */
    private array $metaData;

    /**
     * @ORM\Column(type="string", enumType="App\Enum\OrderState")
     */
    private OrderState $state;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): Order
    {
        $this->id = $id;
        return $this;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): Order
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCampers(): Collection
    {
        return $this->campers;
    }

    public function setCampers(Collection $campers): Order
    {
        $this->campers = $campers;
        return $this;
    }

    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function setEquipments(Collection $equipments): Order
    {
        $this->equipments = $equipments;
        return $this;
    }

    public function getStartStation(): Station
    {
        return $this->startStation;
    }

    public function setStartStation(Station $startStation): Order
    {
        $this->startStation = $startStation;
        return $this;
    }

    public function getEndStation(): Station
    {
        return $this->endStation;
    }

    public function setEndStation(Station $endStation): Order
    {
        $this->endStation = $endStation;
        return $this;
    }

    public function getStartDate(): \DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeImmutable $startDate): Order
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): \DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate): Order
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function setMetaData(array $metaData): Order
    {
        $this->metaData = $metaData;
        return $this;
    }

    public function getState(): OrderState
    {
        return $this->state;
    }

    public function setState(OrderState $state): Order
    {
        $this->state = $state;
        return $this;
    }
}

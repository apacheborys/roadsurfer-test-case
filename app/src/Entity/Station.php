<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Station
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private UuidInterface $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Location")
     */
    private Location $location;

    /**
     * @ORM\Column(type="json")
     */
    private array $metaData;

    /**
     * @var Campervan[]
     * @ORM\OneToMany(targetEntity="App\Entity\Campervan", mappedBy="station")
     */
    private Collection $availableCampers;

    /**
     * @var Equipment[]
     * @ORM\OneToMany(targetEntity="App\Entity\Equipment", mappedBy="station")
     */
    private Collection $equipment;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function setMetaData(array $metaData): self
    {
        $this->metaData = $metaData;

        return $this;
    }

    public function getAvailableCampers(): Collection|array
    {
        return $this->availableCampers;
    }

    public function setAvailableCampers(Collection|array $availableCampers): self
    {
        $this->availableCampers = $availableCampers;

        return $this;
    }

    public function getEquipment(): Collection|array
    {
        return $this->equipment;
    }

    public function setEquipment(Collection|array $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }
}

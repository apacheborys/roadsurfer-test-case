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
}

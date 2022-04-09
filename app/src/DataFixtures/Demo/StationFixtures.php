<?php

namespace App\DataFixtures\Demo;

use App\Entity\Location;
use App\Entity\Station;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class StationFixtures extends AbstractDemo implements OrderedFixtureInterface
{
    public const DATA = [
        [
            'id' => 'e8e592bd-7791-4de3-b036-71fdea7ec8ff',
            'location_id' => LocationFixtures::DATA[0]['id'],
            'metaData' => [
                'city' => 'Munich',
                'type' => 'station',
            ],
            'availableCampers' => [],
            'equipment' => [],
        ],
        [
            'id' => 'fe1e6d7f-9caa-4aee-9f4a-e7c0a622236f',
            'location_id' => LocationFixtures::DATA[1]['id'],
            'metaData' => [
                'city' => 'Krefeld',
                'type' => 'station',
            ],
            'availableCampers' => [],
            'equipment' => [],
        ],
        [
            'id' => '89a9fc72-d687-4c65-95a2-c50118bc2e95',
            'location_id' => LocationFixtures::DATA[2]['id'],
            'metaData' => [
                'city' => 'Sumy',
                'type' => 'station',
            ],
            'availableCampers' => [],
            'equipment' => [],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $rawStation) {
            $location = $manager->find(Location::class, Uuid::fromString($rawStation['location_id']));

            $station = (new Station())
                ->setId(Uuid::fromString($rawStation['id']))
                ->setLocation($location)
                ->setMetaData($rawStation['metaData'])
                ->setAvailableCampers(new ArrayCollection($rawStation['availableCampers']))
                ->setEquipment(new ArrayCollection($rawStation['equipment']))
            ;

            $manager->persist($station);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 3;
    }
}

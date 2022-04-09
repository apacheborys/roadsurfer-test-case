<?php

namespace App\DataFixtures\Demo;

use App\Entity\Location;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class LocationFixtures extends AbstractDemo implements OrderedFixtureInterface
{
    public const DATA = [
        [
            'id' => 'a6140a4a-5da9-4ec2-a88b-8d1de5626328',
            'latitude' => 48.1639967,
            'longitude' => 11.5585086,
        ],
        [
            'id' => '7345425c-ce91-46e1-9a0b-f2b36def3d28',
            'latitude' => 51.3391278,
            'longitude' => 6.5529,
        ],
        [
            'id' => 'bd5c633a-b1c8-451b-a5f2-c90dc41d2048',
            'latitude' => 50.9007528,
            'longitude' => 34.7441743,
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $rawLocation) {
            $location = (new Location())
                ->setId(Uuid::fromString($rawLocation['id']))
                ->setLatitude($rawLocation['latitude'])
                ->setLongitude($rawLocation['longitude'])
            ;

            $manager->persist($location);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 2;
    }
}

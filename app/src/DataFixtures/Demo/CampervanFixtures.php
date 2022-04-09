<?php

namespace App\DataFixtures\Demo;

use App\Entity\Campervan;
use App\Entity\Station;
use App\Enum\CampervanState;
use App\Enum\CampervanType;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class CampervanFixtures extends AbstractDemo implements OrderedFixtureInterface
{
    public const DATA = [
        [
            'id' => '4d42ec2d-0a23-4e7d-aa63-16f2cf09fb98',
            'plateNumber' => 'M TT 1234',
            'metaData' => [
                'brand' => 'VW',
                'model' => 'Caddy Maxi'
            ],
            'type' => CampervanType::MINI_VAN,
            'price' => [
                'amount' => '10000',
                'currency' => 'EUR',
            ],
            'state' => CampervanState::AVAILABLE,
            'station_id' => StationFixtures::DATA[0]['id'],
        ],
        [
            'id' => '754df31c-8c57-4457-8ac3-f8e5b272fd8c',
            'plateNumber' => 'M TT 1233',
            'metaData' => [
                'brand' => 'VW',
                'model' => 'Caddy Maxi'
            ],
            'type' => CampervanType::MINI_VAN,
            'price' => [
                'amount' => '10000',
                'currency' => 'EUR',
            ],
            'state' => CampervanState::AVAILABLE,
            'station_id' => StationFixtures::DATA[0]['id'],
        ],
        [
            'id' => 'd81315f4-b280-4ce9-97ac-0da4649a9bf3',
            'plateNumber' => 'M TT 1232',
            'metaData' => [
                'brand' => 'VW',
                'model' => 'Caddy Maxi'
            ],
            'type' => CampervanType::MINI_VAN,
            'price' => [
                'amount' => '10000',
                'currency' => 'EUR',
            ],
            'state' => CampervanState::AVAILABLE,
            'station_id' => StationFixtures::DATA[1]['id'],
        ],
        [
            'id' => '9db27302-de72-4feb-848c-150bffc62316',
            'plateNumber' => 'M TT 1233',
            'metaData' => [
                'brand' => 'VW',
                'model' => 'Caddy Maxi'
            ],
            'type' => CampervanType::MINI_VAN,
            'price' => [
                'amount' => '10000',
                'currency' => 'EUR',
            ],
            'state' => CampervanState::AVAILABLE,
            'station_id' => StationFixtures::DATA[2]['id'],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $rawCampervan) {
            $station = $manager->find(Station::class, Uuid::fromString($rawCampervan['station_id']));

            $campervan = (new Campervan())
                ->setId(Uuid::fromString($rawCampervan['id']))
                ->setPlateNumber($rawCampervan['plateNumber'])
                ->setMetaData($rawCampervan['metaData'])
                ->setType($rawCampervan['type'])
                ->setPrice(new Money($rawCampervan['price']['amount'], new Currency($rawCampervan['price']['currency'])))
                ->setState($rawCampervan['state'])
                ->setStation($station)
            ;

            $manager->persist($campervan);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 5;
    }
}

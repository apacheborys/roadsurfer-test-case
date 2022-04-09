<?php

namespace App\DataFixtures\Demo;

use App\Entity\Equipment;
use App\Entity\Station;
use App\Enum\EquipmentState;
use App\Enum\EquipmentType;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class EquipmentFixtures extends AbstractDemo implements OrderedFixtureInterface
{
    public const DATA = [
        [
            'id' => 'bc9f093d-b21e-41d3-b4b6-709d9de27ec8',
            'type' => EquipmentType::CAMPING_TABLE,
            'price' => [
                'amount' => '1000',
                'currency' => 'EUR',
            ],
            'metaData' => [
                'color' => 'red',
            ],
            'state' => EquipmentState::AVAILABLE,
            'station' => StationFixtures::DATA[0]['id'],
            'order' => null,
        ],
        [
            'id' => 'a22b351f-8ba6-4568-acf6-714195b83e0e',
            'type' => EquipmentType::CAMPING_TABLE,
            'price' => [
                'amount' => '1000',
                'currency' => 'EUR',
            ],
            'metaData' => [
                'color' => 'red',
            ],
            'state' => EquipmentState::AVAILABLE,
            'station' => StationFixtures::DATA[1]['id'],
            'order' => null,
        ],
        [
            'id' => 'ec754779-f202-4625-9ac9-99f669f81ae9',
            'type' => EquipmentType::CAMPING_TABLE,
            'price' => [
                'amount' => '1000',
                'currency' => 'EUR',
            ],
            'metaData' => [
                'color' => 'red',
            ],
            'state' => EquipmentState::AVAILABLE,
            'station' => StationFixtures::DATA[2]['id'],
            'order' => null,
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $rawEquipment) {
            $station = $manager->find(Station::class, Uuid::fromString($rawEquipment['id']));

            $equipment = (new Equipment())
                ->setId(Uuid::fromString($rawEquipment['id']))
                ->setType($rawEquipment['type'])
                ->setPrice(new Money($rawEquipment['price']['amount'], new Currency($rawEquipment['price']['currency'])))
                ->setMetaData($rawEquipment['metaData'])
                ->setState($rawEquipment['state'])
                ->setStation($station)
                ->setOrder($rawEquipment['order'])
            ;

            $manager->persist($equipment);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 4;
    }
}

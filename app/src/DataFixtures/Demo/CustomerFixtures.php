<?php

namespace App\DataFixtures\Demo;

use App\Entity\Customer;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class CustomerFixtures extends AbstractDemo implements OrderedFixtureInterface
{
    public const DATA = [
        [
            'id' => 'cc709879-937f-4028-8893-884f7904397d',
            'metaData' => [
                'name' => 'Janina',
                'surname' => 'Fritze'
            ],
        ],
        [
            'id' => '261d0c68-b7de-4dac-be84-432013d5818d',
            'metaData' => [
                'name' => 'Borys',
                'surname' => 'Yermokhin'
            ],
        ],
        [
            'id' => '57add2d5-610d-44e8-8a2c-d1caa5128381',
            'metaData' => [
                'name' => 'John',
                'surname' => 'Webber'
            ],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $rawCustomer) {
            $customer = (new Customer())
                ->setId(Uuid::fromString($rawCustomer['id']))
                ->setMetaData($rawCustomer['metaData'])
            ;

            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}

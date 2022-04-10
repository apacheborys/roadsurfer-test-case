<?php

namespace App\DataFixtures\Demo;

use App\Entity\Campervan;
use App\Entity\Customer;
use App\Entity\Equipment;
use App\Entity\Order;
use App\Entity\Station;
use App\Enum\OrderState;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class OrderFixtures extends AbstractDemo implements OrderedFixtureInterface
{
    public const DATA = [
        [
            'id' => '33b5688a-0674-4716-aa5a-2bfe0760ea0d',
            'customer_id' => CustomerFixtures::DATA[0]['id'],
            'campers' => [
                CampervanFixtures::DATA[3]['id']
            ],
            'equipments' => [
                EquipmentFixtures::DATA[2]['id']
            ],
            'startStation' => StationFixtures::DATA[0]['id'],
            'endStation' => StationFixtures::DATA[1]['id'],
            'startDate' => '2022-01-01',
            'endDate' => '2022-02-01',
            'metaData' => [
                'fingerPrint' => 'xxx',
                'comment' => 'Some helpful comment for customer support'
            ],
            'state' => OrderState::FINISHED
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $rawOrder) {
            $customer = $manager->find(Customer::class, $rawOrder['customer_id']);
            /** @var Collection|Campervan[] $campers */
            $campers = $this->getEntities($rawOrder['campers'], Campervan::class, $manager);
            /** @var Collection|Equipment[] $equipments */
            $equipments = $this->getEntities($rawOrder['equipments'], Equipment::class, $manager);
            $startStation = $manager->find(Station::class, $rawOrder['startStation']);
            $endStation = $manager->find(Station::class, $rawOrder['endStation']);

            $order = (new Order())
                ->setId(Uuid::fromString($rawOrder['id']))
                ->setCustomer($customer)
                ->setCampers($campers)
                ->setEquipments($equipments)
                ->setStartStation($startStation)
                ->setEndStation($endStation)
                ->setStartDate(new \DateTimeImmutable($rawOrder['startDate']))
                ->setEndDate(new \DateTimeImmutable($rawOrder['endDate']))
                ->setMetaData($rawOrder['metaData'])
                ->setState($rawOrder['state'])
            ;

            $manager->persist($order);

            foreach ($equipments as $equipment) {
                $equipment->setOrder($order);
                $manager->persist($equipment);
            }

            foreach ($campers as $camper) {
                $camper->setOrder($order);
                $manager->persist($camper);
            }
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 6;
    }
}

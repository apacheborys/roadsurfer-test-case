<?php

namespace App\Tests;

use App\DataFixtures\Demo\EquipmentFixtures;
use App\DataFixtures\Demo\OrderFixtures;
use App\DataFixtures\Demo\StationFixtures;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FunctionalTest extends WebTestCase
{
    /**
     * @dataProvider providerEquipmentDemandTimeline
     */
    public function testEquipmentDemandTimeline(
        UuidInterface $stationId,
        \DateTime $startDate,
        \DateTime $endDate,
        int $expectedResponseCode,
        array $expectedResponse
    ): void {
        $client = self::createClient();
        $client->request(
            'GET',
            '/api/v1/equipment-demand-timeline',
            [
                'station' => $stationId->toString(),
                'startDate' => $startDate->format('Y-m-d'),
                'endDate' => $endDate->format('Y-m-d'),
            ]
        );

        $response = $client->getResponse();

        self::assertSame($expectedResponseCode, $response->getStatusCode());

        $result = json_decode($response->getContent(), true);
        self::assertSame($expectedResponse, $result);
    }

    public function providerEquipmentDemandTimeline(): iterable
    {
        yield [
            'station' => Uuid::fromString(StationFixtures::DATA[1]['id']),
            'startDate' => (new \DateTime(OrderFixtures::DATA[0]['endDate']))->sub(\DateInterval::createFromDateString('1 day')),
            'endDate' => (new \DateTime(OrderFixtures::DATA[0]['endDate']))->add(\DateInterval::createFromDateString('1 day')),
            'expectedResponseCode' => Response::HTTP_OK,
            'expectedResponse' => [
                '2022-01-31' => [
                    [
                        'id' => EquipmentFixtures::DATA[1]['id'],
                        'type' => EquipmentFixtures::DATA[1]['type']->value,
                        'price' => [
                            'amount' => bcdiv(EquipmentFixtures::DATA[1]['price']['amount'], '100', 2),
                            'currency' => EquipmentFixtures::DATA[1]['price']['currency'],
                        ],
                        'metaData' => EquipmentFixtures::DATA[1]['metaData'],
                        'state' => EquipmentFixtures::DATA[1]['state']->value,
                        'station' => EquipmentFixtures::DATA[1]['station'],
                        'order' => EquipmentFixtures::DATA[1]['order'],
                    ],
                ],
                '2022-02-01' => [
                    [
                        'id' => EquipmentFixtures::DATA[1]['id'],
                        'type' => EquipmentFixtures::DATA[1]['type']->value,
                        'price' => [
                            'amount' => bcdiv(EquipmentFixtures::DATA[1]['price']['amount'], '100', 2),
                            'currency' => EquipmentFixtures::DATA[1]['price']['currency'],
                        ],
                        'metaData' => EquipmentFixtures::DATA[1]['metaData'],
                        'state' => EquipmentFixtures::DATA[1]['state']->value,
                        'station' => EquipmentFixtures::DATA[1]['station'],
                        'order' => EquipmentFixtures::DATA[1]['order'],
                    ],
                ],
                '2022-02-02' => [
                    [
                        'id' => EquipmentFixtures::DATA[1]['id'],
                        'type' => EquipmentFixtures::DATA[1]['type']->value,
                        'price' => [
                            'amount' => bcdiv(EquipmentFixtures::DATA[1]['price']['amount'], '100', 2),
                            'currency' => EquipmentFixtures::DATA[1]['price']['currency'],
                        ],
                        'metaData' => EquipmentFixtures::DATA[1]['metaData'],
                        'state' => EquipmentFixtures::DATA[1]['state']->value,
                        'station' => EquipmentFixtures::DATA[1]['station'],
                        'order' => EquipmentFixtures::DATA[1]['order'],
                    ],
                    [
                        'id' => EquipmentFixtures::DATA[2]['id'],
                        'type' => EquipmentFixtures::DATA[2]['type']->value,
                        'price' => [
                            'amount' => bcdiv(EquipmentFixtures::DATA[2]['price']['amount'], '100', 2),
                            'currency' => EquipmentFixtures::DATA[2]['price']['currency'],
                        ],
                        'metaData' => EquipmentFixtures::DATA[2]['metaData'],
                        'state' => EquipmentFixtures::DATA[2]['state']->value,
                        'station' => EquipmentFixtures::DATA[2]['station'],
                        'order' => OrderFixtures::DATA[0]['id'],
                    ],
                ],
            ]
        ];
    }
}

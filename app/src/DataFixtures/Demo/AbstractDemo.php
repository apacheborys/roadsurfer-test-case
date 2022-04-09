<?php

namespace App\DataFixtures\Demo;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

abstract class AbstractDemo extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['demo'];
    }

    protected function getEntities(array $entityIds, string $class, ObjectManager $manager): Collection
    {
        $result = [];

        foreach ($entityIds as $entityId) {
            $result[] = $manager->find($class, Uuid::fromString($entityId));
        }

        return new ArrayCollection($result);
    }
}

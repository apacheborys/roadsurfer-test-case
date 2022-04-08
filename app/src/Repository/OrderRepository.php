<?php

namespace App\Repository;

use App\DTO\EquipmentDemandRequestDTO;
use App\Entity\Equipment;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\Doctrine\UuidType;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order[] findAll()
 * @method Order[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method Order|null findOneBy(array $criteria, ?array $orderBy = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * @param EquipmentDemandRequestDTO $dto
     * @return Equipment[]|null
     */
    public function equipmentDemandTimeline(EquipmentDemandRequestDTO $dto): ?array
    {
        $qb = $this->createQueryBuilder('o');
        $qb
            ->select('e')
            ->join(
                Equipment::class,
                'e',
                Join::WITH,
                $qb->expr()->eq('o.id', 'e.order')
            )
            ->where(
                $qb->expr()->eq('o.endStation', ':station')
            )
            ->andWhere(
                $qb->expr()->between('o.endDate', ':from', ':to')
            )
            ->setParameters([
                'from' => $dto->startDate,
                'to' => $dto->endDate,
                'station' => $dto->station->toString(),
            ])
            ->setMaxResults($dto->limit)
            ->setFirstResult($dto->page * $dto->limit)
        ;

        return $qb->getQuery()->getResult();
    }
}

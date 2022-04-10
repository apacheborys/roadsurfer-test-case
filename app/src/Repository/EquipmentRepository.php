<?php

namespace App\Repository;

use App\DTO\EquipmentDemandRequestDTO;
use App\Entity\Equipment;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Equipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipment[] findAll()
 * @method Equipment[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method Equipment|null findOneBy(array $criteria, ?array $orderBy = null)
 */
class EquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipment::class);
    }

    /**
     * @param EquipmentDemandRequestDTO $dto
     * @return Equipment[]|null
     */
    public function equipmentDemandTimeline(EquipmentDemandRequestDTO $dto): ?array
    {
        $qb = $this->createQueryBuilder('e');
        $qb
            ->select('e')
            ->leftJoin(
                Order::class,
                'o',
                Join::WITH,
                $qb->expr()->eq('e.order', 'o.id')
            )
            ->where(
                $qb->expr()->eq('e.station', ':station'),
                $qb->expr()->isNull('o.id')
            )
            ->orWhere(
                $qb->expr()->andX(
                    $qb->expr()->eq('o.endStation', ':station'),
                    $qb->expr()->orX(
                        $qb->expr()->gt('o.startDate', ':date'),
                        $qb->expr()->lt('o.endDate', ':date')
                    )
                )
            )
            ->setParameters([
                'date' => $dto->date,
                'station' => $dto->station->toString(),
            ])
            ->setMaxResults($dto->limit)
            ->setFirstResult($dto->page * $dto->limit)
        ;

        return $qb->getQuery()->getResult();
    }
}

<?php

namespace App\Resolver;

use App\DTO\EquipmentDemandRequestDTO;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class EquipmentDemandResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        if ($argument->getType() != EquipmentDemandRequestDTO::class) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $dto = new EquipmentDemandRequestDTO();

        if ($request->get('startDate')) {
            $dto->startDate = new \DateTimeImmutable($request->get('startDate'));
        }

        if ($request->get('endDate')) {
            $dto->endDate = new \DateTimeImmutable($request->get('endDate'));
        }

        if ($request->get('station')) {
            $dto->station = Uuid::fromString($request->get('station'));
        }

        if ($request->get('limit')) {
            $limit = (int) $request->get('limit');
            $dto->limit = $limit < 20 && $limit > 0 ? $limit : 20;
        }

        if ($request->get('page')) {
            $page = (int) $request->get('page');
            $dto->page = $page > 0 ? $page : 0;
        }

        yield $dto;
    }
}

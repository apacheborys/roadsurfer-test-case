<?php

namespace App\Resolver;

use App\DTO\EquipmentDemandRequestDTO;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class EquipmentDemandResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        if ($argument->getType() != EquipmentDemandRequestDTO::class) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $dto = new EquipmentDemandRequestDTO();

        if ($request->get('startDate')) {
            $dto->startDate = new \DateTimeImmutable($request->get('startDate'));
        } else {
            throw new \LogicException(sprintf('Can\'t find expected variable %s in received request', 'startDate'));
        }

        if ($request->get('endDate')) {
            $dto->endDate = new \DateTimeImmutable($request->get('endDate'));
        } else {
            throw new \LogicException(sprintf('Can\'t find expected variable %s in received request', 'endDate'));
        }

        if ($request->get('station')) {
            $dto->station = Uuid::fromString($request->get('station'));
        } else {
            throw new \LogicException(sprintf('Can\'t find expected variable %s in received request', 'station'));
        }

        if ($request->get('limit')) {
            $dto->limit = (int) $request->get('limit');
        }

        if ($request->get('page')) {
            $dto->page = (int) $request->get('page');
        }

        yield $dto;
    }
}

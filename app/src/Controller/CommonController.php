<?php

namespace App\Controller;

use App\DTO\EquipmentDemandRequestDTO;
use App\Repository\EquipmentRepository;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommonController
{
    private EquipmentRepository $equipmentRepository;
    private ValidatorInterface $validator;

    public function __construct(EquipmentRepository $equipmentRepository, ValidatorInterface $validator)
    {
        $this->equipmentRepository = $equipmentRepository;
        $this->validator = $validator;
    }

    public function index(): Response
    {
        return new Response(null, Response::HTTP_NOT_FOUND);
    }

    public function equipmentDemandTimeline(EquipmentDemandRequestDTO $dto): Response
    {
        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        // @TODO Should be moved to custom constraint
        if ($dto->startDate->diff($dto->endDate)->days > 20) {
            return new JsonResponse('Date interval can\'t be more than 20 days', Response::HTTP_BAD_REQUEST);
        }

        $cursorDate = \DateTime::createFromImmutable($dto->startDate)
            ->add(\DateInterval::createFromDateString(($dto->page * $dto->limit) . ' day'))
        ;

        $result = [];
        while ($cursorDate <= $dto->endDate || count($result) > $dto->limit) {
            $this->fetchEquipmentData($cursorDate, $dto->station, $result);
            $cursorDate = $cursorDate->add(\DateInterval::createFromDateString('1 day'));
        };

        return new JsonResponse($result, empty($result) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK);
    }

    private function fetchEquipmentData(\DateTime $cursorDate, UuidInterface $stationId, array &$result): void
    {
        $equipments = $this->equipmentRepository->equipmentDemandTimeline(
            $cursorDate,
            $stationId,
            20,
            0
        );

        foreach ($equipments as $equipment) {
            $result[$cursorDate->format('Y-m-d')][] = $equipment->toArray();
        }
    }
}

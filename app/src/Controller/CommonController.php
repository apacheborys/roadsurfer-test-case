<?php

namespace App\Controller;

use App\DTO\EquipmentDemandRequestDTO;
use App\Repository\EquipmentRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommonController
{
    private EquipmentRepository $equipmentRepository;

    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    public function index(): Response
    {
        return new Response(null, Response::HTTP_NOT_FOUND);
    }

    public function equipmentDemandTimeline(EquipmentDemandRequestDTO $dto): Response
    {
        $equipments = $this->equipmentRepository->equipmentDemandTimeline($dto);

        $result = [];
        foreach ($equipments as $equipment) {
            $result[] = $equipment->toArray();
        }

        return new JsonResponse($result, empty($result) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK);
    }
}

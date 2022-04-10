<?php

namespace App\Controller;

use App\DTO\EquipmentDemandRequestDTO;
use App\Repository\EquipmentRepository;
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

        $equipments = $this->equipmentRepository->equipmentDemandTimeline($dto);

        $result = [];
        foreach ($equipments as $equipment) {
            $result[] = $equipment->toArray();
        }

        return new JsonResponse($result, empty($result) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK);
    }
}

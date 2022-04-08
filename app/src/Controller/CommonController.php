<?php

namespace App\Controller;

use App\DTO\EquipmentDemandRequestDTO;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommonController
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(): Response
    {
        return new Response(null, Response::HTTP_NOT_FOUND);
    }

    public function equipmentDemandTimeline(EquipmentDemandRequestDTO $dto): Response
    {
        $equipments = $this->orderRepository->equipmentDemandTimeline($dto);

        $result = [];
        foreach ($equipments as $equipment) {
            $result[] = $equipment->toArray();
        }

        return new JsonResponse($result, empty($result) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK);
    }
}

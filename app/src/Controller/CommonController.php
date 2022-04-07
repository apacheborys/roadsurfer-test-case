<?php

namespace App\Controller;

use App\DTO\EquipmentDemandRequestDTO;
use Symfony\Component\HttpFoundation\Response;

class CommonController
{
    public function index(): Response
    {
        return new Response(null, Response::HTTP_NOT_FOUND);
    }

    public function equipmentDemandTimeline(EquipmentDemandRequestDTO $dto): Response
    {
        dd($dto);
    }
}

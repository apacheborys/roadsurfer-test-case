<?php

namespace App\Enum;

enum CampervanState
{
    case AVAILABLE;
    case BUSY;
    case BOOKED;
    case MAINTENANCE;
}
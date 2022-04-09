<?php

namespace App\Enum;

enum CampervanState: string
{
    case AVAILABLE = 'available';
    case BUSY = 'busy';
    case BOOKED = 'booked';
    case MAINTENANCE = 'maintenance';
}

<?php

namespace App\Enum;

enum EquipmentState: string
{
    case AVAILABLE = 'available';
    case BOOKED = 'booked';
    case IN_USE = 'in_use';
}

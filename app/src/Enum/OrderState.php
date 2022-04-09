<?php

namespace App\Enum;

enum OrderState: string
{
    case PLACED = 'placed';
    case CONFIRMED = 'confirmed';
    case EXECUTING = 'executing';
    case FINISHED = 'finished';
    case CANCELLED = 'cancelled';
}

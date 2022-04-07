<?php

namespace App\Enum;

enum BookingState
{
    case PLACED;
    case CONFIRMED;
    case EXECUTING;
    case FINISHED;
    case CANCELLED;
}

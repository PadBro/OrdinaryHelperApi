<?php

namespace App\Enums;

enum TicketState: int
{
    case Open = 0;
    case Closed = 1;
}

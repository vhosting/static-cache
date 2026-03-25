<?php

namespace App\Enums;

enum DeleteMethod: string
{
    case Exact = 'exact';
    case StartsWith = 'starts_with';
    case EndsWith = 'ends_with';
    case Contains = 'contains';
}

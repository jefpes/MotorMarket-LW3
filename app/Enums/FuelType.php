<?php

namespace App\Enums;

enum FuelType: string
{
    case GASOLINE = 'GASOLINA';
    case DIESEL   = 'DIESEL';
    case ETHANOL  = 'ETANOL';
    case FLEX     = 'FLEX';
    case HYBRID   = 'HIBRIDO';
    case ELECTRIC = 'ELETRICO';
    case OTHER    = 'OUTRO';
}

<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CD = 'CARTÃO DE DÉBITO';
    case CC = 'CARTÃO DE CRÉDITO';
    case BN = 'BOLETO BANCÁRIO';
    case DP = 'DEPÓSITO';
    case DN = 'DINHEIRO';
    case TR = 'TRANSFERÊNCIA';
    case CH = 'CHEQUE';
    case PD = 'PIX';
}

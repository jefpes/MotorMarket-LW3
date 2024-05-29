<?php

namespace App\Enums;

enum LogradouroType: string
{
    case AEROPORTO   = 'Aeroporto';
    case ALAMEDA     = 'Alameda';
    case APARTAMENTO = 'Apartamento';
    case AREA        = 'Área';
    case AVENIDA     = 'Avenida';
    case CAMPO       = 'Campo';
    case CHACARA     = 'Chácara';
    case COLONIA     = 'Colônia';
    case CONDOMINIO  = 'Condomínio';
    case CONJUNTO    = 'Conjunto';
    case DISTRITO    = 'Distrito';
    case ESPLANADA   = 'Esplanada';
    case ESTACAO     = 'Estação';
    case ESTRADA     = 'Estrada';
    case FAVELA      = 'Favela';
    case FAZENDA     = 'Fazenda';
    case FEIRA       = 'Feira';
    case JARDIM      = 'Jardim';
    case LAGO        = 'Lago';
    case LAGOA       = 'Lagoa';
    case LARGO       = 'Largo';
    case LOTEAMENTO  = 'Loteamento';
    case MORRO       = 'Morro';
    case NUCLEO      = 'Núcleo';
    case PARQUE      = 'Parque';
    case PASSARELA   = 'Passarela';
    case PATIO       = 'Pátio';
    case PRACA       = 'Praça';
    case QUADRA      = 'Quadra';
    case RECANTO     = 'Recanto';
    case RESIDENCIAL = 'Residencial';
    case RODOVIA     = 'Rodovia';
    case RUA         = 'Rua';
    case SETOR       = 'Setor';
    case SITIO       = 'Sítio';
    case TRAVESSA    = 'Travessa';
    case TRECHO      = 'Trecho';
    case TREVO       = 'Trevo';
    case VALE        = 'Vale';
    case VEREDA      = 'Vereda';
    case VIA         = 'Via';
    case VIADUTO     = 'Viaduto';
    case VIELA       = 'Viela';
    case VILA        = 'Vila';
}

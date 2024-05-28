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

    /**
     * Obter o nome legível do tipo de logradouro.
     */
    public function name(): string
    {
        return match($this) {
            self::AEROPORTO   => 'Aeroporto',
            self::ALAMEDA     => 'Alameda',
            self::APARTAMENTO => 'Apartamento',
            self::AREA        => 'Área',
            self::AVENIDA     => 'Avenida',
            self::CAMPO       => 'Campo',
            self::CHACARA     => 'Chácara',
            self::COLONIA     => 'Colônia',
            self::CONDOMINIO  => 'Condomínio',
            self::CONJUNTO    => 'Conjunto',
            self::DISTRITO    => 'Distrito',
            self::ESPLANADA   => 'Esplanada',
            self::ESTACAO     => 'Estação',
            self::ESTRADA     => 'Estrada',
            self::FAVELA      => 'Favela',
            self::FAZENDA     => 'Fazenda',
            self::FEIRA       => 'Feira',
            self::JARDIM      => 'Jardim',
            self::LAGO        => 'Lago',
            self::LAGOA       => 'Lagoa',
            self::LARGO       => 'Largo',
            self::LOTEAMENTO  => 'Loteamento',
            self::MORRO       => 'Morro',
            self::NUCLEO      => 'Núcleo',
            self::PARQUE      => 'Parque',
            self::PASSARELA   => 'Passarela',
            self::PATIO       => 'Pátio',
            self::PRACA       => 'Praça',
            self::QUADRA      => 'Quadra',
            self::RECANTO     => 'Recanto',
            self::RESIDENCIAL => 'Residencial',
            self::RODOVIA     => 'Rodovia',
            self::RUA         => 'Rua',
            self::SETOR       => 'Setor',
            self::SITIO       => 'Sítio',
            self::TRAVESSA    => 'Travessa',
            self::TRECHO      => 'Trecho',
            self::TREVO       => 'Trevo',
            self::VALE        => 'Vale',
            self::VEREDA      => 'Vereda',
            self::VIA         => 'Via',
            self::VIADUTO     => 'Viaduto',
            self::VIELA       => 'Viela',
            self::VILA        => 'Vila',
        };
    }
}

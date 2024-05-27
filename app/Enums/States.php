<?php

namespace App\Enums;

enum States: string
{
    case AC = 'AC'; // Acre
    case AL = 'AL'; // Alagoas
    case AP = 'AP'; // Amapá
    case AM = 'AM'; // Amazonas
    case BA = 'BA'; // Bahia
    case CE = 'CE'; // Ceará
    case DF = 'DF'; // Distrito Federal
    case ES = 'ES'; // Espírito Santo
    case GO = 'GO'; // Goiás
    case MA = 'MA'; // Maranhão
    case MT = 'MT'; // Mato Grosso
    case MS = 'MS'; // Mato Grosso do Sul
    case MG = 'MG'; // Minas Gerais
    case PA = 'PA'; // Pará
    case PB = 'PB'; // Paraíba
    case PR = 'PR'; // Paraná
    case PE = 'PE'; // Pernambuco
    case PI = 'PI'; // Piauí
    case RJ = 'RJ'; // Rio de Janeiro
    case RN = 'RN'; // Rio Grande do Norte
    case RS = 'RS'; // Rio Grande do Sul
    case RO = 'RO'; // Rondônia
    case RR = 'RR'; // Roraima
    case SC = 'SC'; // Santa Catarina
    case SP = 'SP'; // São Paulo
    case SE = 'SE'; // Sergipe
    case TO = 'TO'; // Tocantins

    public function nome(): string
    {
        return match($this) {
            self::AC => 'Acre',
            self::AL => 'Alagoas',
            self::AP => 'Amapá',
            self::AM => 'Amazonas',
            self::BA => 'Bahia',
            self::CE => 'Ceará',
            self::DF => 'Distrito Federal',
            self::ES => 'Espírito Santo',
            self::GO => 'Goiás',
            self::MA => 'Maranhão',
            self::MT => 'Mato Grosso',
            self::MS => 'Mato Grosso do Sul',
            self::MG => 'Minas Gerais',
            self::PA => 'Pará',
            self::PB => 'Paraíba',
            self::PR => 'Paraná',
            self::PE => 'Pernambuco',
            self::PI => 'Piauí',
            self::RJ => 'Rio de Janeiro',
            self::RN => 'Rio Grande do Norte',
            self::RS => 'Rio Grande do Sul',
            self::RO => 'Rondônia',
            self::RR => 'Roraima',
            self::SC => 'Santa Catarina',
            self::SP => 'São Paulo',
            self::SE => 'Sergipe',
            self::TO => 'Tocantins',
        };
    }
}

<?php

namespace App\Helpers;

class MoneyField
{
    /**
     * Convert a formatted string to a float value.
     *
     * @param string $value
     * @return string
     */
    public static function convertToFloat(string $value): string
    {
        // Remove todos os espaços e troque vírgulas por pontos
        return str_replace(' ', '', $value);
    }
}

<?php

namespace App\Helpers;

class Helper
{
    public static function numberFormat(string $value)
    {
        return number_format($value, 2, ',', '.');
    }
}
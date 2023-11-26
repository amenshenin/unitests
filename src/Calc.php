<?php
namespace App;

use Exception;

class Calc
{
    public function divide(float $dividend = 0.0, float $divider = 1.0): float
    {
        if ($divider == 0) {
            throw new Exception('Деление на ноль.');
        }
        return $dividend / $divider;
    }
}
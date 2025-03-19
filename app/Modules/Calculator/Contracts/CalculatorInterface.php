<?php

namespace App\Modules\Calculator\Contracts;
interface CalculatorInterface
{
    public function calculate(array $distances, bool $extraPerson): array;
}

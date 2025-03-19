<?php

namespace App\Modules\Calculator\Services;

use App\Modules\Calculator\Contracts\CalculatorInterface;

abstract class BaseCalculator implements CalculatorInterface
{
    protected float $costPerMile;
    protected float $extraPersonCost;

    public function __construct(float $costPerMile, float $extraPersonCost)
    {
        $this->costPerMile = $costPerMile;
        $this->extraPersonCost = $extraPersonCost;
    }

    public function calculate(array $distances, bool $extraPerson): array
    {
        $totalDistance = array_sum($distances);
        $baseCost = $totalDistance * $this->costPerMile;
        $extraCost = $extraPerson ? $this->extraPersonCost : 0;
        $totalPrice = $baseCost + $extraCost;

        return [
            'drop_off_count' => count($distances),
            'total_distance' => $totalDistance,
            'cost_per_mile' => $this->costPerMile,
            'extra_person_price' => $extraCost,
            'total_price' => $totalPrice
        ];
    }
}

<?php

namespace App\Modules\Calculator\Services;

class TruckDeliveryCalculator extends BaseCalculator
{
    public function __construct()
    {
        parent::__construct(2.00, 30.00);
    }
}

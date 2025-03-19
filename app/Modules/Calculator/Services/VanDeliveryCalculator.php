<?php

namespace App\Modules\Calculator\Services;

class VanDeliveryCalculator extends BaseCalculator
{
    public function __construct()
    {
        parent::__construct(1.00, 15.00);
    }
}

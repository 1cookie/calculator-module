<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Calculator\Services\VanDeliveryCalculator;

class CalculatorTest extends TestCase
{
    public function test_van_calculator_calculates_correctly()
    {
        $calculator = new VanDeliveryCalculator();
        $result = $calculator->calculate([55, 13, 22], false);

        $this->assertEquals(3, $result['drop_off_count']);
        $this->assertEquals(90, $result['total_distance']);
        $this->assertEquals(1.00, $result['cost_per_mile']);
        $this->assertEquals(0, $result['extra_person_price']);
        $this->assertEquals(90, $result['total_price']);
    }
}

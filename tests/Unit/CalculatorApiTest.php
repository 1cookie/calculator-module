<?php

namespace Tests\Unit;

use Tests\TestCase;

class CalculatorApiTest extends TestCase
{
    public function test_api_returns_correct_van_delivery_cost()
    {
        $response = $this->postJson('/api/calculate-cost', [
            'distances' => [55, 13, 22],
            'extra_person' => false,
            'vehicle_type' => 'van'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'drop_off_count' => 3,
                'total_distance' => 90,
                'cost_per_mile' => 1.00,
                'extra_person_price' => 0,
                'total_price' => 90
            ]);
    }
}


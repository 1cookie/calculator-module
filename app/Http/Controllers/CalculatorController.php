<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Calculator\Contracts\CalculatorInterface;
use App\Modules\Calculator\Services\VanDeliveryCalculator;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'distances' => 'required|array|min:1|max:5',
            'distances.*' => 'numeric|min:0',
            'extra_person' => 'boolean',
            'vehicle_type' => 'required|string|in:van'
        ]);

        $calculator = new VanDeliveryCalculator();
        $result = $calculator->calculate($validated['distances'], $validated['extra_person'] ?? false);

        return response()->json($result);
    }
}

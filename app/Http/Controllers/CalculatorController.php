<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Calculator\Services\VanDeliveryCalculator;
use App\Modules\Calculator\Services\TruckDeliveryCalculator;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'distances' => 'required|array|min:1|max:5',
            'distances.*' => 'numeric|min:0',
            'extra_person' => 'boolean',
            'vehicle_type' => 'required|string|in:van,truck'
        ]);

        $calculator = match ($validated['vehicle_type']) {
            'truck' => new TruckDeliveryCalculator(),
            default => new VanDeliveryCalculator(),
        };

        return response()->json($calculator->calculate($validated['distances'], $validated['extra_person'] ?? false));
    }
}

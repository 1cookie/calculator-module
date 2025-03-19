<?php

use App\Http\Controllers\CalculatorController;
use Illuminate\Support\Facades\Route;

Route::post('/calculate-cost', [CalculatorController::class, 'calculate']);

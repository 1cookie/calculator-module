
# Delivery Cost Calculator API

This project provides a simple API for calculating delivery costs based on the type of vehicle (Van or Truck), the distances of the deliveries, and whether an extra person is needed for assistance.

## Endpoints

### POST `/api/calculate-cost`
This endpoint calculates the total cost of a delivery based on the input parameters:

#### Request Body

```json
{
    "distances": [55, 13, 22],
    "extra_person": true,
    "vehicle_type": "truck"
}
```

- `distances`: An array of integers representing the distances to be covered (between 1 and 5 distances).
- `extra_person`: A boolean flag indicating if an extra person is required (defaults to `false`).
- `vehicle_type`: A string that specifies the vehicle type. It can be either `van` or `truck`.

#### Response

The response will be a JSON object containing the calculated delivery details:

```json
{
    "drop_off_count": 3,
    "total_distance": 90,
    "cost_per_mile": 2.00,
    "extra_person_price": 30,
    "total_price": 210
}
```

- `drop_off_count`: The number of drop-off points (equal to the number of distances provided).
- `total_distance`: The total distance to be covered (sum of all distances).
- `cost_per_mile`: The cost per mile based on the vehicle type.
- `extra_person_price`: The price for an extra person (if applicable).
- `total_price`: The total cost of the delivery.

## Routes

In the `routes/api.php` file, the route to handle the delivery calculation is defined as follows:

```php
Route::post('/calculate-cost', [CalculatorController::class, 'calculate']);
```

The controller that handles the calculation logic is `CalculatorController`.

## Controllers

### CalculatorController

This controller receives the POST request, validates the input, and calculates the delivery cost using either the `VanDeliveryCalculator` or the `TruckDeliveryCalculator` class based on the provided `vehicle_type`.

```php
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
```

## Testing

There are unit and feature tests included in the project to verify the correct behavior of the calculator.

### Unit Tests

The unit test for the `VanDeliveryCalculator` ensures that the business logic is correctly calculating the delivery cost.

To run the unit test:

```bash
php artisan test --filter CalculatorApiTest
```

### Feature Tests

The feature tests simulate HTTP requests and test the full integration of the API endpoint.

To run the feature test:

```bash
php artisan test --filter CalculatorTest
```

## cURL Examples

You can test the API using `cURL` by sending POST requests to the `/api/calculate-cost` endpoint.

### Example 1: Van Delivery

```bash
curl -X POST https://www.deliveryapp.com/api/calculate-cost      -H "Content-Type: application/json"      -d '{
         "distances": [55, 13, 22],
         "extra_person": false,
         "vehicle_type": "van"
     }'
```

### Example 2: Truck Delivery

```bash
curl -X POST https://www.deliveryapp.com/api/calculate-cost      -H "Content-Type: application/json"      -d '{
         "distances": [55, 13, 22],
         "extra_person": true,
         "vehicle_type": "truck"
     }'
```

## Installation

1. Clone the repository:

```bash
git clone https://github.com/1cookie/calculator-module
cd calculator-module
```

2. Install dependencies:

```bash
composer install
```

3. Set up your `.env` file

4. Start the development server:

```bash
php artisan serve
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

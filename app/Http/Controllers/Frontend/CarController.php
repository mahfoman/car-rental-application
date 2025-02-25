<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('availability', true);

        if ($request->has('type') && !empty($request->type)) {
            $query->where('car_type', 'like', "%{$request->type}%");
        }

        if ($request->has('brand') && !empty($request->brand)) {
            $query->where('brand', 'like', "%{$request->brand}%");
        }

        if ($request->has('rent_price_range') && !empty($request->rent_price_range)) {
            $rentPriceRange = $request->rent_price_range;

            // Defining rent price ranges and apply filters accordingly
            if ($rentPriceRange === '100-500') {
                $query->whereBetween('daily_rent_price', [100, 500]);
            } elseif ($rentPriceRange === '500-1000') {
                $query->whereBetween('daily_rent_price', [500, 1000]);
            } elseif ($rentPriceRange === '1000-above') {
                $query->where('daily_rent_price', '>', 1000);
            }elseif ($rentPriceRange === '100-below') {
                $query->where('daily_rent_price', '<', 100);
            }
        }

        $cars = $query->orderBy('id', 'desc')->get();

        return Inertia::render('Frontend/Cars/Index', [
            'cars' => $cars,
            'filters' => $request->only(['type', 'brand'])
        ]);
    }

    public function show( Car $car)
    {
        //dd($car);
        return Inertia::render('Frontend/Cars/Show', [
            'car' => $car
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalCars' => Car::count(),
                'availableCars' => Car::where('availability', true)->count(),
                'totalRentals' => Rental::where('status', 'Completed')->count(),
                'totalProfit' => Rental::where('status', 'Completed')->sum('total_cost'),
            ],
        ]);
    }

}

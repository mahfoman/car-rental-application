<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewRentalNotification;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class RentalController extends Controller
{
// List all rentals
    public function index()
    {

        $rentals = Rental::with(['user', 'car'])->orderBy('id', 'desc')->get();

        return Inertia::render('Admin/Rentals/Index', [
            'rentals' => $rentals
        ]);
    }

    // Show create rental form
    public function create()
    {
        return Inertia::render('Admin/Rentals/Create', [
            'users' => User::where('role', 'customer')->get(['id', 'name']),
            'cars' => Car::where('availability', true)->get(['id', 'name', 'daily_rent_price']),
        ]);
    }

    // Store new rental
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Check for overlapping rentals
        $overlappingRentals = Rental::where('car_id', $request->car_id)
            ->where('status', '!=', 'Canceled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->exists();

        if ($overlappingRentals) {
            return back()->with([
                'message' => 'This car "'.$car->name.'" is already booked for the selected dates',
                'status' => false,
                'error' => true
            ]);
        }

        $days = now()->parse($request->start_date)->diffInDays($request->end_date);
        if ($days == 0) {
            $days = 1;
        }
        $totalCost = $days * $car->daily_rent_price;

        Rental::create([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => $request->status,
        ]);

        return redirect()->route('rentals.create')->with([
            'message' => 'Create Successful',
            'status' => true,
            'error' => false
        ]);
    }

    function edit(Rental $rental)
    {
        return Inertia::render('Admin/Rentals/Create', [
            'rental' => $rental,
            'users' => User::where('role', 'customer')->get(['id', 'name']),
            'cars' => Car::where('availability', true)->get(['id', 'name', 'daily_rent_price']),
            'isUpdating' => true
        ]);
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $car = Car::findOrFail($request->car_id);
        $days = now()->parse($request->start_date)->diffInDays($request->end_date);

        if ($days == 0) {
            $days = 1;
        }

        $totalCost = $days * $car->daily_rent_price;

        $rental->update([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => $request->status,
        ]);

        if( $rental->status == 'Completed' || $rental->status == 'Canceled' ){
            $startDate = Carbon::parse($request->start_date)->format('d M, Y');
            $endDate = Carbon::parse($request->end_date)->format('d M, Y');

            // Send email notification to customer
            $subject = "Your booking request for car \"" . $car->name . "\" from " . $startDate . " to " . $endDate. " has been " . $rental->status;
            $salutation = "Dear ".$rental->user->name;
            $messages = "Your request for booking Car \"" . $car->name . "\" with following detiails has been "
                        . ($rental->status == 'Completed' ? "Completed. Have a nice pleasant trip" : "Canceled due to conflict schedules. Sorry for inconvenience!." )  ;
            Mail::to("developntest@gmail.com")->send(new NewRentalNotification($car, $rental->user , $startDate , $endDate, $totalCost, $subject, $salutation, $messages));
        }

        return redirect()->route('rentals.create')->with([
            'message' => 'Update Successful',
            'status' => true,
            'error' => ''
        ]);
    }

    // Delete rental
    public function destroy(Rental $rental)
    {
        try {
            $rental->delete();
            $data =['message'=>'Delete Successful','status'=>true,'error'=>''];
            return  redirect()->route('rentals.index')->with($data);
        }catch (Exception $e){
            $data =['message'=>'Delete Fail','status'=>false,'error'=>$e->getMessage()];
            return  redirect()->route('rentals.index')->with($data);
        }
    }
}

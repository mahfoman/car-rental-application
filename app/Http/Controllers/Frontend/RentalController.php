<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\RentalConfirmNotification;
use App\Models\Car;
use App\Models\Rental;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRentalNotification;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->header('id');
        $rentals = Rental::where('user_id', $user_id)->with('car')->orderBy('id', 'desc')->get();
        return Inertia::render('Frontend/Rentals/Index', [
            'rentals' => $rentals,
            'flash.share_data' => $request->session()->get('flash.share_data')
        ]);
    }

    public function store(Request $request)
    {
        $user_id = $request->header('id'); //dd($request->input());

        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date',
        ]);

        $request->merge([
            'start_date' => Carbon::parse($request->start_date)->timezone(config('app.timezone'))->toDateString(),
            'end_date' => Carbon::parse($request->end_date)->timezone(config('app.timezone'))->toDateString(),
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
        $days = ( $days < 1 ) ? 1 : $days + 1;
        $totalCost = $days * $car->daily_rent_price;

        $rental = Rental::create([
            'user_id' => $user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'Ongoing',
            'total_cost' => $totalCost
        ]);

        $startDate = Carbon::parse($request->start_date)->format('d M, Y');
        $endDate = Carbon::parse($request->end_date)->format('d M, Y');

        // Send email notification to customer
        $subject = "Your booking request for car \"" . $car->name . "\" from " . $startDate . " to " . $endDate. " has been sent";
        $salutation = "Dear ".$rental->user->name;
        $messages = "Your request for booking Car \"" . $car->name . "\" with following detiails has been sent. We will reply with confirmation soon";
        Mail::to("developntest@gmail.com")->send(new NewRentalNotification($car, $rental->user , $startDate, $endDate, $totalCost, $subject, $salutation, $messages));


        // send email notification to admin
        $subject = "Booking request for car \"" . $car->name . "\" from " . $startDate . " to " . $endDate. " has been sent by " . $rental->user->name;
        $salutation = "Dear Admin";
        $messages = "A customer named \"". $rental->user->name ."\" has submitted a new Car rental request with following detiails";
        Mail::to("developntest@gmail.com")->send(new NewRentalNotification($car, $rental->user , $startDate, $endDate, $totalCost, $subject, $salutation, $messages));


        return redirect()->route('rentals.index')->with([
            'message' => 'This rental is successfully created with car name ' . $car->name . '.',
            'status' => true,
            'error' => ''
        ]);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $user_id = $request->header('id');
            $rental = Rental::with(['user','car'])->find($id);
            //dd((int)$user_id, $rental->user_id);
            if ($rental->user_id === (int)$user_id) {
                $rental->status = 'Canceled';
                $rental->save();

                // send email notification to admin about cancellation
                $startDate = Carbon::parse($rental->start_date)->format('d M, Y');
                $endDate = Carbon::parse($rental->end_date)->format('d M, Y');
                $subject = "Booking request for car \"" . $rental->car->name . "\" from " . $startDate . " to " . $endDate. " has been canceled by " . $rental->user->name;
                $salutation = "Dear Admin";
                $messages = "A customer named \"". $rental->user->name ."\" has canceled Car rental request with following detiails";
                Mail::to("developntest@gmail.com")->send(new NewRentalNotification($rental->car, $rental->user , $startDate, $endDate, $rental->total_cost, $subject, $salutation, $messages));
            }

            $data =['message'=>'Cancel Successful','status'=>true,'error'=>''];
            return  redirect()->route('rentals.index')->with($data);
        }catch (Exception $e){
            $data =['message'=>'Cancel Fail','status'=>false,'error'=>''];
            return  redirect()->route('rentals.index')->with($data);
        }
    }
}

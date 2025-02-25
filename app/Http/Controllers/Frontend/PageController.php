<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use App\Models\Car;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;


class PageController extends Controller
{
    //
    public function home(){
        $cars = Car::whereHas('rentals', function ($query) {
                        $query->where('status', 'completed'); })
                    ->withCount('rentals')
                    ->orderByDesc('rentals_count')
                    ->take(5) // Top 5 most rented cars
                    ->get(); //dd($cars);
        return Inertia::render("Frontend/Pages/Home",[
            'cars' => $cars,
        ]);
    }

    public function about(){
        return Inertia::render("Frontend/Pages/About");
    }

    public function contact(){
        return Inertia::render("Frontend/Pages/Contact");
    }

    public function contact_store(Request $request)
    {
        try{
            //dd($request->input());
            $name = $request->input('name');
            $email = $request->input('email');
            $message = $request->input('description');

            Mail::to("mahfoozur.rahman.bd@gmail.com")->send(new ContactEmail($name, $email, $message));

            return redirect()->route('ContactPage')->with([
                'message' => 'Message Sent Successful',
                'status' => true,
                'error' => ''
            ]);

        } catch (Exception $e){
            return redirect()->route('ContactPage')->with([
                'message' => 'Message Sent Fail',
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }


}

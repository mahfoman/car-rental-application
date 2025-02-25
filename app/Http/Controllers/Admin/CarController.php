<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CarController extends Controller
{
    public function index()
    {
        //echo "hello"; exit;
        $cars = Car::orderBy('id', 'desc')->get(); //dd($cars);
        return Inertia::render('Admin/Cars/Index', [
            'cars' => $cars
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Cars/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
        } else {
            $imagePath = null; // No image uploaded
        }
        //dd($validated);
        Car::create([
            'name' => $validated['name'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'car_type' => $validated['car_type'],
            'daily_rent_price' => $validated['daily_rent_price'],
            'availability' => $validated['availability'] ?? true,
            'image' => $imagePath, // Store the image path
        ]);

        //return redirect()->route('admin.cars.index')->with('status', 'Car created successfully!');
        return redirect()->route('cars.create')->with([
            'message' => 'Create Successful',
            'status' => true,
            'error' => ''
        ]);
    }

    function edit(Car $car)
    {
        return Inertia::render('Admin/Cars/Create', [
            'car' => $car,
            'isUpdating' => true
        ]);
    }

    public function update(Request $request, Car $car)
    {
//        dd('inside update');
        //dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'nullable|boolean',
            //'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        if ($request->hasFile('image')) {
            // Deleting old image if it exists
            if ($car->image) {
                Storage::disk('public')->delete( $car->image);
            }
            $imagePath = $request->file('image')->store('car_images', 'public');
        } else {
            $imagePath = $car->image; // Keep the existing image if no new image is uploaded
        }

        $car->update([
            'name' => $validated['name'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'car_type' => $validated['car_type'],
            'daily_rent_price' => $validated['daily_rent_price'],
            'availability' => $validated['availability'] ?? true,
            'image' => $imagePath, // Update the image path
        ]);

        return redirect()->route('cars.create')->with([
            'message' => 'Update Successful',
            'status' => true,
            'error' => ''
        ]);
    }



    public function destroy(Car $car)
    {
        try {
            // Checking if the car has an image and if the file exists on the server
            if ($car->image && Storage::disk('public')->exists( $car->image)) {
                Storage::disk('public')->delete( $car->image);
            }
            $car->delete();
            $data =['message'=>'Delete Successful','status'=>true,'error'=>''];
            return  redirect()->route('cars.index')->with($data);
        }catch (Exception $e){
            $data =['message'=>'Delete Fail','status'=>false,'error'=>$e->getMessage()];
            return  redirect()->route('cars.index')->with($data);
        }
    }

}

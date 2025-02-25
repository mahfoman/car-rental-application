<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class CustomerController extends Controller
{
    // List all customers
    public function index()
    {
        $customers = User::where('role', 'customer')->orderBy('id', 'desc')->get(['id', 'name', 'email']);

        return Inertia::render('Admin/Customers/Index', [
            'customers' => $customers
        ]);
    }

    // Show create customer form
    public function create()
    {
        return Inertia::render('Admin/Customers/Create');
    }

    // Store new customer
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'customer'
            ]);

            return redirect()->route('customers.create')->with([
                'message' => 'Create Successful',
                'status' => true,
                'error' => ''
            ]);
        }catch (Exception $e){
            return redirect()->route('customers.create')->with([
            'message' => 'Create Fail',
            'status' => false,
            'error' => $e->getMessage()
            ]);
        }
    }

    function edit(User $customer)
    {
        return Inertia::render('Admin/Customers/Create', [
            'customer' => $customer,
            'isUpdating' => true
        ]);
    }

    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => "required|email|unique:users,email,{$customer->id}",
        ]);

        try {
            $customer->update($validated);

            return redirect()->route('customers.create')->with([
                'message' => 'Update Successful',
                'status' => true,
                'error' => ''
            ]);
        } catch (Exception $e) {
            return redirect()->route('customers.create')->with([
                'message' => 'Update Fail',
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    // Delete customer
    public function destroy(User $customer)
    {
        try {
            $customer->delete();
            $data =['message'=>'Delete Successful','status'=>true,'error'=>''];
            return  redirect()->route('customers.index')->with($data);
        }catch (Exception $e){
            $data =['message'=>'Delete Fail','status'=>false,'error'=>''];
            return  redirect()->route('customers.index')->with($data);
        }
    }
}

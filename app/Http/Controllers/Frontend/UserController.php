<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    function register(Request $request){

        try {
            $name=$request->input('name');
            $email=$request->input('email');
            $role= 'customer';
            $password=$request->input('password');

            User::create([
                'name'=>$name,
                'email'=>$email,
                'role'=>$role,
                'password' => Hash::make($password),
            ]);

            return redirect()->route('RegistrationPage')->with([
                'message' => 'Registration Successful',
                'status' => true,
                'error' => ''
            ]);
        }
        catch (Exception $e) {
            return redirect()->route('RegistrationPage')->with([
                'message' => 'Registration Fail',
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }

    }

    function login(Request $request) {
        // Retrieving the user by email
        $user = User::where('email', $request->input('email'))->first();

        // Checking if user exists and verify password
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Storing user info in session
            $request->session()->put('email', $user->email);
            $request->session()->put('user_id', $user->id);
            $request->session()->put('role', $user->role);
            $request->session()->put('user_name', $user->name);

            return Inertia::location($user->role === 'admin' ? '/admin/dashboard' : '/rentals');
        }

        // Login failed
        return back()->with([
            'message' => 'Login Failed',
            'status' => false,
            'error' => 'Invalid email or password'
        ]);
    }

    function logout(Request $request){
//        echo 'logout'; exit;
        $request->session()->flush();
        return redirect()->route('HomePage');

    }

    function UpdateProfile(Request $request){
        // update profile details
        try{

            $email=$request->input('email');
            $name=$request->input('name');
            $mobile=$request->input('mobile');
            $password=$request->input('password');

            User::where('email','=',$email)->update([
                'name'=>$name,
                'email'=>$email,
                'mobile'=>$mobile,
                'password'=>$password
            ]);

            session()->flash('message', 'Request Successful');
            session()->flash('status', true);
            session()->flash('error', '');

        }catch (Exception $e){
            session()->flash('message', 'Request not Successful');
            session()->flash('status', false);
            session()->flash('error', $e->getMessage());

        }
        return  redirect()->route('ProfilePage');
    }



    public function LoginPage(Request $request)
    {
        $email=$request->session()->get('email','default'); //dd($email);
        //dd($request->session()->get('flash'));

        if($email != 'default') {
            return redirect()->route('rentals.index');
        }

        return Inertia::render('Frontend/Auth/LoginPage',[
            'flash.share_data' => $request->session()->get('flash.share_data'),
        ]);
    }

    public function RegistrationPage(Request $request)
    {
        $email=$request->session()->get('email','default'); //dd($email);

        if($email != 'default') {
            return redirect()->route('DashboardPage');
        }
        return Inertia::render('Frontend/Auth/RegistrationPage');
    }

    public function ResetPasswordPage(Request $request)
    {
        $email=$request->session()->get('email','default'); //dd($email);

        if($email != 'default') {
            return redirect()->route('DashboardPage');
        }
        return Inertia::render('ResetPasswordPage');
    }

    public function ProfilePage(Request $request)
    {
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return Inertia::render('ProfilePage',['list'=>$user]);
    }
}

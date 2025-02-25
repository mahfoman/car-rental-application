<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id=$request->session()->get('user_id','default');
        $email=$request->session()->get('email','default');
        $role=$request->session()->get('role','default');

        if($email=="default"){
            $request->session()->flash('share_data','You are not authorized to access this page!');
            //dd($request->session()->get('flash'));
            return redirect('/login');
        }
        else{
            $request->headers->set('id',$user_id);
            $request->headers->set('email',$email);
            $request->headers->set('role',$role);

            return $next($request);
        }
    }
}

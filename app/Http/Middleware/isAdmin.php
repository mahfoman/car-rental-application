<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    public function handle($request, Closure $next): Response
    {
        $role=$request->session()->get('role','default');
        if ($role !== 'admin') {
            $request->session()->flash('share_data','You are not authorized to access this admin page!');
            return redirect('/rentals');
        }
        return $next($request);
    }

}

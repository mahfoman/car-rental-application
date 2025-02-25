<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isCustomer
{
    public function handle($request, Closure $next): Response
    {
        $role=$request->session()->get('role','default');
        if ($role !== 'customer') {
            $request->session()->flash('share_data','You are not authorized to access this customer page!');
            return redirect('/admin/rentals');
        }
        return $next($request);
    }

}

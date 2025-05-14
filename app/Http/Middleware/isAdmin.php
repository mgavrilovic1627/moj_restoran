<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        
        if(!$request->user())
        {
            return redirect("login")->with("error","Niste ulogovani uopste!");
        }

        if( $request->user()->role !== "admin") 
        {
            return redirect("/")->with("error","Niste ulogovani kao admin!");
        }

        return $next($request);
        
    }
}

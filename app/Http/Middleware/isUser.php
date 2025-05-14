<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);

        /* Originalna provera
        if($request->user()->role !== "user") 
        {
            return redirect("/")->with("error","Niste ulogovani uopste!");
        }
        return $next($request);
        */
    }
}

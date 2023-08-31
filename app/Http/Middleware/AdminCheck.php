<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()){
            return redirect(RouteServiceProvider::HOME);
        }

        // $user = User::find(Auth::user()->id);
        // if(!$user->hasRole('admin')){
        if(!auth()->user()->is_admin){
            return redirect(RouteServiceProvider::HOME);
        }
        
        return $next($request);
    }
}

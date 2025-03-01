<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if(Auth::check())
            {
                if(Auth::user()->permissions == '1' ||Auth::user()->permissions == '2')
                {
                    return $next($request);
                }
                else
                {
                    return redirect('/home')->with('status','Access Denied! as you are not an admin!');
                }
            }
            else
            {
                return redirect('/home')->with('status','Please Login First');
            }
    }

    public function index()
    {
        return view('home');
    }
}

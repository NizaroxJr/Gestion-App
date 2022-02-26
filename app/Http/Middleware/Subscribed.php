<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Auth;
use Session;

class Subscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->subscribed('default')|| Auth::user()->subscription('default')->ended()) {
            if(!Auth::user()->parent()->get()->count()){
                return redirect('plans');
            }
            else{
               abort(403, "You're Not Subscribed"); 
            }
        }
          return $next($request);
        
    }
}

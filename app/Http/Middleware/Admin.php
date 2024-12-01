<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


use Auth;

class Admin
{
   
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        $role_id = Auth::user()->role_id;
        
        if($role_id=='1'){
        
            return $next($request);
        
        
        }else{
        
        
            return redirect()->route('dashboard');
        
        
        }
    }

}







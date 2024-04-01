<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Rolechecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role_id): Response
    {
        // return $next($request);
        if(auth::check()){
            $user = user::where('role_id', 1)->first();
            $role_id = $user->role_id;
            if($role_id == 1){
                return $next($request);
            }else{
                return response()->json([
                    'message'=>'Unauthorized'
                ],403);
 
            }

        }
    }
}

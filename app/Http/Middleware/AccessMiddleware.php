<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hash_password='$2y$10$TGGSOEl.kC2Jx7QcgIM5de91wLPWwxc.Mtj.7P/OacuHKHtwsZawG';

        if(Hash::check($request->auth_key ,$hash_password)!==true){
            return response()->json([
                "msg"=>"authentication failed!",
                "time"=>date('Y-m-d H:i:s')
            ]);
        }
        return $next($request);
    }
}

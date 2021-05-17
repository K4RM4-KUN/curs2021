<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;
use App\Models\Subscription;

class SubscribeSecurity
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
        if($request->id != Auth::user()->id && Author::where([['user_id',$request->id],['subscriptions',1]])->exists()){ 

            if(!Subscription::where([['subscriber_id',Auth::user()->id],['caducate_at',">",date("Y-m-d H:i:s")],['user_id',$request->id]])->exists()){
                return $next($request);
            }  
        }
        return back();
    }
}

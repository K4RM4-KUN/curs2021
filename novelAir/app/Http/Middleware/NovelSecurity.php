<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NovelSecurity
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
        $userNovels = Novel::where("user_id",Auth::user()->id)->where("id",$request->id)->get();
        if(count($userNovels) != 0){
            return $next($request);
        } else {
            return redirect('/dashboard');
        }
    }
}

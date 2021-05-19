<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User_Role;
use App\Models\Role;

class UserBlocked
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
        //$userNovels = Novel::where("user_id",Auth::user()->id)->where("id",$request->id)->get();
        $rolUser = User_Role::with('role')->where('user_id',Auth::user()->id)->first();
        if($rolUser->role->rol_name != 'bloqueado'){
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}

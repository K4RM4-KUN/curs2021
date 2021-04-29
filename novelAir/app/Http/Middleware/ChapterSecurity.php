<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterSecurity
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
        $chapter = Chapter::where("id",$request->id)->get();
        //dd($chapter);
        $userNovels = Novel::where("user_id",Auth::user()->id)->where("id",$chapter[0]->novel_id)->get();
        //dd($userNovels,Auth::user()->id);
        if(count($userNovels) != 0){
            //dd($userNovels,Auth::user()->id,"hello");
            return $next($request);
        } else {
            //return redirect('/dashboard');
        }
    }
}

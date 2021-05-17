<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\PaymentChapter;
use App\Models\Subscription;
use App\Models\Role;
use App\Models\User_Role;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;

class PublicChapterSecurity
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
        //id : id novela
        //id_chapter : num capitulo

        $chapters = Chapter:: where([
            ["novel_id", $request->id],
            ["public",1],
        ])->orderbydesc('chapter_n')->get();
        
        $payed = PaymentChapter::where([['novel_id',$request->id]])->first();

        $novel = Novel::where([['id',$request->id]])->first();
        
        if(Auth::check()){
            if(Auth::user()->id == $novel->user_id){
                return $next($request);
            } else if((Role::where('id',(User_Role::where('user_id',Auth::user()->id)->first())->role_id)->first())->rol_name == 'admin'){
                return $next($request);
            }
        }

        if(Chapter::where([['novel_id',$request->id],['chapter_n',$request->id_chapter],['public',1]])->exists()){
            if($payed->payment_chapters == 0){
                return $next($request);
            }elseif(!($payed->payment_chapters < 0) && $request->id_chapter < $chapters[$payed->payment_chapters-1]->chapter_n){
                return $next($request);
            }
            if(Auth::check() && Subscription::where([['user_id',$novel->user_id],['subscriber_id',Auth::user()->id]])->exists()){
                //dd('macaco');
                return $next($request);
            }
        }
        return back();
    }
}

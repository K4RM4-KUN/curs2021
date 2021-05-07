<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novel;
use App\Models\UNS;

class FeaturedSidebar extends Controller
{
    //

    public function index(){
        $general = 'content';
        $type = 1;
        if($general == 'content'){
            $result = Novel::where("visual_novel",$type)->withCount([ 'uns','uns as uns_count' => function ($query) {
                $query->where('updated_at',">",date("Y-m-d H:i:s", strtotime('monday this week')));
            }]);
        } else {

        }
        $data['featureds'] = $result->orderbydesc('created_at')->get();
        
        //dd($data['featureds'],date("Y-m-d H:i:s", strtotime('monday this week')));
        return view('feature.popularNovelsSidebar',$data);
    }
}

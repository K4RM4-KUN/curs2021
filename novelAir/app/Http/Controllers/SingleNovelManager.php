<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\Tag;
use App\Models\UNS;
use App\Models\States;
use App\Models\Tag_Novel;
use App\Models\Genre;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use File;

use Illuminate\Http\Request;

class SingleNovelManager extends Controller
{
    public function index(){
        //
        $data["genres"] = Genre::all();

        return view('createNovel',$data);
    }

    public function novelIndex($id){
        $data["novels"] = Novel:: where("id",$id)->get();
        $data["tags"] = DB::table("tags_novels")->join('tags',"tags_novels.tag_id","=","tags.id")->where("novel_id",$id)->get();
        $data["chapters"] = Chapter:: where("novel_id",$id)->orderby("chapter_n")->get();
        $data["genres"] = Genre::all();
        
        return view("viewNovel",$data);
    }

    public function chapterIndex($id,$chapter){
        $data["novels"] = Novel:: where("id",$id)->get();
        $data["chapter"] = Chapter::where("id",$chapter)->get();
        $files = File::files(public_path("/".$data["chapter"][0]->route));
        if(count($files) == 0){
            $data["preview"] = 'images/noimage.png';
        } else {
            $data["preview"] = $data["chapter"][0]->route."/".$files[0]->getFilename();
        }
        
        return view("viewChapter",$data);
    }

    public function chapterCreationIndex($id){
        $data["novels"] = Novel:: where("id",$id)->get();
        $data["chapters"] = Chapter::where("novel_id",$id)->orderbydesc("created_at")->get();

        return view("createChapter",$data);
    }

    public function viewChapterIndex($id,$chapter){   
        $data["novel"] = Novel:: where("id",$id)->get();
        $data["chapter"] = Chapter:: where([
            ["novel_id", $id],
            ["chapter_n", $chapter]
        ])->get();

        $data["chapters"] = Chapter:: where([
            ["novel_id", $id],
        ])->orderbydesc('chapter_n')->get();

        $data["content"] = File::files(public_path()."/".$data["chapter"][0]->route);
        
        return view('chapter',$data);
       
    }

    public function imageChapterIndex($id,$chapter){
        $data["novel"] = Novel:: where("id",$id)->get();

        $data["chapter"] = Chapter:: where([
            ["novel_id", $id],
            ["id", $chapter]
        ])->get();

        $data["content"] = File::files(public_path()."/".$data["chapter"][0]->route);

        return view('chapterImages',$data);
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            //'genre' => 'required|string|max:255',
            'sinopsis' => 'required|string|max:400',
            'cover' => 'required|mimes:jpeg,jpg,png|max:1024|dimensions:max_width=900,max_height=1350,min_width=300,min_height=450',
        ]);
            //dimensions:max_width=899,max_height=1349,min_width=299,min_height=449,ratio=9/16|max:1024

        $image = $request->file('cover');

        $novel = new Novel;
        $novel->setAttribute('user_id', Auth::user()->id);
        $novel->setAttribute('name', $request->name);
        $novel->setAttribute('genre', $request->genre);
        $novel->setAttribute('imgtype', ".".explode(".", $image->getClientOriginalName())[1]);
        $novel->setAttribute('sinopsis', $request->sinopsis);
        //$novel->setAttribute('novel_dir', public_path()."/users/".Auth::user()->id."/novels/".$novel->id);
        if (isset($request->adultContent)){
        	$novel->setAttribute('adult_content', 1);
        }else{
        	$novel->setAttribute('adult_content', 0);
        }
        
        if (isset($request->visualNovel)){
        	$novel->setAttribute('visual_novel', 1);
        	if (isset($request->typeOther)){
        		$novel->setAttribute('novel_type', $request->typeOther);
        	}else {
        		$novel->setAttribute('novel_type', $request->gender);
        	}
        }else{
        	$novel->setAttribute('visual_novel', 0);
            $novel->setAttribute('novel_type', 'novela');
        }
        
        if (isset($request->public)){
        	$novel->setAttribute('public', 1);
        }else{
        	$novel->setAttribute('public', 0);
        }
        //dd($novel);
        $novel->save();

        $novel = Novel::find($novel->id);
        $novel->novel_dir = "users/".Auth::user()->id."/novels/".$novel->id;
        $novel->save();

        if ($request->tags != null){
           $newTags = explode(",", $request->tags);
        
            foreach ($newTags as $newTag) {

                if (!($newTag == null || $newTag == " ")){
                    $newTag = strtoupper($newTag);

                    $compTag = Tag:: where("tag_name",$newTag)->get();
                    
                    if (count($compTag) == 0){
                        $createTag = New Tag;
                        $createTag->setAttribute('tag_name', $newTag);
                        $createTag->save();
                    }
                    $compTag = Tag:: where("tag_name",$newTag)->get();
                    
                    $tagNovel = New Tag_Novel;
                    $tagNovel->setAttribute('novel_id', $novel->id);
                    $tagNovel->setAttribute('tag_id', $compTag[0]->id);
                    $tagNovel->save();
                }
            } 
        }
        File::makeDirectory(public_path()."/".$novel->novel_dir , $mode = 0775, true);
        $image->move(public_path()."/".$novel->novel_dir,"cover.".explode(".", $image->getClientOriginalName())[1]);  

        return redirect('novel_manager');
    }

    public function createChapter(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'chapter_n' => 'required|string|max:255',
            'content' => 'required',
            'content.*' => 'mimes:jpeg,jpg,png|max:1024'
        ]);

        $chapter = new Chapter;
        if (!(Chapter::where('chapter_n', $request->chapter_n)->where('novel_id', $request->id))->exists()){
            $chapter->setAttribute('novel_id', $request->id);
            $chapter->setAttribute('title', $request->title);
            $chapter->setAttribute('chapter_n', $request->chapter_n);
            $chapter->setAttribute('route', $request->novel_dir."/".$request->chapter_n);
            if (isset($request->public)){
                $chapter->setAttribute('public', 1);
            }else{
                $chapter->setAttribute('public', 0);
            }
            $chapter->save();
        }else{
            $request->validate([
                'chapter_n' => 'unique:chapters'
            ]);
        }

        File::makeDirectory(public_path()."/".$chapter->route, $mode = 0775, true);
        $counter = 1;
        foreach($request->file('content') as $image){
            if($counter < 10){
                $image->move(public_path()."/".$chapter->route."/","00".$counter.".".explode(".", $image->getClientOriginalName())[1]);  
            } else if($counter < 100){
                $image->move(public_path()."/".$chapter->route."/","0".$counter.".".explode(".", $image->getClientOriginalName())[1]); 
            } else {
                $image->move(public_path()."/".$chapter->route."/",$counter.".".explode(".", $image->getClientOriginalName())[1]); 
            }
            $counter++;
        }

        return redirect('novel_manager/chapterImages/'.$request->id."/".$chapter->id);
    }

    public function addImages(Request $request){
        $request->validate([
            'content' => 'required',
            'content.*' => 'mimes:jpeg,jpg,png|max:1024'
        ]);
        $route = public_path("/".$request->route);
        $files = File::files($route);
        $counter = count($files)+1;
        foreach($request->file('content') as $image){
            if($counter < 10){
                $image->move(public_path()."/".$request->route."/","00".$counter.".".explode(".", $image->getClientOriginalName())[1]);   
            } else if($counter < 100){ 
                $image->move(public_path()."/".$request->route."/","0".$counter.".".explode(".", $image->getClientOriginalName())[1]); 
            } else {
                $image->move(public_path()."/".$request->route."/",$counter.".".explode(".", $image->getClientOriginalName())[1]); 
            }
            $counter++;
        }
        return redirect('novel_manager/chapterImages/'.$request->novel_id."/".$request->id);
    }

    public function delNovel($id){
        $novel = new Novel;
        $novel = Novel::find($id);

        File::deleteDirectory($novel->novel_dir);

        Novel::destroy($id);

        return redirect('novel_manager');
    }

    public function delChapter($id){
        $chapter = new Chapter;
        $chapter = Chapter::find($id);
        $novel = $chapter->novel_id;

        File::deleteDirectory($chapter->route);

        Chapter::destroy($id);
        return redirect('novel_manager/'.$novel);
        //File::deleteDirectory("users/9");
    }

    public function editChapter(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'chapter_n' => 'required',
        ]);

        if (!(Chapter::where('chapter_n', $request->chapter_n)->where('novel_id', $request->id_novel))->exists()){
            $chapter = Chapter::find($request->id);
            $chapter->title = $request->title;
            $chapter->chapter_n = $request->chapter_n;
            
            if (isset($request->public)){
                $chapter->public = 1;
            }else{
                $chapter->public = 0;
            }
            
            $chapter->save();
        }else{
            $request->validate([
                'chapter_n' => 'unique:chapters'
            ]);
        }

        return redirect('novel_manager/'.$request->novel_id."/".$request->id);
    }

    public function editNovel(Request $request){
        $request->validate([
            'name' => 'string|max:255',
            'sinopsis' => 'string|max:400',
            'cover' => 'mimes:jpeg,jpg,png|max:1024|dimensions:max_width=900,max_height=1350,min_width=300,min_height=450',
            //'tags' => 'regex:/([A-Za-z0-9 ,])/i',
        ]);

        $novel = Novel::find($request->id);
        $novel->name = $request->name;
        $novel->genre = $request->genre;
        $novel->sinopsis = $request->sinopsis;
        
        if (isset($request->adultContent)){
        	$novel->adult_content = 1;
        }else{
        	$novel->adult_content = 0;
        }
        
        if (isset($request->public)){
        	$novel->public = 1;
        }else{
        	$novel->public = 0;
        }
        if (isset($request->end)){
        	$novel->ended = 1;
        }else{
        	$novel->ended = 0;
        }
        
        $novel->save();
        
        if (isset($request->cover)){
            $image = $request->file('cover');
            $image->move(public_path()."/".$novel->novel_dir."/","cover.".explode(".", $image->getClientOriginalName())[1]); 
        }
        
        Tag_Novel:: where('novel_id',$request->id)->delete();

        if ($request->tags != null){
            $newTags = explode(",", $request->tags);
        
            foreach ($newTags as $newTag) {

                if (!($newTag == null || $newTag == " " || strlen($newTag)<4)){

                    $newTag = strtoupper($newTag);

                    $compTag = Tag:: where("tag_name",$newTag)->get();
                    
                    if (count($compTag) == 0){
                        $createTag = New Tag;
                        $createTag->setAttribute('tag_name', $newTag);
                        $createTag->save();
                    }
                    $compTag = Tag:: where("tag_name",$newTag)->get();
                    
                    $tagNovel = New Tag_Novel;
                    $tagNovel->setAttribute('novel_id', $novel->id);
                    $tagNovel->setAttribute('tag_id', $compTag[0]->id);
                    $tagNovel->save();
                }
            } 
        }

        return redirect('novel_manager/'.$request->id);
    }

    public function editChapterImages(Request $request){
        foreach(explode(",",$request->toEliminate) as $delete){
                if(File::exists(public_path("/".$request->route."/".$delete))){
                    File::delete(public_path("/".$request->route."/".$delete));
                }
            }
        $route = public_path("/".$request->route);
        $files = File::files($route);
        $update = explode(",",$request->toUpdateNum);
        for($i=0;$i<count($files);$i++){
            if($files[$i] != $update[$i]){
                if($i+1 < 10){
                    File::move($route."/".$update[$i],$route."/"."00".($i+1)."-".$update[$i]);
                } else if($i+1 < 100){
                    File::move($route."/".$update[$i],$route."/"."0".($i+1)."-".$update[$i]);
                } else {
                    File::move($route."/".$update[$i],$route."/".($i+1)."-".$update[$i]);
                }
            }
        }
        $files = File::files($route);
        for($i=0;$i<count($files);$i++){
            if($i+1 < 10){
                File::move($route."/".$files[$i]->getFilename(),$route."/"."00".($i+1).".".$files[$i]->getExtension());
            } else if($i+1 < 100){
                File::move($route."/".$files[$i]->getFilename(),$route."/"."0".($i+1).".".$files[$i]->getExtension());
            } else {
                File::move($route."/".$files[$i]->getFilename(),$route."/".($i+1).".".$files[$i]->getExtension());
            }
        }
        //Cache::flush();
    }

}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Novel;
use App\Models\Chapter;
use App\Models\Tag;
use App\Models\Tag_Novel;
use App\Http\Requests\ImageUploadRequest;
use Illuminate\Support\Facades\Cache;
use File;

use Illuminate\Http\Request;

class SingleNovelManager extends Controller
{
    public function index(){
        //
        return view('createNovel');
    }

    public function novelIndex($id){
        $data["novels"] = Novel:: where("id",$id)->get();
        $data["chapters"] = Chapter::where("novel_id",$id)->orderbydesc("chapter_n")->get();
        return view("viewNovel",$data);
    }

    public function chapterIndex($id,$chapter){
        $data["novels"] = Novel:: where("id",$id)->get();
        $data["chapter"] = Chapter:: where("id",$chapter)->get();
        
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
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'sinopsis' => 'required|string|max:400',
        ]);

        $novel = new Novel;
        $novel->setAttribute('user_id', Auth::user()->id);
        $novel->setAttribute('name', $request->name);
        $novel->setAttribute('genre', $request->genre);
        $novel->setAttribute('sinopsis', $request->sinopsis);
        //$novel->setAttribute('novel_dir', public_path()."/users/".Auth::user()->id."/novels/".$novel->id);
        if (isset($request->adultContent)){
        	$novel->setAttribute('adult_content', 1);
        }else{
        	$novel->setAttribute('adult_content', 0);
        }
        
        if (isset($request->gender)){
        	$novel->setAttribute('visual_novel', 1);
        	if (isset($request->typeOther)){
        		$novel->setAttribute('novel_type', $request->typeOther);
        	}else {
        		$novel->setAttribute('novel_type', $request->gender);
        	}
        }else{
        	$novel->setAttribute('visual_novel', 0);
        }
        
        if (isset($request->public)){
        	$novel->setAttribute('public', 1);
        }else{
        	$novel->setAttribute('public', 0);
        }
        $novel->save();

        $novel = Novel::find($novel->id);
        $novel->novel_dir = "users/".Auth::user()->id."/novels/".$novel->id;
        $novel->save();

        if ($request->tags == null){
           $newTags = explode(",", $request->tags);
        
            foreach ($newTags as $newTag) {
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

        
        
        File::makeDirectory(public_path()."/".$novel->novel_dir , $mode = 0775, true);

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

        File::makeDirectory(public_path()."/".$chapter->route, $mode = 0775, true);
        $counter = 1;
        foreach($request->file('content') as $image){
            $image->move(public_path()."/".$chapter->route."/",$counter.".".explode(".", $image->getClientOriginalName())[1]);  
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
            $image->move(public_path()."/".$request->route."/",$counter.".".explode(".", $image->getClientOriginalName())[1]);  
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

    //DANI ARREGLAR (NO BORRA NADA!)(ADEMAS POR LA CARA TE REDIRIGE A EL HOME DE NOVELMANAGER)
    //Supongo que aun no estaba acabado, pero tampoco parece que borre nada en BD, supongo que era lo ultimo que has hecho en clase xD
    public function delChapter($id){
        $chapter = new Chapter;
        //$chapter = Chapter::find($id);
        $novel = $chapter->novel_id;

        File::deleteDirectory($chapter->route);

        //Chapter::destroy($id);
        return redirect('novel_manager/'.$novel);
        //File::deleteDirectory("users/9");
    }

    public function editChapter(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'chapter_n' => 'required|integer',
        ]);

        $chapter = Chapter::find($request->id);
        $chapter->title = $request->title;
        $chapter->chapter_n = $request->chapter_n;
        
        if (isset($request->public)){
        	$chapter->public = 1;
        }else{
        	$chapter->public = 0;
        }
        
        $chapter->save();

        return redirect('novel_manager/'.$request->novel_id."/".$request->id);
    }

    public function editNovel(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'sinopsis' => 'required|string|max:400',
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
        
        $novel->save();

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
                File::move($route."/".$update[$i],$route."/".($i+1)."-".$update[$i]);
            }
        }
        $files = File::files($route);
        for($i=0;$i<count($files);$i++){
            File::move($route."/".$files[$i]->getFilename(),$route."/".$i.".".$files[$i]->getExtension());
        }
        Cache::flush();
    }

}

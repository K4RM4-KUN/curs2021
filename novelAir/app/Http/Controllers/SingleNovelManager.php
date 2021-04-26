<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Novel;
use App\Models\Chapter;
use File;

use Illuminate\Http\Request;

class SingleNovelManager extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('createNovel');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
        $novel->save();

        $insertedId = $novel->id;

        $novel = Novel::find($insertedId);
        $novel->novel_dir = public_path()."/users/".Auth::user()->id."/novels/".$insertedId;
        $novel->save();
        
        File::makeDirectory(public_path()."/users/".Auth::user()->id."/novels/".$insertedId , $mode = 0775, true);

        return redirect('novel_manager');
    }

    public function goCreateChapter($id){
        $data["novels"] = Novel:: where("id",$id)->get();
        return view("createChapter",$data);
    }

    public function createChapter(Request $request){
        /* $request->validate([
            'title' => 'required|string|max:255',
            'chapter_n' => 'required|string|max:255',
            'sinopsis' => 'required|string|max:400',
        ]); */

        $chapter = new Chapter;
        $chapter->setAttribute('novel_id', $request->id);
        $chapter->setAttribute('title', $request->title);
        $chapter->setAttribute('chapter_n', $request->chapter_n);
        $chapter->setAttribute('route', $request->novel_dir."/".$request->chapter_n);
        $chapter->setAttribute('public', 1);
        $chapter->save();

        File::makeDirectory($chapter->route, $mode = 0775, true);

        return redirect('novel_manager/'.$request->id);
    }

    public function GoNovel($id){
        $data["novels"] = Novel:: where("id",$id)->get();
        $data["chapters"] = Chapter::where("novel_id",$id)->orderbydesc("created_at")->get();
        return view("viewNovel",$data);
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
        $novel->save();

        return redirect('novel_manager/'.$request->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

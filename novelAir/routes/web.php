<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleNovelManager;
use App\Http\Controllers\Library;
use App\Http\Controllers\FeaturedSidebar;
use App\Http\Controllers\NovelManager;
use App\Http\Controllers\NovelMain;
use App\Http\Controllers\Lista;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Test
Route::get('text2/{id_novel}/{id_chapter}',[NovelMain::class, 'test2']);
Route::get('test/{list?}',[Lista::class,'test'])->name('list')->middleware(['auth']);

//Featured
Route::get('featured',[FeaturedSidebar::class,'index']);

//Library
Route::get('biblioteca/{type?}',[Library::class,'index'])->name('goLibrary');
Route::post('biblioteca/resultado',[Library::class,'resultSercher'])->name('goLibraryResult');
//Test
Route::get('biblioteca/test2/{type?}',[Library::class,'indextest2'])->name('goLibrarytest2');
Route::post('biblioteca/test2/resultado',[Library::class,'resultSerchertest2'])->name('goLibraryResulttest2');

//List
Route::get('listas/{list?}',[Lista::class,'index'])->name('list')->middleware(['auth']);

//NovelMain
Route::get('novel/{id?}/{order?}',[NovelMain::class, 'index'])->name("viewNovel");
Route::get('deleteMark/{id?}',[NovelMain::class, 'deleteMark']);
Route::get('lista/{type}/{novel_id}', [NovelMain::class, 'novelInteraction'])->name("interactNovel")->middleware(['auth']);
Route::get('vote/{id}/{vote}', [NovelMain::class, 'voteNovel'])->name("voteNovel")->middleware(['auth']);
Route::get('leer/{id_novel}/{id_chapter}', [NovelMain::class, 'readIndex']);

//NovelManager
Route::get('novel_manager', [NovelManager::class, 'index'])->name("goNM")->middleware(['auth']);
Route::get('novel_manager/create', [SingleNovelManager::class, 'index'])->name("createNovel")->middleware(['auth']);
Route::post('novel_manager/adding', [SingleNovelManager::class, 'createChapter'])->name("createChapters")->middleware(['auth']);
Route::post('novel_manager/addingImages', [SingleNovelManager::class, 'addImages'])->name("addImages")->middleware(['auth']);
Route::post('novel_manager/created', [SingleNovelManager::class, 'create'])->name("insertNovel")->middleware(['auth']);
Route::post('novel_manager/edit', [SingleNovelManager::class, 'editNovel'])->name("editNovel")->middleware(['auth']);
Route::post('novel_manager/editChapter', [SingleNovelManager::class, 'editChapter'])->name("editChapter")->middleware(['auth']);
Route::get('novel_manager/{id?}', [SingleNovelManager::class, 'novelIndex'])->middleware(['auth','novelsecurity']);
Route::get('novel_manager/{id?}/add_chapter', [SingleNovelManager::class, 'chapterCreationIndex'])->middleware(['auth','novelsecurity']);
Route::get('novel_manager/delNovel/{id?}', [SingleNovelManager::class, 'delNovel'])->middleware(['auth','novelsecurity']);
Route::get('novel_manager/delChapter/{id?}', [SingleNovelManager::class, 'delChapter'])->middleware(['auth','chaptersecurity']);
Route::get('novel_manager/viewChapter/{id?}/{id_chapter}', [SingleNovelManager::class, 'viewChapterIndex'])->middleware(['auth']);
Route::get('novel_manager/chapterImages/{id?}/{id_chapter}', [SingleNovelManager::class, 'imageChapterIndex'])->name('goIM')->middleware(['auth','novelsecurity']);
Route::post('novel_manager/editImages', [SingleNovelManager::class,'editChapterImages'])->middleware(["auth"]);
Route::get('novel_manager/{id}/{chapter}', [SingleNovelManager::class, 'chapterIndex'])->name("goVC")->middleware(['auth','novelsecurity']);


//Route::view("test","layouts.navigationNew");
require __DIR__.'/auth.php';

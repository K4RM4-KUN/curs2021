<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleNovelManager;
use App\Http\Controllers\NovelManager;


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

require __DIR__.'/auth.php';

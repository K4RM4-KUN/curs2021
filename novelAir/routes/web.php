<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleNovelManager;
use App\Http\Controllers\Library;
use App\Http\Controllers\FeaturedSidebar;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\NovelManager;
use App\Http\Controllers\NovelMain;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Lista;
use App\Http\Controllers\AdminController;

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
Route::get('test',[FeaturedSidebar::class,'authorIndex'])->middleware(['auth']);
Route::post('verificar',[MailController::class,'verificationRequest'])->name('verificationRequest')->middleware(['auth']);

//Admin
Route::get('admin',[AdminController::class,'adminIndex'])->name('goAdmin')->middleware(['auth']);

//User
Route::get('perfil/{id}/{username?}',[UserProfile::class,'profileIndex'])->middleware(['auth']);
Route::get('usuario/ajustes/{config?}',[UserProfile::class,'settingsIndex'])->middleware(['auth']);
Route::post('editarUsuario',[UserProfile::class,'userUpdate'])->name('updateUser')->middleware(['auth']);
Route::post('cambiarPass',[UserProfile::class,'changePassword'])->name('changePass')->middleware(['auth']);
Route::post('authorConfig',[UserProfile::class,'authorConfig'])->name('configAuthor')->middleware(['auth']);
Route::post('editarPerfil',[UserProfile::class,'profileUpdate'])->name('updateProfile')->middleware(['auth']);
Route::get('seguir/{id?}',[UserProfile::class,'followUser'])->middleware(['auth']);
Route::get('usuarios',[UserProfile::class,'allUsers'])->name('authors')->middleware(['auth']);
Route::post('usuarios/busqueda',[UserProfile::class,'allUsersSearch'])->name('authorsSearch')->middleware(['auth']);

//Featured
Route::get('featured',[FeaturedSidebar::class,'index']);

//Library
Route::get('biblioteca/{type?}',[Library::class,'index'])->name('goLibrary');
Route::post('biblioteca/resultado',[Library::class,'resultSercher'])->name('goLibraryResult');

//List
Route::get('listas/{list?}/{filter?}',[Lista::class,'index'])->name('list')->middleware(['auth']);

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

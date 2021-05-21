<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleNovelManager;
use App\Http\Controllers\Library;
use App\Http\Controllers\FeaturedSidebar;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\NovelManager;
use App\Http\Controllers\NovelMain;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Lista;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

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

Route::get('/',[HomeController::class,'index']);

Route::get('/dashboard', function () {
    //return view('dashboard');
    return redirect('/');
})->name('dashboard');

//Test ->middleware(['auth'])

//About us
Route::get('nosotros/{type?}/{end?}',[AboutController::class,'indexHome'])->name('aboutUs');
Route::get('nosotros/{type?}',[AboutController::class,'indexHome'])->name('aboutUs');
Route::get('terminos/{type?}',[AboutController::class,'index'])->name('aboutTerms');
Route::post('contactar/{from?}',[MailController::class,'contactRequest'])->name('contact');

//Subscribe
Route::get('subscribe/{id?}',[PaymentController::class,'payWithPayPal'])->name('goPay')->middleware(['auth','subscribesecurity']);
Route::get('payment/status/{id?}',[PaymentController::class,'payPalStatus'])->middleware(['auth','subscribesecurity']);
Route::get('results/{id?}/{transaction?}',[PaymentController::class,'paymentResult'])->middleware(['auth']);

//Admin
Route::get('admin',[AdminController::class,'adminIndex'])->name('goAdmin')->middleware(['auth','adminsecurity']);
Route::get('admin/user/{id?}',[AdminController::class,'adminUser'])->middleware(['auth','adminsecurity']);
Route::get('admin/novel/{id?}',[AdminController::class,'adminNovel'])->middleware(['auth','adminsecurity']);
Route::post('admin/search',[AdminController::class,'adminSearch'])->name('adminSearch')->middleware(['auth','adminsecurity']);
Route::post('admin/edit/user',[AdminController::class,'adminEditUser'])->name('adminEditUser')->middleware(['auth','adminsecurity']);
Route::get('admin/blockUser/{id?}',[AdminController::class,'adminBlockUser'])->middleware(['auth','adminsecurity']);
Route::get('admin/removeUser/{id?}',[AdminController::class,'adminRemoveUser'])->middleware(['auth','adminsecurity']);
Route::get('admin/blockNovel/{id?}',[AdminController::class,'adminBlockNovel'])->middleware(['auth','adminsecurity']);
Route::get('admin/removeNovel/{id?}',[AdminController::class,'adminRemoveNovel'])->middleware(['auth','adminsecurity']);
Route::post('admin/addImg',[AdminController::class,'adminAddImg'])->middleware(['auth','adminsecurity']);
Route::get('admin/rmImf/{name?}',[AdminController::class,'adminRmImg'])->middleware(['auth','adminsecurity']);

//User
Route::get('perfil/{id}/{username?}',[UserProfile::class,'profileIndex']);
Route::get('usuario/ajustes/{config?}',[UserProfile::class,'settingsIndex'])->middleware(['auth']);
Route::post('editarUsuario',[UserProfile::class,'userUpdate'])->name('updateUser')->middleware(['auth']);
Route::post('cambiarPass',[UserProfile::class,'changePassword'])->name('changePass')->middleware(['auth']);
Route::post('authorConfig',[UserProfile::class,'authorConfig'])->name('configAuthor')->middleware(['auth']);
Route::post('editarPerfil',[UserProfile::class,'profileUpdate'])->name('updateProfile')->middleware(['auth']);
Route::get('seguir/{id?}',[UserProfile::class,'followUser'])->middleware(['auth']);
Route::get('usuarios',[UserProfile::class,'allUsers'])->name('authors');
Route::post('usuarios/busqueda',[UserProfile::class,'allUsersSearch'])->name('authorsSearch');
Route::post('verificar',[MailController::class,'verificationRequest'])->name('verificationRequest')->middleware(['auth']);

//Featured
Route::get('featured',[FeaturedSidebar::class,'index']);

//Library
Route::post('biblioteca/resultado',[Library::class,'resultSercher'])->name('goLibraryResult');
Route::get('biblioteca/{type?}',[Library::class,'index'])->name('goLibrary');

//List
Route::get('listas/{list?}/{filter?}',[Lista::class,'index'])->name('list')->middleware(['auth']);

//NovelMain
Route::get('novel/{id?}/{order?}',[NovelMain::class, 'index'])->name("viewNovel")->middleware(['publicnovelsecurity']);
Route::get('deleteMark/{id?}',[NovelMain::class, 'deleteLastView'])->middleware(['auth','publicnovelsecurity']);
Route::get('lista/{type}/{id}', [NovelMain::class, 'novelInteraction'])->name("interactNovel")->middleware(['auth','publicnovelsecurity']);
Route::get('vote/{id}/{vote}', [NovelMain::class, 'voteNovel'])->name("voteNovel")->middleware(['auth','publicnovelsecurity']);
Route::get('leer/{id}/{id_chapter}', [NovelMain::class, 'readIndex'])->middleware(['publicnovelsecurity','publicchaptersecurity']);

//NovelManager
Route::get('novel_manager', [NovelManager::class, 'index'])->name("goNM")->middleware(['auth','userblocked']);
Route::get('novel_manager/create', [SingleNovelManager::class, 'index'])->name("createNovel")->middleware(['auth','userblocked']);
Route::post('novel_manager/adding', [SingleNovelManager::class, 'createChapter'])->name("createChapters")->middleware(['auth','userblocked']);
Route::post('novel_manager/addingImages', [SingleNovelManager::class, 'addImages'])->name("addImages")->middleware(['auth','userblocked']);
Route::post('novel_manager/created', [SingleNovelManager::class, 'create'])->name("insertNovel")->middleware(['auth','userblocked']);
Route::post('novel_manager/edit', [SingleNovelManager::class, 'editNovel'])->name("editNovel")->middleware(['auth','userblocked']);
Route::post('novel_manager/editChapter', [SingleNovelManager::class, 'editChapter'])->name("editChapter")->middleware(['auth','userblocked']);
Route::get('novel_manager/{id?}', [SingleNovelManager::class, 'novelIndex'])->middleware(['auth','novelsecurity','userblocked']);
Route::get('novel_manager/{id?}/add_chapter', [SingleNovelManager::class, 'chapterCreationIndex'])->middleware(['auth','novelsecurity','userblocked']);
Route::get('novel_manager/delNovel/{id?}', [SingleNovelManager::class, 'delNovel'])->middleware(['auth','novelsecurity','userblocked']);
Route::get('novel_manager/delChapter/{id?}', [SingleNovelManager::class, 'delChapter'])->middleware(['auth','chaptersecurity','userblocked']);
Route::get('novel_manager/viewChapter/{id?}/{id_chapter}', [SingleNovelManager::class, 'viewChapterIndex'])->middleware(['auth','novelsecurity','userblocked']);
Route::get('novel_manager/chapterImages/{id?}/{id_chapter}', [SingleNovelManager::class, 'imageChapterIndex'])->name('goIM')->middleware(['auth','novelsecurity','userblocked']);
Route::post('novel_manager/editImages', [SingleNovelManager::class,'editChapterImages'])->middleware(["auth",'userblocked']);
Route::get('novel_manager/{id}/{chapter}', [SingleNovelManager::class, 'chapterIndex'])->name("goVC")->middleware(['auth','novelsecurity','userblocked']);


//Route::view("test","layouts.navigationNew");
require __DIR__.'/auth.php';

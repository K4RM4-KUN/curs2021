<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/facebook', [HomeController::class, "index"])->middleware(['auth'])->name('face');
Route::get('/channelChange/{to}', [HomeController::class, "ChannelIndex"])->middleware(['auth'])->name('changeChannel');
Route::post('/facebook', [HomeController::class, "send"])->middleware(['auth'])->name('sendPost');
Route::post('/like', [HomeController::class, "like"])->middleware(['auth'])->name('likePost');
Route::post('/comment', [HomeController::class, "comment"])->middleware(['auth'])->name('commentPost');
Route::post('/notification', [HomeController::class, "notify"])->middleware(['auth'])->name('notify');
Route::post('/notifyUser', [HomeController::class, "notifyTo"])->middleware(['auth'])->name('notifyTo');
Route::get('/logout', function () {
    Auth::logout();
    return view('welcome');
});


require __DIR__.'/auth.php';

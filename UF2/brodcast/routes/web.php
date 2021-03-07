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

Route::get('/facebook', [HomeController::class, "index"])->middleware(['auth'])->name('dashboard');
Route::get('/channelChange/{to}', [HomeController::class, "ChannelIndex"])->middleware(['auth'])->name('changeChannel');
Route::post('/facebook', [HomeController::class, "send"])->middleware(['auth'])->name('sendPost');



require __DIR__.'/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\formController;

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

Route::get('/form',[formController::class, 'goForm'] )->middleware('auth')->name('goForm');
Route::post('/result',[formController::class, 'goResult'] )->middleware('auth')->name('goResult');

require __DIR__.'/auth.php';

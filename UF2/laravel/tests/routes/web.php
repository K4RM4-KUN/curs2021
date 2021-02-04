<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\mainController;

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

Route::get('table', [mainController::class, 'index'])->name('goCars');
Route::post('table', [mainController::class, 'store'])->name('AddCar');
Route::patch('table/', [mainController::class, 'update'])->name('UpdateCar');
Route::delete('table', [mainController::class, 'destroy'])->name('DeleteCar');

require __DIR__.'/auth.php';

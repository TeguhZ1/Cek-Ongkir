<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['is_login'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/store', [HomeController::class, 'store'])->name('store');
    Route::get('/api/province/{id}/cities',[HomeController::class, 'getCities']);
    Route::post('/api/cities',[HomeController::class, 'searchCities']);
    Route::get('/api/cities/{province_id}', [HomeController::class, 'getCities']);
    Route::get('/api/provinces', [HomeController::class, 'getProvinces']);
});
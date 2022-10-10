<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController as movieCon;
use App\Http\Controllers\HomeController as homeCon;
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



Auth::routes();

Route::get('/', [homeCon::class, 'homeList'])->name('home')->middleware('gate:home');
Route::put('/rate/{movie}', [homeCon::class, 'rate'])->name('rate')->middleware('gate:user');
Route::post('/comment/{movie}', [homeCon::class, 'addComment'])->name('comment')->middleware('gate:user');


Route::prefix('movie')->name('m_')->group(function () {
    Route::get('/', [movieCon::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [movieCon::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [movieCon::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{movie}', [movieCon::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{movie}', [movieCon::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{movie}', [movieCon::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{movie}', [movieCon::class, 'update'])->name('update')->middleware('gate:admin');
});

Route::prefix('comment')->name('c_')->group(function () {
    Route::get('/', [movieCon::class, 'index'])->name('index')->middleware('gate:user');
    Route::delete('/delete/{comment}', [movieCon::class, 'create'])->name('delete')->middleware('gate:admin');
    // Route::post('/create', [movieCon::class, 'store'])->name('store')->middleware('gate:admin');
    // Route::get('/show/{movie}', [movieCon::class, 'show'])->name('show')->middleware('gate:user');
    // Route::delete('/delete/{movie}', [movieCon::class, 'destroy'])->name('delete')->middleware('gate:admin');
    // Route::get('/edit/{movie}', [movieCon::class, 'edit'])->name('edit')->middleware('gate:admin');
    // Route::put('/edit/{movie}', [movieCon::class, 'update'])->name('update')->middleware('gate:admin');
});
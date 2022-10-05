<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController as catCon;
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

Route::prefix('category')->name('c_')->group(function () {
    Route::get('/', [catCon::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [catCon::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [catCon::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{category}', [catCon::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{category}', [catCon::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{category}', [catCon::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{category}', [catCon::class, 'update'])->name('update')->middleware('gate:admin');
    Route::delete('/delete-movies/{category}', [catCon::class, 'destroyAll'])->name('delete_movies')->middleware('gate:admin');
});

Route::prefix('movie')->name('m_')->group(function () {
    Route::get('/', [movieCon::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [movieCon::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [movieCon::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{movie}', [movieCon::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{movie}', [movieCon::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{movie}', [movieCon::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{movie}', [movieCon::class, 'update'])->name('update')->middleware('gate:admin');
});

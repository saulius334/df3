<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController as catCon;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('category')->name('c_')->group(function () {
    Route::get('/', [catCon::class, 'index'])->name('index');
    Route::get('/create', [catCon::class, 'create'])->name('create');
    Route::post('/create', [catCon::class, 'store'])->name('store');
    Route::get('/show/{category}', [catCon::class, 'show'])->name('show');
    Route::delete('/delete/{category}', [catCon::class, 'destroy'])->name('delete');
    Route::get('/edit/{category}', [catCon::class, 'edit'])->name('edit');
    Route::put('/edit/{category}', [catCon::class, 'update'])->name('update');
});

<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/', [BerandaController::class, 'utama']);

Route::middleware(['auth'])->group(function () {
    // Route Kategori
    Route::resource('category', CategoryController::class);
    Route::get('category/{category}', [CategoryController::class, 'destroy']);
    
    // Route Book
    Route::resource('book', BookController::class);
    Route::get('book/{book}', [BookController::class, 'destroy']);
    Route::get('tampil/{id}', [BookController::class, 'hide']);
    
});

Route::middleware(['auth', 'Admin'])->group(function () {
    // Route User
    Route::resource('user', UserController::class);
    Route::get('user/{user}', [UserController::class, 'destroy']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BookController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');



Route::middleware('auth:sanctum')->group(function() {
    
    Route::get('/test', [TestController::class, 'index'])->name('test');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/book', [BookController::class, 'index'])->name('book');
    // Route::get('/book', [BookController::class, 'create'])->name('book');

    Route::resource('books', BookController::class);
});




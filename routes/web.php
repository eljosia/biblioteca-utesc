<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::middleware([
    'auth'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');

    // Libros
    Route::get('/libros', [BooksController::class, 'index'])->name('book.index');
    Route::get('/libro/editar/{id?}', [BooksController::class, 'edit'])->name('book.edit');
});



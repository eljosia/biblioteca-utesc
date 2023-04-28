<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
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
    Route::get('/libro/nuevo', [BooksController::class, 'new'])->name('book.new');
    Route::get('/libro/editar/{id?}', [BooksController::class, 'edit'])->name('book.edit');

    // Prestamos
    Route::get('/prestamos', [LoanController::class, 'index'])->name('loan.index');
    Route::get('/prestamos/nuevo', [LoanController::class, 'new'])->name('loan.new');
    Route::get('/prestamo/{code?}', [LoanController::class, 'show'])->name('loan.show');
});

<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReportController;
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


Route::get('/', [GuestController::class, 'index'])->name('guest.index');

Route::middleware(['auth', 'verified'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');

    // Libros
    Route::get('/libros', [BooksController::class, 'index'])->name('book.index');
    Route::get('/libro/nuevo', [BooksController::class, 'new'])->name('book.new');
    Route::get('/libro/editar/{id?}', [BooksController::class, 'edit'])->name('book.edit');

    // Prestamos
    Route::get('/prestamos', [LoanController::class, 'index'])->name('loan.index');
    Route::get('/prestamos/nuevo', [LoanController::class, 'new'])->name('loan.new');
    Route::get('/prestamos/editar/{code?}', [LoanController::class, 'edit'])->name('loan.edit');
    Route::get('/prestamo/{code?}', [LoanController::class, 'show'])->name('loan.show');
    Route::get('/prestamo/print/{code?}', [LoanController::class, 'print'])->name('loan.print');
    Route::get('/prestamo/print/voucher/{code?}', [LoanController::class, 'delivery_voucher'])->name('loan.print_delivery_voucher');

    // Reportes
    Route::get('/reportes', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/generate', [ReportController::class, 'generater'])->name('report.generate');

    // Personas
    Route::get('/personas', [PeopleController::class, 'index'])->name('people.index');
    Route::get('/personas/nuevo', [PeopleController::class, 'new'])->name('people.new');
    Route::get('/persona/editar/{identifier?}', [PeopleController::class, 'edit'])->name('people.edit');

    // Configuracion
    Route::get('/configuracion', [ConfigController::class, 'index'])->name('config.index');
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// LIBROS
Route::get('/libros', [BooksController::class, 'list'])->name('book.list');

Route::group(['middleware' => 'apikey'], function () {
    // LIBROS
    Route::get('/libros/titulos', [BooksController::class, 'title_list'])->name('book.title_list');
    Route::post('/libro/guardar', [BooksController::class, 'save'])->name('book.save');
    Route::delete('/libro/borrar/{id?}', [BooksController::class, 'delete'])->name('book.delete');
    Route::get('/libros/guardar_cover', [BooksController::class, 'save_cover'])->name('book.save_cover');

    // PRESTAMOS
    Route::get('/prestamos', [LoanController::class, 'list'])->name('loan.list');
    Route::post('/prestamos/guardar', [LoanController::class, 'save'])->name('loan.save');
    Route::post('/prestamo/entregar', [LoanController::class, 'deliver'])->name('loan.deliver');
    Route::get('/prestamo/buscar-persona', [LoanController::class, 'searchPeople'])->name('loan.search-people');

    // DASHBOARD CHARTS
    Route::get('/chart/get-quantity-books', [ChartController::class, 'getQuantityBooks'])->name('chart.getQuantityBooks');
    Route::get('/chart/get-daily-search-quantity', [ChartController::class, 'getDailySearchQuantity'])->name('chart.getDailySearchQuantity');
    Route::get('/chart/get-loans-to-be-delivery', [ChartController::class, 'getLoansToBeDelivery'])->name('chart.getLoansToBeDelivery');

    // REPORTES
    Route::get('/report/generate', [ReportController::class, 'generate'])->name('report.generate');


    //PERSONAS
    Route::get('/personas', [PeopleController::class, 'list'])->name('people.list');
    Route::post('/persona/guardar', [PeopleController::class, 'save'])->name('people.save');
});

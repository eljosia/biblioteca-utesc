<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoanController;
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

Route::get('/libros', [BooksController::class,'list'])->name('book.list');
Route::get('/libros/titulos', [BooksController::class,'title_list'])->name('book.title_list');
Route::post('/libro/guardar', [BooksController::class,'save'])->name('book.save');
Route::delete('/libro/borrar/{id?}', [BooksController::class,'delete'])->name('book.delete');

Route::post('/prestamos/guardar', [LoanController::class,'save'])->name('loan.save');


Route::get('/prestamo/buscar-persona', [LoanController::class, 'searchPeople'])->name('loan.search-people');
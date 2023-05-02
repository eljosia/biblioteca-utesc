<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getQuantityBooks()
    {
        $chart = Book::join('careers', 'careers.id', 'books.area')
        ->selectRaw('COUNT(books.area) as quantity, careers.name as career')
        ->groupBy('books.area')
        ->get();

        return response()->json($chart);
    }
}

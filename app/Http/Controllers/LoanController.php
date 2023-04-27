<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {

        return view('pages.loans.index');
    }

    public function new()
    {
        $data = (object)[];
        $data->career = Book::select('area')->groupBy('area')->get();
        return view('pages.loans.new', compact('data'));
    }
}

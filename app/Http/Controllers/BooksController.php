<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        return view('pages.books.index');
    }

    public function load(Request $r)
    {
        if($r->search):

        else:
            $book = Book::join('classification as cl', 'cl.id','books.classification_id')->get();
        endif;

        return $book;
        
    }
}

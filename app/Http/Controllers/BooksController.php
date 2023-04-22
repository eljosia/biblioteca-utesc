<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function index()
    {
        $data = (object)[];
        $data->loadbook = route('book.list');

        return view('pages.books.index', compact('data'));
    }

    public function list(Request $r)
    {
        $user_id    = $r->header('bearer');
        $search     = $r->input('search');
        $title      = $r->input('titulo');
        $folio      = $r->input('folio');
        $isbn       = $r->input('isbn');
        $autor      = $r->input('autor');
        $area       = $r->input('area');
        $country    = $r->input('pais');
        $shelf      = $r->input('estante');
        $theme      = $r->input('clasificacion');

        $data = (object)[];
        $data->books = Book::select([
            'title', 'folio', 'isbn', 'autor', 'editorial', 'area', 'quantity', 'edition', 'country', 'pages', 'shelf', 'theme',
            DB::raw("CONCAT('https://covers.openlibrary.org/b/isbn/', REPLACE(isbn, '-', ''), '-L.jpg') AS cover_img")
        ])->join('classifications as cl', 'cl.id', 'books.classification_id');

        if (User::find(is_numeric(jdecrypt($user_id)))):
            $edit_url   = DB::raw('CONCAT("' . route('book.edit') . '/", books.id) AS edit_url');
            $delete_url = DB::raw('CONCAT("' . route('book.delete') . '/", books.id) AS delete_url');
            $data->books->addSelect($edit_url, $delete_url);
        endif;

        $conditions = [
            ['title', 'like', $search],
            ['autor', 'like', $search],
            ['editorial', 'like', $search],
            ['title', 'like', $title],
            ['folio', 'like', $folio],
            ['isbn', 'like', str_replace('-', '', $isbn)],
            ['autor', 'like', $autor],
            ['area', 'like', $area],
            ['country', 'like', $country],
            ['shelf', 'like', $shelf],
            ['theme', 'like', $theme],
        ];

        foreach ($conditions as $condition) {
            if ($condition[0] == 'isbn' && !empty($condition[2])) {
                $data->books->whereRaw("REPLACE(isbn, '-', '') LIKE '%" .  str_replace("-", "", $isbn) . "%'");
            } elseif (!empty($condition[2])) {
                $data->books->orWhere($condition[0], 'like', '%' . $condition[2] . '%');
            }
        }

        return response()->json(array('books' => $data->books->get(), 'count' => $data->books->count()));
    }
}

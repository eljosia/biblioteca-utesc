<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Classification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function index()
    {
        $data = (object)[];
        $data->loadbook = route('book.list');
        $data->areas    = Book::select('area')->groupBy('area')->get();

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
        $dates      = $r->input('fechas');

        $data = (object)[];
        $data->books = Book::select([
            'title', 'folio', 'isbn', 'autor', 'editorial', 'area', 'quantity', 'edition', 'country', 'pages', 'shelf', 'theme',
            'date_of_acq as acquisition', DB::raw("CONCAT('https://covers.openlibrary.org/b/isbn/', REPLACE(isbn, '-', ''), '-L.jpg') AS cover_img")
        ])->join('classifications as cl', 'cl.id', 'books.classification_id');

        if (User::find(is_numeric(jdecrypt($user_id)))) :
            $edit_url   = DB::raw('CONCAT("' . route('book.edit') . '/", books.id) AS edit_url');
            $delete_url = DB::raw('CONCAT("' . route('book.delete') . '/", books.id) AS delete_url');
            $data->books->addSelect($edit_url, $delete_url);
        endif;

        $conditions = [
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
                $data->books->where($condition[0], 'like', '%' . $condition[2] . '%');
            }
        }
        if ($search) :
            $data->books->Where('title', 'like', '%' . $search . '%')
                ->orWhere('autor', 'like', '%' . $search . '%')
                ->orWhere('editorial', 'like', '%' . $search . '%');
        endif;

        if ($dates) :
            $date        = explode(' - ', $dates);
            $first_date     = Carbon::createFromFormat('d/m/Y', $date[0]);
            $second_date    = Carbon::createFromFormat('d/m/Y', $date[1]);

            $data->books->whereBetween('date_of_acq', [$first_date, $second_date]);
        endif;

        return response()->json(array('books' => $data->books->get(), 'count' => $data->books->count(), 'sql' => toSqlQuery($data->books)));
    }

    public function new()
    {
        $data = (object)[];
        $data->classifications = Classification::all();

        return view('pages.books.new', compact('data'));
    }
}

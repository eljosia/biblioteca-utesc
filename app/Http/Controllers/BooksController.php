<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Careers;
use App\Models\Classification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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
        $key        = ($r->header('bearer')) ? $r->header('bearer') : $r->key;
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
            'title', 'folio', 'isbn', 'autor', 'editorial', 'careers.name as area', 'quantity', 'edition', 'country', 'pages', 'shelf', 'theme',
            'date_of_acq as acquisition',  'cover_books.cover_url as cover_img',
            DB::raw("CASE WHEN loans.id IS NULL OR loans.delivery_date IS NOT NULL THEN 'Disponible' ELSE 'Ocupado' END AS status")
        ])
            ->join('classifications as cl', 'cl.id', 'books.classification_id')
            ->join('careers', 'careers.id', 'books.area')
            ->join('cover_books', 'cover_books.book_id', 'books.id')
            ->leftJoin('loans', 'loans.book_id', '=', 'books.id');

        if (env('ENCRYPT_PASS') == base64_decode($key)) :
            $edit_url   = DB::raw('CONCAT("' . route('book.edit') . '/", books.id) AS edit_url');
            $delete_url = DB::raw('CONCAT("' . route('book.delete') . '/", books.id) AS delete_url');
            $data->books->addSelect('books.id as id', $edit_url, $delete_url);
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
                ->orWhere('editorial', 'like', '%' . $search . '%')
                ->orWhere('isbn', 'like', '%' . $search . '%');
        endif;

        if ($dates) :
            $date        = explode(' - ', $dates);
            $first_date     = Carbon::createFromFormat('d/m/Y', $date[0]);
            $second_date    = Carbon::createFromFormat('d/m/Y', $date[1]);

            $data->books->whereBetween('date_of_acq', [$first_date, $second_date]);
        endif;

        if ($r->public_search):
            saveLog('Book', 'search', $search, $r->all(), $r->ip(), 1);
        endif;

        $data->date = Carbon::now()->format('Y-m-d');
        return response()->json(array('books' => $data->books->get(), 'count' => $data->books->count(), 'sql' => toSqlQuery($data->books)));
    }

    public function new()
    {
        $data = (object)[];
        $data->classifications  = Classification::all();
        $data->area             = Careers::all();

        return view('pages.books.new', compact('data'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $areas = Careers::all();

        return view('pages.books.edit', compact('book', 'areas'));
    }

    public function save(Request $r)
    {
        $validate = Validator::make($r->all(), [
            'title'         => 'required|string|max:250',
            'date_of_acq'   => 'required|date',
        ]);

        if ($validate->fails()) {
            return response()->json(array(
                'success' => false,
                'msg'     => 'Ops...',
                'errors'  => $validate->getMessageBag()->toArray()
            ));
        }

        $book_id = $r->book_id;
        if (!$book_id) :
            $book                       = new Book();
            $action                     = "new";
            $msg                        = "Se agregó el libro: " . $r->title;
            $book->created_by           = $r->by_user_id;
        else :
            $book                       = Book::findOrFail($book_id);
            $action                     = "reload";
            $msg                        = "Se ha editado el libro: " . $book->title;
            $book->updated_by           = $r->by_user_id;

        endif;

        try {
            $book->folio                = $r->folio;
            $book->isbn                 = $r->isbn;
            $book->title                = $r->title;
            $book->autor                = $r->autor;
            $book->description          = $r->description;
            $book->editorial            = $r->editorial;
            $book->area                 = $r->area;
            $book->quantity             = $r->quantity;
            $book->edition              = $r->edition;
            $book->country              = $r->country;
            $book->date_of_pub          = Carbon::createFromDate($r->date_of_pub);
            $book->pages                = $r->pages;
            $book->shelf                = $r->shelf;
            $book->status               = 0;
            $book->classification_id    = $r->classification;
            $book->donated              = ($r->donated) ? $r->donated : false;
            $book->date_of_acq          = Carbon::createFromFormat('Y-m-d H:i:s', $r->date_of_acq . ' 00:00:00');
            $book->save();

            DB::table('cover_books')->insert([
                "cover_url" => $r->cover_url,
                "book_id" => $book->id
            ]);

            saveLog('Book', 'save', $msg, $r->all(), $r->ip(), $r->by_user_id, $book->id);
            return response()->json(array('success' => true, 'msg' => $msg, 'action' => $action));
        } catch (Exception $e) {
            saveLog('Book', 'save', $e->getMessage(), $r->all(), $r->ip(), $r->by_user_id);
            return response()->json(array('success' => false, 'msg' => 'Se ha producido un error al guardar el libro'));
        }
    }

    public function delete(Request $r)
    {
        $book_id = $r->id;
        $book = Book::findOrFail($book_id);
        $book->delete();
        $msg = "Se ha borrado el libro correctamente.";

        saveLog('Book', 'delete', $msg, $r->all(), $r->ip(), $r->by_user_id, $book_id);
        return response()->json(array('success' => true, 'msg' => $msg, 'table_id' => 'books-table'));
    }

    public function title_list(Request $r)
    {
        $book = Book::select('title')->where('title', 'like', '%' . $r->title)->get();
        return $book;
    }

    public function save_cover()
    {
        $book = Book::select(['books.id as id', 'isbn'])->where('books.id', '>', 4370)->get();
        foreach ($book as $b) {
            $url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $b->isbn;
            $cover = 'https://covers.openlibrary.org/b/isbn/' . $b->isbn . '-L.jpg';

            DB::table('cover_books')->insert([
                "cover_url" => $this->searchCover($url, $cover),
                "book_id" => $b->id
            ]);
        }
        // return $book;
    }

    public function searchCover($url, $cover)
    {
        try {
            $client = new Client();
            $response = $client->request('GET', $url);
            $results = json_decode($response->getBody());

            if ($results->totalItems == 1) {
                $book = $results->items[0];
                $thumbnail = null;

                if (isset($book->volumeInfo->imageLinks)) {
                    $thumbnail = $book->volumeInfo->imageLinks->thumbnail;
                } else {
                    $size = getimagesize($cover);

                    if ($size[0] === 1 && $size[1] === 1) {
                        $thumbnail = null;
                    } else {
                        $thumbnail = $cover;
                    }
                }

                // MOSTRAMOS
                return $thumbnail;
            } else {
                echo 'No se pudo cargar la imagen';
            }
        } catch (GuzzleException $error) {
            echo $error->getMessage();
        }
    }
}

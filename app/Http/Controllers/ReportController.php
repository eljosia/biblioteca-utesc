<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Careers;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.reports.index');
    }

    public function generate(Request $r)
    {
        $data = (object)[];
        $data->title = "Reporte General";
        $data->thead = ["Folio", "Titulo", "Area", "Autor", "Estante"];

        $data->books = Book::select([
            'title', 'folio', 'isbn', 'autor', 'editorial', 'careers.name as area', 'quantity', 'edition', 'country', 'pages', 'shelf', 'theme',
            'date_of_acq as acquisition', DB::raw("CONCAT('https://covers.openlibrary.org/b/isbn/', REPLACE(isbn, '-', ''), '-L.jpg') AS cover_img"),
            DB::raw("CASE WHEN loans.id IS NULL OR loans.delivery_date IS NOT NULL THEN 'Disponible' ELSE 'Ocupado' END AS status")
        ])
            ->join('classifications as cl', 'cl.id', 'books.classification_id')
            ->join('careers', 'careers.id', 'books.area')
            ->leftJoin('loans', 'loans.book_id', '=', 'books.id');

        if ($r->type == "area") :
            if ($r->area_id) :
                $data->books->where('books.area', $r->area_id);
                $data->title = "Reporte de Libros por Area: " . Careers::find($r->area_id)->name;
                $data->thead = ["Folio", "Titulo", "Autor", "Estante"];
            else :
                $data->books->orderBy('careers.name', 'asc');
                $data->title = "Reporte por areas";
            endif;
        endif;

        if ($r->fechas) :
            $date           = explode(' - ', $r->fechas);
            $first_date     = Carbon::createFromFormat('d/m/Y', $date[0]);
            $second_date    = Carbon::createFromFormat('d/m/Y', $date[1]);

            $data->books->whereBetween('date_of_acq', [$first_date, $second_date]);
        endif;

        $data->careers = Book::select('careers.name as area', DB::raw("COUNT(careers.name) as total"))
            ->join('careers', 'careers.id', 'books.area')
            ->groupBy('careers.name')->get();

        $data->date = Carbon::now()->format('Y-m-d');

        return response()->json(array(
            'books'         => $data->books->get(),
            'count'         => $data->books->count(),
            'date'          => $data->date,
            'type'          => $r->type,
            'title'         => $data->title,
            'thead'         => $data->thead,
            'allcareers'    => $data->careers,
        ));
    }
}

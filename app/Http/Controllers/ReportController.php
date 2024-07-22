<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Careers;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class ReportController extends Controller
{

    public function index()
    {
        $data = (object)[];
        $data->page_title = "Dashboard";
        $data->breadcrumb = [
            ['link' => route('dashboard.index'), 'text' => 'Dashboard'],
            ['link' => route('report.index'), 'text' => 'Reportes'],
            ['text' => 'Generar']
        ];
        $data->buttons = [
            // ['modal' => 'kt_modal_create_app', 'class' => 'btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary', 'text' => 'Rollover'],
            // ['link' => '#link', 'class' => 'btn btn-sm fw-bold btn-primary', 'text' => 'Boton', 'icon' => 'la-pen']
        ];

        return view('pages.dashboards.reports.index', compact('data'));
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

        // Convert stdClass to array
        $dataArray = json_decode(json_encode($data), true);

        // Load the view with the converted array
        $pdf = Pdf::loadView('pages.dashboards.reports._pdf', $dataArray);

        return $pdf->download();
        // return response()->json(array(
        //     'books'         => $data->books->get(),
        //     'count'         => $data->books->count(),
        //     'date'          => $data->date,
        //     'type'          => $r->type,
        //     'title'         => $data->title,
        //     'thead'         => $data->thead,
        //     'allcareers'    => $data->careers,
        // ));
    }

    public function generater(Request $r)
    {
        // dd($r->all());
        set_time_limit(0);
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', 0);
        ini_set("pcre.backtrack_limit", "5000000");

        $data = (object)[];
        $data->title = "Reporte General";
        $data->thead = ["Folio", "Titulo", "Area", "Autor", "Estante"];
        $data->type = "general";

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
                $data->type = "area";
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
        $data->books = $data->books->get();

        $html = view('pages.dashboards.reports._pdf', compact('data'))->render();
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);

        $mpdf->WriteHTML($html);
        return $mpdf->Output();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Careers;
use App\Models\Loan;
use App\Models\People;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        $data = (object)[];
        $data->page_title = "Lista de Prestamos";
        $data->breadcrumb = [
            ['link' => route('dashboard.index'), 'text' => 'Dashboard'],
            ['link' => route('loan.index'), 'text' => 'Prestamos'],
            ['text' => 'Listado']
        ];

        $data->buttons = [
            ['link' => route('loan.new'), 'class' => 'btn btn-sm fw-bold btn-primary', 'text' => 'Nuevo', 'icon' => 'la-plus']
        ];


        $data->table = (object)[];
        $data->table->list      = route('loan.list');
        $data->table->js        = 'loan-table';

        // $data->modals = [
        //     ['include' => 'pages.dashboards.products.modals._m_change-price']
        // ];

        return view('pages.dashboards.datatable', compact('data'));
    }

    public function list()
    {
        $show_url       = route('loan.show') . '/';
        $edit_url       = route('loan.edit') . '/';
        $print_url      = route('loan.print') . '/';
        $deliver_url    = route('loan.deliver');

        $data = (object)[];
        $raw_show       = DB::raw('CONCAT("' . $show_url . '", loans.code) AS show_url');
        $raw_edit       = DB::raw('CONCAT("' . $edit_url . '", loans.code) AS edit_url');
        $raw_deliver    = DB::raw('CONCAT("' . $deliver_url . '") AS deliver_url');
        $raw_print      = DB::raw('CONCAT("' . $print_url . '", loans.code) AS print_url');
        $raw_fullname   = DB::raw('CONCAT(peoples.name, " ", peoples.last_name) AS full_name');

        $data->loans = Loan::select(
            [
                'code',
                'loan_date',
                'return_date',
                'peoples.identifier as identifier',
                'books.title as title',
                'books.folio as folio',
                'users.name as created_by',
                'loans.created_at as created_at',
                'loans.delivery_date',
                $raw_fullname, $raw_print, $raw_show, $raw_edit, $raw_deliver
            ]
        )
            ->join('peoples', 'peoples.id', 'loans.people_id')
            ->join('books', 'books.id', 'loans.book_id')
            ->join('users', 'users.id', 'loans.created_by');

        return response()->json(array('data' => $data->loans->get(), 'count' => $data->loans->count(), 'sql' => toSqlQuery($data->loans)));
    }

    public function new()
    {
        $data = (object)[];
        $data->page_title = "Nuevo Prestamo";
        $data->breadcrumb = [
            ['link' => route('dashboard.index'), 'text' => 'Dashboard'],
            ['link' => route('loan.index'), 'text' => 'Prestamos'],
            ['text' => 'Nuevo']
        ];

        $data->buttons = [
            
        ];
        $data->career = Careers::all();

        return view('pages.dashboards.loans.form', compact('data'));
    }

    public function edit($code)
    {
        $data = (object)[];
        $data->career = Careers::all();
        $data->loan = Loan::where('code', $code)->firstOrFail();
        $data->page_title = "Editar Prestamo";
        $data->breadcrumb = [
            ['link' => route('dashboard.index'), 'text' => 'Dashboard'],
            ['link' => route('loan.index'), 'text' => 'Prestamo'],
            ['text' => $data->loan->code]
        ];

        $data->buttons = [
            
        ];

        return view('pages.dashboards.loans.form', compact('data'));
    }

    public function save(Request $r)
    {
        $validate = Validator::make($r->all(), [
            'name'              => 'required',
            'last_name'         => 'required',
            'phone'             => 'nullable|numeric',
            'identifier'        => 'required|numeric',
            'return_date'       => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(array(
                'success' => false,
                'msg'     => 'Ops...',
                'errors'  => $validate->getMessageBag()->toArray()
            ));
        }

        if (!$r->loan_id) {
            $loan               = new Loan();
            $loan->code         = $this->genCode();
            $loan->created_by   = base64_decode($r->by_user_id);
            $msg                = "Se ha guardado el prestamo";
            $event              = "Save";
        } else {
            $loan               = Loan::findOrFail($r->loan_id);
            $loan->updated_by   = base64_decode($r->by_user_id);
            $msg                = "Se ha editado el prestamo: " . $loan->code;
            $event              = "Update";
        }

        $people = People::where('identifier', $r->identifier);
        if ($people->count() > 0) {
            $people = $people->first();
            $people->updated_by = base64_decode($r->by_user_id);
        } else {
            $people = new People();
            $people->created_by = base64_decode($r->by_user_id);
        }

        try {
            $people->name               = $r->name;
            $people->last_name          = $r->last_name;
            $people->phone              = $r->phone;
            $people->identifier         = $r->identifier;
            $people->career_id          = $r->career_id;
            $people->save();

            $loan->loan_date            = $r->loan_date;
            $loan->return_date          = $r->return_date;
            $loan->people_id            = $people->id;
            $loan->book_id              = $r->book_id;
            $loan->save();

            saveLog('Loan', $event, $msg, $r->all(), $r->ip(), base64_decode($r->by_user_id), $loan->id);
            return response()->json(array('success' => true, 'msg' => $msg, 'action' => route('loan.show', ['code' => $loan->code])));
        } catch (Exception $e) {
            saveLog('Loan', $event, $e->getMessage(), $r->all(), $r->ip(), base64_decode($r->by_user_id));
            return response()->json(array('success' => false, 'msg' => 'Se ha producido un error al guardar el nuevo prestamo.'));
        }
    }

    public function genCode()
    {
        $ultimo_codigo = Loan::orderBy('id', 'desc')->pluck('code')->first();

        if (!$ultimo_codigo) {
            $nuevo_codigo = 1;
        } else {
            $nuevo_codigo = intval(substr($ultimo_codigo, 3)) + 1;
        }

        return sprintf("PRE%05d", $nuevo_codigo);
    }

    public function show($code)
    {
        $loan = Loan::where('code', $code)->firstOrFail();
        $data = (object)[];
        $data->page_title = "<div>Prestamo de Libro #" . $loan->code . '<span
                                class="badge ' . $loan->status()->class . ' text-white ms-2">' . $loan->status()->msg . '</span></div>';
        $data->breadcrumb = [
            ['link' => route('dashboard.index'), 'text' => 'Dashboard'],
            ['link' => route('loan.index'), 'text' => 'Prestamos'],
            ['text' => $loan->code]
        ];

        $print_route = !$loan->delivery_date ? route('loan.print', ['code' => $loan->code]) : route('loan.print_delivery_voucher', ['code' => $loan->code]);
        $data->buttons = [
            ['link' => route('loan.new'), 'class' => 'btn btn-sm fw-bold btn-primary', 'text' => 'Nuevo', 'icon' => 'la-plus'],
            ['link' => $print_route, 'class' => 'btn btn-sm fw-bold btn-secondary', 'text' => 'Imprimir', 'icon' => 'la-print', 'target' => "_blank"],
        ];

        $data->loan = $loan;
        $data->people = $loan->people;
        $data->book = $loan->book;

        // $data->modals = [
        //     ['include' => 'pages.dashboards.products.modals._m_change-price']
        // ];

        return view('pages.dashboards.loans.show', compact('data'));


        return view('pages.loans.show', compact('data'));
    }

    public function print($code)
    {
        $loan = Loan::where('code', $code)->first();
        if (!$loan)
            abort(404);

        $data = (object)[];
        $data->loan = $loan;
        $data->people = $loan->people;
        $data->book = $loan->book;

        $data->copies = 1;

        return FacadePdf::loadView('pages.dashboards.loans.print', compact('data'))->stream();
        // return view('pages.loans.print', compact('data'));
    }

    public function searchPeople(Request $r)
    {
        $people = People::where('identifier', $r->identifier)->first();

        return response()->json(array('data' => $people));
    }

    public function deliver(Request $r)
    {
        $loan = Loan::where('code', $r->code)->first();
        $book = Book::where('folio', $r->folio)->first();
        if ($loan->book_id !== $book->id) :
            saveLog('Loan', 'Update', "No se encontró el codigo o folio", $r->all(), $r->ip(), base64_decode($r->by_user_id));
            abort(404);
        endif;
        try {
            $loan->delivery_date = Carbon::now()->format('Y-m-d H:i:s');
            $loan->save();
            $msg = "Se ha confirmado la entrega del libro con folio:" . $loan->book->folio;

            saveLog('Loan', 'Update', $msg, $r->all(), $r->ip(), base64_decode($r->by_user_id), $loan->id);
            return response()->json(array('success' => true, 'msg' => $msg, 'action' => route('loan.show', ['code' => $loan->code])));
        } catch (Exception $e) {
            saveLog('Loan', 'Update', $e->getMessage(), $r->all(), $r->ip(), base64_decode($r->by_user_id), $loan->id);
            return response()->json(array('success' => false, 'msg' => "Hubo un error al confirmar la entrega"));
        }
    }

    public function delivery_voucher($code)
    {
        $loan = Loan::where('code', $code)->whereNotNull('delivery_date')->first();
        if (!$loan)
            abort(404);

        $data = (object)[];
        $data->loan = $loan;
        $data->people = $loan->people;
        $data->book = $loan->book;

        $data->copies = 1;

        return FacadePdf::loadView('pages.dashboards.loans.print_delivery_voucher', compact('data'))->stream();
        // return view('pages.dashboards.loans.print_delivery_voucher', compact('data'));
    }
}

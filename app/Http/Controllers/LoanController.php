<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\People;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
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
        $data->loadloans = route('loan.list');
        return view('pages.loans.index', compact('data'));
    }

    public function list()
    {
        $show_url   = route('loan.show') . '/';
        $print_url  = route('loan.print') . '/';

        $data = (object)[];
        $raw_show       = DB::raw('CONCAT("' . $show_url . '", loans.code) AS show_url');
        $raw_print      = DB::raw('CONCAT("' . $print_url . '", loans.code) AS print_url');
        $raw_fullname   = DB::raw('CONCAT(peoples.name, " ", peoples.last_name) AS full_name');

        $data->loans = Loan::select(['code', 'loan_date', 'return_date', 'peoples.identifier as identifier', 'books.title as title', 'users.name as created_by', $raw_fullname, $raw_print, $raw_show])
        ->join('peoples', 'peoples.id', 'loans.people_id')
        ->join('books', 'books.id', 'loans.book_id')
        ->join('users', 'users.id', 'loans.created_by');

        return response()->json(array('loans' => $data->loans->get(), 'count' => $data->loans->count(), 'sql' => toSqlQuery($data->loans)));

    }

    public function new()
    {
        $data = (object)[];
        $data->career = Book::select('area')->groupBy('area')->get();
        return view('pages.loans.new', compact('data'));
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
            $loan->created_by   = $r->by_user_id;
            $loan->status       = true;
            $msg                = "Se ha guardado el prestamo";
            $event              = "Save";
        } else {
            $loan               = Loan::findOrFail($r->loan_id);
            $loan->updated_by   = $r->by_user_id;
            $msg                = "Se ha editado el prestamo: " . $loan->code;
            $event              = "Update";
        }

        $people = People::where('identifier', $r->identifier);
        if ($people->count() > 0) {
            $people = $people->first();
        } else {
            $people = new People();
        }

        try {
            $people->name               = $r->name;
            $people->last_name          = $r->last_name;
            $people->phone              = $r->phone;
            $people->identifier         = $r->identifier;
            $people->career             = $r->career;
            $people->save();

            $loan->loan_date            = $r->loan_date;
            $loan->return_date          = $r->return_date;
            $loan->people_id            = $people->id;
            $loan->book_id              = $r->book_id;
            $loan->save();

            saveLog('Loan', $event, $msg, $r->all(), $r->ip(), $r->by_user_id, $loan->id);
            return response()->json(array('success' => true, 'msg' => $msg, 'action' => route('loan.show', ['code' => $loan->code])));
        } catch (Exception $e) {
            saveLog('Loan', $event, $e->getMessage(), $r->all(), $r->ip(), $r->by_user_id);
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
        $loan = Loan::where('code', $code)->first();
        if (!$loan)
            abort(404);

        $data = (object)[];
        $data->loan = $loan;
        $data->people = $loan->people;
        $data->book = $loan->book;

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

        return FacadePdf::loadView('pages.loans.print', compact('data'))->stream();
        // return view('pages.loans.print', compact('data'));
    }

    public function searchPeople(Request $r)
    {
        $people = People::where('identifier', $r->identifier)->first();

        return response()->json(array('data' => $people));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\People;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function save(Request $r)
    {
        $validate = Validator::make($r->all(), [
            'name'              => 'required',
            'last_name'         => 'required',
            'phone'             => 'nullable|numeric',
            'tuition'           => 'nullable|numeric',
            'employee_number'   => 'nullable|integer',
        ]);

        if ($validate->fails()) {
            return response()->json(array(
                'success' => false,
                'msg'     => 'Ops...',
                'errors'  => $validate->getMessageBag()->toArray()
            ));
        }

        if (!$r->loan_id) {
            $people             = new People();
            $loan               = new Loan();
            $loan->code         = $this->genCode();
            $loan->created_by   = $r->by_user_id;
            $msg                = "Se ha guardado el prestamo";
            $event              = "Save";
        } else {
            $people             = People::findOrFail($r->people_id);
            $loan               = Loan::findOrFail($r->loan_id);
            $loan->updated_by   = $r->by_user_id;
            $msg                = "Se ha editado el prestamo: " . $loan->code;
            $event              = "Update";
        }

        try {
            $people->name               = $r->name;
            $people->last_name          = $r->last_name;
            $people->phone              = $r->phone;
            $people->tuition            = $r->tuition;
            $people->employee_number    = $r->employee_number;
            $people->grade              = $r->grade;
            $people->group              = $r->group;
            $people->career             = $r->career;
            $people->save();

            $loan->loan_date            = $r->loan_date;
            $loan->return_date          = $r->return_date;
            $loan->people_id            = $people->id;
            $loan->book_id              = $r->book_id;
            $loan->save();

            saveLog('Loan', $event, $msg, $r->all(), $r->ip(), $r->by_user_id, $loan->id);
            return response()->json(array('success' => true, 'msg' => $msg, 'action' => ''));
        } catch (Exception $e) {
            saveLog('Loan', $event, $e->getMessage(), $r->all(), $r->ip(), $r->by_user_id);
            return response()->json(array('success' => false, 'msg' => 'Se ha producido un error al guardar el nuevo prestamo.'));
        }
    }

    public function genCode()
    {
        // Recuperar el último código generado de la base de datos
        $lastCode = Loan::orderBy('code', 'desc')->first();

        if ($lastCode) {
            // Incrementar el valor numérico del último código en 1
            $numbers = substr($lastCode->code, 1);
            $newNumber = intval($numbers) + 1;
        } else {
            // Si no hay ningún código generado, crear uno nuevo
            $newNumber = 1;
        }

        // Combinar la base "A" con el nuevo valor numérico y completar los ceros faltantes
        $newCode = "A" . str_pad($newNumber, 5, "0", STR_PAD_LEFT);

        // Insertar el nuevo código generado en la base de datos
        return $newCode;
    }

    public function show($code) {
        $loan = Loan::where('code', $code)->first();
        if (!$loan)
            abort(404);

        $data = (object)[];
        $data->loan = $loan;
        $data->people = $loan->people;
        $data->book = $loan->book;

        return view('pages.loans.show', compact('data'));
    }
}

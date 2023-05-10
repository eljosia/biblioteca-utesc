<?php

namespace App\Http\Controllers;

use App\Models\Careers;
use App\Models\Loan;
use App\Models\People;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeopleController extends Controller
{
    public function index()
    {
        $data = (object)[];
        $data->loadpeoples = route('people.list');
        return view('pages.peoples.index', compact('data'));
    }
    public function new()
    {
        $data = (object)[];
        $data->career = Careers::all();
        return view('pages.peoples.new', compact('data'));
    }
    public function edit($identifier)
    {
        $data = (object)[];
        $data->people = People::where('identifier', $identifier)->first();

        if (!$data->people)
            return abort(404);

        $data->career = Careers::all();
        return view('pages.peoples.edit', compact('data'));
    }
    public function save(Request $r)
    {
        $validate = Validator::make($r->all(), [
            'name'              => 'required',
            'last_name'         => 'required',
            'phone'             => 'nullable|numeric',
            'identifier'        => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response()->json(array(
                'success' => false,
                'msg'     => 'Ops...',
                'errors'  => $validate->getMessageBag()->toArray()
            ));
        }

        if (!$r->people_id) {
            if (People::where('identifier', $r->identifier)->count() == 1)
                return response()->json(array('success' => false, 'msg' => 'El identificador ya se encuentra registrado.', 'errors' => []));

            $people = new People();
            $msg = "Se ha guardado una nueva persona.";
            $event = "Save";
            $people->created_by = $r->by_user_id;
        } else {
            $people = People::findOrFail($r->people_id);
            $msg = "Se ha editado correctamente: "  . $people->name;
            $event = "Update";
            $people->updated_by = $r->by_user_id;
        }

        try {
            $people->name               = $r->name;
            $people->last_name          = $r->last_name;
            $people->phone              = $r->phone;
            $people->identifier         = $r->identifier;
            $people->career_id          = $r->career_id;
            $people->save();

            saveLog('People', $event, $msg, $r->all(), $r->ip(), $r->by_user_id, $people->id);
            return response()->json(array('success' => true, 'msg' => $msg, 'action' => route('people.index')));
        } catch (Exception $e) {
            saveLog('People', $event, $e->getMessage(), $r->all(), $r->ip(), $r->by_user_id);
            return response()->json(array('success' => false, 'msg' => 'Se ha producido un error al guardar la persona.'));
        }
    }

    public function list(Request $r)
    {
        $loan = [];
        $edit_url = route('people.edit') . '/';
        $raw_edit = DB::raw('CONCAT("' . $edit_url . '", peoples.identifier) AS edit_url');

        if ($r->search) :
            $people = People::select(['careers.name as career', 'peoples.*', $raw_edit])->where('identifier', $r->identifier)
                ->join('careers', 'careers.id', 'peoples.career_id')
                ->first();

            $show_url   = route('loan.show') . '/';
            $raw_show   = DB::raw('CONCAT("' . $show_url . '", loans.code) AS show_url');

            $loan = Loan::select(['books.folio', 'books.title', 'loans.*', $raw_show])->where('people_id', $people->id)
                ->join('books', 'books.id', 'loans.book_id')
                ->orderBy('loans.created_at', 'desc')->get();
        else :
            $people = People::select(['careers.name as career', 'peoples.*', $raw_edit])
                ->join('careers', 'careers.id', 'peoples.career_id')
                ->get();
        endif;

        if (!$people)
            return abort(404);


        return response()->json(array('people' => $people, 'loans' => $loan));
    }
}

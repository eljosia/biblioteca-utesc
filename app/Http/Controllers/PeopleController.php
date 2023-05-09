<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function list(Request $r)
    {
        if ($r->search) :
            $people = People::select(['careers.name as career', 'peoples.*'])->where('identifier', $r->identifier)
                ->join('careers', 'careers.id', 'peoples.career_id')
                ->first();
        endif;
        if (!$people)
            return abort(404);

        $show_url   = route('loan.show') . '/';
        $raw_show   = DB::raw('CONCAT("' . $show_url . '", loans.code) AS show_url');

        $loan = Loan::select(['books.folio', 'books.title', 'loans.*', $raw_show])->where('people_id', $people->id)
            ->join('books', 'books.id', 'loans.book_id')
            ->orderBy('loans.created_at','desc');
        return response()->json(array('people' => $people, 'loans' => $loan->get()));
    }
}

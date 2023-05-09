<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getQuantityBooks()
    {
        $chart = Book::join('careers', 'careers.id', 'books.area')
            ->selectRaw('COUNT(books.area) as quantity, careers.name as career')
            ->groupBy('books.area')
            ->get();

        return response()->json($chart);
    }

    public function getDailySearchQuantity()
    {
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->push(now()->subDays($i)->format('Y-m-d'));
        }
        $chart = DB::table(DB::raw("(
            SELECT '{$dates[0]}' AS date
            UNION SELECT '{$dates[1]}' AS date
            UNION SELECT '{$dates[2]}' AS date
            UNION SELECT '{$dates[3]}' AS date
            UNION SELECT '{$dates[4]}' AS date
            UNION SELECT '{$dates[5]}' AS date
            UNION SELECT '{$dates[6]}' AS date
        ) AS dates"))
            ->leftJoin('activity_logs', function ($join) {
                $join->on(DB::raw('DATE(activity_logs.created_at)'), '=', 'dates.date')
                    ->where('activity_logs.event', '=', 'search');
            })
            ->select(DB::raw('DATE(dates.date) AS date'), DB::raw('COUNT(activity_logs.id) AS count'))
            ->groupBy(DB::raw('DATE(dates.date)'))
            ->orderBy('date', 'ASC')
            ->get();

        return response()->json($chart);
    }

    public function getLoansToBeDelivery()
    {
        $loans = Loan::selectRaw('code, return_date, peoples.name, peoples.last_name, peoples.identifier, DATEDIFF(NOW(), return_date) AS days_since_return')
            ->join('peoples', 'peoples.id', 'loans.people_id')
            ->whereNull('loans.delivery_date')
            ->whereDate('loans.return_date', '<=', now())
            ->get();

        return response()->json($loans);
    }
}

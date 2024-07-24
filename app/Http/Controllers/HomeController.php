<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Careers;
use App\Models\Loan;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = (object)[];
        $data->page_title = "Dashboard";
        $data->breadcrumb = [
            ['link' => route('dashboard.index'), 'text' => 'Dashboard'],
            ['text' => 'Inicio']
        ];
        $data->buttons = [
            // ['modal' => 'kt_modal_create_app', 'class' => 'btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary', 'text' => 'Rollover'],
            // ['link' => '#link', 'class' => 'btn btn-sm fw-bold btn-primary', 'text' => 'Boton', 'icon' => 'la-pen']
        ];

        // CHARTS
        $data->books      = $this->compareMonthlyBooks();
        $data->total_search     = $this->getSearchCount();
        $data->loans            = $this->compareMonthlyLoans();
        $data->expired_loans    = $this->compareMonthlyExpiredLoans();
        $data->people           = $this->compareMonthlyPeople();

        $data->careers          = $this->showBooksByCareer();
        $data->shelfs           = $this->getBooksByShelf();
        $data->typebook         = $this->typeBook();

        return view('pages.dashboards.index', compact('data'));
    }
    public function getSearchCount()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $totalSearchThisWeek = ActivityLog::where('event', 'search')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $totalSearchLastWeek = ActivityLog::where('event', 'search')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();

        $percentageChange = $totalSearchThisWeek - $totalSearchLastWeek;
        $percentageChange = $percentageChange / $totalSearchLastWeek;
        $percentageChange = $percentageChange * 100;
        $percentageChange = number_format($percentageChange, 2);
        // Preparar los datos para la vista o respuesta
        $data = [
            'this_week' => $totalSearchThisWeek,
            'last_week' => $totalSearchLastWeek,
            'percentage_change' => $percentageChange
        ];

        // Devuelve o usa $data según sea necesario
        return $data;
    }

    public function compareMonthlyLoans()
    {
        // Obtener el total de todos los libros prestados
        $totalLoans = Loan::count();

        // Obtener el rango de fechas para el mes actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Obtener el total de préstamos del mes actual
        $totalLoansThisMonth = Loan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Obtener el rango de fechas para el mes pasado
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Obtener el total de préstamos del mes pasado
        $totalLoansLastMonth = Loan::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Calcular la diferencia y el porcentaje de cambio mensual
        $difference = $totalLoansThisMonth - $totalLoansLastMonth;
        if ($totalLoansLastMonth == 0) {
            if ($totalLoansThisMonth == 0) {
                // Si ambos meses no tuvieron registros, no hay cambio
                $percentageChange = 0;
            } else {
                // Si el mes pasado no hubo registros pero este mes sí, el cambio es del 100%
                $percentageChange = 100;
            }
        } else {
            // Calcular el porcentaje de cambio
            $percentageChange = ($difference / $totalLoansLastMonth) * 100;
        }

        // Formatear el porcentaje de cambio a 2 decimales
        $percentageChange = number_format($percentageChange, 2);

        // Preparar los datos para la vista o respuesta
        $data = [
            'total' => $totalLoans,
            'this_month' => $totalLoansThisMonth,
            'last_month' => $totalLoansLastMonth,
            'difference' => $difference,
            'percentage_change' => $percentageChange
        ];

        // Retornar la vista o respuesta con los datos
        return $data;
    }

    public function compareMonthlyExpiredLoans()
    {
        // Obtener el total de todos los préstamos expirados
        $totalExpiredLoans = Loan::where('return_date', '<', now())
            ->whereNull('delivery_date')
            ->count();

        // Obtener el rango de fechas para el mes actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Obtener el total de préstamos expirados del mes actual
        $totalExpiredLoansThisMonth = Loan::where('return_date', '<', now())
            ->whereNull('delivery_date')
            ->whereBetween('return_date', [$startOfMonth, $endOfMonth])
            ->count();

        // Obtener el rango de fechas para el mes pasado
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Obtener el total de préstamos expirados del mes pasado
        $totalExpiredLoansLastMonth = Loan::where('return_date', '<', now())
            ->whereNull('delivery_date')
            ->whereBetween('return_date', [$startOfLastMonth, $endOfLastMonth])
            ->count();

        // Calcular la diferencia y el porcentaje de cambio mensual
        $difference = $totalExpiredLoansThisMonth - $totalExpiredLoansLastMonth;
        if ($totalExpiredLoansLastMonth == 0) {
            if ($totalExpiredLoansThisMonth == 0) {
                // Si ambos meses no tuvieron registros, no hay cambio
                $percentageChange = 0;
            } else {
                // Si el mes pasado no hubo registros pero este mes sí, el cambio es del 100%
                $percentageChange = 100;
            }
        } else {
            // Calcular el porcentaje de cambio
            $percentageChange = ($difference / $totalExpiredLoansLastMonth) * 100;
        }

        // Formatear el porcentaje de cambio a 2 decimales
        $percentageChange = number_format($percentageChange, 2);

        // Preparar los datos para la vista o respuesta
        $data = [
            'total' => $totalExpiredLoans,
            'this_month' => $totalExpiredLoansThisMonth,
            'last_month' => $totalExpiredLoansLastMonth,
            'difference' => $difference,
            'percentage_change' => $percentageChange
        ];

        // Retornar la vista o respuesta con los datos
        return $data;
    }

    public function compareMonthlyPeople()
    {
        // Obtener el total de todas las personas agregadas
        $totalPeople = People::count();

        // Obtener el rango de fechas para el mes actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Obtener el total de personas agregadas del mes actual
        $totalPeopleThisMonth = People::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Obtener el rango de fechas para el mes pasado
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Obtener el total de personas agregadas del mes pasado
        $totalPeopleLastMonth = People::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Calcular la diferencia y el porcentaje de cambio mensual
        $difference = $totalPeopleThisMonth - $totalPeopleLastMonth;
        if ($totalPeopleLastMonth == 0) {
            if ($totalPeopleThisMonth == 0) {
                // Si ambos meses no tuvieron registros, no hay cambio
                $percentageChange = 0;
            } else {
                // Si el mes pasado no hubo registros pero este mes sí, el cambio es del 100%
                $percentageChange = 100;
            }
        } else {
            // Calcular el porcentaje de cambio
            $percentageChange = ($difference / $totalPeopleLastMonth) * 100;
        }

        // Formatear el porcentaje de cambio a 2 decimales
        $percentageChange = number_format($percentageChange, 2);

        // Preparar los datos para la vista o respuesta
        $data = [
            'total' => $totalPeople,
            'this_month' => $totalPeopleThisMonth,
            'last_month' => $totalPeopleLastMonth,
            'difference' => $difference,
            'percentage_change' => $percentageChange
        ];

        // Retornar la vista o respuesta con los datos
        return $data;
    }

    public function compareMonthlyBooks()
    {
        // Obtener el total de todos los libros agregados
        $totalBooks = Book::count();

        // Obtener el rango de fechas para el mes actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Obtener el total de libros agregados del mes actual
        $totalBooksThisMonth = Book::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Obtener el rango de fechas para el mes pasado
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Obtener el total de libros agregados del mes pasado
        $totalBooksLastMonth = Book::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Calcular la diferencia y el porcentaje de cambio mensual
        $difference = $totalBooksThisMonth - $totalBooksLastMonth;
        if ($totalBooksLastMonth == 0) {
            if ($totalBooksThisMonth == 0) {
                // Si ambos meses no tuvieron registros, no hay cambio
                $percentageChange = 0;
            } else {
                // Si el mes pasado no hubo registros pero este mes sí, el cambio es del 100%
                $percentageChange = 100;
            }
        } else {
            // Calcular el porcentaje de cambio
            $percentageChange = ($difference / $totalBooksLastMonth) * 100;
        }

        // Formatear el porcentaje de cambio a 2 decimales
        $percentageChange = number_format($percentageChange, 2);

        // Preparar los datos para la vista o respuesta
        $data = [
            'total' => $totalBooks,
            'this_month' => $totalBooksThisMonth,
            'last_month' => $totalBooksLastMonth,
            'difference' => $difference,
            'percentage_change' => $percentageChange
        ];

        // Retornar la vista o respuesta con los datos
        return $data;
    }

    public function showBooksByCareer()
    {
        // Obtener el rango de fechas para el mes actual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Obtener el rango de fechas para el mes pasado
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Obtener el total de libros por carrera
        $careers = Careers::withCount([
            'books as total_books_general' => function($query) {
                $query->selectRaw('count(*)');
            },
            'books as total_books_this_month' => function($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            },
            'books as total_books_last_month' => function($query) use ($startOfLastMonth, $endOfLastMonth) {
                $query->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth]);
            }
        ])->get();

        // Calcular el porcentaje de cambio mensual para cada carrera
        foreach ($careers as $career) {
            $totalBooksThisMonth = $career->total_books_this_month;
            $totalBooksLastMonth = $career->total_books_last_month;

            $difference = $totalBooksThisMonth - $totalBooksLastMonth;

            if ($totalBooksLastMonth == 0) {
                if ($totalBooksThisMonth == 0) {
                    $percentageChange = 0;
                } else {
                    $percentageChange = 100;
                }
            } else {
                $percentageChange = ($difference / $totalBooksLastMonth) * 100;
            }

            $career->percentage_change = number_format($percentageChange, 2);
        }

        // Preparar los datos para la vista o respuesta
        $data = [
            'careers' => $careers
        ];

        // Retornar la vista o respuesta con los datos
        return $data;
    }

    public function getBooksByShelf()
    {
        // Obtener el total de libros por categoría
        $booksByCategory = Book::select('shelf', DB::raw('count(*) as total'))
            ->groupBy('shelf')
            ->get();

        // Devolver los datos como JSON
        return response()->json($booksByCategory);
    }

    public function typeBook(){
        $data = (object)[];
        $data->donated    = Book::where('donated', true)->count();
        $data->buyed      = Book::where('donated', false)->count();

        return $data;
    }
}

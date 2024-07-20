<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            ['modal' => 'kt_modal_create_app', 'class' => 'btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary', 'text' => 'Rollover'],
            ['link' => '#link', 'class' => 'btn btn-sm fw-bold btn-primary', 'text' => 'Boton', 'icon' => 'la-pen']
        ];
        return view('pages.dashboards.index', compact('data'));
    }
}

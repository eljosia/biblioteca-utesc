<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
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

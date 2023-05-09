@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="text-center h3 my-4">
                Dashboard
            </div>
        </div>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 px-1">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Libros (Totales)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Book::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-book fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 px-1">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Libros (Prestados)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Loan::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-people-carry-box fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 px-1">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Usuarios Premium
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rocket fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4 px-1">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-9 pe-md-1">
            <div class="row">
                <div class="col-md-7 mb-3 pe-md-1">
                    <div class="h3 mb-3">Busqueda diaria de libros</div>
                    <div class="card shadow p-5" style="height: 100%">
                        <canvas id="get-daily-search" class="my-auto"></canvas>
                    </div>
                </div>

                <div class="col-md-5 mb-3 ps-md-1">
                    <div class="h3 mb-3">Libros Totales</div>
                    <div class="card shadow p-5" style="height: 100%">
                        <canvas id="get-quantity-books" class="my-auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ps-md-1">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="h3 mb-3">Entregas de Libros</div>
                    <div class="card shadow p-3" style="height: 100%">
                        <table class="table table-sm" id="to-delivery-books">
                            <thead>
                                <tr>
                                    <th class="text-wrap">Nombre</th>
                                    <th>Info</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @include('partials.modals._m_people_info')
@endsection
@section('scripts')
    @vite(['resources/js/home.js'])
@endsection

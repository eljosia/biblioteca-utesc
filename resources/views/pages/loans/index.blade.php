@extends('layouts.app')

@section('title', 'Prestamos de Libros')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Préstamos</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <div class="row">
                    </div>
                    <div id="dtable">
                        <div class="dtable-content">
                            <table class="table table-striped table-hover table-sm" id="loans-table"
                                data-url="{{ $data->loadloans }}">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Matrícula</th>
                                        <th>Nombre</th>
                                        <th>Libro</th>
                                        <th>Prestamo</th>
                                        <th>Fecha Limite</th>
                                        <th>Prestado por</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@vite(['resources/js/pages/loans/index.js'])

@endsection

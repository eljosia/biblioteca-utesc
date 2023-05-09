@extends('layouts.app')

@section('title', 'Prestamos de Libros')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Personas</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-header h3">
                    <i class="fa-solid fa-people-group"></i> Lista de Personas
                </div>
                <div class="card-body">
                    <div id="dtable">
                        <div class="dtable-content">
                            <table class="table table-striped table-hover table-sm" id="peoples-table"
                                data-url="{{ $data->loadpeoples }}">
                                <thead>
                                    <tr>
                                        <th>Matrícula</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Teléfono</th>
                                        <th>Carrera</th>
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
@section('modals')
    @include('partials.modals._m_people_info')
@endsection
@section('scripts')
    @vite(['resources/js/pages/peoples/index.js'])
@endsection

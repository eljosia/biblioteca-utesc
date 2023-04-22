@extends('layouts.app')

@section('title', 'Libros')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Libros</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="text-center h3 my-4">
                   Todos los libros
                </div>

                <table class="table table-striped table-hover table-sm" id="books-table">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Folio</th>
                            <th>ISBN</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Area</th>
                            <th>Cantidad</th>
                            <th>Edicion</th>
                            <th>Pais</th>
                            <th>Páginas</th>
                            <th>Estante</th>
                            <th>Clasificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@vite(['resources/js/pages/books/index.js'])
@endsection
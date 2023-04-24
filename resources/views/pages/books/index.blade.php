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
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mx-auto">
                            <form class="border-bottom py-3" id="book-filter" method="GET"
                                action="{{ route('book.list') }}">
                                <div class="row">
                                    <div class="col-6 col-md-3 mb-4 pe-2">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Titulo, autor o editorial">
                                    </div>
                                    <div class="col-6 col-md-3 mb-4 pe-2">
                                        <select class="form-control" data-live-search="true"
                                            data-style="btn-outline-light text-dark" name="area">
                                            <option value="">Area</option>
                                            @foreach ($data->areas as $area)
                                                <option value="{{ $area->area }}">{{ $area->area }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-2 mb-4 pe-2">
                                        <input type="number" class="form-control" name="estante" placeholder="Estante">
                                    </div>
                                    <div class="col-6 col-md-4 mb-4 pe-2">
                                        <input type="text" name="datefilter" class="form-control" id="datefilter"
                                            placeholder="Fechas" value="" />
                                    </div>
                                    <div class="col-12 text-end">
                                        <button class="btn btn-secondary ms-auto btn-clean-filter">Limpiar</button>
                                        <button type="submit" class="btn btn-primary ms-auto">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="dtable">
                        <div class="dtable-content">
                            <table class="table table-striped table-hover table-sm" id="books-table"
                                data-url="{{ $data->loadbook }}">
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
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/books/index.js'])

@endsection

@extends('layouts.app')

@section('title', 'Generar Reportes')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Reportes</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <h3 class="border-bottom pb-3"><i class="fa-regular fa-file-pdf"></i> Generar Reportes</h3>
                    <div class="row">
                        <div class="col-12 row">
                            <div class="col-12 p-1">
                                <div class="text-muted">Filtros:</div>
                                <form class="row border-bottom py-3" id="report-filtre" method="GET" action="{{route('report.generate')}}">
                                    <div class="col-6 col-md-3 px-1 my-1">
                                        <label for="" class="form-label">Reporte:</label>
                                        <select class="form-control" id="report-type" name="type">
                                            <option value="general">General</option>
                                            <option value="area">Por Areas/Carrera</option>
                                            <option value="loan">Prestamos</option>
                                        </select>
                                    </div>

                                    <div class="col-9 col-md-3 px-1 my-1 d-none dfiltro" id="by-area">
                                        <label for="" class="form-label">Área:</label>
                                        <select class="form-control filtro" data-live-search="true"
                                            data-style="btn-outline-light text-dark" id="area" name="area_id">
                                            <option value="">Selecciona Area</option>
                                            @foreach (\App\Models\Careers::all() as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-4 mb-4 pe-2">
                                        <label for="" class="form-label">Fechas</label>
                                        <input type="text" name="datefilter" class="form-control mt-1" id="datefilter"
                                            placeholder="Fechas" value="" />
                                    </div>
                                    <div class="col-12 px-1">
                                        <button type="submit" id="btngen" data-url="#"
                                            class="float-end btn btn-sm btn-primary">Generar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/reports/index.js'])
@endsection

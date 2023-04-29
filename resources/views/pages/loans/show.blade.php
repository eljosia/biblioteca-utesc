@extends('layouts.app')

@section('title', 'Detalle del Prestamo')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Préstamos</li>
            <li class="breadcrumb-item">Detalle</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data->loan->code }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <div class="border-bottom pb-3 mb-6 row">
                        <div class="col-md-6 h3 my-auto">
                            <i class="fa-solid fa-calendar-day me-1"></i> Prestamo de libro #{{ $data->loan->code }}
                        </div>
                        <div class="col-md-6 text-end mt-4 mt-sm-0">
                            <a target="_blank" href="{{route('loan.print', ['code' => $data->loan->code])}}" class="btn btn-primary btn-sm"><i class="fa-solid fa-print d-sm-none"></i>
                                <span class="d-none d-sm-block"><i class="fa-solid fa-print"></i> Imprimir</span>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen d-sm-none"></i>
                                <span class="d-none d-sm-block"><i class="fa-solid fa-file-pen"></i> Editar</span>
                            </a>
                            <a href="#" class="btn btn-success btn-sm"><i class="fa-solid fa-check d-sm-none"></i>
                                <span class="d-none d-sm-block"><i class="fa-solid fa-check"></i> Entregar</span>
                            </a>
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-12 text-end">
                            <div>
                                <span class="font-bold">Fecha del Prestamo:</span> <br>
                                @date($data->loan->created_at)
                            </div>

                            <div>
                                <span class="font-bold">Fecha Limite de Entrega:</span> <br>
                                @date($data->loan->return_date);
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 h4 text-center mb-4">
                            <i class="fa-solid fa-user me-1"></i> Datos de la persona
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="font-bold">Matrícula / No. Empleado:</span> <br>
                            {{($data->people->identifier)}}
                        </div>
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="font-bold">Nombre:</span> <br>
                            {{ $data->people->name }} {{ $data->people->last_name }}
                        </div>
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="font-bold">Teléfono:</span> <br>
                            {{ $data->people->phone ? $data->people->phone : ' - - - ' }}
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="font-bold">Carrera:</span> <br>
                            {{ $data->people->career }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12 h4 text-center mb-4">
                            <i class="fa-solid fa-book me-1"></i> Datos del Libro:
                        </div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-6 col-sm-3 text-center p-5">
                            <input type="hidden" name="isbn" value="{{ $data->book->isbn }}">
                            <div id="previewimg"></div>
                        </div>
                        <div class="col-6 col-sm-9 p-5">
                            <div class="row">
                                <div class="col-12">
                                    <span class="font-bold">Titulo:</span> <br>
                                    {{ $data->book->title }}
                                </div>
                                <div class="col-12">
                                    <span class="font-bold">Autor:</span> <br>
                                    {{ $data->book->autor }}
                                </div>
                                <div class="col-12">
                                    <span class="font-bold">Clasificación:</span> <br>
                                    {{ $data->book->shelf }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/loans/show.js'])
@endsection

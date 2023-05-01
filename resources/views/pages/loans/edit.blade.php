@extends('layouts.app')

@section('title', 'Nuevo Prestamo')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('loan.index') }}">Prestamos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Prestamo</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <h3 class="border-bottom pb-3 mb-4"><i class="fa-solid fa-file-pen"></i> Editar Prestamo: {{$data->loan->code}}</h3>
                    <form id="form-new-loan" method="POST" action="{{ route('loan.save') }}" class="row">
                        <input type="hidden" value="{{$data->loan->id}}" name="loan_id">
                        <div class="col-10 mx-auto">
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">
                                    Datos del Prestamo del libro
                                    <hr>
                                </div>
                                <div class="col-6 col-md-4 pe-2">
                                    <label for="" class="form-label">Fecha del Prestamo</label>
                                    <input type="date" name="loan_date" class="form-control"
                                        value="{{\Carbon\Carbon::parse($data->loan->created_at)->format('Y-m-d')}}">
                                </div>
                                <div class="col-6 col-md-4 pe-2">
                                    <label for="" class="form-label">Fecha de Entrega</label>
                                    <input type="date" name="return_date" class="form-control"
                                        value="{{$data->loan->return_date}}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">
                                    Datos del Alumno/Profesor
                                    <hr>
                                </div>
                                <div class="col-12 row mb-4">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Matricula / No. Empleado / ID INE:</label>
                                        <input type="text" class="form-control" name="identifier"
                                            placeholder="Ingrese el identificador" value="{{$data->loan->people->identifier}}">
                                        <span class="error text-danger font-bold" data-name="employee_number"></span>
                                    </div>

                                </div>
                                <div class="col-md-6 pe-2">
                                    <label for="" class="form-label">Nombre: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ingresa el Nombre" value="{{$data->loan->people->name}}">
                                    <span class="error text-danger font-bold" data-name="name"></span>

                                </div>
                                <div class="col-md-6 ps-2">
                                    <label for="" class="form-label">Apellidos: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Ingresa los Apellidos" value="{{$data->loan->people->last_name}}">
                                    <span class="error text-danger font-bold" data-name="last_name"></span>

                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4 pe-2">
                                    <label for="" class="form-label">Telefono:</label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Ingresa el numero de celular" value="{{$data->loan->people->phone}}">
                                    <span class="error text-danger font-bold" data-name="phone"></span>

                                </div>
                                <div class="col-sm-7 col-md-4 pe-2">
                                    <label for="" class="form-label">Carrera:</label>
                                    <select name="career_id" class="form-control">
                                        @foreach ($data->career as $career)
                                            <option value="{{ $career->id }}" {{($career->id == $data->loan->people->career_id) ? 'selected' : ''}}>{{ $career->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto">
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">
                                    Datos del Libro
                                    <hr>
                                </div>
                                <div class="col-12 pe-2">
                                    <label for="" class="form-label">Titulo: <span
                                            class="text-danger">*</span></label>
                                    <input id="book-title" type="text" class="form-control" name="title"
                                        dir="ltr" autocomplete="on" tabindex="1" value="{{$data->loan->book->title}}">
                                </div>

                            </div>

                            <div class="row mb-4">
                                <div class="col-md-2 pe-2">
                                    <label for="" class="form-label">Clasificación:</label>
                                    <input type="text" class="form-control" readonly placeholder="Clasificación"
                                        name="classification" value="{{$data->loan->book->shelf}}">
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label for="" class="form-label">Autor:</label>
                                    <input type="text" class="form-control" readonly placeholder="Autor"
                                        name="autor" value="{{$data->loan->book->autor}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto">
                            <div class="text-end">
                                <input type="hidden" name="book_id" value="{{$data->loan->book->id}}">
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                    Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/loans/new.js'])
@endsection

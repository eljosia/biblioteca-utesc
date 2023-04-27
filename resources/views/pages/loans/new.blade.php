@extends('layouts.app')

@section('title', 'Nuevo Prestamo')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('loan.index') }}">Prestamos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nuevo Prestamo</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <h3 class="border-bottom pb-3 mb-4"><i class="fa-solid fa-plus"></i> Nuevo Prestamo</h3>
                    <div class="row">
                        <div class="col-10 mx-auto">
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">Datos del Alumno/Profesor</div>
                                <div class="col-md-6 pe-2">
                                    <label for="" class="form-label">Nombre: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ingresa el Nombre">
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label for="" class="form-label">Apellidos: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Ingresa los Apellidos">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4 pe-2">
                                    <label for="" class="form-label">Telefono:</label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Ingresa el numero de celular">
                                </div>
                                <div class="col-md-4 px-1">
                                    <label for="" class="form-label">Matrícula:</label>
                                    <input type="text" class="form-control" name="tuition"
                                        placeholder="Matrícula del alumno">
                                </div>
                                <div class="col-md-4 ps-2">
                                    <label for="" class="form-label">No. de Empleado:</label>
                                    <input type="text" class="form-control" name="employee_number"
                                        placeholder="Número de Empleado">
                                </div>
                                <div class="col-md-8 ms-auto text-center">
                                    <div style="font-size: 0.7rem">Ingrese solo <b>La Matrícula</b> si correspone a un
                                        alumno o <b>Número de Empleado</b> a algun trabajador de la escuela si es necesario
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-8">
                                <div class="col-md-4 pe-2">
                                    <label for="" class="form-label">Carrera:</label>
                                    <select name="career" class="form-control">
                                        @foreach ($data->career as $career)
                                            <option value="{{ $career->area }}">{{ $career->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 px-1">
                                    <label for="" class="form-label">Cuatrimestre:</label>
                                    <select name="grade" class="form-control">
                                        <option value="0">Seleccionar</option>
                                        @for ($i = 1; $i < 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2 ps-2">
                                    <label for="" class="form-label">Grupo:</label>
                                    <input type="text" class="form-control" name="group" placeholder="Grupo">
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto">
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">Datos del Libro</div>
                                <div class="col-md-6 pe-2">
                                    <label for="" class="form-label">Titulo: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Ingresa el titulo del libro">
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
    @vite(['resources/js/pages/loans/new.js'])
@endsection

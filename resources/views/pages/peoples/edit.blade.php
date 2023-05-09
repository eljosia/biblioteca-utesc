@extends('layouts.app')

@section('title', 'Editar Persona')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('people.index') }}">Personas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Persona</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-header h3">
                    Agregar Nueva Persona
                </div>

                <div class="card-body">
                    <form action="{{ route('people.save') }}" method="POST" id="form-add-people">
                        <div class="row mb-3">
                            <div class="col-md-6 px-3">
                                <label for="" class="form-label">Nombre:</label>
                                <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$data->people->name}}">
                                <span class="error text-danger font-bold" data-name="name"></span>
                            </div>
                            <div class="col-md-6 px-3">
                                <label for="" class="form-label">Apellidos</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Apellidos" value="{{$data->people->last_name}}">
                                <span class="error text-danger font-bold" data-name="last_name"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 px-3">
                                <label for="" class="form-label">Identificador:</label>
                                <input type="text" name="identifier" class="form-control" placeholder="Matrícula/ID" value="{{$data->people->identifier}}" readonly>
                                <span class="error text-danger font-bold" data-name="identifier"></span>
                                <div id="identifierHelp" class="form-text">Ingrésa la matrícula del alumno/profesor o los 9
                                    dígitos que se encuentran al reverso del INE</div>
                            </div>
                            <div class="col-md-4 px-3">
                                <label for="" class="form-label">Teléfono</label>
                                <input type="text" name="phone" class="form-control" placeholder="xxx-xxx-xxxx" value="{{$data->people->phone}}">
                                <span class="error text-danger font-bold" data-name="phone"></span>
                            </div>
                            <div class="col-md-4 px-3">
                                <label for="" class="form-label">Carrera:</label>
                                <select name="career_id" class="form-control">
                                    @foreach ($data->career as $career)
                                        <option value="{{ $career->id }}" {{($career->id == $data->people->career_id) ? 'selected' : ''}}>{{ $career->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 text-end">
                                <input type="hidden" readonly value="{{$data->people->id}}" name="people_id">
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/peoples/new.js'])
@endsection

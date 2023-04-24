@extends('layouts.app')

@section('title', 'Nuevo Libro')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('book.index')}}">Libros</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nuevo Libro</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <h3 class="border-bottom pb-3"><i class="fal fa-books-medical"></i> Agregar Nuevo Libro</h3>
                    <div class="row mt-5">
                        <div class="col-12 col-md-3 px-3">
                            <div class="display-fc" id="previewimg">
        
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <form action="{{route('book.save')}}" class="row" method="POST" id="form-save-books">
                                <div class="col-12 col-md-4 p-1">
                                    <label for="" class="form-label">ISBN:</label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control inp" name="isbn" placeholder="ISBN">
                                        <button class="btn btn-primary" id="searchbook"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
        
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">FOLIO:</label>
                                    <input type="text" class="form-control inp" name="folio">
                                </div>
        
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Adquisición:</label>
                                    <input type="date" class="form-control inp" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" name="date_of_acq">
                                </div>
        
                                <div class="col-12 col-md-8 p-1">
                                    <label for="" class="form-label">Titulo:</label>
                                    <input type="text" class="form-control inp" required name="title">
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Autor:</label>
                                    <input type="text" class="form-control inp" name="autor">
                                </div>
                                <div class="col-12 p-1">
                                    <label for="" class="form-label">Descripción: <small>(Opcional)</small></label>
                                    <textarea class="form-control inp" rows="4" name="description"></textarea>
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Editorial:</label>
                                    <input type="text" class="form-control inp" name="editorial">
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Area:</label>
                                    <select class="form-control inp" name="area">
                                        <option value="Agricultura">Agricultura</option>
                                        <option value="Enfermería">Enfermería</option>
                                        <option value="Gastronomía">Gastronomía</option>
                                        <option value="Infantiles">Infantiles</option>
                                        <option value="Mantenimiento">Mantenimiento</option>
                                        <option value="Mecatrónica">Mecatrónica</option>
                                        <option value="Otros">Otros</option>
                                        <option value="Procesos Bioalimentarios">Procesos Bioalimentarios</option>
                                        <option value="Tecnologías">Tecnologías</option>
                                        <option value="Turismo">Turismo</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control inp" name="quantity">
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Edición:</label>
                                    <input type="text" class="form-control inp" name="edition">
                                </div>
                                <div class="col-4 col-md-4 p-1">
                                    <label for="" class="form-label">País</label>
                                    <input type="text" class="form-control inp" name="country">
                                </div>
                                <div class="col-4 col-md-4 p-1">
                                    <label for="" class="form-label">Páginas</label>
                                    <input type="number" class="form-control inp" name="pages">
                                </div>
                                <div class="col-4 col-md-4 p-1">
                                    <label for="" class="form-label">Estante</label>
                                    <input type="number" class="form-control inp" name="shelf">
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Clasificación</label>
                                    <select class="form-control inp" data-live-search="true" name="classification">
                                        @foreach($data->classifications as $class)
                                        <option value="{{$class->id}}">{{$class->theme}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Fecha de Publicación</label>
                                    <input type="text" class="form-control inp" name="date_of_pub">
                                </div>
        
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@vite(['resources/js/pages/books/new.js'])
@endsection

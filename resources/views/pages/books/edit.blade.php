@extends('layouts.app')

@section('title', 'Editar Libro')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('book.index') }}">Libros</a></li>
            <li class="breadcrumb-item">Editar</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-body">
                    <h3 class="border-bottom pb-3"><i class="fa-solid fa-pen-to-square"></i> Editar: {{$book->title}}</h3>

                    <div class="row mt-5">
                        <div class="col-12 col-md-3 px-3">
                            <div class="display-fc" id="previewimg">

                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <form action="{{ route('book.save') }}" class="row" method="POST" id="form-save-books">
                                <input type="hidden" name="book_id" value="{{$book->id}}">
                                <div class="col-12 col-md-4 p-1">
                                    <label for="" class="form-label">ISBN:</label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control inp" name="isbn" placeholder="ISBN" value="{{$book->isbn}}">
                                        <button class="btn btn-primary" id="searchbook"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">FOLIO:</label>
                                    <input type="text" class="form-control inp" name="folio" value="{{$book->folio}}">
                                </div>

                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Adquisición:</label>
                                    <input type="date" class="form-control inp" name="date_of_acq" value="{{$book->date_of_acq}}">
                                    <span class="error text-danger font-bold" data-name="date_of_acq"></span>
                                </div>

                                <div class="col-12 col-md-8 p-1">
                                    <label for="" class="form-label">Titulo:</label>
                                    <input type="text" class="form-control inp" required name="title" value="{{$book->title}}">
                                    <span class="error text-danger font-bold" data-name="title"></span>
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Autor:</label>
                                    <input type="text" class="form-control inp" name="autor" value="{{$book->autor}}">
                                </div>
                                <div class="col-12 p-1">
                                    <label for="" class="form-label">Descripción: <small>(Opcional)</small></label>
                                    <textarea class="form-control inp" rows="4" name="description">{{$book->description}}</textarea>
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Editorial:</label>
                                    <input type="text" class="form-control inp" name="editorial" value="{{$book->editorial}}">
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Area:</label>
                                    <select class="form-control inp" name="area">
                                        @foreach($areas as $area)
                                        <option value="{{$area->id}}" {{($book->area === $area->id) ? 'selected' : ''}}>{{$area->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control inp" name="quantity" value="{{$book->quantity}}">
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Edición:</label>
                                    <input type="text" class="form-control inp" name="edition" value="{{$book->edition}}">
                                </div>
                                <div class="col-4 col-md-4 p-1">
                                    <label for="" class="form-label">País</label>
                                    <input type="text" class="form-control inp" name="country" value="{{$book->country}}">
                                </div>
                                <div class="col-4 col-md-4 p-1">
                                    <label for="" class="form-label">Páginas</label>
                                    <input type="number" class="form-control inp" name="pages" value="{{$book->pages}}">
                                </div>
                                <div class="col-4 col-md-4 p-1">
                                    <label for="" class="form-label">Estante</label>
                                    <input type="number" class="form-control inp" name="shelf" value="{{$book->shelf}}">
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Clasificación</label>
                                    <select class="form-control inp" data-live-search="true" name="classification" value="{{$book->classification_id}}">
                                        @foreach (\App\Models\Classification::all() as $class)
                                            <option value="{{ $class->id }}" {{($class->id === $book->classification_id) ? 'selected' : ''}}>{{ $class->theme }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 p-1">
                                    <label for="" class="form-label">Fecha de Publicación</label>
                                    <input type="text" class="form-control inp" name="date_of_pub" value="{{$book->date_of_pub}}">
                                </div>

                                <div class="col-12 text-end">
                                    <input type="hidden" name="cover_url" value="{{$book->cover_img}}">
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
    @vite(['resources/js/pages/books/edit.js'])
@endsection

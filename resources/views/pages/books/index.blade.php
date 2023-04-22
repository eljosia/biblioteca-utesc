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
            </div>
        </div>
    </div>
@endsection

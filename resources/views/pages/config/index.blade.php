@extends('layouts.app')

@section('title', 'Configuración del sistema')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Configuración</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="card-header h3">Configuración General</div>
                <div class="card-body">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="general">General</li>
                        <li class="tab-link" data-tab="loan">Prestamos de Libros</li>
                        <li class="tab-link" data-tab="tab-3">Tab Three</li>
                        <li class="tab-link" data-tab="tab-4">Tab Four</li>
                    </ul>

                    <div id="general" class="tab-content current">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat.
                    </div>
                    <div id="loan" class="tab-content">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum.
                    </div>
                    <div id="tab-3" class="tab-content">
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                        nulla pariatur.
                    </div>
                    <div id="tab-4" class="tab-content">
                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        ul.tabs {
            margin: 0px;
            padding: 0px;
            list-style: none;
        }

        ul.tabs li {
            background: none;
            color: #222;
            display: inline-block;
            padding: 10px 15px;
            cursor: pointer;
        }

        ul.tabs li.current {
            background: #ededed;
            color: #222;
        }

        .tab-content {
            display: none;
            padding: 15px;
        }

        .tab-content.current {
            display: inherit;
        }
    </style>
@endsection
@section('scripts')
    @vite(['resources/js/pages/config/index.js'])
@endsection

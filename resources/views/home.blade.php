@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-5">
                <div class="text-center h3 my-4">
                    Dashboard
                </div>
            </div>
        </div>
    </div>
@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/sass/app.scss'])

</head>

<body class="bg-white">
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-gray-50">
        @include('partials.d_navbar')

        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <header class="bg-header">
                <div class="container-xl">
                    <div class="py-5">
                        <!-- Page heading -->
                        <div>
                            <div class="row align-items-center">
                                <div class="col-md-9 col-12 mb-3 mb-md-0">
                                    <!-- Title -->
                                    <span class="mb-0 ls-tight h-title">@yield('breadcrumb')</span>
                                </div>
                                <!-- Actions -->
                                <div class="col-md-3 col-12 text-md-end">
                                    <div class="mx-n1">
                                        @yield('actions')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main class="py-10 px-3 px-lg-7 ">
                <!-- Container -->
                <div class="container-xl">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- SCRIPTS --}}
    @vite(['resources/js/app.js'])
</body>

</html>

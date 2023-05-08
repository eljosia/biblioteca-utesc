<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTEsc | Biblioteca</title>
    @vite(['resources/sass/app.scss'])
    @vite(['resources/css/loader.css'])
    <style>
        #navbar {
            position: fixed;
            top: 0;
            width: 100%;
            display: block;
            transition: top 0.8s;
            z-index: 999;
        }

        h1 {
            font-weight: 300;
        }

        .content {
            margin-top: 15rem;
        }

        p {
            color: grey;
            font-weight: 300;
            line-height: 30px;
        }
    </style>
</head>

<body>
    <div class="loading d-none">Loading&#8230;</div>
    <div id="navbar">
        <div class="d-flex justify-content-center py-2" style="background-color: #3BBBA8;">
            <!-- Logo -->
            <a class="mx-auto align-items-center" href="#">
                <img src="{{ image('logo.png') }}" class="h-24 me-2" alt="...">
            </a>
        </div>
        <form action="/api/libros" id="form-search-book" class="row bg-white">
            <div class="col-10 mx-auto text-center">
                <h1 class="my-1">Buscar Libros:</h1>
                <div class="input-group input-group-lg d-flex">
                    <input type="text" class="form-control" placeholder="Titulo, Autor, ISBN ..." name="search" autocomplete="off">
                    <button type="submit" class="btn btn-primary" id="btn-search"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="content row">
        <div class="col-11 col-md-10 mx-auto">
            <div class="row response-books">
                {{-- RESULTADOS DE BUSQUEDA --}}
            </div>
        </div>
    </div>


    {{-- SCRIPTS --}}
    @vite(['resources/js/jquery.min.js', 'resources/js/app.js'])
    @vite(['resources/js/search_book.js'])
</body>

</html>

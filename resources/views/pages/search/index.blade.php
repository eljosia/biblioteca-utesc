@extends('pages.search._template')
@section('content')
    <div class="loading d-none">Loading&#8230;</div>
    <div id="navbar">
        <div class="d-flex justify-content-center py-2" style="background-color: #3BBBA8;">
            <!-- Logo -->
            <a class="mx-auto align-items-center" href="#">
                <img src="{{ image('logo.png') }}" class="h-24 me-2 my-5" alt="..." style="height: 10vh;">
            </a>
        </div>
        <form action="/api/libros" id="form-search-book" class="row bg-white p-5">
            <div class="col-10 col-md-5 mx-auto text-center">
                <h1 class="my-1">Buscar Libros:</h1>
                <div class="input-group input-group-lg d-flex">
                    <input type="text" class="form-control" placeholder="Titulo, Autor, ISBN ..." name="search"
                        autocomplete="off">
                    <button type="submit" class="btn btn-primary" id="btn-search"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="content row">
        <div id="releases" class="row"></div>
        <div class="col-11 col-md-10 mx-auto">
            <div class="row response-books mt-10" id="search-content">
                {{-- RESULTADOS DE BUSQUEDA --}}

            </div>
        </div>
    </div>

    <footer>
        <div id="scrolltop">
            <!--begin::Scrolltop button-->
            <div class="btn btn-dark rounded" data-kt-scrolltop="true" data-kt-scrolltop-speed="1000">
                <i class="fa-regular fa-circle-up fs-2"></i>
            </div>
            <!--end::Scrolltop button-->
        </div>

        <div class="row justify-content-between">
            <div class="col-4 text-sm">Powered By <a href="#">Jose
                    A.</a></div>
            <div class="col-4 text-end text-sm">
                @auth
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fa-solid fa-gauge me-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Iniciar Sesión
                    </a>
                @endauth
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= 30) {
                    document.getElementById("navbar").style.top = "-160px"; //160px oculta Buscar Libros
                    $('#scrolltop').fadeIn(1000);
                } else if (scroll <= 30) {
                    document.getElementById("navbar").style.top = "0";
                    $('#scrolltop').fadeOut(1000);

                }
            });

            const searchButton = document.querySelector("#btn-search");
            const blockUI = new KTBlockUI(searchButton, {
                overlayClass: "bg-dark bg-opacity-50"
            });

            const toggleBlockUI = (shouldBlock) => {
                if (shouldBlock) {
                    blockUI.block();
                    searchButton.disabled = true;
                } else {
                    blockUI.release();
                    searchButton.disabled = false;
                }
            };

            $('#form-search-book').on('submit', function(e) {
                e.preventDefault();
                const url = $(this).attr('action');
                const book = $('input[name="search"]').val().trim();

                if (book.length > 3) {
                    toggleBlockUI(true);

                    h.getPetition(url, {
                            search: {
                                "value": book
                            },
                            public_search: true
                        }, 'GET')
                        .then(response => {
                            console.log(response);
                            toggleBlockUI(false);
                            var data = response.data;
                            if (data.length > 0) {
                                var book_col = '';
                                $.each(data, function(i, book) {

                                    book_col += `<div class="col-6 col-md-4 mb-5">
                                                    <div class="card shadow-sm" style="height:100% !important;">
                                                        <div class="card-body ribbon ribbon-top">
                                                            ${(book.is_new == 1) ? '<div class="ribbon-label bg-success">¡Nuevo!</div>' : ''}
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <img class="mw-100 mh-300px card-rounded-bottom"
                                                                        src="${(book.cover_img) ? book.cover_img : '/images/default_book.gif'}" alt="">
                                                                </div>
                                                                <div class="col-8">
                                                                    <div class="fs-4 fw-bold">
                                                                        <i class="fa-solid fa-bookmark"></i>
                                                                        ${book.title}
                                                                    </div>
                                                                    <div class="px-5 fs-6 mt-5">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item"><span class="fw-bold">Autor:</span> ${book.autor}</li>
                                                                            <li class="list-group-item"><span class="fw-bold">Area:</span> ${book.area}</li>
                                                                            <li class="list-group-item"><span class="fw-bold">ISBN:</span> ${book.isbn}</li>
                                                                            <li class="list-group-item"><span class="fw-bold">Estante:</span> ${book.shelf}</li>
                                                                            <li class="list-group-item"><span class="fw-bold">Cantidad:</span> ${book.quantity}</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`
                                });

                                $('.response-books').html(book_col);
                                $('#releases').html(`<div class="col-10 mx-auto mt-10">
                                                        <p class="fs-4">
                                                            <b>${data.length}</b> resultados de busqueda para <b>"${book}"</b>
                                                        </p>
                                                    </div>`)
                            } else {
                                console.log('no hay datos')
                                $('#releases').html(`<div class="col-10 mx-auto mt-10">
                                                        <p class="fs-4">
                                                            <b>${data.length}</b> resultados de busqueda para <b>"${book}"</b>
                                                        </p>
                                                    </div>`)
                                $('.response-books').html(
                                    '<div class="text-2xl text-center">No hay resultados de búsqueda</div'
                                );

                            }
                        })
                        .catch(error => {
                            console.error(error);
                            toggleBlockUI(false);
                            toastr.error("Ha ocurrido un error con el servidor. Vuelve a intentarlo")
                        });
                } else {
                    toastr.warning('Ingresa por lo menos 3 letras para buscar un libro');
                    toggleBlockUI(false);
                }
            });
        });
    </script>
@endsection

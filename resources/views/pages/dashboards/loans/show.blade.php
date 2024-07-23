<x-default-layout>
    @include('partials._head-slots')

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

        <div class="col-12 col-md-7">
            <div class="card p-10 h-100">
                <div class="card-header">
                    <div class="card-title">
                        <i class="ki-duotone ki-user fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Datos de la persona
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="fw-bold">Matrícula / No. Empleado:</span> <br>
                            {{ $data->people->identifier }}
                        </div>
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="fw-bold">Nombre:</span> <br>
                            {{ $data->people->name }} {{ $data->people->last_name }}
                        </div>
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="fw-bold">Teléfono:</span> <br>
                            {{ $data->people->phone ? $data->people->phone : ' - - - ' }}
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="fw-bold">Carrera:</span> <br>
                            {{ $data->people->career->name }}
                        </div>
                        <div class="col-sm-6 col-md-4 text-center">
                            <span class="fw-bold">Fecha Préstamo:</span> <br>
                            @date($data->loan->created_at)
                        </div>
                        <div class="col-sm-6 col-md-4 text-center">
                            @if (!$data->loan->delivery_date)
                                <span class="fw-bold">Fecha Limite de Entrega:</span> <br>
                                @date($data->loan->return_date);
                            @else
                                <span class="fw-bold">Fecha Entregada:</span> <br>
                                @date($data->loan->delivery_date)
                            @endif
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-12 text-end">
                            Autorizado por: <span class="fw-bolder">{{$data->loan->creator->name}}</span> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 h3 my-auto">


                        </div>
                        <div class="col-md-6 text-end mt-4 mt-sm-0">
                            @if (!$data->loan->delivery_date)
                                <a href="{{ route('loan.edit', ['code' => $data->loan->code]) }}"
                                    class="btn btn-warning btn-sm"><i class="fa-solid fa-file-pen d-sm-none"></i>
                                    <span class="d-none d-sm-block"><i class="fa-solid fa-file-pen"></i> Editar</span>
                                </a>
                                <button data-url="{{ route('loan.deliver') }}" data-action="deliver"
                                    data-code="{{ $data->loan->code }}" class="btn btn-success btn-sm"><i
                                        class="fa-solid fa-check d-sm-none"></i>
                                    <span class="d-none d-sm-block"><i class="fa-solid fa-check"></i> Entregar</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="card p-10 h-100">
                <div class="card-header">
                    <div class="card-title">
                        <i class="ki-duotone ki-book fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                        Datos del Libro
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4 align-items-center">
                        <div class="col-6 text-center p-5">
                            <input type="hidden" name="isbn" value="{{ $data->book->isbn }}">
                            <div id="previewimg"></div>
                        </div>
                        <div class="col-6 p-5">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-bold">Titulo:</span> <br>
                                    {{ $data->book->title }}
                                </div>
                                <div class="col-12">
                                    <span class="fw-bold">Autor:</span> <br>
                                    {{ $data->book->autor }}
                                </div>
                                <div class="col-12">
                                    <span class="fw-bold">Clasificación:</span> <br>
                                    {{ $data->book->shelf }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->

    @push('scripts')
        <script>
            $(document).ready(function() {
                var isbn = $('input[name="isbn"]').val();
                var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;
                var cover = `https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg`;

                searchCover(url, cover);
                console.log("ready")
            });

            async function searchCover(url, cover) {
                let thumbnail;
                try {
                    const response = await fetch(url);
                    const results = await response.json();
                    console.log(results)
                    if (results.totalItems == 1) {
                        const book = results.items[0];

                        if (book.volumeInfo.imageLinks) {
                            thumbnail = book.volumeInfo.imageLinks.thumbnail;
                        } else {
                            const img = new Image();
                            img.src = cover;

                            await new Promise((resolve, reject) => {
                                img.onload = function() {
                                    if (img.naturalWidth === 1 && img.naturalHeight === 1) {
                                        console.log('La imagen es de 1x1 píxeles');
                                        thumbnail = '/images/default-book.png';
                                    } else {
                                        console.log('La imagen no es de 1x1 píxeles', cover);
                                        thumbnail = cover;
                                    }
                                    resolve();
                                };

                                img.onerror = function() {
                                    console.log('Ha ocurrido un error al cargar la imagen');
                                    reject();
                                };
                            });
                        }

                        // MOSTRAMOS
                    } else {
                        toastr.warning("No se pudo cargar la imagen");
                        thumbnail = '/images/default-book.png';
                    }
                } catch (error) {
                    console.log(error);
                }
                $('#previewimg').html(`<img src="${thumbnail}" style="width:100%">`);
            }
        </script>
    @endpush
    @push('modals')
    @endpush
</x-default-layout>

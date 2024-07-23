<x-default-layout>
    @include('partials._head-slots')

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-12">
            <div class="card">
                <div class="card">
                    <div class="card-body p-10">
                        <h3 class="border-bottom pb-3"><i class="fa-solid fa-plus"></i> Agregar Nuevo Libro</h3>
                        <div class="row mt-5">
                            <div class="col-12 col-md-3 px-3">
                                <div class="display-fc" id="previewimg">

                                </div>
                            </div>
                            <div class="col-12 col-md-9">
                                <form action="{{ route('book.save') }}" class="row" method="POST"
                                    id="form-save-books">
                                    <input type="hidden" name="book_id" value="{{ @$data->book->id }}">
                                    <div class="col-12 col-md-4 p-1">
                                        <label for="" class="form-label">ISBN:</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control inp" name="isbn"
                                                placeholder="ISBN" value="{{ @$data->book->isbn }}">
                                            <button class="btn btn-primary" id="searchbook"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">FOLIO:</label>
                                        <input type="text" class="form-control inp" name="folio"
                                            value="{{ @$data->book->folio }}">
                                    </div>

                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Adquisición:</label>
                                        <input type="date" class="form-control inp" name="date_of_acq"
                                            value="{{ @$data->book->date_of_acq }}">
                                        <span class="error text-danger font-bold" data-name="date_of_acq"></span>
                                    </div>

                                    <div class="col-12 col-md-8 p-1">
                                        <label for="" class="form-label">Titulo:</label>
                                        <input type="text" class="form-control inp" required name="title"
                                            value="{{ @$data->book->title }}">
                                        <span class="error text-danger font-bold" data-name="title"></span>
                                    </div>
                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Autor:</label>
                                        <input type="text" class="form-control inp" name="autor"
                                            value="{{ @$data->book->autor }}">
                                    </div>
                                    <div class="col-12 p-1">
                                        <label for="" class="form-label">Descripción:
                                            <small>(Opcional)</small></label>
                                        <textarea class="form-control inp" rows="4" name="description">{{ @$data->book->description }}</textarea>
                                    </div>
                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Editorial:</label>
                                        <input type="text" class="form-control inp" name="editorial"
                                            value="{{ @$data->book->editorial }}">
                                    </div>
                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Area:</label>
                                        <select class="form-control inp" name="area">
                                            @foreach ($data->area as $area)
                                                <option value="{{ $area->id }}"
                                                    {{ @$data->book->area === $area->id ? 'selected' : '' }}>
                                                    {{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Cantidad:</label>
                                        <input type="number" class="form-control inp" name="quantity"
                                            value="{{ @$data->book->quantity }}">
                                    </div>
                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Edición:</label>
                                        <input type="text" class="form-control inp" name="edition"
                                            value="{{ @$data->book->edition }}">
                                    </div>
                                    <div class="col-4 col-md-4 p-1">
                                        <label for="" class="form-label">País</label>
                                        <input type="text" class="form-control inp" name="country"
                                            value="{{ @$data->book->country }}">
                                    </div>
                                    <div class="col-4 col-md-4 p-1">
                                        <label for="" class="form-label">Páginas</label>
                                        <input type="number" class="form-control inp" name="pages"
                                            value="{{ @$data->book->pages }}">
                                    </div>
                                    <div class="col-4 col-md-4 p-1">
                                        <label for="" class="form-label">Estante</label>
                                        <input type="number" class="form-control inp" name="shelf"
                                            value="{{ @$data->book->shelf }}">
                                    </div>
                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Clasificación</label>
                                        <select class="form-control inp" data-live-search="true"
                                            name="classification" value="{{ @$data->book->classification_id }}">
                                            @foreach (\App\Models\Classification::all() as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ $class->id === @$data->book->classification_id ? 'selected' : '' }}>
                                                    {{ $class->theme }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-4 p-1">
                                        <label for="" class="form-label">Fecha de Publicación</label>
                                        <input type="text" class="form-control inp" name="date_of_pub"
                                            value="{{ @$data->book->date_of_pub }}">
                                    </div>

                                    <div class="col-12 text-end">
                                        <input type="hidden" name="cover_url"
                                            value="{{ @$data->book->cover_img }}">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
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
            $('#searchbook').on('click', function(e) {
                e.preventDefault();
                var isbn = $('input[name="isbn"]').val();
                var searchbtn = $(this);
                var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;
                var cover = `https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg`;

                searchBook(url, cover, searchbtn, isbn)
            })

            $('#form-save-books').on('submit', function(e) {
                e.preventDefault();

                var idform = this;
                var errors = document.querySelectorAll('.error');
                $('.error').text('');

                h.sendForm(idform).then(data => {
                    if (data.success) {
                        toastr.success(data.msg);
                        if (data.action == 'new') {
                            $(idform)[0].reset();
                            $('#previewimg').html('')
                        } else {
                            location.reload
                        }

                    } else {
                        toastr.error("Ops...", 'error');
                        console.log(data.errors)
                        errors.forEach(function(span) {
                            var name = $(span).data('name');
                            $(`[data-name="${name}"]`).text(data.errors[name])
                        })
                    }
                })
            })

            async function searchBook(url, cover, searchbtn, isbn) {
                try {
                    const response = await fetch(url);
                    const results = await response.json();
                    searchbtn.html(`<i class="fa-solid fa-magnifying-glass"></i>`);

                    if (results.totalItems == 1) {
                        const book = results.items[0];
                        let thumbnail;

                        const title = book['volumeInfo']['title'];
                        const desc = book['volumeInfo']['description'];
                        const authors = book['volumeInfo']['authors'];
                        const printType = book['volumeInfo']['printType'];
                        const pageCount = book['volumeInfo']['pageCount'];
                        const publisher = book['volumeInfo']['publisher'];
                        const publishedDate = book['volumeInfo']['publishedDate'];
                        const webReaderLink = book['accessInfo']['webReaderLink'];

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

                        const countryResponse = await fetch('/storage/country.json');
                        const country = await countryResponse.json();
                        if (book['accessInfo']['country']) {
                            var av = book['accessInfo']['country'];
                            $('input[name="pais"]').val(country[av]);
                        }

                        // MOSTRAMOS
                        $('#previewimg').html(`<img src="${thumbnail}" style="width:100%">`);
                        $('input[name="cover_url"]').val(thumbnail);
                        $('input[name="title"]').val(title);
                        $('input[name="autor"]').val(authors);
                        $('input[name="description"]').val(desc);
                        $('input[name="editorial"]').val(publisher);
                        $('input[name="pages"]').val(pageCount);
                        $('input[name="date_of_pub"]').val(publishedDate);
                    } else {
                        toastr.warning("No encontramos el libro, agregalo manualmente");
                    }
                } catch (error) {
                    console.log(error);
                }
            }


            // EDITAR
            $(document).ready(function() {
                var isbn = $('input[name="isbn"]').val();
                var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;
                var cover = `https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg`;

                if ($('#book_id').val())
                    searchCover(url, cover);
            });

            async function searchCover(url, cover) {
                try {
                    const response = await fetch(url);
                    const results = await response.json();

                    if (results.totalItems == 1) {
                        const book = results.items[0];
                        let thumbnail;

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
                        $('#previewimg').html(`<img src="${thumbnail}" style="width:100%">`);
                        $('input[name="cover_url"]').val(thumbnail);
                    } else {
                        toastr.warning("No se pudo cargar la imagen");
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        </script>
    @endpush
    @push('modals')
    @endpush
</x-default-layout>

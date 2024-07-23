<x-default-layout>
    @include('partials._head-slots')

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

        <div class="col-12">
            <div class="card p-10 h-100">
                <div class="card-header">
                    <div class="card-title">
                        <i class="ki-duotone ki-plus-square fs-2 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        Nuevo Prestamo
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-new-loan" method="POST" action="{{ route('loan.save') }}" class="row">
                        <input type="hidden" value="{{@$data->loan->id}}" name="loan_id">
                        <div class="col-10 mx-auto">
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">
                                    Datos del Prestamo del libro
                                    <hr>
                                </div>
                                <div class="col-6 col-md-4 pe-2">
                                    <label for="" class="form-label">Fecha del Prestamo</label>
                                    <input type="date" name="loan_date" class="form-control"
                                        value="{{\Carbon\Carbon::parse(@$data->loan->created_at)->format('Y-m-d')}}">
                                </div>
                                <div class="col-6 col-md-4 pe-2">
                                    <label for="" class="form-label">Fecha de Entrega</label>
                                    <input type="date" name="return_date" class="form-control"
                                        value="{{@$data->loan->return_date}}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">
                                    Datos del Alumno/Profesor
                                    <hr>
                                </div>
                                <div class="col-12 row mb-4">
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Matricula / No. Empleado / ID INE:</label>
                                        <input type="text" class="form-control" name="identifier"
                                            placeholder="Ingrese el identificador" value="{{@$data->loan->people->identifier}}">
                                        <span class="error text-danger font-bold" data-name="employee_number"></span>
                                    </div>

                                </div>
                                <div class="col-md-6 pe-2">
                                    <label for="" class="form-label">Nombre: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ingresa el Nombre" value="{{@$data->loan->people->name}}">
                                    <span class="error text-danger font-bold" data-name="name"></span>

                                </div>
                                <div class="col-md-6 ps-2">
                                    <label for="" class="form-label">Apellidos: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Ingresa los Apellidos" value="{{@$data->loan->people->last_name}}">
                                    <span class="error text-danger font-bold" data-name="last_name"></span>

                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4 pe-2">
                                    <label for="" class="form-label">Telefono:</label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Ingresa el numero de celular" value="{{@$data->loan->people->phone}}">
                                    <span class="error text-danger font-bold" data-name="phone"></span>

                                </div>
                                <div class="col-sm-7 col-md-4 pe-2">
                                    <label for="" class="form-label">Carrera:</label>
                                    <select name="career_id" class="form-control">
                                        @foreach (@$data->career as $career)
                                            <option value="{{ $career->id }}" {{($career->id == @$data->loan->people->career_id) ? 'selected' : ''}}>{{ $career->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto">
                            <div class="row mb-4">
                                <div class="col-12 h4 mb-4">
                                    Datos del Libro
                                    <hr>
                                </div>
                                <div class="col-12 pe-2 d-flex align-items-center">
                                    <label for="" class="form-label">Titulo: <span
                                            class="text-danger">*</span></label>
                                    <input id="book-title" type="text" class="form-control" name="title"
                                        dir="ltr" autocomplete="on" tabindex="1" value="{{@$data->loan->book->title}}">
                                    <span class="ms-5" id="ele_loader" style="display: none">
                                        <span class="loader"></span>
                                    </span>
                                </div>

                            </div>

                            <div class="row mb-4">
                                <div class="col-md-2 pe-2">
                                    <label for="" class="form-label">Clasificación:</label>
                                    <input type="text" class="form-control" readonly placeholder="Clasificación"
                                        name="classification" value="{{@$data->loan->book->shelf}}">
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label for="" class="form-label">Autor:</label>
                                    <input type="text" class="form-control" readonly placeholder="Autor"
                                        name="autor" value="{{@$data->loan->book->autor}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto">
                            <div class="text-end">
                                <input type="hidden" name="book_id" value="{{@$data->loan->book->id}}">
                                <button type="submit" class="btn btn-primary submit_btn"><i
                                        class="fa-solid fa-floppy-disk"></i>
                                    Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->
    @push('style')
        <style>
            .loader {
                width: 25px;
                height: 25px;
                border: 5px solid #FFF;
                border-bottom-color: #3BBBA8;
                border-radius: 50%;
                display: inline-block;
                box-sizing: border-box;
                animation: rotation 1s linear infinite;
            }

            @keyframes rotation {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
        <script>
            const autoCompleteJS = new autoComplete( // API Basic Configuration Object
                {
                    selector: "#book-title",
                    data: {
                        src: async () => {
                            const response = await fetch('/api/libros');
                            const data = await response.json();
                            // console.log(data.data.map(item => item.title))
                            return data.data.map(item => item.title);
                        },
                        cache: true
                    },
                    resultsList: {
                        element: (list, data) => {
                            if (!data.results.length) {
                                // Create "No Results" message element
                                const message = document.createElement("div");
                                // Add class to the created element
                                message.setAttribute("class", "no_result");
                                // Add message text content
                                message.innerHTML = `<span>No se encuentra el libro de "${data.query}"</span>`;
                                // Append message element to the results list
                                list.prepend(message);
                            }
                        },
                        noResults: true,
                    },
                    resultItem: {
                        highlight: true,
                    }
                }
            );

            autoCompleteJS.input.addEventListener("selection", function(event) {
                const feedback = event.detail;
                autoCompleteJS.input.blur();
                // // Prepare User's Selected Value
                const selection = feedback.selection.value;
                autoCompleteJS.input.value = selection;

                $('.submit_btn').prop('disabled', true);
                $('#ele_loader').fadeIn();

                h.getPetition("/api/libros", {
                    search: {
                        "value": selection
                    },
                }, 'GET').then(response => {
                    var book = response.data[0];
                    $('input[name="autor"]').val(book.autor)
                    $('input[name="classification"]').val(book.shelf)
                    $('input[name="book_id"]').val(book.id)

                    $('.submit_btn').prop('disabled', false);
                    $('#ele_loader').fadeOut();

                })
            });

            $(document).ready(function() {

                $('#form-new-loan').on('submit', function(e) {
                    e.preventDefault();
                    var idform = this;
                    var errors = document.querySelectorAll('.error');
                    $('.error').text('');

                    h.sendForm(idform).then(data => {
                        if (data.success == true) {
                            toastr.success(data.msg);
                            location.href = data.action;
                            // if (data.action == 'new') { $(idform)[0].reset(); $('#previewimg').html('')}
                            // else {
                            //     location.reload
                            // }

                            console.log(data);
                        } else {
                            toastr.error("Ops...");
                            console.log(data.errors)
                            errors.forEach(function(span) {
                                var name = $(span).data('name');
                                $(`[data-name="${name}"]`).text(data.errors[name])
                            })
                        }
                    })
                })

                $('input[name="identifier"]').blur(function() {
                    var $identifier = $(this).val();
                    var people
                    h.getPetition('/api/prestamo/buscar-persona', {
                        identifier: $identifier
                    }, 'GET').then(response => {

                        if (response.data) {
                            people = response.data
                            $('input[name="name"]').val(people.name);
                            $('input[name="last_name"]').val(people.last_name);
                            $('input[name="phone"]').val(people.phone);
                            $('select[name="career"]').val(people.career).trigger('change');
                            $('select[name="grade"]').val(people.grade).trigger('change');
                            $('input[name="group"]').val(people.group);
                        } else {
                            toastr.info(
                                'No se encontró ninguna persona, ingresa los datos correspondientes'
                            )
                        }


                    });
                });

            });
        </script>
    @endpush
    @push('modals')
    @endpush
</x-default-layout>

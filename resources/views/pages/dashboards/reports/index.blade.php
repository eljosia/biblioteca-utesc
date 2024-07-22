<x-default-layout>
    @include('partials._head-slots')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-10">
                    <h3 class="border-bottom pb-3"><i class="fa-regular fa-file-pdf"></i> Generar Reportes</h3>
                    <div class="row">
                        <div class="col-12 row">
                            <div class="col-12 p-1">
                                <div class="text-muted">Filtros:</div>
                                <form class="row border-bottom py-3" id="report-filtre" method="GET"
                                    action="{{ route('report.generate') }}">
                                    <div class="col-6 col-md-3 px-1 my-1">
                                        <label for="" class="form-label">Reporte:</label>
                                        <select class="form-select" data-control="select2"
                                            data-placeholder="Tipo de reporte" id="report-type" name="type">
                                            <option value="general">General</option>
                                            <option value="area">Por Areas/Carrera</option>
                                            <option value="loan">Prestamos</option>
                                        </select>
                                    </div>

                                    <div class="col-9 col-md-3 px-1 my-1 d-none dfiltro" id="by-area">
                                        <label for="" class="form-label">Área:</label>
                                        <select class="form-select filtro" data-control="select2"
                                            data-placeholder="Area" data-live-search="true"
                                            data-style="btn-outline-light text-dark" id="area" name="area_id">
                                            <option value="">Selecciona Area</option>
                                            @foreach (\App\Models\Careers::all() as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-4 mb-4 pe-2">
                                        <label for="" class="form-label">Fechas</label>
                                        <input type="text" name="datefilter" class="form-control mt-1"
                                            id="datefilter" placeholder="Fechas" value="" />
                                    </div>
                                    <div class="col-12 px-1">
                                        <button type="submit" id="btngen" data-url="#"
                                            class="float-end btn btn-sm btn-primary">Generar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body p-10">
                    Vista Previa:
                    <div id="loading">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div id="iframe-container"></div>
                </div>
            </div>
        </div>
    </div>
    @push('style')
        <style>
            #loading {
                display: none;
                text-align: center;
            }

            iframe {
                width: 100%;
                height: 500px;
                border: none;
            }

            .lds-ellipsis,
            .lds-ellipsis div {
                box-sizing: border-box;
            }

            .lds-ellipsis {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
            }

            .lds-ellipsis div {
                position: absolute;
                top: 33.33333px;
                width: 13.33333px;
                height: 13.33333px;
                border-radius: 50%;
                background: currentColor;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
            }

            .lds-ellipsis div:nth-child(1) {
                left: 8px;
                animation: lds-ellipsis1 0.6s infinite;
            }

            .lds-ellipsis div:nth-child(2) {
                left: 8px;
                animation: lds-ellipsis2 0.6s infinite;
            }

            .lds-ellipsis div:nth-child(3) {
                left: 32px;
                animation: lds-ellipsis2 0.6s infinite;
            }

            .lds-ellipsis div:nth-child(4) {
                left: 56px;
                animation: lds-ellipsis3 0.6s infinite;
            }

            @keyframes lds-ellipsis1 {
                0% {
                    transform: scale(0);
                }

                100% {
                    transform: scale(1);
                }
            }

            @keyframes lds-ellipsis3 {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(0);
                }
            }

            @keyframes lds-ellipsis2 {
                0% {
                    transform: translate(0, 0);
                }

                100% {
                    transform: translate(24px, 0);
                }
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('input[name="datefilter"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                        'MM/DD/YYYY'));
                });

                $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                $('#report-type').on('change', function(e) {
                    e.preventDefault();
                    var v = $(this).val();
                    if (v == "general") {
                        $('#btngen').data('url')
                        $('#by-area').addClass('d-none')
                        $('#area').val("");
                        $('#by-shelf').addClass('d-none').val("");
                        $('#shelf').val("");
                        $('#by-dates').addClass('d-none').val("");
                        $('#fechar').val("");
                    } else if (v == "area") {
                        $('#by-area').removeClass('d-none');
                    }
                });

                var iframeCreated = false; // Bandera para saber si ya se creó el iframe

                $('#report-filtre').on('submit', function(e) {
                    e.preventDefault();
                    var url;
                    var formData = {
                        type: $('select[name="type"]').val(),
                        area_id: $('select[name="area_id"]').val(),
                        fechas: $('input[name="datefilter"]').val(),
                        key: $('meta[name="data-key"]').attr('content'),
                    };

                    // Remover parámetros vacíos
                    Object.keys(formData).forEach(function(key) {
                        if (!formData[key]) {
                            delete formData[key];
                        }
                    });

                    $('#loading').show();
                    url = $(this).attr('action') + '?' + $.param(formData);
                    console.log(url);

                    // Si el iframe ya ha sido creado antes, se elimina
                    if (iframeCreated) {
                        $('#iframe-container').empty();
                    }

                    $('<iframe>', {
                        src: url,
                        id: 'document',
                        frameborder: 0,
                        scrolling: 'no'
                    }).on('load', function() {
                        // Ocultar mensaje de carga cuando el iframe haya cargado
                        $('#loading').hide();
                    }).on('error', function() {
                        $('#loading').hide();
                        toastr.error(
                            "Error al cargar, si el error persiste, contacta al administrador.");
                    }).appendTo('#iframe-container');

                    iframeCreated = true; // Marcar que el iframe ya ha sido creado
                });
            });
        </script>
    @endpush
    @push('modals')
    @endpush
</x-default-layout>

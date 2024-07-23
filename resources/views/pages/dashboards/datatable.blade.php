<x-default-layout>
    @include('partials._head-slots')

    <div class="row">
        <div class="col-12 mx-auto">
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header d-flex justify-content-start row">
                    <!--begin::Search-->
                    <div class="col-4 col-md-2 d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-product-filter="search"
                            class="form-control form-control-solid w-250px ps-12" id="search" name="search"
                            placeholder="Buscar" />
                    </div>
                    <!--end::Search-->

                    <div class="col-4 col-md-2 d-flex align-items-center position-relative my-1">
                        <select class="form-select form-select-solid filtro" data-control="select2"
                            data-placeholder="Area" data-live-search="true" data-style="btn-outline-light text-dark"
                            id="area" name="area">
                            <option value="all">Todas</option>
                            @foreach (\App\Models\Careers::all() as $area)
                                <option value="{{ $area->name }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--begin::Search-->
                    <div class="col-4 col-md-2 d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-calendar fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-product-filter="datefilter"
                            class="form-control form-control-solid w-250px ps-12" name="datefilter" id="datefilter"
                            placeholder="Fechas" placeholder="Fechas" />
                    </div>
                    <!--end::Search-->

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 mt-10">
                    <!--begin::Datatable-->
                    <table id="{{ isset($data->table->js) ? $data->table->js : $data->table->js }}"
                        data-url="{{ $data->table->list }}" class="table table-striped table-row-bordered gy-5 gs-7">
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                    <!--end::Datatable-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
    </div>
    @push('scripts')
        {{-- <script src="{{ mix('js/dashboard.js') }}"></script> --}}
        <script src="{{ mix('js/scripts/datatables/' . $data->table->js . '.js') }}" type="text/javascript"></script>
    @endpush
    @push('modals')
        @if (isset($data->modals))
            @foreach ($data->modals as $modal)
                @include($modal['include'])
            @endforeach
        @endif
    @endpush
</x-default-layout>

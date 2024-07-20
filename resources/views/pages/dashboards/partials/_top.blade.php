<!--begin::Row-->
<div class="row gy-5 gx-xl-10 justify-content-between">
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-2 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-book fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $data->books['total'] }}">0</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-500">Libros</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                @if ($data->books['percentage_change'] > 0)
                    <span class="badge badge-light-success fs-base">
                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->books['percentage_change'] }}%</span>
                @elseif ($data->books['percentage_change'] <= 0)
                    <span class="badge badge-light-danger fs-base">
                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->books['percentage_change'] }}%</span>
                @endif
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-2 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-search-list fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span
                        class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $data->total_search['this_week'] }}">0</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-500">Busqueda Semanal</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                @if ($data->total_search['percentage_change'] > 0)
                    <span class="badge badge-light-success fs-base">
                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->total_search['percentage_change'] }}%</span>
                @elseif ($data->total_search['percentage_change'] < 0)
                    <span class="badge badge-light-danger fs-base">
                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->total_search['percentage_change'] }}%</span>
                @endif
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-2 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-courier fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"  data-kt-countup="true" data-kt-countup-value="{{ $data->loans['total'] }}">0</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-500">Libros Prestados</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                @if ($data->loans['percentage_change'] > 0)
                    <span class="badge badge-light-success fs-base">
                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->loans['percentage_change'] }}%</span>
                @elseif ($data->loans['percentage_change'] <= 0)
                    <span class="badge badge-light-danger fs-base">
                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->loans['percentage_change'] }}%</span>
                @endif
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-2 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-watch fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $data->expired_loans['total'] }}">0</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-500">Prestamos Expirados</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                @if ($data->expired_loans['percentage_change'] > 0)
                    <span class="badge badge-light-success fs-base">
                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->expired_loans['percentage_change'] }}%</span>
                @elseif ($data->expired_loans['percentage_change'] <= 0)
                    <span class="badge badge-light-danger fs-base">
                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->expired_loans['percentage_change'] }}%</span>
                @endif
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-people fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $data->people['total'] }}">0</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-500">Personas Registradas</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                @if ($data->people['percentage_change'] > 0)
                    <span class="badge badge-light-success fs-base">
                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->people['percentage_change'] }}%</span>
                @elseif ($data->people['percentage_change'] <= 0)
                    <span class="badge badge-light-danger fs-base">
                        <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>{{ $data->people['percentage_change'] }}%</span>
                @endif
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->



    {{-- <!--begin::Col-->
    <div class="col-sm-6 col-xl-2 mb-5 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-abstract-26 fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">106M</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-500">Saving</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                <span class="badge badge-light-success fs-base">
                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>2.1%</span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col--> --}}
</div>
<!--end::Row-->

<x-default-layout>
    @include('partials._head-slots')

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-10">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">General</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Link 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Link 3</a>
                        </li> --}}
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header pt-8">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Preferencias</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <!--begin::Form-->
                                    <form class="form" id="form_settings" action="{{ route('setting.save') }}">
                                        <!--begin::Input group-->
                                        <div class="fv-row row mb-15">
                                            <!--begin::Col-->
                                            <div class="col-md-3 d-flex align-items-center">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold">Cabecera</label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-7">
                                                <!--begin::Input-->
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-empty" data-kt-image-input="true">
                                                    <!--begin::Image preview wrapper-->
                                                    <div class="image-input-wrapper" id="header_input"
                                                        style="width: 900px; height: 125px; background-size: cover; background-position: center; background-image: url('{{ @$data->setting->pdf_header }}')">
                                                    </div>
                                                    <!--end::Image preview wrapper-->

                                                    <!--begin::Edit button-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Change Header">
                                                        <i class="ki-duotone ki-pencil fs-6"><span
                                                                class="path1"></span><span class="path2"></span></i>

                                                        <!--begin::Inputs-->
                                                        <input type="file" name="pdfheader"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="pdfheader_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Edit button-->

                                                    <!--begin::Cancel button-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Cancel Header">
                                                        <i class="ki-outline ki-cross fs-3"></i>
                                                    </span>
                                                    <!--end::Cancel button-->

                                                    <!--begin::Remove button-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Remove Header">
                                                        <i class="ki-outline ki-cross fs-3"></i>
                                                    </span>
                                                    <!--end::Remove button-->
                                                </div>
                                                <!--end::Image input-->
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row row mb-15">
                                            <!--begin::Col-->
                                            <div class="col-md-3 d-flex align-items-center">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold">Pie de página</label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-7">
                                                <!--begin::Input-->
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-empty" data-kt-image-input="true">
                                                    <!--begin::Image preview wrapper-->
                                                    <div class="image-input-wrapper" id="footer_input"
                                                        style="width: 900px; height: 125px; background-size: cover; background-position: center; background-image: url('{{ @$data->setting->pdf_footer }}')">
                                                    </div>
                                                    <!--end::Image preview wrapper-->

                                                    <!--begin::Edit button-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Change Footer">
                                                        <i class="ki-duotone ki-pencil fs-6"><span
                                                                class="path1"></span><span class="path2"></span></i>

                                                        <!--begin::Inputs-->
                                                        <input type="file" name="pdffooter"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="pdffooter_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Edit button-->

                                                    <!--begin::Cancel button-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Cancel Footer">
                                                        <i class="ki-outline ki-cross fs-3"></i>
                                                    </span>
                                                    <!--end::Cancel button-->

                                                    <!--begin::Remove button-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        data-bs-dismiss="click" title="Remove Footer">
                                                        <i class="ki-outline ki-cross fs-3"></i>
                                                    </span>
                                                    <!--end::Remove button-->
                                                </div>
                                                <!--end::Image input-->
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Action buttons-->
                                        <div class="row mt-12">
                                            <div class="col-md-9 offset-md-3">
                                                <!--begin::Cancel-->
                                                <button type="button" class="btn btn-light me-3">Cancel</button>
                                                <!--end::Cancel-->
                                                <!--begin::Button-->
                                                <button type="submit" class="btn btn-primary"
                                                    id="kt_file_manager_settings_submit">
                                                    <span class="indicator-label">Save</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                        </div>
                                        <!--begin::Action buttons-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                            ...
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                            ...
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
                $('#form_settings').on('submit', function(e) {
                    e.preventDefault();

                    var url = $(this).attr('action');
                    var header64 = getBgImg('header_input');
                    var footer64 = getBgImg('footer_input');

                    var data = {
                        "pdf": {
                            "header": header64,
                            "footer": footer64
                        }
                    }

                    h.getPetition(url, data, "POST").then(response => {
                        if (response.success) {
                            toastr.success(response.msg);
                        } else {
                            toastr.error("Ha ocurrido un error, intenalo de nuevo");
                        }
                    });
                })
            });

            function getBgImg(elementId) {
                const element = document.getElementById(elementId);
                if (element) {
                    const backgroundImage = window.getComputedStyle(element).getPropertyValue('background-image');
                    const urlMatch = backgroundImage.match(/url\(["']?([^"']*)["']?\)/);
                    const url = urlMatch ? urlMatch[1] : null;

                    // Verificar si la URL es una imagen en base64
                    if (url && url.startsWith('data:image/')) {
                        return url;
                    }
                }
                return null;
            }
        </script>
    @endpush
    @push('modals')
    @endpush
</x-default-layout>

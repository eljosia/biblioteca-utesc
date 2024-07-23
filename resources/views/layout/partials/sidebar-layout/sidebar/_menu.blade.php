<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
            data-kt-menu-expand="false">
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item">
                <!--begin::Menu item-->
                <div class="menu-item">
                    <a href="{{route('dashboard.index')}}" class="menu-link">
                        <span class="menu-icon">{!! getIcon('element-11', 'fs-2 text-white') !!}</span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>

                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item">
                        <!--begin::Menu item-->
                        <div class="menu-item">
                            <a href="{{route('book.index')}}" class="menu-link">
                                <span class="menu-icon">{!! getIcon('book', 'fs-2 text-white') !!}</span>
                                <span class="menu-title">Libros</span>
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item">
                            <a href="{{route('loan.index')}}" class="menu-link">
                                <span class="menu-icon">{!! getIcon('courier', 'fs-2 text-white') !!}</span>
                                <span class="menu-title">Prestamos</span>
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item">
                            <a href="{{route('report.index')}}" class="menu-link">
                                <span class="menu-icon">{!! getIcon('tablet-text-down', 'fs-2 text-white') !!}</span>
                                <span class="menu-title">Reportes</span>
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item">
                            <a href="#" class="menu-link">
                                <span class="menu-icon">{!! getIcon('profile-user', 'fs-2 text-white') !!}</span>
                                <span class="menu-title">Personas</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->

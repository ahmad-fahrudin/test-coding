<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('dashboard') }}">
            <img alt="Logo" src="{{ asset('metronic/assets/media/logos/default-dark.svg') }}"
                class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('metronic/assets/media/logos/default-small.svg') }}"
                class="h-20px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">

                    <!-- Dashboard Section -->
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('dashboard') }}">
                            <span class="menu-icon"><i class="bi-graph-up"></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <!-- Master Data -->
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Master Data</span>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('kelas.index') }}">
                            <span class="menu-icon"><i class="bi bi-image-fill"></i></span>
                            <span class="menu-title">Kelas Manage</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('siswa.index') }}">
                            <span class="menu-icon"><i class="bi bi-image-fill"></i></span>
                            <span class="menu-title">Siswa Manage</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('guru.index') }}">
                            <span class="menu-icon"><i class="bi bi-image-fill"></i></span>
                            <span class="menu-title">Guru Manage</span>
                        </a>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
                        @csrf
                        <button type="submit"
                            class="btn btn-danger d-flex align-items-center justify-content-center mx-auto"
                            style="width: 80%; max-width: 200px;">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

</div>
<!--end::Sidebar-->

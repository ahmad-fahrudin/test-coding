<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../" />
    <title>{{ config('app.name') }} | @yield('title')
    </title>

    {{--  meta  --}}
    @include('layouts.meta_seo')
    {{--  end meta  --}}

    {{--  css files  --}}
    @include('layouts.css')
    {{--  end of css files  --}}

    {{--  page css  --}}
    @yield('page_css')
    {{--  end of page css  --}}

    {{--  extra css  --}}
    @yield('extra_css')
    {{--  end of extra css  --}}

    {{--  prevent clickjaking  --}}
    @include('layouts.prevent_clickjaking')
    {{--  end prevent clickjaking  --}}

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">

    {{-- script page setup --}}
    @include('layouts.page_setup_script')
    {{-- end script page setup --}}

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header" data-kt-sticky="true"
                data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize"
                data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
                <!--begin::Header container-->
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
                    id="kt_app_header_container">

                    {{-- sidebar toggle --}}
                    @include('layouts.sidebar_toggle')
                    {{-- end of sidebar toggle --}}

                    {{-- movbile logo --}}
                    @include('layouts.mobile_logo')
                    {{-- end movbile logo --}}

                    {{-- header menu wrapper --}}
                    @include('layouts.header_menu_wrapper')
                    {{-- end of header menu wrapper --}}

                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                {{-- sidebar --}}
                @include('layouts.sidebar')
                {{-- end of sidebar --}}

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">

                        <!--begin::Toolbar-->
                        <!--end::Toolbar-->

                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">

                                @yield('content')

                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->

                    {{-- footer --}}
                    @include('layouts.footer')
                    {{-- end of footer --}}

                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->

    {{-- bottom script --}}
    @include('layouts.bottom_script')
    {{-- end of bottom script --}}

    {{-- bottom script --}}
    @include('layouts.datatable_script')
    {{-- end of bottom script --}}

    {{-- page script --}}
    @yield('page_script')
    {{-- end of page script --}}

    {{-- extra script --}}
    @yield('extra_script')
    {{-- end of extra script --}}

</body>
<!--end::Body-->

</html>

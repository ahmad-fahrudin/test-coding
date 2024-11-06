<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Login {{ config('app.name') }}</title>
    <meta charset="utf-8" />

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

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">

    {{-- script page setup --}}
    @include('layouts.page_setup_script')
    {{-- end script page setup --}}

    @yield('content')

    {{-- bottom script --}}
    @include('layouts.bottom_script')
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

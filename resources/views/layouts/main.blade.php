<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT. Anjatama | {{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('layouts.partials.link')


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('lte/dist/img/AdminLTELogo.png') }} " alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('layouts.partials.navbar')

        @include('layouts.partials.sidebar')

        @yield('content')

        @include('layouts.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('layouts.partials.script')

</body>

</html>

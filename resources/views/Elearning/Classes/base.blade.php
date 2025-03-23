<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('Front/assets/img/logo.png') }}">
    <link href="{{ asset('BackEnd/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('BackEnd/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ asset('BackEnd/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
    <!-- App css -->
    <link href="{{ asset('BackEnd/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd//plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('css')
</head>

<body class="">

    <div class="col-md-11 mx-auto">
        @include('Elearning.Classes.top_bar')
        @yield('content')
    </div>
    <script src="{{ asset('BackEnd/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/waves.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/moment.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.analytics_dashboard.init.js') }}"></script>
    <script src="{{ asset('Backend/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/pages/jquery.form-upload.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('BackEnd/assets/js/app.js') }}"></script>
    @stack('js')
</body>

</html>

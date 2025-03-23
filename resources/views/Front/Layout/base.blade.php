<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="Front/assets/img/logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('Front/assets/vendor/animate.css/animate.min.cs') }}" rel="stylesheet">
    <link href="{{ asset('Front/assets/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('Front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Front/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Front/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('Front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('Front/assets/css/style.css') }}" rel="stylesheet">

<style>
    .fade-in-container {
    opacity: 0;
    animation: fadeIn 2s forwards; /* Adjust the duration as needed */
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}
</style>

</head>

<body style="font-family: 'Roboto Slab';">


    @include('Front.Layout.header')
    @if (Session::has('success'))
        <p class="alert alert-info bg-success text-white">{{ Session::get('success') }}</p>
    @endif
    @if (Session::has('error'))
        <p class="alert alert-info bg-danger text-white">{{ Session::get('error') }}</p>
    @endif

    <div class="bg-red" style="min-height: 70vh">
    @yield('content')
</div>

    @include('Front.layout.Footer')
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="{{ asset('Front/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('Front/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('Front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('Front/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('Front/assets/js/main.js') }}"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ env('APP_URL') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="icon" type="image/png" sizes="64x64" href="frontend/asset/img/favicon.png">
    <link rel="stylesheet" href="frontend/asset/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="frontend/asset/css/lightgallery-bundle.css">
    <link rel="stylesheet" href="frontend/asset/css/header-footer.css">

    <link rel="stylesheet" href="frontend/asset/css/home.css">
    <link rel="stylesheet" href="frontend/asset/css/category.css">
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/asset/css/detail.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body id="page-top">

    @include('frontend.user.layouts.header')


    <div class="over-suggestion"></div>
    <main class="main">
        @yield('content')
    </main>
    @include('frontend.user.layouts.footer')




    <script src="frontend/asset/js/bootstrap.bundle.min.js"></script>
    <script src="frontend/asset/js/header-footer.js"></script>
    <script src="frontend/asset/js/swiper-bundle.min.js"></script>
    <script src="frontend/asset/js/home.1.js"></script>
    <script src="frontend/asset/js/category.1.js"></script>
    <script src="frontend/asset/js/modal.js"></script>
    <script src="frontend/asset/js/detail.1.js">

    <script src="frontend/asset/js/cart.2.js"></script>
    <script src="frontend/asset/js/cart.3.js"></script>
    <script src="frontend/asset/js/detail.3.js"></script>
    <script src="frontend/asset/js/util.js"></script>
    <script src="frontend/asset/js/dropdown.js"></script>
    <script src="frontend/asset/js/jquery-3.6.0.min.js"></script>
    <!--bootstrap js-->
    @stack('scripts')

</body>

</html>

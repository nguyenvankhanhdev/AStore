<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ env('APP_URL') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/favicon.png">
    <link rel="stylesheet" href="frontend/asset/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="frontend/asset/css/lightgallery-bundle.css">
    <link rel="stylesheet" href="frontend/asset/css/header-footer.css">
    <link rel="stylesheet" href="frontend/asset/css/home.css">
</head>
<body>


    @include('frontend.user.layouts.header')

    <div class="over-suggestion"></div>

    <main class="main">
        <section class="section-wrap home-page">
            @include('frontend.user.layouts.section_cate')
        </section>

    </main>

    @include('frontend.user.layouts.footer')

    <script src="frontend/asset/js/header-footer.js"></script>
    <script src="frontend/asset/js/swiper-bundle.min.js"></script>
    <script src="frontend/asset/js/home.1.js"></script>
</body>
</html>
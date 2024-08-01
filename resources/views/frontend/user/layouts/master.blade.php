<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="icon" type="image/png" sizes="64x64" href="frontend/asset/img/favicon.png">
    <link rel="stylesheet" href="/frontend/asset/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/frontend/asset/css/lightgallery-bundle.css">
    <link rel="stylesheet" href="/frontend/asset/css/header-footer.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/frontend/asset/css/home.css">
    <link rel="stylesheet" href="/frontend/asset/css/category.css">
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/asset/css/detail.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .swal2-icon.swal2-warning {
            border-radius: 50%; /* Tạo viền tròn */
            border: 2px solid #f8bb86; /* Màu viền */
            padding: 10px; /* Khoảng cách bên trong biểu tượng */
            box-sizing: content-box; /* Đảm bảo padding không ảnh hưởng đến kích thước */
            margin-left: 200px; /* Khoảng cách với nội dung */
            margin-top: 10px
        }

        .swal2-icon.swal2-warning .swal2-icon-content {
            font-size: 30px; /* Kích thước biểu tượng */
        }
        .swal2-icon.swal2-success {
            border: 2px solid #26ef33; /* Màu viền */
            padding: 10px; /* Khoảng cách bên trong biểu tượng */
            box-sizing: content-box; /* Đảm bảo padding không ảnh hưởng đến kích thước */
            margin-left: 200px; /* Khoảng cách với nội dung */
            margin-top: 10px
        }

        .swal2-icon.swal2-success .swal2-icon-content {
            font-size: 30px; /* Kích thước biểu tượng */
        }
    </style>


</head>

<body id="page-top">

    @include('frontend.user.layouts.header')


    <div class="over-suggestion"></div>
    <main class="main">
        @yield('content')
    </main>
    @include('frontend.user.layouts.footer')




    <script src="/frontend/asset/js/bootstrap.bundle.min.js"></script>
    <script src="/frontend/asset/js/header-footer.js"></script>
    <script src="/frontend/asset/js/swiper-bundle.min.js"></script>
    <script src="/frontend/asset/js/home.1.js"></script>
    <script src="/frontend/asset/js/category.1.js"></script>
    <script src="/frontend/asset/js/modal.js"></script>
    <script src="/frontend/asset/js/detail.1.js">
        < script src = "/frontend/asset/js/cart.2.js" >
    </script>
    <script src="/frontend/asset/js/cart.3.js"></script>
    <script src="/frontend/asset/js/detail.3.js"></script>
    <script src="/frontend/asset/js/util.js"></script>
    <script src="/frontend/asset/js/dropdown.js"></script>
    <script src="/frontend/asset/js/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


    <!--bootstrap js-->
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.delete-item a', function(event) {
                event.preventDefault();

                let deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,
                            success: function(data) {
                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1000); // 0.5 giây
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Cant Delete',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                })
            })

        })

    </script>
    @stack('scripts')

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="icon" type="image/png" sizes="64x64" href="/frontend/asset/img/favicon.png">
    <link rel="stylesheet" href="/frontend/asset/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/frontend/asset/css/lightgallery-bundle.css">
    <link rel="stylesheet" href="/frontend/asset/css/header-footer.css">
    <link rel="stylesheet" href="/frontend/asset/css/home.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="/frontend/asset/css/detail.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/frontend/asset/css/category.css">
    <link rel="stylesheet" href="/frontend/asset/css/detail.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="/backend/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/frontend/asset/css/main.css">
    <link rel="stylesheet" href="/frontend/asset/css/header-footer-mb.css" media="only screen and (max-width: 768px)">
    <link rel="stylesheet" href="/frontend/asset/css/home-mb.css" media="only screen and (max-width: 768px)">
    <link rel="stylesheet" href="/frontend/asset/css/detail-mb.css" media="only screen and (max-width: 768px)">
    <link rel="stylesheet" href="/frontend/asset/css/category-mb.css" media="only screen and (max-width: 768px)">
    <link rel="stylesheet" href="/frontend/asset/css/main-mb.css" media="only screen and (max-width: 768px)">
    <link rel="stylesheet" href="/frontend/asset/css/fCare.css">

    <style>
        .toast-container {
            background: rgb(50, 130, 11);
        }

        .toast-message {}

        .toast-success {
            background: rgb(50, 130, 11);
        }

        .swal2-icon.swal2-warning {
            border-radius: 50%;
            /* Tạo viền tròn */
            border: 2px solid #f8bb86;
            /* Màu viền */
            padding: 10px;
            /* Khoảng cách bên trong biểu tượng */
            box-sizing: content-box;
            /* Đảm bảo padding không ảnh hưởng đến kích thước */
            margin-left: 200px;
            /* Khoảng cách với nội dung */
            margin-top: 10px
        }

        .containerr {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin-top: 17px;
            padding-left: 12px;
            margin-right: auto;
            margin-left: auto;
        }

        .swal2-icon.swal2-warning .swal2-icon-content {
            font-size: 30px;
            /* Kích thước biểu tượng */
        }

        .swal2-icon.swal2-success {
            border: 2px solid #26ef33;
            /* Màu viền */
            padding: 10px;
            /* Khoảng cách bên trong biểu tượng */
            box-sizing: content-box;
            /* Đảm bảo padding không ảnh hưởng đến kích thước */
            margin-left: 200px;
            /* Khoảng cách với nội dung */
            margin-top: 10px
        }

        .swal2-icon.swal2-success .swal2-icon-content {
            font-size: 30px;
            /* Kích thước biểu tượng */
        }

        .text-section {
            margin: 20px;
            flex: 1;
            margin-top: 111px;
        }

        .text-section h1 {
            font-size: 21px;
            color: #333333;
            margin: 0;
        }

        .text-section p {
            color: #666666;
            margin: 10px 0 20px;
        }

        .text-section button {
            background-color: #d32f2f;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .image-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
        }
    </style>

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"></script>


</head>
<body id="page-top">
    @include('frontend.user.layouts.header')
    <div class="over-suggestion"></div>
    <main class="main">
        @yield('content')
        <div class="wrap-section-chat"><a class="wrap-ic-chat" href="" aria-controls="chat-modal"><i
            class="ic-chat"></i></a>
        <div class="modal modal-sm js-modal chat-modal js-modal-chat" data-animation="on" id="chat-modal">
          <div class="modal-wrapper" tabindex="-1">
            <div class="modal-box">
              <div class="modal-header modal-title">
                <div class="label label-xl"> <span class="label-text">Hỗ trợ trực tuyến</span></div><span
                  class="modal-close js-modal-close"><i class="ic-close-thin ic-md"></i></span>
              </div>
              <div class="modal-body">
                <div class="list-ic-chat"><a class="item m-b-8" href="tel:18006616"><span class="img"> <img
                        src="{{ asset('frontend/asset/img/ic-call.png') }}" alt=""></span><span class="cont"><span class="num">1800
                        6616</span><span class="text">(8h00 - 22h00)</span></span></a><a class="item" href="{{ route('user.message.index') }}"><span
                      class="img"> <img src={{ asset('uploads/mess.png') }} alt=""></span><span class="cont"><span
                        class="num">Chat với Admin</span><span class="text">(8h00 - 22h00)</span></span></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>

    @include('frontend.user.layouts.footer')
    
    {{-- <script src="/frontend/asset/js/header-footer-mb.js" media="only screen and (max-width: 768px)"></script>
    <script src="/frontend/asset/js/home-mb.js" media="only screen and (max-width: 768px)"></script>
    <script src="/frontend/asset/js/detail-mb.js" media="only screen and (max-width: 768px)"></script>
    <script src="/frontend/asset/js/category-mb.js" media="only screen and (max-width: 768px)"></script>
    <script src="/frontend/asset/js/main-mb.js" media="only screen and (max-width: 768px)"></script> --}}

    <script src="/frontend/asset/js/header-footer.js"></script>
    <script src="/frontend/asset/js/swiper-bundle.min.js"></script>
    {{-- <script src="/frontend/asset/js/home.1.js"></script> --}}
    <script src="/frontend/asset/js/modal.js"></script>
    <script src="/frontend/asset/js/detail.1.js"></script>
    <script src="/frontend/asset/js/category.1.js"></script>
    <script src="/frontend/asset/js/category.2.js"></script>
    <script src="/frontend/asset/js/cart.2.js"></script>
    <script src="/frontend/asset/js/cart.3.js"></script>
    <script src="/frontend/asset/js/detail.3.js"></script>
    <script src="/frontend/asset/js/util.js"></script>
    <script src="/frontend/asset/js/dropdown.js"></script>
    <script src="/frontend/asset/js/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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

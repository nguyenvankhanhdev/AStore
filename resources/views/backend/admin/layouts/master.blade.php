<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('backend/asset/img/image.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ADMIN</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
    <link href="{{ asset('backend/asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/asset/bootstrap-daterangepicker/daterangepicker.css')}}" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('backend/asset/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
        .toast {
            color: black !important;
            /* Màu chữ */
            background-color: white !important;
            /* Màu nền */
            border: 1px solid #ccc;
            /* Viền */
        }

        .toast-success {
            background-color: #349734 !important;
            /* Màu nền khi thành công */
            color: white !important;
            /* Màu chữ khi thành công */
        }

        #loading-overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
            /* Hide overlay initially */
        }

        #loading-content {
            text-align: center;
            font-size: 20px;
            color: #000;
        }

        .spinner {
            margin: 20px auto;
            width: 70px;
            text-align: center;
        }

        .spinner>div {
            width: 18px;
            height: 18px;
            background-color: #333;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: bouncedelay 1.4s infinite ease-in-out both;
            animation: bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes bouncedelay {

            0%,
            80%,
            100% {
                -webkit-transform: scale(0);
            }

            40% {
                -webkit-transform: scale(1.0);
            }
        }

        @keyframes bouncedelay {

            0%,
            80%,
            100% {
                transform: scale(0);
                -webkit-transform: scale(0);
            }

            40% {
                transform: scale(1.0);
                -webkit-transform: scale(1.0);
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="loading-overlay">
        <div id="loading-content">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
            <p>Waiting...</p>
        </div>
    </div>
    <div id="wrapper">

        <!-- Sidebar -->
        @include('backend.admin.layouts.slide')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- Topbar Navbar -->
                @include('backend.admin.layouts.navbar')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('backend.admin.layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('auth.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="backend/asset/vendor/jquery/jquery.min.js"></script>
    <script src="backend/asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="backend/asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="backend/asset/js/sb-admin-2.min.js"></script>
    <script src="backend/asset/vendor/chart.js/Chart.min.js"></script>
    <script src="backend/asset/js/demo/chart-area-demo.js'"></script>
    <script src="backend/asset/js/demo/chart-pie-demo.js'"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="backend/asset/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


    <script>
        $(document).ready(function() {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd' // định dạng ngày tháng bạn mong muốn
            });
        })

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.delete-item', function(event) {
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
    <script>
        // Show overlay before page unloads
        window.addEventListener('beforeunload', function() {
            var overlay = document.getElementById('loading-overlay');
            overlay.style.display = 'flex';
        });

        // Hide overlay when page is fully loaded
        window.addEventListener('load', function() {
            var overlay = document.getElementById('loading-overlay');
            overlay.style.display = 'none';
        });

        // Hide overlay when page is navigated back from cache
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                var overlay = document.getElementById('loading-overlay');
                overlay.style.display = 'none';
            }
        });
    </script>



    @stack('scripts')

</body>

</html>

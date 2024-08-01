<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <title>
    @yield('title')
  </title>
  <link rel="icon" type="image/png" href="/">

  <link rel="stylesheet" href="{{ asset('frontend/asset/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/asset/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="/frontend/asset/css/select2.min.css">
  <link rel="stylesheet" href="/frontend/asset/css/slick.css">
  <link rel="stylesheet" href="/frontend/asset/css/jquery.nice-number.min.css">
  <link rel="stylesheet" href="/frontend/asset/css/jquery.calendar.css">
  <link rel="stylesheet" href="/frontend/asset/css/add_row_custon.css">
  <link rel="stylesheet" href="/frontend/asset/css/mobile_menu.css">
  <link rel="stylesheet" href="/frontend/asset/css/jquery.exzoom.css">
  <link rel="stylesheet" href="/frontend/asset/css/multiple-image-video.css">
  <link rel="stylesheet" href="/frontend/asset/css/ranger_style.css">
  <link rel="stylesheet" href="/frontend/asset/css/jquery.classycountdown.css">
  <link rel="stylesheet" href="/frontend/asset/css/venobox.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="/frontend/asset/css/style.css">
  <link rel="stylesheet" href="/frontend/asset/css/responsive.css">
  {{-- @if($settings->layout === 'RTL')
  <link rel="stylesheet" href="{{asset('frontend/css/rtl.css')}}">
  @endif
  @vite(['resources/js/app.js']) --}}



</head>

<body>


  <!--=============================
    DASHBOARD MENU START
  ==============================-->
  <div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
      <img src="uth()->user()->image)}}" alt="img" class="img-fluid">
      <p>{{auth()->user()->name}}</p>
    </div>
  </div>

  <!--=============================
    DASHBOARD MENU END
  ==============================-->


  <!--=============================
    DASHBOARD START
  ==============================-->
    @yield('content')
  <!--=============================
    DASHBOARD START
  ==============================-->


  <!--============================
      SCROLL BUTTON START
    ==============================-->
  <div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
  </div>
  <!--============================
    SCROLL BUTTON  END
  ==============================-->


  <!--jquery library js-->
  <script src="/frontend/asset/js/jquery-3.6.0.min.js"></script>
  <!--bootstrap js-->
  <script src="/frontend/asset/js/bootstrap.bundle.min.js"></script>
  <!--font-awesome js-->
  <script src="/frontend/asset/js/Font-Awesome.js"></script>
  <!--select2 js-->
  <script src="/frontend/asset/js/select2.min.js"></script>
  <!--slick slider js-->
  <script src="/frontend/asset/js/slick.min.js"></script>
  <!--simplyCountdown js-->
  <script src="/frontend/asset/js/simplyCountdown.js"></script>
  <!--product zoomer js-->
  <script src="/frontend/asset/js/jquery.exzoom.js"></script>
  <!--nice-number js-->
  <script src="/frontend/asset/js/jquery.nice-number.min.js"></script>
  <!--counter js-->
  <script src="/frontend/asset/js/jquery.waypoints.min.js"></script>
  <script src="/frontend/asset/js/jquery.countup.min.js"></script>
  <!--add row js-->
  <script src="/frontend/asset/js/add_row_custon.js"></script>
  <!--multiple-image-video js-->
  <script src="/frontend/asset/js/multiple-image-video.js"></script>
  <!--sticky sidebar js-->
  <script src="/frontend/asset/js/sticky_sidebar.js"></script>
  <!--price ranger js-->
  <script src="/frontend/asset/js/ranger_jquery-ui.min.js"></script>
  <script src="/frontend/asset/js/ranger_slider.js"></script>
  <!--isotope js-->
  <script src="/frontend/asset/js/isotope.pkgd.min.js"></script>
  <!--venobox js-->
  <script src="/frontend/asset/js/venobox.min.js"></script>
  <!--classycountdown js-->
  <script src="/frontend/asset/js/jquery.classycountdown.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!--Sweetalert js-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <!--main/custom js-->
  <script src="/frontend/asset/js/main.js"></script>

  <!-- Show Dynamic Validation Erros-->
  <script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{$error}}")
        @endforeach
    @endif
  </script>

    <!-- Dynamic Delete alart -->
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.delete-item', function(event){
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

                            success: function(data){

                                if(data.status == 'success'){
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    window.location.reload();
                                }else if (data.status == 'error'){
                                    Swal.fire(
                                        'Cant Delete',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error){
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

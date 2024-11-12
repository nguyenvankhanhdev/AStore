@extends('frontend.user.dashboard.layouts.master')

@section('title')
    Coupons
@endsection

@section('content')
    <!--=============================
        DASHBOARD START
      ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.user.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <div class="mb-3">
                            <a href="{{ route('user.user-coupons.index') }}" class="btn btn-primary"> <i
                                    class="fa fa-solid fa-backward"></i> Back</a>
                        </div>

                        <h3><i class="far fa-user"></i>Đổi Mã giảm giá</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        DASHBOARD START
      ==============================-->
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).on('click', '.redeem-coupon', function() {
            let couponId = $(this).data('id');

            $.ajax({
                url: '{{ route('coupons.redeem') }}',
                method: 'POST',
                data: {
                    coupon_id: couponId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);

                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    alert('Error redeeming coupon.');
                }
            });
        });
    </script>
@endpush

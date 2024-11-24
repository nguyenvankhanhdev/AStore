@extends('frontend.user.dashboard.layouts.master')

@section('title')
    Coupons
@endsection

@section('content')
    <!--=============================
        DASHBOARD START
      ==============================-->
      <section id="wsus__dashboard" class="py-5">
        <div class="container-fluid">
            @include('frontend.user.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <div class="mb-4">
                            <a href="{{ route('user.user-coupons.index') }}" class="btn btn-primary">
                                <i class="fa fa-solid fa-backward"></i> Quay lại
                            </a>
                        </div>

                        <h3 class="mb-4"><i class="far fa-user"></i> Đổi Mã Giảm Giá</h3>

                        <div class="mb-4">
                            <h4 class="btn btn-primary">Điểm của bạn: <strong>{{ App\Models\User::getPoint() }} đ</strong></h4>
                        </div>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="card">
                                    <div class="card-body">
                                        {{ $dataTable->table() }}
                                    </div>
                                </div>
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
            let button = $(this);

            // Disable the button to prevent multiple clicks
            button.prop('disabled', true);

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

                        // Reload the page after success
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000); // Delay before reload to show success message
                    } else {
                        toastr.error(response.message);
                    }
                    // Re-enable the button after the operation is completed
                    button.prop('disabled', false);
                },
                error: function() {
                    toastr.error('Có lỗi xảy ra khi đổi mã giảm giá.');
                    // Re-enable the button in case of error
                    button.prop('disabled', false);
                }
            });
        });
    </script>

@endpush

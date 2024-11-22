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
                    <h3 class="mb-4"><i class="far fa-user"></i> Mã giảm giá</h3>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('user.user-coupons.showcoupons') }}" class="btn btn-dark">Đổi mã giảm giá</a>
                            </div>
                            <div>
                                <h4 class="mb-0 btn btn-primary">Điểm của bạn: {{ App\Models\User::getPoint() }} đ</h4>
                            </div>
                        </div>
                    </div>
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
@endpush

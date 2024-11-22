@extends('frontend.user.dashboard.layouts.master')

@section('title')
 || Dahsboard
@endsection

@section('content')

        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <h3>User Dashboard</h3>
            <br>
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{ route('user.order.index') }}">
                    <i class="fas fa-cart-plus"></i>
                    <p>Total Order</p>
                    <h4 style="color:#ffff">{{ $orderTotal }}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="{{ route('user.order.index') }}">
                    <i class="fas fa-cart-plus"></i>
                    <p>Pending Orders</p>
                    <h4 style="color:#ffff">{{ $orderPending }}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{ route('user.order.index') }}">
                    <i class="fas fa-cart-plus"></i>
                    <p>Complete Orders</p>
                    <h4 style="color:#ffff">{{ $orderCompleted }}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="{{ route('user.reviews') }}">
                    <i class="fas fa-star"></i>
                    <p>Reviews</p>
                    <h4 style="color:#ffff">{{ $ratings }}</h4>
                  </a>
                </div>

                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="{{ route('user.wishlist.index') }}">
                    <i class="fas fa-star"></i>
                    <p>Wishlist</p>
                    <h4 style="color:#ffff">{{ $wishlist }}</h4>
                  </a>
                </div>

                <div class="col-xl-2 col-6 col-md-4">
                    <a class="wsus__dashboard_item orange" href="{{ route('user.dashboard.profile') }}">
                      <i class="fas fa-user-shield"></i>
                      <p>profile</p>
                      <h4 style="color:#ffff">-</h4>
                    </a>
                </div>
              </div>

            </div>
          </div>
        </div>

@endsection

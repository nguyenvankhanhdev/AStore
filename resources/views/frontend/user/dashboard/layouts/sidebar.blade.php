<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="javascript:;" class="dash_logo"><img src="/frontend/asset/img/logoAstore.jpg" alt="logo"
            class="img-fluid"></a>  
    <ul class="dashboard_link">
        <li><a class="" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>

        <li><a class="" href="{{ route('user.message.index') }}"><i class="fas fa-tachometer"></i>Tin nhắn</a>
        </li>

        <li><a class="" href="{{ url('/') }}"><i class="fas fa-home"></i>Trang chủ</a></li>

        <li>
            <a class="{{ setActive(['user.order.index']) }}" href="{{ route('user.order.index') }}"><i
                    class="fas fa-list-ul"></i>Tất cả đơn hàng</a>
        </li>
        <li>
            <a class="{{ setActive(['user.all.cancelorder']) }}" href="{{ route('user.all.cancelorder') }}">
                <i class="fa fa-first-order">
                </i>Đơn hàng đã hủy</a>
        </li>
        <li>
            <a class="{{ setActive(['user.all.completeorder']) }}" href="{{ route('user.all.completeorder') }}">
                <i class="fa fa-first-order">
                </i>Đơn hàng hoàn thành</a>
        </li>
        <li><a class="{{ setActive(['user.user-coupons.*']) }}" href="{{ route('user.user-coupons.index') }}"><i
                    class="fas fa-coins"></i>Phiếu giảm giá</a></li>
        <li><a class="{{ setActive(['user.reviews']) }}" href="{{ route('user.reviews') }}"><i class="far fa-star"></i>
                đánh giá</a></li>
        <li><a class="" href="{{ route('user.wishlist.index') }}"><i class="far fa-heart"></i>Yêu thích</a></li>

        <li><a class="{{ setActive(['user.dashboard.profile']) }}" href="{{ route('user.dashboard.profile') }}"><i
                    class="far fa-user"></i>Thông tin cá nhân</a></li>
        <li><a class="{{ setActive(['user.address.*']) }}" href="{{ route('user.address.index') }}"><i
                    class="fal fa-gift-card"></i>địa chỉ</a></li>

        <li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> Đăng xuất</a>
            </form>
        </li>

    </ul>
</div>

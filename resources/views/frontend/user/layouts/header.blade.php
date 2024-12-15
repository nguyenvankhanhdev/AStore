<div class="header">
    <div class="header-body">
        <div class="container flex-center">
            <div class="header-menu-toggle" style="display: none">
                <i class="ic-menu"></i>
            </div>
            <div class="header-logo">
                <a href="{{ route('products.index') }}">
                    <img src="/frontend/asset/img/logoAstore.jpg" alt="logo">
                </a>
            </div>

            <div class="header-search col-sm-12">
                <form method="GET" action="{{ route('products.search') }}">
                    <div class="form-group">
                        <div class="form-search form-search-sm">
                            <span class="form-search-icon m-r-4"><i class="ic-search ic-sm"></i></span>
                            <input class="form-search-input m-r-8" type="text" name="search" placeholder="Bạn đang tìm sản phẩm, tin tức, workshop..." value="{{ request()->input('search') }}">
                            <span class="form-search-icon form-search-clear"><i class="ic-close-thin ic-sm"></i></span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="header-right">
                <div class="header-user">
                    <a href="{{ auth()->check() ? route('admin.dashboard.index') : route('login') }}">
                        <div class="user-info flex text-grayscale-300">
                            <span class="form-cart-icon m-r-8"><i class="ic-user-2"></i></span>
                            <div class="f-s-ui-14">
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @else
                                    Đăng nhập
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                <div class="header-cart">
                    <a href="{{ route('cart.index') }}">
                        <div class="c-cart">
                            <span class="form-cart-icon m-r-8">
                                <span class="count">
                                    @if (Auth::check())
                                        {{ \App\Models\Carts::getCountCart(Auth::id()) }}
                                    @else
                                        0
                                    @endif
                                </span>
                                <i class="ic-cart"></i>
                            </span>
                            <div class="f-s-ui-14">Giỏ hàng</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="hd-mb header-search" style="display: none">
            <form method="GET" action="{{ route('products.search') }}">
                <div class="form-group">
                    <div class="form-search form-search-sm">
                        <span class="form-search-icon m-r-4"><i class="ic-search ic-sm"></i></span>
                        <input class="form-search-input m-r-8" type="text" name="search" placeholder="Bạn đang tìm sản phẩm, tin tức, workshop..." value="{{ request()->input('search') }}">
                        <span class="form-search-icon form-search-clear"><i class="ic-close-thin ic-sm"></i></span>
                    </div>
                </div>
            </form>
        </div>

        <div class="header-bot">
            <div class="container">
                <div class="header-item">
                    <ul class="flex text-center">
                        <li class="b-b-600"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="b-b-600"><a href="{{ route('products.category', ['categories' => 'iphone']) }}">iPhone</a></li>
                        <li class="b-b-600"><a href="{{ route('products.category', ['categories' => 'ipad']) }}">iPad</a></li>
                        <li class="b-b-600"><a href="{{ route('products.category', ['categories' => 'macbook']) }}">Macbook</a></li>
                        <li class="b-b-600"><a href="{{ route('products.category', ['categories' => 'apple-watch']) }}">Apple Watch</a></li>
                        <li class="b-b-600"><a href="{{ route('products.category', ['categories' => 'phu-kien-linh-kien']) }}">Phụ Kiện - Linh Kiện</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.header-menu-toggle').addEventListener('click', function () {
        document.querySelector('.header-bot').classList.toggle('show');
    });

    document.addEventListener('click', function (event) {
        const menu = document.querySelector('.header-bot');
        const toggle = document.querySelector('.header-menu-toggle');
        if (!menu.contains(event.target) && !toggle.contains(event.target)) {
            menu.classList.remove('show');
        }
    });


</script>

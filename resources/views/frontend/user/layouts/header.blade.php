<div class="header">
    <div class="header-body">
        <div class="container flex-center">
            <div class="header-logo"><a href="{{ route('products.index') }}"><img
                        src="/frontend/asset/img/logo-fstu-aar.png" alt="logo"></a>
            </div>

            <div class="header-search">
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
            <div class="header-user"><a
                    href="{{ auth()->check() ? route('admin.dashboard.index') : route('login') }}">
                    <div class="user-info flex text-grayscale-300"><span class="form-cart-icon m-r-8"><i
                                class="ic-user-2"></i></span>
                        <div class="f-s-ui-14">
                            @if (auth()->check())
                                @if (auth()->user()->role === 'user')
                                    {{ auth()->user()->name }}
                                @else
                                    {{ auth()->user()->name }}
                                @endif
                            @else
                                {{ 'Đăng nhập' }}
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            <div class="header-cart">
                <a href="{{ route('cart.index') }}">
                    <div class="c-cart"><span class="form-cart-icon m-r-8"><span class="count">
                                @if (Auth::check())
                                    {{ \App\Models\Carts::getCountCart(Auth::id()) }}
                                @else
                                    0
                                @endif


                            </span><i class="ic-cart"></i></span>
                        <div class="f-s-ui-14">Giỏ hàng</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="header-bot">
        <div class="container">
            <div class="header-item">
                <ul class="flex text-center">
                    <li><a href="{{ route('products.category', ['categories' => 'iphone']) }}">iPhone</a></li>
                    <li><a href="{{ route('products.category', ['categories' => 'ipad']) }}">iPad</a></li>
                    <li><a href="{{ route('products.category', ['categories' => 'macbook']) }}">Macbook</a></li>
                    <li><a href="{{ route('products.category', ['categories' => 'apple-watch']) }}">Apple Watch</a></li>
                    {{-- <li><a>Phụ kiện</a></li>
                    <li><a>Tin tức - Thủ thuật</a></li> --}}
                    <li><a href="{{ route('products.category', ['categories' => 'phu-kien-linh-kien']) }}">Phụ Kiện-Linh Kiện</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

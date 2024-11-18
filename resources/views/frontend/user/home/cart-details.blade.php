@extends('frontend.user.layouts.master')

@section('content')
    <div class="c-cart bg-gray-100 footer-off">
        <div class="container">
            <div class="c-cart__wrap">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="link" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                            </svg>
                            Tiếp tục mua hàng</a></li>

                </ol>

                @php
                    $countcarts = App\Models\Carts::getCountCart(Auth::user()->id);
                    echo '<script>
                        var countCarts = "' . json_encode($countcarts) . '";
                    </script>';
                @endphp
                <div class="card">
                    <div class="card-title">Có {{ count($carts) }} sản phẩm trong giỏ hàng<span
                            class="c-modal--close js-modal__close"></span>
                    </div>
                    <div class="card-body">
                        <div class="c-cart__block">
                            @foreach ($carts as $cart)
                                <div class="c-cart__product" data-productid=""
                                    data-variantcolorid="{{ $cart->variant_color->id }}"
                                    data-discount="{{ $cart->variant_color->offer_price }}">
                                    <div class="product-cart">
                                        <div class="product-cart__img">
                                            <div
                                                class="absolute top-1 left-1 flex h-6 w-6 items-center justify-center rounded-md bg-white">
                                                <label
                                                    class="ant-checkbox-wrapper ant-checkbox-wrapper-checked css-bvvl68 css-10ed4xt">
                                                    <span class="ant-checkbox css-10ed4xt ant-checkbox-checked">
                                                        <input type="checkbox" class="ant-checkbox-input"
                                                            data-price="{{ $cart->variant_color->price - $cart->variant_color->offer_price }}">
                                                        <span class="ant-checkbox-inner"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <img src="{{ $cart->product->image }} " alt="{{ $cart->product->name }}">
                                        </div>
                                        <div class="product-cart__info">
                                            <div class="product-cart__inside">
                                                <a class="product-cart__line" href=""></a>
                                                <h3 class="product-cart__name product-cart__name--lg name-product-split">
                                                    {{ $cart->product->name }}
                                                    @php
                                                        if ($cart->variant_color->variant->storage->GB === '0GB') {
                                                            echo '';
                                                        } else {
                                                            echo ' - ' . $cart->variant_color->variant->storage->GB;
                                                        }
                                                    @endphp
                                                </h3>
                                                <div class="product-cart__line" style="display: flex"></div>
                                                <p style="margin-left: 2px">Màu sắc:
                                                    <span>{{ $cart->variant_color->color->name }}</span><i
                                                        class="ic-check ic-sm m-l-8"></i>
                                                </p>
                                                <div class="product-cart__line" style="display: flex"></div>

                                                <div class="product-cart__line"></div>
                                            </div>
                                            <div class="product-cart__quality">
                                                <div class="product-cart__quality__wrap">
                                                    <button class="cs-btn btn js--btn-minus" type="button"
                                                        data-cart-id="{{ $cart->id }}"><span
                                                            class="ic-minus"></span></button>
                                                    <input class="cs-input-cart" type="text" readonly
                                                        value="{{ $cart->quantity }}" id="quantity-{{ $cart->id }}">
                                                    <button class="cs-btn btn js--btn-plus" type="button"
                                                        data-cart-id="{{ $cart->id }}"><span
                                                            class="ic-plus"></span></button>
                                                </div>
                                                <div class="product-cart__remove delete-item">
                                                    <a href="{{ route('cart.destroy', $cart->id) }}"
                                                        style="color: #939ca3">
                                                        <i class="ic-trash f-s-p-12 ic-xs m-r-4"></i>Xoá
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-cart__price">
                                                <div class="cs-price cs-price--main" id="cs-price--main">
                                                    {{ number_format($cart->variant_color->price - $cart->variant_color->offer_price, 0, ',', '.') }}
                                                    ₫
                                                </div>
                                                <div class="cs-price cs-price--sub" style="text-decoration: line-through">
                                                    {{ number_format($cart->variant_color->price, 0, ',', '.') }} ₫</div>
                                                <div class="fst-cart-tag m-t-4">
                                                    <div class="cs-price cs-price--main f-w-500" id="discountAll">
                                                        -{{ number_format($cart->variant_color->offer_price, 0, ',', '.') }}
                                                        ₫
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="c-cart__center">
                                <div class="c-cart__coupon">
                                    <div class="c-cart__title">Mã giảm giá</div>
                                    <div class="cs-input-group m-t-8">
                                        <div class="form-group">
                                            <input class="form-input form-input-sm" type="text" id="coupon_code"
                                                placeholder="Nhập mã giảm giá">
                                        </div>
                                        <div class="apply-btn m-l-8">
                                            <a class="btn btn-link btn-sm" id="coupon_form"
                                                href="{{ route('apply-coupon') }}">Áp dụng</a>
                                        </div>
                                    </div>

                                    <div class="c-cart-badge m-t-8" id="coupon-badge">
                                        <a class="badge badge-grayscale badge-xxxs badge-xxs badge-close m-r-8 m-b-8"
                                            href="{{ route('remove-coupon') }}">
                                            <i class="ic-tag m-r-4"></i>
                                            <span id="getcoupon_code">
                                                @if (Session::has('coupon'))
                                                    {{ Session::get('coupon')['coupon_code'] }}
                                                @endif

                                                @if (Session::has('coupon'))
                                                    <script>
                                                        var cp = @json(Session::get('coupon'));
                                                        console.log(cp);
                                                    </script>
                                                @endif
                                            </span>
                                            <span class="btn btn-icon-single btn-square btn-grayscale btn-xs">
                                                <i class="ic-close f-s-ui-16"></i>
                                            </span>
                                        </a>
                                    </div>

                                </div>
                                <div class="c-cart__total">
                                    <p class="text-normal"><span>Tổng tiền:</span><span
                                            class="total_price"id="amount"></span></p>
                                    <p class="text-normal"><span>Giảm: </span><span id="discount"></span></p>
                                    <p class="text-normal"><span>Điểm tích lũy: </span><span class="point"
                                            style="font-size: 15px;

                                        padding: 0px 7px;
                                        background: #d32424;
                                        border-radius: 10px;
                                        color: white;
                                    }"
                                            id="point"></span></p>
                                    <p class="text--lg"><span class="text-size--lg">Cần thanh toán:</span><span
                                            class="re-price f-w-500 f-s-p-16 re-red"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="c-cart__group-customer p-x-24 p-t-16">
                            <div class="c-cart__title">Thông tin khách hàng</div>
                            <div class="c-cart__form__block m-t-8">
                                <!-- form user-->
                                <div class="form-customer">
                                    <div class="c-cart__form__line m-t-8">
                                        <div class="radio margin-right-2x">
                                            <input id="radio-cart1" readonly="" type="radio" name="gender"
                                                value="Anh" checked>
                                            <label for="radio-cart1">Anh</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio-cart2" readonly="" type="radio" name="gender"
                                                value="Chị">
                                            <label for="radio-cart2">Chị</label>
                                        </div>
                                    </div>
                                    <div class="c-cart__form__line m-t-8">
                                        <div class="box-namecus">
                                            <div class="form-group"><input
                                                    class="cs-input form-input-md cs-input-size--full txt-Email"
                                                    type="text" placeholder="Nhập họ và tên" name="firstname"
                                                    value=""></div>
                                            <div class="feedback error-name">
                                                <div class="stack"><span class="ic-minus-circled"></span>
                                                    <div id="tx-err-Name">Vui lòng nhập thông tin còn thiếu!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-phonecus">
                                            <div class="form-group"><input
                                                    class="cs-input form-input-md cs-input-size--full txt-Email"
                                                    type="text" placeholder="Nhập số điện thoại" name="phonenumber"
                                                    value=""></div>
                                            <div class="feedback error-email">
                                                <div class="stack"><span class="ic-minus-circled"></span>
                                                    <div id="tx-err-Phone">Vui lòng nhập thông tin còn thiếu!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-cart__form__line m-t-8"><input
                                            class="cs-input form-input-md cs-input-size--full txt-Email" type="text"
                                            placeholder="Nhập email" name="email" value=""></div>
                                    <div class="feedback">
                                        <div class="stack"><span class="ic-minus-circled"></span>
                                            <div id="tx-err-Phone">Vui lòng nhập thông tin còn thiếu!</div>
                                        </div>
                                    </div>
                                    <div class="feedback error-email">
                                        <div class="stack"><span class="ic-minus-circled"></span>
                                            <div id="tx-err-Email">Kiểm tra lại thông tin!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-cart__form__line form-delivery m-x-24 m-y-16">
                                <div class="c-cart__title">Chọn hình thức giao hàng</div>
                                <div class="c-cart__payment m-t-8">
                                    <div class="c-cart__payment__wrap js--cart__tabs js-cart__methodship">
                                        <div class="radio margin-right-2x"><input
                                                class="js--tabs-child paymentship js-input-checked" id="radio-cart3"
                                                type="radio" name="shipping" data-toggle="c-cart__shiphome"
                                                readonly="" value="1" data-name="athome"><label
                                                for="radio-cart3">Giao hàng tận nơi, miễn phí</label></div>
                                        <div class="radio"><input class="js--tabs-child paymentship js-input-checked"
                                                id="radio-cart4" type="radio" name="shipping"
                                                data-toggle="c-cart__shipshop" readonly="" value="2"><label
                                                for="radio-cart4">Địa chỉ hiện có</label></div>
                                        <div class="feedback error-ship">
                                            <div class="stack"><span class="ic-minus-circled"></span>
                                                <div id="tx-err-Ship">Vui lòng chọn hình thức giao hàng</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="home-delivery js-home-delivery">
                                        <div class="c-cart__payment__tab-item js--cart__tabs-item" id="c-cart__shipcity">
                                            <div class="c-cart__payment-block">
                                                <div class="c-cart__payment__inner">
                                                    <div class="c-dropdown c-dropdown--col">
                                                        <div class="c-dropdown js-dropdown-open">
                                                            <div class="group-dropdown">
                                                                <div class="c-dropdown-button c-dropdown-button--lg"
                                                                    data-name="" id="province-dropdown"> Chọn Tỉnh thành
                                                                </div><span class="ic-arrow-select ic-dropdown"></span>
                                                            </div>
                                                            <div class="c-dropdown-menu">
                                                                <div class="c-dropdown-menu__top">
                                                                    <div class="c-dropdown-menu__search">
                                                                        <div class="cs-input-group cs-input-group--search">
                                                                            <span class="ic-search cs-input-search"></span>
                                                                            <input class="cs-input js-input-typing"
                                                                                id="search-province" type="text"
                                                                                placeholder="Nhập địa chỉ"
                                                                                autocomplete="none"><span
                                                                                class="form-search-icon form-search-clear close-btn js-form-clear open"
                                                                                data-name="delete"><i
                                                                                    class="ic-close ic-sm"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-dropdown-menu__wrapper m-t-4"
                                                                    id="province-list">
                                                                    @foreach ($provinces as $province)
                                                                        <a class="item-region" id="province"
                                                                            data-id="{{ $province->id }}">{{ $province->name }}</a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="feedback error-general">
                                                            <div class="stack" id="provinceError"><span
                                                                    class="ic-minus-circled"></span>
                                                                Thông tin bắt buộc
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="c-dropdown c-dropdown--col">
                                                        <div class="c-dropdown js-dropdown-open">
                                                            <div class="group-dropdown">
                                                                <div class="c-dropdown-button c-dropdown-button--lg"
                                                                    data-name="" id="district-dropdown"> Chọn Quận/Huyện
                                                                </div><span class="ic-arrow-select ic-dropdown"></span>
                                                            </div>
                                                            <div class="c-dropdown-menu">
                                                                <div class="c-dropdown-menu__top">
                                                                    <div class="c-dropdown-menu__search">
                                                                        <div class="cs-input-group cs-input-group--search">
                                                                            <span class="ic-search cs-input-search"></span>
                                                                            <input class="cs-input js-input-typing"
                                                                                id="search-district" type="text"
                                                                                placeholder="Nhập địa chỉ"
                                                                                autocomplete="none"><span
                                                                                class="form-search-icon form-search-clear close-btn js-form-clear open"
                                                                                data-name="delete"><i
                                                                                    class="ic-close ic-sm"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-dropdown-menu__wrapper m-t-4"
                                                                    id="district-list">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="feedback error-general">
                                                            <div class="stack"><span
                                                                    class="ic-minus-circled"></span>Thông tin bắt buộc
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-cart__payment__tab-item js--cart__tabs-item" id="c-cart__shiphome">
                                            <div class="c-cart__payment-block">
                                                <div class="c-cart__payment__inner">
                                                    <div class="c-cart__full col-ward m-t-8">
                                                        <div class="c-dropdown js-dropdown-open">
                                                            <div class="group-dropdown">
                                                                <div class="c-dropdown-button c-dropdown-button--lg"
                                                                    data-name="" id="ward-dropdown"> Chọn Phường/Xã
                                                                </div><span class="ic-arrow-select ic-dropdown"></span>
                                                            </div>
                                                            <div class="c-dropdown-menu">
                                                                <div class="c-dropdown-menu__top">
                                                                    <div class="c-dropdown-menu__search">
                                                                        <div class="cs-input-group cs-input-group--search">
                                                                            <span class="ic-search cs-input-search"></span>
                                                                            <input class="cs-input js-input-typing"
                                                                                id="search-ward" type="text"
                                                                                placeholder="Nhập địa chỉ"
                                                                                autocomplete="none">
                                                                            <span
                                                                                class="form-search-icon form-search-clear close-btn js-form-clear open"
                                                                                data-name="delete"><i
                                                                                    class="ic-close ic-sm">
                                                                                </i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-dropdown-menu__wrapper m-t-4"
                                                                    id="ward-list">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="feedback error-ward margin-top-empty m-t-8">
                                                            <div class="stack stack--danger"><span
                                                                    class="ic-minus-circled"></span>Thông tin bắt buộc
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="c-cart__full m-t-8"><input
                                                            class="cs-input form-input-sm is-invalid" type="text"
                                                            name="address" placeholder="Nhập địa chỉ*">
                                                        <div class="feedback error-general m-t-8">
                                                            <div class="stack"><span
                                                                    class="ic-minus-circled"></span>Thông tin bắt buộc
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-cart__payment__tab-item js--cart__tabs-item" id="c-cart__moreinfo">
                                            <div class="c-cart__payment-block">
                                                <div class="c-cart__payment__line m-t-16">
                                                    <div class="form-group m-b-8">
                                                        <textarea class="form-input form-input-md" rows="3" placeholder="Ghi chú yêu cầu"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-delivery js-store-delivery">

                                        <div class="fst__address m-t-8">
                                            <div class="fst__address__inner user-location p-y-8 p-l-16">
                                                <ul>
                                                    @foreach ($user_address as $address)
                                                        <li class="p-y-8 p-x-16">
                                                            <div class="radio address-radio"><input id="location"
                                                                    type="radio" value="1"
                                                                    name="radio-location11"> <label
                                                                    class="address-info p-r-8" for="location">
                                                                    <div class="user-name"
                                                                        data-address={{ $address->id }}>
                                                                        {{ $address->address }}, {{ $address->ward }},
                                                                        {{ $address->district }}, {{ $address->province }}
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="c-cart__form">
                                <div class="c-cart__form__block">
                                    <div class="c-cart__title">Chọn hình thức thanh toán</div>
                                    <ul class="c-cart__form__list c-cart__type-payment js--cart__tabs p-t-8 p-b-16">
                                        <li class="cls-list-payment">
                                            <div class="radio paymentmethod">
                                                <input class="js--tabs-child" id="pay1" type="radio"
                                                    data-promotion="" name="cart2" value="1" checked=""
                                                    data-payment-id="1">
                                                <label for="pay1">Trả tiền mặt khi nhận hàng</label>
                                            </div>
                                        </li>
                                        <li class="cls-list-payment" data-name="open-bank-vnpay">
                                            <div class="radio paymentmethod"><input class="js--tabs-child" id="pay2"
                                                    type="radio" data-promotion="VNPAYATM" name="cart2"
                                                    value="2"><label for="pay2">ATM nội địa/QR
                                                    CODE/Internet Banking (Thanh toán qua VNPAY)</label></div>
                                            <div class="c-cart__form__list__expand js--cart__tabs-item group-bank-vnpay"
                                                id="se3t4">
                                                <div class="cs-suggest__wrapper js--search-product">
                                                    <div class="c-cart__searchBox">
                                                        <div class="cs-input-group cs-input-group--search"><input
                                                                class="cs-input form-input-sm cs-input--lg js--input-w-product js-input-typing js-input-open"
                                                                type="text" placeholder="Nhập ngân hàng"><span
                                                                class="ic-search cs-input-search"></span><span
                                                                class="form-search-icon form-search-clear close-btn js-form-clear open"><i
                                                                    class="ic-close ic-sm"></i></span></div>
                                                    </div>
                                                </div>
                                                <div class="c-cart__select m-t-8" id="list-bank-item">
                                                    <div class="c-cart__select__item" id="VNPay" data-payment-id="2"
                                                        data-name="vnpay" value="VNPay"><img
                                                            src="{{ asset('uploads/vnpay.jpg') }}" alt="vnpay">
                                                    </div>
                                                    <div class="c-cart__select__item" id="Momo" data-payment-id="3"
                                                        data-name="momo" value="Momo"><img
                                                            src="{{ asset('uploads/momo.png') }}" alt="Momo">
                                                    </div>
                                                    <div class="c-cart__select__item" id="zalopay" data-payment-id="8"
                                                        data-name="momo" value="Momo"><img
                                                            src="{{ asset('uploads/zalopay.png') }}" alt="zalopay">
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                        <li class="cls-list-payment" data-name="open-bank-visa">
                                            <div class="radio paymentmethod"><input class="js--tabs-child" id="pay3"
                                                    type="radio" data-promotion="" name="cart2"
                                                    value="3"><label for="pay3">Thanh toán bằng thẻ quốc tế
                                                    Paypal,
                                                    Stripe, Razorpay</label></div>
                                            <div class="c-cart__form__list__expand js--cart__tabs-item group-bank-visa"
                                                id="se3t6">
                                                <div class="c-cart__select" id="listvisa">
                                                    <div class="c-cart__select__item" data-name="Paypal"
                                                        data-payment-id ="4" value="Visa">
                                                        <img src="https://banner2.cleanpng.com/20190313/wce/kisspng-logo-paypal-x-com-image-brand-1713901610285.webp"
                                                            alt="">
                                                    </div>
                                                    <div class="c-cart__select__item" data-name="stripe"
                                                        data-payment-id="5" value="Mastercard"><img
                                                            src="https://duyalex.com/wp-content/uploads/2018/10/social.png"
                                                            alt="">
                                                    </div>
                                                    <div class="c-cart__select__item" data-name="razorpay"
                                                        data-payment-id ="6" value="">
                                                        <img src="https://marketplace.cs-cart.com/images/detailed/4/logo_black.png"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="cs-toast cs-toast--success" id="box-textvisa"
                                                    style="display: none"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <form id="checkout">
                                <div class="c-cart__submit">
                                    <button class="btn btn-xl btn-link" type="submit" id="btnCompleteOrder checkout"
                                        style="display: inline-block">HOÀN TẤT ĐẶT HÀNG</button><button
                                        class="btn btn-xl btn-link" id="btnInstallment" style="display: none">MUA TRẢ
                                        GÓP</button>
                                    <p>Bằng cách đặt hàng, bạn đồng ý với <a class="re-link--gray"
                                            href="https://fptshop.com.vn/tos" style="text-decoration: underline">Điều
                                            khoản
                                            sử dụng </a> của FStudio by FPT</p>
                                </div>
                            </form>
                        </div>
                        <div class="ghslod-lg hide">
                            <div class="spinner spinner-primary spinner-big"><svg>
                                    <circle cx="50%" cy="50%" r="30"></circle>
                                </svg><span class="spinner-text">Đang cập nhật giỏ hàng...</span></div>
                        </div>
                    </div>
                    <div class="containerr">
                        <div class="text-section">
                            <h1>
                                Chưa có sản phẩm nào trong giỏ hàng
                            </h1>
                            <p>
                                Cùng mua sắm hàng ngàn sản phẩm tại FPTShop nhé!
                            </p>
                            <button style="margin-left: 100px;" class="shoping">
                                Mua hàng
                            </button>
                        </div>
                        <div class="image-section">
                            <img alt="Illustration of a shopping cart with small people around it" height="300"
                                src="https://storage.googleapis.com/a1aa/image/7HbH5YVfanXQba48flDo4wZwib9owPw2zwTJ8kGONl66JQoTA.jpg"
                                width="400" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function filterDropdown(inputId, listId) {
            $(inputId).on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $(listId + ' .item-region').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        }
        filterDropdown('#search-province', '#province-list');
        filterDropdown('#search-district', '#district-list');
        filterDropdown('#search-ward', '#ward-list');

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            if (countCarts === '0') {
                $('.card-title').hide();
                $('.card-body').hide();
                $('.breadcrumb').hide();
                $('.containerr').show();
            } else {
                $('.card-title').show();
                $('.card-body').show();
                $('.breadcrumb').show();
                $('.containerr').hide();
            }

            $('.shoping').on('click', function() {
                window.location.href = "{{ route('home') }}";
            })


            $(document).on('click', '#province-list .item-region', function(e) {
                e.preventDefault();
                var provinceId = $(this).data('id');
                $.ajax({
                    url: '{{ url('get-districts') }}/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district-list').html('');
                        $.each(data, function(key, value) {
                            $('#district-list').append(
                                '<a class="item-region region-district" id="district_id" data-id="' +
                                value.id +
                                '" >' + value.name + '</a>'
                            );
                        });

                    }
                });
            });

            $(document).on('click', '#district-list .item-region', function(e) {
                e.preventDefault();
                var districtId = $(this).data('id');
                $('#ward-list').html(''); // Clear ward list
                $.ajax({
                    url: '{{ url('get-wards') }}/' + districtId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ward-list').html('');
                        $.each(data, function(key, value) {
                            $('#ward-list').append(
                                '<a class="item-region region-ward" data-id="' +
                                value.id + '" >' + value.name + '</a>');
                        });
                    }
                });
            });

            $(document).on('click', '.js-dropdown-open .item-region', function(e) {
                e.preventDefault();
                var wrapperItem = $(this).closest('.c-dropdown-menu');
                var getItem = wrapperItem.find('.c-dropdown-menu__wrapper .item-region');
                var fillValue = $(this).closest('.js-dropdown-open').find('.c-dropdown-button');

                getItem.removeClass('active');
                $(this).addClass('active');
                fillValue.text($(this).text());
                wrapperItem.removeClass('open');
            });

            var displayCoupon = $('#coupon-badge');
            var getcoupon_code = $('#getcoupon_code');


            if (getcoupon_code.text().trim() === '') {
                displayCoupon.hide();
            } else {
                displayCoupon.show();
            }

            var cb1 = '';
            if (typeof cp !== 'undefined' && cp) {
                cb1 = cp;
                console.log(cp);

            }

            var checkboxes = $('.ant-checkbox-input');
            var totalPriceElement = $('.re-price');
            var discountElement = $('#discount');
            var totalAmountElement = $('#amount');

            function updateTotal() {
                var totalPrice = 0;
                var totalDiscount = 0;
                var point = 0;
                checkboxes.each(function() {
                    var checkbox = $(this);
                    var productId = checkbox.closest('.c-cart__product').data('variantcolorid');
                    localStorage.setItem('checkbox-' + productId, checkbox.is(':checked'));
                    var productElement = $('.c-cart__product[data-variantcolorid="' + productId + '"]');
                    var findValues = productElement.find('.js--btn-minus').data('cart-id');

                    if (checkbox.is(':checked')) {
                        var price = parseFloat(checkbox.data('price')) || 0;
                        var discount = parseFloat(checkbox.data('discount')) || 0;
                        var quantityElement = $('#quantity-' + findValues);
                        var quantity = quantityElement.length ? parseFloat(quantityElement.val()) || 0 : 0;
                        totalPrice += price * quantity;

                    }
                });
                totalAmountElement.text(totalPrice.toLocaleString('vi-VN') + ' ₫');

                if (cb1.discount_type === 'percent') {
                    totalDiscount = totalPrice * (cb1.discount / 100);
                    totalPrice -= (totalPrice * cb1.discount / 100);
                    totalPriceElement.text(totalPrice.toLocaleString('vi-VN') + ' ₫');

                } else if (cb1.discount_type === 'amount') {
                    totalDiscount = cb1.discount * 1000;
                    totalPrice = totalPrice - (cb1.discount * 1000);
                    totalPriceElement.text(totalPrice.toLocaleString('vi-VN') + ' ₫');
                } else {
                    totalPrice = totalPrice;
                    totalPriceElement.text(totalPrice.toLocaleString('vi-VN') + ' ₫');
                }

                point = totalPrice / 100000;
                $('#point').text("+ " + Math.floor(point) + " " + "điểm");
                discountElement.text('-' + totalDiscount.toLocaleString('vi-VN') + '₫');

            }


            checkboxes.each(function() {
                var checkbox = $(this);
                var productId = checkbox.closest('.c-cart__product').data('variantcolorid');
                var storedState = localStorage.getItem('checkbox-' + productId);
                if (storedState === 'true') {
                    checkbox.prop('checked', true);
                } else {
                    checkbox.prop('checked', false);
                }
            });

            checkboxes.on('change', updateTotal);
            updateTotal();



            $('.js--btn-minus').on('click', function(e) {
                e.preventDefault();
                var cartId = $(this).data('cart-id');
                var quantityInput = $('#quantity-' + cartId);
                var currentQuantity = parseInt(quantityInput.val()) || 1;

                if (currentQuantity > 1) {
                    currentQuantity--;
                    quantityInput.val(currentQuantity);

                    $.ajax({
                        url: "{{ route('cart.updateQuantity') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            cart_id: cartId,
                            quantity: currentQuantity
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                toastr.success(data.message);
                                updateTotal();

                            } else {
                                toastr.error(data.message);
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            });

            $('.js--btn-plus').on('click', function(e) {
                e.preventDefault();
                var cartId = $(this).data('cart-id');
                var quantityInput = $('#quantity-' + cartId);
                var currentQuantity = parseInt(quantityInput.val()) || 1;
                currentQuantity++;
                quantityInput.val(currentQuantity);

                $.ajax({
                    url: "{{ route('cart.updateQuantity') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        cart_id: cartId,
                        quantity: currentQuantity
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            updateTotal();

                        } else {
                            $('.js--btn-plus').prop('disabled', true);
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });


            $('#coupon_form').on('click', function(e) {
                e.preventDefault();
                let couponCode = $('#coupon_code').val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('apply-coupon') }}",
                    data: {
                        coupon_code: couponCode
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            displayCoupon.show();
                            getcoupon_code.text(data.coupon_code);
                            cb1 = data.coupon;
                            updateTotal();
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });


            $('.badge-close').on('click', function(e) {
                e.preventDefault();
                let display = $('#coupon-badge');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('remove-coupon') }}",
                    success: function(data) {
                        if (data.status === 'success') {
                            display.hide();
                            cb1 = '';
                            toastr.success(data.message);
                            updateTotal();

                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            var paymentMethod = 1;

            $('.c-cart__select__item').click(function() {
                $('.c-cart__select__item').removeClass('active');
                $(this).addClass('active');

                paymentMethod = $(this).data('payment-id');
                console.log('Selected payment ID:', paymentMethod);
            });
            var province = '',
                districtId = '',
                ward = '',
                deliveryTime = '',
                selectedProductIds = [],
                addressId = null;

            var checkboxes = $('.c-cart__product input[type="checkbox"]');

            $('.item-region').on('click', function() {
                province = $(this).text();
            });

            $(document).on('click', '#district-list .region-district', function() {
                districtId = $(this).text();
            });

            $(document).on('click', '#ward-list .region-ward', function() {
                ward = $(this).text();
            });

            $(document).on('click', '.dropdown-menu-wrapper a', function(e) {
                e.preventDefault();
                deliveryTime = $(this).find('span').text().trim();
                $(this).closest('.dropdown').find('.dropdown-button span').text(deliveryTime);
            });

            $('input[name="radio-location11"]').on('change', function() {
                if ($(this).is(':checked')) {
                    addressId = $(this).closest('.address-radio').find('.user-name').data('address');
                    console.log("Selected address ID: " + addressId);
                }
            });

            $("#checkout").on('click', function(e) {
                e.preventDefault();
                var firstname = $('input[name="firstname"]').val();
                var phonenumber = $('input[name="phonenumber"]').val();
                var email = $('input[name="email"]').val();
                var proAddress = $('input[name="address"]').val();
                var address = [];
                var info = [];
                var endMoney = $('.re-price').text();
                var point = $('#point').text().replace("+", "").replace("điểm", "").trim();
                var location = $('input[name="address-available"]:checked').val();
                var create_address = $('input[name="create-address"]:checked').val();

                if (addressId !== null) {
                    address.push(addressId);
                } else if (province && districtId && ward && proAddress) {
                    address.push(province, districtId, ward, proAddress);
                }
                endMoney = endMoney.replace('₫', '').replace(/\./g, '');
                info.push(firstname, phonenumber, email);
                checkboxes.each(function() {
                    var checkbox = $(this);
                    if (checkbox.is(':checked')) {
                        var productIds = checkbox.closest('.c-cart__product').data(
                            'variantcolorid');
                        selectedProductIds.push(productIds);
                    }
                });
                if (!paymentMethod) {
                    paymentMethod = 1;
                }
                if (!selectedProductIds.length || !paymentMethod || !firstname || !phonenumber || !email ||
                    !endMoney || (address.length === 0 && !location)) {
                    toastr.error("Vui lòng điền đầy đủ thông tin.");
                    return;
                }
                $.ajax({
                    method: 'POST',
                    url: "{{ route('checkout') }}",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                    },
                    data: {
                        _token: '{{ csrf_token() }}',
                        paymentMethod: paymentMethod,
                        info: info,
                        address: address,
                        total_amount: endMoney,
                        location: location,
                        point: point,
                        create_address: create_address,
                        productIds: selectedProductIds,
                        coupon_id: cb1.id,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            cb1 = '';
                            window.location.href = response.redirect;
                            toastr.success(response.message);



                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });


        });
    </script>
@endpush

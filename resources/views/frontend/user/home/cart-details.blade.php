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
                <div class="card">
                    <div class="card-title">Có {{ count($carts) }} sản phẩm trong giỏ hàng<span
                            class="c-modal--close js-modal__close"></span>
                    </div>
                    <div class="card-body">
                        <div class="c-cart__block">
                            @foreach ($carts as $cart)
                                @php
                                    $product = $products->firstWhere('id', $cart->pro_id);
                                @endphp
                                <div class="c-cart__product" data-variant="{{ $product->variant }}" data-producttype="1"
                                    data-productid="{{ $product->id }}">
                                    <div class="product-cart">
                                        <div class="product-cart__img">
                                            <div
                                                class="absolute top-1 left-1 flex h-6 w-6 items-center justify-center rounded-md bg-white">
                                                <label
                                                    class="ant-checkbox-wrapper ant-checkbox-wrapper-checked css-bvvl68 css-10ed4xt">
                                                    <span class="ant-checkbox css-10ed4xt ant-checkbox-checked">
                                                        <input type="checkbox" class="ant-checkbox-input" value=""
                                                            checked="">
                                                        <span class="ant-checkbox-inner"></span>
                                                    </span>
                                                </label>
                                            </div>
                                            <img src="{{ $product->image }} " alt="{{ $product->name }}">
                                        </div>
                                        <div class="product-cart__info">
                                            <div class="product-cart__inside">
                                                <a class="product-cart__line" href=""></a>
                                                @php
                                                    $product = $products->where('id', $cart->pro_id)->first();
                                                    $variant = $product->variants
                                                        ->where('id', $cart->variant_id)
                                                        ->first();
                                                @endphp
                                                @if ($product && $variant)
                                                    <h3
                                                        class="product-cart__name product-cart__name--lg name-product-split">
                                                        {{ $product->name }} - {{ $variant->storage->GB }}
                                                    </h3>
                                                @endif
                                                <div class="product-cart__line" style="display: flex"></div>
                                                <p style="margin-left: 2px">Màu sắc:
                                                    <span>{{ $variant->color->color }}</span><i
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
                                                    <input class="cs-input-cart" type="text" readonly value="{{ $cart->quantity }}" id="quantity-{{ $cart->id }}">
                                                    <button class="cs-btn btn js--btn-plus" type="button"
                                                        data-cart-id="{{ $cart->id }}"><span
                                                            class="ic-plus"></span></button>
                                                </div>
                                                <div class="product-cart__remove delete-item">
                                                    <a href="{{ route('cart.destroy', $product->id) }}">
                                                        <i class="ic-trash f-s-p-12 ic-xs m-r-4"></i>Xoá
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-cart__price">
                                                <div class="cs-price cs-price--main" id="cs-price--main">
                                                    @php
                                                        $variant = $product->variants
                                                            ->where('id', $cart->variant_id)
                                                            ->first();
                                                    @endphp
                                                    {{ number_format(($variant->price - $variant->offer_price), 0, ',', '.') }}₫
                                                </div>
                                                <div class="cs-price cs-price--sub" style="text-decoration: line-through">
                                                    {{ number_format($variant->price, 0, ',', '.') }}</div>
                                                <div class="fst-cart-tag m-t-4">
                                                        <div class="cs-price cs-price--main f-w-500" id="discountAll">-{{ number_format($variant->offer_price, 0, ',', '.') }}</div>
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
                                        <div class="feedback error-voucher">
                                            <div class="stack"></div><span class="ic-minus-circled"></span>
                                            <p>Nhập voucher để áp dụng</p>
                                        </div>
                                        <div class="apply-btn m-l-8">
                                            <a class="btn btn-link btn-sm" id="coupon_form"
                                                href="{{ route('apply-coupon') }}">Áp dụng</a>
                                        </div>
                                    </div>
                                    <p class="text-inValid-success m-t-8">Áp dụng thành công giảm 1.500.000₫ </p>
                                    <p class="text-inValid-failed m-t-8">Mã giảm giá không hợp lệ</p>
                                    <div class="c-cart-badge m-t-8"><a
                                            class="badge badge-grayscale badge-xxxs badge-xxs badge-close m-r-8 m-b-8"
                                            href="#"><i class="ic-tag m-r-4"></i><span>MACBOOK16</span><span
                                                class="btn btn-icon-single btn-square btn-grayscale btn-xs"><i
                                                    class="ic-close f-s-ui-16"></i></span></a>
                                    </div>
                                </div>
                                <div class="c-cart__total">
                                    <p class="text-normal"><span>Tổng tiền:</span><span class="total_price" id="amount"></span></p>
                                    <p class="text-normal"><span>Giảm:</span><span id="discount"></span></p>
                                    {{-- {{ number_format($variant->offer_price * $cart->quantity, 0, ',', '.') }} --}}
                                    <p class="text--lg"><span class="text-size--lg">Cần thanh toán:</span><span class="re-price f-w-500 f-s-p-16 re-red"></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="c-cart__group-customer p-x-24 p-t-16">
                            <div class="c-cart__title">Thông tin khách hàng</div>
                            <div class="c-cart__form__block m-t-8">
                                <!-- form user-->
                                <div class="form-customer">
                                    <div class="c-cart__form__line m-t-8">
                                        <div class="radio margin-right-2x"><input id="radio-cart1" readonly=""
                                                type="radio" name="gender" value="Anh" checked=""><label
                                                for="radio-cart1">Anh</label></div>
                                        <div class="radio"><input id="radio-cart2" readonly="" type="radio"
                                                name="gender" value="Chị"><label for="radio-cart2">Chị</label></div>
                                    </div>
                                    <div class="c-cart__form__line m-t-8">
                                        <div class="box-namecus">
                                            <div class="form-group"><input
                                                    class="cs-input form-input-md cs-input-size--full txt-Email"
                                                    type="text" placeholder="Nhập họ và tên" value=""></div>
                                            <div class="feedback error-name">
                                                <div class="stack"><span class="ic-minus-circled"></span>
                                                    <div id="tx-err-Name">Vui lòng nhập thông tin còn thiếu!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-phonecus">
                                            <div class="form-group"><input
                                                    class="cs-input form-input-md cs-input-size--full txt-Email"
                                                    type="text" placeholder="Nhập số điện thoại" value=""></div>
                                            <div class="feedback error-email">
                                                <div class="stack"><span class="ic-minus-circled"></span>
                                                    <div id="tx-err-Phone">Vui lòng nhập thông tin còn thiếu!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-cart__form__line m-t-8"><input
                                            class="cs-input form-input-md cs-input-size--full txt-Email" type="text"
                                            placeholder="Nhập email" value=""></div>
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
                                                type="radio" name="deli" data-toggle="c-cart__shiphome"
                                                readonly="" value="1" data-name="athome"><label
                                                for="radio-cart3">Giao hàng tận nơi, miễn phí</label></div>
                                        <div class="radio"><input class="js--tabs-child paymentship js-input-checked"
                                                id="radio-cart4" type="radio" name="deli"
                                                data-toggle="c-cart__shipshop" readonly="" value="2"><label
                                                for="radio-cart4">Nhận tại cửa hàng FPT Shop</label></div>
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
                                                                            <span
                                                                                class="ic-search cs-input-search"></span><input
                                                                                class="cs-input js-input-typing"
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
                                                                        <a class="item-region"
                                                                            data-id="{{ $province->id }}">{{ $province->name }}</a>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="feedback error-general">
                                                            <div class="stack"><span
                                                                    class="ic-minus-circled"></span>Thông tin bắt buộc
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
                                                                            <span
                                                                                class="ic-search cs-input-search"></span><input
                                                                                class="cs-input js-input-typing"
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
                                                                    <!-- Districts will be loaded here by AJAX -->
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
                                                            name="" id="" placeholder="Nhập địa chỉ*">
                                                        <div class="feedback error-general m-t-8">
                                                            <div class="stack"><span
                                                                    class="ic-minus-circled"></span>Thông tin bắt buộc
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-cart__payment__line m-t-8">
                                                    <div class="text--normal text-size--lg">Thời gian giao hàng:</div>
                                                    <div class="c-dropdown">
                                                        <div class="dropdown js-dropdown dropdown-undefined">
                                                            <div class="dropdown-button"><span>Chỉ giao giờ hành
                                                                    chính</span><i class="ic-arrow-select ic-sm"></i>
                                                            </div>
                                                            <div class="dropdown-menu full-size">
                                                                <div class="dropdown-menu-wrapper"><a class="active"
                                                                        href=""> <span>Chỉ giao giờ hành
                                                                            chính</span><i class="ic-check ic-sm m-l-8">
                                                                        </i></a><a href=""><span>Tất cả các
                                                                            ngày trong tuần</span></a></div>
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
                                        <div class="c-cart__payment__tab-item js--cart__tabs-item" id="c-cart__shipcity">
                                            <div class="c-cart__payment-block">
                                                <div class="c-cart__payment__inner">
                                                    <div class="c-dropdown c-dropdown--col m-r-8">
                                                        <div class="c-dropdown js-dropdown-open">
                                                            <div class="group-dropdown">
                                                                <div class="c-dropdown-button c-dropdown-button--lg"
                                                                    data-name=""> Chọn Tỉnh thành
                                                                </div><span class="ic-arrow-select ic-dropdown"></span>
                                                            </div>
                                                            <div class="c-dropdown-menu">
                                                                <div class="c-dropdown-menu__top">
                                                                    <div class="c-dropdown-menu__search">
                                                                        <div class="cs-input-group cs-input-group--search">
                                                                            <span
                                                                                class="ic-search cs-input-search"></span><input
                                                                                class="cs-input js-input-typing"
                                                                                id="search-ward" type="text"
                                                                                placeholder="Nhập địa chỉ"
                                                                                autocomplete="none"><span
                                                                                class="form-search-icon form-search-clear close-btn js-form-clear open"
                                                                                data-name="delete"><i
                                                                                    class="ic-close ic-sm"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-dropdown-menu__wrapper m-t-4"><a
                                                                        class="item-region" href="#">Hà
                                                                        Nội</a><a class="item-region" href="#">Hồ
                                                                        Chí Minh</a><a class="item-region"
                                                                        href="#">Đồng Tháp</a><a class="item-region"
                                                                        href="#">Đồng
                                                                        nai</a><a class="item-region" href="#">Thái
                                                                        Nguyên</a><a class="item-region"
                                                                        href="#">Gia
                                                                        Lai</a><a class="item-region" href="#">Nha
                                                                        Trang</a><a class="item-region"
                                                                        href="#">Quãng Ngãi</a><a
                                                                        class="item-region" href="#">An
                                                                        Giang</a><a class="item-region" href="#">Cà
                                                                        Mau</a><a class="item-region" href="#">Đà
                                                                        Nẵng</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="c-dropdown c-dropdown--col">
                                                        <div class="c-dropdown js-dropdown-open">
                                                            <div class="group-dropdown">
                                                                <div class="c-dropdown-button c-dropdown-button--lg"
                                                                    data-name=""> Chọn Quận/Huyện
                                                                </div><span class="ic-arrow-select ic-dropdown"></span>
                                                            </div>
                                                            <div class="c-dropdown-menu">
                                                                <div class="c-dropdown-menu__top">
                                                                    <div class="c-dropdown-menu__search">
                                                                        <div class="cs-input-group cs-input-group--search">
                                                                            <span
                                                                                class="ic-search cs-input-search"></span><input
                                                                                class="cs-input js-input-typing"
                                                                                id="search-ward" type="text"
                                                                                placeholder="Nhập địa chỉ"
                                                                                autocomplete="none"><span
                                                                                class="form-search-icon form-search-clear close-btn js-form-clear open"
                                                                                data-name="delete"><i
                                                                                    class="ic-close ic-sm"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-dropdown-menu__wrapper m-t-4"><a
                                                                        class="item-region" href="#">Hà
                                                                        Nội</a><a class="item-region" href="#">Hồ
                                                                        Chí Minh</a><a class="item-region"
                                                                        href="#">Đồng Tháp</a><a class="item-region"
                                                                        href="#">Đồng
                                                                        nai</a><a class="item-region" href="#">Thái
                                                                        Nguyên</a><a class="item-region"
                                                                        href="#">Gia
                                                                        Lai</a><a class="item-region" href="#">Nha
                                                                        Trang</a><a class="item-region"
                                                                        href="#">Quãng Ngãi</a><a
                                                                        class="item-region" href="#">An
                                                                        Giang</a><a class="item-region" href="#">Cà
                                                                        Mau</a><a class="item-region" href="#">Đà
                                                                        Nẵng</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-cart__payment__tab-item js--cart__tabs-item" id="c-cart__shipshop">
                                            <div class="c-cart__payment-block">
                                                <div class="c-cart__payment__line c-cart__payment__location">
                                                    <div class="fst-cart__message p-y-4 p-x-8 m-t-8">
                                                        <p class="fst-cart__message--text">Thanh nhớ ngoài SanDisk
                                                            Cruzer
                                                            Glide 3.0 USB Flash
                                                            Drive, Black with fgfgrueguyr</p>hiện không có sẵn tại cửa
                                                        hàng
                                                        bạn chọn.
                                                    </div>
                                                    <div class="text-normal cls-cancel-prod m-t-8">Vui lòng <span
                                                            class="text-destroy f-w-500 f-s-ui-12 p-y-4 p-x-8">Hủy bỏ
                                                            sản
                                                            phẩm không có sẵn</span>
                                                        hoặc chọn shop có hàng ngay bên dưới:</div>
                                                    <div class="text-normal m-t-8"><span class="text-size--lg">Có 13
                                                            shop
                                                            có hàng tại Hà
                                                            Nội.</span> Hãy chọn shop bạn muốn nhận hàng.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fst__address m-t-8">
                                            <div class="fst__address__inner user-location p-y-8 p-l-16">
                                                <ul>
                                                    <li class="p-y-8 p-x-16">
                                                        <div class="radio address-radio"><input id="location"
                                                                type="radio" value="1"
                                                                name="radio-location11"><label class="address-info p-r-8"
                                                                for="location">
                                                                <div class="user-name">192A Nguyễn Thị Định, P. An Phú
                                                                    ,
                                                                    Quận 2, Hồ Chí Minh<p class="text-warning-700 p-t-4">
                                                                        Đặt hàng lấy sau 2-7 ngày</p>
                                                                </div>
                                                            </label>
                                                            <div class="btn btn-outline-grayscale btn-sm p-l-8">Xem bản
                                                                đồ
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="have-items p-y-8 p-x-16">
                                                        <div class="radio address-radio"><input id="location11"
                                                                type="radio" value="2"
                                                                name="radio-location11"><label class="address-info p-r-8"
                                                                for="location11">
                                                                <div class="user-name">192A Nguyễn Thị Định, P. An Phú
                                                                    ,
                                                                    Quận 2, Hồ Chí Minh<p class="text-succes-700 p-t-4">Có
                                                                        hàng</p>
                                                                </div>
                                                            </label>
                                                            <div class="btn btn-outline-grayscale btn-sm p-l-8">Xem bản
                                                                đồ
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="have-items p-y-8 p-x-16">
                                                        <div class="radio address-radio"><input id="location12"
                                                                type="radio" value="3"
                                                                name="radio-location11"><label class="address-info p-r-8"
                                                                for="location12">
                                                                <div class="user-name">192A Nguyễn Thị Định, P. An Phú
                                                                    ,
                                                                    Quận 2, Hồ Chí Minh<p class="text-succes-700 p-t-4">Có
                                                                        hàng</p>
                                                                </div>
                                                            </label>
                                                            <div class="btn btn-outline-grayscale btn-sm p-l-8">Xem bản
                                                                đồ
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="have-items p-y-8 p-x-16">
                                                        <div class="radio address-radio"><input id="location13"
                                                                type="radio" value=""
                                                                name="radio-location11"><label class="address-info p-r-8"
                                                                for="location13">
                                                                <div class="user-name">192A Nguyễn Thị Định, P. An Phú
                                                                    ,
                                                                    Quận 2, Hồ Chí Minh<p class="text-succes-700 p-t-4">Có
                                                                        hàng</p>
                                                                </div>
                                                            </label>
                                                            <div class="btn btn-outline-grayscale btn-sm p-l-8">Xem bản
                                                                đồ
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="btn btn-md fst-viewmore text-center"><a
                                                        class="re-link js--open-modal" href="#">Xem thêm 2 địa
                                                        chỉ
                                                        <i class="ic-down"></i></a></div>
                                            </div>
                                        </div>
                                        <div class="c-cart__payment__line">
                                            <div class="text--normal text-size--lg">Thời gian giao hàng:</div>
                                            <div class="c-dropdown">
                                                <div class="dropdown js-dropdown dropdown-undefined">
                                                    <div class="dropdown-button"><span>Chỉ giao giờ hành chính</span><i
                                                            class="ic-arrow-select ic-sm"></i></div>
                                                    <div class="dropdown-menu full-size">
                                                        <div class="dropdown-menu-wrapper"><a class="active"
                                                                href=""> <span>Chỉ giao giờ hành
                                                                    chính</span><i class="ic-check ic-sm m-l-8">
                                                                </i></a><a href=""><span>Tất cả các
                                                                    ngày trong tuần</span></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-cart__payment__line m-t-16">
                                            <div class="form-group">
                                                <textarea class="form-input form-input-md" rows="3" placeholder="Ghi chú yêu cầu"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-cart__form">
                                <div class="c-cart__form__block">
                                    <div class="c-cart__title">Chọn hình thức thanh toán</div>
                                    <ul class="c-cart__form__list c-cart__type-payment js--cart__tabs p-t-8 p-b-16">

                                    </ul>
                                </div>
                            </div>
                            <div class="c-cart__submit"><button class="btn btn-xl btn-link" id="btnCompleteOrder"
                                    style="display: inline-block">HOÀN TẤT ĐẶT HÀNG</button><button
                                    class="btn btn-xl btn-link" id="btnInstallment" style="display: none">MUA TRẢ
                                    GÓP</button>
                                <p>Bằng cách đặt hàng, bạn đồng ý với <a class="re-link--gray"
                                        href="https://fptshop.com.vn/tos" style="text-decoration: underline">Điều
                                        khoản
                                        sử dụng </a> của FStudio by FPT</p>
                            </div>
                        </div>
                        <div class="ghslod-lg hide">
                            <div class="spinner spinner-primary spinner-big"><svg>
                                    <circle cx="50%" cy="50%" r="30"></circle>
                                </svg><span class="spinner-text">Đang cập nhật giỏ hàng...</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <link rel="stylesheet" href="frontend/asset/css/main.css">

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
                                    '<a class="item-region" data-id="' + value.id +
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
                                $('#ward-list').append('<a class="item-region" data-id="' +
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

                $('.js--btn-minus').on('click', function() {
                    var input = $(this).siblings('.cs-input-cart');
                    var currentValue = parseInt(input.val());
                    if (currentValue > 1) {
                        input.val(currentValue - 1);
                        updateCartQuantity($(this).data('cart-id'), currentValue - 1);
                    }
                });

                $('.js--btn-plus').on('click', function() {
                    var input = $(this).siblings('.cs-input-cart');
                    var currentValue = parseInt(input.val());
                    input.val(currentValue + 1);
                    updateCartQuantity($(this).data('cart-id'), currentValue + 1);
                });

                function updateCartQuantity(cartId, quantity) {
                    $.ajax({
                        url: '{{ route('cart.updateQuantity') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            cart_id: cartId,
                            quantity: quantity
                        },
                        success: function(response) {
                            window.location.reload();

                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                function updateCartTotal() {
    var priceMainElements = document.querySelectorAll('#cs-price--main');
    var quantityCart = document.querySelectorAll('.cs-input-cart');
    var amount = document.getElementById('amount');
    var amountDiscount = document.querySelector('.re-red');
    var discount = document.getElementById('discount');
    var totalPrice = 0;
    var discountAll = document.querySelectorAll('#discountAll');
    var totalDiscount = 0;

    priceMainElements.forEach(function(priceElement, index) {
        var priceValue = priceElement.textContent.trim().replace(/\./g, '').replace('₫', '');
        var quantity = quantityCart[index].value;
        var discountValue = discountAll[index].textContent.trim().replace(/\./g, '').replace('-', '').replace('₫', '');
        totalDiscount += discountValue * quantity;
        totalPrice += parseInt(priceValue, 10) * quantity;
    });

    discount.textContent = totalDiscount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '₫';
    console.log(discount.textContent);
    amount.textContent = totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '₫';

    var totalPriceAfterDiscount = totalPrice - totalDiscount;
    amountDiscount.textContent = totalPriceAfterDiscount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '₫';
}


                updateCartTotal();

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
                            if (data.status === 'error') {
                                $('.text-inValid-success').hide();
                                $('.text-inValid-failed').text(data.message).show();
                                toastr.error(data.message);
                            } else if (data.status === 'success') {
                                $('.text-inValid-failed').hide();
                                $('.text-inValid-success').text('Áp dụng thành công giảm ' + data
                                    .discount + '₫').show();
                                toastr.success(data.message);
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                });


            });
        </script>
    @endpush

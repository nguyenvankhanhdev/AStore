@extends('frontend.user.layouts.master')

@section('content')
    <div class="c-cart bg-gray-100 footer-off">
        <div class="container">
            <div class="c-cart__wrap">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="link" href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item">Giỏ hàng</li>
                </ol>
                <div class="card">
                    <div class="card-title">Có 2 sản phẩm trong giỏ hàng<span class="c-modal--close js-modal__close"></span>
                    </div>
                    <div class="card-body">
                        <div class="c-cart__block">
                            <div class="c-cart__product" data-brand="Apple (iPhone)" data-variant="597164"
                                data-producttype="1" data-productid="34678">
                                <div class="product-cart">
                                    <div class="product-cart__img"><img
                                            src="https://fptshop.com.vn/Uploads/Originals/2020/10/14/637382725406081030_ip-12-pro-max-vang-1.png"
                                            alt="Demo"></div>
                                    <div class="product-cart__info">
                                        <div class="product-cart__inside"><a class="product-cart__line"
                                                href="https://fptshop.com.vn/dien-thoai/iphone-12-pro-max-128gb"></a>
                                            <h3 class="product-cart__name product-cart__name--lg name-product-split"
                                                data-sku="00714499" data-color="Vàng">iPhone 12 Pro Max 128GB </h3>
                                            <div class="product-cart__line" style="display: flex"></div>
                                            <div class="dropdown js-dropdown dropdown-undefined">
                                                <div class="dropdown-button"><span>Mới nhất</span><i
                                                        class="ic-arrow-select ic-sm"></i>
                                                </div>
                                                <div class="dropdown-menu">
                                                    <div class="dropdown-menu-wrapper"><a><span>Chọn...</span><i
                                                                class="ic-check ic-sm m-l-8"></i></a><a class="active"
                                                            href=""> <span>Mới
                                                                nhất</span><i class="ic-check ic-sm m-l-8"> </i></a><a
                                                            href=""><span>Cũ
                                                                nhất</span><i class="ic-check ic-sm m-l-8"></i></a></div>
                                                </div>
                                            </div>
                                            <div class="product-cart__line"></div>
                                        </div>
                                        <div class="product-cart__quality">
                                            <div class="product-cart__quality__wrap"><button
                                                    class="cs-btn btn js--btn-minus disabled" type="button"><span
                                                        class="ic-minus"></span></button><input class="cs-input-cart"
                                                    type="text" readonly="" value="1"><button
                                                    class="cs-btn btn js--btn-plus" type="button"><span
                                                        class="ic-plus"></span></button></div>
                                            <div class="product-cart__remove"><i class="ic-trash f-s-p-12 ic-xs m-r-4"></i>
                                                Xoá</div>
                                        </div>
                                        <div class="product-cart__price">
                                            <div class="cs-price cs-price--main">30.999.000₫</div>
                                            <div class="cs-price cs-price--sub" style="text-decoration: line-through">
                                                32.999.000₫</div>
                                            <div class="fst-cart-tag m-t-4"><a
                                                    class="badge badge-default badge-xxxs fst-cart-badge m-r-4"
                                                    href="#"><i class="ic-tag m-r-4"></i><span>MACBOOK16</span></a>
                                                <div class="cs-price cs-price--main f-w-500">-1.500.000₫</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-cart__center">
                                <div class="c-cart__coupon">
                                    <div class="c-cart__title">Mã giảm giá</div>
                                    <div class="cs-input-group m-t-8">
                                        <div class="form-group"><input class="form-input form-input-sm" type="text"
                                                placeholder="Nhập mã giảm giá"></div>
                                        <div class="feedback error-voucher">
                                            <div class="stack"></div><span class="ic-minus-circled"></span>
                                            <p>Nhập voucher để áp dụng</p>
                                        </div>
                                        <div class="apply-btn m-l-8"><a class="btn btn-link btn-sm" href="#">Áp
                                                dụng</a></div>
                                    </div>
                                    <p class="text-inValid-success m-t-8">Áp dụng thành công giảm 1.500.000₫ khi mua điện
                                        thoại
                                        Macbook</p>
                                    <p class="text-inValid-failed m-t-8">Mã giảm giá không hợp lệ</p>
                                    <div class="c-cart-badge m-t-8"><a
                                            class="badge badge-grayscale badge-xxxs badge-xxs badge-close m-r-8 m-b-8"
                                            href="#"><i class="ic-tag m-r-4"></i><span>MACBOOK16</span><span
                                                class="btn btn-icon-single btn-square btn-grayscale btn-xs"><i
                                                    class="ic-close f-s-ui-16"></i></span></a>
                                    </div>
                                </div>
                                <div class="c-cart__total">
                                    <p class="text-normal"><span>Tổng tiền:</span><span>32.999.000đ</span></p>
                                    <p class="text-normal"><span>Giảm:</span><span>-2.000.000đ</span></p>
                                    <p class="text--lg"><span class="text-size--lg">Cần thanh toán:</span><span
                                            class="re-price f-w-500 f-s-p-16 re-red">30.999.000đ</span></p>
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
                                                                        <a class="item-region" data-id="{{ $province->id }}" href="#">{{ $province->name }}</a>
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
                                                                <div class="c-dropdown-menu__wrapper m-t-4"
                                                                    id="ward-list">
                                                                    <!-- Wards will be loaded here by AJAX -->
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
                                        <li class="cls-list-payment">
                                            <div class="radio paymentmethod"><input class="js--tabs-child" id="pay1"
                                                    type="radio" data-promotion="" name="cart2" value="1"
                                                    checked=""><label for="pay1">Trả tiền mặt
                                                    khi nhận
                                                    hàng/Trả góp lãi suất thường</label></div>
                                        </li>
                                        <li class="cls-list-payment" data-name="open-bank-vnpay">
                                            <div class="radio paymentmethod"><input class="js--tabs-child" id="pay2"
                                                    type="radio" data-promotion="VNPAYATM" name="cart2"
                                                    value="2"><label for="pay2">ATM nội
                                                    địa/QR
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
                                                    <ul class="cs-suggest js--suggestion-w-product" id="bank-suggest">
                                                        <li class="cs-suggest__item active" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/ABB.jpg"
                                                                    alt="Ngân hàng thương mại cổ phần An Bình (ABBANK)">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng thương
                                                                    mại
                                                                    cổ phần An Bình (ABBANK)
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/ACB.jpg"
                                                                    alt="Ngân hàng ACB"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ngân hàng ACB
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/AGB.jpg"
                                                                    alt="Ngân hàng Nông nghiệp (Agribank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Nông
                                                                    nghiệp
                                                                    (Agribank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BAB.jpg"
                                                                    alt="Ngân Hàng TMCP Bắc Á"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ngân Hàng TMCP
                                                                    Bắc Á
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BIDV.jpg"
                                                                    alt="Ngân hàng đầu tư và phát triển Việt Nam (BIDV)">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng đầu tư
                                                                    và
                                                                    phát triển Việt Nam (BIDV)
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/DAB.jpg"
                                                                    alt="Ngân hàng Đông Á (DongABank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Đông Á
                                                                    (DongABank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/EXB.jpg"
                                                                    alt="Ngân hàng EximBank"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ngân hàng
                                                                    EximBank
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/HDB.jpg"
                                                                    alt="Ngân hàng HDBank"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ngân hàng HDBank
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/IVB.jpg"
                                                                    alt="Ngân hàng TNHH Indovina (IVB)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng TNHH
                                                                    Indovina (IVB)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/MB.jpg"
                                                                    alt="Ngân hàng thương mại cổ phần Quân đội"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng thương
                                                                    mại
                                                                    cổ phần Quân đội</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/MSB.jpg"
                                                                    alt="Ngân hàng Hàng Hải (MSBANK)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Hàng
                                                                    Hải
                                                                    (MSBANK)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/NAB.jpg"
                                                                    alt="Ngân hàng Nam Á (NamABank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Nam Á
                                                                    (NamABank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/NVB.jpg"
                                                                    alt="Ngân hàng Quốc dân (NCB)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Quốc
                                                                    dân
                                                                    (NCB)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/OCB.jpg"
                                                                    alt="Ngân hàng Phương Đông (OCB)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Phương
                                                                    Đông
                                                                    (OCB)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/OJB.jpg"
                                                                    alt="Ngân hàng Đại Dương (OceanBank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Đại
                                                                    Dương
                                                                    (OceanBank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/PVCOMBANK.jpg"
                                                                    alt="Ngân hàng TMCP Đại Chúng Việt Nam"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng TMCP
                                                                    Đại
                                                                    Chúng Việt Nam</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/STB.jpg"
                                                                    alt="Ngân hàng TMCP Sài Gòn Thương Tín (SacomBank)">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng TMCP
                                                                    Sài
                                                                    Gòn Thương Tín (SacomBank)
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/SGB.jpg"
                                                                    alt="Ngân hàng thương mại cổ phần Sài Gòn Công Thương">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng thương
                                                                    mại
                                                                    cổ phần Sài Gòn Công Thương
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/SCB.jpg"
                                                                    alt="Ngân hàng TMCP Sài Gòn (SCB)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng TMCP
                                                                    Sài
                                                                    Gòn (SCB)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/SHB.jpg"
                                                                    alt="Ngân hàng Thương mại cổ phần Sài Gòn - Hà Nội(SHB)">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Thương
                                                                    mại
                                                                    cổ phần Sài Gòn - Hà
                                                                    Nội(SHB)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/TCB.jpg"
                                                                    alt="Ngân hàng Kỹ thương Việt Nam (TechcomBank)">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Kỹ
                                                                    thương
                                                                    Việt Nam (TechcomBank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/TPB.jpg"
                                                                    alt="Ngân hàng Tiên Phong (TPBank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Tiên
                                                                    Phong
                                                                    (TPBank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VPB.jpg"
                                                                    alt="Ngân hàng Việt Nam Thịnh vượng (VPBank)">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Việt
                                                                    Nam
                                                                    Thịnh vượng (VPBank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIB.jpg"
                                                                    alt="Ngân hàng Thương mại cổ phần Quốc tế Việt Nam (VIB)	">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Thương
                                                                    mại
                                                                    cổ phần Quốc tế Việt Nam
                                                                    (VIB)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VAB.jpg"
                                                                    alt="Ngân hàng TMCP Việt Á"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ngân hàng TMCP
                                                                    Việt
                                                                    Á</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIETBANK.jpg"
                                                                    alt="Ngân hàng thương mại cổ phần Việt Nam Thương Tín">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng thương
                                                                    mại
                                                                    cổ phần Việt Nam Thương Tín
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VCCB.jpg"
                                                                    alt="Ngân Hàng Bản Việt"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ngân Hàng Bản
                                                                    Việt
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VCB.jpg"
                                                                    alt="Ngân hàng Ngoại thương (Vietcombank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Ngoại
                                                                    thương (Vietcombank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/ICB.jpg"
                                                                    alt="Ngân hàng Công thương (Vietinbank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng Công
                                                                    thương
                                                                    (Vietinbank)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BIDC.jpg"
                                                                    alt="Ngân Hàng BIDC"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân Hàng BIDC
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/WRB.jpg"
                                                                    alt="Ngân hàng TNHH MTV Woori Việt Nam"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng TNHH
                                                                    MTV
                                                                    Woori Việt Nam</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VINID.jpg"
                                                                    alt="Ví VinID"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ví VinID</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIMASS.jpg"
                                                                    alt="Ví VIMASS"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ví VIMASS</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/1PAY.jpg"
                                                                    alt="Ví TrueMoney"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ví TrueMoney
                                                                </h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIVIET.jpg"
                                                                    alt="Ví Việt"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"></h3>Ví Việt
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: none">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/YOLO.jpg"
                                                                    alt="Ví YOLO"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ví YOLO</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VNPTPAY.jpg"
                                                                    alt="Ví VNPTPAY"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ví VNPTPAY</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VNPAYQR.jpg"
                                                                    alt="Ví VnPay"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg"> Ví VnPay</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/KIENLONGBANK.jpg"
                                                                    alt="Ngân hàng TMCP Kiên Long (KIENLONGBANK)">
                                                            </div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân hàng TMCP
                                                                    Kiên
                                                                    Long (KIENLONGBANK)</h3>
                                                            </div>
                                                        </li>
                                                        <li class="cs-suggest__item" style="display: flex">
                                                            <div class="img img--md margin-right"><img
                                                                    src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BAOVIETBANK.jpg"
                                                                    alt="Ngân Hàng Tmcp Bảo Việt (Baovietbank)"></div>
                                                            <div class="info">
                                                                <h3 class="text-normal text-size--lg">Ngân Hàng Tmcp
                                                                    Bảo
                                                                    Việt (Baovietbank)</h3>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="c-cart__select m-t-8" id="list-bank-item">
                                                    <div class="c-cart__select__item" id="ABBANK"
                                                        data-name="Ngân hàng thương mại cổ phần An Bình (ABBANK)"
                                                        value="ABBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/ABB.jpg"
                                                            alt="Ngân hàng thương mại cổ phần An Bình (ABBANK)"></div>
                                                    <div class="c-cart__select__item" id="ACB"
                                                        data-name="Ngân hàng ACB" value="ACB"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/ACB.jpg"
                                                            alt="Ngân hàng ACB"></div>
                                                    <div class="c-cart__select__item" id="AGRIBANK"
                                                        data-name="Ngân hàng Nông nghiệp (Agribank)" value="AGRIBANK">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/AGB.jpg"
                                                            alt="Ngân hàng Nông nghiệp (Agribank)">
                                                    </div>
                                                    <div class="c-cart__select__item" id="BACABANK"
                                                        data-name="Ngân Hàng TMCP Bắc Á" value="BACABANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BAB.jpg"
                                                            alt="Ngân Hàng TMCP Bắc Á"></div>
                                                    <div class="c-cart__select__item" id="BIDV"
                                                        data-name="Ngân hàng đầu tư và phát triển Việt Nam (BIDV)"
                                                        value="BIDV"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BIDV.jpg"
                                                            alt="Ngân hàng đầu tư và phát triển Việt Nam (BIDV)"></div>
                                                    <div class="c-cart__select__item" id="DONGABANK"
                                                        data-name="Ngân hàng Đông Á (DongABank)" value="DONGABANK">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/DAB.jpg"
                                                            alt="Ngân hàng Đông Á (DongABank)">
                                                    </div>
                                                    <div class="c-cart__select__item" id="EXIMBANK"
                                                        data-name="Ngân hàng EximBank" value="EXIMBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/EXB.jpg"
                                                            alt="Ngân hàng EximBank"></div>
                                                    <div class="c-cart__select__item" id="HDBANK"
                                                        data-name="Ngân hàng HDBank" value="HDBANK">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/HDB.jpg"
                                                            alt="Ngân hàng HDBank">
                                                    </div>
                                                    <div class="c-cart__select__item" id="IVB"
                                                        data-name="Ngân hàng TNHH Indovina (IVB)" value="IVB"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/IVB.jpg"
                                                            alt="Ngân hàng TNHH Indovina (IVB)"></div>
                                                    <div class="c-cart__select__item" id="MBBANK"
                                                        data-name="Ngân hàng thương mại cổ phần Quân đội" value="MBBANK">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/MB.jpg"
                                                            alt="Ngân hàng thương mại cổ phần Quân đội">
                                                    </div>
                                                    <div class="c-cart__select__item" id="MSBANK"
                                                        data-name="Ngân hàng Hàng Hải (MSBANK)" value="MSBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/MSB.jpg"
                                                            alt="Ngân hàng Hàng Hải (MSBANK)"></div>
                                                    <div class="c-cart__select__item" id="NAMABANK"
                                                        data-name="Ngân hàng Nam Á (NamABank)" value="NAMABANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/NAB.jpg"
                                                            alt="Ngân hàng Nam Á (NamABank)"></div>
                                                    <div class="c-cart__select__item" id="NCB"
                                                        data-name="Ngân hàng Quốc dân (NCB)" value="NCB">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/NVB.jpg"
                                                            alt="Ngân hàng Quốc dân (NCB)">
                                                    </div>
                                                    <div class="c-cart__select__item" id="OCB"
                                                        data-name="Ngân hàng Phương Đông (OCB)" value="OCB"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/OCB.jpg"
                                                            alt="Ngân hàng Phương Đông (OCB)"></div>
                                                    <div class="c-cart__select__item" id="OJB"
                                                        data-name="Ngân hàng Đại Dương (OceanBank)" value="OJB">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/OJB.jpg"
                                                            alt="Ngân hàng Đại Dương (OceanBank)">
                                                    </div>
                                                    <div class="c-cart__select__item" id="PVCOMBANK"
                                                        data-name="Ngân hàng TMCP Đại Chúng Việt Nam" value="PVCOMBANK">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/PVCOMBANK.jpg"
                                                            alt="Ngân hàng TMCP Đại Chúng Việt Nam">
                                                    </div>
                                                    <div class="c-cart__select__item" id="SACOMBANK"
                                                        data-name="Ngân hàng TMCP Sài Gòn Thương Tín (SacomBank)"
                                                        value="SACOMBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/STB.jpg"
                                                            alt="Ngân hàng TMCP Sài Gòn Thương Tín (SacomBank)"></div>
                                                    <div class="c-cart__select__item" id="SAIGONBANK"
                                                        data-name="Ngân hàng thương mại cổ phần Sài Gòn Công Thương"
                                                        value="SAIGONBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/SGB.jpg"
                                                            alt="Ngân hàng thương mại cổ phần Sài Gòn Công Thương">
                                                    </div>
                                                    <div class="c-cart__select__item" id="SCB"
                                                        data-name="Ngân hàng TMCP Sài Gòn (SCB)" value="SCB"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/SCB.jpg"
                                                            alt="Ngân hàng TMCP Sài Gòn (SCB)"></div>
                                                    <div class="c-cart__select__item" id="SHB"
                                                        data-name="Ngân hàng Thương mại cổ phần Sài Gòn - Hà Nội(SHB)"
                                                        value="SHB"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/SHB.jpg"
                                                            alt="Ngân hàng Thương mại cổ phần Sài Gòn - Hà Nội(SHB)">
                                                    </div>
                                                    <div class="c-cart__select__item" id="TECHCOMBANK"
                                                        data-name="Ngân hàng Kỹ thương Việt Nam (TechcomBank)"
                                                        value="TECHCOMBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/TCB.jpg"
                                                            alt="Ngân hàng Kỹ thương Việt Nam (TechcomBank)"></div>
                                                    <div class="c-cart__select__item" id="TPBANK"
                                                        data-name="Ngân hàng Tiên Phong (TPBank)" value="TPBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/TPB.jpg"
                                                            alt="Ngân hàng Tiên Phong (TPBank)"></div>
                                                    <div class="c-cart__select__item" id="VPBANK"
                                                        data-name="Ngân hàng Việt Nam Thịnh vượng (VPBank)"
                                                        value="VPBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VPB.jpg"
                                                            alt="Ngân hàng Việt Nam Thịnh vượng (VPBank)"></div>
                                                    <div class="c-cart__select__item" id="VIB"
                                                        data-name="Ngân hàng Thương mại cổ phần Quốc tế Việt Nam (VIB)	"
                                                        value="VIB"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIB.jpg"
                                                            alt="Ngân hàng Thương mại cổ phần Quốc tế Việt Nam (VIB)	">
                                                    </div>
                                                    <div class="c-cart__select__item" id="VIETABANK"
                                                        data-name="Ngân hàng TMCP Việt Á" value="VIETABANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VAB.jpg"
                                                            alt="Ngân hàng TMCP Việt Á"></div>
                                                    <div class="c-cart__select__item" id="VIETBANK"
                                                        data-name="Ngân hàng thương mại cổ phần Việt Nam Thương Tín"
                                                        value="VIETBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIETBANK.jpg"
                                                            alt="Ngân hàng thương mại cổ phần Việt Nam Thương Tín">
                                                    </div>
                                                    <div class="c-cart__select__item" id="VIETCAPITALBANK"
                                                        data-name="Ngân Hàng Bản Việt" value="VIETCAPITALBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VCCB.jpg"
                                                            alt="Ngân Hàng Bản Việt"></div>
                                                    <div class="c-cart__select__item" id="VIETCOMBANK"
                                                        data-name="Ngân hàng Ngoại thương (Vietcombank)"
                                                        value="VIETCOMBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VCB.jpg"
                                                            alt="Ngân hàng Ngoại thương (Vietcombank)"></div>
                                                    <div class="c-cart__select__item" id="VIETINBANK"
                                                        data-name="Ngân hàng Công thương (Vietinbank)" value="VIETINBANK">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/ICB.jpg"
                                                            alt="Ngân hàng Công thương (Vietinbank)">
                                                    </div>
                                                    <div class="c-cart__select__item" id="BIDC"
                                                        data-name="Ngân Hàng BIDC" value="BIDC"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BIDC.jpg"
                                                            alt="Ngân Hàng BIDC"></div>
                                                    <div class="c-cart__select__item" id="WOORIBANK"
                                                        data-name="Ngân hàng TNHH MTV Woori Việt Nam" value="WOORIBANK">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/WRB.jpg"
                                                            alt="Ngân hàng TNHH MTV Woori Việt Nam">
                                                    </div>
                                                    <div class="c-cart__select__item" id="VINID" data-name="Ví VinID"
                                                        value="VINID"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VINID.jpg"
                                                            alt="Ví VinID"></div>
                                                    <div class="c-cart__select__item" id="VIMASS"
                                                        data-name="Ví VIMASS" value="VIMASS"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIMASS.jpg"
                                                            alt="Ví VIMASS"></div>
                                                    <div class="c-cart__select__item" id="1PAY"
                                                        data-name="Ví TrueMoney" value="1PAY"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/1PAY.jpg"
                                                            alt="Ví TrueMoney"></div>
                                                    <div class="c-cart__select__item" id="VIVIET" data-name="Ví Việt"
                                                        value="VIVIET"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VIVIET.jpg"
                                                            alt="Ví Việt"></div>
                                                    <div class="c-cart__select__item" id="YOLO" data-name="Ví YOLO"
                                                        value="YOLO"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/YOLO.jpg"
                                                            alt="Ví YOLO"></div>
                                                    <div class="c-cart__select__item" id="VNPTPAY"
                                                        data-name="Ví VNPTPAY" value="VNPTPAY"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VNPTPAY.jpg"
                                                            alt="Ví VNPTPAY"></div>
                                                    <div class="c-cart__select__item" id="VNPAYQR"
                                                        data-name="Ví VnPay" value="VNPAYQR"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/VNPAYQR.jpg"
                                                            alt="Ví VnPay"></div>
                                                    <div class="c-cart__select__item" id="KIENLONGBANK"
                                                        data-name="Ngân hàng TMCP Kiên Long (KIENLONGBANK)"
                                                        value="KIENLONGBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/KIENLONGBANK.jpg"
                                                            alt="Ngân hàng TMCP Kiên Long (KIENLONGBANK)"></div>
                                                    <div class="c-cart__select__item" id="BAOVIETBANK"
                                                        data-name="Ngân Hàng Tmcp Bảo Việt (Baovietbank)"
                                                        value="BAOVIETBANK"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Content/Checkout/images/bank/BAOVIETBANK.jpg"
                                                            alt="Ngân Hàng Tmcp Bảo Việt (Baovietbank)"></div>
                                                </div>
                                                <p class="cls-text--desc m-t-8" data-promotion="VNPAYATM">Gợi ý:
                                                    <span class="text-success f-w-500">Nhập mã "VNPAY300" </span>giảm
                                                    3% tối
                                                    đa 300.000₫ qua
                                                    VNPAY-QR khi thanh toán online 100%
                                                </p>
                                            </div>
                                        </li>
                                        <li class="cls-list-payment" data-name="open-bank-visa">
                                            <div class="radio paymentmethod"><input class="js--tabs-child"
                                                    id="pay4" type="radio" data-promotion="" name="cart2"
                                                    value="4"><label for="pay4">Thanh toán
                                                    bằng thẻ quốc tế
                                                    Visa,
                                                    Master, JCB, AMEX</label></div>
                                            <div class="c-cart__form__list__expand js--cart__tabs-item group-bank-visa"
                                                id="se3t6">
                                                <div class="c-cart__select" id="listvisa">
                                                    <div class="c-cart__select__item" data-name="Visa" value="Visa">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Cart/Checkout/images/nh/30visa.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="c-cart__select__item" data-name="Mastercard"
                                                        value="Mastercard"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Cart/Checkout/images/nh/31master.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="c-cart__select__item" data-name="JCB" value="JCB">
                                                        <img src="https://fptshop.com.vn/gio-hang-v2/Cart/Checkout/images/nh/32jcb.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="c-cart__select__item" data-name="AMEX"
                                                        value="AMERICAN_EXPRESS"><img
                                                            src="https://fptshop.com.vn/gio-hang-v2/Cart/Checkout/images/nh/33amex.jpg"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="cs-toast cs-toast--success" id="box-textvisa"
                                                    style="display: none"></div>
                                            </div>
                                        </li>
                                        <li
                                            class="cls-list-payment tooltip tooltip-top tooltip-dark cart--tooltip-payment">
                                            <div class="radio paymentmethod"><input class="js--tabs-child"
                                                    id="pay7" type="radio" disabled="" data-promotion=""
                                                    name="cart2" value="7"><label for="pay7">Thanh toán
                                                    bằng trả
                                                    góp</label></div>
                                            <div class="tooltip-box tooltip-full-size">
                                                <p>Hình thức thanh toán này không khả dụng với khuyến mại bạn chọn</p>
                                            </div>
                                        </li>
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
            $(document).ready(function() {
                $(document).on('click', '#province-list .item-region', function(e) {
                    e.preventDefault();
                    var provinceId = $(this).data('id');
                    $.ajax({
                        url: '{{ url("get-districts") }}/' + provinceId,
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
                        url: '{{ url("get-wards") }}/'+ districtId,
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
            });
        </script>
    @endpush

@extends('frontend.user.layouts.master')

@section('front_content')

<div class="category">
    <div class="container">
        {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="link" href="#">Trang chủ</a></li>
            <li class="breadcrumb-item">Mac</li>
        </ol> --}}
        <h1 class="h1">Mac</h1>
        <div class="card card-md category__container">
            <div class="card-body">
                <div class="actions">
                    <div class="menu js-category-menu">
                        <div class="swiper">
                            <div class="swiper-wrapper"> <a class="item swiper-slide active" data-ref="#block-1">Tất
                                    cả</a><a class="item swiper-slide" data-ref="#block-2">MacBook Air 13”</a><a
                                    class="item swiper-slide" data-ref="#block-3">MacBook Pro 13”</a><a
                                    class="item swiper-slide" data-ref="#block-4">MacBook
                                    Pro 14”</a><a class="item swiper-slide" data-ref="#block-5">MacBook Pro 16”</a><a
                                    class="item swiper-slide" data-ref="#block-6">Mac mini</a><a
                                    class="item swiper-slide" data-ref="#block-7">iMac</a><a class="item swiper-slide"
                                    data-ref="#block-8">MacBook Pro
                                    16”</a><a class="item swiper-slide" data-ref="#block-9">Mac mini</a><a
                                    class="item swiper-slide" data-ref="#block-10">iMac</a></div>
                        </div>
                        <div class="swiper-button-next sw-button"><i class="ic-angle-right"></i></div>
                        <div class="swiper-button-prev sw-button"><i class="ic-angle-left"></i></div>
                    </div>
                    <div class="sort">
                        <div class="content">
                            <div class="text">Sắp xếp theo:</div>
                            <div class="dropdown js-dropdown">
                                <div class="dropdown-button"><span>Mới nhất</span><i class="ic-arrow-select ic-sm"></i>
                                </div>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-wrapper scrollbar"><a href="#"><span>Option:
                                                1</span></a><a href="#"><span>Option: 2</span></a><a
                                            href="#"><span>Option: 3</span></a><a href="#"><span>Option:
                                                4</span></a><a href="#"><span>Option: 5</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active" id="block-1">
                    <div class="product-list">
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>
                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md" href="#">XEM
                                    CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md" href="#">XEM
                                    CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="product__img"><a href="#"><img
                                        src="https://images.fpt.shop/unsafe/fit-in/214x214/filters:quality(90):fill(white)/cdn.fptshop.com.vn/Uploads/Originals/2019/9/11/637037687757921048_11-pro-max-chung.png"
                                        alt=""></a></div>
                            <div class="product__info">

                                <h3 class="product__name">
                                    <div class="text">Lorem ipsum dolor sit amet.</div><span
                                        class="badge badge-xs badge-link">Mới</span>
                                </h3>

                                <div class="product__price">
                                    <div class="text">Giá chỉ</div>
                                    <div class="price">60.990.000đ</div><strike
                                        class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                </div>
                            </div>
                            <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                    href="#">XEM CHI TIẾT </a>
                            </div>
                        </div>
                        {{-- <div class="card-nolist w-100">
                            <div class="noti-img"><img src="assets/img/no-search.png"
                                    alt="Không tìm thấy sản phẩm phù hợp">
                            </div>
                            <p class="noti-title">Không tìm thấy sản phẩm phù hợp</p>
                            <p class="noti-content">Vui lòng điều chỉnh lại bộ lọc</p>
                        </div>
                    </div>
                    <div class="viewmore"><a class="btn btn-icon btn-outline-grayscale btn-md"
                            href="#"><span>Xem thêm 22
                                sản phẩm</span><i class="ic-angle-down"></i></a></div>
                </div>
                <div class="tab-pane" id="block-2">tab2</div>
                <div class="tab-pane" id="block-3">tab3</div>
                <div class="tab-pane" id="block-4">tab4</div>
                <div class="tab-pane" id="block-5">tab5</div> --}}
            </div>
        </div>
    </div>
</div>


@endsection
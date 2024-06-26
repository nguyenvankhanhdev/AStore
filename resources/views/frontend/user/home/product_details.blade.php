@extends('frontend.user.layouts.master')

@section('content')
    <div class="detail">
        <div class="detail__header lg-detail-header">
            <div class="temp">
                <picture data-src="https://via.placeholder.com/1x1/f3f3f3"><img src="https://via.placeholder.com/1x1/f3f3f3">
                </picture>
            </div>
            <div class="detail__breadcrumb">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="link" href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a class="link"
                                href="{{ route('products.category', ['categories' => $cate->slug]) }}">{{ $cate->name }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
            <div class="detail__gallery">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="slider-gallery">
                                <div class="slider-gallery__main">
                                    <div class="swiper gallery-main js-open-next">
                                        <div class="swiper-wrapper js-gallery">
                                            @foreach ($product->productImages as $image)
                                                <div class="swiper-slide" data-src="{{ $image->image }}">
                                                    <picture><img src="{{ $image->image }}"
                                                            alt="MacBook Pro 16” 2021 M1 Pro"></picture>
                                                </div>
                                            @endforeach
                                        </div><!-- Add Arrows-->
                                        <div class="swiper-button-next ic-angle-right swiper-button"></div>
                                        <div class="swiper-button-prev ic-angle-left swiper-button"></div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                                <div class="slider-gallery__thumb">
                                    <div class="swiper gallery-thumbs">
                                        <div class="swiper-wrapper">
                                            @foreach ($product->productImages as $image)
                                                <div class="swiper-slide active">
                                                    <span>
                                                        <img src="{{ $image->image }}" alt="">
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="view-gallery js-open-gallery" data-count="+12"><img
                                            src="https://via.placeholder.com/96x96" alt=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="wrapper">
                                <h1 class="h1 name">{{ $product->name }}</h1>
                                <div class="npi-special">
                                    <div class="product-price-left npi-special-price js-control-item active">
                                        <div class="npi-special-inner">
                                            <div class="npi-special-caption">
                                                <div class="npi-special-caption-icon"><img
                                                        src="frontend/asset/img/fxemoji_star.svg" alt="fxemoji_star"></div>
                                                <div class="npi-special-caption-label">Giá phiên bản 1 Đổi 1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="npi-border">
                                    <div class="price">
                                        <div class="boxprice"><span class="text text-primary">27.990.000₫</span><strike
                                                class="text-promo p-l-8 f-s-p-24 f-w-400"> 30.500.000đ</strike></div>

                                    </div>
                                    <div class="types js-select"><a class="item active">
                                            <div class="radio"><input id="p22" type="radio" value=""
                                                    name="p22"><label for="p22">512GB</label></div>
                                            <p>60.990.000₫</p>
                                        </a><a class="item">
                                            <div class="radio"><input id="p23" type="radio" value=""
                                                    name="p22"><label for="p23">1TB</label></div>
                                            <p>65.690.000₫</p>
                                        </a></div>

                                    <div class="colors js-select">
                                        {{-- @foreach ( )

                                        @endforeach --}}
                                        <div class="item active"><span style="background-color:#124183"></span>
                                            <div>Xanh đen</div>
                                        </div>
                                        <div class="item"><span
                                                style="background: linear-gradient(90deg, #E0901A 52.36%, #E9CA95 52.56%);"></span>
                                            <div>Vàng</div>
                                        </div>
                                        <div class="item"><span style="background-color:#7d7e80"> </span>
                                            <div>Xám</div>
                                        </div>
                                        <div class="item"><span style="background-color:#e2e4e6"> </span>
                                            <div>Bạc</div>
                                        </div>
                                    </div>
                                    <div class="payment-incentives">
                                        <div class="block-head">
                                            <div class="block-head-title">Ưu đãi thanh toán</div><span
                                                class="link js--open-modal" aria-controls="modal-incentives">Xem tất
                                                cả</span>
                                        </div>
                                        <div class="list-bank">
                                            <div class="swiper-custom">
                                                <div class="swiper slideIncentives">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="prod-card">
                                                                <div class="prod-card-img"><img src=""
                                                                        alt=""></div>
                                                                <div class="prod-card-info">
                                                                    <p class="prod-card-desc">Giảm
                                                                        thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                                                            class="link">Chi tiết</a></p>
                                                                    <div class="prod-card-btn"><button
                                                                            class="btn btn-rounded btn-icon"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Chọn</span></button><button
                                                                            class="btn btn-rounded btn-icon btn-active"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Đã Chọn</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="prod-card">
                                                                <div class="prod-card-img"><img src=""
                                                                        alt=""></div>
                                                                <div class="prod-card-info">
                                                                    <p class="prod-card-desc">Giảm
                                                                        thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                                                            class="link">Chi tiết</a></p>
                                                                    <div class="prod-card-btn"><button
                                                                            class="btn btn-rounded btn-icon"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Chọn</span></button><button
                                                                            class="btn btn-rounded btn-icon btn-active"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Đã Chọn</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="prod-card">
                                                                <div class="prod-card-img"><img src=""
                                                                        alt=""></div>
                                                                <div class="prod-card-info">
                                                                    <p class="prod-card-desc">Giảm
                                                                        thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                                                            class="link">Chi tiết</a></p>
                                                                    <div class="prod-card-btn"><button
                                                                            class="btn btn-rounded btn-icon"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Chọn</span></button><button
                                                                            class="btn btn-rounded btn-icon btn-active"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Đã Chọn</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <div class="prod-card">
                                                                <div class="prod-card-img"><img src=""
                                                                        alt=""></div>
                                                                <div class="prod-card-info">
                                                                    <p class="prod-card-desc">Giảm
                                                                        thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                                                            class="link">Chi tiết</a></p>
                                                                    <div class="prod-card-btn"><button
                                                                            class="btn btn-rounded btn-icon"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Chọn</span></button><button
                                                                            class="btn btn-rounded btn-icon btn-active"><span
                                                                                class="ic-check"></span><span
                                                                                class="btn-label">Đã Chọn</span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-button-prev sw-control-prev"><i
                                                        class="ic-angle-left"></i></div>
                                                <div class="swiper-button-next sw-control-next"><i
                                                        class="ic-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action action-npi"><a class="btn btn-link btn-xl btn-line-1"
                                            href="#">

                                            <div class="btn-text">MUA NGAY</div><span class="btn-sub-text">Phiên bản 1 ĐỔI
                                                1 + Combo Siêu
                                                Phẩm</span>
                                        </a><a class="btn btn-outline-grayscale btn-xl btn-line-2" href="#">
                                            <div class="btn-text">TRẢ GÓP 0%</div><span class="btn-sub-text">Duyệt nhanh
                                                qua đện
                                                thoại</span>
                                        </a><a class="btn btn-outline-grayscale btn-xl btn-line-2" href="#">
                                            <div class="btn-text">TRẢ GÓP QUA THẺ</div><span class="btn-sub-text">Visa,
                                                Master Card,
                                                JCB</span>
                                        </a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail__body">
            <div class="product-related m-t-48">
                <div class="container">
                    <div class="card card-md">
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="product-related__heading">
                                        <div class="h4">Phụ kiện tương thích</div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail__properties">
                <div class="container">
                    <div class="properties__detail">
                        <div class="properties">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6 col-md-12">
                                        <div class="properties__detail">
                                            <div class="h4 heading">Thông số kỹ thuật</div>
                                            <div class="card card-md">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tbody></tbody>
                                                        <tr>
                                                            <td>CPU</td>
                                                            <td>Intel Core i3-7200U</td>
                                                        </tr>
                                                        <tr>
                                                            <td>RAM</td>
                                                            <td>4 GB DDR4 2600 MHz</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ổ Cứng</td>
                                                            <td>HDD 1000 GB & SSD 128 GB</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Màn hình</td>
                                                            <td> Acer ComfyView™ IPS LED LCD</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Đồ họa</td>
                                                            <td>Card rời: NDIVIA GeForce 1050 Ti; Tích
                                                                hợp: Intel HD Graphics 620</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cổng giao tiếp</td>
                                                            <td>2 x Type-C, 1 x USB 3.0, 1 x USB 2.0, 1 x
                                                                HDMI, 1 x VGA</td>
                                                        </tr>
                                                        <tr>
                                                            <td>PIN</td>
                                                            <td>4 Cell, Li-ion, Liền, 42 W AC Adapter W</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hệ điều hành</td>
                                                            <td>Windows 10 Pro</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trọng lượng (Kg)</td>
                                                            <td>1.2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kích thước (mm)</td>
                                                            <td>Kích thước (mm) 360 x 265 x 12</td>
                                                        </tr>
                                                    </table>
                                                    <div class="trigger"><a class="link"
                                                            aria-controls="properties-modal">Xem cấu hình chi
                                                            tiết<span class="ic-angle-right"></span></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal modal-lg js-modal properties js-modal-properties" data-animation="on"
                        id="properties-modal">
                        <div class="modal-wrapper" tabindex="-1">
                            <div class="modal-box">
                                <div class="modal-header modal-title">
                                    <div class="label label-xl"> <span class="label-text">Chi tiết thông số kỹ
                                            thuật</span></div><span class="modal-close js-modal-close"><i
                                            class="ic-close ic-md"></i></span>
                                </div>
                                <div class="modal-body">
                                    <div class="properties__gallery">
                                        <div class="swiper properties-gallery-main">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide2/600/300" alt="Slide 2">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide3/600/300" alt="Slide 3">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide4/600/300" alt="Slide 4">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide5/600/300" alt="Slide 5">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide6/600/300" alt="Slide 6">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide7/600/300" alt="Slide 7">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide8/600/300" alt="Slide 8">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide9/600/300" alt="Slide 9">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide10/600/300" alt="Slide 10">
                                                </div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide11/600/300" alt="Slide 11">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper properties-gallery-thumb">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide2/115/100"
                                                        alt="Slide thumb 2"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide3/115/100"
                                                        alt="Slide thumb 3"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide4/115/100"
                                                        alt="Slide thumb 4"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide5/115/100"
                                                        alt="Slide thumb 5"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide6/115/100"
                                                        alt="Slide thumb 6"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide7/115/100"
                                                        alt="Slide thumb 7"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide8/115/100"
                                                        alt="Slide thumb 8"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide9/115/100"
                                                        alt="Slide thumb 9"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide10/115/100"
                                                        alt="Slide thumb 10"></div>
                                                <div class="swiper-slide"> <img
                                                        src="https://picsum.photos/seed/slide11/115/100"
                                                        alt="Slide thumb 11"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="properties__menu">
                                        <div class="swiper">
                                            <div class="swiper-wrapper"> <a class="item swiper-slide active"
                                                    data-ref="#block-1">Thông tin
                                                    hàng hóa</a><a class="item swiper-slide" data-ref="#block-2">Màn
                                                    hình</a><a class="item swiper-slide" data-ref="#block-3">Cấu
                                                    hình</a><a class="item swiper-slide" data-ref="#block-4">Lưu trữ</a><a
                                                    class="item swiper-slide" data-ref="#block-5">Giao tiếp
                                                    &amp; kết nối</a><a class="item swiper-slide" data-ref="#block-6">Hệ
                                                    Điều hành</a><a class="item swiper-slide" data-ref="#block-7">Thông
                                                    tin khác</a><a class="item swiper-slide" data-ref="#block-8">phụ kiện
                                                    trong hộp</a></div>
                                        </div>
                                    </div>
                                    <div class="block" id="block-1">
                                        <div class="title">Thông tin hàng hóa</div>
                                        <div class="content">
                                            <ul class="list-group list-bullet list-sm">
                                                <li>
                                                    <div class="text-grayscale">Thương hiệu:</div><a
                                                        class="link">Apple</a>
                                                </li>
                                                <li>
                                                    <div class="text-grayscale">Series:</div><a class="link">iPhone
                                                        11</a>
                                                </li>
                                                <li>
                                                    <div class="text-grayscale">Thời gian ra mắt:</div>
                                                    <div>13/09/2019</div>
                                                </li>
                                                <li>
                                                    <div class="text-grayscale">State:</div>
                                                    <div>On Sale </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="block" id="block-2">
                                        <div class="title">Màn hình</div>
                                        <div class="content">
                                            <table class="table table-md table-default">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale">Phiên bản</div>
                                                        </td>
                                                        <td>
                                                            <ul class="list">
                                                                <li>15.6"</li>
                                                                <li>60 Hz</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phân giải</div>
                                                        </td>
                                                        <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tần số quét</div>
                                                        </td>
                                                        <td>LED</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ sáng</div>
                                                        </td>
                                                        <td>220 nits</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tấm nền</div>
                                                        </td>
                                                        <td>TN</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phủ màu</div>
                                                        </td>
                                                        <td>45% NTSC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ tương phản</div>
                                                        </td>
                                                        <td>400:1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="block" id="block-3">
                                        <div class="title">Cấu hình</div>
                                        <div class="content">
                                            <table class="table table-md table-default">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale">Phiên bản</div>
                                                        </td>
                                                        <td>
                                                            <ul class="list">
                                                                <li>15.6"</li>
                                                                <li>60 Hz</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phân giải</div>
                                                        </td>
                                                        <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tần số quét</div>
                                                        </td>
                                                        <td>LED</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ sáng</div>
                                                        </td>
                                                        <td>220 nits</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tấm nền</div>
                                                        </td>
                                                        <td>TN</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phủ màu</div>
                                                        </td>
                                                        <td>45% NTSC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ tương phản</div>
                                                        </td>
                                                        <td>400:1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="block" id="block-4">
                                        <div class="title">Lưu trữ</div>
                                        <div class="content">
                                            <table class="table table-md table-default">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale">Phiên bản</div>
                                                        </td>
                                                        <td>
                                                            <ul class="list">
                                                                <li>15.6"</li>
                                                                <li>60 Hz</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phân giải</div>
                                                        </td>
                                                        <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tần số quét</div>
                                                        </td>
                                                        <td>LED</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ sáng</div>
                                                        </td>
                                                        <td>220 nits</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tấm nền</div>
                                                        </td>
                                                        <td>TN</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phủ màu</div>
                                                        </td>
                                                        <td>45% NTSC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ tương phản</div>
                                                        </td>
                                                        <td>400:1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="block" id="block-5">
                                        <div class="title">Giao tiếp & kết nối</div>
                                        <div class="content">
                                            <div class="badge-list"><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span><span
                                                    class="badge badge-grayscale badge-xs">badge</span></div>
                                        </div>
                                    </div>
                                    <div class="block" id="block-6">
                                        <div class="title">Hệ điều hành</div>
                                        <div class="content">
                                            <table class="table table-md table-default">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale">Phiên bản</div>
                                                        </td>
                                                        <td>
                                                            <ul class="list">
                                                                <li>15.6"</li>
                                                                <li>60 Hz</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phân giải</div>
                                                        </td>
                                                        <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tần số quét</div>
                                                        </td>
                                                        <td>LED</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ sáng</div>
                                                        </td>
                                                        <td>220 nits</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tấm nền</div>
                                                        </td>
                                                        <td>TN</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phủ màu</div>
                                                        </td>
                                                        <td>45% NTSC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ tương phản</div>
                                                        </td>
                                                        <td>400:1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="block" id="block-7">
                                        <div class="title">Thông tin khác</div>
                                        <div class="content">
                                            <table class="table table-md table-default">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale">Phiên bản</div>
                                                        </td>
                                                        <td>
                                                            <ul class="list">
                                                                <li>15.6"</li>
                                                                <li>60 Hz</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phân giải</div>
                                                        </td>
                                                        <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tần số quét</div>
                                                        </td>
                                                        <td>LED</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ sáng</div>
                                                        </td>
                                                        <td>220 nits</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Tấm nền</div>
                                                        </td>
                                                        <td>TN</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ phủ màu</div>
                                                        </td>
                                                        <td>45% NTSC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale"> Độ tương phản</div>
                                                        </td>
                                                        <td>400:1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="block" id="block-8">
                                        <div class="title">Phụ kiện trong hộp</div>
                                        <div class="content">
                                            <ul class="list-pk">
                                                <li>
                                                    <div class="ic"> <span class="ic-doc"></span></div>
                                                    <div class="text">Sách huớng dẫn sử dụng </div>
                                                </li>
                                                <li>
                                                    <div class="ic"> <span class="ic-cable"></span></div>
                                                    <div class="text">Cáp sạc</div>
                                                </li>
                                                <li>
                                                    <div class="ic"> <span class="ic-wireless-mouse"></span></div>
                                                    <div class="text">Chuột không dây</div>
                                                </li>
                                                <li>
                                                    <div class="ic"> <span class="ic-wireless-keyboard"></span></div>
                                                    <div class="text">Bàn phím không dây</div>
                                                </li>
                                                <li>
                                                    <div class="ic"> <span class="ic-power"></span></div>
                                                    <div class="text">Bộ sạc điện</div>
                                                </li>
                                                <li>
                                                    <div class="ic"><span class="ic-shockproof-bag"></span></div>
                                                    <div class="text">Túi chống sốc</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="block" id="block-9">
                                        <div class="title">Camera sau</div>
                                        <div class="subtitle">Triple rear camera</div>
                                        <div class="table-wrapper">
                                            <div class="table-col">
                                                <div class="table-title">Standard</div>
                                                <table class="table table-md table-default">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale">Phiên bản</div>
                                                            </td>
                                                            <td>
                                                                <ul class="list">
                                                                    <li>15.6"</li>
                                                                    <li>60 Hz</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ phân giải</div>
                                                            </td>
                                                            <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Tần số quét</div>
                                                            </td>
                                                            <td>LED</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ sáng</div>
                                                            </td>
                                                            <td>220 nits</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Tấm nền</div>
                                                            </td>
                                                            <td>TN</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ phủ màu</div>
                                                            </td>
                                                            <td>45% NTSC</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ tương phản</div>
                                                            </td>
                                                            <td>400:1</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="table-col">
                                                <div class="table-title">Ultra Wide</div>
                                                <table class="table table-md table-default">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale">Phiên bản</div>
                                                            </td>
                                                            <td>
                                                                <ul class="list">
                                                                    <li>15.6"</li>
                                                                    <li>60 Hz</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ phân giải</div>
                                                            </td>
                                                            <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Tần số quét</div>
                                                            </td>
                                                            <td>LED</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ sáng</div>
                                                            </td>
                                                            <td>220 nits</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Tấm nền</div>
                                                            </td>
                                                            <td>TN</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ phủ màu</div>
                                                            </td>
                                                            <td>45% NTSC</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ tương phản</div>
                                                            </td>
                                                            <td>400:1</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="table-col">
                                                <div class="table-title">Telephoto</div>
                                                <table class="table table-md table-default">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale">Phiên bản</div>
                                                            </td>
                                                            <td>
                                                                <ul class="list">
                                                                    <li>15.6"</li>
                                                                    <li>60 Hz</li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ phân giải</div>
                                                            </td>
                                                            <td> <a class="link">1920 x 1080 Pixel</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Tần số quét</div>
                                                            </td>
                                                            <td>LED</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ sáng</div>
                                                            </td>
                                                            <td>220 nits</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Tấm nền</div>
                                                            </td>
                                                            <td>TN</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ phủ màu</div>
                                                            </td>
                                                            <td>45% NTSC</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="text-grayscale"> Độ tương phản</div>
                                                            </td>
                                                            <td>400:1</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <table class="table table-md table-default">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="text-grayscale">Phiên bản</div>
                                                        </td>
                                                        <td>
                                                            <ul class="list-group list-bullet list-sm">
                                                                <li>
                                                                    <div class="text-grayscale-700">4K 4320p@24fps</div>
                                                                </li>
                                                                <li>
                                                                    <div class="text-grayscale-700">FullHD 1080p@30fps
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="text-grayscale-700">HD 720p@30fps</div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="block" id="block-10">
                                        <div class="title">Cảm biến</div>
                                        <div class="content">
                                            <ul class="list-group list-bullet list-sm">
                                                <li>
                                                    <div class="text-grayscale-700">Cảm biến tiệm cận</div>
                                                </li>
                                                <li>
                                                    <div class="text-grayscale-700">Cảm biến la bàn</div>
                                                </li>
                                                <li>
                                                    <div class="text-grayscale-700">Cảm biến ánh sáng</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="block" id="block-11">
                                        <div class="title">Bảo mật</div>
                                        <div class="content">
                                            <ul class="list-group list-bullet list-sm">
                                                <li>
                                                    <div class="text-grayscale-700">Cảm biến tiệm cận</div>
                                                </li>
                                                <li>
                                                    <div class="text-grayscale-700">Cảm biến la bàn</div>
                                                </li>
                                                <li>
                                                    <div class="text-grayscale-700">Cảm biến ánh sáng</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail__post">
                <div class="container">
                    <div class="row">
                        <div class="col-9">
                            <div class="content">
                                <div class="description">Sắc màu mới nhất của iPhone 13 series đã lộ diện, phiên bản
                                    Green/Alpine
                                    Green với màu xanh lá chủ đạo giúp dòng iPhone 13 đem lại cảm nhận khác biệt về cấu trúc
                                    thẩm mỹ.
                                </div>
                                <h3>Nét đẹp sang trọng pha chút bí ẩn</h3>
                                <p>Sự cao cấp toát lên ở mọi chi tiết là điều mà bạn có thể dễ dàng cảm nhận được trên
                                    iPhone 13
                                    Pro. Được chế tác từ khung thép không gỉ cứng cáp, bảo vệ màn hình là mặt gốm Ceramic
                                    Shield siêu
                                    cứng cùng ngôn ngữ thiết kế phẳng hiện đại, iPhone 13 Pro có vẻ đẹp trường tồn theo năm
                                    tháng.</p>
                                <p>Điện thoại còn đạt chuẩn chống nước IP68, tránh được mọi nguy cơ từ nước trong cuộc sống
                                    thường
                                    ngày. Bên cạnh 3 màu sắc quen thuộc là Xám, Vàng, Trắng, iPhone 13 Pro năm nay có thêm
                                    màu Xanh
                                    Sierra đẹp theo xu hướng thanh lịch và độc đáo.</p>
                                <div class="img"><img src="assets/img/post1.png" alt="alt"></div>
                                <h3>Thể hiện đẳng cấp trong từng đường nét</h3>
                                <p>Với việc bổ sung thêm tùy chọn Alpine Green vào các phiên bản màu sắc, iPhone 13 Pro màu
                                    xanh lá
                                    giờ đây cho thấy vẻ đẹp khác biệt, phô diễn nét đẹp trầm mặc và diện mạo thực sự cao
                                    cấp. Apple đã
                                    nghiên cứu kỹ lưỡng để chọn ra sắc màu thành phẩm sau cùng cho chiếc điện thoại nhằm
                                    truyền tải rõ
                                    nét tinh thần sang trọng vốn có của sản phẩm.</p>
                                <div class="img"><img src="assets/img/post2.png" alt="alt"></div>
                                <p>Sự cao cấp toát lên ở mọi chi tiết là điều mà bạn có thể dễ dàng cảm nhận được trên
                                    iPhone 13
                                    Pro. Được chế tác từ khung thép không gỉ cứng cáp, bảo vệ màn hình là mặt gốm Ceramic
                                    Shield siêu
                                    cứng cùng ngôn ngữ thiết kế phẳng hiện đại, iPhone 13 Pro có vẻ đẹp trường tồn theo năm
                                    tháng.</p>
                                <p>Điện thoại còn đạt chuẩn chống nước IP68, tránh được mọi nguy cơ từ nước trong cuộc sống
                                    thường
                                    ngày. Bên cạnh 3 màu sắc quen thuộc là Xám, Vàng, Trắng, iPhone 13 Pro năm nay có thêm
                                    màu Xanh
                                    Sierra đẹp theo xu hướng thanh lịch và độc đáo.</p>
                                <p>Điện thoại còn đạt chuẩn chống nước IP68, tránh được mọi nguy cơ từ nước trong cuộc sống
                                    thường
                                    ngày. Bên cạnh 3 màu sắc quen thuộc là Xám, Vàng, Trắng, iPhone 13 Pro năm nay có thêm
                                    màu Xanh
                                    Sierra đẹp theo xu hướng thanh lịch và độc đáo.</p>
                                <div class="img"><img src="assets/img/post2.png" alt="alt"></div>
                                <div class="img"><img src="https://picsum.photos/seed/slide1/700/497" alt="alt">
                                </div>
                                <p>Sự cao cấp toát lên ở mọi chi tiết là điều mà bạn có thể dễ dàng cảm nhận được trên
                                    iPhone 13
                                    Pro. Được chế tác từ khung thép không gỉ cứng cáp, bảo vệ màn hình là mặt gốm Ceramic
                                    Shield siêu
                                    cứng cùng ngôn ngữ thiết kế phẳng hiện đại, iPhone 13 Pro có vẻ đẹp trường tồn theo năm
                                    tháng.</p>
                                <p>Điện thoại còn đạt chuẩn chống nước IP68, tránh được mọi nguy cơ từ nước trong cuộc sống
                                    thường
                                    ngày. Bên cạnh 3 màu sắc quen thuộc là Xám, Vàng, Trắng, iPhone 13 Pro năm nay có thêm
                                    màu Xanh
                                    Sierra đẹp theo xu hướng thanh lịch và độc đáo.</p>
                                <div class="img"><img src="assets/img/post3.png" alt="alt"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail__landing">
                <div class="feature feature-l8">
                    <div class="img"> <img src="assets/img/l8-img1.png" alt="alt"><img
                            src="assets/img/l8-img2.png" alt="alt">
                    </div>
                    <div class="content">
                        <div class="h1">Siêu mạnh mẽ cho dân Pro </div>
                        <div class="text">Chip M1 Pro hay M1 Max nhanh như chớp mang đến hiệu suất đột phá và thời lượng
                            pin ấn
                            tượng. Màn hình Liquid Retina XDR lộng lẫy và tất cả các cổng kết nối bạn cần. Đây chính là
                            chiếc máy
                            tính xách tay bạn hằng mong đợi.</div>
                    </div>
                </div>
                <div class="feature feature-l2 feature--dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="img"><img src="assets/img/l2-img1.png" alt="alt"></div>
                            </div>
                            <div class="col-6">
                                <div class="content">
                                    <div class="h3">Năng lực mạnh mẽ</div>
                                    <div class="h1">Hiệu năng mạnh mẽ. Không ngốn pin.</div>
                                    <div class="text">Khả năng tiết kiệm điện đáng kinh ngạc của chip M1 Pro hoặc M1 Max
                                        đặt ra chuẩn
                                        mới cho hiệu năng và đưa thời lượng pin lên đẳng cấp mới. Nhờ đó, bạn có thể dễ dàng
                                        xử lý tác
                                        vụ chỉnh sửa video 8K, lập trình hay kết xuất cảnh quay phức tạp ở định dạng 3D từ
                                        bất cứ nơi
                                        đâu.</div>
                                    <ul class="list">
                                        <li> <span>Thời lượng pin lên tới</span>
                                            <div>21 giờ</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature feature-l9 feature--dark">
                    <div class="container">
                        <div class="row">
                            <div class="col-5">
                                <div class="content">
                                    <div class="h3">Apple Silicon</div>
                                    <div class="h1">Pro tới Max.</div>
                                    <div class="text">Hiệu năng đồ họa nhanh gấp 4 lần và công nghệ học máy nhanh gấp 5
                                        lần trên phiên
                                        bản 16 inch. Hiệu năng đồ họa nhanh gấp 13 lần và công nghệ học máy nhanh gấp 11 lần
                                        trên phiên
                                        bản 14 inch.</div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="img"><img src="assets/img/l9-img1.png" alt="alt"><img
                                        src="assets/img/l9-img2.png" alt="alt"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature feature-l10">
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                <div class="img"><img src="assets/img/l10-img.png" alt="alt"></div>
                                <div class="content">
                                    <div class="h3">Màn hình</div>
                                    <div class="h1">Đại tiệc cho thị giác trên màn hình XDR.</div>
                                    <div class="text">Màn hình Liquid Retina XDR cho Extreme Dynamic Range và tỉ lệ tương
                                        phản tuyệt
                                        vời. Hình ảnh có độ chi tiết cực đỉnh trong vùng tối, màu đen sâu hơn và nhiều màu
                                        sắc rực rỡ
                                        hơn bao giờ hết.</div>
                                    <ul class="list">
                                        <li> <span>Độ sáng liên tục lên đến</span>
                                            <div>1000 nit</div>
                                        </li>
                                        <li> <span>Độ sáng cao nhất lên đến</span>
                                            <div>1600 nit</div>
                                        </li>
                                        <li> <span>Tỉ lệ tương phản</span>
                                            <div>1.000.000:1</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature feature-l5">
                    <div class="img"><img src="assets/img/l5-img.png" alt="alt"></div>
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col"> </div>
                                <div class="col-5">
                                    <div class="h3">Camera, Micro và Loa</div>
                                    <div class="h1">Gọi video sắc nét hơn. Âm thanh trong veo.</div>
                                    <div class="text">Camera FaceTime HD 1080p được cải tiến. Hệ thống âm thanh sáu loa
                                        mạnh mẽ với âm
                                        thanh không gian. Và dãy micro chất lượng chuẩn studio. Vì vậy hình ảnh và tiếng nói
                                        của bạn
                                        luôn rõ đẹp nhất.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature feature-l6">
                    <div class="img"><img src="assets/img/l6-img.png" alt="alt"></div>
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-5">
                                    <div class="h3">Kết nối</div>
                                    <div class="h1">Nhiều kết nối hơn bao giờ hết.</div>
                                    <div class="text">Nhiều cổng kết nối dành cho dân chuyên, bao gồm cả SDXC, HDMI,
                                        Thunderbolt 4 và
                                        jack cắm tai nghe. Và sạc bằng cáp MagSafe 3.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature feature-l3">
                    <div class="container">
                        <div class="row">
                            <div class="col-5">
                                <div class="content">
                                    <div class="h3">macOS và Các Ứng Dụng Pro</div>
                                    <div class="h1">Khai phóng sức mạnh của M1 Pro và M1 Max.</div>
                                    <div class="text">Hơn 10.000 ứng dụng và phần bổ trợ đã được tối ưu hóa cho Apple
                                        silicon nhờ
                                        macOS Monterey, bao gồm cả Final Cut Pro, Logic Pro, Cinema 4D và Microsoft 365.
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="img"><img src="assets/img/l3-img.png" alt="alt"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail__bottom">
            <div class="product-related m-b-48">
                <div class="container">
                    <div class="card card-md">
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="product-related__heading">
                                        <div class="h4">Dòng sản phẩm khác</div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6">
                                    <div class="item"><a class="item__img" href="#"><img
                                                src="https://via.placeholder.com/210x210" alt=""></a>
                                        <div class="item__info"><a href="#">
                                                <div class="item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để chiến
                                                    game </div>
                                            </a>
                                            <div class="item__price">
                                                <div class="text text-primary">28.999.000₫ </div>
                                                <div class="text text-grayscale">33.999.000₫</div><strike
                                                    class="text text-grayscale">34.999.000₫</strike>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail__question">
                <div class="container">
                    <div class="accordion accordion-card m-b-48">
                        <div class="accordion-title"> <span>Câu hỏi thường gặp</span></div>
                        <div class="accordion-tab">
                            <div class="accordion-content">
                                <div class="accordion-content-title">
                                    <div class="label"><i class="ic-help ic-circle"></i><span>
                                            <p>Tại sao hàng chính hãng lại đắt hơn hàng xách tay bán tại các cửa hàng khác ?
                                            </p>
                                        </span></div>
                                </div>
                                <div class="accordion-content-description">
                                    <div> F.Studio by FPT là đại lý ủy quyền bán hàng Apple chính hãng tại Việt Nam,
                                        F.Studio by FPT
                                        chỉ bán 1 loại hàng hóa duy nhất là: Hàng chính hãng</div>
                                </div>
                            </div>
                            <div class="accordion-action">
                                <div
                                    class="js-accordion-action btn btn-icon-single btn-rounded btn-outline-grayscale btn-md">
                                    <i class="ic-plus"> </i>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-tab">
                            <div class="accordion-content">
                                <div class="accordion-content-title">
                                    <div class="label"><i class="ic-help ic-circle"></i><span>
                                            <p>Tại sao hàng chính hãng lại đắt hơn hàng xách tay bán tại các cửa hàng khác ?
                                            </p>
                                        </span></div>
                                </div>
                                <div class="accordion-content-description">
                                    <div> F.Studio by FPT là đại lý ủy quyền bán hàng Apple chính hãng tại Việt Nam,
                                        F.Studio by FPT
                                        chỉ bán 1 loại hàng hóa duy nhất là: Hàng chính hãng</div>
                                </div>
                            </div>
                            <div class="accordion-action">
                                <div
                                    class="js-accordion-action btn btn-icon-single btn-rounded btn-outline-grayscale btn-md">
                                    <i class="ic-plus"> </i>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-tab">
                            <div class="accordion-content">
                                <div class="accordion-content-title">
                                    <div class="label"><i class="ic-help ic-circle"></i><span>
                                            <p>Tại sao hàng chính hãng lại đắt hơn hàng xách tay bán tại các cửa hàng khác ?
                                            </p>
                                        </span></div>
                                </div>
                                <div class="accordion-content-description">
                                    <div> F.Studio by FPT là đại lý ủy quyền bán hàng Apple chính hãng tại Việt Nam,
                                        F.Studio by FPT
                                        chỉ bán 1 loại hàng hóa duy nhất là: Hàng chính hãng</div>
                                </div>
                            </div>
                            <div class="accordion-action">
                                <div
                                    class="js-accordion-action btn btn-icon-single btn-rounded btn-outline-grayscale btn-md">
                                    <i class="ic-plus"> </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="news m-b-48 news--vertical news--related">
                <div class="container">
                    <div class="card card-md">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="news__heading">
                                        <div class="h4">Tin tức - Thủ thuật về MacBook Pro 16” 2021 M1 Pro </div><a
                                            class="link link-sm" href="#">Xem tất cả</a>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6 col-xs-12">
                                    <div class="news-item"><a class="news-item__img" href="#"><img
                                                src="https://via.placeholder.com/266x176" alt=""></a>
                                        <div class="news-item__info"><a href="#">
                                                <div class="news-item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để
                                                    chiến game </div>
                                            </a>
                                            <div class="news-item__badge"> <a class="badge badge-grayscale badge-xs"
                                                    href="#">Tin khuyến
                                                    mãi</a><a class="badge badge-grayscale badge-xs" href="#">Mẹo
                                                    laptop</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6 col-xs-12">
                                    <div class="news-item"><a class="news-item__img" href="#"><img
                                                src="https://via.placeholder.com/266x176" alt=""></a>
                                        <div class="news-item__info"><a href="#">
                                                <div class="news-item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để
                                                    chiến game </div>
                                            </a>
                                            <div class="news-item__badge"> <a class="badge badge-grayscale badge-xs"
                                                    href="#">Tin khuyến
                                                    mãi</a><a class="badge badge-grayscale badge-xs" href="#">Mẹo
                                                    laptop</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6 col-xs-12">
                                    <div class="news-item"><a class="news-item__img" href="#"><img
                                                src="https://via.placeholder.com/266x176" alt=""></a>
                                        <div class="news-item__info"><a href="#">
                                                <div class="news-item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để
                                                    chiến game </div>
                                            </a>
                                            <div class="news-item__badge"> <a class="badge badge-grayscale badge-xs"
                                                    href="#">Tin khuyến
                                                    mãi</a><a class="badge badge-grayscale badge-xs" href="#">Mẹo
                                                    laptop</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-6 col-xs-12">
                                    <div class="news-item"><a class="news-item__img" href="#"><img
                                                src="https://via.placeholder.com/266x176" alt=""></a>
                                        <div class="news-item__info"><a href="#">
                                                <div class="news-item__name">Những lý do nên lựa chọn laptop Asus TUF
                                                    FA506II-AL012T để
                                                    chiến game </div>
                                            </a>
                                            <div class="news-item__badge"> <a class="badge badge-grayscale badge-xs"
                                                    href="#">Tin khuyến
                                                    mãi</a><a class="badge badge-grayscale badge-xs" href="#">Mẹo
                                                    laptop</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 show-mdm">
                                    <div class="text-center m-t-8 m-b-4"><a class="link link-icon link-sm"
                                            href="#">Xem tất cả<i class="ic-angle-down m-l-4"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail__comments">
                <div class="fpt-comment">
                    <div class="container">
                        <div class="card card-md user-feedback">
                            <div class="card-title">
                                <h3 class="h5 heading">Hỏi & Đáp</h3>
                                <div class="form-group">
                                    <div class="form-search form-search-md"><span class="form-search-icon m-r-4"><i
                                                class="ic-search ic-sm"></i></span><input class="form-search-input m-r-8"
                                            type="text" placeholder="Tìm theo nội dung, người gửi..."><span
                                            class="form-search-icon form-search-clear"><i
                                                class="ic-close ic-md"></i></span></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="user-form">
                                    <div class="flex flex-center-ver m-b-8">
                                        <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận: <strong>Vy</strong>
                                        </div><a class="link link-xs link-icon"><span class="ic m-r-4"><i
                                                    class="ic-edit ic-xs text-link"></i></span>Thay đổi</a>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-input form-input-lg" rows="3"
                                            placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea><button class="btn btn-lg btn-primary"
                                            aria-controls="comment-info">GỬI BÌNH LUẬN</button>
                                    </div>
                                    <div class="upload-action">
                                        <div class="btn btn-outline-grayscale btn-md btn-icon btn-icon-left"><span
                                                class="f-s-ui-16">Thêm ảnh</span><i
                                                class="ic-camera ic-sm text-grayscale"></i></div><span class="text">Chỉ
                                            thêm <strong>tối đa 5 ảnh</strong></span>
                                    </div>
                                    <div class="upload-list">
                                        <div class="item">
                                            <div class="img"><img src="assets/img/thumb1.jpg" alt="alt"></div><a
                                                class="link link-xs">Xoá</a>
                                        </div>
                                        <div class="item">
                                            <div class="img"><img src="assets/img/thumb2.jpg" alt="alt"></div><a
                                                class="link link-xs">Xoá</a>
                                        </div>
                                        <div class="item">
                                            <div class="img"><img src="assets/img/thumb3.jpg" alt="alt"></div>
                                            <div class="progress-primary progress-sm progress-line">
                                                <div class="progress-bar" style="width: 70%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-content">
                                    <div class="result">
                                        <div class="text"><strong>1.000 hỏi đáp về</strong>“Samsung Galaxy S22 Ultra 5G
                                            128GB”</div>
                                        <div class="auto">
                                            <div class="text">Sắp xếp theo</div>
                                            <div class="dropdown js-dropdown dropdown-xs">
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
                                        </div>
                                    </div>
                                    <div class="user-wrapper">
                                        <div class="user-block">
                                            <div class="avatar avatar-md avatar-text avatar-circle">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trương Thảo</div>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">Thái nguyên có hàng không vậy?</div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>-----Phần này để test -------------</p>
                                            <div class="avatar avatar-md avatar-text avatar-circle js-gallery-container">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trương Thảo</div>
                                                        <div
                                                            class="alert alert-success alert-xs alert-single alert-no-fill">
                                                            <div class="label label-xs"><i
                                                                    class="ic-check ic-circle ic-xs m-r-4"></i><span
                                                                    class="alert-text label-text">Đã mua tại
                                                                    FPTShop</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-rate">
                                                        <ul class="list-star">
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-grayscale"></span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">Thái nguyên có hàng không vậy?</div>
                                                    </div>
                                                    <div class="avatar-image">
                                                        <div class="upload-list">
                                                            <div class="item" data-src="assets/img/thumb1.jpg">
                                                                <div class="img"><img src="assets/img/thumb1.jpg"
                                                                        alt="alt"></div>
                                                            </div>
                                                            <div class="item" data-src="assets/img/thumb2.jpg">
                                                                <div class="img"><img src="assets/img/thumb2.jpg"
                                                                        alt="alt"></div>
                                                            </div>
                                                            <div class="item" data-src="assets/img/thumb3.jpg">
                                                                <div class="img"><img src="assets/img/thumb3.jpg"
                                                                        alt="alt"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="avatar avatar-md avatar-text avatar-circle js-gallery-container">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trương Thảo</div>
                                                        <div
                                                            class="alert alert-success alert-xs alert-single alert-no-fill">
                                                            <div class="label label-xs"><i
                                                                    class="ic-check ic-circle ic-xs m-r-4"></i><span
                                                                    class="alert-text label-text">Đã mua tại
                                                                    FPTShop</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-rate">
                                                        <ul class="list-star">
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-warning"></span></li>
                                                            <li><span class="ic-star ic-color-grayscale"></span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">Thái nguyên có hàng không vậy?</div>
                                                    </div>
                                                    <div class="avatar-image">
                                                        <div class="upload-list">
                                                            <div class="item" data-src="assets/img/thumb1.jpg">
                                                                <div class="img"><img src="assets/img/thumb1.jpg"
                                                                        alt="alt"></div>
                                                            </div>
                                                            <div class="item" data-src="assets/img/thumb2.jpg">
                                                                <div class="img"><img src="assets/img/thumb2.jpg"
                                                                        alt="alt"></div>
                                                            </div>
                                                            <div class="item" data-src="assets/img/thumb3.jpg">
                                                                <div class="img"><img src="assets/img/thumb3.jpg"
                                                                        alt="alt"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>-----Phần này để test end -------------</p>
                                        </div>
                                        <div class="user-block reply">
                                            <div class="avatar avatar-md avatar-logo avatar-circle">
                                                <div class="avatar-shape"><img src="assets/img/logo.png" alt="">
                                                </div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trần Quốc Hoàn</div><span
                                                            class="badge badge-grayscale badge-xxs m-l-4">Quản trị
                                                            viên</span>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">
                                                            <p>Chào chị Hoàng Yến Nam Bình,</p>
                                                            <p>Dạ trường hợp này không biết chị để máy không sử dụng trong
                                                                bao lâu và máy tụt bao
                                                                nhiêu phần trăm pin vậy ạ</p>
                                                            <p>Mong phản hồi từ chị.</p>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block">
                                            <div class="avatar avatar-md avatar-text avatar-circle">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trương Thảo</div>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">Thái nguyên có hàng không vậy?</div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs link-icon"><i
                                                                class="ic-like ic-xs m-r-4"></i>Thích (1)</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block">
                                            <div class="avatar avatar-md avatar-text avatar-circle">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trương Thảo</div>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">Thái nguyên có hàng không vậy?</div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block reply">
                                            <div class="avatar avatar-md avatar-logo avatar-circle">
                                                <div class="avatar-shape"><img src="assets/img/logo.png"
                                                        alt=""></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trần Quốc Hoàn</div><span
                                                            class="badge badge-grayscale badge-xxs m-l-4">Quản trị
                                                            viên</span>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">
                                                            <p>Chào chị Hoàng Yến Nam Bình,</p>
                                                            <p>Dạ trường hợp này không biết chị để máy không sử dụng trong
                                                                bao lâu và máy tụt bao
                                                                nhiêu phần trăm pin vậy ạ</p>
                                                            <p>Mong phản hồi từ chị.</p>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block reply">
                                            <div class="avatar avatar-md avatar-text avatar-circle">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">SL</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Sơn Lâm</div>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">
                                                            <p>@Trần Quốc Hoàn: ok mình cảm ơn</p>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs link-icon"><i
                                                                class="ic-like ic-xs m-r-4"></i>Thích (1)</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block">
                                            <div class="avatar avatar-md avatar-text avatar-circle">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trương Thảo</div>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">Thái nguyên có hàng không vậy?</div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block reply">
                                            <div class="avatar avatar-md avatar-logo avatar-circle">
                                                <div class="avatar-shape"><img src="assets/img/logo.png"
                                                        alt=""></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trần Quốc Hoàn</div><span
                                                            class="badge badge-grayscale badge-xxs m-l-4">Quản trị
                                                            viên</span>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">
                                                            <p>Chào chị Hoàng Yến Nam Bình,</p>
                                                            <p>Dạ trường hợp này không biết chị để máy không sử dụng trong
                                                                bao lâu và máy tụt bao
                                                                nhiêu phần trăm pin vậy ạ</p>
                                                            <p>Mong phản hồi từ chị.</p>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs link-icon"><i
                                                                class="ic-like ic-xs m-r-4"></i>Thích (1)</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                                <div class="avatar-form">
                                                    <div class="form-group">
                                                        <textarea class="form-input form-input-lg" rows="3"
                                                            placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)...">@Trần Quốc Hoàn mình cảm ơn nhiều</textarea><button class="btn btn-lg btn-primary"
                                                            aria-controls="comment-info">GỬI BÌNH LUẬN</button>
                                                    </div>
                                                    <div class="upload-action">
                                                        <div
                                                            class="btn btn-outline-grayscale btn-md btn-icon btn-icon-left">
                                                            <span class="f-s-ui-16">Thêm ảnh</span><i
                                                                class="ic-camera ic-sm text-grayscale"></i>
                                                        </div><span class="text">Chỉ thêm <strong>tối đa 5
                                                                ảnh</strong></span>
                                                    </div>
                                                    <div class="upload-list">
                                                        <div class="item">
                                                            <div class="img"><img src="assets/img/thumb1.jpg"
                                                                    alt="alt"></div><a class="link link-xs">Xoá</a>
                                                        </div>
                                                        <div class="item">
                                                            <div class="img"><img src="assets/img/thumb2.jpg"
                                                                    alt="alt"></div><a class="link link-xs">Xoá</a>
                                                        </div>
                                                        <div class="item">
                                                            <div class="img"><img src="assets/img/thumb3.jpg"
                                                                    alt="alt"></div><a class="link link-xs">Xoá</a>
                                                        </div>
                                                        <div class="item">
                                                            <div class="img"><img src="assets/img/thumb4.jpg"
                                                                    alt="alt"></div>
                                                            <div class="progress-primary progress-sm progress-line">
                                                                <div class="progress-bar" style="width: 70%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block">
                                            <div class="avatar avatar-md avatar-text avatar-circle">
                                                <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trương Thảo</div>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">Thái nguyên có hàng không vậy?</div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Thích</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-block reply">
                                            <div class="avatar avatar-md avatar-logo avatar-circle">
                                                <div class="avatar-shape"><img src="assets/img/logo.png"
                                                        alt=""></div>
                                                <div class="avatar-info">
                                                    <div class="avatar-name">
                                                        <div class="text">Trần Quốc Hoàn</div><span
                                                            class="badge badge-grayscale badge-xxs m-l-4">Quản trị
                                                            viên</span>
                                                    </div>
                                                    <div class="avatar-para">
                                                        <div class="text">
                                                            <p>Chào chị Hoàng Yến Nam Bình,</p>
                                                            <p>Dạ trường hợp này không biết chị để máy không sử dụng trong
                                                                bao lâu và máy tụt bao
                                                                nhiêu phần trăm pin vậy ạ</p>
                                                            <p>Mong phản hồi từ chị.</p>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-time">
                                                        <div class="text text-grayscale">1 giờ trước</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs link-icon"><i
                                                                class="ic-like ic-xs m-r-4"></i>Thích (1)</div><i
                                                            class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                                <div class="avatar-form">
                                                    <div class="flex flex-center-ver m-b-8">
                                                        <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận:
                                                            <strong>Vy</strong>
                                                        </div><a class="link link-xs link-icon"><span
                                                                class="ic m-r-4"><i
                                                                    class="ic-edit ic-xs text-link"></i></span>Thay
                                                            đổi</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-input form-input-lg" rows="3"
                                                            placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)...">@Trần Quốc Hoàn mình cảm ơn nhiều</textarea><button class="btn btn-lg btn-primary"
                                                            aria-controls="comment-info">GỬI BÌNH LUẬN</button>
                                                    </div>
                                                    <div class="upload-action">
                                                        <div
                                                            class="btn btn-outline-grayscale btn-md btn-icon btn-icon-left">
                                                            <span class="f-s-ui-16">Thêm ảnh</span><i
                                                                class="ic-camera ic-sm text-grayscale"></i>
                                                        </div><span class="text">Chỉ thêm <strong>tối đa 5
                                                                ảnh</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pages">
                                        <ul class="pagination pagination-space">
                                            <li class="pagination-item"><a class="pagination-link" href="#"><i
                                                        class="ic-angle-left"></i></a></li>
                                            <li class="pagination-item"><a class="pagination-link"
                                                    href="#">1</a></li>
                                            <li class="pagination-item active"><a class="pagination-link"
                                                    href="#">2</a></li>
                                            <li class="pagination-item"><a class="pagination-link"
                                                    href="#">3</a></li>
                                            <li class="pagination-item"><a class="pagination-link"
                                                    href="#">4</a></li>
                                            <li class="pagination-item"><a class="pagination-link"
                                                    href="#">...</a></li>
                                            <li class="pagination-item"><a class="pagination-link"
                                                    href="#">10</a></li>
                                            <li class="pagination-item"><a class="pagination-link" href="#"><i
                                                        class="ic-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-animation js-modal scale popup-modal modal-incentives" id="modal-incentives"
            data-animation="on">
            <div class="modal-wrapper" tabindex="-1">
                <div class="modal-box">
                    <div class="modal-header modal-title">
                        <div class="title">Ưu đãi thanh toán</div><span class="modal-close js-modal-close"><i
                                class="ic-close"></i></span>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>
                                <div class="prod-card">
                                    <div class="prod-card-img"><img src="" alt=""></div>
                                    <div class="prod-card-info">
                                        <p class="prod-card-name">OCB</p>
                                        <p class="prod-card-desc"></p>Giảm thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                            class="link">Chi tiết</a>
                                        <div class="prod-card-btn"> <button class="btn btn-rounded btn-icon"><span
                                                    class="ic-check"></span><span class="btn-label">Chọn</span></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="prod-card">
                                    <div class="prod-card-img"><img src="" alt=""></div>
                                    <div class="prod-card-info">
                                        <p class="prod-card-name">OCB</p>
                                        <p class="prod-card-desc"></p>Giảm thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                            class="link">Chi tiết</a>
                                        <div class="prod-card-btn"> <button class="btn btn-rounded btn-icon "><span
                                                    class="ic-check"></span><span class="btn-label">Chọn
                                                </span></button></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="prod-card">
                                    <div class="prod-card-img"><img src="" alt=""></div>
                                    <div class="prod-card-info">
                                        <p class="prod-card-name">OCB</p>
                                        <p class="prod-card-desc"></p>Giảm thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                            class="link">Chi tiết</a>
                                        <div class="prod-card-btn"> <button
                                                class="btn btn-rounded btn-icon btn-active"><span
                                                    class="ic-check"></span><span class="btn-label">Đã Chọn
                                                </span></button></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="prod-card">
                                    <div class="prod-card-img"><img src="" alt=""></div>
                                    <div class="prod-card-info">
                                        <p class="prod-card-name">OCB</p>
                                        <p class="prod-card-desc"></p>Giảm thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                            class="link">Chi tiết</a>
                                        <div class="prod-card-btn"> <button class="btn btn-rounded btn-icon "><span
                                                    class="ic-check"></span><span class="btn-label">Chọn
                                                </span></button></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="prod-card">
                                    <div class="prod-card-img"><img src="" alt=""></div>
                                    <div class="prod-card-info">
                                        <p class="prod-card-name">OCB</p>
                                        <p class="prod-card-desc"></p>Giảm thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                            class="link">Chi tiết</a>
                                        <div class="prod-card-btn"> <button class="btn btn-rounded btn-icon "><span
                                                    class="ic-check"></span><span class="btn-label">Chọn
                                                </span></button></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="prod-card">
                                    <div class="prod-card-img"><img src="" alt=""></div>
                                    <div class="prod-card-info">
                                        <p class="prod-card-name">OCB</p>
                                        <p class="prod-card-desc"></p>Giảm thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                            class="link">Chi tiết</a>
                                        <div class="prod-card-btn"> <button class="btn btn-rounded btn-icon "><span
                                                    class="ic-check"></span><span class="btn-label">Chọn</span></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="prod-card">
                                    <div class="prod-card-img"><img src="" alt=""></div>
                                    <div class="prod-card-info">
                                        <p class="prod-card-name">OCB</p>
                                        <p class="prod-card-desc"></p>Giảm thêm<strong>1.500.000đ</strong> cho 150 suất <a
                                            class="link">Chi tiết</a>
                                        <div class="prod-card-btn"> <button class="btn btn-rounded btn-icon "><span
                                                    class="ic-check"></span><span class="btn-label">Chọn
                                                </span></button></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

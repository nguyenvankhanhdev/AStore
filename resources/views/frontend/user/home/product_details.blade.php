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
                                href="{{ route('products.category', ['categories' => $product->category->slug]) }}">{{ $product->category->name }}</a>
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
                                                <div class="swiper-slide" data-src="{{ asset($image->image) }}">
                                                    <picture><img src="{{ asset($image->image) }}"
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
                                                        <img src="{{ asset($image->image) }}" alt="">
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
                                <h1 class="h1 name product_name" data-initial-name="{{ $product->name }}">
                                    {{ $product->name }}</h1>
                                <div class="npi-special">
                                    <div class="product-price-left npi-special-price js-control-item active">
                                        <div class="npi-special-inner">
                                            <div class="npi-special-caption">
                                                <div class="npi-special-caption-icon"><img
                                                        src="/frontend/asset/img/fxemoji_star.svg" alt="fxemoji_star"></div>
                                                <div class="npi-special-caption-label">Giá phiên bản 1 Đổi 1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="npi-border">
                                    <div class="price">
                                        <div class="boxprice"><span class="text text-primary price-sale"
                                                style="color: #ae172b"></span>
                                            <strike class="text-promo p-l-8 f-s-p-24 f-w-400"></strike>
                                            <span class="txtpricemarketPhanTram badge badge-danger persent-special"
                                                style="">-12%</span>
                                        </div>
                                    </div>
                                    <div id="variant-selector" class="types js-select">
                                        @foreach ($product->variants as $variant)
                                            <a class="item {{ $variant->id == $selectedVariantId ? 'active' : '' }}"
                                                data-id="{{ $variant->id }}">
                                                <div class="radio" name="variant">
                                                    <input type="radio" name="storage" value="{{ $variant->id }}"
                                                        {{ $variant->id == $selectedVariantId ? 'checked' : '' }}>
                                                    <label>{{ $variant->storage->GB }}</label>
                                                </div>

                                                @if ($variant->variantColors->first())
                                                    <p class="price-variant">
                                                        {{ number_format($variant->variantColors->first()->price - $variant->variantColors->first()->offer_price, 0, ',', '.') }}₫
                                                    </p>
                                                @else
                                                    <p>Không có giá</p>
                                                @endif
                                            </a>
                                        @endforeach

                                    </div>

                                    <div class="colors js-select">
                                        @foreach ($colors as $index => $color)
                                            @php
                                                $name = App\Models\ColorProduct::find($color->color_id);
                                                $isActive = $index === 0 ? 'active' : '';
                                                if ($isActive === 'active') {
                                                    $selectedColorId = $name->id;
                                                }
                                            @endphp
                                            @switch($name->name)
                                                @case('Xanh da trời')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#51b3f0"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Đen')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#232A31"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Đỏ')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#FB1634"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Xanh lá')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#77ff82"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Trắng')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#FAF7F2"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Vàng hồng')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#ffe194"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Xám')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#B2C5D6"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @default
                                                    <div class="item" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#FFFFFF"></span> <!-- Màu mặc định -->
                                                        <div>Không xác định</div>
                                                    </div>
                                            @endswitch
                                        @endforeach
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
                                    <div class="action action-npi">
                                        <form id="add-to-cart-form" style="width: 100%">
                                            <button type="submit" class="btn btn-link btn-xl btn-line-1">
                                                <div class="btn-text">MUA NGAY</div>
                                                <span class="btn-sub-text">Phiên bản 1 ĐỔI 1 + Combo Siêu Phẩm</span>
                                            </button>
                                        </form>
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
        </div>





        <div class="detail__bottom">
            <div class="detail__comments">
                <div class="fpt-comment">
                    <div class="container">
                        <div class="card card-md user-feedback">
                            <div class="review-container">
                                <h3 cla>
                                    Đánh giá sản phẩm: {{ $product->name }}
                                    @if($product->point == 0 || $product->point < 0.1)
                                        <span class="inline-stars">
                                            <span class="star">☆</span>
                                            <span class="star">☆</span>
                                            <span class="star">☆</span>
                                            <span class="star">☆</span>
                                            <span class="star">☆</span>
                                        </span>
                                        <span class="rating-score">(0.0/5.0)</span>
                                    @else
                                        <span class="inline-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($product->point >= $i)
                                                    <span class="star full">★</span> <!-- Sao sáng đầy đủ -->
                                                @elseif($product->point >= $i - 0.5)
                                                    <span class="star half">★</span> <!-- Sao sáng nửa -->
                                                @else
                                                    <span class="star empty">★</span> <!-- Sao chưa sáng -->
                                                @endif
                                            @endfor
                                        </span>
                                        <span class="rating-score">({{ number_format($product->point, 1) }}/5.0)</span>
                                        <button class="btn view-reviews-btn">
                                            Xem các đánh giá
                                        </button>
                                    @endif

                                </h3>
                                <!-- Modal -->
                                <div class="modal-review" id="reviewsModal">
                                    <div class="modal-content-review">
                                        <div class="modal-header-review">
                                            <h3>Đánh giá sản phẩm</h3>
                                        </div>
                                        <div class="modal-body-review">
                                            @foreach ($ratingOfProduct as $rating )
                                                <div class="modal-line-review">
                                                    <div class="info-user">
                                                        <div class="user-image">
                                                            @if ($rating->user->image==null)
                                                                <img src="{{asset('uploads/anhdaidien.png')}}" alt="Review Image" />
                                                            @else
                                                                <img src="{{asset( $rating->user->image )}}" alt="Review Image" />
                                                            @endif

                                                        </div>
                                                        <div class="user-rating">
                                                            <div class="rating-user">
                                                                <strong>{{ $rating->user->name }}</strong>
                                                            </div>
                                                            <div class="rating-thoughts">
                                                                <p>{{ $rating->content }}</p>
                                                            </div>
                                                            <div class="rating-stars review">
                                                                <span class="inline-stars">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        @if($rating->point >= $i)
                                                                            <span class="star full">★</span> <!-- Sao sáng đầy đủ -->
                                                                        @elseif($product->point >= $i - 0.5)
                                                                            <span class="star half">★</span> <!-- Sao sáng nửa -->
                                                                        @else
                                                                            <span class="star empty">★</span> <!-- Sao chưa sáng -->
                                                                        @endif
                                                                    @endfor
                                                                </span>
                                                                <span class="rating-score-review">({{ number_format($rating->point, 1) }}/5.0)</span>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="image-gallery">
                                                        @foreach ($rating->ratingImages as $image)
                                                            <img src="{{asset( $image->image )}}" alt="Review Image" />
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- Dòng đánh giá 1 -->

                                            <!-- Các đánh giá khác... -->
                                        </div>
                                        <div class="modal-footer-review">
                                            <button class="close-btn" onclick="closeModal()">Đóng</button>
                                        </div>
                                    </div>
                                </div>



                                <div class="review-content">
                                    <!-- Phần bên trái: Đánh giá bằng sao -->
                                    <div class="star-rating">
                                       <h4>
                                        Tổng số đánh giá của sản phẩm ( {{ $countRatingProduct }} )
                                       </h4>
                                    </div>

                                    <!-- Dấu gạch thẳng đứng phân cách -->
                                    <div class="divider"></div>

                                    <!-- Phần bên phải: Đánh giá theo số lượng -->
                                    <div class="rating-count">
                                        @foreach ([5, 4, 3, 2, 1] as $star)
                                            <p>Đánh giá {{ $star }} <span class="count-star">★</span>
                                               (<span class="count-star-{{ $star }}">{{ $ratingsCount[$star] ?? 0 }}</span>)
                                            </p>
                                        @endforeach
                                    </div>

                                </div>
                            </div>


                            <div class="card-title">
                                <h3 class="h5 heading">Bình luận</h3>
                                {{-- <div class="form-group">
                                    <div class="form-search form-search-md"><span class="form-search-icon m-r-4"><i
                                                class="ic-search ic-sm"></i></span><input class="form-search-input m-r-8"
                                            type="text" placeholder="Tìm theo nội dung, người gửi..."><span
                                            class="form-search-icon form-search-clear"><i
                                                class="ic-close ic-md"></i></span></div>
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <form id="commentForm" method="POST" action="{{ route('comments.store') }}">
                                    @csrf
                                    <div class="user-form">
                                        <input type="hidden" name="cmt_id" value="0">
                                        <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                        <div class="flex flex-center-ver m-b-8">
                                            @if (Auth::check())
                                                <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận:
                                                    <strong>{{ $user->username }}</strong>
                                                </div>
                                            @else
                                                {
                                                <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận:
                                                    <strong>Khách</strong>
                                                </div>
                                                }
                                            @endif

                                            {{-- <a class="link link-xs link-icon"><span class="ic m-r-4">
                                                    <i class="ic-edit ic-xs text-link"></i></span>Thay đổi</a> --}}
                                        </div>
                                        <div class="form-group">
                                            <textarea name="content" class="form-input form-input-lg" rows="3"
                                                placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                            <button type="submit" class="btn btn-lg btn-primary"
                                                aria-controls="comment-info">GỬI BÌNH LUẬN</button>
                                        </div>

                                        @if ($errors->has('content'))
                                            <span id="contentError"
                                                class="text-danger">{{ $errors->first('content') }}</span>
                                        @endif
                                    </div>
                                </form>

                                <div class="user-content">
                                    <div class="result">
                                        <div class="text" style="color: #444b52;"><strong>Những bình luận về </strong>“{{ $product->name }}”</div>



                                    </div>
                                    <div id="comments-container" class="user-wrapper">
                                        <div class="user-block">
                                            @if ($comment->isEmpty())
                                                <h2>Sản phẩm chưa có bình luận</h2>
                                            @else
                                                @foreach ($comment as $cm)
                                                    <div data-timestamp="{{ strtotime($cm->created_at) }}" class="avatar avatar-md avatar-text avatar-circle">

                                                        <div class="avatar-shape"><span class="f-s-p-20 f-w-500">TT</span>
                                                        </div>
                                                        <div class="avatar-info">
                                                            <div class="avatar-name">
                                                                <div class="text">
                                                                    {{ $cm->user->username }}</div>
                                                            </div>
                                                            <div class="avatar-para">
                                                                <div class="text">{{ $cm->content }}</div>
                                                            </div>
                                                            <div class="avatar-time">
                                                                <div class="text text-grayscale">
                                                                    {{ $cm->created_at->diffForHumans() }}</div><i
                                                                    class="ic-circle-sm"></i>
                                                                @php
                                                                    $userId = Auth::id(); // Lấy ID của người dùng hiện tại
                                                                @endphp
                                                                <div data-comment-id="{{ $cm->id }}"
                                                                    class="link link-xs like-button {{ $cm->isLikedByUser($userId) ? 'liked' : '' }}">
                                                                    ({{ $cm->cmt_likes }})
                                                                    {{ $cm->isLikedByUser($userId) ? 'Bỏ Thích' : 'Thích' }}
                                                                </div>
                                                                <i class="ic-circle-sm"></i>
                                                                <div data-comment-id="{{ $cm->id }}"
                                                                    class="link active_repcm link-xs">Trả lời</div>
                                                            </div>
                                                        </div>

                                                        @if (Auth::id() == $cm->user_id)
                                                            <a data-comment-id="{{ $cm->id }}"
                                                                class='btn editcm btn-dark'><i
                                                                    class='far fa-edit'></i></a>
                                                            <a data-comment-id="{{ $cm->id }}"
                                                                class='btn deletecm btn-dark'><i
                                                                    class='far fa-trash-alt'></i></a>
                                                        @else
                                                            <a data-comment-id="{{ $cm->id }}" name="cm_id"
                                                                value="{{ $cm->id }}"
                                                                class='btn warningcm btn-dark'><i
                                                                    class="fas fa-exclamation-triangle"></i></a>
                                                        @endif


                                                    </div>
                                                    <div id="commentForm_{{ $cm->id }}" style="display:none;"
                                                        class="avatar-form form-groupcm">
                                                        <div class="form-group ">

                                                            <textarea name="editcm" class="form-input form-input-lg" rows="3"
                                                                placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                            <a data-comment-id="{{ $cm->id }}"
                                                                class="btn btneditcm btn-lg btn-primary"
                                                                aria-controls="comment-info">SỬA BÌNH LUẬN</a>
                                                        </div>
                                                        @if ($errors->has('editcm'))
                                                            <span id="contentError"
                                                                class="text-danger">{{ $errors->first('content') }}</span>
                                                        @endif
                                                    </div>
                                                    <div id="repcommentForm_{{ $cm->id }}" style="display:none;"
                                                        class="avatar-form form-groupcm">
                                                        <div class="form-group">
                                                            <input data-cmt-id="{{ $cm->id }}" type="hidden"
                                                                name="cmt_id" value="{{ $cm->id }}">
                                                            <input type="hidden" name="pro_id"
                                                                value="{{ $product->id }}">
                                                            <textarea name="repcm" class="form-input form-input-lg" rows="3"
                                                                placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                            <a data-comment-id="{{ $cm->id }}"
                                                                class="btn btnrepcm btn-lg btn-primary"
                                                                aria-controls="comment-info">GỬI BÌNH LUẬN</a>
                                                        </div>
                                                        @if ($errors->has('repcm'))
                                                            <span id="contentError"
                                                                class="text-danger">{{ $errors->first('content') }}</span>
                                                        @endif
                                                    </div>
                                                    <!-- Hiển thị các trả lời -->
                                                    @foreach ($cm->replies as $reply)
                                                        <div class="user-block reply">
                                                            <div class="avatar avatar-md avatar-text avatar-circle">
                                                                <div class="avatar-shape"><span
                                                                        class="f-s-p-20 f-w-500">SL</span></div>
                                                                <div class="avatar-info">
                                                                    <div class="avatar-name">
                                                                        <div class="text">{{ $reply->user->username }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-para">
                                                                        <div class="text">{{ $reply->content }}</div>
                                                                    </div>
                                                                    <div class="avatar-time">
                                                                        <div class="text text-grayscale">
                                                                            {{ $reply->created_at->diffForHumans() }}</div>
                                                                        <i class="ic-circle-sm"></i>
                                                                        @php
                                                                            $userId = Auth::id(); // Lấy ID của người dùng hiện tại
                                                                        @endphp
                                                                        <div data-comment-id="{{ $reply->id }}"
                                                                            class="link link-xs like-button {{ $reply->isLikedByUser($userId) ? 'liked' : '' }}">
                                                                            ({{ $reply->cmt_likes }})
                                                                            {{ $reply->isLikedByUser($userId) ? 'Bỏ Thích' : 'Thích' }}
                                                                        </div>
                                                                        <i class="ic-circle-sm"></i>
                                                                        <div data-comment-id="{{ $reply->id }}"
                                                                            class="link active_repcm link-xs">Trả lời</div>
                                                                    </div>
                                                                    @if (Auth::id() == $reply->user_id)
                                                                        <a data-comment-id="{{ $reply->id }}"
                                                                            class='btn editrepcm btn-dark'><i
                                                                                class='far fa-edit'></i></a>
                                                                        <a data-comment-id="{{ $reply->id }}"
                                                                            class='btn deleterepcm btn-dark'><i
                                                                                class='far fa-trash-alt'></i></a>
                                                                    @else
                                                                        <a data-comment-id="{{ $reply->id }}"
                                                                            name="cm_id" value="{{ $reply->id }}"
                                                                            class='btn warningrepcm btn-dark'><i
                                                                                class="fas fa-exclamation-triangle"></i></a>
                                                                    @endif

                                                                </div>

                                                                <div style="display:none;"
                                                                    id="commentForm_{{ $reply->id }}"
                                                                    class="avatar-form form-groupcm">
                                                                    <div class="form-group ">
                                                                        <textarea name="editcm" class="form-input form-input-lg" rows="3"
                                                                            placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                                        <a data-comment-id="{{ $reply->id }}"
                                                                            class="btn btneditrepcm btn-lg btn-primary"
                                                                            aria-controls="comment-info">SỬA BÌNH LUẬN</a>
                                                                    </div>
                                                                </div>
                                                                <div style="display:none;"
                                                                    id="repcommentForm_{{ $reply->id }}"
                                                                    class="avatar-form form-groupcm">
                                                                    <div class="form-group ">
                                                                        <input data-cmt-id="{{ $cm->id }}"
                                                                            type="hidden" value="{{ $cm->id }}">
                                                                        <input type="hidden" name="pro_id"
                                                                            value="{{ $product->id }}">
                                                                        <textarea name="repcm" class="form-input form-input-lg" rows="3"
                                                                            placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                                        <a data-comment-id="{{ $reply->id }}"
                                                                            class="btn btnrepcm btn-lg btn-primary"
                                                                            aria-controls="comment-info">GỬI BÌNH LUẬN</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <input type="hidden" id="currentPage" value="1">

                                    <div id="pagination-container">
                                        {{ $comment->links('vendor.pagination.bootstrap-4') }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var selectedColorId = @json($selectedColorId);
        $(document).ready(function() {
            $('#variant-selector').on('click', '.item', function(event) {
                event.preventDefault();
                const variantId = $(this).data('id');
                const url = new URL(window.location.href);
                url.searchParams.set('variant', variantId);
                window.location.href = url.toString();
            });

            function fetchPrice(colorId, variantId) {
                $.ajax({
                    url: "{{ route('getByColor') }}",
                    method: 'GET',
                    data: {
                        color_id: colorId,
                        variant_id: variantId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            const originalPrice = response.price.price;
                            const storage = response.storage.GB;
                            const offerPrice = response.price.offer_price;
                            const discount = originalPrice - offerPrice;
                            const discountPercentage = (offerPrice / originalPrice) * 100;
                            const productName = $('.product_name').data('initial-name');
                            $('.product_name').text(`${productName} - ${storage}`);
                            $('.text-promo').text(originalPrice.toLocaleString('vi-VN') + ' ₫');
                            $('.price-sale').text(discount.toLocaleString('vi-VN') + ' ₫');
                            $('.txtpricemarketPhanTram').text(
                                `Giảm -${Math.round(discountPercentage)}%`);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }






            let activeColorItem = $('.colors .item.active');
            let colorId = activeColorItem.data('color-id');
            const variantId = $('#variant-selector .item.active').data('id');


            $('#add-to-cart-form').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: {
                        color_id: colorId,
                        variant_id: variantId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        }
                    },
                    error: function(response) {
                        if (response.status === 'error') {
                            toastr.error(response.message);
                        }
                    }
                });

            });

            if (colorId && variantId) {
                fetchPrice(colorId, variantId);
            }
            $('.colors .item').on('click', function() {
                $('.colors .item.active').removeClass('active');
                $(this).addClass('active');
                colorId = $(this).data('color-id');
                fetchPrice(colorId, variantId);
            });





        });
    </script>







    <script>
        $(document).ready(function() {
            // Bắt sự kiện click vào nút chỉnh sửa (editcm)
            $('.active_repcm').click(function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của nút

                var commentId = $(this).data('comment-id'); // Lấy giá trị của data-comment-id
                var commentForm = $('#repcommentForm_' + commentId);

                // Kiểm tra trạng thái hiển thị của commentForm
                if (commentForm.is(':visible')) {
                    commentForm.hide(); // Nếu đang hiển thị thì ẩn đi
                } else {
                    $('.form-groupcm').hide(); // Ẩn tất cả các form-group khác trước khi hiển thị form mới
                    commentForm.show(); // Hiển thị form tương ứng với commentId
                }
            });
        });
    </script>
    <script>


        $(document).ready(function() {

             // Khi nhấn nút "Xem các đánh giá", modal sẽ được hiển thị
            document.querySelector('.view-reviews-btn').addEventListener('click', function() {
                // Hiển thị modal
                document.getElementById('reviewsModal').style.display = 'flex';
            });

            // Hàm đóng modal khi nhấn "Đóng"
            function closeModal() {
                // Ẩn modal
                document.getElementById('reviewsModal').style.display = 'none';
            }

            // Đóng modal khi nhấp ra ngoài modal
            window.addEventListener('click', function(event) {
                // Kiểm tra nếu người dùng nhấp vào vùng nền ngoài modal
                if (event.target === document.getElementById('reviewsModal')) {
                    closeModal();  // Đóng modal
                }
            });


            // Hàm để khởi tạo các sự kiện tương tác với bình luận
            function khoiTaoSuKienBinhLuan() {
                // Bắt sự kiện click vào nút "Thích"
                $('.like-button').off('click').on('click', function(e) {
                    e.preventDefault();
                    var commentId = $(this).data('comment-id');
                    var likeButton = $(this);

                    $.ajax({
                        url: "{{ route('comments.likeComment') }}",
                        method: 'POST',
                        data: {
                            cmt_id: commentId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status === 'liked') {
                                likeButton.text('(' + data.likesCount + ') Bỏ Thích');
                            } else if (data.status === 'unliked') {
                                likeButton.text('(' + data.likesCount + ') Thích');
                            }

                            if (data.message) {
                                alert(data.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Đã xảy ra lỗi: ' + error);
                        }
                    });
                });

                // Bắt sự kiện click vào nút xóa
                $('.deletecm,.deleterepcm').off('click').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('comment-id');
                    var page = $('#currentPage').val(); // Lấy trang hiện tại từ input ẩn

                    if (confirm('Bạn có muốn xóa bình luận này không?')) {
                        $.ajax({
                            url: "{{ route('comments.destroy') }}",
                            method: 'POST',
                            data: {
                                cm_id: id,
                                page: page,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                // Reload để áp dụng các thay đổi và giữ vị trí cuộn
                                reloadPage1(page);

                            },
                            error: function(xhr, status, error) {
                                alert('Đã xảy ra lỗi: ' + error);
                            }
                        });
                    }
                });

                // Bắt sự kiện click vào nút báo cáo
                $('.warningcm,.warningrepcm').off('click').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('comment-id');
                    var page = $('#currentPage').val();
                    if (confirm('Bạn có muốn báo cáo bình luận này không?')) {
                        $.ajax({
                            url: "{{ route('comments.change-status') }}",
                            method: 'POST',
                            data: {
                                cm_id: id,
                                page: page,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                // Reload để áp dụng các thay đổi và giữ vị trí cuộn
                                reloadPage1(page);

                                // if (response.status === 'success') {
                                //     alert(response.message);


                                // }
                            },
                            error: function(xhr, status, error) {
                                alert('Đã xảy ra lỗi: ' + error);
                            }
                        });
                    }
                });

                // Bắt sự kiện click vào nút chỉnh sửa
                $('.btneditcm,.btneditrepcm').off('click').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('comment-id');
                    var content = $('#commentForm_' + id).find('textarea[name="editcm"]').val();
                    var page = $('#currentPage').val();
                    if (confirm('Bạn có muốn sửa bình luận này không?')) {
                        $.ajax({
                            url: "{{ route('comments.update') }}",
                            method: 'POST',
                            data: {
                                cm_id: id,
                                content: content,
                                page: page,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                // Reload để áp dụng các thay đổi và giữ vị trí cuộn
                                reloadPage1(page);
                            },
                            error: function(xhr, status, error) {
                                alert('Đã xảy ra lỗi: ' + error);
                            }
                        });
                    }
                });

                // Bắt sự kiện click vào nút trả lời bình luận
                $('.btnrepcm').off('click').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('comment-id');
                    var cmt_id = $(this).closest('.form-groupcm').find('input[data-cmt-id]').data('cmt-id');
                    var content = $('#repcommentForm_' + id).find('textarea[name="repcm"]').val();
                    var pro_id = $('#repcommentForm_' + id).find('input[name="pro_id"]').val();
                    var page = $('#currentPage').val();
                    if (confirm('Bạn có muốn trả lời bình luận này không?')) {
                        $.ajax({
                            url: "{{ route('comments.store') }}",
                            method: 'POST',
                            data: {
                                cmt_id: cmt_id,
                                content: content,
                                pro_id: pro_id,
                                page: page,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                // Reload để áp dụng các thay đổi và giữ vị trí cuộn
                                reloadPage1(page);
                            },
                            error: function(xhr, status, error) {
                                alert('Đã xảy ra lỗi: ' + error);
                            }
                        });
                    }
                });

                // Bắt sự kiện click vào nút chỉnh sửa (editcm)
                $('.editcm, .editrepcm').off('click').on('click', function(e) {
                    e.preventDefault();
                    var commentId = $(this).data('comment-id');
                    var commentForm = $('#commentForm_' + commentId);

                    if (commentForm.is(':visible')) {
                        commentForm.hide();
                    } else {
                        $('.form-groupcm').hide();
                        commentForm.show();
                    }
                });

                // Bắt sự kiện click vào nút trả lời (active_repcm)
                $('.active_repcm').off('click').on('click', function(e) {
                    e.preventDefault();
                    var commentId = $(this).data('comment-id');
                    var commentForm = $('#repcommentForm_' + commentId);

                    if (commentForm.is(':visible')) {
                        commentForm.hide();
                    } else {
                        $('.form-groupcm').hide();
                        commentForm.show();
                    }
                });
            }

            // Hàm để reload trang và giữ vị trí cuộn
            function reloadPage() {
                var scrollPosition = $(window).scrollTop();

                location.reload();

            }

            // Lưu giá trị biến vào sessionStorage
            function saveShouldMoveToUserContent(value) {
                sessionStorage.setItem('shouldMoveToUserContent', value);
            }

            // Đọc giá trị biến từ sessionStorage
            function getShouldMoveToUserContent() {
                return sessionStorage.getItem('shouldMoveToUserContent') === 'true';
            }



            // Hàm để lưu giá trị currentPage vào sessionStorage
            function saveCurrentPage(page) {
                sessionStorage.setItem('currentPage', page);
            }

            // Hàm để lấy giá trị currentPage từ sessionStorage
            function getCurrentPage() {
                return sessionStorage.getItem('currentPage') ||
                    1; // Mặc định là trang 1 nếu không có giá trị lưu trữ
            }


            function moveToUserContent() {
                if (getShouldMoveToUserContent() || sessionStorage.getItem('scrollToUserContent') === 'true') {
                    $('html, body').animate({
                        scrollTop: $('.user-content').offset().top
                    }, 500);
                    // Reset biến sau khi di chuyển
                    saveShouldMoveToUserContent(false);
                    sessionStorage.removeItem('scrollToUserContent');
                }


            }

            function reloadPage1(page) {
                // var scrollPosition = $(window).scrollTop();
                // var url = new URL(window.location.href);
                // url.searchParams.set('page', page); // Đặt tham số page vào URL
                // window.location.href = url.toString(); // Tải lại trang với URL mới
                $('#currentPage').val(page);

                var urlWithPage = new URL(window.location.href);
                urlWithPage.searchParams.set('page', page);


                // Lưu trạng thái cuộn vào sessionStorage
                saveShouldMoveToUserContent(true);
                // Lưu giá trị currentPage vào sessionStorage
                saveCurrentPage(page);

                // Chuyển đến URL mới và tải lại trang
                window.location.href = urlWithPage.toString();
                $('#currentPage').val(page);



            }

            $(document).ready(function() {
                // Khôi phục giá trị currentPage từ sessionStorage vào input ẩn
                var currentPage = getCurrentPage();
                $('#currentPage').val(currentPage);

                // Di chuyển đến phần tử .user-content sau khi tải lại trang
                moveToUserContent();

                khoiTaoSuKienBinhLuan();
                // Xóa giá trị currentPage từ sessionStorage sau khi đã sử dụng
                sessionStorage.removeItem('currentPage');
            });



            // Xử lý nhấp vào liên kết phân trang
            $(document).on('click', '.pagination-link[data-url]', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                console.log('URL:', url); // Xuất URL ra console

                // Lấy giá trị trang từ URL
                var urlParams = new URLSearchParams(new URL(url).search);
                var page = urlParams.get('page');

                console.log('Page:', page); // Xuất giá trị trang ra console

                if (url) {
                    currentPage = $(this).text(); // Cập nhật trang hiện tại


                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            $('#comments-container').html($(response).find(
                                '#comments-container').html());
                            $('#pagination-container').html($(response).find(
                                '#pagination-container').html());

                            // Cập nhật giá trị currentPage trong input ẩn
                            $('#currentPage').val(page);


                            // Lưu giá trị currentPage vào sessionStorage
                            sessionStorage.setItem('currentPage', page);
                            // Khởi tạo lại các sự kiện tương tác với bình luận sau khi tải nội dung mới
                            khoiTaoSuKienBinhLuan();

                            $('html, body').animate({
                                scrollTop: $('.user-content').offset().top
                            }, 500);
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', error);
                        }
                    });
                }
            });

            // // Bắt sự kiện gửi bình luận và reload tại vị trí cũ
            // Scroll to the saved position after reload
            if (sessionStorage.getItem('scrollPosition') !== null) {
                $(window).scrollTop(sessionStorage.getItem('scrollPosition'));
                sessionStorage.removeItem('scrollPosition');
            }

            $('#commentForm').on('submit', function(e) {
                // Save the current scroll position
                sessionStorage.setItem('scrollPosition', $(window).scrollTop());

                // Allow the form to submit normally
            });

            // Khôi phục vị trí cuộn sau khi trang reload
            $(window).on('load', function() {
                var url = new URL(window.location.href);
                var currentPage = url.searchParams.get('page');
                var pageInput = $('#currentPage').val();

                // Kiểm tra nếu cần di chuyển đến .user-content
                if (getShouldMoveToUserContent()) {
                    moveToUserContent();

                } else {
                    // Nếu không cần di chuyển, kiểm tra trang hiện tại
                    if ((pageInput === '1' && currentPage !== '1' && currentPage !== null)) {
                        sessionStorage.setItem('scrollToUserContent', 'true');
                        // Nếu không phải trang 1 và không phải do chuyển trang, cập nhật URL và tải lại trang
                        url.searchParams.set('page', 1);
                        window.location.href = url.toString();
                        khoiTaoSuKienBinhLuan();
                    }

                }
            });


            // Khởi tạo các sự kiện tương tác với bình luận khi trang load
            khoiTaoSuKienBinhLuan();
        });




        $(document).ready(function () {
            const stars = $('.star-rating .star');
            const ratingLabel = $('.star-rating .rating-label');
            let selectedRating = 0; // Lưu trữ số sao được chọn

            const ratingTexts = [
                "Rất Tệ",
                "Tệ",
                "Ổn",
                "Tốt",
                "Rất Tốt"
            ];

            stars.each(function (index) {
                // Sự kiện hover vào sao
                $(this).on('mouseover', function () {
                    ratingLabel.text(ratingTexts[index]);

                    // Làm sáng các ngôi sao từ đầu đến ngôi sao hover
                    stars.each(function (i) {
                        $(this).toggleClass('active', i <= index);
                    });
                });

                // Sự kiện khi chuột rời khỏi sao
                $(this).on('mouseout', function () {
                    // Làm sáng các ngôi sao đã chọn trước đó
                    stars.each(function (i) {
                        $(this).toggleClass('active', i < selectedRating);
                    });
                    ratingLabel.text(selectedRating ? ratingTexts[selectedRating - 1] : '');
                });

                // Sự kiện click vào sao để chọn số sao
                $(this).on('click', function () {
                    selectedRating = index + 1;
                    ratingLabel.text(ratingTexts[index]);
                });
            });

            // Sự kiện click vào nút "Đánh giá"
            $('.rate-button').on('click', function (e) {
                e.preventDefault();

                if (selectedRating === 0) {
                    alert("Vui lòng chọn số sao để đánh giá!");
                    return;
                }

                var productId = {{ $product->id }}; // Thêm ID sản phẩm từ Blade

                // In ra giá trị của productId và selectedRating (point)
                console.log("Product ID: " + productId);
                console.log("Selected Rating (Point): " + selectedRating);

                if (confirm('Bạn có muốn gửi đánh giá không?')) {
                    $.ajax({
                        url: "{{ route('product.rating') }}",
                        method: 'POST',
                        data: {
                            pro_id: productId,
                            point: selectedRating,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            toastr.success(response.message);
                            // Cập nhật điểm trung bình sau khi thành công
                            var averageRating = response.averageRating;

                            // Cập nhật hiển thị sao
                            var starHtml = '';
                            for (var i = 1; i <= 5; i++) {
                                if (averageRating >= i) {
                                    starHtml += '<span class="star full">★</span>';
                                } else if (averageRating >= i - 0.5) {
                                    starHtml += '<span class="star half">★</span>';
                                } else {
                                    starHtml += '<span class="star empty">★</span>';
                                }
                            }
                            $('.inline-stars').html(starHtml);

                            // Cập nhật điểm trung bình hiển thị
                            $('.rating-score').text('(' + parseFloat(averageRating).toFixed(1) + '/5.0)');
                            // Cập nhật số lượng đánh giá cho từng mức sao
                            [5, 4, 3, 2, 1].forEach(function(star) {
                                $('.rating-count').find(`.count-star-${star}`).text(response.ratingsCount[star] || 0);
                            });

                            if (response.infoRating) {
                                $('.user-rating-info').html(
                                    '<h5>Bạn đã đánh giá sản phẩm này ' + response.infoRating.point + ' <span class="count-star">★</span></h5>'
                                );
                                $('.rate-button').text('Đánh giá lại');
                            } else {
                                $('.user-rating-info').html('<h5>Bạn chưa đánh giá sản phẩm này</h5>');
                                $('.rate-button').text('Đánh giá');
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 401) {
                                alert(xhr.responseJSON.message); // Hiển thị thông báo chưa đăng nhập
                                window.location.href = "{{ route('auth.admin') }}"; // Chuyển hướng đến trang đăng nhập
                            } else if (xhr.status === 403) {
                                alert(xhr.responseJSON.message); // Hiển thị thông báo từ server
                            } else {
                                alert('Đã xảy ra lỗi: ' + error);
                            }
                        }
                    });
                }
            });

        });










    </script>
@endpush

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
                                        <div class="boxprice"><span class="text text-primary">27.990.000₫</span>
                                            <strike class="text-promo p-l-8 f-s-p-24 f-w-400"> 30.500.000đ</strike>
                                            <span class="txtpricemarketPhanTram badge badge-danger persent-special"
                                                style="">-12%</span>
                                        </div>

                                    </div>
                                    <div id="variant-selector" class="types js-select">
                                        @foreach ($product->variants as $index => $variant)
                                            @php
                                                $storage = App\Models\StorageProduct::find($variant->storage_id);
                                            @endphp
                                            <a class="item {{ $variant->id == $selectedVariantId ? 'active' : '' }}" data-id="{{ $variant->id }}">
                                                <div class="radio">
                                                    <input type="radio"{{ $variant->id == $selectedVariantId ? 'checked' : '' }}>
                                                    <label>{{ $variant->storage->GB }}</label>
                                                </div>
                                                <p>{{ number_format($variant->price - $variant->offer_price, 0, ',', '.') }}₫
                                                </p>
                                            </a>
                                        @endforeach


                                    </div>
                                    <div class="colors js-select">
                                        @foreach ($product->variants as $index => $variant)
                                            @switch($variant->color->color)
                                                @case('Xanh da trời')
                                                    <div class="item {{ $index === 0 ? 'active' : '' }}"
                                                        data-color-id="{{ $variant->id }}">
                                                        <span style="background-color:#51b3f0"></span>
                                                        <div>{{ $variant->color->color }}</div>
                                                    </div>
                                                @break

                                                @case('Đen')
                                                    <div class="item {{ $index === 0 ? 'active' : '' }}"
                                                        data-color-id="{{ $variant->id }}">
                                                        <span style="background-color:#232A31"></span>
                                                        <div>{{ $variant->color->color }}</div>
                                                    </div>
                                                @break

                                                @case('Đỏ')
                                                    <div class="item {{ $index === 0 ? 'active' : '' }}"
                                                        data-color-id="{{ $variant->id }}">
                                                        <span style="background-color:#FB1634"></span>
                                                        <div>{{ $variant->color->color }}</div>
                                                    </div>
                                                @break

                                                @case('Xanh lá')
                                                    <div class="item {{ $index === 0 ? 'active' : '' }}"
                                                        data-color-id="{{ $variant->id }}">
                                                        <span style="background-color:#77ff82"></span>
                                                        <div>{{ $variant->color->color }}</div>
                                                    </div>
                                                @break

                                                @case('Trắng')
                                                    <div class="item {{ $index === 0 ? 'active' : '' }}"
                                                        data-color-id="{{ $variant->id }}">
                                                        <span style="background-color:#FAF7F2"></span>
                                                        <div>{{ $variant->color->color }}</div>
                                                    </div>
                                                @break

                                                @case('Vàng hồng')
                                                    <div class="item {{ $index === 0 ? 'active' : '' }}"
                                                        data-color-id="{{ $variant->id }}">
                                                        <span style="background-color:#b37249"></span>
                                                        <div>{{ $variant->color->color }}</div>
                                                    </div>
                                                @break

                                                @case('Xám')
                                                    <div class="item {{ $index === 0 ? 'active' : '' }}"
                                                        data-color-id="{{ $variant->id }}">
                                                        <span style="background-color:#B2C5D6"></span>
                                                        <div>{{ $variant->color->color }}</div>
                                                    </div>
                                                @break

                                                @default
                                                    <div class="item" data-color-id="{{ $variant->id }}">
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
                                        <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form"
                                            style="width: 100%">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1" min="1">
                                            <input type="hidden" name="variant_id" value="{{ $selectedVariantId }}">
                                            <button type="submit" class="btn btn-link btn-xl btn-line-1">
                                                <div class="btn-text">MUA NGAY</div>
                                                <span class="btn-sub-text">Phiên bản 1 ĐỔI 1 + Combo Siêu Phẩm</span>
                                            </button>
                                        </form>
                                        <a class="btn btn-outline-grayscale btn-xl btn-line-2" href="#">
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
                                <form method="POST" action="{{ route('comments.store') }}">
                                    @csrf
                                    <div class="user-form">
                                        <div class="flex flex-center-ver m-b-8">
                                            @if (Auth::check())
                                                {
                                                <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận:
                                                    <strong>{{ $user->username }}</strong>
                                                </div>
                                                }
                                            @else
                                                {
                                                <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận:
                                                    <strong>Khách</strong>
                                                </div>
                                                }
                                            @endif

                                            <a class="link link-xs link-icon"><span class="ic m-r-4">
                                                    <i class="ic-edit ic-xs text-link"></i></span>Thay đổi</a>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-input form-input-lg" rows="3"
                                                placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                            <button type="submit" class="btn btn-lg btn-primary"
                                                aria-controls="comment-info">GỬI BÌNH LUẬN</button>
                                        </div>

                                    </div>
                                </form>
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
                                                        <div class="link link-xs">Thích</div><i class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        <div class="link link-xs">Thích</div><i class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        <div class="link link-xs">Thích</div><i class="ic-circle-sm"></i>
                                                        <div class="link link-xs">Trả lời</div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        </div><a class="link link-xs link-icon"><span class="ic m-r-4"><i
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
                                            <li class="pagination-item"><a class="pagination-link" href="#">1</a>
                                            </li>
                                            <li class="pagination-item active"><a class="pagination-link"
                                                    href="#">2</a></li>
                                            <li class="pagination-item"><a class="pagination-link" href="#">3</a>
                                            </li>
                                            <li class="pagination-item"><a class="pagination-link" href="#">4</a>
                                            </li>
                                            <li class="pagination-item"><a class="pagination-link" href="#">...</a>
                                            </li>
                                            <li class="pagination-item"><a class="pagination-link" href="#">10</a>
                                            </li>
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
@push('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
        const variantSelector = document.getElementById('variant-selector');

        variantSelector.addEventListener('click', function(event) {
            const clickedElement = event.target.closest('.item');
            if (clickedElement) {
                const variantId = clickedElement.getAttribute('data-id');
                const url = new URL(window.location.href);
                url.searchParams.set('variant', variantId);
                window.location.href = url.toString();
            }
        });
    });

    document.querySelectorAll('.colors .item').forEach(item => {
        item.addEventListener('click', function () {
            document.querySelectorAll('.colors .item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            let colorId = this.getAttribute('data-color-id');
            // Store the selected color in the session
            fetch('{{ route('cart.selectColor') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ color_id: colorId })
            });
        });
    });
    </script>
@endpush

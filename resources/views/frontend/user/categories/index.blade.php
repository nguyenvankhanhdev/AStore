@extends('frontend.user.layouts.master')

@section('content')

    <div class="category">
        <div class="container">
            {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="link" href="#">Trang chủ</a></li>
            <li class="breadcrumb-item">Mac</li>
        </ol> --}}


            <h1 class="h1">{{ $categories->name }}</h1>

            <div class="card card-md category__container">
                <div class="card-body">
                    <div class="actions">
                        <div class="menu js-category-menu">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <a class="item swiper-slide active" data-ref="#block-1">Tất cả</a>
                                    @foreach ($cate as $subcategory)
                                        <a class="item swiper-slide" href="#" data-ref="#block-2">{{ $subcategory->name }}</a>
                                    @endforeach


                                </div>
                            </div>
                            <div class="swiper-button-next sw-button"><i class="ic-angle-right"></i></div>
                            <div class="swiper-button-prev sw-button"><i class="ic-angle-left"></i></div>
                        </div>
                        <div class="sort">
                            <div class="content">
                                <div class="text"></div>
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
                            @foreach ($products as $product)
                                <div class="product">

                                    <div class="product__img">
                                        <a href="#">
                                            <img src="{{ $product->image }}" alt=""></a>
                                    </div>
                                    <div class="product__info">
                                        <h3 class="product__name">
                                            <div class="text">{{ $product->name }}</div>
                                            @if ($product->product_type == 'new_arrival')
                                                <span class="badge badge-xs badge-success badge-link">Mới</span>
                                            @elseif ($product->product_type == 'featured_product')
                                                <span class="badge badge-xs badge-warning badge-link">Nổi bật</span>
                                            @elseif ($product->product_type == 'top_product')
                                                <span class="badge badge-xs badge-info badge-link">Hàng đầu</span>
                                            @elseif ($product->product_type == 'best_product')
                                                <span class="badge badge-xs badge-danger badge-link">Tốt nhất</span>
                                            @endif

                                        </h3>
                                        <div class="product__price">
                                            <div class="text">Giá chỉ</div>
                                            <div class="price">{{ $product->price }}đ</div><strike
                                                class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                        </div>
                                    </div>
                                    <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                            href="#">XEM
                                            CHI TIẾT </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endsection

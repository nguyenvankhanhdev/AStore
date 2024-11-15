@extends('frontend.user.layouts.master')

@section('content')
    <div class="category">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="link" href="{{ route('products.index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">{{ $categories->name }}</li>
            </ol>
            <h1 class="h1">{{ $categories->name }}</h1>

            <div class="card card-md category__container">
                <div class="card-body">
                    <div class="actions">
                        <div class="menu js-category-menu">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <a class="item swiper-slide active" data-ref="#block-1"
                                        href="{{ route('products.category', ['categories' => $categories->slug]) }}">Tất
                                        cả</a>
                                    @foreach ($subcategories as $subcategory)
                                        <a class="item swiper-slide" data-ref="#block-2"
                                            href="{{ route('products.subcategory', ['subcategories' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-button-next sw-button"><i class="ic-angle-right"></i></div>
                            <div class="swiper-button-prev sw-button"><i class="ic-angle-left"></i></div>
                        </div>
                        <div class="sort">
                            <div class="content">
                                <div class="text">Sắp xếp theo:</div>
                                <div class="dropdown js-dropdown">
                                    <div class="dropdown-button">
                                        <span>Mới nhất</span>
                                        <i class="ic-arrow-select ic-sm"></i>
                                    </div>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-wrapper scrollbar">
                                            <a href="{{ route('products.category', ['categories' => request()->categories, 'sort' => 'price_min']) }}" class="price_min">
                                                <span>Giá thấp đến giá cao</span>
                                            </a>
                                            <a href="{{ route('products.category', ['categories' => request()->categories, 'sort' => 'price_max']) }}" class="price_max">
                                                <span>Giá cao đến giá thấp</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane active" id="block-1">
                        <div class="product-list" id="product-list">
                            @foreach ($products as $product)
                                <div class="product" data-product-id="{{ $product->id }}">
                                    <div class="product__img">
                                        <a href="{{ route('product.details', $product->slug) }}"><img
                                                src="{{ $product->image }}" alt=""></a>
                                    </div>
                                    <div class="product__info">
                                        <div class="product__color">
                                        </div>

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
                                        <div class="product__memory js-select">
                                            @foreach ($product->variants as $index => $variant)
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB }}</strong>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="product__price">
                                            <div class="text">Giá chỉ</div>
                                            @php
                                                $firstVariant = $product->variants->first();
                                            @endphp

                                            <div class="price"> </div>
                                            <strike class="text-promo p-l-6 f-s-p-16 f-w-400"> </strike>

                                        </div>
                                    </div>
                                    <div class="product__detail">
                                        @if ($firstVariant)
                                            <a class="btn btn-outline-grayscale btn-md"
                                                href="{{ route('product.details', ['slug' => $product->slug, 'variant' => $firstVariant->id]) }}">XEM
                                                CHI TIẾT</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
    function getPriceByVariantId(productElement) {
        var variantId = productElement.find('.product__memory__item.active').data('variant-id');
        $.ajax({
            url: '{{ route('getByVariant') }}',
            method: 'GET',
            data: {
                variantId: variantId
            },
            success: function (response) {
                if (response.status === 'success') {
                    const price = response.variantColors.price;
                    const discount = response.variantColors.offer_price;
                    const endPrice = price - discount;

                    productElement.find('.product__price .price').text(endPrice.toLocaleString('vi-VN') + ' ₫');
                    productElement.find('.product__price .text-promo').text(price.toLocaleString('vi-VN') + ' ₫');

                    productElement.attr('data-price', price);
                    productElement.attr('data-discounted-price', endPrice);

                    if (!productElement.attr('data-initial-discounted-price')) {
                        productElement.attr('data-initial-discounted-price', endPrice);
                    }
                } else {
                    console.error("Error: API không trả về trạng thái thành công.");
                }
            },
            error: function (error) {
                console.error("Error fetching price:", error);
            }
        });
    }

    function sortProducts(order) {
        var products = $('.product');

        products.sort(function (a, b) {
            var priceA = parseInt($(a).attr('data-initial-discounted-price'));
            var priceB = parseInt($(b).attr('data-initial-discounted-price'));

            if (order === 'asc') {
                return priceA - priceB;
            } else {
                return priceB - priceA;
            }
        });

        $('#product-list').html(products);

        setupVariantClickEvents();
    }

    $('.price_max').click(function (e) {
        e.preventDefault();
        sortProducts('desc');
    });

    $('.price_min').click(function (e) {
        e.preventDefault();
        sortProducts('asc');
    });

    function setupVariantClickEvents() {
        $('.product__memory__item').off('click').on('click', function () {
            const productElement = $(this).closest('.product');

            $(this).closest('.js-select').find('.product__memory__item').removeClass('active');
            $(this).addClass('active');

            getPriceByVariantId(productElement);
        });
    }

    $('.product').each(function () {
        getPriceByVariantId($(this));
    });

    setupVariantClickEvents();
});

</script>
@endpush

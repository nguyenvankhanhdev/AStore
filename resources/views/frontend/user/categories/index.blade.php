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
                        <div class="filter-sort-wrapper">
                            <div class="custom-filter-container">
                                <div class="custom-dropdown">
                                    <button class="custom-dropdown-toggle">Mức giá</button>
                                    <div class="custom-dropdown-content">
                                        <label><input type="checkbox" class="custom-price-range" data-min="7000000" data-max="13000000"> Từ 7 - 13 triệu</label>
                                        <label><input type="checkbox" class="custom-price-range" data-min="13000000" data-max="20000000"> Từ 13 - 20 triệu</label>
                                        <label><input type="checkbox" class="custom-price-range" data-min="20000000" data-max="30000000"> Từ 20 - 30 triệu</label>
                                        <label><input type="checkbox" class="custom-price-range" data-min="30000000"> Trên 30 triệu</label>
                                        <hr>
                                        <div class="custom-price-input">
                                            <label>Hoặc nhập khoảng giá phù hợp với bạn:</label>
                                            <div class="custom-input-group">
                                                <input type="number" id="min-price" placeholder="Giá thấp nhất">
                                                <span>~</span>
                                                <input type="number" id="max-price" placeholder="Giá cao nhất">
                                            </div>
                                            <button id="custom-filter-price-range">Lọc</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="custom-sort-container">
                                <div class="custom-sort-text">Sắp xếp theo:</div>
                                <div class="custom-sort-dropdown">
                                    <div class="custom-sort-button">
                                        <span>Mới nhất</span>
                                        <i class="ic-arrow-select ic-sm"></i>
                                    </div>
                                    <div class="custom-sort-menu">
                                        <div class="custom-sort-menu-wrapper">
                                            <a href="{{ route('products.category', ['categories' => request()->categories, 'sort' => 'price_min']) }}" class="custom-price-min">
                                                <span>Giá thấp đến giá cao</span>
                                            </a>
                                            <a href="{{ route('products.category', ['categories' => request()->categories, 'sort' => 'price_max']) }}" class="custom-price-max">
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
// Function to filter products by price range
function filterProductsByPrice(minPrice, maxPrice) {
    $('.product').each(function () {
        var productPrice = parseInt($(this).attr('data-initial-discounted-price'));

        if ((minPrice === null || productPrice >= minPrice) && (maxPrice === null || productPrice <= maxPrice)) {
            $(this).show(); // Show product if within the price range
        } else {
            $(this).hide(); // Hide product if outside the price range
        }
    });
}

// Event for selecting predefined price ranges
$('.custom-price-range').on('change', function () {
    var selectedRanges = [];

    $('.custom-price-range:checked').each(function () {
        var min = $(this).data('min') || null;
        var max = $(this).data('max') || null;
        selectedRanges.push({ min, max });
    });

    if (selectedRanges.length > 0) {
        $('.product').hide(); // Hide all products initially
        selectedRanges.forEach(function (range) {
            filterProductsByPrice(range.min, range.max);
        });
    } else {
        $('.product').show(); // Show all products if no range is selected
    }
    
    // Clear custom input fields when a predefined range is selected
    $('#min-price').val('');
    $('#max-price').val('');
});

// Event for applying custom price range
$('#custom-filter-price-range').on('click', function () {
    var minPrice = $('#min-price').val() ? parseInt($('#min-price').val()) : null;
    var maxPrice = $('#max-price').val() ? parseInt($('#max-price').val()) : null;

    // Clear predefined checkboxes when custom range is applied
    $('.custom-price-range').prop('checked', false);

    filterProductsByPrice(minPrice, maxPrice);
});

</script>
@endpush

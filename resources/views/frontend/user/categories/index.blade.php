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
                                            <div id="price-slider" style="margin: 15px 0;"></div>
                                            <div class="custom-input-group">
                                                <input type="number" id="slider-min-price" placeholder="Giá thấp nhất">
                                                <span>~</span>
                                                <input type="number" id="slider-max-price" placeholder="Giá cao nhất">
                                            </div>
                                            <button id="custom-filter-price-range">Xem kết quả</button>
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
        const variantId = productElement.find('.product__memory__item.active').data('variant-id');

        if (!variantId) {
            console.error("Variant ID không hợp lệ.");
            return;
        }

        $.ajax({
            url: '{{ route('getByVariant') }}',
            method: 'GET',
            data: { variantId },
            beforeSend: function () {
                setLoading(true);
            },
            success: function (response) {
                setLoading(false);

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
                setLoading(false);
                console.error("Error fetching price:", error);
            }
        });
    }

    function setLoading(isLoading) {
        if (isLoading) {
            $('#product-list').addClass('loading');
        } else {
            $('#product-list').removeClass('loading');
        }
    }

    // Hàm sắp xếp sản phẩm theo giá
    function sortProducts(order) {
        const products = $('.product');

        products.sort(function (a, b) {
            const priceA = parseInt($(a).attr('data-initial-discounted-price'));
            const priceB = parseInt($(b).attr('data-initial-discounted-price'));

            return order === 'asc' ? priceA - priceB : priceB - priceA;
        });

        $('#product-list').html(products);
        setupVariantClickEvents();
    }
    // Hàm lọc sản phẩm theo khoảng giá
    function filterProductsByPrice(minPrice, maxPrice) {
    $('.product').each(function () {
        const productPrice = parseInt($(this).attr('data-initial-discounted-price')) || 0;

        console.log("Product Price:", productPrice); // Debug
        if ((minPrice === null || productPrice >= minPrice) &&
            (maxPrice === null || productPrice <= maxPrice)) {
            $(this).show();
            console.log("Showing Product:", $(this).text());
        } else {
            $(this).hide();
            console.log("Hiding Product:", $(this).text());
        }
    });
}

    function setupVariantClickEvents() {
        $('.product__memory__item').off('click').on('click', function () {
            const productElement = $(this).closest('.product');

            $(this).closest('.js-select').find('.product__memory__item').removeClass('active');
            $(this).addClass('active');

            getPriceByVariantId(productElement);
        });
    }

   // Khởi tạo noUiSlider
const slider = document.getElementById('price-slider');
noUiSlider.create(slider, {
    start: [7000000, 30000000],
    connect: true,
    range: {
        'min': 7000000,
        'max': 50000000
    },
    step: 1000000,
    tooltips: [false, false],
    format: {
        to: function (value) {
            return Math.round(value).toLocaleString('vi-VN') + ' ₫';
        },
        from: function (value) {
            return Number(value.replace(/[^0-9.-]+/g, ''));
        }
    }
});


// Cập nhật giá trị input khi kéo thanh trượt
slider.noUiSlider.on('update', function (values) {
    $('#slider-min-price').val(values[0].replace(/[^0-9]/g, ''));
    $('#slider-max-price').val(values[1].replace(/[^0-9]/g, ''));
});


// Lọc tự động khi kéo
slider.noUiSlider.on('slide', function (values) {
    const minPrice = parseInt(values[0].replace(/[^0-9.-]+/g, ''));
    const maxPrice = parseInt(values[1].replace(/[^0-9.-]+/g, ''));
    console.log("Slider Min Price:", minPrice);
    console.log("Slider Max Price:", maxPrice);

    // filterProductsByPrice(minPrice, maxPrice);
});



// Lọc sản phẩm khi nhấn nút "Lọc"
$('#custom-filter-price-range').on('click', function () {
    // const minPrice = $('#slider-min-price').val() ? parseInt($('#slider-min-price').val()) : null;
    // const maxPrice = $('#slider-max-price').val() ? parseInt($('#slider-max-price').val()) : null;

    // if (minPrice !== null && maxPrice !== null && minPrice > maxPrice) {
    //     alert("Giá thấp nhất không thể lớn hơn giá cao nhất.");
    //     return;
    // }

    // filterProductsByPrice(minPrice, maxPrice);

    const minPrice = parseInt($('#slider-min-price').val()) || 0;
    const maxPrice = parseInt($('#slider-max-price').val()) || Infinity;

    if (minPrice > maxPrice) {
        alert("Giá thấp nhất không thể lớn hơn giá cao nhất.");
        return;
    }

    filterProductsByPrice(minPrice, maxPrice);
});

    // Lọc sản phẩm khi chọn checkbox khoảng giá
    $('.custom-price-range').on('change', function () {
        const selectedRanges = [];

        $('.custom-price-range:checked').each(function () {
            const min = $(this).data('min') || null;
            const max = $(this).data('max') || null;
            selectedRanges.push({ min, max });
        });

        if (selectedRanges.length > 0) {
            $('.product').hide();
            selectedRanges.forEach(function (range) {
                filterProductsByPrice(range.min, range.max);
            });
        } else {
            $('.product').show();
        }

        $('#slider-min-price').val('');
        $('#slider-max-price').val('');
    });

    $('.custom-price-min').click(function (e) {
        e.preventDefault();
        sortProducts('asc');
    });

    $('.custom-price-max').click(function (e) {
        e.preventDefault();
        sortProducts('desc');
    });

    $('.product').each(function () {
        getPriceByVariantId($(this));
    });

    setupVariantClickEvents();
});

</script>

@endpush

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
                                        <label><input type="checkbox" class="custom-price-range" data-min="7000000"
                                                data-max="13000000"> Từ 7 - 13 triệu</label>
                                        <label><input type="checkbox" class="custom-price-range" data-min="13000000"
                                                data-max="20000000"> Từ 13 - 20 triệu</label>
                                        <label><input type="checkbox" class="custom-price-range" data-min="20000000"
                                                data-max="30000000"> Từ 20 - 30 triệu</label>
                                        <label><input type="checkbox" class="custom-price-range" data-min="30000000"> Trên
                                            30 triệu</label>
                                        <hr>
                                        <div class="custom-price-input">
                                            <label>Hoặc nhập khoảng giá phù hợp với bạn:</label>
                                            <div id="price-slider" style="margin: 15px 0;"></div>
                                            <div class="custom-input-group">
                                                <input type="text" id="slider-min-price" placeholder="Giá thấp nhất">
                                                <span>~</span>
                                                <input type="text" id="slider-max-price" placeholder="Giá cao nhất">
                                            </div>
                                            <button id="custom-filter-price-range">Xem kết quả</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-sort-container">
                                <div class="custom-sort-dropdown">
                                    <div class="custom-sort-button">
                                        <span>Sắp xếp</span>
                                        <i class="ic-arrow-select ic-sm"></i>
                                    </div>
                                    <div class="custom-sort-menu">
                                        <div class="custom-sort-menu-wrapper">
                                            <a href="{{ route('products.category', ['categories' => request()->categories, 'sort' => 'price_min']) }}"
                                                class="custom-price-min">
                                                <span>Giá thấp đến giá cao</span>
                                            </a>
                                            <a href="{{ route('products.category', ['categories' => request()->categories, 'sort' => 'price_max']) }}"
                                                class="custom-price-max">
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
        $(document).ready(function() {
            function getPriceByVariantId(productElement) {
                const variantId = productElement.find('.product__memory__item.active').data('variant-id');
                if (!variantId) {
                    console.error("Variant ID không hợp lệ.");
                    return;
                }

                $.ajax({
                    url: '{{ route('getByVariant') }}',
                    method: 'GET',
                    data: {
                        variantId
                    },
                    beforeSend: function() {
                        setLoading(true);
                    },
                    success: function(response) {
                        setLoading(false);

                        if (response.status === 'success') {
                            const price = response.variantColors.price;
                            const discount = response.variantColors.offer_price;
                            const endPrice = price - discount;

                            productElement.find('.product__price .price').text(endPrice.toLocaleString(
                                'vi-VN') + ' ₫');
                            productElement.find('.product__price .text-promo').text(price
                                .toLocaleString('vi-VN') + ' ₫');

                            productElement.attr('data-price', price);
                            productElement.attr('data-discounted-price', endPrice);

                            if (!productElement.attr('data-initial-discounted-price')) {
                                productElement.attr('data-initial-discounted-price', endPrice);
                            }
                        } else {
                            console.error("Error: API không trả về trạng thái thành công.");
                        }
                    },
                    error: function(error) {
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

            function sortProducts(order) {
                const products = $('.product');

                products.sort(function(a, b) {
                    const priceA = parseInt($(a).attr('data-initial-discounted-price')) || 0;
                    const priceB = parseInt($(b).attr('data-initial-discounted-price')) || 0;

                    return order === 'asc' ? priceA - priceB : priceB - priceA;
                });

                $('#product-list').html(products);
                setupVariantClickEvents();
            }

            function filterProductsByPrice(minPrice, maxPrice) {
                $('.product').each(function() {
                    const productPrice = parseInt($(this).attr('data-initial-discounted-price')) || 0;

                    if ((minPrice === null || productPrice >= minPrice) &&
                        (maxPrice === null || productPrice <= maxPrice)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            function setupVariantClickEvents() {
                $('.product__memory__item').off('click').on('click', function() {
                    const productElement = $(this).closest('.product');
                    $(this).closest('.js-select').find('.product__memory__item').removeClass('active');
                    $(this).addClass('active');
                    getPriceByVariantId(productElement);
                });
            }

            function formatCurrencyInput(inputElement) {
                let value = inputElement.value.replace(/[^0-9]/g, '');

                if (value) {
                    value = parseInt(value, 10).toLocaleString('vi-VN') + ' ₫';
                }

                inputElement.value = value;
            }

            function parseCurrency(value) {
                return parseInt(value.replace(/[^0-9]/g, ''), 10) || 0;
            }

            const slider = document.getElementById('price-slider');
            let minSliderPrice, maxSliderPrice;
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
                    to: function(value) {
                        return Math.round(value).toLocaleString('vi-VN') + ' ₫';
                    },
                    from: function(value) {
                        return Number(value.replace(/[^0-9.-]+/g, ''));
                    }
                }
            });

            slider.noUiSlider.on('update', function(values) {
                const minPrice = parseCurrency(values[0]);
                const maxPrice = parseCurrency(values[1]);

                $('#slider-min-price').val(minPrice.toLocaleString('vi-VN') + ' ₫');
                $('#slider-max-price').val(maxPrice.toLocaleString('vi-VN') + ' ₫');
            });


            $('#slider-min-price, #slider-max-price').on('input', function() {
                formatCurrencyInput(this);
            });


            $('#custom-filter-price-range').on('click', function() {
                const minPrice = parseCurrency($('#slider-min-price').val());
                const maxPrice = parseCurrency($('#slider-max-price').val());

                if (minPrice > maxPrice) {
                    alert("Giá thấp nhất không thể lớn hơn giá cao nhất.");
                    return;
                }

                console.log('Khoảng giá được chọn:', minPrice, maxPrice);
                filterProductsByPrice(minPrice, maxPrice);
            });

            $('.custom-price-range').on('change', function() {
                const selectedRanges = [];

                $('.custom-price-range:checked').each(function() {
                    const min = parseFloat($(this).data('min')) || null;
                    const max = parseFloat($(this).data('max')) || null;
                    selectedRanges.push({
                        min,
                        max
                    });
                });

                if (selectedRanges.length > 0) {
                    $('.product').hide();
                    selectedRanges.forEach(function(range) {
                        filterProductsByPrice(range.min, range.max);
                    });
                } else {
                    $('.product').show();
                }

                $('#slider-min-price').val('');
                $('#slider-max-price').val('');
            });


            $('.custom-price-min, .custom-price-max').on('click', function(e) {
                e.preventDefault();
                const selectedText = $(this).find('span').text();
                $('.custom-sort-button span').text(selectedText);

                const order = $(this).hasClass('custom-price-min') ? 'asc' : 'desc';
                sortProducts(order);

                $('.custom-sort-dropdown').removeClass('active');
            });



            $('.product').each(function() {
                getPriceByVariantId($(this));
            });

            setupVariantClickEvents();

            function setActiveSlide(index) {
                const slides = $('.swiper-slide');
                slides.removeClass('active');
                if (index >= slides.length) {
                    index = 0;
                } else if (index < 0) {
                    index = slides.length - 1;
                }
                slides.eq(index).addClass('active');
                localStorage.setItem('activeSlideIndex', index);
            }

            $('.swiper-slide').click(function() {
                const clickedSlide = $(this);
                if (!clickedSlide.hasClass('active')) {
                    $('.swiper-slide').removeClass('active');
                    clickedSlide.addClass('active');
                    setActiveSlide($('.swiper-slide').index(clickedSlide));
                }
            });

            $('.swiper-button-next').click(function() {
                const activeSlide = $('.swiper-slide.active');
                let nextIndex = $('.swiper-slide').index(activeSlide) + 1;
                if (nextIndex >= $('.swiper-slide').length) {
                    nextIndex = 0;
                }
                setActiveSlide(nextIndex);
            });

            $('.swiper-button-prev').click(function() {
                const activeSlide = $('.swiper-slide.active');
                let prevIndex = $('.swiper-slide').index(activeSlide) - 1;
                if (prevIndex < 0) {
                    prevIndex = $('.swiper-slide').length - 1;
                }
                setActiveSlide(prevIndex);
            });

            const storedIndex = localStorage.getItem('activeSlideIndex');
            if (storedIndex !== null) {
                setActiveSlide(parseInt(storedIndex));
            } else if (!$('.swiper-slide').hasClass('active')) {
                $('.swiper-slide').first().addClass('active');
                setActiveSlide(0);
            }

            function setActiveSlideByUrl() {
                const currentUrl = window.location.href;
                $('.swiper-slide').each(function(index) {
                    const slideHref = $(this).attr('href');
                    if (slideHref && currentUrl.includes(slideHref)) {
                        $('.swiper-slide').removeClass('active');
                        $(this).addClass('active');
                        setActiveSlide(index);
                        return false;
                    }
                });
            }
            setActiveSlideByUrl();
        });


        document.addEventListener("DOMContentLoaded", function() {
            const filterDropdown = document.querySelector(".custom-filter-container");
            const sortDropdown = document.querySelector(".custom-sort-container");

            filterDropdown.querySelector(".custom-dropdown-toggle").addEventListener("click", function(e) {
                e.stopPropagation();
                filterDropdown.classList.toggle("active");
                sortDropdown.classList.remove("active");
            });

            sortDropdown.querySelector(".custom-sort-button").addEventListener("click", function(e) {
                e.stopPropagation();
                sortDropdown.classList.toggle("active");
                filterDropdown.classList.remove("active");
            });

            filterDropdown.addEventListener("click", function(e) {
                e.stopPropagation();
            });


            document.addEventListener("click", function() {
                filterDropdown.classList.remove("active");
                sortDropdown.classList.remove("active");
            });
        });
    </script>
@endpush

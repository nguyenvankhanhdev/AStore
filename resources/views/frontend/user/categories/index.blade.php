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
                                    <div class="dropdown-button"><span>Mới nhất</span><i class="ic-arrow-select ic-sm"></i>
                                    </div>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-wrapper scrollbar">
                                            <a class="price_max"><span>Giá thấp đến giá cao</span></a>
                                            <a class="price_min"><span>Giá cao đến giá thấp</span></a>
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
                                            @foreach ($product->variants as $variant)
                                                @switch($variant->color->color)
                                                    @case('Đen')
                                                        <span style="background-color:#232A31"></span>
                                                        @break
                                                    @case('Xanh da trời')
                                                        <span style="background-color:#51b3f0"></span>
                                                        @break
                                                    @case('Xanh lá')
                                                        <span style="background-color:#4859f2"></span>
                                                        @break
                                                    @case('Trắng')
                                                        <span style="background-color:#FAF7F2"></span>
                                                        @break
                                                    @case('Vàng hồng')
                                                        <span style="background-color:#F0D95B"></span>
                                                        @break
                                                    @case('Xám')
                                                        <span style="background-color:#B2C5D6"></span>
                                                        @break
                                                    @default
                                                        <span style="background-color:#FFFFFF"></span> <!-- default color -->
                                                @endswitch
                                            @endforeach
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
                                                    data-price="{{ $variant->price }}"
                                                    data-offer-price="{{ $variant->offer_price }}"
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
                                            @if ($firstVariant)
                                                <div class="price">
                                                    {{ number_format($firstVariant->price - $firstVariant->offer_price, 0, ',', '.') }}đ
                                                </div>
                                                <strike
                                                    class="text-promo p-l-6 f-s-p-16 f-w-400">{{ number_format($firstVariant->price, 0, ',', '.') }}đ</strike>
                                            @else
                                                <div class="price">N/A</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product__detail">
                                        @if ($firstVariant)
                                            <a class="btn btn-outline-grayscale btn-md"
                                                href="{{ route('product.details', ['slug' => $product->slug, 'variant' => $firstVariant->id]) }}">XEM
                                                CHI TIẾT</a>
                                        @else
                                            <a class="btn btn-outline-grayscale btn-md"
                                                href="{{ route('product.details', ['slug' => $product->slug]) }}">XEM CHI
                                                TIẾT</a>
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
            function setActiveSlide(index) {
                const slides = $('.swiper-slide');
                slides.removeClass('active');
                if (index >= slides.length) {
                    index = 0;
                } else if (index < 0) {
                    index = slides.length - 1;
                }
                slides.eq(index).addClass('active');
                // Lưu trạng thái active vào localStorage
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
                    nextIndex = 0; // Quay lại slide đầu tiên nếu đang ở cuối danh sách
                }
                setActiveSlide(nextIndex);
                const nextSlide = $('.swiper-slide').eq(nextIndex);
                const nextHref = nextSlide.attr('href');
                if (nextHref) {
                    window.location.href = nextHref;
                }
            });

            $('.swiper-button-prev').click(function() {
                const activeSlide = $('.swiper-slide.active');
                let prevIndex = $('.swiper-slide').index(activeSlide) - 1;
                if (prevIndex < 0) {
                    prevIndex = $('.swiper-slide').length -
                        1; // Quay lại slide cuối cùng nếu đang ở slide đầu tiên
                }
                setActiveSlide(prevIndex);
                const prevSlide = $('.swiper-slide').eq(prevIndex);
                const prevHref = prevSlide.attr('href');
                if (prevHref) {
                    window.location.href = prevHref;
                }
            });
            const storedIndex = localStorage.getItem('activeSlideIndex');
            if (storedIndex !== null) {
                setActiveSlide(parseInt(storedIndex));
            } else {
                // Nếu chưa có slide active được lưu, thì chọn slide đầu tiên làm active
                if (!$('.swiper-slide').hasClass('active')) {
                    $('.swiper-slide').first().addClass('active');
                    setActiveSlide(0);
                }
            }

            function setActiveSlideByUrl() {
                const currentUrl = window.location.href;

                $('.swiper-slide').each(function(index) {
                    const slideHref = $(this).attr('href');
                    if (slideHref && currentUrl.includes(slideHref)) {
                        $('.swiper-slide').removeClass('active');
                        $(this).addClass('active');
                        setActiveSlide(index);
                        return false; // Dừng vòng lặp khi đã tìm thấy slide tương ứng
                    }
                });
            }
            setActiveSlideByUrl();
        });
        $(document).ready(function() {
            $('.dropdown').cDropdown();
        })
        jQuery.fn.extend({
            cDropdown: function() {
                return this.each(function() {
                    var containermenu = $(this);
                    var button = containermenu.find(".dropdown-button");
                    var menu = containermenu.find(".dropdown-menu");
                    var list = containermenu.find(".dropdown-menu-wrapper");
                    var item = list.children();
                    var option = button.find("span");
                    button.click(function(e) {
                        menu.addClass("open");
                    });
                    item.click(function(e) {
                        e.preventDefault();
                        $(this).siblings().removeClass("active");
                        $(this).addClass("active");
                        var txt = $(this).find("span").text();
                        option.text(txt);
                        menu.removeClass("open");
                    });
                    $(document).click(function(e) {
                        e.stopPropagation();
                        var container = containermenu;
                        if (container.has(e.target).length === 0) {
                            menu.removeClass("open");
                        }
                    });
                });
            },
        });

        function sortProducts(order) {
            var products = $('.product');
            products.sort(function(a, b) {
                var priceA = parseInt($(a).data('discounted-price'));
                var priceB = parseInt($(b).data('discounted-price'));
                if (order === 'asc') {
                    return priceA - priceB;
                } else {
                    return priceB - priceA;
                }
            });

            $('#product-list').html(products);
        }

        $('.price_max').click(function(e) {
            e.preventDefault();
            sortProducts('asc');
        });

        $('.price_min').click(function(e) {
            e.preventDefault();
            sortProducts('desc');
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.product__memory__item').forEach(function(memoryItem) {
                memoryItem.addEventListener('click', function() {
                    const productElement = this.closest('.product');
                    console.log(productElement);
                    const newPrice = this.getAttribute('data-price');
                    const offerPrice = this.getAttribute('data-offer-price');
                    const variantId = this.getAttribute('data-variant-id');

                    this.closest('.js-select').querySelectorAll('.product__memory__item').forEach(
                        function(item) {
                            item.classList.remove('active');
                        });
                    this.classList.add('active');
                    productElement.querySelector('.price').textContent = (newPrice - offerPrice)
                        .toLocaleString('vi-VN') + 'đ';
                    productElement.querySelector('.text-promo').textContent = parseInt(newPrice)
                        .toLocaleString('vi-VN') + 'đ';

                    const detailLink = productElement.querySelector('.product__detail a');
                    const url = new URL(detailLink.href);
                    url.searchParams.set('variant', variantId);
                    detailLink.href = url.toString();
                });
            });
        });
    </script>
@endpush

<div class="category">
    <div class="container">

        <h1 class=" choose-product">Lựa chọn sản phẩm</h1>
        <div class="product-selection">


            <button class="btn btn-primary" onclick="showSection('new')">New</button>
            <button class="btn btn-primary" onclick="showSection('hot')">Hot</button>
            <button class="btn btn-primary" onclick="showSection('top')">Top</button>
            <button class="btn btn-primary" onclick="showSection('best')">Best</button>
            @if ($productsSale->count() > 0)
                <button class="btn btn-primary" onclick="showSection('sale')">Sale</button>
            @endif

        </div>

        <div id="section-new" class="product-section">
            @if ($productsNewArrival->count() == 0)
                <h1 class="h1">Chưa có sản phẩm mới</h1>
                <div class="card card-md category__container">
                    <div class="card-body">
                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h1 class="h1">Sản phẩm mới</h1>
                <div class="card card-md category__container">
                    <div class="card-body">
                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                                @foreach ($productsNewArrival as $product)
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
                                                @elseif ($product->product_type == 'sale_product')
                                                    <span class="badge badge-xs badge-primary badge-link">Giảm
                                                        giá</span>
                                                @elseif($product->product_type == 'accessory')
                                                    <span class="badge badge-xs badge-secondary badge-link">Phụ
                                                        Kiện</span>
                                                @endif
                                            </h3>
                                            <div class="product__memory js-select">
                                                @foreach ($product->variants as $index => $variant)
                                                    @if ($variant->storage->GB == '0GB')
                                                        <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                            style="display: none" data-variant-id="{{ $variant->id }}">
                                                            <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                        </div>
                                                    @else
                                                        <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                            data-variant-id="{{ $variant->id }}">
                                                            <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                        </div>
                                                    @endif
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
                            {{-- <div class="col-xl-12 text-center">
                                <div class="mt-5" style="display:flex; justify-content:center">
                                    @if ($products->hasPages())
                                        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                    @endif

                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            @endif

        </div>

        <div id="section-hot" class="product-section" style="display: none;">
            @if ($productsFeatured->count() == 0)
                <h1 class="h1">Chưa có sản phẩm nổi bật</h1>
                <div class="card card-md category__container">
                    <div class="card-body">
                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h1 class="h1">Sản phẩm nổi bật</h1>
                <div class="card card-md category__container">
                    <div class="card-body">

                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                                @foreach ($productsFeatured as $product)
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
                                                @elseif ($product->product_type == 'sale_product')
                                                    <span class="badge badge-xs badge-primary badge-link">Giảm
                                                        giá</span>
                                                @endif
                                            </h3>
                                            <div class="product__memory js-select">
                                                @foreach ($product->variants as $index => $variant)
                                                @if ($variant->storage->GB == '0GB')
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    style="display: none" data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @else
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @endif
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
                                            </h3>

                                            <div class="product__price">
                                                <div class="text">Giá chỉ</div>
                                                <div class="price">{{ $product->price }}đ</div><strike
                                                    class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>

                                            </div>
                                        </div>
                                @endforeach
                            </div>
                            {{-- <div class="col-xl-12 text-center">
                                <div class="mt-5" style="display:flex; justify-content:center">
                                    @if ($products->hasPages())
                                        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                    @endif

                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            @endif

        </div>


        <div id="section-top" class="product-section" style="display: none;">
            @if ($productsTop->count() == 0)
                <h1 class="h1">Chưa có sản phẩm hàng đầu</h1>
                <div class="card card-md category__container">
                    <div class="card-body">
                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h1 class="h1">Sản phẩm hàng đầu</h1>
                <div class="card card-md category__container">
                    <div class="card-body">

                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                                @foreach ($productsTop as $product)
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
                                                    <span class="badge badge-xs badge-warning badge-link">Nổi
                                                        bật</span>
                                                @elseif ($product->product_type == 'top_product')
                                                    <span class="badge badge-xs badge-info badge-link">Hàng đầu</span>
                                                @elseif ($product->product_type == 'best_product')
                                                    <span class="badge badge-xs badge-danger badge-link">Tốt
                                                        nhất</span>
                                                @elseif ($product->product_type == 'sale_product')
                                                    <span class="badge badge-xs badge-primary badge-link">Giảm
                                                        giá</span>
                                                @endif
                                            </h3>
                                            <div class="product__memory js-select">
                                                @foreach ($product->variants as $index => $variant)
                                                @if ($variant->storage->GB == '0GB')
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    style="display: none" data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @else
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @endif
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
                            {{-- <div class="col-xl-12 text-center">
                                <div class="mt-5" style="display:flex; justify-content:center">
                                    @if ($products->hasPages())
                                        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                    @endif

                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            @endif


        </div>

        <div id="section-sale" class="product-section" style="display: none;">
            @if ($productsSale->count() == 0)
                <h1 class="h1">Chưa có sản phẩm giảm giá</h1>
                <div class="card card-md category__container">
                    <div class="card-body">
                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h1 class="h1">Sản phẩm đang giảm giá mạnh</h1>
                <div class="card card-md category__container">
                    <div class="card-body">

                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                                @foreach ($productsSale as $product)
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
                                                    <span class="badge badge-xs badge-warning badge-link">Nổi
                                                        bật</span>
                                                @elseif ($product->product_type == 'top_product')
                                                    <span class="badge badge-xs badge-info badge-link">Hàng đầu</span>
                                                @elseif ($product->product_type == 'best_product')
                                                    <span class="badge badge-xs badge-danger badge-link">Tốt
                                                        nhất</span>
                                                @elseif ($product->product_type == 'sale_product')
                                                    <span class="badge badge-xs badge-primary badge-link">Giảm
                                                        giá</span>
                                                @endif
                                            </h3>
                                            <div class="product__memory js-select">
                                                @foreach ($product->variants as $index => $variant)
                                                @if ($variant->storage->GB == '0GB')
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    style="display: none" data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @else
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @endif
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
                            {{-- <div class="col-xl-12 text-center">
                                <div class="mt-5" style="display:flex; justify-content:center">
                                    @if ($products->hasPages())
                                        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                    @endif

                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            @endif

        </div>

        <div id="section-best" class="product-section" style="display: none;">
            @if ($productsBest->count() == 0)
                <h1 class="h1">Chưa có sản phẩm tốt nhất</h1>
                <div class="card card-md category__container">
                    <div class="card-body">
                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h1 class="h1">Sản phẩm tốt nhất</h1>
                <div class="card card-md category__container">
                    <div class="card-body">

                        <div class="tab-pane active" id="block-1">
                            <div class="product-list">
                                @foreach ($productsBest as $product)
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
                                                    <span class="badge badge-xs badge-warning badge-link">Nổi
                                                        bật</span>
                                                @elseif ($product->product_type == 'top_product')
                                                    <span class="badge badge-xs badge-info badge-link">Hàng đầu</span>
                                                @elseif ($product->product_type == 'best_product')
                                                    <span class="badge badge-xs badge-danger badge-link">Tốt
                                                        nhất</span>
                                                @endif
                                            </h3>
                                            <div class="product__memory js-select">
                                                @foreach ($product->variants as $index => $variant)
                                                @if ($variant->storage->GB == '0GB')
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    style="display: none" data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @else
                                                <div class="product__memory__item item {{ $index === 0 ? 'active' : '' }}"
                                                    data-variant-id="{{ $variant->id }}">
                                                    <strong>{{ $variant->storage->GB ?? 0 }}</strong>
                                                </div>
                                            @endif
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
                            {{-- <div class="col-xl-12 text-center">
                                <div class="mt-5" style="display:flex; justify-content:center">
                                    @if ($products->hasPages())
                                        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                    @endif

                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            @endif

        </div>

    </div>
</div>

@push('scripts')
    <script>
        function showSection(section) {
            const sections = document.querySelectorAll('.product-section');
            sections.forEach(s => s.style.display = 'none');

            const selectedSection = document.getElementById(`section-${section}`);
            selectedSection.style.display = 'block';
        }
        // Lấy giá trị dung lượng bộ nhớ được chọn
    </script>

    <script>
        $(document).ready(function() {

            function formatNumberToVND(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' ₫';
            }
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

                    success: function(response) {
                        if (response.status === 'success') {
                            const price = response.variantColors.price;
                            const discount = response.variantColors.offer_price;
                            const endPrice = price - discount;

                            productElement.find('.product__price .price').text(formatNumberToVND(endPrice));
                                    productElement.find('.product__price .text-promo').text(formatNumberToVND(price));




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

            var activeItem = $('.product__memory__item.item.active');
            if (activeItem.length === 1) {
                // Lấy dung lượng bộ nhớ từ phần tử active
                var gb = activeItem.find('strong').text().trim().replace('GB', '');
                console.log(gb + ' kl');

                // Ẩn hoặc hiển thị bộ nhớ dựa trên giá trị
                if (gb === '' || parseInt(gb) === 0) {
                    $('.product__memory').hide();
                } else {
                    $('.product__memory').show();
                }
            } else {
                console.error('Nhiều hơn 1 phần tử active hoặc không có phần tử nào!');
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



            $('.product').each(function() {
                getPriceByVariantId($(this));
            });

            setupVariantClickEvents();



        });
    </script>
@endpush

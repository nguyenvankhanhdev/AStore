<div class="category">
    <div class="container">

        <h1 class=" choose-product">Lựa chọn sản phẩm</h1>
        <div class="product-selection">
            <button class="btn btn-primary" onclick="showSection('new')">New</button>
            <button class="btn btn-primary" onclick="showSection('hot')">Hot</button>
            <button class="btn btn-primary" onclick="showSection('top')">Top</button>
            <button class="btn btn-primary" onclick="showSection('best')">Best</button>
        </div>

        <div id="section-new" class="product-section">
        <h1 class="h1">Sản phẩm mới</h1>
        <div class="card card-md category__container">
            <div class="card-body">

                <div class="tab-pane active" id="block-1">
                    <div class="product-list">
                        @foreach ($productsNewArrival as $product)
                            <div class="product">
                                <div class="product__img">
                                    <a href="{{ route('product.details',$product->slug) }}">
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
                                        <div class="price">{{ number_format($product->price,0,",",".") }}đ</div><strike
                                            class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                    </div>
                                </div>
                                <div class="product__detail"><a class="btn btn-outline-grayscale btn-md"
                                        href="{{ route('product.details',$product->slug) }}">XEM
                                        CHI TIẾT </a>
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
        </div>

        <div id="section-hot" class="product-section" style="display: none;">
        <h1 class="h1">Sản phẩm nổi bật</h1>
        <div class="card card-md category__container">
            <div class="card-body">

                <div class="tab-pane active" id="block-1">
                    <div class="product-list">
                        @foreach ($productsFeatured as $product)
                            <div class="product">
                                <div class="product__img">
                                    <a href="{{ route('product.details',$product->slug) }}">
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
        </div>


        <div id="section-top" class="product-section" style="display: none;">
        <h1 class="h1">Sản phẩm hàng đầu</h1>
        <div class="card card-md category__container">
            <div class="card-body">

                <div class="tab-pane active" id="block-1">
                    <div class="product-list">
                        @foreach ($productsTop as $product)
                            <div class="product">
                                <div class="product__img">
                                    <a href="{{ route('product.details',$product->slug) }}">
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
        </div>

        <div id="section-best" class="product-section" style="display: none;">
        <h1 class="h1">Sản phẩm tốt nhất</h1>
        <div class="card card-md category__container">
            <div class="card-body">

                <div class="tab-pane active" id="block-1">
                    <div class="product-list">
                        @foreach ($productsBest as $product)
                            <div class="product">
                                <div class="product__img">
                                    <a href="{{ route('product.details',$product->slug) }}">
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
    </script>

@endpush

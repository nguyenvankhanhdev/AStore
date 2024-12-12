@extends('frontend.user.dashboard.layouts.master')

@section('title')
    Danh sách yêu thích
@endsection

@section('content')
<!--=============================
    DASHBOARD START
==============================-->
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.user.dashboard.layouts.sidebar')
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content mt-2 mt-md-0">
                    <h3><i class="far fa-heart"></i> Danh sách yêu thích</h3>
                    @if($wishlist->isEmpty())
                        <div class="alert alert-info text-center mt-4">
                            Bạn chưa thêm sản phẩm nào vào danh sách yêu thích.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50%">Sản phẩm</th>
                                        <th style="width: 25%">Giá khuyến mãi</th>
                                        <th style="width: 25%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($wishlist as $item)
                                        @php
                                            $variantColor = $item->variantColor;
                                            $variant = $variantColor->variant;
                                            $product = $item->product;
                                            $originalPrice = $variantColor->price;
                                            $offerPrice = $variantColor->offer_price;
                                            $discount = $originalPrice - $offerPrice;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-black btn-lg me-3 delete-wishlist" data-id="{{ $item->id }}" style="font-size: 1.5rem; padding: 0.5rem 0.8rem;">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" style="width: 80px; height: 80px;">
                                                    <div class="ms-3">
                                                        <p class="mb-1"><strong>{{ $product->name }} - {{ $variant->storage->GB }}</strong></p>
                                                        <p class="text-muted mb-0">Màu sắc: {{ $variantColor->color->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-muted mb-1"><del>{{ number_format($originalPrice, 0, ',', '.') }} đ</del></p>
                                                <p class="text-danger fw-bold mb-1">{{ number_format($discount, 0, ',', '.') }} đ</p>
                                                <p class="text-success mb-0">Bạn tiết kiệm: {{ number_format($offerPrice, 0, ',', '.') }} đ</p>

                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-link add-to-cart"
                                                    data-variant-id="{{ $variant->id }}"
                                                    data-color-id="{{ $variantColor->color_id }}"
                                                    style="color: #d42626; font-weight: bold; text-decoration: none;">
                                                    Thêm vào giỏ
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Danh sách yêu thích trống.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<!--=============================
    DASHBOARD END
==============================-->
@endsection

@push('scripts')
<script>
   $(document).on('click', '.delete-wishlist', function (e) {
    e.preventDefault();

    const wishlistId = $(this).data('id');

    if (!wishlistId) {
        toastr.error("Không tìm thấy sản phẩm để xóa!");
        return;
    }

    if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')) {
        return;
    }
    

    // $.ajax({
    //     url: "{{ route('user.wishlist.remove', ':id') }}".replace(':id', wishlistId),
    //     method: 'DELETE',
    //     data: {
    //         _token: $('meta[name="csrf-token"]').attr('content')
    //     },
    //     success: function (response) {
    //         toastr.success(response.message);
    //         $(`button[data-id="${wishlistId}"]`).closest('tr').remove();
    //     },
    //     error: function (xhr) {
    //         toastr.error(xhr.responseJSON.message || "Có lỗi xảy ra khi xóa sản phẩm!");
    //     }
    // });
});


$(document).on('click', '.add-to-cart', function (e) {
    e.preventDefault();

    const variantId = $(this).data('variant-id');
    const colorId = $(this).data('color-id');

    if (!variantId || !colorId) {
        toastr.error("Không tìm thấy thông tin sản phẩm để thêm vào giỏ hàng!");
        return;
    }

    $.ajax({
        url: "{{ route('cart.add') }}",
        method: 'POST',
        data: {
            variant_id: variantId,
            color_id: colorId,
            quantity: 1,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                toastr.success(response.message);
            } else {
                toastr.error(response.message || "Có lỗi xảy ra!");
            }
        },
        error: function (xhr) {
            toastr.error(xhr.responseJSON.message || "Không thêm được sản phẩm vào giỏ hàng!");
        }
    });
});

</script>
@endpush

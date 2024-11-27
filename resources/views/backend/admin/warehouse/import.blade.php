@extends('backend.admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Nhập kho</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Thêm sản phẩm vào kho</h4>
                    </div>
                    <div class="card-body">
                        <form id="warehouse-form" action="{{ route('admin.warehouse.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" value="{{ $nextWarehouseId }}" readonly>
                            </div>

                            <table class="table table-bordered" id="product-table">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Sản phẩm</th>
                                        <th style="width: 20%;">Dung lượng</th>
                                        <th style="width: 20%;">Màu sắc</th>
                                        <th style="width: 10%;">Số lượng</th>
                                        <th style="width: 20%;">Giá nhập</th>
                                        <th style="width: 20%;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="products[0][product_id]" class="form-control product-id">
                                                <option value="">Chọn sản phẩm</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="products[0][variant_id]" class="form-control variant-id">
                                                <option value="">Chọn dung lượng</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="products[0][color_id]" class="form-control color-id">
                                                <option value="">Chọn màu sắc</option>
                                            </select>
                                            <input type="hidden" name="products[0][variant_color_id]" class="variant-color-id">
                                        </td>
                                        <td><input type="number" name="products[0][quantity]" class="form-control quantity" min="1" required></td>
                                        <td><input type="number" name="products[0][warehouse_price]" class="form-control warehouse-price" step="0.01" min="1" required></td>
                                        <td><button type="button" class="btn btn-danger remove-row">Xóa</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" id="add-row" class="btn btn-secondary">Thêm sản phẩm</button>
                            <button type="submit" class="btn btn-primary">Lưu phiếu nhập</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $(document).ready(function () {
    let rowIndex = 1;

    // Thêm dòng sản phẩm mới
    $('#add-row').on('click', function () {
        const newRow = `
            <tr>
                <td>
                    <select name="products[${rowIndex}][product_id]" class="form-control product-id">
                        <option value="">Chọn sản phẩm</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="products[${rowIndex}][variant_id]" class="form-control variant-id">
                        <option value="">Chọn dung lượng</option>
                    </select>
                </td>
                <td>
                    <select name="products[${rowIndex}][color_id]" class="form-control color-id">
                        <option value="">Chọn màu sắc</option>
                    </select>
                    <input type="hidden" name="products[${rowIndex}][variant_color_id]" class="variant-color-id">
                </td>
                <td><input type="number" name="products[${rowIndex}][quantity]" class="form-control quantity" min="1" required></td>
                <td><input type="number" name="products[${rowIndex}][warehouse_price]" class="form-control warehouse-price" step="0.01" min="1" required></td>
                <td><button type="button" class="btn btn-danger remove-row">Xóa</button></td>
            </tr>
        `;
        $('#product-table tbody').append(newRow);
        rowIndex++;
    });

    // Xóa dòng sản phẩm
    $(document).on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
    });
});


    // Khi chọn sản phẩm, load dung lượng
    $(document).on('change', '.product-id', function () {
        const productId = $(this).val();
        const parent = $(this).closest('tr');
        const variantSelect = parent.find('.variant-id');
        const colorSelect = parent.find('.color-id');
        const variantColorInput = parent.find('.variant-color-id');

        variantSelect.empty().append('<option value="">Chọn dung lượng</option>');
        colorSelect.empty().append('<option value="">Chọn màu sắc</option>');
        variantColorInput.val('');

        if (productId) {
            const url = "{{ route('admin.product.variants.get', '') }}/" + productId;

            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(function (variant) {
                            variantSelect.append('<option value="' + variant.id + '">' + variant.storage.GB + '</option>');
                        });
                    }
                },
                error: function () {
                    alert('Không thể tải danh sách dung lượng.');
                }
            });
        }
    });

    // Khi chọn dung lượng, load màu sắc
    $(document).on('change', '.variant-id', function () {
        const variantId = $(this).val();
        const parent = $(this).closest('tr');
        const colorSelect = parent.find('.color-id');
        const variantColorInput = parent.find('.variant-color-id');

        colorSelect.empty().append('<option value="">Chọn màu sắc</option>');
        variantColorInput.val('');

        if (variantId) {
            const url = "{{ route('admin.variant.colors.get', ':id') }}".replace(':id', variantId);

            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(function (color) {
                            colorSelect.append('<option value="' + color.color.id + '">' + color.color.name + '</option>');
                        });
                    }
                },
                error: function () {
                    alert('Không thể tải danh sách màu sắc.');
                }
            });
        }
    });

    // Khi chọn màu sắc, lấy variant_color_id
    $(document).on('change', '.color-id', function () {
        const parent = $(this).closest('tr');
        const variantId = parent.find('.variant-id').val();
        const colorId = $(this).val();
        const variantColorInput = parent.find('.variant-color-id');

        if (variantId && colorId) {
            const url = "{{ route('admin.api.variant.color.get', ['variant_id' => ':variant_id', 'color_id' => ':color_id']) }}"
                .replace(':variant_id', variantId)
                .replace(':color_id', colorId);

            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    if (data.variant_color_id) {
                        variantColorInput.val(data.variant_color_id);
                    }
                },
                error: function () {
                    alert('Không thể lấy Variant Color ID.');
                }
            });
        }
    });
});

</script>

@endpush

@extends('backend.admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" class="form-control" name="image">
                                    <img src="{{ asset($product->image) }}" width="100" alt="Current Image">
                                </div>

                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Danh mục</label>
                                            <select id="inputState" class="form-control main-category" name="category">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $product->cate_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Danh mục phụ</label>
                                            <select id="inputState" class="form-control sub-category" name="sub_category">
                                                <option value="">Select</option>
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}" {{ $product->sub_cate_id == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea name="short_description" class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả dài</label>
                                    <textarea name="long_description" class="form-control summernote">{{ old('long_description', $product->long_description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Loại sản phẩm</label>
                                    <select id="inputState" class="form-control" name="product_type">
                                        <option value="">Chọn</option>
                                        <option value="new_arrival" {{ $product->product_type == 'new_arrival' ? 'selected' : '' }}>Mới</option>
                                        <option value="featured_product" {{ $product->product_type == 'featured_product' ? 'selected' : '' }}>Nổi bật</option>
                                        <option value="top_product" {{ $product->product_type == 'top_product' ? 'selected' : '' }}>Hàng đầu</option>
                                        <option value="best_product" {{ $product->product_type == 'best_product' ? 'selected' : '' }}>Tốt nhất</option>
                                        <option value="sale_product" {{ $product->product_type == 'sale_product' ? 'selected' : '' }}>Giảm giá</option>
                                        <option value="accessory" {{ $product->product_type == 'accessory' ? 'selected' : '' }}>Phụ kiện - Linh kiện</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Trạng thái</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-subcategories') }}",
                    data: { id: id },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>');
                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endpush

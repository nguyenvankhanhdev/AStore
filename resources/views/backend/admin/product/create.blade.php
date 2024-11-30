@extends('backend.admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo sản phẩm</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputState">Danh mục</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputState">Danh mục phụ</label>
                                    <select id="inputState" class="form-control sub-category" name="sub_category">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <textarea name="short_description" class="form-control">{{ old('short_description') }}</textarea>
                        </div>

                        <div class="form-group wsus_input">
                            <label>Mô tả dài</label>
                            <textarea name="long_description" class="form-control summernote">{{ old('long_description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Loại sản phẩm</label>
                            <select id="inputState" class="form-control" name="product_type">
                                <option value="">Chọn</option>
                                <option value="new_arrival">Mới</option>
                                <option value="featured_product">Nổi bật</option>
                                <option value="top_product">Hàng đầu</option>
                                <option value="best_product">Tốt nhất</option>
                                <option value="accessory">Phụ kiện</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                                <option value="1">Cho phép</option>
                                <option value="0">Không cho phép</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tạo</button>
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
                    url: "{{route('admin.product.get-subcategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>')
                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush

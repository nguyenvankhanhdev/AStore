@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Giảm giá</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm danh mục vào giảm giá</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale-item.add-categories') }}" method="POST">
                                @csrf
                                <input type="hidden" name="flash_sale_id" value="{{ $flashSaleDate->id }}">
                                <div class="form-group">
                                    <label>Thêm sản phẩm</label>
                                    <select name="categories" id="" class="form-control select2">
                                        <option value="">Chọn</option>
                                        @foreach ($categories as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Giá giảm </label>
                                            <input type="number" class="form-control" name="offer_price" placeholder="Nhập giá để giảm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Chọn</option>
                                                <option value="1">Cho phép</option>
                                                <option value="0">Không cho phép</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tất cả danh mục giảm giá</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.flash-sale-item-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
            $('body').on('click', '.change-at-home-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.flash-sale-item.show-at-home.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })



        });
    </script>
@endpush

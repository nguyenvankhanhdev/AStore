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
                            <form action="{{ route('admin.admincoupon.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên mã giảm giá</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="form-group">
                                    <label>Mã code</label>
                                    <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Ngày bắt đầu</label>
                                            <input type="date" class="form-control" name="start_date"
                                                value="{{ old('start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Ngày kết thúc</label>
                                            <input type="date" class="form-control" name="end_date"
                                                value="{{ old('end_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="number" name="quantity" class="form-control">{{ old('quantity') }}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Điểm yêu cầu</label>
                                            <input name="required_points" class="form-control">{{ old('required_points') }}
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Giảm giá</label>
                                    <input name="discount" class="form-control">{{ old('discount') }}
                                </div>
                                <div class="form-group">
                                    <label>Loại giảm giá</label>
                                    <select id="inputState" class="form-control" name="discount_type" required>
                                        <option value="" disabled selected>Chọn loại giảm</option>
                                        <option value="percent">Phần trăm</option>
                                        <option value="amount">Số tiền</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Sử dụng tối đa</label>
                                    <input type="number" name="max_use" class="form-control">{{ old('max_use') }}
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
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

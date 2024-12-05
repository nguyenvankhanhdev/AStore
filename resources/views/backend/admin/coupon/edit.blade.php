@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.admincoupon.update', $coupon->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên mã giảm giá</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $coupon->name) }}">
                                </div>

                                <div class="form-group">
                                    <label>Mã code</label>
                                    <input type="text" class="form-control" name="code" value="{{ old('code', $coupon->code) }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Ngày bắt đầu</label>
                                            <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $coupon->start_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Ngày kết thúc</label>
                                            <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $coupon->end_date) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $coupon->quantity) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Điểm yêu cầu</label>
                                            <input name="required_points" class="form-control" value="{{ old('required_points', $coupon->required_points) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Giảm giá</label>
                                    <input name="discount" class="form-control" value="{{ old('discount', $coupon->discount) }}">
                                </div>
                                <div class="form-group">
                                    <label>Loại giảm giá</label>
                                    <select id="inputState" class="form-control" name="discount_type" required>
                                        <option value="" disabled>Chọn loại giảm</option>
                                        <option value="percent" {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                                        <option value="amount" {{ $coupon->discount_type == 'amount' ? 'selected' : '' }}>Số tiền</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Sử dụng tối đa</label>
                                    <input type="number" name="max_use" class="form-control" value="{{ old('max_use', $coupon->max_use) }}">
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Cho phép</option>
                                        <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Không cho phép</option>
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

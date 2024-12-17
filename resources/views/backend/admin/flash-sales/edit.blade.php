@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cập nhật giảm giá</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update',$flashSale->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Ngày bắt đầu</label>
                                    <input type="text" class="form-control datepicker" name="start_date" value="{{ $flashSale->start_date }}">
                                </div>
                                <div class="form-group">
                                    <label>Ngày kết thúc</label>
                                    <input type="text" class="form-control datepicker" name="end_date" value="{{ $flashSale->end_date }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('scripts')

@endpush

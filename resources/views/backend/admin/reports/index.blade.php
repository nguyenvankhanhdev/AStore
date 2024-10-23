@extends('backend.admin.layouts.master')

@section('content')
    <div class="container">
        <!-- Tiêu đề báo cáo -->
        <h1>Báo cáo bán hàng từ {{ $fromDate->format('Y-m-d') }} đến {{ $toDate->format('Y-m-d') }}</h1>

        <!-- Form để chọn khoảng thời gian -->
        <form method="GET" action="{{ route('admin.reports') }}">
            <div class="form-group">
                <label for="from_date">Từ ngày:</label>
                <input type="date" id="from_date" name="from_date" class="form-control ml-2" required value="{{ request('from_date') }}">
            </div>

            <div class="form-group ml-3">
                <label for="to_date">Đến ngày:</label>
                <input type="date" id="to_date" name="to_date" class="form-control ml-2" required value="{{ request('to_date') }}">
            </div>

            <button type="submit" class="btn btn-primary ml-3">Lấy báo cáo</button>
        </form>

        <!-- Kiểm tra nếu có dữ liệu báo cáo -->
        @if(count($report) > 0)
            <!-- Bảng hiển thị báo cáo -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng đã bán</th>
                        <th>Số lượng nhập</th>
                        <th>Tồn kho</th>
                        <th>Tổng doanh thu</th>
                        <th>Lợi nhuận</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report as $data)
                        <tr>
                            <td>{{ $data['product_name'] }} - {{ $data['variant_name'] }} GB - {{ $data['color_name'] }}</td>
                            <td>{{ $data['total_sold'] }}</td>
                            <td>{{ $data['quantity_imported'] }}</td> <!-- Hiển thị số lượng nhập -->
                  <td>{{ $data['stock'] }}</td>
                            <td>{{ number_format($data['revenue'], 2) }} $</td>
                            <td>{{ number_format($data['profit'], 2) }} $</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        @else
            <!-- Hiển thị thông báo nếu không có dữ liệu -->
            <p class="text-center">Không có dữ liệu bán hàng trong khoảng thời gian này.</p>
        @endif
    </div>
@endsection




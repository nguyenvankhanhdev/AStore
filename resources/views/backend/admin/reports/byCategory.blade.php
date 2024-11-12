@extends('backend.admin.layouts.master')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container my-5 p-4 bg-light rounded shadow-sm">
        <!-- Tiêu đề báo cáo -->
        <h2 class="text-center mb-4" style="font-weight: bold; color: #2c3e50;">
            Báo cáo theo danh mục sản phẩm từ {{ Carbon::parse($fromDate)->format('d/m/Y') }} đến {{ Carbon::parse($toDate)->format('d/m/Y') }}
        </h2>

        <!-- Form chọn ngày -->
        <form method="GET" action="{{ route('admin.reports.byCategory') }}" class="row justify-content-center align-items-center mb-4 g-3">
            <div class="col-md-3">
                <label for="from_date" class="form-label fw-bold text-primary">Từ ngày:</label>
                <input type="date" id="from_date" name="from_date" class="form-control" required value="{{ Carbon::parse($fromDate)->format('Y-m-d') }}">
            </div>

            <div class="col-md-3">
                <label for="to_date" class="form-label fw-bold text-primary">Đến ngày:</label>
                <input type="date" id="to_date" name="to_date" class="form-control" required value="{{ Carbon::parse($toDate)->format('Y-m-d') }}">
            </div>

            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary w-100 py-2" style="font-size: 1rem; font-weight: bold;">Lấy báo cáo</button>
            </div>
        </form>

        <!-- Lựa chọn loại báo cáo -->
        <div class="text-center mb-4">
            <label for="report_type" class="form-label">Chọn loại báo cáo:</label>
            <select id="report_type" class="form-select d-inline w-auto" onchange="window.location.href=this.value">
                <option value="{{ route('admin.reports') }}" {{ request()->routeIs('admin.reports') ? 'selected' : '' }}>Doanh thu tất cả sản phẩm</option>
                <option value="{{ route('admin.reports.byCategory') }}" {{ request()->routeIs('admin.reports.byCategory') ? 'selected' : '' }}>Doanh thu theo danh mục</option>
            </select>
        </div>

        <!-- Hiển thị báo cáo -->
        @if(count($report) > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="text-center mb-4" style="font-weight: bold; color: #34495e;">Báo Cáo Theo Danh Mục</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="fw-bold">Tên danh mục</th>
                                    <th class="fw-bold">Số lượng nhập</th>
                                    <th class="fw-bold">Số lượng đã bán</th>
                                    <th class="fw-bold">Tổng doanh thu (đ)</th>
                                    <th class="fw-bold">Lợi nhuận (đ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($report as $data)
                                    <tr>
                                        <td>{{ $data['category_name'] }}</td>
                                        <td>{{ $data['quantity_imported'] }}</td>
                                        <td>{{ $data['total_sold'] }}</td>
                                        <td>{{ number_format($data['revenue'], 0, ',', '.') }} đ</td>
                                        <td>{{ number_format($data['profit'], 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bảng tổng kết -->
                    <table class="table table-bordered table-striped text-center" style="width: 60%; margin: 0;">
                        <thead class="table-secondary">
                            <tr>
                                <th class="fw-bold">Tổng số lượng nhập</th>
                                <th class="fw-bold">Tổng số lượng đã bán</th>
                                <th class="fw-bold">Tổng doanh thu (đ)</th>
                                <th class="fw-bold">Tổng lợi nhuận (đ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $totalQuantityImported }}</td>
                                <td>{{ $totalSold }}</td>
                                <td>{{ number_format($totalRevenue, 0, ',', '.') }} đ</td>
                                <td>{{ number_format($totalProfit, 0, ',', '.') }} đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <!-- Thông báo không có dữ liệu -->
            <p class="text-center text-muted my-4">Không có dữ liệu bán hàng trong khoảng thời gian này.</p>
        @endif
    </div>
@endsection 

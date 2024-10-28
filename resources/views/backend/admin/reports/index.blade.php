@extends('backend.admin.layouts.master')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container my-5 p-4 bg-light rounded shadow-sm">
        <!-- Title of the report -->
        <h2 class="text-center mb-4" style="font-weight: bold; color: #2c3e50;">
            Báo cáo bán hàng từ {{ Carbon::parse($fromDate)->format('d/m/Y') }} đến {{ Carbon::parse($toDate)->format('d/m/Y') }}
        </h2>

        <!-- Date selection form -->
        <form method="GET" action="{{ route('admin.reports') }}" class="row justify-content-center align-items-center mb-4 g-3">
            <div class="col-md-3">
                <label for="from_date" class="form-label">Từ ngày:</label>
                <input type="date" id="from_date" name="from_date" class="form-control" required value="{{ Carbon::parse($fromDate)->format('Y-m-d') }}">
            </div>

            <div class="col-md-3">
                <label for="to_date" class="form-label">Đến ngày:</label>
                <input type="date" id="to_date" name="to_date" class="form-control" required value="{{ Carbon::parse($toDate)->format('Y-m-d') }}">
            </div>

            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary w-100 py-2" style="font-size: 1rem; font-weight: bold;">Lấy báo cáo</button>
            </div>
        </form>

        <!-- Report type selection -->
        <div class="text-center mb-4">
            <label for="report_type" class="form-label">Chọn loại báo cáo:</label>
            <select id="report_type" class="form-select d-inline w-auto" onchange="window.location.href=this.value">
                <option value="{{ route('admin.reports') }}" {{ request()->routeIs('admin.reports') ? 'selected' : '' }}>Doanh thu tất cả sản phẩm</option>
                <option value="{{ route('admin.reports.byCategory') }}" {{ request()->routeIs('admin.reports.byCategory') ? 'selected' : '' }}>Doanh thu theo danh mục</option>
            </select>
        </div>

        <!-- Report Table -->
        @if(count($report) > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="text-center mb-4" style="font-weight: bold; color: #34495e;">Báo Cáo Bán Hàng</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng nhập</th>
                                    <th>Số lượng đã bán</th>
                                    <th>Giá nhập</th>
                                    <th>Giá bán</th>
                                    <th>Giá hàng tồn kho</th>
                                    <th>Tồn kho</th>
                                    <th>Tổng doanh thu</th>
                                    <th>Lợi nhuận</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($report as $data)
                                    <tr>
                                        <td>{{ $data['product_name'] }} - {{ $data['variant_name'] }} GB - {{ $data['color_name'] }}</td>
                                        <td>{{ $data['quantity_imported'] }}</td>
                                        <td>{{ $data['total_sold'] }}</td>
                                        <td>{{ number_format($data['warehouse_price'], 0, '', ',') }} đ</td>
                                        <td>{{ number_format($data['offer_price'], 0, '', ',') }} ₫</td>
                                        <td>{{ number_format($data['inventory_value'], 0, '', ',') }} ₫</td>
                                        <td>{{ $data['stock'] }}</td>
                                        <td>{{ number_format($data['revenue'], 0, '', ',') }} đ</td>
                                        <td>{{ number_format($data['profit'], 0, '', ',') }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Summary Table -->
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="text-center mb-4" style="font-weight: bold; color: #34495e;">Tổng Quan</h5>
                    <table class="table table-bordered table-striped">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>Tổng số lượng nhập</th>
                                <th>Tổng số lượng đã bán</th>
                                <th>Tổng giá trị hàng tồn kho</th>
                                <th>Tổng doanh thu</th>
                                <th>Tổng lợi nhuận</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>{{ $totalQuantityImported }}</td>
                                <td>{{ $totalSold }}</td>
                                <td>{{ number_format($totalInventoryValue, 0, '', ',') }} ₫</td>
                                <td>{{ number_format($totalRevenue, 0, '', ',') }} đ</td>
                                <td>{{ number_format($totalProfit, 0, '', ',') }} đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- No Data Message -->
            <p class="text-center text-muted my-4">Không có dữ liệu bán hàng trong khoảng thời gian này.</p>
        @endif
    </div>
@endsection

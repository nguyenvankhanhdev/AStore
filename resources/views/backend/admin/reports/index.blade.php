@extends('backend.admin.layouts.master')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container my-5 p-4 bg-white rounded shadow-lg">
        <!-- Title of the report -->
        <h2 class="text-center mb-4" style="font-weight: bold; color: #2c3e50;">
            Báo cáo bán hàng từ {{ Carbon::parse($fromDate)->format('d/m/Y') }} đến {{ Carbon::parse($toDate)->format('d/m/Y') }}
        </h2>

        <!-- Date selection form -->
        <form method="GET" action="{{ route('admin.reports') }}" class="row justify-content-center align-items-center mb-4 g-3">
            <div class="col-md-3">
                <label for="from_date" class="form-label fw-bold text-primary">Từ ngày:</label>
                <input type="date" id="from_date" name="from_date" class="form-control" required value="{{ Carbon::parse($fromDate)->format('Y-m-d') }}">
            </div>

            <div class="col-md-3">
                <label for="to_date" class="form-label fw-bold text-primary">Đến ngày:</label>
                <input type="date" id="to_date" name="to_date" class="form-control" required value="{{ Carbon::parse($toDate)->format('Y-m-d') }}">
            </div>

            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Lấy báo cáo</button>
            </div>
        </form>

        <!-- Report type selection -->
        <div class="text-center mb-4">
            <label for="report_type" class="form-label fw-bold" style="color: #2c3e50;">Chọn loại báo cáo:</label>

            <select id="report_type" class="form-select d-inline w-auto shadow-sm border-secondary" onchange="window.location.href=this.value">
                <option value="{{ route('admin.reports') }}" {{ request()->routeIs('admin.reports') ? 'selected' : '' }}>Doanh thu tất cả sản phẩm</option>
                <option value="{{ route('admin.reports.byCategory') }}" {{ request()->routeIs('admin.reports.byCategory') ? 'selected' : '' }}>Doanh thu theo danh mục</option>
            </select>
        </div>

        <!-- Report Table -->
        @if(count($report) > 0)
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5 class="text-center mb-4" style="font-weight: bold; color: #34495e;">Báo Cáo Bán Hàng</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th class="fw-bold">Tên sản phẩm</th>
                                    <th class="fw-bold">Số lượng nhập</th>
                                    <th class="fw-bold">Số lượng đã bán</th>
                                    <th class="fw-bold">Giá nhập</th>
                                    <th class="fw-bold">Giá bán</th>
                                    <th class="fw-bold">Giá hàng tồn kho</th>
                                    <th class="fw-bold">Tồn kho</th>
                                    <th class="fw-bold">Tổng doanh thu</th>
                                    <th class="fw-bold">Lợi nhuận</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($report as $data)
                                    <tr>
                                        <td style="line-height: 1.6; padding: 8px;">
                                            <div style="font-weight: bold; color: #2c3e50; font-size: 1.1em;">
                                                {{ $data['product_name'] }}
                                            </div>
                                            <ul style="list-style: none; padding: 0; margin: 5px 0 0;">
                                                <li style="font-size: 0.9em; color: #34495e;">
                                                    {{ $data['variant_name'] }}GB
                                                </li>
                                                <li style="font-size: 0.9em; color: #34495e;">
                                                    {{ $data['color_name'] }}
                                                </li>
                                                @if($data['new_imports'] == 0)
                                                    <li style="color: #e74c3c; font-size: 0.85em;">
                                                        (Không có nhập kho trong tháng)
                                                    </li>
                                                @endif
                                            </ul>
                                        </td>

                                        <td>{{ $data['quantity_imported'] }}</td>
                                        <td>{{ $data['total_sold'] }}</td>
                                        <td>{{ number_format($data['warehouse_price'], 0, '', ',') }}đ</td>
                                        <td>{{ number_format($data['offer_price'], 0, '', ',') }}₫</td>
                                        <td>{{ number_format($data['inventory_value'], 0, '', ',') }}₫</td>
                                        <td>{{ $data['stock'] }}</td>
                                        <td>{{ number_format($data['revenue'], 0, '', ',') }}đ</td>
                                        <td>{{ number_format($data['profit'], 0, '', ',') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Summary Table -->
            <div class="card shadow mt-4">
                <div class="card-body">
                    <h5 class="text-center mb-4" style="font-weight: bold; color: #34495e;">Tổng Quan</h5>
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th class="fw-bold">Tổng số lượng nhập</th>
                                <th class="fw-bold">Tổng số lượng đã bán</th>
                                <th class="fw-bold">Tổng giá trị hàng tồn kho</th>
                                <th class="fw-bold">Tổng doanh thu</th>
                                <th class="fw-bold">Tổng lợi nhuận</th>
                            </tr>
                        </thead>
                        <tbody>
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

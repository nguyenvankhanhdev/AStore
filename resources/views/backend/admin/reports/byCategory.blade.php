@extends('backend.admin.layouts.master')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4" style="font-weight: bold; font-size: 1.75rem;">
            Báo cáo theo danh mục sản phẩm từ {{ Carbon::parse($fromDate)->format('d/m/Y') }} đến {{ Carbon::parse($toDate)->format('d/m/Y') }}
        </h1>

        <!-- Date selection form -->
        <form method="GET" action="{{ route('admin.reports.byCategory') }}" class="d-flex justify-content-center align-items-center mb-4">
            <div class="form-group mr-3">
                <label for="from_date" class="mr-2">Từ ngày:</label>
                <input type="date" id="from_date" name="from_date" class="form-control" required value="{{ Carbon::parse($fromDate)->format('Y-m-d') }}">
            </div>

            <div class="form-group mr-3">
                <label for="to_date" class="mr-2">Đến ngày:</label>
                <input type="date" id="to_date" name="to_date" class="form-control" required value="{{ Carbon::parse($toDate)->format('Y-m-d') }}">
            </div>

            <button type="submit" class="btn btn-primary px-4 py-2" style="font-size: 1rem;">Lấy báo cáo</button>
        </form>

        @if(count($report) > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Tên danh mục</th>
                                    <th>Số lượng nhập</th>
                                    <th>Số lượng đã bán</th>
                                    <th>Tổng doanh thu</th>
                                    <th>Lợi nhuận</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($report as $data)
                                    <tr class="text-center">
                                        <td>{{ $data['category_name'] }}</td>
                                        <td>{{ $data['quantity_imported'] }}</td>
                                        <td>{{ $data['total_sold'] }}</td>
                                        <td>{{ number_format($data['revenue'], 2) }} $</td>
                                        <td>{{ number_format($data['profit'], 2) }} $</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Summary Table Below the Main Report Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center mb-4" style="font-weight: bold;">Tổng Quan</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Tổng số lượng nhập</th>
                                <th>Tổng số lượng đã bán</th>
                                <th>Tổng doanh thu</th>
                                <th>Tổng lợi nhuận</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $totalQuantityImported }}</td>
                                <td>{{ $totalSold }}</td>
                                <td>{{ number_format($totalRevenue, 2) }} $</td>
                                <td>{{ number_format($totalProfit, 2) }} $</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p class="text-center text-muted">Không có dữ liệu bán hàng trong khoảng thời gian này.</p>
        @endif
    </div>
@endsection

<?php
$address = json_decode($order->address, true);
// $shipping = optional($order->shipping);
// $coupon = optional($order->coupon);
?>
@extends('backend.admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Chi tiết hóa đơn</h1>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Hóa đơn đặt hàng</h2>
                                <div class="invoice-number">Order #{{ $order->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Lập hóa đơn cho: </strong><br>
                                        <b>Họ Tên :</b> {{ $address['name'] ?? 'N/A' }}<br>
                                        <b>Địa chỉ Email:</b> {{ $address['email'] ?? 'N/A' }}<br>
                                        {{-- <b>Phone:</b> {{ $address['phone'] ?? 'N/A' }}<br>
                                    <b>Address:</b> {{ $address['address'] ?? 'N/A' }}<br>
                                    {{ $address['province'] ?? 'N/A' }}, {{ $address['district'] ?? 'N/A' }}, {{ $address['ward'] ?? 'N/A' }} --}}
                                    </address>
                                </div>

                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Vận chuyển đến:</strong><br>
                                        <b>Họ Tên:</b> {{ $address['name'] ?? 'N/A' }}<br>
                                        <b>Địa chỉ Email:</b> {{ $order->user->email ?? 'N/A' }}<br>
                                        <b>Số điện thoại:</b> {{ $address['phone'] ?? 'N/A' }}<br>
                                        <b>Địa chỉ:</b> {{ $address['address'] ?? 'N/A' }}<br>
                                        {{ $address['province'] ?? 'N/A' }}, {{ $address['district'] ?? 'N/A' }},
                                        {{ $address['ward'] ?? 'N/A' }}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-6">
                                <address>
                                    <strong>Payment Information:</strong><br>
                                    <b>Method:</b> {{ $order->payment_method ?? 'N/A' }}<br>
                                    <b>Transaction Id:</b> {{ optional($order->transaction)->transaction_id ?? 'N/A' }}<br>
                                    <b>Status:</b> {{ $order->payment_status === 1 ? 'Complete' : 'Pending' }}
                                </address>
                            </div> --}}
                                <div class="col-md-12 text-md-right">
                                    <address>
                                        <strong>Ngày đặt hàng: </strong><br>
                                        {{ date('d F, Y', strtotime($order->created_at)) }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-right">Tổng</th>
                                        <th class="text-right">Giảm giá</th>
                                    </tr>
                                    @foreach ($order->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ optional($detail->variantColors->variant->product)->name ?? 'Unknown product' }}
                                                -
                                                {{ optional($detail->variantColors->color)->name ?? 'N/A' }} -
                                                {{ optional($detail->variantColors->variant->storage)->GB ?? 'N/A' }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($detail->total_price / $detail->quantity, 0, '.', ',') . 'đ' }}
                                                {{ $settings->currency_icon ?? 'đ' }}
                                            </td>
                                            <td class="text-center">{{ $detail->quantity ?? 0 }}</td>
                                            <td class="text-right">
                                                {{ number_format($detail->total_price, 0, '.', ',') . 'đ' }}
                                            </td>
                                            <td class="text-right">
                                                @if ($order->coupon)
                                                    @if ($order->coupon->discount_type === 'percent')
                                                        {{ number_format($detail->total_price * ($order->coupon->discount / 100), 0, '.', ',') . 'đ' }}
                                                    @elseif ($order->coupon->discount_type === 'amount')
                                                        {{ number_format($order->coupon->discount, 0, '.', ',') . 'đ' }}
                                                    @endif
                                                @else
                                                    0 đ
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Trạng thái thanh toán</label>
                                        <select name="payment_status" id="payment_status" class="form-control"
                                            data-id="{{ $order->id }}">
                                            <option {{ $order->payment_status === 'pending' ? 'selected' : '' }}
                                                value="pending">Đang chờ</option>
                                            <option {{ $order->payment_status === 'completed' ? 'selected' : '' }}
                                                value="completed">Hoàn thành</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <form method="POST" action="{{ route('admin.orders.status') }}">
                                            @csrf
                                            <label for="order_status">Trạng thái đơn hàng</label>
                                            <select name="order_status" id="order_status" data-id="{{ $order->id }}"
                                                class="form-control">
                                                @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                    <option value="{{ $key }}"
                                                        {{ $order->status === $key ? 'selected' : '' }}>
                                                        {{ $orderStatus['status'] }}</option>
                                                @endforeach
                                            </select>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Tạm tính</div>
                                        <div class="invoice-detail-value">
                                            {{ number_format($subTotal, 0, '.', ',') . ' đ' }}
                                        </div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Giảm giá (-)</div>
                                        <div class="invoice-detail-value">
                                            {{ number_format($totalDiscount, 0, '.', ',') . ' đ' }}
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Thanh toán</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ number_format($totalAfterDiscount, 0, '.', ',') . ' đ' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-md-right">
                <button class="btn btn-warning btn-icon icon-left print_invoice"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#order_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.orders.status') }}",
                    data: {
                        status: status,
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Failed to update order status.');
                    }
                });
            });
            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.payment.status') }}", // Đảm bảo route này đúng
                    data: {
                        status: status,
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                        } else {
                            toastr.error('Failed to update payment status.');
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Failed to update payment status.');
                    }
                });
            });


            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();
                $('body').html(printBody.html());
                window.print();
                $('body').html(originalContents);
            });
        });
    </script>
@endpush

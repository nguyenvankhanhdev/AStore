@php
    $address = json_decode($order->address);
    $shipping = json_decode($order->shpping_method);
    $coupon = json_decode($order->coupon);
@endphp

@extends('frontend.user.dashboard.layouts.master')
@section('title')
FPT || Chi tiết đơn hàng
@endsection


@section('content')
    <!--=============================
                DASHBOARD START
              ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.user.dashboard.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i>Chi tiết đơn hàng</h3>
                        <div class="wsus__dashboard_profile">

                            <!--============================
                                    INVOICE PAGE START
                                ==============================-->
                            <section id="" class="invoice-print">
                                <div class="">
                                    <div class="wsus__invoice_area">
                                        <div class="wsus__invoice_header">
                                            <div class="wsus__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single">
                                                            <h5>Thông tin khách hàng</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->ward }},
                                                                {{ $address->district }}, {{ $address->province }}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single text-md-center">
                                                            <h5>Thông tin vận chuyển</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->ward }},
                                                                {{ $address->district }}, {{ $address->province }}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="wsus__invoice_single text-md-end">
                                                            <h6>Trạng thái đơn hàng:

                                                                @if ($order->status == 'pending')
                                                                    <span class="badge bg-warning text-dark"> Đang chờ xử lí
                                                                    </span>

                                                                @endif
                                                            </h6>
                                                            <p>Phương thức thanh toán:
                                                                @if ($order->payment_method == 'cod')
                                                                    <span class="badge bg-warning text-dark">Thanh toán khi
                                                                        nhận hàng</span>
                                                                @else
                                                                    <span class="badge bg-warning text-dark">Thanh toán qua
                                                                        thẻ</span>
                                                                @endif
                                                            </p>
                                                            </p>
                                                            <p>Trạng thái: {{ $order->payment_status }}</p>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wsus__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="name">
                                                                sản phẩm
                                                            </th>
                                                            <th class="amount">
                                                                giá
                                                            </th>

                                                            <th class="offer_price">
                                                                giá đã giảm
                                                            </th>
                                                            <th class="quantity">
                                                                số lượng
                                                            </th>

                                                            <th class="total">
                                                                Tiền thanh toán
                                                            </th>
                                                        </tr>
                                                        @foreach ($order->orderDetails as $orderDetail)
                                                            <tr>
                                                                <td class="name">
                                                                    <p>{{ $orderDetail->variantColors->variant->product->name }}
                                                                        -
                                                                        {{ $orderDetail->variantColors->variant->storage->GB }}
                                                                    </p>

                                                                </td>
                                                                <td class="amount">
                                                                    {{ number_format($orderDetail->variantColors->price, '0', '.') }}
                                                                    đ
                                                                </td>

                                                                <td class="offer_price">
                                                                    {{ number_format($orderDetail->variantColors->offer_price, '0', '.') }}
                                                                    đ
                                                                </td>
                                                                <td class="quantity" style="margin-left: 40px;">
                                                                    {{ $orderDetail->quantity }}
                                                                </td>
                                                                <td class="total" style="    margin-left: 35px;">
                                                                    {{ number_format($order->total_amount, '0', '.') }} đ

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">
                                            {{-- <p><span>Sub Total:</span>{{@$order->sub_total}}</p> --}}
                                            {{-- <p><span>Shipping Fee(+):</span>{{ @$settings->currency_icon }} {{@$shipping->cost}} </p>
                                            <p><span>Coupon(-):</span>{{ @$settings->currency_icon }} {{@$coupon->discount ? $coupon->discount : 0}}</p> --}}
                                            <p><span>Tổng tiền cẩn thanh toán
                                                    :</span>{{ number_format($order->total_amount, '0', '.') }}đ</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--============================
                                    INVOICE PAGE END
                                ==============================-->
                            <div class="col">
                                <div class="mt-2 float-end">
                                    <button class="btn btn-warning print_invoice">print</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                DASHBOARD START
              ==============================-->
@endsection

@push('scripts')
    <script>
        $('.print_invoice').on('click', function() {
            let printBody = $('.invoice-print');
            let originalContents = $('body').html();

            $('body').html(printBody.html());

            window.print();

            $('body').html(originalContents);

        })
    </script>
@endpush
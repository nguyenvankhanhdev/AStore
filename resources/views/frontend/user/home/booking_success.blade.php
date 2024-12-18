@php
    $address = json_decode($order->address);
    $coupon = json_decode($order->coupon);
@endphp
@extends('frontend.user.layouts.master')

@section('content')
    <div class="c-cart bg-gray-100 gallery-off">
        <div class="container">
            <div class="c-cart__wrap p-y-32">
                <div class="card">
                    <div class="card-title" style="text-align: center">Đặt hàng thành công</div>
                    <div class="card-body">
                        <div class="c-cart__noti loyalty">
                            <div class="loyalty-img"><img src="/frontend/asset/img/booking-success.png"></div>
                            <p class="f-s-p-18 text-grayscale-800 f-w-500 p-t-8">Cảm ơn quý khách đã mua hàng tại A.Studio
                            </p>
                        </div>
                        <div class="c-cart__data-user">
                            <div class="c-modal__row info-ship">
                                <div class="st-table-title f-s-p-16">Thông tin giao hàng</div>
                                <table class="table-default st-table">
                                    <tbody>
                                        <tr>
                                            <td>Mã số đơn hàng</td>
                                            <td class="ship_number f-w-500 ">{{ $order->id }}{{ Str::random(10,10000) }} </td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td class="phone_ship">{{ $address->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class="mail_ship">{{ $address->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phương thức thanh toán</td>
                                            <td class="phone_ship">@if($order->payment_method == 'COD')
                                                Thanh toán khi nhận hàng
                                                @else
                                                Thanh toán trực tuyến qua {{ $order->payment_method }}
                                            @endif</td>
                                        </tr>
                                        <tr>
                                            <td>Giao hàng đến</td>
                                            <td class="addressship_ship">{{ $address->address }}, {{ $address->ward }},
                                                {{ $address->district }}, {{ $address->province }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="c-modal__row info-ship">
                            <div class="st-table-title f-s-p-16">Thông tin đơn hàng<p
                                    class="cart-quantity-text f-w-500 f-s-p-16">
                                    Số lượng</p>
                                <p class="f-w-500 f-s-p-16">Thành tiền</p>
                            </div>
                        </div>
                        <div class="c-cart__product-success p-x-16 p-y-24" data-brand="Apple (iPhone)" data-variant="597164"
                            data-producttype="1" data-productid="34678">
                            @foreach ($order->orderDetails as $orderDetail)
                                <div class="product-cart cart-shadow">
                                    <div class="product-cart__img"><img
                                            src="{{ asset($orderDetail->variantColors->variant->product->image) }}"
                                            alt="{{ $orderDetail->variantColors->variant->product->name }}"></div>
                                    <div class="product-cart__info">
                                        <div class="product-cart__inside">
                                            <h3 class="product-cart__name product-cart__name--lg name-product-split">
                                                {{ $orderDetail->variantColors->variant->product->name }}
                                                @if( $orderDetail->variantColors->variant->storage->GB === '0GB')

                                                @else
                                                   - {{ $orderDetail->variantColors->variant->storage->GB }}
                                                @endif
                                                -
                                                {{ $orderDetail->variantColors->color->name }}</h3>
                                            <div class="product-cart__line"></div>
                                        </div>
                                        <div class="product-cart__quality">
                                            <div class="product-cart__quality__wrap">
                                                <span>{{ $orderDetail->quantity }}</span>
                                            </div>
                                        </div>
                                        <div class="product-cart__price">
                                            <div class="cs-price cs-price--main">
                                                {{ number_format($orderDetail->total_price, 0, ',', '.') }} ₫</div>

                                            {{-- <div class="fst-cart-tag m-t-4"><a
                                                    class="badge badge-default badge-xxxs fst-cart-badge m-r-4"
                                                    href="#"><i class="ic-tag m-r-4"></i><span>MACBOOK16</span></a>
                                                <div class="cs-price cs-price--main f-w-500">-1.500.000₫</div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="c-cart__success-pay m-t-16">
                                <div class="text--lg success-pay-title">
                                    <div class="group-number">

                                        <span class="text-size--lg p-r-24">Tạm tính:</span>
                                        <span
                                            class="re-price f-w-500 f-s-p-16 re-red" style="margin-left:46px;">{{ number_format($subTotal, 0, ',', '.') }}
                                            đ</span>
                                        <br>
                                        <span class="text-size--lg p-r-24">Giảm giá:</span>
                                        <span class="re-price f-w-500 f-s-p-16 re-red m-r-4" style="margin-left:40px;">
                                            @if ($order->coupon_id != null)
                                               - {{ number_format($order->coupon->discount * 1000, 0, ',', '.') }} đ
                                            @else
                                                - 0đ
                                            @endif
                                        </span>


                                        <br>
                                        <span class="text-size--lg p-r-24">
                                            @if ($order->payment_method == 'COD')
                                                Cần thanh toán:
                                            @else
                                                Đã thanh toán:
                                            @endif
                                        </span>

                                        <span
                                            class="re-price f-w-500 f-s-p-16 re-red">{{ number_format($order->total_amount, 0, ',', '.') }}
                                            đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="c-cart__callback text-center p-y-24"><button class="btn btn-xl btn-link"
                                id="btnCompleteOrder">VỀ TRANG CHỦ</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#btnCompleteOrder').click(function() {
                window.location.href = '/';
            });
        });
    </script>
@endpush

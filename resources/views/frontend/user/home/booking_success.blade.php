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
                            <p class="f-s-p-18 text-grayscale-800 f-w-500 p-t-8">Cảm ơn quý khách đã mua hàng tại F.Studio by
                                FPT
                            </p>
                        </div>
                        {{-- <div class="c-cart__data-user">
                            <div class="c-modal__row info-ship">
                                <div class="st-table-title f-s-p-16">Thông tin giao hàng</div>
                                <table class="table-default st-table">
                                    <tbody>
                                        <tr>
                                            <td>Mã số đơn hàng</td>
                                            <td class="ship_number f-w-500 f-s-p-18">1234<a
                                                    class="btn btn-xs btn-link m-l-8" href=""
                                                    aria-controls="cart-check-order">Tra cứu đơn hàng</a></td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td class="phone_ship">00000000000</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class="mail_ship">Chỉ giao hàng giờ hành chính</td>
                                        </tr>
                                        <tr>
                                            <td>Giao hàng đến</td>
                                            <td class="addressship_ship">1231231, Xã Đồng Lạc , Huyện Chương Mỹ, Hà Nội</td>
                                        </tr>
                                        <tr>
                                            <td>Thời gian dự kiến</td>
                                            <td class="time_ship">Thứ tư, 9/2/2022</td>
                                        </tr>
                                        <tr>
                                            <td>Ghi chú yêu cầu</td>
                                            <td class="text_ship">Chỉ giao hàng giờ hành chính</td>
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
                            <div class="product-cart cart-shadow">
                                <div class="product-cart__img"><img
                                        src="https://fptshop.com.vn/Uploads/Originals/2020/10/14/637382725406081030_ip-12-pro-max-vang-1.png"
                                        alt="Demo"></div>
                                <div class="product-cart__info">
                                    <div class="product-cart__inside">
                                        <h3 class="product-cart__name product-cart__name--lg name-product-split"
                                            data-sku="00714499" data-color="Vàng">iPhone 12 Pro Max 128GB </h3>
                                        <div class="product-cart__line"></div>
                                    </div>
                                    <div class="product-cart__quality">
                                        <div class="product-cart__quality__wrap"><span>1</span></div>
                                    </div>
                                    <div class="product-cart__price">
                                        <div class="cs-price cs-price--main">30.999.000₫</div>
                                        <div class="cs-price cs-price--sub" style="text-decoration: line-through">
                                            32.999.000₫</div>
                                        <div class="fst-cart-tag m-t-4"><a
                                                class="badge badge-default badge-xxxs fst-cart-badge m-r-4"
                                                href="#"><i class="ic-tag m-r-4"></i><span>MACBOOK16</span></a>
                                            <div class="cs-price cs-price--main f-w-500">-1.500.000₫</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-cart__success-pay m-t-16">
                                <div class="text--lg success-pay-title"><a class="link link-ic" href=""><i
                                            class="ic-edit"></i>
                                        Chỉnh sửa đơn hàng</a>
                                    <div class="group-number"><span class="text-size--lg p-r-24">Cần thanh toán:</span><span
                                            class="re-price f-w-500 f-s-p-16 re-red">30.999.000đ</span></div>
                                </div>
                            </div>
                        </div> --}}
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

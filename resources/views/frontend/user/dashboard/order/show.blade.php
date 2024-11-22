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
                                                                @elseif($order->status == 'processed')
                                                                    <span class="badge bg-warning text-dark"> Đã xử lí
                                                                    </span>
                                                                @elseif($order->status == 'delivered')
                                                                    <span class="badge bg-warning text-dark"> Đã giao hàng
                                                                    </span>
                                                                @elseif($order->status == 'canceled')
                                                                    <span class="badge bg-danger text-white"> Đã hủy đơn
                                                                        hàng
                                                                    </span>
                                                                @elseif($order->status == 'completed')
                                                                    <span class="badge bg-success text-white"> Đã hoàn thành
                                                                    </span>
                                                                @endif
                                                            </h6>
                                                            <h6 style = "font-size: 16px;">Phương thức thanh toán:
                                                                @if ($order->payment_method == 'cod')
                                                                    <span class="badge bg-warning text-dark">Thanh toán khi
                                                                        nhận hàng</span>
                                                                @else
                                                                    <span class="badge bg-warning text-dark">Thanh toán qua
                                                                        thẻ</span>
                                                                @endif
                                                                    </h6>
                                                            </p>

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

                                                            <th class="quantity">
                                                                số lượng
                                                            </th>


                                                            <th class="total">
                                                                Tiền thanh toán
                                                            </th>
                                                            @if ($order->status == 'completed')
                                                                <th class="rating">
                                                                    Đánh giá
                                                                </th>
                                                            @endif

                                                        </tr>
                                                        @foreach ($order->orderDetails as $orderDetail)
                                                            <tr>
                                                                <td class="name">
                                                                    <p>{{ $orderDetail->variantColors->variant->product->name }}
                                                                        -
                                                                        {{ $orderDetail->variantColors->variant->storage->GB }}
                                                                        -
                                                                        {{ $orderDetail->variantColors->color->name }}
                                                                    </p>

                                                                </td>
                                                                <td class="amount">
                                                                    {{ number_format($order->total_amount / $orderDetail->quantity, '0', '.') }}
                                                                    đ
                                                                </td>

                                                                <td class="quantity" style="margin-left: 40px;">
                                                                    {{ $orderDetail->quantity }}
                                                                </td>

                                                                <td class="total" style="    margin-left: 35px;">
                                                                    {{ number_format($order->total_amount, '0', '.') }} đ

                                                                </td>
                                                                @if ($order->status == 'completed')
                                                                    <td data-orderdetail-id="{{ $orderDetail->id }}"
                                                                        class="rating-button">
                                                                        @if (in_array($orderDetail->id, $arrayOrderDetailIdInRating))
                                                                            <!-- Nếu đã được đánh giá -->
                                                                            <button class="rating-btn rated" disabled>Đã
                                                                                đánh giá</button>
                                                                        @else
                                                                            <!-- Nếu chưa được đánh giá -->
                                                                            <button class="rating-btn">Đánh giá</button>
                                                                        @endif
                                                                    </td>
                                                                @endif


                                                            </tr>
                                                            @if ($order->status == 'completed')
                                                                <!-- Modal -->
                                                                <div data-orderdetail-id="{{ $orderDetail->id }}"
                                                                    id="rating-modal" class="rating-modal">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <div class="product-info">
                                                                                <img src="{{ asset($orderDetail->variantColors->variant->product->image) }}"
                                                                                    alt="Product" class="product-img">
                                                                                <span
                                                                                    class="product-name">{{ $orderDetail->variantColors->variant->product->name }}
                                                                                    -
                                                                                    {{ $orderDetail->variantColors->variant->storage->GB }}
                                                                                    -
                                                                                    {{ $orderDetail->variantColors->color->name }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="star-rating">
                                                                                <div class="custom-ratingstar">
                                                                                    <div>Đánh giá: </div>
                                                                                    <div class="stars">
                                                                                        <span class="star"
                                                                                            data-rating="1">★</span>
                                                                                        <span class="star"
                                                                                            data-rating="2">★</span>
                                                                                        <span class="star"
                                                                                            data-rating="3">★</span>
                                                                                        <span class="star"
                                                                                            data-rating="4">★</span>
                                                                                        <span class="star"
                                                                                            data-rating="5">★</span>
                                                                                    </div>
                                                                                    <div class="rating-label"></div>
                                                                                </div>
                                                                            </div>

                                                                            <textarea id="review-text" placeholder="Nhập nội dung đánh giá..."></textarea>
                                                                            <div class="upload-btn">
                                                                                <input type="file"
                                                                                    id="file-upload{{ $orderDetail->id }}"
                                                                                    multiple>
                                                                                <label
                                                                                    for="file-upload{{ $orderDetail->id }}">Tải
                                                                                    ảnh lên</label>
                                                                                <div id="uploaded-images"
                                                                                    class="uploaded-images"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn cancel-btn"
                                                                                onclick="closeModal()">Hủy</button>
                                                                            <button
                                                                                data-orderdetail-id="{{ $orderDetail->id }}"
                                                                                data-product-id="{{ $orderDetail->variantColors->variant->product->id }}"
                                                                                class="btn submit-btn">Đánh giá</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">
                                            {{-- <p><span>Sub Total:</span>{{@$order->sub_total}}</p> --}}
                                            {{-- <p><span>Shipping Fee(+):</span>{{ @$settings->currency_icon }} {{@$shipping->cost}} </p> --}}
                                            </span></p>
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


        $(document).ready(function() {
            const stars = $('.star-rating .star');
            const ratingTexts = ["Rất Tệ", "Tệ", "Ổn", "Tốt", "Rất Tốt"];
            let selectedRating = 0;

            // Đặt sự kiện khi nhấn vào nút "Đánh giá" mở modal
            $('.rating-btn').on('click', function() {
                const orderDetailId = $(this).closest('td').data('orderdetail-id');
                $(`div[data-orderdetail-id="${orderDetailId}"].rating-modal`).css('display', 'flex');
            });

            // Đóng modal khi nhấn nút Hủy hoặc bên ngoài modal
            $('.cancel-btn').on('click', function() {
                $(this).closest('.rating-modal').css('display', 'none');
            });

            $(window).on('click', function(event) {
                if ($(event.target).hasClass('rating-modal')) {
                    $(event.target).css('display', 'none');
                }
            });

            // Xử lý sự kiện hover trên ngôi sao
            $(document).on('mouseover', '.stars .star', function() {
                const index = $(this).data('rating') - 1;
                const stars = $(this).parent().children('.star'); // Chọn các ngôi sao trong cùng modal
                $(this).parent().next('.rating-label').text(ratingTexts[index]);

                stars.each(function(i) {
                    $(this).toggleClass('active', i <= index);
                });
            });

            // Xử lý sự kiện mouseout khi chuột ra khỏi các ngôi sao
            $(document).on('mouseout', '.stars .star', function() {
                const stars = $(this).parent().children('.star');
                stars.each(function(i) {
                    $(this).toggleClass('active', i < selectedRating);
                });
                $(this).parent().next('.rating-label').text(selectedRating ? ratingTexts[selectedRating -
                    1] : '');
            });

            // Xử lý sự kiện click để chọn mức sao đánh giá
            $(document).on('click', '.stars .star', function() {
                selectedRating = $(this).data('rating');
                const stars = $(this).parent().children('.star');
                $(this).parent().next('.rating-label').text(ratingTexts[selectedRating - 1]);

                stars.each(function(i) {
                    $(this).toggleClass('selected', i < selectedRating);
                });
            });
            // Xử lý sự kiện upload ảnh
            $(document).on('change', '[id^="file-upload"]', function(e) {
                const orderDetailId = $(this).attr('id').replace('file-upload',
                ''); // Lấy orderdetail-id từ id của file-upload
                const uploadedImagesContainer = $('#rating-modal[data-orderdetail-id="' + orderDetailId +
                    '"] .uploaded-images'); // Tìm đúng modal theo orderdetail-id

                uploadedImagesContainer.empty(); // Xóa các ảnh cũ

                const files = e.target.files;

                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const image = $('<img>').attr('src', event.target.result);
                        uploadedImagesContainer.append(image); // Thêm ảnh vào đúng modal
                    };
                    reader.readAsDataURL(file);
                });
            });

        });

        $('body').on('click', '.submit-btn', function(event) {
            event.preventDefault();

            let orderDetailId = $(this).data('orderdetail-id');
            let productId = $(this).data('product-id');
            let content = $('#rating-modal[data-orderdetail-id="' + orderDetailId + '"] #review-text').val();

            // Lấy số sao đánh giá
            let point = $('#rating-modal[data-orderdetail-id="' + orderDetailId + '"] .stars .star.selected')
            .length;

            let ratingImages = $('#rating-modal[data-orderdetail-id="' + orderDetailId + '"] #file-upload' +
                orderDetailId)[0].files;


            Swal.fire({
                title: 'Bạn có chắc muốn đánh giá sản phẩm này?',
                text: "Đánh giá của bạn sẽ được gửi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('pro_id', productId);
                    formData.append('orderdetail_id', orderDetailId);
                    formData.append('content', content);
                    formData.append('point', point);

                    // Thêm từng file ảnh vào FormData
                    for (let i = 0; i < ratingImages.length; i++) {
                        formData.append('ratingImages[]', ratingImages[i]);
                    }

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('user.rating') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire('Đã đánh giá!', response.message, 'success');
                                // Thay đổi button thành "Đã đánh giá" và thêm class
                                $('td[data-orderdetail-id="' + orderDetailId + '"] .rating-btn')
                                    .removeClass('rating-btn')
                                    .addClass('rating-btn rated')
                                    .attr('disabled', true)
                                    .text('Đã đánh giá');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire('Lỗi', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Lỗi', 'Có lỗi xảy ra khi gửi đánh giá', 'error');
                        }
                    });
                }
            });
        });

        // Đoạn mã chọn số sao đánh giá
        $('.star').on('click', function() {
            $(this).siblings().removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');
        });
    </script>
@endpush

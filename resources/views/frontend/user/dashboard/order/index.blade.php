@extends('frontend.user.dashboard.layouts.master')

@section('title')
    Product
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
                        <h3><i class="far fa-user"></i>Đơn Hàng</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Hủy Đơn Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cancelOrderForm">
                        <div class="form-group">
                            <label for="cancelReason">Lý do hủy:</label>
                            <select class="form-control" id="cancelReason" required>
                                <option value="" disabled selected>Chọn lý do</option>
                                <option value="Không cần thiết nữa">Không cần thiết nữa</option>
                                <option value="Giá cao">Giá cao</option>
                                <option value="Thay đổi ý định">Thay đổi ý định</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <input type="hidden" id="orderIdToCancel">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmCancelOrder">Xác nhận hủy</button>
                </div>
            </div>
        </div>
    </div>

    <!--=============================
                    DASHBOARD START
                  ==============================-->
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}



    <script>
        $(document).ready(function() {
            $('body').on('click', '.cancel-order', function() {
                let orderId = $(this).data('id'); // Lấy ID đơn hàng
                $('#orderIdToCancel').val(orderId); // Gắn ID vào input hidden trong modal
                $('#cancelOrderModal').modal('show'); // Hiển thị modal
            });

            // Khi nhấn nút "Xác nhận hủy"
            $('#confirmCancelOrder').on('click', function() {
                const orderId = $('#orderIdToCancel').val(); // Lấy ID từ input hidden
                const reason = $('#cancelReason').val(); // Lấy lý do hủy

                if (!reason) {
                    toastr.error('Vui lòng chọn lý do hủy!');
                    return;
                }

                $.ajax({
                    url: "{{ route('user.order.cancel') }}", // Route xử lý hủy
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: orderId,
                        reason: reason
                    },
                    success: function(data) {
                        
                        $('#cancelOrderModal').modal('hide'); // Ẩn modal
                        window.location.reload();
                        toastr.success(data.message);

                    },
                    error: function(xhr, status, error) {
                        toastr.error('Đã xảy ra lỗi. Vui lòng thử lại.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush

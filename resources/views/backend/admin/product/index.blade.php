@extends('backend.admin.layouts.master')


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Product</h3>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product.create') }}" class="btn btn-dark"><i class="fas fa-plus"></i>
                                    Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.product.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })

            })
        })
    </script>

    {{-- <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                // Bắt sự kiện click vào nút báo cáo
                $('.warningcm').click(function(e) {
                    // e.preventDefault();
                    var id = $(this).data('comment-id'); // Lấy giá trị của data-comment-id
                    console.log(id);

                    // Hiển thị cửa sổ xác nhận
                    if (confirm('Bạn có muốn báo cáo bình luận này không?')) {
                        // Gửi yêu cầu Ajax
                        $.ajax({
                            url: "{{ route('comments.change-status') }}",
                            method: 'PUT',
                            data: {
                                id: id,

                            },
                            success: function(data) {
                                console.log(data);
                            },
                            error: function(xhr, status, error) {
                                alert('Đã xảy ra lỗi: ' + error);
                            }
                        });
                    }
                });
            });
        });
    </script> --}}
@endpush

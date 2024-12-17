@extends('backend.admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tất cả phiếu giảm giá</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4></h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.admincoupon.create') }}" class="btn btn-dark"><i
                                        class="fas fa-plus"></i> Create New</a>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.change-status', function() {

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.change-status-coupon') }}",
                    type: "PUT",
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        if (data.status) {
                            toastr.success(data.message)
                        } else {
                            toastr.error(data.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })

        });
    </script>
@endpush

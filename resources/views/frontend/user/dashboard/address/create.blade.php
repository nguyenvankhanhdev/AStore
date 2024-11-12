@extends('frontend.user.dashboard.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.user.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fal fa-gift-card"></i>tạo địa chỉ</h3>
                        <div class="wsus__dashboard_add wsus__add_address">
                            <form action="{{ route('user.address.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>tên <b>*</b></label>
                                            <input type="text" placeholder="Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>email</label>
                                            <input type="email" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>điện thoại <b>*</b></label>
                                            <input type="text" placeholder="Phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Tỉnh/Thành Phố <b>*</b></label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="province">
                                                    <option>Select</option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->name }}" data-id="{{ $province->id }}">
                                                            {{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Xã/Phường<b>*</b></label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="ward">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Huyện/Quận <b>*</b></label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="district">
                                                    <option>Select</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Đường <b>*</b></label>
                                            <input type="text" placeholder="Address" name="address">
                                        </div>
                                    </div>
                                    <div class="col-xl-6" style="margin-top: 37px;">
                                        <button type="submit" class="common_btn">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('select[name="province"]').on('change', function() {
                let province_id = $(this).find(':selected').data('id')
                if (province_id) {
                    $.ajax({
                        url: `/get-districts/${province_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="district"]').empty().append(
                                '<option>Select</option>');
                            $('select[name="ward"]').empty().append('<option>Select</option>');
                            $.each(data, function(key, district) {
                                $('select[name="district"]').append(
                                    `<option value="${district.name}" data-id="${district.id}">${district.name}</option>`
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="district"]').empty().append('<option>Select</option>');
                    $('select[name="ward"]').empty().append('<option>Select</option>');
                }
            });

            $('select[name="district"]').on('change', function() {
                let district_id = $(this).find(':selected').data('id');
                if (district_id) {
                    $.ajax({
                        url: `/get-wards/${district_id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="ward"]').empty().append('<option>Select</option>');
                            $.each(data, function(key, ward) {
                                $('select[name="ward"]').append(
                                    `<option value="${ward.name}">${ward.name}</option>`
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="ward"]').empty().append('<option>Select</option>');
                }
            });
        });
    </script>
@endpush

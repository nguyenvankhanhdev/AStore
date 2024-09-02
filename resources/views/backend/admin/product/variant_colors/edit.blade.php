@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Variant Colors</h4>
                        </div>
                        <div class="card-body">
                            <form id="variantColorsForm" action="{{ route('admin.variant-colors.update',$variantColor->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">Colors</label>
                                    <select id="inputState" class="form-control main-category" name="colors">
                                        <option value="">Select</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}" {{ $variantColor->color_id == $color->id ? 'selected' : '' }}>{{ $color->color }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="colorError"></span>
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" min="0" class="form-control" name="quantity" value="{{ $variantColor->quantity }}">
                                    <span class="text-danger" id="quantityError"></span>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" min="0" class="form-control" name="price" value="{{ $variantColor->price }}">
                                    <span class="text-danger" id="priceError"></span>
                                </div>

                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="number" min="0" class="form-control" name="offer_price" value="{{ $variantColor->offer_price }}">
                                    <span class="text-danger" id="offerPriceError"></span>
                                </div>
                                <input type="hidden" name="variants" value="{{ $variantColor->quantity }}">
                                <button type="submit" class="btn btn-primary">Update</button>
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
        $('#variantColorsForm').on('submit', function(event) {
            let isValid = true;
            $('.text-danger').text('');
            if ($('#inputState').val() === '') {
                $('#colorError').text('Please select a color.');
                isValid = false;
            }
            if ($('input[name="quantity"]').val() === '') {
                $('#quantityError').text('Please enter a quantity.');
                isValid = false;
            }
            if ($('input[name="price"]').val() === '') {
                $('#priceError').text('Please enter a price.');
                isValid = false;
            }
            if ($('input[name="offer_price"]').val() === '') {
                $('#offerPriceError').text('Please enter an offer price.');
                isValid = false;
            }
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>
@endpush

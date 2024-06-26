@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product Variant</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-variant.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="int" class="form-control" name="quantity"
                                        value="{{ old('quantity') }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Color</label>
                                            <select id="inputState" class="form-control main-category" name="color">
                                                <option value="">Select</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->color }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Color</label>
                                            <select id="inputState" class="form-control main-category" name="storage">
                                                <option value="">Select</option>
                                                @foreach ($storages as $storage)
                                                    <option value="{{ $storage->id }}">{{ $storage->GB }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                                <input type="hidden" name="product" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" class="form-control" name="offer_price"
                                        value="{{ old('offer_price') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
@endpush

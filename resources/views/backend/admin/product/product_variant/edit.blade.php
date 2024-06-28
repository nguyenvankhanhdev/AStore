@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product Variant</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-variant.update', $variant->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" name="quantity" value="{{ $variant->quantity }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="color">Color</label>
                                            <select id="color" class="form-control" name="color">
                                                <option value="">Select</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}" {{ $variant->color_id == $color->id ? 'selected' : '' }}>
                                                        {{ $color->color }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="storage">Storage</label>
                                            <select id="storage" class="form-control" name="storage">
                                                <option value="">Select</option>
                                                @foreach ($storages as $storage)
                                                    <option value="{{ $storage->id }}" {{ $variant->storage_id == $storage->id ? 'selected' : '' }}>
                                                        {{ $storage->GB }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ $variant->price }}">
                                </div>
                                <input type="hidden" name="product" value="{{ $variant->pro_id }}">
                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" class="form-control" name="offer_price" value="{{ $variant->offer_price }}">
                                </div>
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
@endpush

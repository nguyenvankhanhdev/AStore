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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputState">Storage</label>
                                            <select id="inputState" class="form-control main-category" name="storage">
                                                <option value="">Select</option>
                                                @foreach ($storages as $storage)
                                                    <option value="{{ $storage->id }}">{{ $storage->GB }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="product" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

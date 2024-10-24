@extends('backend.admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Color Variant</h1>
        </div>
        <div class="mb-3">
            <a href="{{ route('admin.products-variant.index', ['product' => $products->id]) }}"
                class="btn btn-primary">Back</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                                <h4>Product: {{ $products->name . ' - ' . $variants->storage->GB }}</h4>
                            </div>
                            <div class="card-header-action">
                                <a href="{{ route('admin.variant-colors.create', ['variants' => $variants->id]) }}"
                                    class="btn btn-dark"><i class="fas fa-plus"></i> Create New</a>
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
@endpush

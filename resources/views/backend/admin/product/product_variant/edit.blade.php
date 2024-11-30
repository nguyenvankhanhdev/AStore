@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products-variant.update', $variant->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="storage">GB</label>
                                            <select id="storage" class="form-control" name="storage">
                                                <option value="">GB</option>
                                                @foreach ($storages as $storage)
                                                    <option value="{{ $storage->id }}" {{ $variant->storage_id == $storage->id ? 'selected' : '' }}>
                                                        {{ $storage->GB }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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

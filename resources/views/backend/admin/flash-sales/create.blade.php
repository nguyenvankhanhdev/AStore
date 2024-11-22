@extends('backend.admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Flash Sale</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Sale Start Date</label>
                                    <input type="text" class="form-control datepicker" name="start_date" value="">
                                </div>
                                <div class="form-group">
                                    <label>Sale End Date</label>
                                    <input type="text" class="form-control datepicker" name="end_date" value="">
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>

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

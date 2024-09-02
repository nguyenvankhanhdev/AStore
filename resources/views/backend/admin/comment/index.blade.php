@extends('backend.admin.layouts.master')

@section('content')
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>All Reported Comments</h3>
                    <div class="card-header-action">
                        
                    </div>
                  </div>
                  <div class="card-body">
                    {{ $dataTable->table()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush

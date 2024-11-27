@extends('backend.admin.layouts.master')
@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Đơn hàng hoàn thành</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tât cả đơn hàng hoàn thành</h4>
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

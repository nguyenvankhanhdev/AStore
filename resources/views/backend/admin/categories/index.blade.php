@extends('backend.admin.layouts.master')


@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Category</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Categories</h4>
                    <div class="card-header-action">
                        <a href="{{route('categories.create')}}" class="btn btn-dark"><i class="fas fa-plus"></i> Create New</a>
                    </div>
                  </div>
                  <div class="card-body">

                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

@extends('backend.admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Category</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.categories.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <button type="submmit" class="btn btn-dark">Create</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection


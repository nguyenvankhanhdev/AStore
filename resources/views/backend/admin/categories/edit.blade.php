@extends('backend.admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Category</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.categories.update', $categories->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$categories->name}}">
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

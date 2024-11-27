@extends('backend.admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Liên kết sản phẩm</h1>
        </div>
        <div class="mb-3">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Trở về</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Những danh mục sản phẩm con đã liên kết:</h4>
                            @foreach ($subcategory as $sub)
                                @if ($accessories->contains('sub_cate_id', $sub->id))
                                    <form action="{{ route('admin.product-support.destroy') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                        <input type="hidden" name="subcate_id" value="{{ $sub->id }}">
                                        <span style="margin-right:10px" class="badge bg-light text-dark rounded-pill">
                                            {{ $sub->name }}
                                            <button type="submit" class="btn btn-link p-0 text-dark" style="font-size: 14px; margin-left: 5px; display: inline;" aria-label="Remove" onmouseover="this.style.backgroundColor='transparent'" onmouseout="this.style.backgroundColor='transparent'">
                                                <i style="margin-bottom:10px" class="fas fa-times"></i> <!-- Biểu tượng dấu X -->
                                            </button>

                                        </span>

                                    </form>

                                @endif
                            @endforeach
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-support.store') }}" method="POST">
                                @csrf
                                <div class="input-group">

                                    <select class="form-control main-category " name="subcate_id" required>

                                        <option value="" disabled selected>Chọn Subcategory</option>
                                        @foreach ($subcategory as $sub)
                                            @if (!$accessories->contains('sub_cate_id', $sub->id))
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p style="margin: 0 10px;"></p>
                                    <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary rounded-pill text-white">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </section>
@endsection

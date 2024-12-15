@extends('frontend.user.layouts.master')

@section('content')
    <div class="detail">
        <div class="detail__header lg-detail-header">
            <div class="temp">
                <picture data-src="https://via.placeholder.com/1x1/f3f3f3"><img src="https://via.placeholder.com/1x1/f3f3f3">
                </picture>
            </div>
            <div class="detail__breadcrumb">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="link" href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a class="link"
                                href="{{ route('products.category', ['categories' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
            <div class="detail__gallery">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="slider-gallery">
                                <div class="slider-gallery__main">
                                    <div class="swiper gallery-main js-open-next">
                                        <div class="swiper-wrapper js-gallery">
                                            @foreach ($product->productImages as $image)
                                                <div class="swiper-slide" data-src="{{ asset($image->image) }}">
                                                    <picture><img src="{{ asset($image->image) }}"
                                                            alt="MacBook Pro 16” 2021 M1 Pro"></picture>
                                                </div>
                                            @endforeach
                                            <div class="view-gallery js-open-gallery" data-count="+12"><img
                                                    src="https://via.placeholder.com/96x96" alt=""></div>
                                        </div><!-- Add Arrows-->
                                        <div class="swiper-button-next ic-angle-right swiper-button"></div>
                                        <div class="swiper-button-prev ic-angle-left swiper-button"></div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                                <div class="slider-gallery__thumb">
                                    <div class="swiper gallery-thumbs">
                                        <div class="swiper-wrapper">
                                            @foreach ($product->productImages as $image)
                                                <div class="swiper-slide active">
                                                    <span>
                                                        <img src="{{ asset($image->image) }}" alt="">
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- <div class="view-gallery js-open-gallery" data-count="+12"><img
                                            src="https://via.placeholder.com/96x96" alt=""></div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="wrapper">
                                <h1 class="h1 name product_name" data-initial-name="{{ $product->name }}">
                                    {{ $product->name }}</h1>
                                <div class="npi-special">
                                    <div class="product-price-left npi-special-price js-control-item active">
                                        <div class="npi-special-inner">
                                            <div class="npi-special-caption">
                                                <div class="npi-special-caption-icon"><img
                                                        src="/frontend/asset/img/fxemoji_star.svg" alt="fxemoji_star"></div>
                                                <div class="npi-special-caption-label">Giá phiên bản 1 Đổi 1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="npi-border">
                                    <div class="price">
                                        <div class="boxprice"><span class="text text-primary price-sale"
                                                style="color: #ae172b"></span>
                                            <strike class="text-promo p-l-8 f-s-p-24 f-w-400"></strike>
                                            <span class="txtpricemarketPhanTram badge badge-danger persent-special"
                                                style="">-12%</span>
                                        </div>
                                    </div>
                                    <div id="variant-selector" class="types js-select">
                                        @foreach ($product->variants as $variant)
                                            <a class="item {{ $variant->id == $selectedVariantId ? 'active' : '' }}"
                                                data-id="{{ $variant->id }}">
                                                <div class="radio" name="variant">
                                                    <input type="radio" name="storage" value="{{ $variant->id }}"
                                                        {{ $variant->id == $selectedVariantId ? 'checked' : '' }}>
                                                    <label>{{ $variant->storage->GB }}</label>
                                                </div>

                                                @if ($variant->variantColors->first())
                                                    <p class="price-variant">
                                                        {{ number_format($variant->variantColors->first()->price - $variant->variantColors->first()->offer_price, 0, ',', '.') }}₫
                                                    </p>
                                                @else
                                                    <p>Không có giá</p>
                                                @endif
                                            </a>
                                        @endforeach

                                    </div>

                                    <div style="margin: 10px 0;">
                                        <span style="font-size: 18px; font-weight:600;">
                                            Màu sắc
                                        </span>
                                    </div>

                                    <div class="colors js-select">
                                        @foreach ($colors as $index => $color)
                                            @php
                                                $name = App\Models\ColorProduct::find($color->color_id);
                                                $isActive = $index === 0 ? 'active' : '';
                                                if ($isActive === 'active') {
                                                    $selectedColorId = $name->id;
                                                }
                                            @endphp
                                            @switch($name->name)
                                                @case('Xanh da trời')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#51b3f0"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Đen')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#232A31"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Đỏ')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#FB1634"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Xanh lá')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#77ff82"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Trắng')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#FAF7F2"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Vàng hồng')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#ffe194"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Xám')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#B2C5D6"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Bạc')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#B2C5D6"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Xanh dương')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#51b3f0"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Xanh dương đậm')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#106294"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Xám không gian')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#6c93ab"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Hồng')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#ffbfe4"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Tím')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#bb2bf8"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @case('Ánh sao')
                                                    <div class="item {{ $isActive }}" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#d6d6d6"></span>
                                                        <div>{{ $name->name }}</div>
                                                    </div>
                                                @break

                                                @default
                                                    <div class="item" data-color-id="{{ $name->id }}">
                                                        <span style="background-color:#FFFFFF"></span> <!-- Màu mặc định -->
                                                        <div>Không xác định</div>
                                                    </div>
                                            @endswitch
                                        @endforeach
                                    </div>

                                    <div style="margin: 10px 0;">
                                        <span style="font-size: 18px; font-weight:600;">
                                            Mua ngay hoặc yêu thích
                                        </span>
                                    </div>
                                    <div class="pre-order">
                                        <div class="btn btn-link btn-xl" id="add-to-cart-form">
                                            <div><i class="ic-cart"></i> THÊM GIỎ HÀNG</div>
                                        </div>
                                        <div class="btn btn-link btn-danger btn-xl" id="add-to-wishlist"
                                            data-product-id="{{ $product->id }}" data-variant-id="" data-color-id="">
                                            <div> <i class="fa fa-heart"></i> YÊU THÍCH</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail__bottom">
                    <div class="detail__comments">
                        <div class="fpt-comment">
                            <div class="container">
                                <div class="card card-md user-feedback">
                                    <div class="review-container">
                                        <h3 cla>
                                            Đánh giá sản phẩm: {{ $product->name }}
                                            @if ($product->point == 0 || $product->point < 0.1)
                                                <span class="inline-stars">
                                                    <span class="star">☆</span>
                                                    <span class="star">☆</span>
                                                    <span class="star">☆</span>
                                                    <span class="star">☆</span>
                                                    <span class="star">☆</span>
                                                </span>
                                                <span class="rating-score">(0.0/5.0)</span>
                                            @else
                                                <span class="inline-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($product->point >= $i)
                                                            <span class="star full">★</span> <!-- Sao sáng đầy đủ -->
                                                        @elseif($product->point >= $i - 0.5)
                                                            <span class="star half">★</span> <!-- Sao sáng nửa -->
                                                        @else
                                                            <span class="star empty">★</span> <!-- Sao chưa sáng -->
                                                        @endif
                                                    @endfor
                                                </span>
                                                <span
                                                    class="rating-score">({{ number_format($product->point, 1) }}/5.0)</span>
                                                <button class="btn view-reviews-btn">
                                                    Xem các đánh giá
                                                </button>
                                            @endif

                                        </h3>

                                        <!-- Modal -->
                                        <div class="modal-review" id="reviewsModal">
                                            <div class="modal-content-review">
                                                <div class="modal-header-review">
                                                    <h3>Đánh giá sản phẩm</h3>
                                                </div>
                                                <div class="modal-body-review">
                                                    @foreach ($ratingOfProduct as $rating)
                                                        <div class="modal-line-review">
                                                            <div class="info-user">
                                                                <div class="user-image">
                                                                    @if ($rating->user->image == null)
                                                                        <img src="{{ asset('uploads/anhdaidien.png') }}"
                                                                            alt="Review Image" />
                                                                    @else
                                                                        <img src="{{ asset($rating->user->image) }}"
                                                                            alt="Review Image" />
                                                                    @endif

                                                                </div>
                                                                <div class="user-rating">
                                                                    <div class="rating-user">
                                                                        <strong>{{ $rating->user->name }}</strong>
                                                                    </div>
                                                                    <div class="rating-thoughts">
                                                                        <p>{{ $rating->content }}</p>
                                                                    </div>
                                                                    <div class="rating-stars review">
                                                                        <span class="inline-stars">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($rating->point >= $i)
                                                                                    <span class="star full">★</span>
                                                                                    <!-- Sao sáng đầy đủ -->
                                                                                @elseif($rating->point >= $i - 0.5)
                                                                                    <span class="star half">★</span>
                                                                                    <!-- Sao sáng nửa -->
                                                                                @else
                                                                                    <span class="star empty">★</span>
                                                                                    <!-- Sao chưa sáng -->
                                                                                @endif
                                                                            @endfor
                                                                        </span>
                                                                        <span
                                                                            class="rating-score-review">({{ number_format($rating->point, 1) }}/5.0)</span>
                                                                    </div>
                                                                </div>


                                                            </div>


                                                            <div class="image-gallery">
                                                                @foreach ($rating->ratingImages as $image)
                                                                    <img src="{{ asset($image->image) }}"
                                                                        alt="Review Image" />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <!-- Dòng đánh giá 1 -->

                                                    <!-- Các đánh giá khác... -->
                                                </div>
                                                <div class="modal-footer-review">
                                                    <button class="close-btn" onclick="closeModal()">Đóng</button>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="review-content">
                                            <!-- Phần bên trái: Đánh giá bằng sao -->
                                            <div class="star-rating">
                                                <h4>
                                                    Tổng số đánh giá của sản phẩm ( {{ $countRatingProduct }} )
                                                </h4>
                                            </div>

                                            <!-- Dấu gạch thẳng đứng phân cách -->
                                            <div class="divider"></div>

                                            <!-- Phần bên phải: Đánh giá theo số lượng -->
                                            <div class="rating-count">
                                                @foreach ([5, 4, 3, 2, 1] as $star)
                                                    <p>Đánh giá {{ $star }} <span class="count-star">★</span>
                                                        (<span
                                                            class="count-star-{{ $star }}">{{ $ratingsCount[$star] ?? 0 }}</span>)
                                                    </p>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>


                                    <div class="card-title">
                                        <h3 class="h5 heading">Bình luận</h3>
                                        {{-- <div class="form-group">
                                    <div class="form-search form-search-md"><span class="form-search-icon m-r-4"><i
                                                class="ic-search ic-sm"></i></span><input class="form-search-input m-r-8"
                                            type="text" placeholder="Tìm theo nội dung, người gửi..."><span
                                            class="form-search-icon form-search-clear"><i
                                                class="ic-close ic-md"></i></span></div>
                                </div> --}}
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="user-form">
                                                <input type="hidden" name="cmt_id" value="0">
                                                <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                                <div class="flex flex-center-ver m-b-8">
                                                    @if (Auth::check())
                                                        <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận:
                                                            <strong>{{ $user->name }}</strong>
                                                        </div>
                                                    @else

                                                        <div class="text-grayscale-800 f-s-p-16 m-r-8">Người bình luận:
                                                            <strong>Khách</strong>
                                                        </div>

                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="content" class="form-input form-input-lg" rows="3"
                                                        placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                    <button type="submit" class="btn btn-lg btn-primary"
                                                        aria-controls="comment-info" id="commentForm">GỬI BÌNH
                                                        LUẬN</button>
                                                </div>


                                                <span id="contentError" class="text-danger hide">Vui lòng nhập bình luận
                                                    !</span>

                                            </div>
                                        </form>

                                        <div class="user-content">
                                            <div class="result">
                                                <div class="text" style="color: #444b52;"><strong>Những bình luận về
                                                    </strong>“{{ $product->name }}”</div>
                                            </div>
                                            <div id="comments-container" class="user-wrapper">
                                                <div class="user-block">
                                                    @if ($comment->isEmpty())
                                                        <h2>Sản phẩm chưa có bình luận</h2>
                                                    @else
                                                        @foreach ($comment as $cm)
                                                            <div data-timestamp="{{ strtotime($cm->created_at) }}"
                                                                class="avatar avatar-md avatar-text avatar-circle">

                                                                <div class="avatar-shape"><span
                                                                        class="f-s-p-20 f-w-500">TT</span>
                                                                </div>
                                                                <div class="avatar-info">
                                                                    <div class="avatar-name">
                                                                        <div class="text">
                                                                            {{ $cm->user->name }}</div>
                                                                    </div>
                                                                    <div class="avatar-para">
                                                                        <div class="text">{{ $cm->content }}</div>
                                                                    </div>
                                                                    <div class="avatar-time">
                                                                        <div class="text text-grayscale">
                                                                            {{ $cm->created_at->diffForHumans() }}</div><i
                                                                            class="ic-circle-sm"></i>
                                                                        @php
                                                                            $userId = Auth::id(); // Lấy ID của người dùng hiện tại
                                                                        @endphp
                                                                        <div data-comment-id="{{ $cm->id }}"
                                                                            class="link link-xs like-button {{ $cm->isLikedByUser($userId) ? 'liked' : '' }}">
                                                                            ({{ $cm->cmt_likes }})
                                                                            {{ $cm->isLikedByUser($userId) ? 'Bỏ Thích' : 'Thích' }}
                                                                        </div>
                                                                        <i class="ic-circle-sm"></i>
                                                                        <div data-comment-id="{{ $cm->id }}"
                                                                            class="link active_repcm link-xs">Trả lời</div>
                                                                    </div>
                                                                </div>

                                                                @if (Auth::id() == $cm->user_id)
                                                                    <a data-comment-id="{{ $cm->id }}"
                                                                        class='btn editcm btn-dark'><i
                                                                            class='far fa-edit'></i></a>

                                                                    <a data-comment-id="{{ $cm->id }}"
                                                                        href="" class='btn deletecm btn-dark'><i
                                                                            class='far fa-trash-alt'></i></a>
                                                                @else
                                                                    <a data-comment-id="{{ $cm->id }}"
                                                                        name="cm_id" value="{{ $cm->id }}"
                                                                        class='btn warningcm btn-dark'><i
                                                                            class="fas fa-exclamation-triangle"></i></a>
                                                                @endif


                                                            </div>
                                                            <div id="commentForm_{{ $cm->id }}"
                                                                style="display:none;" class="avatar-form form-groupcm">
                                                                <div class="form-group ">

                                                                    <textarea name="editcm" class="form-input form-input-lg" rows="3"
                                                                        placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                                    <a data-comment-id="{{ $cm->id }}"
                                                                        class="btn btneditcm btn-lg btn-primary"
                                                                        aria-controls="comment-info">SỬA BÌNH LUẬN</a>
                                                                </div>
                                                                @if ($errors->has('editcm'))
                                                                    <span id="contentError"
                                                                        class="text-danger">{{ $errors->first('content') }}</span>
                                                                @endif
                                                            </div>
                                                            <div id="repcommentForm_{{ $cm->id }}"
                                                                style="display:none;" class="avatar-form form-groupcm">
                                                                <div class="form-group">
                                                                    <input data-cmt-id="{{ $cm->id }}"
                                                                        type="hidden" name="cmt_id"
                                                                        value="{{ $cm->id }}">
                                                                    <input type="hidden" name="pro_id"
                                                                        value="{{ $product->id }}">
                                                                    <textarea name="repcm" class="form-input form-input-lg" rows="3"
                                                                        placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                                    <a data-comment-id="{{ $cm->id }}"
                                                                        class="btn btnrepcm btn-lg btn-primary"
                                                                        aria-controls="comment-info">GỬI BÌNH LUẬN</a>
                                                                </div>
                                                                @if ($errors->has('repcm'))
                                                                    <span id="contentError"
                                                                        class="text-danger">{{ $errors->first('content') }}</span>
                                                                @endif
                                                            </div>
                                                            <!-- Hiển thị các trả lời -->
                                                            @foreach ($cm->replies as $reply)
                                                                <div class="user-block reply">
                                                                    <div
                                                                        class="avatar avatar-md avatar-text avatar-circle">
                                                                        <div class="avatar-shape"><span
                                                                                class="f-s-p-20 f-w-500">SL</span></div>
                                                                        <div class="avatar-info">
                                                                            <div class="avatar-name">
                                                                                <div class="text">
                                                                                    {{ $reply->user->name }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="avatar-para">
                                                                                <div class="text">{{ $reply->content }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="avatar-time">
                                                                                <div class="text text-grayscale">
                                                                                    {{ $reply->created_at->diffForHumans() }}
                                                                                </div>
                                                                                <i class="ic-circle-sm"></i>
                                                                                @php
                                                                                    $userId = Auth::id(); // Lấy ID của người dùng hiện tại
                                                                                @endphp
                                                                                <div data-comment-id="{{ $reply->id }}"
                                                                                    class="link link-xs like-button {{ $reply->isLikedByUser($userId) ? 'liked' : '' }}">
                                                                                    ({{ $reply->cmt_likes }})
                                                                                    {{ $reply->isLikedByUser($userId) ? 'Bỏ Thích' : 'Thích' }}
                                                                                </div>
                                                                                <i class="ic-circle-sm"></i>
                                                                                <div data-comment-id="{{ $reply->id }}"
                                                                                    class="link active_repcm link-xs">Trả
                                                                                    lời</div>
                                                                            </div>
                                                                            @if (Auth::id() == $reply->user_id)
                                                                                <a data-comment-id="{{ $reply->id }}"
                                                                                    class='btn editrepcm btn-dark'><i
                                                                                        class='far fa-edit'></i></a>
                                                                                <a data-comment-id="{{ $reply->id }}"
                                                                                    class='btn deleterepcm btn-dark'><i
                                                                                        class='far fa-trash-alt'></i></a>
                                                                            @else
                                                                                <a data-comment-id="{{ $reply->id }}"
                                                                                    name="cm_id"
                                                                                    value="{{ $reply->id }}"
                                                                                    class='btn warningrepcm btn-dark'><i
                                                                                        class="fas fa-exclamation-triangle"></i></a>
                                                                            @endif

                                                                        </div>

                                                                        <div style="display:none;"
                                                                            id="commentForm_{{ $reply->id }}"
                                                                            class="avatar-form form-groupcm">
                                                                            <div class="form-group ">
                                                                                <textarea name="editcm" class="form-input form-input-lg" rows="3"
                                                                                    placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                                                <a data-comment-id="{{ $reply->id }}"
                                                                                    class="btn btneditrepcm btn-lg btn-primary"
                                                                                    aria-controls="comment-info">SỬA BÌNH
                                                                                    LUẬN</a>
                                                                            </div>
                                                                        </div>
                                                                        <div style="display:none;"
                                                                            id="repcommentForm_{{ $reply->id }}"
                                                                            class="avatar-form form-groupcm">
                                                                            <div class="form-group ">
                                                                                <input data-cmt-id="{{ $cm->id }}"
                                                                                    type="hidden"
                                                                                    value="{{ $cm->id }}">
                                                                                <input type="hidden" name="pro_id"
                                                                                    value="{{ $product->id }}">
                                                                                <textarea name="repcm" class="form-input form-input-lg" rows="3"
                                                                                    placeholder="Nhập nội dung bình luận (tiếng Việt có dấu)..."></textarea>
                                                                                <a data-comment-id="{{ $reply->id }}"
                                                                                    class="btn btnrepcm btn-lg btn-primary"
                                                                                    aria-controls="comment-info">GỬI BÌNH
                                                                                    LUẬN</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <input type="hidden" id="currentPage" value="1">

                                            <div id="pagination-container">
                                                {{ $comment->links('vendor.pagination.bootstrap-4') }}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @push('scripts')
            <script>
                var selectedColorId = @json($selectedColorId);
                $(document).ready(function() {

                    function formatNumberToVND(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' ₫';
                    }
                    $('#variant-selector').on('click', '.item', function(event) {
                        event.preventDefault();
                        const variantId = $(this).data('id');
                        const url = new URL(window.location.href);
                        url.searchParams.set('variant', variantId);
                        window.location.href = url.toString();
                    });
                    // Định nghĩa colorId và variantId là các biến toàn cục
                    let colorId;
                    let variantId;

                    function fetchPrice(colorId, variantId) {
                        $.ajax({
                            url: "{{ route('getByColor') }}",
                            method: 'GET',
                            data: {
                                color_id: colorId,
                                variant_id: variantId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    const originalPrice = response.price.price;
                                    const storage = response.storage.GB;
                                    const offerPrice = response.price.offer_price;
                                    const discount = originalPrice - offerPrice;
                                    const discountPercentage = (offerPrice / originalPrice) * 100;
                                    const productName = $('.product_name').data('initial-name');
                                    if (storage === "0GB") {
                                        $('.product_name').text(`${productName}`);
                                        $('.text-promo').text(formatNumberToVND(originalPrice));
                                        $('.price-sale').text(formatNumberToVND(discount));
                                        $('.txtpricemarketPhanTram').text(
                                            `Giảm -${Math.round(discountPercentage)}%`);
                                        return;
                                    }
                                    $('#variant-selector .item.active .price-variant').text(discount
                                        .toLocaleString('vi-VN') + ' ₫');
                                    // Display with storage included
                                    $('.product_name').text(`${productName} - ${storage}`);
                                    $('.text-promo').text(formatNumberToVND(originalPrice));
                                    $('.price-sale').text(formatNumberToVND(discount));
                                    $('.txtpricemarketPhanTram').text(
                                        `Giảm -${Math.round(discountPercentage)}%`);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    }

                    function updateVariantAndFetchPrice() {
                        colorId = $('.colors .item.active').data('color-id');
                        variantId = $('#variant-selector .item.active').data('id');
                        if (colorId && variantId) {
                            fetchPrice(colorId, variantId);
                        }
                    }

                    // Initial load
                    updateVariantAndFetchPrice();

                    // Event handler for color selection
                    $('.colors .item').on('click', function() {
                        $('.colors .item.active').removeClass('active');
                        $(this).addClass('active');
                        updateVariantAndFetchPrice();
                    });

                    // Event handler for variant selection
                    $('#variant-selector .item').on('click', function() {
                        $('#variant-selector .item.active').removeClass('active');
                        $(this).addClass('active');
                        updateVariantAndFetchPrice();
                    });

                    if ($('#variant-selector .item.active label').text().trim() === "0GB") {
                        $('#variant-selector .item.active').hide();
                    }

                    // Thêm vào giỏ hàng
                    $('#add-to-cart-form').on('click', function(e) {
                        e.preventDefault();

                        // Kiểm tra lại colorId và variantId khi nhấn vào giỏ hàng
                        colorId = $('.colors .item.active').data('color-id');
                        variantId = $('#variant-selector .item.active').data('id');

                        if (colorId && variantId) {
                            $.ajax({
                                url: "{{ route('cart.add') }}",
                                method: 'POST',
                                data: {
                                    color_id: colorId,
                                    variant_id: variantId,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        toastr.success(response.message);
                                    } else {
                                        toastr.error(response.message);
                                    }
                                },
                                error: function(response) {
                                    if (response.status === 'error') {
                                        toastr.error(response.message);
                                    }
                                }
                            });
                        } else {
                            console.error("Color ID hoặc Variant ID không hợp lệ.");
                        }
                    });

                    $('#commentForm').on('click', function(e) {
                        e.preventDefault();
                        var form = $(this).closest('form');
                        var cmt_id = form.find('input[name="cmt_id"]').val();
                        var content = form.find('textarea[name="content"]').val();
                        var pro_id = form.find('input[name="pro_id"]').val();
                        var contentError = form.find('#contentError');
                        if (content === '') {
                            toastr.error('Vui lòng nhập nội dung bình luận!');
                            contentError.removeClass('hide');
                            return;
                        }
                        $.ajax({
                            url: '{{ route('comments.store') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                cmt_id: cmt_id,
                                content: content,
                                pro_id: pro_id,
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                    toastr.success(response.message);
                                    contentError.addClass('hide');

                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(response) {
                                toastr.error('Đã xảy ra lỗi, vui lòng thử lại!');
                            }
                        });
                    });





                });

                $('#add-to-wishlist').on('click', function(e) {
                    e.preventDefault();

                    const productId = $(this).data('product-id');
                    const variantId = $('#variant-selector .item.active').data('id'); // Lấy ID biến thể
                    const colorId = $('.colors .item.active').data('color-id'); // Lấy ID màu sắc

                    // Kiểm tra nếu chưa chọn biến thể hoặc màu sắc
                    if (!variantId || !colorId) {
                        toastr.error("Vui lòng chọn màu sắc và biến thể sản phẩm!");
                        return;
                    }

                    // Gửi AJAX để lấy variantColorId


                    $.ajax({
                        url: "{{ route('get.variantColorId') }}", // Route tới backend
                        method: 'GET',
                        data: {
                            variant_id: variantId,
                            color_id: colorId,
                            _token: '{{ csrf_token() }}',
                        },

                        success: function(response) {
                            if (response.status === 'success') {
                                const variantColorId = response.variant_color_id;

                                console.log("variantColorId:", variantColorId);
                                console.log("CSRF Token:", $('meta[name="csrf-token"]').attr('content'));
                                // Gửi thêm AJAX để thêm vào wishlist
                                $.ajax({
                                    url: "{{ route('wishlist.add') }}", // Route thêm vào wishlist
                                    method: 'POST',
                                    data: {
                                        pro_id: productId,
                                        variant_color_id: variantColorId,
                                        _token: '{{ csrf_token() }}',
                                    },
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            toastr.success(response.message);
                                        } else {
                                            toastr.error(response.message);
                                        }
                                    },
                                    error: function(error) {

                                        toastr.error(error.responseJSON.message ||
                                            "Đã xảy ra lỗi khi thêm vào yêu thích! Vui lòng thử lại.");
                                    }
                                });

                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON.message ||
                                "Không tìm thấy thông tin sản phẩm! Vui lòng thử lại.");
                        }
                    });
                });
            </script>


            <script>
                $(document).ready(function() {
                    // Bắt sự kiện click vào nút chỉnh sửa (editcm)
                    $('.active_repcm').click(function(e) {
                        e.preventDefault(); // Ngăn chặn hành động mặc định của nút

                        var commentId = $(this).data('comment-id'); // Lấy giá trị của data-comment-id
                        var commentForm = $('#repcommentForm_' + commentId);

                        // Kiểm tra trạng thái hiển thị của commentForm
                        if (commentForm.is(':visible')) {
                            commentForm.hide(); // Nếu đang hiển thị thì ẩn đi
                        } else {
                            $('.form-groupcm').hide(); // Ẩn tất cả các form-group khác trước khi hiển thị form mới
                            commentForm.show(); // Hiển thị form tương ứng với commentId
                        }
                    });
                });
            </script>
            <script>
                $(document).ready(function() {

                    // Khi nhấn nút "Xem các đánh giá", modal sẽ được hiển thị
                    document.querySelector('.view-reviews-btn').addEventListener('click', function() {
                        // Hiển thị modal
                        document.getElementById('reviewsModal').style.display = 'flex';
                    });

                    // Hàm đóng modal khi nhấn "Đóng"
                    function closeModal() {
                        // Ẩn modal
                        document.getElementById('reviewsModal').style.display = 'none';
                    }

                    // Đóng modal khi nhấp ra ngoài modal
                    window.addEventListener('click', function(event) {
                        // Kiểm tra nếu người dùng nhấp vào vùng nền ngoài modal
                        if (event.target === document.getElementById('reviewsModal')) {
                            closeModal(); // Đóng modal
                        }
                    });


                    // Hàm để khởi tạo các sự kiện tương tác với bình luận
                    function khoiTaoSuKienBinhLuan() {
                        // Bắt sự kiện click vào nút "Thích"
                        $('.like-button').off('click').on('click', function(e) {
                            e.preventDefault();
                            var commentId = $(this).data('comment-id');
                            var likeButton = $(this);

                            $.ajax({
                                url: "{{ route('comments.likeComment') }}",
                                method: 'POST',
                                data: {
                                    cmt_id: commentId,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    if (data.status === 'liked') {
                                        likeButton.text('(' + data.likesCount + ') Bỏ Thích');
                                    } else if (data.status === 'unliked') {
                                        likeButton.text('(' + data.likesCount + ') Thích');
                                    }

                                    if (data.message) {
                                        toastr.success(data.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    toastr.error('Đã xảy ra lỗi: ' + error);
                                }
                            });
                        });

                        // Bắt sự kiện click vào nút xóa
                        $('.deletecm,.deleterepcm').off('click').on('click', function(e) {
                            e.preventDefault();
                            var id = $(this).data('comment-id');
                            var page = $('#currentPage').val(); // Lấy trang hiện tại từ input ẩn

                            Swal.fire({
                                title: 'Bạn có chắc chắn?',
                                text: "Bạn sẽ không thể hoàn tác điều này!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'Hủy',
                                confirmButtonText: 'Có, chắc chắn!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('comments.destroy') }}",
                                        data: {
                                            cm_id: id,
                                            page: page,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(data) {
                                            if (data.status == 'success') {
                                                Swal.fire(
                                                    'Deleted!',
                                                    data.message,
                                                    'success'
                                                )
                                                setTimeout(function() {
                                                    window.location.reload();
                                                }, 1000); // 0.5 giây
                                            } else if (data.status == 'error') {
                                                Swal.fire(
                                                    'Cant Delete',
                                                    data.message,
                                                    'error'
                                                )
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    })
                                }
                            })
                        });

                        // Bắt sự kiện click vào nút báo cáo
                        $('.warningcm,.warningrepcm').off('click').on('click', function(e) {
                            e.preventDefault();
                            var id = $(this).data('comment-id');
                            var page = $('#currentPage').val();

                            Swal.fire({
                                title: 'Bạn có chắc chắn?',
                                text: "Bạn sẽ không thể hoàn tác điều này!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'Hủy',
                                confirmButtonText: 'Có, chắc chắn!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "{{ route('comments.change-status') }}",
                                        method: 'POST',
                                        data: {
                                            cm_id: id,
                                            page: page,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(data) {
                                            if (data.status == 'success') {
                                                Swal.fire(
                                                    'Deleted!',
                                                    data.message,
                                                    'success'
                                                )
                                                setTimeout(function() {
                                                    window.location.reload();
                                                    reloadPage1(page);
                                                }, 1000); // 0.5 giây
                                            } else if (data.status == 'error') {
                                                Swal.fire(
                                                    'Cant Delete',
                                                    data.message,
                                                    'error'
                                                )
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    })
                                }
                            })
                        });

                        // Bắt sự kiện click vào nút chỉnh sửa
                        $('.btneditcm,.btneditrepcm').off('click').on('click', function(e) {
                            e.preventDefault();
                            var id = $(this).data('comment-id');
                            var content = $('#commentForm_' + id).find('textarea[name="editcm"]').val();
                            var page = $('#currentPage').val();
                            if (confirm('Bạn có muốn sửa bình luận này không?')) {
                                $.ajax({
                                    url: "{{ route('comments.update') }}",
                                    method: 'POST',
                                    data: {
                                        cm_id: id,
                                        content: content,
                                        page: page,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(data) {
                                        // Reload để áp dụng các thay đổi và giữ vị trí cuộn
                                        reloadPage1(page);
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Đã xảy ra lỗi: ' + error);
                                    }
                                });
                            }
                        });

                        // Bắt sự kiện click vào nút trả lời bình luận
                        $('.btnrepcm').off('click').on('click', function(e) {
                            e.preventDefault();
                            var id = $(this).data('comment-id');
                            var cmt_id = $(this).closest('.form-groupcm').find('input[data-cmt-id]').data('cmt-id');
                            var content = $('#repcommentForm_' + id).find('textarea[name="repcm"]').val();
                            var pro_id = $('#repcommentForm_' + id).find('input[name="pro_id"]').val();
                            var page = $('#currentPage').val();
                            if (confirm('Bạn có muốn trả lời bình luận này không?')) {
                                $.ajax({
                                    url: "{{ route('comments.store') }}",
                                    method: 'POST',
                                    data: {
                                        cmt_id: cmt_id,
                                        content: content,
                                        pro_id: pro_id,
                                        page: page,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(data) {
                                        // Reload để áp dụng các thay đổi và giữ vị trí cuộn
                                        reloadPage1(page);
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Đã xảy ra lỗi: ' + error);
                                    }
                                });
                            }
                        });

                        // Bắt sự kiện click vào nút chỉnh sửa (editcm)
                        $('.editcm, .editrepcm').off('click').on('click', function(e) {
                            e.preventDefault();
                            var commentId = $(this).data('comment-id');
                            var commentForm = $('#commentForm_' + commentId);

                            if (commentForm.is(':visible')) {
                                commentForm.hide();
                            } else {
                                $('.form-groupcm').hide();
                                commentForm.show();
                            }
                        });

                        // Bắt sự kiện click vào nút trả lời (active_repcm)
                        $('.active_repcm').off('click').on('click', function(e) {
                            e.preventDefault();
                            var commentId = $(this).data('comment-id');
                            var commentForm = $('#repcommentForm_' + commentId);

                            if (commentForm.is(':visible')) {
                                commentForm.hide();
                            } else {
                                $('.form-groupcm').hide();
                                commentForm.show();
                            }
                        });
                    }

                    // Hàm để reload trang và giữ vị trí cuộn
                    function reloadPage() {
                        var scrollPosition = $(window).scrollTop();

                        location.reload();

                    }

                    // Lưu giá trị biến vào sessionStorage
                    function saveShouldMoveToUserContent(value) {
                        sessionStorage.setItem('shouldMoveToUserContent', value);
                    }

                    // Đọc giá trị biến từ sessionStorage
                    function getShouldMoveToUserContent() {
                        return sessionStorage.getItem('shouldMoveToUserContent') === 'true';
                    }



                    // Hàm để lưu giá trị currentPage vào sessionStorage
                    function saveCurrentPage(page) {
                        sessionStorage.setItem('currentPage', page);
                    }

                    // Hàm để lấy giá trị currentPage từ sessionStorage
                    function getCurrentPage() {
                        return sessionStorage.getItem('currentPage') ||
                            1; // Mặc định là trang 1 nếu không có giá trị lưu trữ
                    }


                    function moveToUserContent() {
                        if (getShouldMoveToUserContent() || sessionStorage.getItem('scrollToUserContent') === 'true') {
                            $('html, body').animate({
                                scrollTop: $('.user-content').offset().top
                            }, 500);
                            // Reset biến sau khi di chuyển
                            saveShouldMoveToUserContent(false);
                            sessionStorage.removeItem('scrollToUserContent');
                        }


                    }

                    function reloadPage1(page) {
                        // var scrollPosition = $(window).scrollTop();
                        // var url = new URL(window.location.href);
                        // url.searchParams.set('page', page); // Đặt tham số page vào URL
                        // window.location.href = url.toString(); // Tải lại trang với URL mới
                        $('#currentPage').val(page);

                        var urlWithPage = new URL(window.location.href);
                        urlWithPage.searchParams.set('page', page);


                        // Lưu trạng thái cuộn vào sessionStorage
                        saveShouldMoveToUserContent(true);
                        // Lưu giá trị currentPage vào sessionStorage
                        saveCurrentPage(page);

                        // Chuyển đến URL mới và tải lại trang
                        window.location.href = urlWithPage.toString();
                        $('#currentPage').val(page);



                    }

                    $(document).ready(function() {
                        // Khôi phục giá trị currentPage từ sessionStorage vào input ẩn
                        var currentPage = getCurrentPage();
                        $('#currentPage').val(currentPage);

                        // Di chuyển đến phần tử .user-content sau khi tải lại trang
                        moveToUserContent();

                        khoiTaoSuKienBinhLuan();
                        // Xóa giá trị currentPage từ sessionStorage sau khi đã sử dụng
                        sessionStorage.removeItem('currentPage');
                    });



                    // Xử lý nhấp vào liên kết phân trang
                    $(document).on('click', '.pagination-link[data-url]', function(e) {
                        e.preventDefault();
                        var url = $(this).data('url');
                        console.log('URL:', url); // Xuất URL ra console

                        // Lấy giá trị trang từ URL
                        var urlParams = new URLSearchParams(new URL(url).search);
                        var page = urlParams.get('page');

                        console.log('Page:', page); // Xuất giá trị trang ra console

                        if (url) {
                            currentPage = $(this).text(); // Cập nhật trang hiện tại


                            $.ajax({
                                url: url,
                                method: 'GET',
                                success: function(response) {
                                    $('#comments-container').html($(response).find(
                                        '#comments-container').html());
                                    $('#pagination-container').html($(response).find(
                                        '#pagination-container').html());

                                    // Cập nhật giá trị currentPage trong input ẩn
                                    $('#currentPage').val(page);


                                    // Lưu giá trị currentPage vào sessionStorage
                                    sessionStorage.setItem('currentPage', page);
                                    // Khởi tạo lại các sự kiện tương tác với bình luận sau khi tải nội dung mới
                                    khoiTaoSuKienBinhLuan();

                                    $('html, body').animate({
                                        scrollTop: $('.user-content').offset().top
                                    }, 500);
                                },
                                error: function(xhr, status, error) {
                                    console.log('Error:', error);
                                }
                            });
                        }
                    });

                    // // Bắt sự kiện gửi bình luận và reload tại vị trí cũ
                    // Scroll to the saved position after reload
                    if (sessionStorage.getItem('scrollPosition') !== null) {
                        $(window).scrollTop(sessionStorage.getItem('scrollPosition'));
                        sessionStorage.removeItem('scrollPosition');
                    }

                    $('#commentForm').on('submit', function(e) {
                        // Save the current scroll position
                        sessionStorage.setItem('scrollPosition', $(window).scrollTop());

                        // Allow the form to submit normally
                    });

                    // Khôi phục vị trí cuộn sau khi trang reload
                    $(window).on('load', function() {
                        var url = new URL(window.location.href);
                        var currentPage = url.searchParams.get('page');
                        var pageInput = $('#currentPage').val();

                        // Kiểm tra nếu cần di chuyển đến .user-content
                        if (getShouldMoveToUserContent()) {
                            moveToUserContent();

                        } else {
                            // Nếu không cần di chuyển, kiểm tra trang hiện tại
                            if ((pageInput === '1' && currentPage !== '1' && currentPage !== null)) {
                                sessionStorage.setItem('scrollToUserContent', 'true');
                                // Nếu không phải trang 1 và không phải do chuyển trang, cập nhật URL và tải lại trang
                                url.searchParams.set('page', 1);
                                window.location.href = url.toString();
                                khoiTaoSuKienBinhLuan();
                            }

                        }
                    });


                    // Khởi tạo các sự kiện tương tác với bình luận khi trang load
                    khoiTaoSuKienBinhLuan();
                });
            </script>
        @endpush

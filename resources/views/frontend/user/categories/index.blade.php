@extends('frontend.user.layouts.master')

@section('content')

    <div class="category">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="link" href="{{route('products.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item">{{ $categories->name }}</li>
              </ol>
              <h1 class="h1">{{ $categories->name }}</h1>

              <div class="card card-md category__container">
                  <div class="card-body">
                      <div class="actions">
                          <div class="menu js-category-menu">
                              <div class="swiper">
                                  <div class="swiper-wrapper">
                                      <a class="item swiper-slide active" data-ref="#block-1" href="{{route('products.category', ['categories' =>   $categories->slug ]) }}">Tất cả</a>
                                      @foreach ($subcategories as $subcategory )
                                          <a class="item swiper-slide" data-ref="#block-2" href="{{route('products.subcategory', ['subcategories' =>   $subcategory->slug ]) }}">{{ $subcategory->name }}</a>
                                      @endforeach
                                  </div>
                              </div>
                              <div class="swiper-button-next sw-button"><i class="ic-angle-right"></i></div>
                              <div class="swiper-button-prev sw-button"><i class="ic-angle-left"></i></div>
                          </div>
                          <div class="sort">
                              <div class="content">
                                  <div class="text">Sắp xếp theo:</div>
                                  <div class="dropdown js-dropdown">
                                      <div class="dropdown-button"><span>Mới nhất</span><i class="ic-arrow-select ic-sm"></i></div>
                                      <div class="dropdown-menu">
                                          <div class="dropdown-menu-wrapper scrollbar"><a href="#"><span>Option: 1</span></a><a href="#"><span>Option: 2</span></a><a href="#"><span>Option: 3</span></a><a href="#"><span>Option: 4</span></a><a href="#"><span>Option: 5</span></a></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane active" id="block-1">
                          <div class="product-list">
                              @foreach ($products as $product)
                                  <div class="product">
                                      <div class="product__img">
                                          <a href="#"><img src="{{ $product->image }}" alt=""></a>
                                      </div>
                                      <div class="product__info">
                                          <h3 class="product__name">
                                              <div class="text">{{ $product->name }}</div>
                                              @if ($product->product_type == 'new_arrival')
                                                  <span class="badge badge-xs badge-success badge-link">Mới</span>
                                              @elseif ($product->product_type == 'featured_product')
                                                  <span class="badge badge-xs badge-warning badge-link">Nổi bật</span>
                                              @elseif ($product->product_type == 'top_product')
                                                  <span class="badge badge-xs badge-info badge-link">Hàng đầu</span>
                                              @elseif ($product->product_type == 'best_product')
                                                  <span class="badge badge-xs badge-danger badge-link">Tốt nhất</span>
                                              @endif
                                          </h3>
                                          <div class="product__price">
                                              <div class="text">Giá chỉ</div>
                                              <div class="price">{{ $product->price }}đ</div><strike class="text-promo p-l-6 f-s-p-16 f-w-400">39.990.000đ</strike>
                                          </div>
                                      </div>
                                      <div class="product__detail"><a class="btn btn-outline-grayscale btn-md" href="#">XEM CHI TIẾT</a></div>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  @endsection

@push('scripts')
<script>
      $(document).ready(function() {
            function setActiveSlide(index) {
                const slides = $('.swiper-slide');
                slides.removeClass('active');
                if (index >= slides.length) {
                    index = 0;
                } else if (index < 0) {
                    index = slides.length - 1;
                }
                slides.eq(index).addClass('active');
                // Lưu trạng thái active vào localStorage
                localStorage.setItem('activeSlideIndex', index);
            }

            $('.swiper-slide').click(function() {
                const clickedSlide = $(this);
                if (!clickedSlide.hasClass('active')) {
                    $('.swiper-slide').removeClass('active');
                    clickedSlide.addClass('active');
                    setActiveSlide($('.swiper-slide').index(clickedSlide));
                }
            });

            $('.swiper-button-next').click(function() {
                const activeSlide = $('.swiper-slide.active');
                let nextIndex = $('.swiper-slide').index(activeSlide) + 1;
                if (nextIndex >= $('.swiper-slide').length) {
                    nextIndex = 0; // Quay lại slide đầu tiên nếu đang ở cuối danh sách
                }
                setActiveSlide(nextIndex);
                const nextSlide = $('.swiper-slide').eq(nextIndex);
                const nextHref = nextSlide.attr('href');
                if (nextHref) {
                    window.location.href = nextHref;
                }
            });

            $('.swiper-button-prev').click(function() {
                const activeSlide = $('.swiper-slide.active');
                let prevIndex = $('.swiper-slide').index(activeSlide) - 1;
                if (prevIndex < 0) {
                    prevIndex = $('.swiper-slide').length -
                    1; // Quay lại slide cuối cùng nếu đang ở slide đầu tiên
                }
                setActiveSlide(prevIndex);
                const prevSlide = $('.swiper-slide').eq(prevIndex);
                const prevHref = prevSlide.attr('href');
                if (prevHref) {
                    window.location.href = prevHref;
                }
            });

            // Khởi động slide active từ localStorage nếu có
            const storedIndex = localStorage.getItem('activeSlideIndex');
            if (storedIndex !== null) {
                setActiveSlide(parseInt(storedIndex));
            } else {
                // Nếu chưa có slide active được lưu, thì chọn slide đầu tiên làm active
                if (!$('.swiper-slide').hasClass('active')) {
                    $('.swiper-slide').first().addClass('active');
                    setActiveSlide(0);
                }
            }

            function setActiveSlideByUrl() {
                const currentUrl = window.location.href;

                $('.swiper-slide').each(function(index) {
                    const slideHref = $(this).attr('href');
                    if (slideHref && currentUrl.includes(slideHref)) {
                        $('.swiper-slide').removeClass('active');
                        $(this).addClass('active');
                        setActiveSlide(index);
                        return false; // Dừng vòng lặp khi đã tìm thấy slide tương ứng
                    }
                });
            }

            // Gọi hàm để kiểm tra và set active khi trang được tải
            setActiveSlideByUrl();
        });
</script>
@endpush

@extends('frontend.user.layouts.master')

@section('content')

    <section class="section-wrap home-page">
        <section class="section-module section__cate">
            <div class="container">
                <div class="home__cate flex">
                    <div class="cate__item"><a href="{{route('products.category', ['categories' => 'iphone']) }}">
                            <div class="cate__item-title">iPhone</div>
                            <div class="cate__item-img"><img src="frontend/asset/img/iphone.png" alt="iPhone"></div>
                            <div class="cate__item-btn">
                                <div class="cate__item-link">
                                    <span>Khám phá ngay</span>
                                    <i class="ic-angle-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="cate__item"><a href="{{route('products.category', ['categories' => 'ipad']) }}">
                            <div class="cate__item-title">iPad</div>
                            <div class="cate__item-img"><img src="frontend/asset/img/ipad.png" alt="iPad"></div>
                            <div class="cate__item-btn">
                               <div class="cate__item-link"> <span>Khám phá ngay</span><i class="ic-angle-right"></i></div>
                            </div>
                        </a>
                    </div>
                    <div class="cate__item"><a href="{{route('products.category', ['categories' => 'macbook']) }}">
                            <div class="cate__item-title">Macbook</div>
                            <div class="cate__item-img"><img src="frontend/asset/img/mac.png" alt="Mac"></div>
                            <div class="cate__item-btn">
                                <div class="cate__item-link"><span>Khám phá ngay</span><i class="ic-angle-right"></i></div>
                            </div>
                        </a>
                    </div>
                    <div class="cate__item"><a href="{{route('products.category', ['categories' => 'apple-watch']) }}">
                            <div class="cate__item-title">Apple Watch</div>
                            <div class="cate__item-img"><img src="frontend/asset/img/Apple-watch.png" alt="Apple Watch">
                            </div>
                            <div class="cate__item-btn">
                                <div class="cate__item-link"><span>Khám phá ngay</span><i class="ic-angle-right"></i></div>
                            </div>
                        </a>
                    </div>
                    <div class="cate__item"><a href="{{route('products.category', ['categories' => 'phu-kien-linh-kien']) }}">
                            <div class="cate__item-title">Phụ kiện</div>
                            <div class="cate__item-img"><img src="frontend/asset/img/airtag.png" alt="Phụ kiện"></div>
                            <div class="cate__item-btn">
                                <div class="cate__item-link"><span>Khám phá ngay</span><i class="ic-angle-right"></i></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </section>

    @include('frontend.user.layouts.index')
@endsection

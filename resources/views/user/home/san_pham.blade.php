@extends('user.layouts.master')

@php
    $title = config('app.name', 'Laravel');
@endphp

@section('title')
    <title>{{$title}}</title>

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')
    <style>
        .filters-content__product-img > img{
            object-fit: contain;
        }
    </style>
@endsection

@section('content')


    <!-- Begin Content -->
    <main class="home">
        <!-- Begin Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="container-xl">
                <div class="breadcrumbs-wrapper">
                    <nav class="breadcrumbs-link">
                        <a href="{{route('user.home.index')}}" class="breadcrumbs-link__sub">Trang chủ</a>
                        <span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <a href="{{route('user.home.filter', ['category_ids' => optional($category)->id])}}" class="breadcrumbs-link__sub">{{optional($category)->name}}</a>
                        <span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <a class="breadcrumbs-link__sub">{{$product->name}}</a>
                    </nav>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb -->

        <!-- START SPEAK -->
        <section class="details">
            <div class="container-xl">
                <div class="details-wrapper">
                    <div class="row gx-4">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="details-product">
                                <div class="details-info__slider">
                                    <!-- Swiper -->
                                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                         class="swiper DetailsSwiper2">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="details-info__slider-cover">
                                                    <div class="details-info__slider-img">
                                                        <img style="object-fit: contain;" src="{{$product->avatar('original')}}"/>
                                                    </div>
                                                </div>

                                            </div>
                                            @foreach($product->images as $image)
                                                <div class="swiper-slide">
                                                    <div class="details-info__slider-cover">
                                                        <div class="details-info__slider-img">
                                                            <img
                                                                src="{{$image->image_path}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>

                                    <div thumbsSlider="" class="swiper DetailsSwiper details-info__slider-thumbs">
                                        <div class="swiper-wrapper">
                                            @foreach($product->images as $image)
                                                <div class="swiper-slide">
                                                    <div class="details-info__slider-cover">
                                                        <div class="details-info__slider-active">
                                                            <img src="{{$image->image_path}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="details-product__info">
                                    <h3 class="details-product__title">
                                        {{$product->name}}
                                    </h3>

                                    <ul class="details-info__digital-header">
                                        <li>
                                            Thương hiệu:
                                            <span class="color-main">{{optional($product->brand)->name}}</span>
                                        </li>
                                        <li>
                                            SKU:
                                            <span class="color-main">{{$product->sku}}</span>
                                        </li>
                                        <li>
                                            Mã vạch:
                                            <span class="color-main">{{$product->barcode}}</span>
                                        </li>
                                    </ul>

                                    <div class="details-product__price">
                                        {{number_format($product->sell_price)}}đ
                                    </div>

                                    <div class="details-product__activity">
                                        <button class="details-product__btn" onclick="buyNow({{ $product->id }})">
                                            Mua ngay
                                        </button>

                                        <button class="details-product__btn add-cart" onclick="addToCart({{$product->id}})">
                                            Thêm vào giỏ hàng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="details-same">
                                <div class="details-same__item">
                                    <div class="details-same__img">
                                        <img
                                            src="{{\App\Models\Helper::logoImagePath()}}">
                                    </div>

                                    <p class="details-same__text">
                                        {{env('APP_NAME')}}
                                        <i class="fa-solid fa-circle-check"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="details-info__trust">
                                <h3 class="details-info__trust-heading">Chính sách bán hàng</h3>

                                <ul class="details-info__trust-list">
                                    <li class="details-info__trust-item">
                                        <div class="details-info__trust-icon">
                                            <img
                                                src="https://lh3.googleusercontent.com/E0d9NJQM-lkf44ZrHeKLZ7P2qEjpGgRX48UiZ-ITpYG79YV8RS7p7zMKDnAjiL-jKrC7IsFirXaVmsQz-9GI6qomaPqH077k=rw"
                                                alt="">
                                        </div>
                                        Cam kết 100% chính hãng
                                    </li>

                                    <li class="details-info__trust-item">
                                        <div class="details-info__trust-icon">
                                            <img
                                                src="https://lh3.googleusercontent.com/LrMKYa1DKh6XMNJBOPJ6t6_w5i1hf0NsuTvyyaoY3mJ-LS6pqyGqtYzPdnyNvdp9ZbQ99boFy3b7sIEofeWKHySPKPCgezI=rw"
                                                alt="">
                                        </div>
                                        Giá bán tốt nhất
                                    </li>

                                    <li class="details-info__trust-item">
                                        <div class="details-info__trust-icon">
                                            <img
                                                src="https://lh3.googleusercontent.com/rhBme1oyzZBvHgzmXJChzbmCmgqi8NnZk464N0eHygrmFujbkw_EXBKdsI-8aGTOYpPF8Vcvh6VLIOaOmv69X60JXZngRPFT=rw"
                                                alt="">
                                        </div>
                                        Giao hàng miễn phí
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="details-cover">
                        <div class="row">
                            <div class="col-lg-8">
                                <article class="details-article">
                                    <h3 class="details-article__header">
                                        Mô tả sản phẩm
                                    </h3>

                                    <div class="details-article__wrapper">
                                        {!!$product->description!!}
                                    </div>
                                </article>
                            </div>

                            <div class="col-lg-4">
                                <div class="details-digital">
                                    <h3 class="details-article__header details-digital__heading">
                                        Thông tin chi tiết
                                    </h3>

                                    <ul class="details-digital__list">
                                        <li class="details-digital__item">
                                            <p class="details-digital__title">Hãng sản xuất</p>
                                            <p class="details-digital__description">{{optional($product->brand)->name}}</p>
                                        </li>

                                    </ul>
                                    <ul class="details-digital__list">
                                        <li class="details-digital__item">
                                            <p class="details-digital__title">Bảo hành</p>
                                            <p class="details-digital__description">{{$product->warranty}} tháng</p>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="details-slider">
                        <h3 class="details-slider__heading">
                            Sản phẩm tương tự
                        </h3>
                        <!-- Swiper -->

                        <div class="SameSwiper category__swiper">
                            <div class="swiper-wrapper">
                                @foreach( $productRelates as $productRelate)
                                    <div class="swiper-slide">
                                        <div class="filters-content__product-item">
                                            <a href="{{route('user.home.filter_detail',['slug'=>$productRelate->slug])}}"
                                               class="filters-content__product-img">
                                                <img src="{{$productRelate->avatar()}}"
                                                     alt="Ảnh sản phẩm">
                                            </a>

                                            <div class="filters-content__product-info">
                                                <h4 class="filters-content__product-title">
                                                    <a href="{{route('user.home.filter_detail',['slug'=>$productRelate->slug])}}">
                                                        {{$productRelate->name}}
                                                    </a>
                                                </h4>

                                                <div class="filters-content__product-price">
                                                    <span
                                                        class="price-number">{{number_format($productRelate->sell_price)}}</span>đ
                                                </div>
                                            </div>

                                            <div class="filters-content__product-btn">
                                                Thêm vào giỏ
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                            <!-- <div class="swiper-pagination"></div> -->
                        </div>


                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

        </section>
        <!-- END SPEAK -->
    </main>
    <!-- End Content -->



@endsection

@section('js')
    <script>
        // / <!-- Slider Product Details -->
        var swiper = new Swiper(".DetailsSwiper", {
            // loop: true,
            spaceBetween: 6,
            slidesPerView: 6,
            // freeMode: true,
            // watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".DetailsSwiper2", {
            // loop: true,
            // spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>

    <script>
        var swiper = new Swiper(".SameSwiper", {
            slidesPerView: 2,
            spaceBetween: 0,
            pagination: {
                el: ".details-slider>.swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".details-slider>.swiper-button-next",
                prevEl: ".details-slider>.swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
                1200: {
                    slidesPerView: 5,
                },
            },
        });
    </script>

    <!-- SCROLL JS-->
    <script>
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 200) {
                $('#header-main').addClass('header-sticky');
            } else {
                $('#header-main').removeClass('header-sticky');
            }
        });
    </script>
    <script>
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 100) {
                $('#header-main__mobile').addClass('header-sticky__mobile');
            } else {
                $('#header-main__mobile').removeClass('header-sticky__mobile');
            }
        });
    </script>
@endsection


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
    {{--    <link rel="stylesheet" href="{{asset('assets/user/assets/filter/filter.css')}}">--}}
@endsection

@section('content')


    <!-- Begin Content -->
    <main class="home">
        <!-- Begin Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="container-xl">
                <div class="breadcrumbs-wrapper">
                    <nav class="breadcrumbs-link">
                        <a href="#" class="breadcrumbs-link__sub">Trang chủ</a>
                        <span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <a href="#" class="breadcrumbs-link__sub">Tin tức</a>
                    </nav>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb -->

        <!-- START News -->
        <section class="news">
            <div class="container-xl">
                <div class="news-content">
                    {!! $news->content !!}
                </div>
            </div>

        </section>
        <!-- END News -->
    </main>
    <!-- End Content -->



@endsection

@section('js')
    $(document).ready(function () {
    $('.noUi-handle').on('click', function () {
    $(this).width(50);
    });
    var rangeSlider = document.getElementById('slider-range');
    var moneyFormat = wNumb({
    decimals: 0,
    // thousand: ',',
    // prefix: '₫',
    });
    noUiSlider.create(rangeSlider, {
    start: [0, 100000000],
    step: 10000,
    range: {
    'min': [0],
    'max': [100000000]
    },
    format: moneyFormat,
    connect: true
    });

    // Set visual min and max values and also update value hidden form inputs
    rangeSlider.noUiSlider.on('update', function (values, handle) {

    const convertVN1 = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
    }).format(values[0]);
    const convertVN2 = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
    }).format(values[1]);

    document.querySelector('#slider-range-value1').value = convertVN1;
    document.querySelector('#slider-range-value2').value = convertVN2;
    // document.getElementsByName('min-value').value = moneyFormat.from(
    //     values[0]);
    // document.getElementsByName('max-value').value = moneyFormat.from(
    //     values[1]);
    });
    });

    $(document).ready(function () {
    $('.noUi-handle').on('click', function () {
    $(this).width(50);
    });
    var rangeSlider = document.getElementById('slider-rangeTwo');
    var moneyFormat = wNumb({
    decimals: 0,
    // thousand: ',',
    // prefix: '₫',
    });
    noUiSlider.create(rangeSlider, {
    start: [0, 100000000],
    step: 10000,
    range: {
    'min': [0],
    'max': [100000000]
    },
    format: moneyFormat,
    connect: true
    });

    // Set visual min and max values and also update value hidden form inputs
    rangeSlider.noUiSlider.on('update', function (values, handle) {

    const convertVN1 = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
    }).format(values[0]);
    const convertVN2 = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
    }).format(values[1]);

    document.querySelector('.slider-range-valueOne').value = convertVN1;
    document.querySelector('.slider-range-valueTwo').value = convertVN2;
    // document.getElementsByName('min-value').value = moneyFormat.from(
    //     values[0]);
    // document.getElementsByName('max-value').value = moneyFormat.from(
    //     values[1]);
    });
    });
    </script>

    <!-- ================ Header Scroll ================= -->
    <!-- <script>
    window.onscroll = function () {
        myFunction()
    };

    const headerScroll = document.querySelector(".header-scroll");
    const headerMain = document.querySelector(".header");
    var sticky = headerMain.offsetTop + 198;


    function myFunction() {
        if (window.pageYOffset > sticky) {
            headerScroll.classList.add('active');
        } else {
            headerScroll.classList.remove('active');
        }
    }
    </script> -->

    <!-- <script>
        $(".premium-priceList__check").change(function () {
            if (this.checked) {
                $('.premium-priceList__content').append(
                    '<style>.premium-priceList__month{display: none !important;}</style>');
                $('.premium-priceList__content').append(
                    '<style>.premium-priceList__year{display: flex !important; display: -webkit-flex; display: -ms-flexbox;}</style>'
                );
            } else {
                $('.premium-priceList__content').append(
                    '<style>.premium-priceList__month{display: flex !important; display: -webkit-flex; display: -ms-flexbox;}</style>'
                );
                $('.premium-priceList__content').append(
                    '<style>.premium-priceList__year{display: none !important;}</style>');
            }
        });
    </script> -->

    <script>
        var swiper = new Swiper(".mySwipers", {

            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                428: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                728: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1023: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },

        });
    </script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
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

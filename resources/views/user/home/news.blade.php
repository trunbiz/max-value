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
                <div class="news-wrapper">
                    <div class="news-list">
                        @foreach($news as $new)
                            <a href="{{route('user.home.new_detail',['slug'=>$new->slug])}}" class="news-item">
                                <div class="news-item__img">
                                    <img src="{{$new->avatar('1000x1000')}}"
                                         alt="">
                                </div>

                                <div class="news-item__info">
                                    <h3 class="news-item__title">
                                        {{$new -> title}}
                                    </h3>

                                    <span class="news-item__time">
                                    {{$new->created_at}}
                                </span>

                                    <p class="news-item__desc">
                                        {{\App\Models\Formatter::getShortDescriptionAttribute($new->content)}}
                                    </p>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            {{$news->links('user.components.new_paginate', ['news'=>$news])}}
            {{--                    <ul class="filters-pagination">--}}
            {{--                        <!-- < -->--}}
            {{--                        <li class="filters-pagination__item">--}}
            {{--                            <a href="#" class="filters-pagination__link">--}}
            {{--                                <i class="filters-pagination__icon fas fa-chevron-left"></i>--}}
            {{--                            </a>--}}
            {{--                        </li>--}}
            {{--                        <!-- 1 -->--}}
            {{--                        <li class="filters-pagination__item active">--}}
            {{--                            <a href="#" class="filters-pagination__link">1</a>--}}
            {{--                        </li>--}}
            {{--                        <!-- 2 -->--}}
            {{--                        <li class="filters-pagination__item">--}}
            {{--                            <a href="#" class="filters-pagination__link">2</a>--}}
            {{--                        </li>--}}
            {{--                        <!-- 3 -->--}}
            {{--                        <li class="filters-pagination__item">--}}
            {{--                            <a href="#" class="filters-pagination__link">3</a>--}}
            {{--                        </li>--}}
            {{--                        <!-- 4 -->--}}
            {{--                        <!-- <li class="filters-pagination__item">--}}
            {{--                                <a href="#" class="filters-pagination__link">4</a>--}}
            {{--                            </li> -->--}}
            {{--                        <!-- 5 -->--}}
            {{--                        <!-- <li class="filters-pagination__item">--}}
            {{--                                <a href="#" class="filters-pagination__link">5</a>--}}
            {{--                            </li> -->--}}
            {{--                        <!-- ... -->--}}
            {{--                        <li class="filters-pagination__item">--}}
            {{--                            <a href="#" class="filters-pagination__link">...</a>--}}
            {{--                        </li>--}}
            {{--                        <!-- 14 -->--}}
            {{--                        <li class="filters-pagination__item">--}}
            {{--                            <a href="#" class="filters-pagination__link">14</a>--}}
            {{--                        </li>--}}
            {{--                        <!--  > -->--}}
            {{--                        <li class="filters-pagination__item">--}}
            {{--                            <a href="#" class="filters-pagination__link">--}}
            {{--                                <i class="filters-pagination__icon fas fa-chevron-right"></i>--}}
            {{--                            </a>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </section>
        <!-- END News -->
    </main>
    <!-- End Content -->

@endsection

@section('js')
    <link rel="stylesheet" href="{{asset('assets/user/assets/filter/filter.js')}}">



    <script>


        function onFilter() {


            const searchParams = new URLSearchParams(window.location.search)


            if ($('#filters1').is(":checked")) {
                // searchParams.set("price1", "true")
                searchParams.set("min_price", "0")
                searchParams.set("max_price", "1000000")
            } else if ($('#filters2').is(":checked")) {
                searchParams.set("min_price", "1000000")
                searchParams.set("max_price", "2000000")
            } else if ($('#filters3').is(":checked")) {
                searchParams.set("min_price", "2000000")
                searchParams.set("max_price", "100000000")
            } else {

                searchParams.set("min_price", $("#slider-range-value1").val().replace(/[.]/g, ""))
                searchParams.set("max_price", $("#slider-range-value2").val().replace(/[.]/g, ""))
            }

            let categoryIds = [];

            $(".checkbox_category:checked").each(function () {
                categoryIds.push($(this).val());
            });


            searchParams.set("category_ids", categoryIds)
            searchParams.set("filter", "true")

            window.location.search = searchParams.toString()
        }

        function onXemNhieu() {
            const searchParams = new URLSearchParams(window.location.search)
            deleteparamurl(searchParams);
            searchParams.set("xem_nhieu", "true")
            window.location.search = searchParams.toString()

        }

        function onlatest() {
            const searchParams = new URLSearchParams(window.location.search)
            deleteparamurl(searchParams);
            searchParams.set("latest_product", "true")
            window.location.search = searchParams.toString()

        }

        function onBiggestDiscount() {
            const searchParams = new URLSearchParams(window.location.search)
            deleteparamurl(searchParams);
            searchParams.set("biggest_discount", "true")

            window.location.search = searchParams.toString()

        }

        function onIncreasePrice() {
            const searchParams = new URLSearchParams(window.location.search)
            deleteparamurl(searchParams);
            searchParams.set("increase_price", "true")
            window.location.search = searchParams.toString()

        }

        function onDecreasePrice() {
            const searchParams = new URLSearchParams(window.location.search)
            deleteparamurl(searchParams);
            searchParams.set("decrease_price", "true")
            window.location.search = searchParams.toString()

        }


        function deleteparamurl(searchParams) {
            searchParams.delete("xem_nhieu")
            searchParams.delete("latest_product")
            searchParams.delete("biggest_discount")
            searchParams.delete("increase_price")
            searchParams.delete("decrease_price")
            searchParams.delete("price1")
            searchParams.delete("price2")
            searchParams.delete("price3")
            searchParams.delete("filter")
        }

    </script>
@endsection

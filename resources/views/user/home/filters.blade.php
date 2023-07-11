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
                        <a href="" class="breadcrumbs-link__sub">Trang chủ</a>
                        <span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <a href="{{route('user.home.filter')}}" class="breadcrumbs-link__sub">Thực phẩm chức năng</a>
                    </nav>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb -->
        <section class="filters">
            <div class="container-xl">
                <div class="filters-wrapper">
                    <div class="filters-content">
                        <div class="filters-content__condition">
                            <!-- KHOẢNG GIÁ -->
                            <div class="filters-content__option">
                                <h4 class="filters-content__title">Khoảng giá</h4>

                                <ul class="filters-content__list">

                                    <li class="filters-content__item">
                                        <input id="filters1"
                                               class="form-check-input radio_price"
                                               name="radio_price"
                                               {{request("max_price") == "1000000" ? 'checked' : ''}}
                                               type="radio" value=""
                                               aria-label="Checkbox for following text input">

                                        <div class="filters-content__details">
                                            <label for="filters1" class="filters-content__price">Dưới 1 triệu</label>

                                        </div>
                                    </li>

                                    <li class="filters-content__item">
                                        <input id="filters2"
                                               class="form-check-input"
                                               name="radio_price"
                                               {{(request("min_price") == 1000000 && request("max_price") == 2000000) ? 'checked' : ''}}
                                               type="radio" value=""
                                               aria-label="Checkbox for following text input">
                                        <div class="filters-content__details">
                                            <label for="filters2" class="filters-content__price">Từ 1 triệu đến 2 triệu</label>


                                        </div>
                                    </li>

                                    <li class="filters-content__item">
                                        <input id="filters3"
                                               class="form-check-input "
                                               name="radio_price"
                                               {{request("max_price") == 100000000 ? 'checked' : ''}}
                                               type="radio" value=""
                                               aria-label="Checkbox for following text input">
                                        <div class="filters-content__details">
                                            <label for="filters3" class="filters-content__price">Trên 2 triệu</label>

                                        </div>
                                    </li>
                                </ul>

                                <div class="filters-content__range">
                                    <div class=" filters-content__range-progress">
                                        <div id="slider-range"></div>
                                    </div>

                                    <div class="row filters-content__range-price">
                                        <div class="mb-3 col-lg-6 caption">
                                            <input id="slider-range-value1" type="text" class="form-control"
                                                   placeholder="" aria-label="startPrice" value="{{request('min_price')}}">
                                        </div>
                                        <div class="text-right col-lg-6 caption">

                                            <input id="slider-range-value2" type="text" class="form-control"
                                                   placeholder="" aria-label="startPrice" value="{{request('max_price')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="filters-content__range-btn">
                                    <button class="btn " onclick="onFilter()">Lọc</button>
                                </div>
                            </div>
                            <!-- KHOẢNG GIÁ -->

                            <!-- NHU CẦU SỬ DỤNG -->
                            <div class="filters-content__option">
                                <h4 class="filters-content__title">Danh mục</h4>

                                <ul class="filters-content__list">
                                    @foreach($categories as $category)
                                        <li class="filters-content__item">
                                            <input id ="{{$category->id}}" class="form-check-input checkbox_category" type="checkbox" value="{{$category->id}}" {{in_array($category->id, explode(",", request('category_ids'))) ? 'checked' : ''}}
                                            aria-label="Checkbox for following text input">
                                            <div class="filters-content__details">
                                                <label for ="{{$category->id}}" class="filters-content__price">{{$category->name}}</label>
                                                <span>({{$category->products->count()}})</span>
                                            </div>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                            <!-- NHU CẦU SỬ DỤNG -->

                        </div>

                        <div class="filters-content__mobile" data-bs-toggle="offcanvas"
                             data-bs-target="#filterOffcanvas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                            </svg>

                            <span>Bộ lọc</span>
                        </div>

                        <div class="filters-content__product">
                            <!-- Pagination and Button Sort -->
                            <div class="filters-content__navigation">
                                <h4 class="filters-content__label">Sắp xếp theo:</h4>

                                <div class="filters-content__action">
                                    <button
                                        class="btn btn-outline-warning {{request('latest_product') == "true" ? 'active' : '' }}"
                                        onclick="onlatest()">Hàng Mới
                                    </button>
                                    <button
                                        class="btn btn-outline-warning {{request('xem_nhieu') == "true" ? 'active' : ''}}"
                                        onclick="onXemNhieu()">Xem Nhiều
                                    </button>
                                    <button
                                        class="btn btn-outline-warning {{request('biggest_discount') == "true" ? 'active' : ''}}"
                                        onclick="onBiggestDiscount()">Giá Giảm Nhiều
                                    </button>
                                    <button
                                        class="btn btn-outline-warning {{request('increase_price') == "true" ? 'active' : ''}}"
                                        onclick="onIncreasePrice()">Giá Tăng Dần
                                    </button>
                                    <button
                                        class="btn btn-outline-warning {{request('decrease_price') == "true" ? 'active' : ''}}"
                                        onclick="onDecreasePrice()">Giá Giảm Dần
                                    </button>
                                </div>
                            </div>
                            <!-- Pagination and Button Sort -->

                            <!-- <div id="div_no_product_search" style="">
                                    <h3>Không tìm thấy sản phẩm phù hợp!</h3>
                                </div> -->

                            <!-- List Product -->
                            @if(count($products) == 0)
                                <div style="text-align:center" class="mt-5">
                                    <h3 style="font-weight: bold">Không tìm thấy sản phẩm</h3>
                                </div>
                            @endif

                            <div class="filters-content__product-list">

                                @foreach($products as $product)
                                    <div class="filters-content__product-item">
                                        <a href="{{route('user.home.filter_detail',['slug'=>$product->slug])}}" class="filters-content__product-img">
                                            <img src="{{$product->image_url}}">
                                        </a>

                                        <div class="filters-content__product-info">
                                            <h4 class="filters-content__product-title">
                                                <a href="{{route('user.home.filter_detail',['slug'=>$product->slug])}}">
                                                    {{$product->name}}
                                                </a>
                                            </h4>

                                            <div class="filters-content__product-price">
                                                <span
                                                    class="price-number">{{number_format($product->sell_price)}} </span>đ
                                            </div>
                                        </div>

                                        <div class="filters-content__product-btn" onclick="addToCart({{$product->id}})">
                                            Thêm vào giỏ
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @include('user.components.paginate', ['paginator' => $products])

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- START SPEAK -->

        <!-- END SPEAK -->
        <div class="offcanvas offcanvas-start filters-offcanvas" tabindex="-1" id="filterOffcanvas"
             aria-labelledby="filterOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 id="filterOffcanvasLabel"></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="filters-content__option">
                    <h4 class="filters-content__title">Khoảng giá</h4>

                    <ul class="filters-content__list">

                        <li class="filters-content__item">
                            <input id="filters1"
                                   class="form-check-input radio_price"
                                   name="radio_price"
                                   {{request("max_price") == "1000000" ? 'checked' : ''}}
                                   type="radio" value=""
                                   aria-label="Checkbox for following text input">

                            <div class="filters-content__details">
                                <label  for="filters1" class="filters-content__price">Dưới 1 triệu</label>

                            </div>
                        </li>

                        <li class="filters-content__item">
                            <input id="filters2"
                                   class="form-check-input"
                                   name="radio_price"
                                   {{(request("min_price") == 1000000 && request("max_price") == 2000000) ? 'checked' : ''}}
                                   type="radio" value=""
                                   aria-label="Checkbox for following text input">
                            <div class="filters-content__details">
                                <label for="filters2" class="filters-content__price">Từ 1 triệu đến 2 triệu</label>


                            </div>
                        </li>

                        <li class="filters-content__item">
                            <input id="filters3"
                                   class="form-check-input "
                                   name="radio_price"
                                   {{request("max_price") == 100000000 ? 'checked' : ''}}
                                   type="radio" value=""
                                   aria-label="Checkbox for following text input">
                            <div class="filters-content__details">
                                <label for="filters3" class="filters-content__price">Trên 2 triệu</label>

                            </div>
                        </li>
                    </ul>

                    <div class="filters-content__range">
                        <div class=" filters-content__range-progress">
                            <div id="slider-range"></div>
                        </div>

                        <div class="row filters-content__range-price">
                            <div class="mb-3 col-lg-6 caption">
                                <input id="slider-range-value1" type="text" class="form-control"
                                       placeholder="" aria-label="startPrice" value="{{request('min_price')}}">
                            </div>
                            <div class="text-right col-lg-6 caption">

                                <input id="slider-range-value2" type="text" class="form-control"
                                       placeholder="" aria-label="startPrice" value="{{request('max_price')}}">
                            </div>
                        </div>
                    </div>

                    <div class="filters-content__range-btn">
                        <button class="btn " onclick="onFilter()">Lọc</button>
                    </div>
                </div>
                <!-- KHOẢNG GIÁ -->

                <!-- NHU CẦU SỬ DỤNG -->
                <div class="filters-content__option">
                    <h4 class="filters-content__title">Danh mục</h4>

                    <ul class="filters-content__list">
                        @foreach($categories as $category)
                            <li class="filters-content__item">
                                <input id ="{{$category->id}}" class="form-check-input checkbox_category" type="checkbox" value="{{$category->id}}" {{in_array($category->id, explode(",", request('category_ids'))) ? 'checked' : ''}}
                                aria-label="Checkbox for following text input">
                                <div class="filters-content__details">
                                    <label for ="{{$category->id}}" class="filters-content__price">{{$category->name}}</label>
                                    <span>({{$category->products->count()}})</span>
                                </div>
                            </li>

                        @endforeach
                    </ul>
                </div>
                <!-- NHU CẦU SỬ DỤNG -->

                <!-- CPU -->

            </div>
        </div>
    </main>
    <!-- End Content -->

@endsection

@section('js')
{{--    <link rel="stylesheet" href="{{asset('assets/user/assets/filter/filter.js')}}">--}}



    <script>


        function onFilter() {


            const searchParams = new URLSearchParams(window.location.search)


            if ($('#filters1').is(":checked")) {
                // searchParams.set("price1", "true")
                searchParams.set("min_price", "0")
                searchParams.set("max_price", "1000000")
            }else if ($('#filters2').is(":checked")) {
                searchParams.set("min_price", "1000000")
                searchParams.set("max_price", "2000000")
            } else if ($('#filters3').is(":checked")){
                searchParams.set("min_price", "2000000")
                searchParams.set("max_price", "100000000")
            }else{

                searchParams.set("min_price",  $("#slider-range-value1").val().replace(/[.]/g,""))
                searchParams.set("max_price", $("#slider-range-value2").val().replace(/[.]/g,""))
            }

            let categoryIds = [];

            $(".checkbox_category:checked").each(function(){
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

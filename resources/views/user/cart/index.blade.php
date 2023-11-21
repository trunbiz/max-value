@extends('user.layouts.master')

@section('title')
    <title>{{$title}}</title>

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>

@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')

@endsection

@section('content')

    @php
        $total = 0;
        $cart = \Illuminate\Support\Facades\Session::get('cart');
    @endphp
    <!-- Begin Content -->
    <main class="home">
        <!-- Begin Breadcrumbs -->
        <section class="breadcrumbs">
            <div class="container-xl">
                <div class="breadcrumbs-wrapper">
                    <nav class="breadcrumbs-link">
                        <a href="{{ route('user.home.index') }}" class="breadcrumbs-link__sub">Trang chủ</a>
                        <span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <a href="#" class="breadcrumbs-link__sub">{{ $title }}</a>
                    </nav>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb -->

        <!-- START Cart -->
        <div id="cartOrder">
            @if(isset($cart) && !empty($cart))
                <section class="cart">
                    <div class="container-xl">
                        <div class="cart-wrapper">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-12">
                                    <div class="cart-header">
                                        <h3 class="cart-header__title">
                                            {{ $title }}
                                        </h3>

                                        <a href="javascript:void(0)" onclick="removeCart()" class="cart-header__remove">
                                            Xóa tất cả
                                        </a>
                                    </div>

                                    <div class="cart-product">
                                        <div class="cart-product__table">
                                            <div class="cart-product__header">
                                            <span class="product-check">
{{--                                                <input type="checkbox" class="cart-product__check checkAll" checked>--}}
                                            </span>
                                                <span class="product-info">Sản phẩm</span>
                                                <span class="product-price">Đơn giá</span>
                                                <span class="product-quantity">Số lượng</span>
                                                <span class="product-money">Thành tiên</span>

                                                <span class="product-remove"></span>
                                            </div>

                                            <div class="cart-product__list">
                                                @foreach($cart as $item)
                                                    @php
                                                        $subtotal = $item['price'] * $item['quantity'];
                                                        $total += $subtotal;
                                                    @endphp
                                                    <div class="cart-product__item" id="item{{$item['product_id']}}">
                                                            <span class="product-check cart-product__check">
{{--                                                                <input type="checkbox" name="inputCheck" class="cart-product__check" checked value="{{ $item['product_id'] }}">--}}
                                                            </span>

                                                        <div class="product-info cart-product__info">
                                                            <div class="cart-product__img">
                                                                <img src="{{ $item['product_image'] }}" alt="{{ $item['product_name'] }}">
                                                            </div>

                                                            <div class="cart-product__detail">
                                                                <h3 class="cart-product__name">
                                                                    {{ $item['product_name'] }}
                                                                </h3>
                                                                <div class="cart-product__option">
                                                                    <p>SKU: {{ $item['product_sku'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <span class="product-price cart-product__price">
                                                                <span class="product-label">Đơn giá:</span>
                                                                <span class="price-cover">
                                                                    <span class="price-new">
                                                                        {{ number_format($item['price'], '0', '', '.') }}<sup>đ</sup>
                                                                    </span>
                                                                </span>
                                                            </span>

                                                        <span class="product-quantity cart-product__quantity">
                                                                    <span class="product-label">Số lượng:</span>
                                                                    <div class="quantity-option">
                                                                        <span class="quantity-icon" onclick="handleDecrement({{$item['product_id']}})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="3"
                                                                                 viewBox="0 0 8 1">
                                                                                <line id="Line_5" data-name="Line 5" x2="8"
                                                                                      transform="translate(0 0.5)" fill="none" stroke="#333"
                                                                                      strokeWidth="1"></line>
                                                                            </svg>
                                                                        </span>
                                                                        <span class="quantity-number" min="1" onchange="changeQuantity({{ $item['product_id'] }})">
                                                                            {{ $item['quantity'] }}
                                                                        </span>
                                                                        <span class="quantity-icon" onclick="handleIncrement({{$item['product_id']}})">
                                                                            <svg xmlns="http:www.w3.org/2000/svg" width="10" height="10"
                                                                                 viewBox="0 0 8 8">
                                                                                <g id="Group_162" data-name="Group 162"
                                                                                   transform="translate(14012 -3271)">
                                                                                    <line id="Line_6" data-name="Line 6" x2="8"
                                                                                          transform="translate(-14012 3275)" fill="none"
                                                                                          stroke="#333" strokeWidth="1"></line>
                                                                                    <line id="Line_7" data-name="Line 7" y2="8"
                                                                                          transform="translate(-14008 3271)" fill="none"
                                                                                          stroke="#333" strokeWidth="1"></line>
                                                                                </g>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </span>

                                                        <span class="product-money cart-product__money">
                                                                <span class="money-label">Thành tiền:</span>

                                                                <span>
                                                                    {{ number_format($subtotal, '0', '', '.') }}<sup>đ</sup>
                                                                </span>
                                                            </span>

                                                        <span class="product-remove cart-product__remove" onclick="removeItem({{ $item['product_id'] }})">
                                                                <svg id="trash-2" xmlns="http://www.w3.org/2000/svg" width="26"
                                                                     height="26" viewBox="0 0 24 24">
                                                                    <rect id="Rectangle_25" data-name="Rectangle 25" width="24"
                                                                          height="24" fill="#ff0e1f" opacity="0" />
                                                                    <path id="Path_55" data-name="Path 55"
                                                                          d="M21,6H16V4.33A2.42,2.42,0,0,0,13.5,2h-3A2.42,2.42,0,0,0,8,4.33V6H3A1,1,0,0,0,3,8H4V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,4.33c0-.16.21-.33.5-.33h3c.29,0,.5.17.5.33V6H10ZM18,19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V8H18Z"
                                                                          fill="#ff0e1f" />
                                                                    <path id="Path_56" data-name="Path 56"
                                                                          d="M9,17a1,1,0,0,0,1-1V12a1,1,0,0,0-2,0v4A1,1,0,0,0,9,17Z"
                                                                          fill="#ff0e1f" />
                                                                    <path id="Path_57" data-name="Path 57"
                                                                          d="M15,17a1,1,0,0,0,1-1V12a1,1,0,0,0-2,0v4A1,1,0,0,0,15,17Z"
                                                                          fill="#ff0e1f" />
                                                                </svg>
                                                            </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-12">
                                    <div class="cart__cover-endow" style="    margin-top: 25px;">
{{--                                        <div class="input-group">--}}
{{--                                            <input type="text" class="form-control cart__input-gift" placeholder="Mã giảm giá"--}}
{{--                                                   aria-label="Username" aria-describedby="button-addon1">--}}
{{--                                            <!-- <div class="input-group-text" id="basic-addon1"></div> -->--}}
{{--                                            <button class="btn  cart__cover-btn" type="button" id="button-addon1">--}}
{{--                                                Áp dụng--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
                                        <span class="cart__cover-endow-error"></span>

                                        <div class="cart__cover-endow-price">
                                            <p>
                                                <span>Tạm tính</span>
                                                <span class="cart__cover-endow-price-money">
                                                    <span class="total-cart-price">{{ number_format($total, '0', '', '.') }}</span>₫
                                                </span>
                                            </p>
                                            <p>
                                                <span>Giảm giá</span>
                                                <span class="cart__cover-endow-price-money">
                                                <span class="price-discount">0</span>₫</span>
                                            </p>
                                            <p class="cart__cover-endow-total">
                                                <span>Thành tiền</span>
                                                <span class="cart__cover-endow-price-money" style="color: #ee2724;">
                                                <span class="total-cart-cart">{{ number_format($total, '0', '', '.') }}</span>₫
                                            </span>
                                            </p>

                                            <span class="cart-vat">(Đã bao gồm VAT nếu có)</span>
                                        </div>

                                        <div class="text-right cart__table-btn-cover">
                                            <a class="btn cart__table-btn cart__table-btn-link" href="{{ route('user.checkout.index') }}">
                                                Tiến hành đặt hàng
                                            </a>
                                            <!-- <a id="thanhtoan2" class="btn btn-primary cart__table-btn cart__table-btn-pay"
                                                href="#">Tiến hành đặt hàng</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
        <!-- END Cart -->
    </main>
    <!-- End Content -->

@endsection

@section('js')
    <script src="{{asset('assets/user/assets/js/custom.js')}}"></script>
    <script>
        function removeItem(id) {
            swal({
                title: "Bạn có chắc muốn xóa sản phẩm này?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                cancelButtonText: 'Hủy',
            }).then((willDelete) => {
                if (willDelete) {
                    callAjax(
                        'GET',
                        '{{ route('user.cart.delete') }}?id='+id,
                        {},
                        (response) => {
                            if( response.status == true ) {
                                swal(response.message, {
                                    icon: "success",
                                });
                                $('#countCart').html('('+response.count+')');
                                $('#cartOrder').html(response.html);
                                $('#updateCart').html(response.show);
                            } else {
                                swal("Error!", response.message, "error");
                            }
                        }
                    )

                }
            });
        }

        function removeCart() {
            swal({
                title: "Bạn có chắc muốn xóa tất cả?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                cancelButtonText: 'Hủy',
            }).then((willDelete) => {
                if (willDelete) {
                    callAjax(
                        'GET',
                        '{{ route('user.cart.delete.all') }}',
                        {},
                        (response) => {
                            if( response.status == true ) {
                                swal(response.message, {
                                    icon: "success",
                                });
                                $('#countCart').html('('+response.count+')');
                                $('#cartOrder').html(response.html);
                                $('#updateCart').html(response.show);
                            } else {
                                swal("Error!", response.message, "error");
                            }
                        }
                    )

                }
            });

        }

       function changeQuantity(id) {
            callAjax(
                'GET',
                '{{ route('user.cart.update') }}?id='+id,
                {
                    'quantity' : $('#item'+id).find('.quantity-number').html(),
                },
                (response) => {
                    if( response.status == true ) {
                        $('#countCart').html('('+response.count+')');
                        $('#cartOrder').html(response.html);
                        $('#updateCart').html(response.show);
                    } else {
                        swal("Error!", response.message, "error");
                    }
                }
            )
       }

       $('.checkAll').click(function () {
            if(this.checked){
                $('input[name="inputCheck"]').each(function () {
                    this.checked = true;
                })
            }else{
                $('input[name="inputCheck"]').each(function () {
                    this.checked = false;
                })
            }
       })

        $('input[name="inputCheck"]').click(function () {
            var product_id = $(this).val();
            if($('.checkAll:checked').length == $('input[name="inputCheck').length){
                $('.checkAll').prop('checked',true);
            }else{
                $('.checkAll').prop('checked',false);
                callAjax(
                    'GET',
                    '{{ route('user.cart.remove') }}?product_id='+product_id,
                    {},
                    (response) => {
                        if( response.status == true ) {
                            $('#cartOrder').html(response.html);
                        } else {
                            swal("Error!", response.message, "error");
                        }
                    }
                )
            }
        })

    </script>


@endsection

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
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

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
                        <a class="breadcrumbs-link__sub">{{ $title }}</a>
                    </nav>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb -->

        <!-- START Cart -->
        <section class="cart payment">
            <div class="container-xl">
                <div class="cart-wrapper">
                    <div class="cart-header">
                        <h3 class="cart-header__title">
                            Thông tin khách hàng
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-12">
                            <div class="cart-product payment__form">
                                <form class="payment__info-customer" autocomplete="off">
                                    <div class="payment__info-group mb-4">
                                        <label for="NameInput" class="form-label">Họ tên <sup>*</sup></label>
                                        <input type="text" class="form-control" id="NameInput" placeholder="Họ và tên" name="name" value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="payment__info-group mb-4">
                                        <label for="PhoneInput" class="form-label">Số điện thoại <sup>*</sup></label>
                                        <div class="input-group">
                                            <input type="text" id="PhoneInput" class="form-control" name="phone" value="{{ auth()->user()->phone }}"
                                                   placeholder="Nhập số điện thoại" aria-describedby="basic-addon2">
                                            <!-- <button class="input-group-text btn-button" id="basic-addon2">Nhận mã xác
                                                thực</button> -->
                                        </div>
                                    </div>
                                    <div class="payment__info-group mb-4">
                                        <label for="EmailInput" class="form-label">Email <sup>*</sup></label>
                                        <input type="email" class="form-control" id="EmailInput" name="email"
                                               placeholder="Nhập email">
                                    </div>
                                    <div class="payment__info-group mb-4">
                                        <label for="addressInput" class="form-label">Địa chỉ <sup>*</sup></label>
                                        <input type="text" class="form-control" id="addressInput" name="address"
                                               placeholder="Nhập địa chỉ của bạn">
                                    </div>
                                    <div class="payment__info-group text-area mb-4">
                                        <label for="areaInput" class="form-label">Ghi chú</label>
                                        <textarea type="text" class="form-control" id="areaInput" placeholder="" name="note"
                                                  rows="7" cols="50"></textarea>
                                    </div>
                                </form>

                                <button type="button" class="btn payment__info-btn" onclick="orderCart()">
                                    Đặt hàng
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-12">
                            <div class="payment__info-order">
                                <div class="payment__info-header">
                                    <h3>Đơn hàng</h3>

                                    <a href="{{ route('user.cart') }}" class="payment__info-link">
                                        Chỉnh sửa
                                    </a>
                                </div>

                                <div class="payment__info-description">
                                    <div class="payment__info-number">
                                        {{ count($cart) }} sản phẩm
                                    </div>

                                    <ul class="payment__info-list">
                                        @foreach($cart as $item)
                                            @php
                                                $subtotal = $item['price'] * $item['quantity'];
                                                $total += $subtotal;
                                            @endphp
                                            <li class="payment__info-item">
                                                <span class="payment__info-quantity">{{ $item['quantity'] }}x</span>

                                                <p class="payment__info-name">
                                                    {{ $item['product_name'] }}
                                                </p>

                                                <span class="payment__info-price">
                                                                {{ number_format($item['price'], '0', '', '.') }}₫
                                                        </span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="payment__info-total">
                                        <p>
                                            Thành tiền
                                        </p>
                                        <span class="payment__info-money">
                                               {{ number_format($total, '0', '', '.') }}₫
                                        </span>
                                    </div>

                                    <p class="payment__info-note">(Đã bao gồm VAT nếu có)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- END Cart -->
    </main>
    <!-- End Content -->

@endsection

@section('js')

    <script>
        function orderCart() {
            swal({
                title: "Bạn có chắc muốn muốn đặt hàng?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                cancelButtonText: 'Hủy',
            }).then((willDelete) => {
                if (willDelete) {
                    callAjax(
                        'POST',
                        '{{ route('user.checkout.store') }}',
                        {
                            name: $('input[name="name"]').val(),
                            phone: $('input[name="phone"]').val(),
                            email: $('input[name="email"]').val(),
                            address: $('input[name="address"]').val(),
                            note: $('textarea[name="note"]').val(),
                        },
                        (response) => {
                            if( response.status == true ) {
                                swal("Success!", response.message, "success").then(function (isConfirm) {
                                    if(isConfirm){
                                        window.location.href = '{{ route('user.home.index') }}';
                                    }
                                });
                            } else {
                                swal("Error!", response.message, "error");
                            }
                        }
                    )
                }
            });

        }
    </script>

@endsection

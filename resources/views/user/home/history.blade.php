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
<!-- Begin Content -->
<main class="home">
    <!-- START Information -->
    <section class="info">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-3 col-md-0 col-sm-0">
                    @include('user.components.sidebars_user')
                </div>

                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="info-manage__header">
                        <div class="info-manage__header-wrapper">
                            <div class="info-body__title">Quản lý đơn hàng</div>
                        </div>
                    </div>

                    <div class="infoAcc-status">

                        <!-- Navigation Status -->
                        <nav class="infoAcc-status__nav">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <!-- Btn All -->
                                <button class="nav-link active"  onclick="changeTab(5)">
                                    Chờ thanh toán
                                </button>

                                <!-- Btn Confirm Wait -->
                                <button class="nav-link" onclick="changeTab(8)">
                                    Chờ giao hàng
                                </button>

                                <!-- Btn Wait Get Item -->
                                <button class="nav-link" onclick="changeTab(9)">
                                        Đã hoàn thành
                                </button>
                            </div>
                        </nav>

                        <div class="infoAcc-content tab-content" id="nav-tabContent">
                            <!-- Tab All -->
                            <div class="tab-pane fade show active" id="showOrder">
                                @if(count($orders) > 0)
                                    <div class="infoAcc-content__wapper">
                                        <div class="infoAcc-content__cover waitConfirm">
                                            <div class="infoAcc-content__list">
                                                <div class="infoAcc-content__item">
                                                    <div class="infoAcc-content__product">
                                                        <a href="#" class="infoAcc-content__img">
                                                            <img src=""
                                                                 alt="">
                                                        </a>
                                                        <div class="infoAcc-content__info">
                                                            <h4 class="infoAcc-content__title">
                                                                <a href="#"></a>
                                                            </h4>
                                                            <p class="infoAcc-content__quantity">
                                                                Số lượng:
                                                            </p>
                                                            <div class="infoAcc-content__money">
                                                                <span class="money-name">Giá tiền:</span>
                                                                <span class="money-new color-red">
                                                                        ₫
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="infoAcc-content__status">

                                            </p>

                                            <!-- Total Price -->
                                            <div class="infoAcc-content__price">
                                                <div class="infoAcc-content__total">
                                                    <p>Thành tiền:</p>

                                                    <span class="number-total color-red">
                                                        1.319.000₫
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="info-manage__body">
                                        <div height="200" width="200" class="info-manage__body-img">
                                            <img class="css-jdz5ak"
                                                 src="https://firebasestorage.googleapis.com/v0/b/mongcaifood.appspot.com/o/no-products-found.png?alt=media&amp;token=2f22ae28-6d48-49a7-a36b-e1a696618f9c"
                                                 loading="lazy" decoding="async">
                                        </div>
                                        <div class="info-manage__body-text">Bạn không có đơn hàng nào</div>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- END Information -->
</main>
<!-- End Content -->

@endsection

@section('js')

    <script>
        function changeTab(id) {
            callAjax(
                'GET',
                '{{ route('user.history.status') }}?id='+id,
                {},
                (response) => {
                    $('#showOrder').html(response.html);
                }
            )
        }
    </script>

@endsection

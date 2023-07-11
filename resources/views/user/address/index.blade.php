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
                    <div class="col-md-3 col-sm-0">
                       @include('user.components.sidebars_user')
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12">

                        <div class="info-address__header">
                            <div class="info-body__title">Sổ địa chỉ</div>

                        </div>

                        <button class="info-address__btn" onclick="create()">
                            <i class="fa-regular fa-plus"></i>
                            <div class="info-address__btn-spacer"></div>
                            Thêm địa chỉ mới
                        </button>

                        <div class="info-address">
                            <div class="info-address__row">
                                <div style="flex: 0 0 65%;">
                                    <div class="info-address__row">
                                        <div type="subtitle" class="info-address__name">NGUYEN DUC
                                            THIEN
                                        </div>
                                        <span class="info-right__address-default">
                                            <div type="caption" class="info-address__default">
                                                MẶC
                                                ĐỊNH
                                            </div>
                                        </span>
                                    </div>
                                    <div class="info-address__address">
                                        Địa chỉ: Cao Minh, Vĩnh Bảo, Phường Vĩnh Niệm, Quận Lê Chân, Thành
                                        phố
                                        Hải Phòng
                                    </div>
                                    <div class="info-right__address-phone">
                                        Điện thoại: 0853212490</div>
                                </div>
                                <div style="flex: 0 0 35%;">
                                    <div class="info-address__row info-address__row-end">
                                        <button class="info-right__address__btn" type="button">
                                            <div class="info-right__address-text">
                                                Chỉnh sửa</div>
                                        </button>
                                    </div>
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

    <!-- Modal -->
    <div class="modal fade info-modal" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true"></div>

    <div id="loader" class="lds-dual-ring load overlay_irt"></div>

@endsection

@section('js')

    <script>
        function create() {
            $this = $('#addressModal');
            callAjax(
                'GET',
                '{{ route('user.address.create') }}',
                {},
                (response) => {
                    $this.html(response.html);
                    $this.modal('show');
                }
            )
        }
    </script>

@endsection

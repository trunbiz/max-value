@php
$userAssign = auth()->user()->getFirstUserAssign();
$name = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->name : (optional(auth()->user()->manager)->name ?? (\App\Models\User::find(1)->name ?? null));
$email = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->email : (optional(auth()->user()->manager)->email ?? (\App\Models\User::find(1)->email ?? null));
$telegram = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->telegram : (optional(auth()->user()->manager)->telegram ?? (\App\Models\User::find(1)->telegram ?? null));
$skype = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->skype : (optional(auth()->user()->manager)->skype ?? (\App\Models\User::find(1)->skype ?? null));
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="google-site-verification" content="qnS8f1XIvnXPF-cd_GzUDuAxT0SxnpSrvzi_h6EO9v8" />
    <base href="{{asset('assets/publisher')}}/"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16"  href="/favicons/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32"  href="/favicons/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
    <link rel="icon" type="image/png" sizes="96x96"  href="/favicons/apple-touch-icon-96x96.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/favicons/android-icon-192x192.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_URL')}}"/>
    <meta property="og:description" content="{{env('APP_URL')}}"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>

    <title>@yield('title')</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="lib/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="lib/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="lib/apexcharts/apexcharts.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../administrator/css/vendors/flag-icon.css">
    <link rel="icon" type="image/x-icon" href="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}">
    <link rel="icon" href="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/sweetalert2.css')}}">


    <script src="<?php echo e(asset('/vendor/sweet-alert/sweetalert.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="lib/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style2.css">


    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="lib/jqueryui/jquery-ui.min.js"></script>
    <script src="lib/colorpicker/spectrum.js"></script>
    <script src="lib/select2/js/select2.full.min.js"></script>
    <script src="lib/prismjs/prism.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="assets/js/scriptHeader.js"></script>


    <!-- Vendor CSS -->
    <link rel="stylesheet" href="lib/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="lib/cryptofont/css/cryptofont.min.css">
    <link rel="stylesheet" href="lib/apexcharts/apexcharts.css">
    <!-- Template CSS -->
    <script src="{{asset('vendor/sweet-alert/sweetalert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/helper/main_helper.js')}}"></script>

    <style>
        #loading .modal-dialog{
            position: relative;
            margin: auto;
            margin-top: 10%;
            padding: 20px;
            background-color: #fefefe;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .form-control, .select2-container, .form-group{
            margin: 10px 0;
        }
        .navbar-expand-lg .container-fluid .navbar-filter-mobi{
            display: none !important;
        }
        .col-6{
            padding: 5px;
        }

        /*.main-footer {*/
        /*    position: absolute;*/
        /*    width: 80%;*/
        /*    clear: both;*/
        /*    padding-top: 20px;*/
        /*    bottom: 0;*/
        /*}*/
        @media only screen and (max-width: 600px) {
            .navbar-expand-lg .container-fluid .navbar-filter-mobi {
                display: block !important;
            }
            .navbar-expand-lg .container-fluid .navbar-filter-mobi ul {
                flex-direction: row;
            }
            .navbar-expand-lg .container-fluid .navbar-filter-mobi ul li{
                margin-right: 10px;
            }
            .navbar-filter{
                display: none;
            }
        }



    </style>

</head>
<body>

<div class="sidebar sidebar-dark">
    <div class="sidebar-header">
        <a href="/" class="sidebar-logo">Max Value</a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Dashboard</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{route('user.dashboard.index')}}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"><i
                            class="ri-bar-chart-2-fill"></i> <span>Overview</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
        <div class="nav-group show">
            <a href="#" class="nav-label">Applications</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{route('user.websites.index')}}"
                       class="nav-link {{ request()->is('websites') ? 'active' : '' }}"><i class="ri-ie-fill"></i>
                        <span>Websites & Zones</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.advertises.index')}}"
                       class="nav-link {{ (request()->is('advs')) ? 'active' : '' }}"><i class="ri-file-edit-fill"></i>
                        <span>Ads.txt</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.wallet_users.index')}}"
                       class="nav-link {{ (request()->is('wallet')) ? 'active' : '' }}"><i class="ri-wallet-fill"></i>
                        <span>Wallet</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.faqs')}}"
                       class="nav-link {{ (request()->is('faqs')) ? 'active' : '' }}"><i class="ri-questionnaire-fill"></i>
                        <span>FAQ</span></a>
                </li>
                @if(session()->has('hasClonedUser'))
                    <li class="nav-item">
                        <a href="#"
                           onclick="event.preventDefault(); document.getElementById('cloneuser-form').submit();"
                           class="nav-link"><i class="ri-logout-box-fill"></i>
                            <span>Return admin</span></a>

                        <form id="cloneuser-form" action="{{ route('administrator.returnImpersonateAdmin') }}"
                              method="POST">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
        </div><!-- nav-group -->
    </div><!-- sidebar-body -->
    <div class="sidebar-footer">
        <div class="sidebar-footer-top">
            <div class="sidebar-footer-thumb">
{{--                <img src="assets/img/img1.jpg" alt="">--}}
                <img src="assets/img/support.png" alt="">
            </div><!-- sidebar-footer-thumb -->
            <div class="sidebar-footer-body">
                <h6>{{$name}}</h6>
                <p>Account Manager</p>
            </div><!-- sidebar-footer-body -->
        </div><!-- sidebar-footer-top -->
        <div class="sidebar-footer-menu">
            <nav class="nav">
                <a href="mailto:{{$email}}" title="mail"><i class="ri-mail-line btn btn-outline-danger border-0"></i>
                    Gmail</a>
                @if(!empty($telegram))
                    <a href="{{$telegram}}" title="Telegram"><i
                            class="ri-send-plane-fill btn btn-outline-info border-0"></i> Telegram</a>
                @endif
                @if(!empty($skype))
                    <a href="{{$skype}}" title="Skype"><i class="ri-skype-line btn btn-outline-primary border-0"></i>
                        Skype</a>
                @endif
                <a href="javascript:void(0)" title="Time UTC"><i class="ri-time-fill btn btn-outline-info border-0"></i><span class="timeUTC" style="color: rgba(255, 255, 255, 0.6)"></span></a>
            </nav>
        </div><!-- sidebar-footer-menu -->
    </div><!-- sidebar-footer -->
</div><!-- sidebar -->

<div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

    <div class="form-search me-auto" style="background: none">

    </div><!-- form-search -->
    <div class="dropdown dropdown-notification ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i
                class="ri-notification-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f me--10-f">
            <div class="dropdown-menu-header">
                <h6 class="dropdown-menu-title">Notifications</h6>
            </div><!-- dropdown-menu-header -->
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="avatar online"><img src="assets/img/user.png" alt=""></div>
        </a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <div class="dropdown-menu-body">
                <div class="avatar avatar-xl online mb-3"><img src="assets/img/user.png" alt=""></div>
                <h5 class="mb-1 text-dark fw-semibold" style="word-wrap: break-word;">{{\Illuminate\Support\Facades\Auth::user()->email ?? ''}}</h5>
                <p class="fs-sm text-secondary">Member (<strong>{{\Illuminate\Support\Facades\Auth::user()->code ?? ''}}</strong>)</p>
                <nav class="nav">
                    <a href="{{route('user.settings.index')}}"><i class="ri-user-settings-line"></i> Account
                        Settings</a>
                    <a href="{{route('user.logout')}}"><i class="ri-logout-box-r-line"></i> Log Out</a>
                </nav>
            </div><!-- dropdown-menu-body -->
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
</div><!-- header-main -->

<div class="main main-app p-3 p-lg-4">
    @yield('content')
    <div class="row mt-3">
        <div class="col-sm-12">
            <div id="widget-referral">
                <button type="button" class="btn ringing" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-html="true" data-bs-content-id="popover-content">
                    <img src="assets/img/referal-bonus-maxvalue.gif" style="width: 100px">
                </button>
                <div id="popover-content" class="d-none">
                    <span>Code: </span><strong class="text-copy">{{\Illuminate\Support\Facades\Auth::user()->code}} </strong><br>
                    <span>Link referral: </span><br><strong class="text-copy">{{config('app.url', '') .'/'.\Illuminate\Support\Facades\Auth::user()->code}} </strong>
                    <a target="_blank" href="{{config('app.url', '') .'/'.\Illuminate\Support\Facades\Auth::user()->code}}"><i class="ri-external-link-line"></i></a>
                </div>
            </div>
        </div>
    </div>
</div><!-- main -->
<!-- Modal -->
<div class="modal fade" id="loading" tabindex="-1" aria-labelledby="loading" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">
                <h4>Waiting ...</h4>
                <div class="spinner-grow text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-warning" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // $('.select-multiple').select2();

        // $( '.select-multiple' ).select2( {
        //     theme: "bootstrap-5",
        //     width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        //     placeholder: $( this ).data( 'placeholder' ),
        //     closeOnSelect: false,
        // } );
        updateUTCTime();
        function updateUTCTime() {
            var now = new Date();
            var hours = now.getUTCHours();
            var minutes = now.getUTCMinutes();
            var seconds = now.getUTCSeconds();

            // Định dạng thời gian để hiển thị
            var formattedTime = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);

            // Gán giá trị vào phần tử HTML
            $(".timeUTC").text("UTC: " + formattedTime);
        }
        // Hàm để thêm số 0 phía trước nếu cần
        function pad(num) {
            return (num < 10 ? "0" : "") + num;
        }

        setInterval(updateUTCTime, 1000);
    });
    function callAjax(method, url, data, success) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            type: method,
            url: url,
            beforeSend: function () {
                $('#loader').removeClass('loading');
            },
            success: function (response, textStatus, jqXHR) {
                success(response);
            },
            complete: function () {
                $('#loader').addClass('loading');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        })
    }
</script>

<script src="assets/js/script.js"></script>
<script src="assets/js/script2.js"></script>
<script src="lib/chart.js/chart.min.js"></script>
</body>
</html>

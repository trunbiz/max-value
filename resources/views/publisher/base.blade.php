<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{asset('assets/publisher')}}/"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ \App\Models\Helper::logoImagePath() }}">
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_URL')}}"/>
    <meta property="og:description" content="{{env('APP_URL')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

    <title>@yield('title')</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="lib/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="lib/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="lib/apexcharts/apexcharts.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../administrator/css/vendors/flag-icon.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="lib/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="lib/apexcharts/apexcharts.min.js"></script>
    <script src="lib/jqueryui/jquery-ui.min.js"></script>
    <script src="lib/colorpicker/spectrum.js"></script>
    <script src="lib/select2/js/select2.full.min.js"></script>
    <script src="lib/prismjs/prism.js"></script>
</head>
<body>

<div class="sidebar">
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
                    <a href="{{route('user.websites.index')}}" class="nav-link {{ request()->is('websites') ? 'active' : '' }}"><i class="ri-ie-fill"></i> <span>Websites & Zones</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.websites.index')}}" class="nav-link"><i class="ri-file-edit-fill"></i> <span>Ads.txt</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.websites.index')}}" class="nav-link"><i class="ri-wallet-fill"></i> <span>Wallet</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.websites.index')}}" class="nav-link"><i class="ri-logout-box-fill"></i>
                        <span>Return admin</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
    </div><!-- sidebar-body -->
    <div class="sidebar-footer">
        <div class="sidebar-footer-top">
            <div class="sidebar-footer-thumb">
                <img src="assets/img/img1.jpg" alt="">
            </div><!-- sidebar-footer-thumb -->
            <div class="sidebar-footer-body">
                <h6><a href="../pages/profile.html">Shaira Diaz</a></h6>
                <p>Premium Member</p>
            </div><!-- sidebar-footer-body -->
            <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
        </div><!-- sidebar-footer-top -->
        <div class="sidebar-footer-menu">
            <nav class="nav">
                <a href=""><i class="ri-edit-2-line"></i> Edit Profile</a>
                <a href=""><i class="ri-profile-line"></i> View Profile</a>
            </nav>
            <hr>
            <nav class="nav">
                <a href=""><i class="ri-question-line"></i> Help Center</a>
                <a href=""><i class="ri-lock-line"></i> Privacy Settings</a>
                <a href=""><i class="ri-user-settings-line"></i> Account Settings</a>
                <a href=""><i class="ri-logout-box-r-line"></i> Log Out</a>
            </nav>
        </div><!-- sidebar-footer-menu -->
    </div><!-- sidebar-footer -->
</div><!-- sidebar -->

<div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

    <div class="form-search me-auto">
        <input type="text" class="form-control" placeholder="Search">
        <i class="ri-search-line"></i>
    </div><!-- form-search -->

    <div class="dropdown dropdown-skin">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i
                class="ri-settings-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <label>Skin Mode</label>
            <nav id="skinMode" class="nav nav-skin">
                <a href="" class="nav-link active">Light</a>
                <a href="" class="nav-link">Dark</a>
            </nav>
            <hr>
            <label>Sidebar Skin</label>
            <nav id="sidebarSkin" class="nav nav-skin">
                <a href="" class="nav-link active">Default</a>
                <a href="" class="nav-link">Prime</a>
                <a href="" class="nav-link">Dark</a>
            </nav>
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->

    <div class="dropdown dropdown-notification ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><small>3</small><i
                class="ri-notification-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f me--10-f">
            <div class="dropdown-menu-header">
                <h6 class="dropdown-menu-title">Notifications</h6>
            </div><!-- dropdown-menu-header -->
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="avatar online"><img src="assets/img/img10.jpg" alt=""></div>
                    <div class="list-group-body">
                        <p><strong>Dominador Manuel</strong> and <strong>100 other people</strong> reacted to your
                            comment "Tell your partner that...</p>
                        <span>Aug 20 08:55am</span>
                    </div><!-- list-group-body -->
                </li>
                <li class="list-group-item">
                    <div class="avatar online"><img src="assets/img/img11.jpg" alt=""></div>
                    <div class="list-group-body">
                        <p><strong>Angela Ighot</strong> tagged you and <strong>9 others</strong> in a post.</p>
                        <span>Aug 18 10:30am</span>
                    </div><!-- list-group-body -->
                </li>
                <li class="list-group-item">
                    <div class="avatar"><span class="avatar-initial bg-primary">a</span></div>
                    <div class="list-group-body">
                        <p>New listings were added that match your search alert <strong>house for rent</strong></p>
                        <span>Aug 15 08:10pm</span>
                    </div><!-- list-group-body -->
                </li>
                <li class="list-group-item">
                    <div class="avatar online"><img src="assets/img/img14.jpg" alt=""></div>
                    <div class="list-group-body">
                        <p>Reminder: <strong>Jerry Cuares</strong> invited you to like <strong>Cuares Surveying
                                Services</strong>. <br><a href="">Accept</a> or <a href="">Decline</a></p>
                        <span>Aug 14 11:50pm</span>
                    </div><!-- list-group-body -->
                </li>
                <li class="list-group-item">
                    <div class="avatar online"><img src="assets/img/img15.jpg" alt=""></div>
                    <div class="list-group-body">
                        <p><strong>Dyanne Aceron</strong> reacted to your post <strong>King of the Bed</strong>.</p>
                        <span>Aug 10 05:30am</span>
                    </div><!-- list-group-body -->
                </li>
            </ul>
            <div class="dropdown-menu-footer"><a href="">Show all Notifications</a></div>
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="avatar online"><img src="assets/img/img1.jpg" alt=""></div>
        </a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <div class="dropdown-menu-body">
                <div class="avatar avatar-xl online mb-3"><img src="assets/img/img1.jpg" alt=""></div>
                <h5 class="mb-1 text-dark fw-semibold">{{\Illuminate\Support\Facades\Auth::user()->email ?? ''}}</h5>
                <p class="fs-sm text-secondary">Member</p>

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
<script src="assets/js/db.data.js"></script>
<script src="assets/js/db.analytics.js"></script>

</body>
</html>

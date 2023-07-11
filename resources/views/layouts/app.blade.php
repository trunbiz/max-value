<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Pham Son" name="author">

    <meta name="keyword" content="{{ config('app.name', 'Laravel') }}">
    <meta name="promotion" content="{{ config('app.name', 'Laravel') }}">
    <meta name="Description" content="{{ config('app.name', 'Laravel') }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ \App\Models\Helper::logoImagePath() }}">
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/prism.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/whether-icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/owlcarousel/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/rating/rating.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/fontawesome-6.0.0/css/fontawesome.css')}}"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('vendor/datetimepicker/daterangepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('vendor/select2/select2.min.css')}}"/>
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('/assets/administrator/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/responsive.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/order-image.css')}}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="{{asset('/assets/administrator/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/jquery.ui.min.js')}}"></script>
    <script src="{{asset('/vendor/jquery-ui-1.13.2/jquery-ui.js')}}"></script>
    <script src="{{asset('/vendor/masknumber/jquery.masknumber.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @include('administrator.components.helper')

    @yield('css')
</head>
<body class="rtl">
    @yield('content')


    <!-- Bootstrap js-->
    <script src="{{asset('/assets/administrator/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('/assets/administrator/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{asset('/assets/administrator/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('/assets/administrator/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/prism/prism.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/general-widget.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/tooltip-init.js')}}"></script>
    <script src="{{asset('/vendor/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{asset('vendor/sweet-alert-2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/datetimepicker/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/datetimepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/helper/main_helper.js')}}"></script>

    <!-- Plugins JS Ends-->

{{--    <!-- Plugin used-->--}}
{{--    <script src="{{asset('/vendor/rating/jquery.barrating.js')}}"></script>--}}
{{--    <script src="{{asset('/vendor/rating/rating-script.js')}}"></script>--}}
{{--    <script src="{{asset('/vendor/ecommerce.js')}}"></script>--}}
{{--    <script src="{{asset('/vendor/product-list-custom.js')}}"></script>--}}
{{--    <script src="{{asset('/vendor/script.js')}}"></script>--}}
{{--    <script src="{{asset('/vendor/theme-customizer/customizer.js')}}"></script>--}}

    <!-- Theme js-->
{{--    <script src="{{asset('/assets/administrator/js/script.js')}}"></script>--}}
{{--    <script src="{{asset('/assets/administrator/js/theme-customizer/customizer.js')}}"></script>--}}

    @yield('js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Infinity Ltd" name="description">
    <meta content="Pham Son" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ \App\Models\Helper::logoImagePath() }}">
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_URL')}}"/>
    <meta property="og:description" content="{{env('APP_URL')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

    @yield('css')
<!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">

    {{--    Bootstrap 3--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- fontAwesome Css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/user/css/style.css')}}">
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
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/style-update.css')}}" >

    <script src="{{asset('/assets/administrator/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/jquery.ui.min.js')}}"></script>
    <script src="{{asset('/vendor/jquery-ui-1.13.2/jquery-ui.js')}}"></script>
    <script src="{{asset('/vendor/masknumber/jquery.masknumber.js')}}"></script>

    <script src="{{asset('/assets/user/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icon-css@3.5.0/css/flag-icon.min.css">
    @include('user.components.helper')

    <style>
        .product-table{
            overflow-x: auto !important;
        }

        .product-table > table > tbody > tr td:last-child {
            width: 1%;
            white-space: nowrap;
        }

        .product-table > table > tbody > tr td:first-child {
            width: 1%;
            white-space: nowrap;
            text-align: start;
        }

        .fa {
            font-family: 'FontAwesome';
        }

        .list-products .product-table table th {
            min-width: 0 !important;
        }

        .customizer-links{
            display: none;
        }

        .simplebar-content-wrapper{
            overflow: visible;
        }

        .rounded-circle {
            height: 40px;
            width: 40px;
            object-fit: cover;
        }

        .simplebar-offset{
            height: 100% !important;
        }
        .form-control{
            height: 34px;
        }

    </style>

</head>

<body>

@include('user.components.header')

<main id="main">
    @yield('content')
    <div id="loader" class="lds-dual-ring loading overlay_irt"></div>
</main>

<!-- JAVASCRIPT -->
</div>
</div>

<script src="{{asset('/assets/user/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/user/js/apex-chart.js')}}"></script>
<script src="{{asset('/assets/user/js/moment.min.js')}}"></script>
<script src="{{asset('/assets/user/js/daterangepicker.min.js')}}"></script>
<script src="{{asset('/vendor/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('/vendor/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('/vendor/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('/vendor/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{asset('/assets/user/js/eyePass.js')}}"></script>
<script src="{{asset('/assets/user/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('/assets/user/js/select2.full.min.js')}}"></script>
<script src="{{asset('/assets/user/js/select2-custom.js')}}"></script>
<script src="{{asset('/assets/user/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/helper/main_helper.js')}}"></script>
<script>
    function viewBirthOfDay() {

        const searchParams = new URLSearchParams(window.location.search)
        searchParams.set('date_of_birth', new Date().toISOString().slice(0, 10))
        window.location.search = searchParams.toString()
    }

    function isEmptyInput(id, is_alert = false, message_alert = "", is_focus = false){
        if (!$('#' + id).val().trim()) {
            if(is_alert){
                alert(message_alert)
            }

            if(is_focus){
                $('#' + id).focus()
            }

            return true
        }
        return false
    }

    function callAjaxMultipart(method = "GET", url, data, success, error, on_process = null, is_loading = true){
        $.ajax({
            type: method,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            url: url,
            beforeSend: function () {
                if(is_loading){
                    showLoading()
                }
            },
            success: function (response) {
                if(is_loading){
                    hideLoading()
                }
                success(response)
            },
            error: function (err) {
                if(is_loading){
                    hideLoading()
                }
                Swal.fire(
                    {
                        icon: 'error',
                        title: err.responseText,
                    }
                );
                error(err)
            },
            xhr:function (){
                // get the native XmlHttpRequest object
                var xhr = $.ajaxSettings.xhr() ;
                // set the onprogress event handler
                xhr.upload.onprogress = function(evt){
                    // console.log('progress', evt.loaded/evt.total*100)

                    if (on_process){
                        on_process(evt.loaded/evt.total*100)
                    }

                } ;
                // set the onload event handler
                xhr.upload.onload = function(){

                } ;
                // return the customized object

                return xhr ;
            }
        });
    }

    function callAjax(method = "GET", url, data, success, error, is_loading = true){
        $.ajax({
            type: method,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            data: data,
            url: url,
            beforeSend: function () {
                if(is_loading){
                    showLoading()
                }
            },
            success: function (response) {
                if(is_loading){
                    hideLoading()
                }
                success(response)
            },
            error: function (err) {
                if(is_loading){
                    hideLoading()
                }
                Swal.fire(
                    {
                        icon: 'error',
                        title: err.responseText,
                    }
                );
                error(err)
            },
        });
    }

    function hideModal(id){
        $('#' + id).modal('hide');
    }

    function showModal(id){
        $('#' + id).modal('show');
    }

    function isCheckedInput(id){
        return $("#" + id).is(":checked") == "true" || $("#" + id).is(":checked") == true
    }

    $("input.number").maskNumber({
        integer: true
    })

</script>

@yield('js')

</body>


</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ \App\Models\Helper::logoImagePath() }}">

    <!-- fontAwesome Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('assets/user/assets/css/all.min.css')}}" />
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{asset('assets/user/assets/css/swiper-bundle.min.css')}}" />
    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/assets/css/bootstrap.min.css')}}" />

    <!-- Font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('/assets/user/assets/css/private.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/user/assets/css/othercss.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/user/assets/css/style.css')}}" />
</head>

<body>
<!-- Begin Content -->
<main class="home">
    <!-- START Account -->
    <section class="account" style="background-image: url(https://identity.teko.vn/assets/background.svg);">
        <div class="container-xl">
            <div class="account-wrapper">
                <form id="registerForm" autocomplete="off">
                    <div class="account-form">
                        <div class="account-form__logo">
                            <img src="https://lh3.googleusercontent.com/pecvEPwX9W2P6kAicqOv5KDBZ60Qw4HImnI5qzIzybqpmKRZBEtKWHHnXs2ZBer-clfeTkcFHbuyJVfnetl_M2M7zHwN6blk"
                                 alt="">
                        </div>

                        <h3 class="account-form__title">
                            Tạo tài khoản
                        </h3>

                        <div class="account-form__line">
                            Nhập thông tin tài khoản
                        </div>

                        <div class="account-form__group payment__info-group">
                            <input type="text" class="form-control" id="phoneInput" name="phone"
                                   placeholder="Số điện thoại *">
                        </div>

                        <div class="account-form__group payment__info-group">
                            <input type="password" class="form-control" name="password" id="passInput" placeholder="Mật khẩu *">
                        </div>

                        <div class="account-form__group payment__info-group">
                            <input type="password" class="form-control" id="confirmPassInput" placeholder="Nhập lại mật khẩu *" name="confirm_password">
                        </div>

{{--                        <div class="form-check account-form__check">--}}
{{--                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">--}}
{{--                            <label class="form-check-label" for="flexCheckChecked">--}}
{{--                                Hiển thị mật khẩu--}}
{{--                            </label>--}}
{{--                        </div>--}}

                        <div class="account-form__group payment__info-group">
                            <input type="text" class="form-control" id="nameInput" placeholder="Tên *" name="name">
                        </div>

                        {{--                    <a href="#" class="account-form__link">--}}
                        {{--                        Kích hoạt tài khoản--}}
                        {{--                    </a>--}}

                        <button class="account-form__btn">
                            Tạo tài khoản
                        </button>

                        <a href="{{ route('user.index.login') }}" class="account-form__register">
                            Đăng nhập
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <div id="loader" class="lds-dual-ring load overlay_irt"></div>
    <!-- END Account -->
</main>
<!-- End Content -->

<!-- Jquery JS -->
<script type="text/javascript" src="{{asset('assets/user/assets/js/Library/jquery.min.js')}}"></script>
<!-- Script Bootstrap -->
<script type="text/javascript" src="{{asset('assets/user/assets/js/Library/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('vendor/sweet-alert/sweetalert.min.js')}}"></script>

<script src="{{asset('assets/user/assets/js/custom.js')}}"></script>

<script>
    $('#registerForm').on('submit', function (e) {
        e.preventDefault();
        var $this = $(this);
        callAjax(
            'POST',
            '{{ route('user.index.post.register') }}',
            $this.serialize(),
            (response) => {
                if( response.status == true ) {
                    swal("Success!", response.message, "success").then(function (isConfirm) {
                        if(isConfirm){
                            window.location.href = '{{ route('user.home.index') }}'
                        }
                    });
                } else {
                    swal("Error!", response.message, "error");
                }
            }
        )
    })
</script>

</body>

</html>

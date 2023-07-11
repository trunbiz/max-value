@extends('layouts.app')

@section('content')

    <style>
        .col-xl-7 {
            background-size: contain !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            max-height: 50vh;
            margin-top: 25vh;
            position: relative;
        }
    </style>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-ball"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid p-0">
            <div class="row m-0">

                <div class="col-xl-7 p-0 bg-left">
                    <h1 style="position: absolute;top: 0;transform: translateX(-50%);left: 50%;">
                        Register
                    </h1>
                    <img class="bg-img-cover bg-center"
                                                       src="{{asset('assets/images/login.svg')}}" alt="looginpage">
                </div>
                <div class="col-xl-5 p-0">
                    <div class="login-card">
                        <form class="theme-form login-form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <h4>Create your account</h4>
                            <h6>Enter your personal details to create account</h6>

                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="icon-email"></i></span>
                                    <input name="email" class="form-control @error('email') is-invalid @enderror"
                                           type="email" required="" placeholder>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                           name="password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--                        <div class="form-group">--}}
                            {{--                            <label>Capcha</label>--}}
                            {{--                            <div class="small-group">--}}
                            {{--                                <div class="input-group">--}}
                            {{--                                    <span class="captcha-image">{!! \Mews\Captcha\Facades\Captcha::img() !!}</span>--}}
                            {{--                                </div>--}}
                            {{--                                <div>--}}
                            {{--                                    <input id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" type="text" required placeholder="capcha">--}}
                            {{--                                    @error('captcha')--}}
                            {{--                                    <span class="invalid-feedback" role="alert">--}}
                            {{--                                        <strong>{{ $message }}</strong>--}}
                            {{--                                    </span>--}}
                            {{--                                    @enderror--}}

                            {{--                                    <a onclick="refreshCapcha()" class="text-sm-start" href="javascript:void(0)"--}}
                            {{--                                       style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center">Refresh</a>--}}

                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="form-group">
                                <div>
                                    <label>
                                        By way Continue you Agree with
                                        <a href="#">
                                            our Privacy Policy
                                        </a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                            </div>

                            <p>Already have an account?<a class="ms-2" href="{{route('login')}}">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-wrapper end-->

    <!-- wrapper, to center website -->

@endsection

@section('js')
    <script>

        function refreshCapcha() {
            $.ajax({
                type: 'get',
                url: '{{ route('refreshCaptcha') }}',
                success: function (data) {
                    $('.captcha-image').html(data.captcha);
                }
            });
        }
    </script>

    <!-- Theme js-->
    <script src="{{asset('/assets/administrator/js/script.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/theme-customizer/customizer.js')}}"></script>
@endsection


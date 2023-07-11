@extends('layouts.app')

@section('content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5 b-center" style="background-color: rgba(99,98,231,0.1);background-image: url('{{asset('/assets/images/sign_up.jpg')}}'); background-size: contain; background-position: center center; display: block; background-repeat: no-repeat"><img class="bg-img-cover bg-center" src="../assets/images/login/3.jpg" alt="looginpage" style="display: none;"></div>


                <div class="col-xl-7 p-0">
                    <div class="login-card">
                        <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h4>Login</h4>
                            <h6>Welcome back! Log in to your account.</h6>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" required value="{{ old('email') }}" autofocus>
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
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Remember password</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="link" href="{{ route('password.request') }}">Forgot password?</a>
                                @endif


                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                            </div>
                            <p>Don't have account?<a class="ms-2" href="{{ route('register') }}">Create Account</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

<script src="{{asset('administrator/assets/libs/jquery/jquery.min.js')}}"></script>

<script>


    $(document).ready(function () {
        $('#flexCheckDefault').change(function () {
            if (this.checked) {
                $('.button-register').prop('disabled', false);
            } else {
                $('.button-register').prop('disabled', true);
            }
        });
    });

</script>

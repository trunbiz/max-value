@extends('layouts.app')

@section('content')
    <div style="background-color: rgba(99,98,231,0.1);height: 100vh;">

        <div class="account-pages pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-4">
                                    <div class="mb-3">
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h4 class="font-size-18 mt-2 text-center">Reset Password</h4>
                                    <p class="text-muted text-center mb-4">Enter your Email and instructions will be
                                        sent to you!</p>

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}" class="form-horizontal">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                                   autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="text-end">
                                                <button class="btn btn-primary w-md waves-effect waves-light"
                                                        type="submit">Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                <div class="mt-5 text-center position-relative">
                                    <p class="text-black">Remember It ? <a href="{{route('login')}}"
                                                                           class="font-weight-bold text-primary"> Sign In
                                            Here </a></p>
                                    <p class="text-black-50">
                                        <script>document.write(new Date().getFullYear())</script>
                                        © {{ config('app.name', 'Laravel') }}.
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{asset('assets/publisher')}}/"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}">
    <link rel="icon" type="image/x-icon" href="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}">

    <title>Maxvalue.media - login</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="lib/remixicon/fonts/remixicon.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>
<body class="page-sign">

<div class="card card-sign">
    <div class="card-header">
        <a href="{{asset('/')}}" class="header-logo mb-4">Maxvalue</a>
        <h3 class="card-title">Login</h3>
        <p class="card-text">Welcome back! Please login to continue.</p>
    </div><!-- card-header -->
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Email address</label>
                <input type="text" class="form-control" name="email" placeholder="Enter your email address">
            </div>
            <div class="mb-4">
                <label class="form-label d-flex justify-content-between">Password <a
                        href="{{ route('password.request') }}">Forgot password?</a></label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password">
            </div>
            <button class="btn btn-primary btn-sign">Login</button>
        </form>
    </div><!-- card-body -->
    <div class="card-footer">
        Don't have an account? <a href="{{ route('register') }}">Create an Account</a>
    </div><!-- card-footer -->
</div><!-- card -->

<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    'use script'

    var skinMode = localStorage.getItem('skin-mode');
    if (skinMode) {
        $('html').attr('data-skin', 'dark');
    }
</script>
</body>
</html>

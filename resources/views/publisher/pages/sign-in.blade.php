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

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicons/favicon.png">
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

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

    <title>Maxvalue.media - forgot password</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="lib/remixicon/fonts/remixicon.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>
<body class="page-auth">

<div class="header">
    <div class="container">
        <a href="{{asset('/')}}" class="header-logo">Maxvalue</a>
    </div><!-- container -->
</div><!-- header -->

<div class="content">
    <div class="container">
        <div class="card card-auth">
            <div class="card-body text-center">
                @error('email')
                <span class="alert alert-danger" role="alert">
                <strong>We can't find a user with that email address.</strong>
                </span>
                @enderror
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" class="form-horizontal">
                    @csrf
                    <div class="mb-5">
                        <object type="image/svg+xml" data="assets/svg/forgot_password.svg" class="w-50"></object>
                    </div>
                    <h3 class="card-title">Reset your password</h3>
                    <p class="card-text mb-5">Enter your username or email address and we will send you a link to reset
                        your
                        password.</p>

                    <div class="row g-2">
                        <div class="col-sm-8"><input type="text"
                                                     class="form-control @error('email') is-invalid @enderror"
                                                     placeholder="Email" name="email" id="email">
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary">Reset</button>
                        </div>
                    </div><!-- row -->
                </form>
            </div><!-- card-body -->
        </div><!-- card -->
    </div><!-- container -->
</div><!-- content -->

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

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{asset('assets/publisher')}}/"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ \App\Models\Helper::logoImagePath() }}">
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_URL')}}"/>
    <meta property="og:description" content="{{env('APP_URL')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

    <title>Maxvalue.media - Login</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="lib/remixicon/fonts/remixicon.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.min.css">
    <script type="text/javascript" src="{{asset('assets/helper/main_helper.js')}}"></script>
    <style>
        @media (min-width: 768px) {
            .card-sign {
                width: 600px;
            }
        }
    </style>
</head>
<body class="page-sign">

<div class="card card-sign">
    <div class="card-header">
        <a href="{{asset('/')}}" class="header-logo mb-4">Maxvalue</a>
        <h3 class="card-title">Sign Up</h3>
        <p class="card-text">It's free to signup and only takes a minute.</p>
    </div><!-- card-header -->
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address (<span class="text-danger">*</span>)</label>
                <input type="text" name="email" class="form-control" required placeholder="Enter your email address">
            </div>
            <div class="mb-3">
                <label class="form-label">Password (<span class="text-danger">*</span>)</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter your password">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone number (<span class="text-danger">*</span>)</label>
                <input type="text" name="phone" class="form-control" required placeholder="Enter your phone number">
            </div>
            <div class="mb-3">
                <label class="form-label">Referral code</label>
                <input type="text" name="referral_code" class="form-control" placeholder="Referral code" value="">
            </div>
            <div class="mb-3 row">
                <div class="col-3">
                    <label class="form-label">Messenger</label>
                    <select name="style_messenger" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="SKYPE">Skype</option>
                        <option value="TELEGRAM">Telegram</option>
                        <option value="WHATSAPP">WhatsApp</option>
                    </select>
                </div>
                <div class="col-9">
                    <label class="form-label">Nickname in messenger</label>
                    <input type="text" name="nick_messenger" class="form-control" placeholder="Nickname" value="">
                </div>
            </div>
            <div class="alert alert-primary" role="alert">
                For a faster approval process, please provide the following additional information.
            </div>
            <div class="mb-3">
                <label class="form-label">Url website (<span class="text-danger">*</span>)</label>
                <input type="text" name="url" class="form-control" required placeholder="https://example.com" value="">
            </div>
            <div class="mb-3">
                <label for="impression" class="">Monthly impression/pageview</label>
                <input type="number" name="impression" class="form-control impression" placeholder="1.000.000">
            </div>
            <div class="mb-3">
                <label for="geo" class="">Top geo</label>
                <input type="text" name="geo" class="form-control" placeholder="US, UK, ..." value="">
            </div>
{{--            <div class="mb-3">--}}
{{--                <label for="file_report" class="">File Report</label>--}}
{{--                <input type="file" class="form-control file_report" name="file_report">--}}
{{--                <div class="form-text">Please tell us about your site's charts and reports.</div>--}}
{{--            </div>--}}

            <div class="mb-4">
                <small>By clicking <strong>Create Account</strong> below, you agree to our terms of service and privacy
                    statement.</small>
            </div>
            <button class="btn btn-primary btn-sign">Create Account</button>
        </form>
    </div><!-- card-body -->
    <div class="card-footer">
        Already have an account? <a href="{{ route('login') }}">Sign In</a>
    </div><!-- card-footer -->
</div><!-- card -->

<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    var skinMode = localStorage.getItem('skin-mode');
    if (skinMode) {
        $('html').attr('data-skin', 'dark');
    }
    $(document).ready(function() {

        // Lưu giá trị code referral cuối cùng
        @if(!empty($code))
        setCookie('referral_code', @json($code));
        @endif
        $('input[name="referral_code"]').val(getCookie('referral_code'));
    });
</script>
</body>
</html>

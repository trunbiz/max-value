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
    <link rel="shortcut icon" href="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}">
    <link rel="icon" type="image/x-icon" href="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_URL')}}"/>
    <meta property="og:description" content="{{env('APP_URL')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

    <title>Maxvalue.media - register</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="lib/remixicon/fonts/remixicon.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.min.css">
    <script type="text/javascript" src="{{asset('assets/helper/main_helper.js')}}"></script>
</head>
<body class="page-sign">

<div class="card card-sign">
    <div class="card-header">
        <a href="{{asset('/')}}" class="header-logo mb-4">Maxvalue</a>
        <h3 class="card-title">Register</h3>
        <p class="card-text">It's free to register and only takes a minute.</p>
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
                To expedite the website browsing process, please provide additional information.
            </div>
            <div class="mb-3">
                <label class="form-label">Url website</label>
                <input type="text" name="url" class="form-control" placeholder="url" value="">
            </div>
            <div class="mb-3">
                <label for="impression" class="">Impression/page view</label>
                <input type="number" name="impression" class="form-control impression" placeholder="1.000.000">
            </div>
            <div class="mb-3">
                <label for="geo_id" class="">Geo</label>
                <select class="form-control choose_value select2_init select-multiple geo_id" name="geo_id[]" multiple>
                    <option value=null>Choose</option>
                    @foreach($geos as $geo)
                        <option value="{{$geo->id}}">{{$geo->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="file_report" class="">File Report</label>
                <input type="file" class="form-control file_report" name="file_report">
                <div class="form-text">Please tell us about your site's charts and reports.</div>
            </div>

            <div class="mb-4">
                <small>By clicking <strong>Create Account</strong> below, you agree to our terms of service and privacy
                    statement.</small>
            </div>
            <button class="btn btn-primary btn-sign">Create Account</button>
        </form>
    </div><!-- card-body -->
    <div class="card-footer">
        Already have an account? <a href="{{ route('login') }}">Login</a>
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

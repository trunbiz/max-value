@extends('publisher.base')
@section('title', 'Dashboard')
@section('content')
    <div class="d-flex align-items-center mb-4">
        <div class="row">
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item"><a href="#">Ads</a></li>
            </ol>
            <h4 class="main-title mb-0">Ads.Txt Configuration</h4>
            <p style="color: red">Update the ads.txt on your sites in order to keep them active and continue
                monetizing</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-sm-6">
            <textarea class="form-control" id="myInput" disabled rows="24" placeholder="Ads ...">{{$adsTxt}}</textarea>
        </div>
        <div class="col-sm-6" style="font-size: 32px">
            <a class="btn btn-primary" href="{{route('user.advertises.download_txt')}}"> <i class="ri-download-2-fill"></i></a>
            <button class="btn btn-primary" onclick="copyAdsText()"><i class="ri-folders-line"></i></button>
        </div>
    </div>
    <style>
    </style>
    <script>
        function copyAdsText() {
            if (document.selection) {
                var range = document.body.createTextRange()
                range.moveToElementText(document.getElementById("myInput"))
                range.select().createTextRange()
                document.execCommand("copy")
            } else if (window.getSelection) {
                var range = document.createRange()
                range.selectNode(document.getElementById("myInput"))
                window.getSelection().addRange(range)
                document.execCommand("copy")
            }
        }
    </script>
@endsection

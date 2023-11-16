@extends('publisher.base')
@section('title', 'Ads.txt')
@section('content')
    <div class="row">
        <h4 class="main-title mb-0">Ads.Txt Configuration</h4>
        <p class="text-danger mb-0">Update the ads.txt on your sites in order to keep them active and continue
            monetizing</p>
    </div>
    <div class="row g-3">
        <div class="col-sm-6">
            <span style="float: right">{{$lines}} Row</span>
            <textarea class="form-control" id="myInput" disabled rows="24" placeholder="Ads ...">{{$adsTxt}}</textarea>
        </div>
        <div class="col-sm-6" style="font-size: 32px">
            <a class="btn btn-primary" href="{{route('user.advertises.download_txt')}}"> <i class="ri-download-2-fill"></i> Download</a>
            <button class="btn btn-primary" onclick="copyAdsText()"><i class="ri-folders-line"></i> Copy</button>
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
            swal("Success!", 'Copied', "success");
        }
    </script>
@endsection

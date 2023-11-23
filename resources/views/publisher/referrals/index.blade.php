@extends('publisher.base')
@section('title', 'Referral - Maxvalue.media')
@section('content')
    <div class="container">
        <div class="row text-center">
            <h2 class="main-title mb-0"><b>Referral Program</b></h2>
        </div>
        <div class="row mt-3">
            <p class="mb-5">Sponsor your friends and receive $15 for each new publisher that registers thanks to you!
                Your friend will be credited with $5 upon approval. In order to benefit from the offer, the person you
                refer must use your sponsor code when registering. To receive your commission of $15 your friend must
                generate at least $1 through the Maxvalue. You may only earn commission for each friend once regardless
                of the number of websites you refer to The Maxvalue.</p>
        </div>
        <div class="row text-center">
            <div class="col-6">
                <h3 class="fs-6 mb-4"><b>My Referral Code</b></h3>

                <p class="fw-bold color-domain" style="display: none"
                   id="referral_code">{{\Illuminate\Support\Facades\Auth::user()->code}}</p>

                <button type="button" class="btn btn-outline-primary btn-lg btnReferralCode">Get my Referral Code</button>
                <div class="alert alertReferralCode alert-success align-items-center px-3 py-1 mt-2 mb-0 d-none" role="alert">
                    <i class="bi bi-check-circle-fill fs-4 pe-2"></i>
                    copied
                </div>
            </div>
            <div class="col-6">
                <h3 class="fs-6 mb-4"><b>My Referral Link</b></h3>

                <p class="fw-bold color-domain" style="display: none"
                   id="link_referral_code">{{config('app.url', '') .'/'.\Illuminate\Support\Facades\Auth::user()->code}}</p>

                <button type="button" class="btn btn-outline-primary btn-lg btnReferralLink">Get my Referral link</button>
                <div class="alert alert-success alertReferralLink align-items-center px-3 py-1 mt-2 mb-0 d-none" role="alert">
                    <i class="bi bi-check-circle-fill fs-4 pe-2"></i>
                    copied
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-center mt-5 mb-4">
            <h2 class="main-title mb-0"><b>Referral History</b></h2>
        </div>
        <div class="row text-center">
            <div class="table-responsive" id="table-referral">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Money</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $key => $item)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->payment_at}}</td>
                            <td>$ {{round($item->totalRefer ?? 0, 2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    @include('publisher.common.footer_table')
                </div>
            </div>
        </div>
    </div>
    <style>
        .color-domain {
            color: #0583C7;
        }
    </style>
    <script>
        $(document).ready(function () {
            // Initialize Clipboard.js
            var clipboardCode = new ClipboardJS('.btnReferralCode', {
                text: function () {
                    return $("#referral_code").text();
                }
            });

            var clipboardLink = new ClipboardJS('.btnReferralLink', {
                text: function () {
                    return $("#link_referral_code").text();
                }
            });

            // Show success alert on successful copy
            clipboardCode.on('success', function (e) {
                $(".alertReferralCode").removeClass("d-none");

                // Hide alertReferralLink after 2 seconds
                setTimeout(function () {
                    $(".alertReferralCode").addClass("d-none");
                }, 2000);
                e.clearSelection();
            });

            clipboardLink.on('success', function (e) {
                $(".alertReferralLink").removeClass("d-none");

                // Hide alertReferralLink after 2 seconds
                setTimeout(function () {
                    $(".alertReferralLink").addClass("d-none");
                }, 2000);
                e.clearSelection();
            });

            // Show referral code on button click
            $(".btnReferralCode").click(function () {
                $("#referral_code").show();
                $(this).hide();
            });

            // Show referral link on button click
            $(".btnReferralLink").click(function () {
                $("#link_referral_code").show();
                $(this).hide();
            });
        });
    </script>
@endsection

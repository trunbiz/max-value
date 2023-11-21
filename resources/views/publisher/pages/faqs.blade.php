@extends('publisher.base')
@section('title', 'FAQ')
@section('content')
    <style>
        /* Chọn accordion-header có trạng thái aria-expanded="true" và thay đổi màu nền */
        .accordion-header [aria-expanded="true"] {
            background-color: #0583C7; /* Màu đỏ nhạt, có thể thay đổi theo mong muốn */
            color: white;
        }
        .accordion-collapse{
            padding-top: 20px;
        }
    </style>
    <h2 class="main-title mb-3">Frequently Asked Questions</h2>
    <div class="row g-5">
        <div class="col-xl">
            <div class="accordion accordion-faq" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <b>MaxValue, who are you?</b>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>We’re an alternative Google ad network that helps publishers increase their revenue through continuous and sustainable growth.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Should I replace Google AdSense?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>Absolutely, with our ad tech and premium demands, you can expect higher revenue.</p>
                            <p>And you don't need an active AdSense account to monetize with us.</p>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How can I get started with Maxvalue?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <ol>
                                <li>Add your website and zone</li>
                                <li>Update our <a href="{{route('user.advertises.index')}}">ads.txt lines</a> , implement our pending code to your websites</li>
                                <li>Wait 1-2 days for demand approval to start earning.</li>
                            </ol>
                            <p>Important Note: <span class="text-danger">We do need 1- 3 weeks to integrate our demands to optimize your revenue.</span></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            When can I see my Revenue?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>Your yesterday's earnings will be fully visible on the dashboard at 9:00 UTC</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            What are the minimum requirements for a website?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>The safe content website with traffic from tier 1 and a minimum of 100,000 pageviews monthly.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Which ad formats and sizes are supported?
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>We provide Sticky ads, Instream/outstream Video, IAB Banner, and Native.</p>
                            <p>Let’s contact our Account Manager to get recommendations for best-performing ad formats.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            What are your payment terms?
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>Net-15 term: January revenue will be released on 10th - 15th February.</p>
                            <p>Min pay for Paypal: $25, Payoneer: $50, Crypto: $100 and Wire transfer: $200</p>
                            <p>We work on CPM rates, when visitors engage with our ads, you earn.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            What is your referral program?
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>We pay 5% of the revenue for each publisher you refer to us. No limit. For detail <a href="">here</a> .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div><!-- col -->
{{--        <div class="col-md-6 col-lg-7 col-xl-4 col-xxl-3">--}}
{{--            <h5 class="section-title mb-4">NPM Installation</h5>--}}

{{--            <nav class="nav nav-classic">--}}
{{--                <a href="" class="nav-link"><span>Common errors when intalling NPM</span></a>--}}
{{--                <a href="" class="nav-link"><span>NPM for Windows</span></a>--}}
{{--                <a href="" class="nav-link"><span>Cannot install npm in Mac</span></a>--}}
{{--                <a href="" class="nav-link"><span>NPM does not recognize in local</span></a>--}}
{{--                <a href="" class="nav-link"><span>NPM version not showing when doing command</span></a>--}}
{{--            </nav>--}}

{{--            <hr class="my-4 opacity-0">--}}

{{--            <h5 class="section-title mb-4">Bootstrap Installation</h5>--}}
{{--            <nav class="nav nav-classic">--}}
{{--                <a href="" class="nav-link"><span>Common errors when intalling Bootstrap</span></a>--}}
{{--                <a href="" class="nav-link"><span>Migrating from Bootstrap 4</span></a>--}}
{{--                <a href="" class="nav-link"><span>Bootstrap using Webpack</span></a>--}}
{{--                <a href="" class="nav-link"><span>Bootstrap react components</span></a>--}}
{{--                <a href="" class="nav-link"><span>Example of bootsrap page using navbar</span></a>--}}
{{--            </nav>--}}

{{--            <hr class="my-4 opacity-0">--}}

{{--            <h5 class="section-title mb-4">SASS Customization</h5>--}}
{{--            <nav class="nav nav-classic">--}}
{{--                <a href="" class="nav-link"><span>Minimize sass to css without bootstrap</span></a>--}}
{{--                <a href="" class="nav-link"><span>Adding more utilities classes in sass</span></a>--}}
{{--            </nav>--}}
{{--        </div><!-- col -->--}}
    </div><!-- row -->
@endsection

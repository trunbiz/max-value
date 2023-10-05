@extends('user.layouts.master')

@section('title')
    <title>{{$title}}</title>
@endsection

@section('css')

@endsection

@section('content')
    <div class="container-fluid general-widget">
        <div class="row">
            {{--            _______________________--}}
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media ">
                            <div class="media-body">
                                <h6 class="font-roboto">Total Earning</h6>
                                <h4 class="mb-0">${{ number_format($wallet['totalEarning'] ?? 0, 2) }}</h4>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-success" height="39" viewBox="0 0 320 512">
                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z"/>
                            </svg>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-success" role="progressbar" style="width: 75%"
                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media ">
                            <div class="media-body">
                                <h6 class="font-roboto">Total Websites</h6>
                                <h4 class="mb-0 counter">{{ number_format($totalSite) }}</h4>
                            </div>
                            <svg class="fill-success" width="45" height="39" viewBox="0 0 45 39" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/>

                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-secondary" height="39"
                                 viewBox="0 0 512 512">
                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/>
                            </svg>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-secondary" role="progressbar" style="width: 75%"
                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media ">
                            <div class="media-body">
                                <h6 class="font-roboto">Total Zones</h6>
                                <h4 class="mb-0 counter">{{number_format($totalZone)}}</h4>
                            </div>
                            <svg class="fill-success" width="45" height="39" viewBox="0 0 45 39" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.92047 8.49509C5.81037 8.42629 5.81748 8.25971 5.93378 8.20177C7.49907 7.41686 9.01464 6.65821 10.5302 5.89775C14.4012 3.95495 18.2696 2.00762 22.1478 0.0792996C22.3387 -0.0157583 22.6468 -0.029338 22.8359 0.060288C28.2402 2.64315 33.6357 5.24502 39.033 7.84327C39.0339 7.84327 39.0339 7.84417 39.0348 7.84417C39.152 7.90121 39.1582 8.06869 39.0472 8.1375C38.9939 8.17009 38.9433 8.20087 38.8918 8.22984C33.5398 11.2228 28.187 14.2121 22.8385 17.2115C22.5793 17.3572 22.3839 17.3762 22.1131 17.2296C16.7851 14.3507 11.4518 11.4826 6.12023 8.61188C6.05453 8.57748 5.98972 8.53855 5.92047 8.49509Z"></path>
                                <path
                                    d="M21.1347 23.3676V38.8321C21.1347 38.958 21.0042 39.0386 20.895 38.9806C20.4182 38.7271 19.9734 38.4918 19.5295 38.2528C14.498 35.5441 9.46833 32.8317 4.43154 30.1339C4.12612 29.97 4.02046 29.7944 4.02224 29.4422C4.03822 26.8322 4.03023 24.2222 4.02934 21.6122C4.02934 21.4719 4.02934 21.3325 4.02934 21.1659C4.02934 21.0428 4.15542 20.9622 4.26373 21.0147C4.35252 21.0581 4.43065 21.0962 4.50434 21.1396C8.18539 23.2888 11.8664 25.438 15.5457 27.5909C16.5081 28.154 17.0622 28.0453 17.7627 27.1464C18.7748 25.8472 19.7896 24.5508 20.8045 23.2535C20.8053 23.2526 20.8062 23.2517 20.8071 23.2499C20.9172 23.1132 21.1347 23.192 21.1347 23.3676Z"></path>
                                <path
                                    d="M23.83 23.3784C23.83 23.2019 24.0484 23.1241 24.1567 23.2626C25.2168 24.6178 26.2192 25.9016 27.2233 27.1835C27.8928 28.039 28.4504 28.1494 29.3719 27.6117C33.0521 25.4643 36.7323 23.316 40.4133 21.1686C40.4914 21.1233 40.5713 21.0799 40.6592 21.0337C40.7613 20.9803 40.8856 21.0473 40.8972 21.164C40.9025 21.2184 40.9069 21.2691 40.9069 21.3189C40.9087 23.928 40.9052 26.5371 40.9132 29.1462C40.914 29.4006 40.8421 29.5518 40.6131 29.6794C35.1057 32.7539 29.6037 35.8365 24.099 38.9163C24.0892 38.9218 24.0803 38.9263 24.0706 38.9317C23.9605 38.9879 23.8309 38.9082 23.8309 38.7833L23.83 23.3784Z"></path>
                                <path
                                    d="M28.4752 24.454C27.2908 22.9385 26.118 21.4384 24.9203 19.9066C24.6983 19.6232 24.7809 19.2031 25.0925 19.0293L41.3092 9.95809C41.5746 9.80962 41.9076 9.89743 42.0692 10.1582C43.0147 11.6791 43.9541 13.1891 44.9103 14.7264C45.0852 15.0079 44.9946 15.3818 44.7114 15.5475C39.5414 18.5649 34.3875 21.5742 29.2086 24.5979C28.9627 24.74 28.651 24.6794 28.4752 24.454Z"></path>
                                <path
                                    d="M20.0132 19.931C18.819 21.4592 17.6506 22.9539 16.4804 24.4512C16.3037 24.6767 15.9921 24.7373 15.747 24.5943C10.586 21.5814 5.45504 18.5857 0.288619 15.5701C6.65486e-05 15.4017 -0.087831 15.0188 0.0968427 14.7372C1.02554 13.3204 1.94269 11.9208 2.86872 10.5085C3.03209 10.2596 3.35349 10.1763 3.61363 10.3157C9.018 13.2254 14.3975 16.1215 19.833 19.0483C20.1508 19.2194 20.2378 19.644 20.0132 19.931Z"></path>
                            </svg>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-success" role="progressbar" style="width: 60%"
                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h6 class="font-roboto">Pending Zones</h6>
                                <h4 class="mb-0 counter">{{number_format($totalZonePending)}}</h4>
                            </div>
                            <svg class="fill-success" width="45" height="39" viewBox="0 0 45 39" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.92047 8.49509C5.81037 8.42629 5.81748 8.25971 5.93378 8.20177C7.49907 7.41686 9.01464 6.65821 10.5302 5.89775C14.4012 3.95495 18.2696 2.00762 22.1478 0.0792996C22.3387 -0.0157583 22.6468 -0.029338 22.8359 0.060288C28.2402 2.64315 33.6357 5.24502 39.033 7.84327C39.0339 7.84327 39.0339 7.84417 39.0348 7.84417C39.152 7.90121 39.1582 8.06869 39.0472 8.1375C38.9939 8.17009 38.9433 8.20087 38.8918 8.22984C33.5398 11.2228 28.187 14.2121 22.8385 17.2115C22.5793 17.3572 22.3839 17.3762 22.1131 17.2296C16.7851 14.3507 11.4518 11.4826 6.12023 8.61188C6.05453 8.57748 5.98972 8.53855 5.92047 8.49509Z"></path>
                                <path
                                    d="M21.1347 23.3676V38.8321C21.1347 38.958 21.0042 39.0386 20.895 38.9806C20.4182 38.7271 19.9734 38.4918 19.5295 38.2528C14.498 35.5441 9.46833 32.8317 4.43154 30.1339C4.12612 29.97 4.02046 29.7944 4.02224 29.4422C4.03822 26.8322 4.03023 24.2222 4.02934 21.6122C4.02934 21.4719 4.02934 21.3325 4.02934 21.1659C4.02934 21.0428 4.15542 20.9622 4.26373 21.0147C4.35252 21.0581 4.43065 21.0962 4.50434 21.1396C8.18539 23.2888 11.8664 25.438 15.5457 27.5909C16.5081 28.154 17.0622 28.0453 17.7627 27.1464C18.7748 25.8472 19.7896 24.5508 20.8045 23.2535C20.8053 23.2526 20.8062 23.2517 20.8071 23.2499C20.9172 23.1132 21.1347 23.192 21.1347 23.3676Z"></path>
                                <path
                                    d="M23.83 23.3784C23.83 23.2019 24.0484 23.1241 24.1567 23.2626C25.2168 24.6178 26.2192 25.9016 27.2233 27.1835C27.8928 28.039 28.4504 28.1494 29.3719 27.6117C33.0521 25.4643 36.7323 23.316 40.4133 21.1686C40.4914 21.1233 40.5713 21.0799 40.6592 21.0337C40.7613 20.9803 40.8856 21.0473 40.8972 21.164C40.9025 21.2184 40.9069 21.2691 40.9069 21.3189C40.9087 23.928 40.9052 26.5371 40.9132 29.1462C40.914 29.4006 40.8421 29.5518 40.6131 29.6794C35.1057 32.7539 29.6037 35.8365 24.099 38.9163C24.0892 38.9218 24.0803 38.9263 24.0706 38.9317C23.9605 38.9879 23.8309 38.9082 23.8309 38.7833L23.83 23.3784Z"></path>
                                <path
                                    d="M28.4752 24.454C27.2908 22.9385 26.118 21.4384 24.9203 19.9066C24.6983 19.6232 24.7809 19.2031 25.0925 19.0293L41.3092 9.95809C41.5746 9.80962 41.9076 9.89743 42.0692 10.1582C43.0147 11.6791 43.9541 13.1891 44.9103 14.7264C45.0852 15.0079 44.9946 15.3818 44.7114 15.5475C39.5414 18.5649 34.3875 21.5742 29.2086 24.5979C28.9627 24.74 28.651 24.6794 28.4752 24.454Z"></path>
                                <path
                                    d="M20.0132 19.931C18.819 21.4592 17.6506 22.9539 16.4804 24.4512C16.3037 24.6767 15.9921 24.7373 15.747 24.5943C10.586 21.5814 5.45504 18.5857 0.288619 15.5701C6.65486e-05 15.4017 -0.087831 15.0188 0.0968427 14.7372C1.02554 13.3204 1.94269 11.9208 2.86872 10.5085C3.03209 10.2596 3.35349 10.1763 3.61363 10.3157C9.018 13.2254 14.3975 16.1215 19.833 19.0483C20.1508 19.2194 20.2378 19.644 20.0132 19.931Z"></path>
                            </svg>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-success" role="progressbar" style="width: 60%"
                                     aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span
                                        class="animate-circle"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            ------------------------------------}}
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media ">
                            <div class="media-body">
                                <h6 class="font-roboto">Total request {{$titleFilter}}</h6>
                                <h4 class="mb-0 counter">{{ number_format($totalReport->totalRequests ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media ">
                            <div class="media-body">
                                <h6 class="font-roboto">Total revenue {{$titleFilter}}</h6>
                                <h4 class="mb-0">${{ number_format(floor($totalReport->totalRevenue ?? 0)) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="media ">
                            <div class="media-body">
                                <h6 class="font-roboto">Average CPM {{$titleFilter}}</h6>
                                <h4 class="mb-0">{{ number_format($totalReport->averageCpm ?? 0, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 col-xl-12 col-sm-12 col-lg-12 group__value" style="padding: 10px">
                <a href="{{route('user.dashboard.index', ['date_option' => 'YESTERDAY'])}}"
                   class="item__filter {{ (request('date_option') == 'YESTERDAY') ? 'active' : ''}}">
                    <span>Yesterday</span>
                </a>
                <a href="{{route('user.dashboard.index', ['date_option' => 'SUB_3'])}}"
                   class="item__filter {{ (request('date_option') == 'SUB_3') ? 'active' : ''}}">
                    <span>Last 3days</span>
                </a>
                <a href="{{route('user.dashboard.index', ['date_option' => 'SUB_7'])}}"
                   class="item__filter {{ (request('date_option') == 'SUB_7') ? 'active' : ''}}">
                    <span>Last 7 days</span>
                </a>
                <a href="{{route('user.dashboard.index', ['date_option' => 'SUB_THIS_MONTH'])}}"
                   class="item__filter {{ (request('date_option') == 'SUB_THIS_MONTH') ? 'active' : ''}}">
                    <span>This month</span>
                </a>
                <a href="{{route('user.dashboard.index', ['date_option' => 'SUB_LAST_MONTH'])}}"
                   class="item__filter {{ (request('date_option') == 'SUB_LAST_MONTH') ? 'active' : ''}}">
                    <span>Last month</span>
                </a>
                <a href="{{route('user.dashboard.index', ['date_option' => 'ALL'])}}"
                   class="item__filter {{ (request('date_option') == 'ALL') ? 'active' : ''}}">
                    <span>All the time</span>
                </a>
            </div>

            <div class="col-sm-12 col-xl-12 box-col-12">
                <div class="card">
                    <div id="chart_custom"></div>
                </div>
            </div>
            <b>Statistics</b>
            <div class="col-sm-12 col-xl-12 box-col-12">
                <div class="card-footer bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="date-sort {{ (request('sort') == 'ASC') ? 'ASC' : 'DESC'}}">Date
                                    <i class="fa-solid fa-sort"></i></th>
                                <th scope="col">Website</th>
                                <th scope="col">Zone</th>
                                <th scope="col"
                                    class="impressions_sort {{ (request('impressions_sort') == 'ASC') ? 'ASC' : 'DESC'}}">
                                    Impressions <i class="fa-solid fa-sort"></i></th>
                                <th scope="col" class="cpm_sort {{ (request('cpm_sort') == 'ASC') ? 'ASC' : 'DESC'}}">
                                    Cpm <i class="fa-solid fa-sort"></i></th>
                                <th scope="col"
                                    class="revenue_sort {{ (request('revenue_sort') == 'ASC') ? 'ASC' : 'DESC'}}">
                                    Revenue <i class="fa-solid fa-sort"></i></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $itemReportSite)
                                <tr>
                                    <td scope="row" data-column="Date">{{$itemReportSite->date}}</td>
                                    <td>{{$itemReportSite->name}}</td>
                                    <td>{{$itemReportSite->zone_name}}</td>
                                    <td>{{number_format($itemReportSite->total_change_impressions ?? 0)}}</td>
                                    <td>{{round($itemReportSite->ave_cpm, 3)}}</td>
                                    <td>{{round($itemReportSite->total_change_revenue ?? 0, 2)}} $</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        @include('user.components.footer_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .group__value {
            display: flex;
            justify-content: flex-end;
        }

        .group__value .item__filter {
            margin-left: 10px;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // Lắng nghe sự kiện click trên tiêu đề cột
            $('.date-sort, .impressions_sort, .cpm_sort, .revenue_sort').click(function () {
                var $this = $(this);

                var sort = $this.hasClass('ASC') ? 'DESC' : 'ASC';
                var currentUrl = window.location.href;
                var url = new URL(currentUrl);

                var searchParams = url.searchParams;
                searchParams.delete('impressions_sort');
                searchParams.delete('cpm_sort');
                searchParams.delete('revenue_sort');
                searchParams.delete('sort');

                // Xóa class "asc" và "desc" khỏi tất cả các tiêu đề cột
                $('.date-sort, .impressions_sort, .cpm_sort, .revenue_sort').removeClass('asc desc');

                if ($this.hasClass('date-sort')) {
                    url.searchParams.set('sort', sort);
                } else if ($this.hasClass('impressions_sort')) {
                    url.searchParams.set('impressions_sort', sort);
                } else if ($this.hasClass('cpm_sort')) {
                    url.searchParams.set('cpm_sort', sort);
                } else if ($this.hasClass('revenue_sort')) {
                    url.searchParams.set('revenue_sort', sort);
                }
                // Thêm class mới tương ứng với trạng thái sort
                $this.addClass(sort);

                // Chuyển hướng đến URL mới để load lại trang với tham số sort
                window.location.href = url.href;
            });
        });

        $(document).ready(function () {
            $("#date_option").select2({});
        })

        var options = {
            colors: ['rgb(0, 143, 251)', 'rgb(0, 227, 150)', 'rgb(254, 176, 25)', 'rgb(255, 69, 96)', 'rgb(119, 93, 208)', '#FF4081', '#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#FFC107', '#03A9F4', '#E91E63', '#00BCD4', '#8BC34A', '#673AB7', '#FF5722', '#607D8B', '#9E9E9E', '#795548', '#F44336', '#FFEB3B', '#9C27B0', '#009688', '#FF5722'],
            series: @json($chart['data']),
            dataLabels: {
                enabled: true,
                enabledOnSeries: [0]
            },
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true
                    },
                    export: {
                        csv: {
                            filename: @json($fileNameExport),
                        },
                        svg: {
                            filename: @json($fileNameExport),
                        },
                        png: {
                            filename: @json($fileNameExport),
                        }
                    },
                    autoSelected: 'zoom'
                },
            },
            stroke: {
                width: [0, 4]
            },
            title: {
                text: 'Revenue Chart'
            },
            xaxis: {
                categories: @json($chart['date']),
            },
            yaxis: [{
                title: {
                    text: 'Revenue',
                },

            }]
        };
        var chart = new ApexCharts(document.querySelector("#chart_custom"), options);
        chart.render();
    </script>
@endsection

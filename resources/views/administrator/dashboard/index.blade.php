@extends('administrator.layouts.master')

@section('title')
    <title>Home page</title>
@endsection

@section('name')
    <h4 class="page-title">Tổng quan</h4>
@endsection

@section('css')

@endsection

@section('content')

    @can('dashboard-list')
        <div class="container-fluid general-widget">
            <div class="row">
                <div class="col-sm-6 col-xl-4 col-lg-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media static-widget">
                                <div class="media-body">
                                    <h6 class="font-roboto">Request</h6>
                                    <h4 class="mb-0 counter">{{ number_format($totalReport->totalRequests ?? 0) }}</h4>
                                </div>
                                <div class="fill-primary" width="44" height="46" viewBox="0 0 44 46" xmlns="http://www.w3.org/2000/svg">
                                     <span class="badge bg-success"><i class="fa-solid fa-square-arrow-up-right"></i>
                                        {{$totalReportLastMonth->totalRequests != 0 ? number_format((($totalReport->totalRequests) / ($totalReportLastMonth->totalRequests)) * 100, 3) : ''}}
                                        %
                                        </span>
                                </div>
                            </div>
                            <div class="progress-widget">
                                <div style="text-align: right">
                                    <div class="badge bg-primary">
                                        Last: {{number_format($totalReportLastMonth->totalRequests)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 col-lg-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media static-widget">
                                <div class="media-body">
                                    <h6 class="font-roboto">Revenue</h6>
                                    <h4 class="mb-0">${{ number_format(floor($totalReport->totalRevenue ?? 0)) }}</h4>
                                </div>
                                <div class="fill-primary" width="44" height="46" viewBox="0 0 44 46" xmlns="http://www.w3.org/2000/svg">
                                     <span class="badge bg-success"><i class="fa-solid fa-square-arrow-up-right"></i>
                                        {{$totalReportLastMonth->totalRevenue != 0 ? number_format((($totalReport->totalRevenue) / ($totalReportLastMonth->totalRevenue)) * 100, 3) : ''}}
                                        %
                                        </span>
                                </div>
                            </div>
                            <div class="progress-widget">
                                <div style="text-align: right">
                                    <div class="badge bg-primary">
                                        Last: {{number_format(floor($totalReportLastMonth->totalRevenue ?? 0))}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 col-lg-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media static-widget">
                                <div class="media-body">
                                    <h6 class="font-roboto">CPM</h6>
                                    <h4 class="mb-0">{{ round($totalReport->averageCpm ?? 0, 3) }}</h4>
                                </div>
                                <div class="fill-primary" width="44" height="46" viewBox="0 0 44 46" xmlns="http://www.w3.org/2000/svg">
                                     <span class="badge bg-success"><i class="fa-solid fa-square-arrow-up-right"></i>
                                        {{$totalReportLastMonth->averageCpm !=0 ? number_format((($totalReport->averageCpm) / ($totalReportLastMonth->averageCpm)) * 100, 3) : ''}}
                                        %
                                        </span>
                                </div>
                            </div>
                            <div class="progress-widget">
                                <div style="text-align: right">
                                    <div class="badge bg-primary">
                                        Last: {{round($totalReportLastMonth->averageCpm, 3)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="media static-widget">
                                <div class="media-body">
                                    <h6 class="font-roboto">Total Publisher</h6>
                                    <h4 class="mb-0">{{number_format($totalPublisher)}}</h4>
                                </div>
                                <svg class="fill-danger" width="41" height="46" viewBox="0 0 41 46"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                                    <path
                                        d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                                    <path
                                        d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                                </svg>
                            </div>
                            <div class="progress-widget">
                                <div class="progress sm-progress-bar progress-animate">
                                    <div class="progress-gradient-danger" role="progressbar" style="width: 48%"
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
                            <div class="media static-widget">
                                <div class="media-body">
                                    <h6 class="font-roboto">Total Websites</h6>
                                    <h4 class="mb-0 counter">{{ number_format($totalSite) }}</h4>
                                </div>
                                <svg class="fill-success" width="45" height="39" viewBox="0 0 45 39" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                   <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/>

                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-secondary" height="39" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z"/></svg>
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
                            <div class="media static-widget">
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
                            <div class="media static-widget">
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
                <div class="col-sm-12 col-xl-12 box-col-12">
                    <div class="card">
                        <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center">
                            <h5 class="col-sm-8">Statistics</h5>

                            @if(auth()->user()->role->id != \App\Models\User::ROLE_PUBLISHER_MANAGER)
                                <select name="publisher_manager_id" class="form-control col-sm-2"
                                        id="publisher_manager_id"
                                        onchange="onSearchQuery()">
                                    <option value="">--Publisher Manager--</option>
                                    @foreach($userPublisherManager as $itemPublisherManager)
                                        <option
                                            value="{{$itemPublisherManager->id}}" {{ !empty($_GET['publisher_manager_id']) && $_GET['publisher_manager_id'] ==  $itemPublisherManager->id ? 'selected' : '' }}>
                                            {{$itemPublisherManager->name}}
                                        </option>
                                    @endforeach
                                </select>&ensp;
                            @endif
                            <select class="form-control col-sm-2" id="type" name="type" onchange="onSearchQuery()">
                                <option value="">-- Time --</option>
                                <option value="week" {{ isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] == 'week' ? 'selected' : '' }}>Week</option>
{{--                                <option value="month" {{ isset($_GET['type']) && !empty($_GET['type']) && $_GET['type'] == 'month' ? 'selected' : '' }}>Month</option>--}}
                            </select>
                        </div>
                        <div id="chart_custom"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid list-products">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive product-table">
                                <table class="table table-hover ">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="text-center">Request</th>
                                        <th class="text-center">Paid Impressions</th>
                                        <th class="text-center">Revenue</th>
                                        <th class="text-center">Paid Revenue</th>
                                        <th class="text-center">Profit</th>
                                        <th class="text-center">Paid CPM</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($items as $item)
                                        <tr>
                                            <td>
                                                {{$item['date']}}
                                            </td>
                                            <td class="text-center">
                                                {{number_format($item['totalRequests'])}}
                                            </td>
                                            <td class="text-center">
                                                {{number_format($item['paidImpressions'])}}
                                            </td>
                                            <td class="text-center">
                                                {{number_format($item['totalRevenue'])}}
                                            </td>
                                            <td class="text-center">
                                                {{number_format($item['paidRevenue'])}}
                                            </td>
                                            <td class="text-center">
                                                {{number_format($item['totalRevenue'] - $item['paidRevenue'])}}
                                            </td>
                                            <td class="text-center">
                                                {{number_format($item['paidCpm'], 3)}}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @else
        Bạn không có quyền truy cập Dashboard
    @endcan

@endsection

@section('js')
    <script src="{{ asset('/assets/administrator/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#type, #publisher_manager_id").select2({});
        });
        function onSearchQuery() {
            addUrlParameterObjects([
                {name: "type", value: $('select[name="type"]').val()},
                {name: "publisher_manager_id", value: $('select[name="publisher_manager_id"]').val()},
            ])
        }
    </script>
    <script>
        // column chart
        var options = {
            series: [{
                name: 'Total Impression',
                type: 'column',
                data: @json($charts['series']['totalImpressions'])
            }, {
                name: 'Paid Impression',
                type: 'column',
                data: @json($charts['series']['paidImpressions'])
            }, {
                name: 'Total Revenue',
                type: 'line',
                data: @json($charts['series']['totalRevenue'])
            },
            {
                name: 'Revenue',
                type: 'line',
                data: @json($charts['series']['paidRevenue'])
            }
            ],
            chart: {
                height: 350,
                type: 'line',
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [1, 1, 1, 1]
            },
            xaxis: {
                categories: @json($charts['options']),
            },
            yaxis: [
                {
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            colors: '#008FFB',
                        },
                        formatter: function (value) {
                            if (value >= 1000) {
                                return (value / 1000) + "k";
                            } else {
                                return value;
                            }

                        }
                    },
                    title: {
                        text: "Total Impression",
                        style: {
                            color: '#008FFB',
                        }
                    },
                },
                {
                    seriesName: 'Paid Impression',
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#00E396'
                    },
                    labels: {
                        style: {
                            colors: '#00E396',
                        },
                        formatter: function (value) {
                            if (value >= 1000) {
                                return (value / 1000) + "k";
                            } else {
                                return value;
                            }

                        }
                    },
                    title: {
                        text: "Paid Impression",
                        style: {
                            color: '#00E396',
                        }
                    },
                },
                {
                    seriesName: 'Total Revenue',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            colors: '#FEB019',
                        },
                    },
                    title: {
                        text: "Total Revenue",
                        style: {
                            color: '#FEB019',
                        }
                    }
                },
                {
                    seriesName: 'Revenue',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: 'rgb(255, 69, 96)'
                    },
                    labels: {
                        style: {
                            colors: 'rgb(255, 69, 96)',
                        },
                    },
                    title: {
                        text: "Revenue",
                        style: {
                            color: 'rgb(255, 69, 96)',
                        }
                    }
                },
            ],
            tooltip: {
                fixed: {
                    enabled: true,
                    position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                    offsetY: 30,
                    offsetX: 60
                },
            },
            legend: {
                horizontalAlign: 'center',
                offsetX: 40
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart_custom"), options);
        chart.render();
    </script>

    <style>
        .apexcharts-toolbar{
            display: none;
        }
    </style>
@endsection

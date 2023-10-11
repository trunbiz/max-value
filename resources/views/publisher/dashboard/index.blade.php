@extends('publisher.base')
@section('title', 'Dashboard')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <ol class="breadcrumb fs-sm mb-1">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Overview</li>
        </ol>
        <h4 class="main-title mb-0">Welcome to Dashboard</h4>
    </div>
    <nav class="nav nav-icon nav-icon-lg">
        <a href="" class="nav-link" data-bs-toggle="tooltip" title="Share"><i class="ri-share-line"></i></a>
        <a href="" class="nav-link" data-bs-toggle="tooltip" title="Print"><i class="ri-printer-line"></i></a>
        <a href="" class="nav-link" data-bs-toggle="tooltip" title="Report"><i class="ri-bar-chart-2-line"></i></a>
    </nav>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-md-6 col-xl-3">
        <div class="card card-one">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h3 class="card-value mb-1">${{ number_format($wallet['totalEarning'] ?? 0, 2) }}</h3>
                        <label class="card-title fw-medium text-dark mb-1">Total Earning</label>
                    </div><!-- col -->
                    <div class="col-5">
                        <div id="apexChart1"></div>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->
    <div class="col-md-6 col-xl-3">
        <div class="card card-one">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h3 class="card-value mb-1">{{ number_format($totalSite) }}</h3>
                        <label class="card-title fw-medium text-dark mb-1">Total Websites</label>
                    </div><!-- col -->
                    <div class="col-5">
                        <div id="apexChart2"></div>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->
    <div class="col-md-6 col-xl-3">
        <div class="card card-one">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h3 class="card-value mb-1">{{number_format($totalZone)}}</h3>
                        <label class="card-title fw-medium text-dark mb-1">Total Zones</label>
                    </div><!-- col -->
                    <div class="col-5">
                        <div id="apexChart3"></div>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->
    <div class="col-md-6 col-xl-3">
        <div class="card card-one">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h3 class="card-value mb-1">{{number_format($totalZonePending)}}</h3>
                        <label class="card-title fw-medium text-dark mb-1">Pending Zones</label>
                    </div><!-- col -->
                    <div class="col-5">
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->

    <div class="col-md-6 col-xl-4">
        <div class="card card-one">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h3 class="card-value mb-1">{{ number_format($totalReport->totalRequests ?? 0) }}</h3>
                        <label class="card-title fw-medium text-dark mb-1">Total request {{$titleFilter}}</label>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->
    <div class="col-md-6 col-xl-4">
        <div class="card card-one">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h3 class="card-value mb-1">${{ number_format(floor($totalReport->totalRevenue ?? 0)) }}</h3>
                        <label class="card-title fw-medium text-dark mb-1">Total revenue {{$titleFilter}}</label>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->
    <div class="col-md-6 col-xl-4">
        <div class="card card-one">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h3 class="card-value mb-1">{{ number_format($totalReport->averageCpm ?? 0, 2) }}</h3>
                        <label class="card-title fw-medium text-dark mb-1">Average CPM {{$titleFilter}}</label>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->

    <div class="col-md-12 col-xl-12 col-sm-12 col-lg-12 group__value" style="padding: 10px">


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ (request('date_option') == 'YESTERDAY') ? 'active' : ''}}" aria-current="page" href="{{route('user.dashboard.index', ['date_option' => 'YESTERDAY'])}}">Yesterday</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request('date_option') == 'SUB_7') ? 'active' : ''}}" aria-current="page" href="{{route('user.dashboard.index', ['date_option' => 'SUB_7'])}}">Last 7 days</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request('date_option') == 'SUB_THIS_MONTH') ? 'active' : ''}}" aria-current="page" href="{{route('user.dashboard.index', ['date_option' => 'SUB_THIS_MONTH'])}}">This month</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request('date_option') == 'SUB_LAST_MONTH') ? 'active' : ''}}" aria-current="page" href="{{route('user.dashboard.index', ['date_option' => 'SUB_LAST_MONTH'])}}">Last month</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request('date_option') == 'ALL') ? 'active' : ''}}" aria-current="page" href="{{route('user.dashboard.index', ['date_option' => 'ALL'])}}">All the time</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <div class="col-md-12 col-xl-12">
        <div class="card card-one">
            <div class="card-header">
                <h6 class="card-title">Revenue Chart</h6>
            </div><!-- card-header -->
            <div class="card-body">
                <div id="chart_custom" class="apex-chart-nine"></div>
            </div><!-- card-body -->
        </div><!-- card-one -->
    </div><!-- col -->

    <div class="col-12">
        <div class="card card-one">
            <div class="card-header">
                <h6 class="card-title">Your Top Countries</h6>
            </div><!-- card-header -->
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-4 d-flex flex-column justify-content-center">
                        <table class="table table-one mb-4">
                            @foreach($listCountryTraffic as $itemTraffic)
                                <tr>
                                    <td scope="row" data-column="Date">
                                        <span class="flag-icon flag-icon-{{$itemTraffic->code}} flag-icon-{{$itemTraffic->code}}"></span>

                                        <span class="fw-medium">{{$itemTraffic->name}}</span>
                                    </td>
                                    <td>{{round(($itemTraffic->total_impressions/$totalCountryTraffic) * 100, 2)}} %</td>
                                </tr>
                            @endforeach
                        </table>
                    </div><!-- col -->
                    <div class="col-md-8 mt-5 mt-md-0">
                        <div id="vmap" class="vmap-one"></div>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-body -->
        </div><!-- card -->
    </div><!-- col -->
</div><!-- row -->

<div class="card card-one mt-3">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-four table-bordered">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th colspan="3">Acquisition</th>
                    <th colspan="3">Behavior</th>
                    <th colspan="3">Conversions</th>
                </tr>
                <tr>
                    <th>Source</th>
                    <th>Users</th>
                    <th>New Users</th>
                    <th>Sessions</th>
                    <th>Bounce Rate</th>
                    <th>Pages/Session</th>
                    <th>Avg. Session</th>
                    <th>Transactions</th>
                    <th>Revenue</th>
                    <th>Rate</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><a href="">Organic search</a></td>
                    <td>350</td>
                    <td>22</td>
                    <td>5,628</td>
                    <td>25.60%</td>
                    <td>1.92</td>
                    <td>00:01:05</td>
                    <td>340,103</td>
                    <td>$2.65M</td>
                    <td>4.50%</td>
                </tr>
                <tr>
                    <td><a href="">Social media</a></td>
                    <td>276</td>
                    <td>18</td>
                    <td>5,100</td>
                    <td>23.66%</td>
                    <td>1.89</td>
                    <td>00:01:03</td>
                    <td>321,960</td>
                    <td>$2.51M</td>
                    <td>4.36%</td>
                </tr>
                <tr>
                    <td><a href="">Referral</a></td>
                    <td>246</td>
                    <td>17</td>
                    <td>4,880</td>
                    <td>26.22%</td>
                    <td>1.78</td>
                    <td>00:01:09</td>
                    <td>302,767</td>
                    <td>$2.1M</td>
                    <td>4.34%</td>
                </tr>
                <tr>
                    <td><a href="">Email</a></td>
                    <td>187</td>
                    <td>14</td>
                    <td>4,450</td>
                    <td>24.97%</td>
                    <td>1.35</td>
                    <td>00:02:07</td>
                    <td>279,300</td>
                    <td>$1.86M</td>
                    <td>3.99%</td>
                </tr>
                <tr>
                    <td><a href="">Other</a></td>
                    <td>125</td>
                    <td>13</td>
                    <td>3,300</td>
                    <td>21.67%</td>
                    <td>1.14</td>
                    <td>00:02:01</td>
                    <td>240,200</td>
                    <td>$1.51M</td>
                    <td>2.84%</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div><!-- card-body -->
</div><!-- card -->

<div class="main-footer mt-5">
    <span>&copy; 2023. Dashbyte. All Rights Reserved.</span>
    <span>Created by: <a href="http://themepixels.me" target="_blank">Themepixels</a></span>
</div><!-- main-footer -->

    <script>
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
            xaxis: {
                categories: @json($chart['date']),
            },
            yaxis: [{
                title: {
                    text: 'Revenue',
                },

            }]
        };
        var chartBar = new ApexCharts(document.querySelector("#chart_custom"), options);
        chartBar.render();
    </script>
@endsection

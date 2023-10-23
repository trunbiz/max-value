@extends('publisher.base')
@section('title', 'Dashboard')
@section('content')
    <script src="lib/apexcharts/apexcharts.min.js"></script>
    <script src="lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <ol class="breadcrumb fs-sm mb-1">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Overview</li>
            </ol>
            <h4 class="main-title mb-0">Welcome to Dashboard</h4>
        </div>
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
                            <div id="apexChart33"></div>
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
                            <h3 class="card-value mb-1">
                                ${{ number_format(floor($totalReport->totalRevenue ?? 0)) }}</h3>
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
                                <a class="nav-link {{ (request('date_option') == 'YESTERDAY') ? 'active' : ''}}"
                                   aria-current="page"
                                   href="{{route('user.dashboard.index', ['date_option' => 'YESTERDAY'])}}">Yesterday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request('date_option') == 'SUB_7') ? 'active' : ''}}"
                                   aria-current="page"
                                   href="{{route('user.dashboard.index', ['date_option' => 'SUB_7'])}}">Last 7 days</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request('date_option') == 'SUB_THIS_MONTH') ? 'active' : ''}}"
                                   aria-current="page"
                                   href="{{route('user.dashboard.index', ['date_option' => 'SUB_THIS_MONTH'])}}">This
                                    month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request('date_option') == 'SUB_LAST_MONTH') ? 'active' : ''}}"
                                   aria-current="page"
                                   href="{{route('user.dashboard.index', ['date_option' => 'SUB_LAST_MONTH'])}}">Last
                                    month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request('date_option') == 'ALL') ? 'active' : ''}}"
                                   aria-current="page"
                                   href="{{route('user.dashboard.index', ['date_option' => 'ALL'])}}">All the time</a>
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
                        <div class="col-md-4 d-flex flex-column">
                            <table class="table table-one mb-4">
                                @foreach($listCountryTraffic as $itemTraffic)
                                    <tr>
                                        <td scope="row" data-column="Date">
                                            <span
                                                class="flag-icon flag-icon-{{$itemTraffic->code}} flag-icon-{{$itemTraffic->code}}"></span>

                                            <span class="fw-medium">{{$itemTraffic->name}}</span>
                                        </td>
                                        <td>{{round(($itemTraffic->total_impressions/$totalCountryTraffic) * 100, 2)}}
                                            %
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div><!-- col -->
                        <div class="col-md-8 mt-5 mt-md-0">
                            <div id="vmap-report" class="vmap-one"></div>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->
    </div><!-- row -->

    <div class="card card-one mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{route('user.dashboard.index')}}" id="searchReport" method="GET">
                    <input type="hidden" name="date_option" value="{{ request('date_option')}}">
                    <div class="row">
                        <div class="col-2">
                            <input type="text" id="dateFrom" class="form-control" name="from" value="{{request('from')}}" placeholder="From">
                        </div><!-- col -->
                        <div class="col-2">
                            <input type="text" id="dateTo" class="form-control" name="to" value="{{request('to')}}" placeholder="To">
                        </div><!-- col -->
                        <div class="col-2">
                            <select id="websiteSearch" class="form-select" name="website_id">
                                <option value="">-Website-</option>
                                @foreach($websites as $website)
                                    <option
                                        value="{{ $website->id }}" {{ request('website_id') == $website->id ? 'selected' : ''}}> {{ $website->name }}</option>
                                @endforeach
                            </select>
                        </div><!-- col -->
                        <div class="col-2">
                            <select id="zoneSearch" class="form-select" name="zone_id">
                                <option value="">-Zone-</option>
                                @foreach($zones as $zone)
                                    <option
                                        value="{{ $zone->id }}" {{ request('zone_id') == $zone->id ? 'selected' : ''}}>{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div><!-- col -->
                        <div class="col-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-primary generate"
                                        onclick="clickSearchReport()"><i class="fa-brands fa-searchengin"></i> Generate
                                </button>
                                <button type="button" class="btn btn-outline-success download"
                                        onclick="clickDownloadReport()"><i
                                        class="fa-solid fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </div><!-- row -->
                </form>
            </div><!-- card-body -->
        </div><!-- card -->

        <div class="card-body p-3">
            <div class="table-responsive" id="table-report">
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
                    @if(!empty($countItem->totalImpressions))
                        <tr style="font-weight: bold">
                            <td scope="row" data-column="Date">Total</td>
                            <td></td>
                            <td></td>
                            <td>{{empty($countItem->totalImpressions) ? 0 : number_format($countItem->totalImpressions)}}</td>
                            <td>{{empty($countItem->averageCpm) ? 0 : round($countItem->averageCpm, 3)}}</td>
                            <td>{{empty($countItem->totalRevenue) ? 0 : round($countItem->totalRevenue ?? 0, 2)}} $</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div>
                @include('publisher.common.footer_table')
            </div>
        </div><!-- card-body -->
    </div><!-- card -->

    <script>
        var dateFormat = 'yy-mm-dd';
        var from = $('#dateFrom').datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: '+1w',
            numberOfMonths: 2
        });

        from.on('change', function () {
            to.datepicker('option', 'minDate', getDate(this));
        });

        var to = $('#dateTo').datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: '+1w',
            numberOfMonths: 2
        });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }

        $(function() {
            // Kiểm tra URL có chứa các trường "from" và "to" hay không
            var urlParams = new URLSearchParams(window.location.search);
            var from = urlParams.get('from');
            var to = urlParams.get('to');

            if (!from && !to) {
                // Lấy ngày đầu tháng
                var startDate = new Date();
                startDate.setDate(1);
                var startDateString = startDate.toISOString().split('T')[0];

                // Lấy ngày hiện tại
                var currentDate = new Date();
                var currentDateString = currentDate.toISOString().split('T')[0];

                // Đặt giá trị mặc định cho các trường input
                $("#dateFrom").val(startDateString);
                $("#dateTo").val(currentDateString);

                // Gắn kết chọn ngày vào các trường input
                $("#dateFrom").datepicker({ dateFormat: "yy-mm-dd" });
                $("#dateTo").datepicker({ dateFormat: "yy-mm-dd" });
            }
        });


        ////
        // With search
        $("#websiteSearch, #zoneSearch").select2({
            placeholder: "- Website -",
        });
        $("#zoneSearch").select2({
            placeholder: "- Zone -",
        });
        $('#websiteSearch, #zoneSearch').one('select2:open', function (e) {
            $('input.select2-search__field').prop('placeholder', 'Search...');
        });

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


        // Sessions By Location
        $('#vmap-report').vectorMap({
            map: 'world_en',
            backgroundColor: '#fff',
            borderColor: '#fff',
            color: '#d9dde7',
            colors: @json($listMapCountryTraffic),
            hoverColor: null,
            hoverOpacity: 0.8,
            enableZoom: false,
            showTooltip: true,
            multiSelectRegion: true
        });

        //
        function clickSearchReport() {
            var url = new URL(window.location.href); // Lấy URL hiện tại
            var dateOption = url.searchParams.get("date_option"); // Lấy giá trị của tham số "date_option"

            // Thêm tham số "dashboard?date_option" vào URL khi kích vào nút form
            var form = document.getElementById("searchReport"); // Thay thế "your-form-id" bằng ID của form

            // Gán giá trị của "date_option" vào trường ẩn trong form
            var dateOptionInput = form.elements["date_option"];
            dateOptionInput.value = dateOption;
            form.action = url + "?date_option=" + dateOption;
            // Gửi form
            form.submit();
        }

        function clickDownloadReport() {
            // Lấy giá trị các trường input và select trong form
            var fromDate = document.querySelector('input[name="from"]').value;; // Giá trị "from"
            var toDate = document.querySelector('input[name="to"]').value;; // Giá trị "to"

            var websiteId = document.querySelector('select[name="website_id"]').value;
            var zoneId = document.querySelector('select[name="zone_id"]').value;
            var exportUrl = "{{route('user.reports.export')}}" + "?website_id=" + websiteId + "&zone_id=" + zoneId + "&from=" + fromDate + "&to=" + toDate;
            window.open(exportUrl, '_blank');
        }

    </script>
    <script src="lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/js/db.data.js"></script>
    <script src="assets/js/db.analytics.js"></script>
@endsection

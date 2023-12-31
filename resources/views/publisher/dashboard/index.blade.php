@extends('publisher.base')
@section('title', 'Dashboard')
@section('content')
    <script src="lib/apexcharts/apexcharts.min.js"></script>
    <script src="lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="main-title mb-0">Welcome to Dashboard</h4>
        </div>
    </div>

    <div class="row g-3 justify-content-center">
        <div class="col-md-6 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-value mb-1">${{ number_format($revenueYesterday->totalRevenue ?? 0, 2) }}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Yesterday Earning</label>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->
        <div class="col-md-6 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-value mb-1">{{ number_format($totalReport->totalImpressions ?? 0) }}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Total
                                Impressions {{$titleFilter}}</label>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->
        <div class="col-md-6 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-value mb-1">{{ number_format($totalReport->averageCpm ?? 0, 2) }}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Average CPM {{$titleFilter}}</label>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->
        <div class="col-md-6 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-value mb-1">
                                ${{ number_format($totalReport->totalRevenue ?? 0, 2) }}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Total revenue {{$titleFilter}}</label>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->
        <div class="col-md-6 col-xl">
            <div class="card card-one">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="card-value mb-1">
                                ${{ number_format($totalReferral ?? 0, 2) }}</h3>
                            <label class="card-title fw-medium text-dark mb-1">Total revenue referral {{$titleFilter}}</label>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card-one -->
        </div><!-- col -->

        <div class="col-md-12 col-xl-12 col-sm-12 col-lg-12 group__value" style="padding: 10px">


            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="navbar-collapse navbar-filter" id="navbarNav">
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
                    <div class="navbar-collapse navbar-filter-mobi" id="navbar-filter-mobi">
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
                        </ul>
                    </div>
                </div>
            </nav>
        </div>


        <div class="col-md-12 col-xl-12">
            <div class="card card-one">
                <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
                    <h6 class="card-title">Revenue Chart</h6>
                    <h6 class="time-report" style="margin-left: auto;margin-right: auto;">
                        Yesterday’s revenue will be shown fully after <span id="countdown"></span> minutes.
                    </h6>
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
                        <div class="col-md-3 d-flex flex-column">
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
                        <div class="col-md-9 mt-5 mt-md-0">
                            <div id="vmap" class="vmap-one"></div>
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
                        <div class="col-sm-2">
                            <input type="text" id="dateFrom" class="form-control" name="from"
                                   value="{{request('from')}}" placeholder="From">
                        </div><!-- col -->
                        <div class="col-sm-2">
                            <input type="text" id="dateTo" class="form-control" name="to" value="{{request('to')}}"
                                   placeholder="To">
                        </div><!-- col -->
                        <div class="col-sm-2">
                            <select id="websiteSearch" class="form-select form-control" name="website_id">
                                <option value="">-Website-</option>
                                @foreach($websites as $website)
                                    <option
                                        value="{{ $website->id }}" {{ request('website_id') == $website->id ? 'selected' : ''}}> {{ $website->name }}</option>
                                @endforeach
                            </select>
                        </div><!-- col -->
                        <div class="col-sm-2">
                            <select id="zoneSearch" class="form-select form-control" name="zone_id">
                                <option value="">-Zone-</option>
                                @foreach($zones as $zone)
                                    <option
                                        value="{{ $zone->id }}" {{ request('zone_id') == $zone->id ? 'selected' : ''}}>{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div><!-- col -->
                        <div class="col-sm-4">
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
                        <th scope="col">TrafficQ</th>
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
                            <td>{{$itemReportSite->trafq}}</td>
                            <td>{{round($itemReportSite->ave_cpm, 2)}}</td>
                            <td>${{round($itemReportSite->total_change_revenue ?? 0, 2)}}</td>
                        </tr>
                    @endforeach
                    @if(!empty($countItem->totalImpressions))
                        <tr style="font-weight: bold">
                            <td scope="row" data-column="Date">Total</td>
                            <td></td>
                            <td></td>
                            <td>{{empty($countItem->totalImpressions) ? 0 : number_format($countItem->totalImpressions)}}</td>
                            <td>{{empty($countItem->averageTrafq) ? 0 : round($countItem->averageTrafq, 2)}}</td>
                            <td>{{empty($countItem->averageCpm) ? 0 : round($countItem->averageCpm, 2)}}</td>
                            <td>${{empty($countItem->totalRevenue) ? 0 : round($countItem->totalRevenue ?? 0, 2)}}</td>
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

    <!-- The Modal -->
    <div class="modal fade" id="bannerPopupModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close close" data-dismiss="modal" onclick="clickCloseBannerPopup()">
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
{{--                    <h5>Dear customers</h5>--}}
{{--                    <p>Our data will be delayed few hours due to API issue. We'll fix asap.<br>--}}
{{--                        Please be patient.</p>--}}
                    <img src="{{ asset('/assets/user/images/Maxvalue-newDashboard2.png') }}" style="width: 100%" alt="banner popup">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer" style="justify-content: left;">
                    <input type="checkbox" value="1" name="showBannerPopup" id="showBannerCheckbox">
                    <label class="checkbox-inline">
                        Don't show again
                    </label>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="welcome-user">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Welcome to the MaxValue!</h5>
                    <button type="button" class="btn-close close" data-dismiss="modal" onclick="clickClosePopup('#welcome-user')">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Hello! We are delighted to welcome you as a new member.</p>
                    <p>Please click the button below to add a website immediately.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('user.websites.index')}}" class="btn btn-primary">Add website</a>
                </div>

            </div>
        </div>
    </div>

    <script>
        function clickCloseBannerPopup() {
            $('#bannerPopupModal').modal('hide');
        }
        function clickClosePopup(id) {
            $(id).modal('hide');
        }

        $(document).ready(function () {
            // kích hide vào lưu giá trị này vào cooki
            // $('#showBannerCheckbox').change(function () {
            //     if ($(this).is(':checked')) {
            //         setCookie('hideBannerPopupDashboard', true);
            //     }
            // });

            // var hideBannerPopupDashboard = getCookie('hideBannerPopupDashboard');
            // console.log(111, hideBannerPopupDashboard)
            // // Hiện popup banner
            // if (!hideBannerPopupDashboard) {
            //     $('#bannerPopupModal').modal('show');
            // }
            @if(count($websites) == 0)
            $('#welcome-user').modal('show');
            setCookie('newUser', true);
            @endif
        });

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

        $(function () {
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
                $("#dateFrom").datepicker({dateFormat: "yy-mm-dd"});
                $("#dateTo").datepicker({dateFormat: "yy-mm-dd"});
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
        $('#vmap').vectorMap({
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
            var url = new URL(window.location.href);
            var dateOption = url.searchParams.get("date_option")

            var form = document.getElementById("searchReport");

            var dateOptionInput = form.elements["date_option"];
            dateOptionInput.value = dateOption;
            form.action = url + "?date_option=" + dateOption;
            form.submit();
        }

        function clickDownloadReport() {
            var fromDate = document.querySelector('input[name="from"]').value;
            var toDate = document.querySelector('input[name="to"]').value;
            var websiteId = document.querySelector('select[name="website_id"]').value;
            var zoneId = document.querySelector('select[name="zone_id"]').value;
            var exportUrl = "{{route('user.reports.export')}}" + "?website_id=" + websiteId + "&zone_id=" + zoneId + "&from=" + fromDate + "&to=" + toDate;
            window.open(exportUrl, '_blank');
        }

    </script>
    <script>
        const countdownElement = document.getElementById('countdown');
        function countdownTo9AM() {
            const currentUtcTime = new Date();
            const currentUtcHours = currentUtcTime.getUTCHours();

            const targetUtcTime = new Date(currentUtcTime);
            targetUtcTime.setUTCHours(9, 0, 0, 0);

            if (currentUtcHours >= 9) {
                targetUtcTime.setDate(targetUtcTime.getUTCDate() + 1);
            }
            const timeUntilTarget = targetUtcTime - currentUtcTime;

            if(timeUntilTarget < 0)
            {
                countdownElement.textContent = `00:00:00`;
                setTimeout(countdownTo9AM, 1000);
            }

            const hours = Math.floor(timeUntilTarget / 3600000);
            const minutes = Math.floor((timeUntilTarget % 3600000) / 60000);
            const seconds = Math.floor((timeUntilTarget % 60000) / 1000);
            countdownElement.textContent = `${hours}:${minutes}:${seconds}`;
            setTimeout(countdownTo9AM, 1000);
        }
        countdownTo9AM();
    </script>
    <script src="assets/js/db.analytics.js"></script>
    <script src="lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/js/db.data.js"></script>
@endsection

@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

<div class="content-main">
    <div class="row">
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card">
                <form action="" method="get" autocomplete="off">
                    <div class="filter__value">
                        <h5 class="filter__title">Filter</h5>
                        <div class="card-header filter__value--content">
                            <div class="filter__content">
                                <div class="search__date row">
                                    <div class="col-md-2 col-xl-2 col-sm-4 col-12">
                                        <label>Date Range:</label>
                                    </div>
                                    <div class="col-md-10 col-xl-10 col-sm-8 col-12 group__value">
                                        <a href="{{route('user.reports.index', ['begin' => \Carbon\Carbon::now()->toDateString(), 'end' => \Carbon\Carbon::now()->toDateString() ])}}" class="item__filter {{ (request('begin') == \Carbon\Carbon::now()->toDateString() && request('end') == \Carbon\Carbon::now()->toDateString() ) ? 'active' : ''}}">
                                            <span>Today</span>
                                        </a>
                                        <a href="{{route('user.reports.index', ['begin' => \Carbon\Carbon::yesterday()->toDateString(), 'end' => \Carbon\Carbon::yesterday()->toDateString()])}}" class="item__filter {{ (request('begin') == \Carbon\Carbon::yesterday()->toDateString() && request('end') == \Carbon\Carbon::yesterday()->toDateString() ) ? 'active' : ''}}">
                                            <span>Yesterday</span>
                                        </a>
                                        <a href="{{route('user.reports.index', ['begin' => \Carbon\Carbon::now()->subDays(6)->toDateString(), 'end' => \Carbon\Carbon::now()->toDateString() ])}}" class="item__filter {{ (request('begin') == \Carbon\Carbon::now()->subDays(6)->toDateString() && request('end') == \Carbon\Carbon::now()->toDateString() ) ? 'active' : ''}}">
                                            <span>Last 7 days</span>
                                        </a>
                                        <a href="{{route('user.reports.index', ['begin' => \Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateString(), 'end' => \Carbon\Carbon::now()->subMonth()->endOfMonth()->toDateString() ])}}" class="item__filter {{ (request('begin') == \Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateString() && request('end') == \Carbon\Carbon::now()->subMonth()->endOfMonth()->toDateString()) ? 'active' : ''}}">
                                            <span>Last Month</span>
                                        </a>
                                        <div class="item__filter {{ ($_GET['begin'] != \Carbon\Carbon::now()->toDateString()  && $_GET['begin'] != \Carbon\Carbon::yesterday()->toDateString()  && $_GET['begin'] != \Carbon\Carbon::now()->subDay(6)->toDateString()  && $_GET['begin'] != \Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateString()) ? 'active' : '' }}">
                                            <label for="custom_date">Custom Range</label>
                                            <input type="text" name="daterange" id="custom_date" data-target="#datepicker">
                                            <div class="input-group-text" data-target="#datepicker" data-toggle="datepicker">
                                                <i class="fa-solid fa-calendar-days"></i>
                                            </div>
                                        </div>
                                        <div class="item__filter calendar__text" id="showDate">
                                            <span>Selected range: </span>
                                            <p>{{ isset($_GET['begin']) && !empty($_GET['begin']) ? date('Y-m-d', strtotime($_GET['begin'])) : date('Y-m-d', strtotime(\Carbon\Carbon::now()->toDateString())) }}
                                            -
                                                {{ isset($_GET['end']) && !empty($_GET['end']) ? date('Y-m-d', strtotime($_GET['end'])) : date('Y-m-d', strtotime(\Carbon\Carbon::now()->toDateString())) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
{{--                        <div class="card-body divider">--}}
{{--                            <button class="filter__button">--}}
{{--                                <i class="fa-solid fa-filter" style="color: #ffffff;"></i>--}}
{{--                                Generate Report--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card">
                <div class="card-header pb-0 export__html">
                    <h5>Reports</h5>
{{--                    <div class="export__filter">--}}
{{--                        <a href="" class="export__filter--item">Export XLSX</a>--}}
{{--                        <a href="" class="export__filter--item">Export CSV</a>--}}
{{--                    </div>--}}
                </div>
                <div class="card-body">
                    <div id="chart1"></div>
                </div>
                <div class="card-footer bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Website</th>
                                <th scope="col">Zone</th>
                                <th scope="col">IMPRESSIONS</th>
{{--                                <th scope="col">REQUESTS</th>--}}
                                <th scope="col">CPM</th>
{{--                                <th scope="col">CPC</th>--}}
{{--                                <th scope="col">CPA</th>--}}
                                <th class="the_last_col" scope="col">REVENUE</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($stats as $itemStat)
                                <tr>
                                    <td scope="row" data-column="Date">{{$itemStat['date']}}</td>
                                    <td>riseearning.com</td>
                                    <td>riseearning.com B-Sticky ads</td>
                                    <td class="column-primary" data-column="Impressions">
                                        {{ \App\Models\Formatter::formatNumber($itemStat['impressions']) }}
                                    </td>
{{--                                    <td data-column="Ad Unit">{{\App\Models\Formatter::formatNumber($itemStat['requests'])}}</td>--}}
                                    <td class="text-start" data-column="Cpm">{{($itemStat['cpm'])}}</td>
{{--                                    <td class="text-start" data-column="CPM">{{$itemStat['cpc']}}</td>--}}
{{--                                    <td class="text-start" data-column="Rev">{{$itemStat['cpa']}}</td>--}}
                                    <td class="text-start text-center" data-column="AmountPub">${{$itemStat['amountPub']}}</td>
                                    <td class="the_last_col text-center" data-column="AmountPub">{{$itemStat['amountPub']}}</td>
                                </tr>
                            @endforeach
                            <tr style="font-weight: bold">
                                <td scope="row" data-column="Date">Total</td>
                                <td></td>
                                <td></td>
                                <td class="column-primary" data-column="Impressions">{{number_format($sumNumber['impressions'])}}</td>
                                <td class="text-start" data-column="Cpm">{{$sumNumber['cpm']}}</td>
                                <td class="text-start text-center" data-column="AmountPub">${{$sumNumber['amountPub']}}</td>
                                <td class="the_last_col text-center" data-column="AmountPub">{{$sumNumber['amountPub']}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

    <script>
        // chart1
        var options1 = {
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                toolbar:{
                    show: false
                }
            },
            stroke: {
                width: [0, 4],
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },
            series: [{
                name: 'Impression',
                type: 'column',
                data: @json($impressions)
            }, {
                name: 'Revenue',
                type: 'line',
                data: @json($earnings)
            }],
            fill: {
                opacity: [0.85,1],
            },
            labels: @json($days),
            markers: {
                size: 5
            },
            xaxis: {
                type:'date',
            },
            yaxis: [{
                opposite: false,
                labels: {
                    formatter: function (value) {
                        if(value >= 1000){
                            return (value / 1000) + "k";
                        }else{
                            return value;
                        }

                    }
                },
            },{
                opposite: true,
                labels: {
                    formatter: function (value) {
                        return '$'+value.toFixed(2);
                    }
                },
            }],

            tooltip: {
                x: {
                    format: "dd MMMM, yyyy",
                },
                y: [{
                    formatter: function (value) {
                        return value;
                    }
                },{
                    formatter: function (y) {
                        if(typeof y !== "undefined") {
                            return  '$'+y.toFixed(1);
                        }
                        return y;

                    }
                }]
            },
            colors:['#1D79C4' , '#690109' ]
        }

        var chart1 = new ApexCharts(
            document.querySelector("#chart1"),
            options1
        );

        chart1.render();

        //Datetime range
        $('input[name="daterange"]').daterangepicker({
            autoUpdateInput: false,
            maxDate: moment(),
            opens: 'center',
            autoApply: false,
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
            },
        });

        $('input[name="daterange"]').on('apply.daterangepicker', function (ev, picker) {
            window.location.href = '{{ route('user.reports.index') }}'+'?begin='+picker.startDate.format('YYYY-MM-DD 00:00')+'&end='+picker.endDate.format('YYYY-MM-DD 23:59');
        })

        $('input[name="daterange"]').data('daterangepicker').setStartDate('{{ date('d/m/Y', strtotime($_GET['begin'])) }}');
        $('input[name="daterange"]').data('daterangepicker').setEndDate('{{ date('d/m/Y', strtotime($_GET['end'])) }}');
    </script>

@endsection


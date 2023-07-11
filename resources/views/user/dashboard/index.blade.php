@extends('user.layouts.master')

@section('title')
    <title>{{$title}}</title>
@endsection

@section('css')

@endsection

@section('content')

    <div class="content-main">
        <div class="row">
            <div class="col-md-12 col-xl-12 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Ad Impressions</h5>
                    </div>
                    <div class="card-body">
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>CPM</h5>
                    </div>
                    <div class="card-body">
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Earning</h5>
                    </div>
                    <div class="card-body">
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
{{--            <div class="col-md-12 col-xl-6 col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header pb-0">--}}
{{--                        <h5>Revenue by Websites (last 7 days)</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div id="chart4"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-12 col-xl-6 col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header pb-0">--}}
{{--                        <h5>Revenue by Demands (last 7 days)</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div id="chart5"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>

@endsection

@section('js')
    <script>
        // chart1
        var options1 = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'Impressions',
                data: @json($impressions)
            }],

            labels: @json($days),
            xaxis: {
                type: 'datetime',
                labels: {
                    format: 'dd/MM'
                }
            },
            yaxis: {
                opposite: true,
                labels: {
                    formatter: function (value) {
                        if (value >= 1000) {
                            return (value / 1000) + "k";
                        } else {
                            return value;
                        }

                    }
                },
            },
            tooltip: {
                x: {
                    format: "dd MMMM, yyyy",
                },
                y: {
                    formatter: function (value) {
                        return value;
                    }
                }
            },
            colors: ['#1D79C4']
        }

        var chart1 = new ApexCharts(
            document.querySelector("#chart1"),
            options1
        );
        chart1.render();

        // chart2
        var options2 = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'cpm',
                data: @json($cpms),
            }],
            labels: @json($days),
            xaxis: {
                type: 'datetime',
                labels: {
                    format: 'dd/MM'
                }
            },
            yaxis: {
                opposite: true,
            },
            tooltip: {
                x: {
                    format: "dd MMMM, yyyy",
                },
                y: {
                    formatter: function (value) {
                        return value;
                    }
                }
            },
            colors: ['#1D79C4']
        }

        var chart2 = new ApexCharts(
            document.querySelector("#chart2"),
            options2
        );
        chart2.render();

        // chart3
        var options3 = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: '$',
                data: @json($earnings)
            }],

            labels: @json($days),
            xaxis: {
                type: 'datetime',
                labels: {
                    format: 'dd/MM'
                }
            },
            yaxis: {
                opposite: true,
            },
            tooltip: {
                x: {
                    format: "dd MMMM, yyyy",
                },
                y: {
                    formatter: function (value) {
                        return value;
                    }
                }
            },
            colors: ['#1D79C4']
        }

        var chart3 = new ApexCharts(
            document.querySelector("#chart3"),
            options3
        );
        chart3.render();

        // chart4
        var options4 = {
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Team A', 'Team B'],
            series: [44, 55],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: ['#1D79C4', '#1D79C4']
        }

        var chart4 = new ApexCharts(
            document.querySelector("#chart4"),
            options4
        );

        chart4.render();

        // chart5
        var options5 = {
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Team A', 'Team B'],
            series: [44, 55],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: ['#1D79C4', '#1D79C4']
        }

        var chart5 = new ApexCharts(
            document.querySelector("#chart5"),
            options5
        );

        chart5.render();
    </script>
@endsection

@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')
    @php
        $total_paid = $total_cpm = 0;
    @endphp
    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        @include('administrator.'.$prefixView.'.search')

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/">AdServer Report</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="reports/update">Update Report</a>
                                </li>
                            </ul>
                        </div>

                        <div class="table-responsive product-table">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Requests</th>
                                    <th>Impressions</th>
                                    <th>Fill Rate %</th>
                                    <th>CPM</th>
                                    <th>Revenue</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($items as $item)
                                    @php
                                        $paid_impression = $item['impressions'] * 80 / 100;
                                        $total_paid += $paid_impression;
                                        $total_cpm += $CPMavr;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{$item['dimension']}}
                                        </td>
                                        <td>
                                            {{number_format($item['requests'])}}
                                        </td>
                                        <td>
                                            {{number_format($item['impressions'])}}
                                        </td>
                                        <td>
{{--                                            {{number_format($paid_impression, 3)}}--}}
                                            {{ (int) ($item['impressions'] / $item['requests'] * 100) }}%
                                        </td>
                                        <td>
                                            {{number_format($CPMavr, 3)}}
                                        </td>
                                        <td>
                                            {{ number_format($paid_impression/1000*$CPMavr, 3) }}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                                <tfoot>

                                <tr>
                                    <td>
                                        Total
                                    </td>
                                    <td>
                                        {{ number_format( \App\Models\Helper::totalByKeyInArray($items, 'requests') ) }}
                                    </td>
                                    <td>
                                        {{ number_format( \App\Models\Helper::totalByKeyInArray($items, 'impressions') ) }}
                                    </td>
                                    <td>
                                        {{ (int) (\App\Models\Helper::totalByKeyInArray($items, 'impressions') / ( (\App\Models\Helper::totalByKeyInArray($items, 'requests') * 100) == 0 ? 1 : (\App\Models\Helper::totalByKeyInArray($items, 'requests') * 100) ) )}}%
{{--                                        {{ number_format($total_paid, 3)  }}--}}
                                    </td>
                                    <td>
                                        {{ number_format($total_cpm, 3)  }}
                                    </td>
                                    <td>
                                        {{ number_format($total_paid/1000*$total_cpm) }}
                                    </td>
                                </tr>

                                </tfoot>
                            </table>
                        </div>
                        <div>
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <style>
        .product-table span, .product-table p {
            color: #fff;
        }
    </style>

@endsection

@section('js')

@endsection


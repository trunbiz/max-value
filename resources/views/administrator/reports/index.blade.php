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

                        <div class="table-responsive product-table">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>Date</th>
{{--                                    <th>Requests</th>--}}
                                    <th>Impressions</th>
                                    <th>CPM</th>
                                    <th>Revenue</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalRe = 0;
                                    @endphp
                                @foreach($items as $item)
                                    @php
                                        $paid_impression = $item['impressions'] * 80 / 100;
                                        $total_paid += $paid_impression;
                                        $total_cpm += $item['cpm'];
                                        $CPMavr = $item['cpm'];
                                        $totalRe += $paid_impression/1000*$CPMavr;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{$item['dimension']}}
                                        </td>
                                        <td>
                                            {{number_format($item['impressions'])}}
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
                                        {{ number_format( \App\Models\Helper::totalByKeyInArray($items, 'impressions') ) }}
                                    </td>
                                    <td>
                                        {{ number_format(($total_cpm/count($items)), 3)  }}
                                    </td>
                                    <td>
                                        {{ number_format($totalRe, 3) }}
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


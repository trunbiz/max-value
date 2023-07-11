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
                        {{--                        <div class="row">--}}
                        {{--                            <ul class="nav nav-tabs">--}}
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" aria-current="page" href="reports">AdServer Report</a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link active" href="/">Update Report</a>--}}
                        {{--                                </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}

                        <div class="table-responsive product-table">
                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Web</th>
                                    <th>Requests</th>
                                    <th>Impressions</th>
                                    <th>Fill Rate %</th>
                                    <th>CPM</th>
                                    <th>Revenue</th>
                                    <th>Count %</th>
                                    <th>Share %</th>
                                    <th>P.Imp</th>
                                    <th>P.CPM</th>
                                    <th>P.Revenue</th>
                                    <th>Profit</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!$items->isEmpty())
                                        <?php
                                        $totalRequest = 0;
                                        $totalImp = 0;
                                        $aveRate = 0;
                                        $aveCpm = 0;
                                        $totalReve = 0;
                                        $aveCount = 0;
                                        $aveShare = 0;
                                        $totalPIm = 0;
                                        $totalPCpm = 0;
                                        $totalPReve = 0;
                                        $totalPProfit = 0;

                                        ?>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>
                                                <input type="hidden" class="form-control" name="id"
                                                       value="{{$item->id}}">
                                                {{$item->date}}
                                            </td>
                                            <td>
                                                @foreach($websites as $web)
                                                    @if($item->web_id == $web['id'])
                                                        {{$web['name']}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{number_format($item->request)}}
                                            </td>
                                            <td>
                                                {{number_format($item->impressions)}}
                                            </td>
                                            <td class="rate">
                                                {{ (int) (( $item->impressions  / $item->request )* 100) }}%
                                            </td>
                                            <td class="cpm">
                                                {{$item->cpm}}
                                            </td>
                                            <td>
                                                {{$item->revenue}}
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="change_count"
                                                       value="{{$item->change_count}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="change_share"
                                                       value="{{$item->change_share}}">
                                            </td>
                                                <?php

                                                $pImp = round(!empty($item->change_impressions) ? $item->change_impressions : ($item->impressions * ($item->change_count / 100)));
                                                $pRevenue = round(($pImp == 0 ? 0 : ($pImp / 1000 * $item->cpm * ($item->change_share / 100))), 2);
                                                $pCpm = round($pImp == 0 ? 0 : (!empty($item->change_cpm) ? $item->change_cpm : ($pRevenue / $pImp * 100)), 3);
                                                $pProfit = round($item->revenue - $pRevenue, 2);

                                                $totalRequest += $item->request ?? 0;
                                                $totalImp += $item->impressions ?? 0;
                                                $aveRate += $item->request == 0 ? 0 : ((int)(($item->impressions / $item->request) * 100));
                                                $aveCpm += $item->cpm ?? 0;
                                                $totalReve += $item->revenue ?? 0;
                                                $aveCount += $item->change_count;
                                                $aveShare += $item->change_share;
                                                $totalPIm += $pImp;
                                                $totalPCpm += $pCpm;
                                                $totalPReve += $pRevenue;
                                                $totalPProfit += $pProfit;
                                                ?>
                                            <td class="pImp">{{number_format($pImp)}}</td>
                                            <td class="pCpm">{{$pCpm}}</td>
                                            <td class="pRevenue">{{$pRevenue}}</td>
                                            <td class="pProfit">{{$pProfit}}</td>
                                            <td>@if($item->status == 1)
                                                    <span class="badge bg-success">accept</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-change-revenue">Save
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr style="font-weight: bold;">
                                        <td>
                                            Total
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            {{$totalRequest}}
                                        </td>
                                        <td>
                                            {{$totalImp}}
                                        </td>
                                        <td class="rate">
                                            {{ round($aveRate/count($items)) }}%
                                        </td>
                                        <td class="cpm">
                                            {{round($aveCpm/count($items), 3)}}
                                        </td>
                                        <td>
                                            {{$totalReve}}
                                        </td>
                                        <td>
                                            {{round($aveCount/count($items), 3)}}
                                        </td>
                                        <td>
                                            {{round($aveShare/count($items), 3)}}
                                        </td>
                                        <td class="pImp">{{$totalPIm}}</td>
                                        <td class="pCpm">{{$totalPCpm}}</td>
                                        <td class="pRevenue">{{$totalPReve}}</td>
                                        <td class="pProfit">{{$totalPProfit}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $items->links('pagination::bootstrap-4') }}
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="change_count"], input[name="change_share"]').on('input', function () {
            var $row = $(this).closest('tr'); // Tìm hàng gần nhất chứa các phần tử input
            var change_count = parseFloat($row.find('input[name="change_count"]').val()) || 0;
            var change_share = parseFloat($row.find('input[name="change_share"]').val()) || 0;
            var request = parseInt($row.find('td:nth-child(3)').text().replace(",", "")) || 0;
            var impressions = parseInt($row.find('td:nth-child(4)').text().replace(",", "")) || 0;
            var cpm = parseFloat($row.find('td:nth-child(6)').text()) || 0;
            var revenue = parseFloat($row.find('td:nth-child(7)').text()) || 0;
            var rate = (impressions / request) * 100;

            var pImp = parseInt((impressions * (change_count / 100)));
            var pRevenue = (pImp / 1000 * cpm * (change_share / 100));
            var pCpm = (pRevenue / pImp * 1000);
            var profit = revenue - pRevenue;

            $row.find('.pImp').text(pImp.toLocaleString("en-US", {useGrouping: true}));
            $row.find('.pCpm').text(pCpm.toFixed(3).toLocaleString("en-US", {minimumFractionDigits: 2, maximumFractionDigits: 2, useGrouping: true}));
            $row.find('.pRevenue').text(pRevenue.toFixed(2).toLocaleString("en-US", {minimumFractionDigits: 2, maximumFractionDigits: 2, useGrouping: true}));
            $row.find('.pProfit').text(profit.toFixed(2).toLocaleString("en-US", {minimumFractionDigits: 2, maximumFractionDigits: 2, useGrouping: true}));
        });

        $('button.btn-change-revenue').on('click', function () {
            var $row = $(this).closest('tr');
            var itemId = $row.find('input[name="id"]').val();
            var changeImpressions = $row.find('.pImp').text().replace(",", "");
            var changeRevenue = $row.find('.pRevenue').text().replace(",", "");
            var changeCpm = $row.find('.pCpm').text().replace(",", "");

            $.ajax({
                url: '/administrator/reports/update',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: itemId,
                    change_impressions: changeImpressions,
                    change_revenue: changeRevenue,
                    change_cpm: changeCpm
                },
                success: function (response) {
                    // Xử lý thành công
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Xử lý lỗi
                    alert(error)
                }
            });
        });
    });
</script>


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
                                    <th>Zone</th>
                                    <th class="sort {{ (request('sort') == 'ASC') ? 'ASC' : 'DESC'}}">Requests <i class="fa-solid fa-sort"></i></th>
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
                                        $avePCpm = 0;
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
                                                {{$listZone[$item->zone_id] ?? null}}
                                            </td>
                                            <td>
                                                <span class="cRequest">{{number_format($item->request)}}</span>
                                            </td>
                                            <td>
                                                <span class="cImpression">{{number_format($item->impressions)}}</span>
                                                <p class="number-old">{{($item->impressions != $item->ad_impressions ? number_format($item->ad_impressions) : '')}}</p>
                                            </td>
                                            <td class="rate">
                                                {{ (int) (( $item->impressions  / $item->request )* 100) }}%
                                            </td>
                                            <td>
                                                <span class="cCpm">{{$item->cpm}}</span>
                                                <p class="number-old">{{($item->cpm != $item->ad_cpm ? ($item->ad_cpm) : '')}}</p>
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
                                                $pCpm = round(!empty($item->change_cpm) ? $item->change_cpm : ($pImp == 0 ? 0 : ($item->cpm * ($item->change_share / 100))), 3);
                                                $pRevenue = round(!empty($item->change_revenue) ? $item->change_revenue : ($pImp == 0 ? 0 : ($pImp / 1000 * $pCpm)), 2);
                                                $pProfit = round($item->revenue - $pRevenue, 2);

                                                $totalRequest += $item->request ?? 0;
                                                $totalImp += $item->impressions ?? 0;
                                                $aveRate += $item->request == 0 ? 0 : ((int)(($item->impressions / $item->request) * 100));
                                                $aveCpm += $item->cpm ?? 0;
                                                $totalReve += $item->revenue ?? 0;
                                                $aveCount += $item->change_count;
                                                $aveShare += $item->change_share;
                                                $totalPIm += $pImp;
                                                $avePCpm += $pCpm;
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
                                                @if($item->status != 1 || auth()->user()->role_id == 1)
                                                <button type="button" class="btn btn-primary btn-change-revenue">Save
                                                </button>
                                                <button type="button" class="btn btn btn-info btn-edit">Edit
                                                </button>
                                                @endif
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
                                        </td>
                                        <td>
                                            {{number_format($totalRequest)}}
                                        </td>
                                        <td>
                                            {{number_format($totalImp)}}
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
                                        <td class="pImp">{{number_format($totalPIm)}}</td>
                                        <td class="pCpm">{{round($avePCpm/count($items), 3)}}</td>
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
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="modal fade" id="editReport" role="dialog" aria-labelledby="editReport" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" class="form-control idChange" name="idChange">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Change Impressions</label>
                                <input type="number" class="form-control ChangeImpressions" name="ChangeImpressions" placeholder="Impressions">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Change CPM</label>
                                <input type="number" class="form-control changeCpm" name="changeCpm" placeholder="CPM">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-update" data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-default btn-close" data-dismiss="modal"></button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
<style>
    .number-old{
        color: #a4a4a4 !important;
        text-decoration-line: line-through;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.sort').click(function() {
            var $this = $(this);
            var sort = $this.hasClass('ASC') ? 'DESC' : 'ASC';
            var currentUrl = window.location.href;
            var url = new URL(currentUrl);
            url.searchParams.set('sort', sort);

            // Xóa class "asc" và "desc" khỏi tất cả các tiêu đề cột
            $('.sort').removeClass('asc desc');
            // Thêm class mới tương ứng với trạng thái sort
            $this.addClass(sort);

            // Chuyển hướng đến URL mới để load lại trang với tham số sort
            window.location.href = url.href;
        });
        $('input[name="change_count"], input[name="change_share"]').on('input', function () {
            var $row = $(this).closest('tr'); // Tìm hàng gần nhất chứa các phần tử input
            var change_count = parseFloat($row.find('input[name="change_count"]').val()) || 0;
            var change_share = parseFloat($row.find('input[name="change_share"]').val()) || 0;
            var request = parseInt($row.find('td:nth-child(4)').text().replace(",", "")) || 0;
            var impressions = parseInt($row.find('td:nth-child(5)').text().replace(",", "")) || 0;
            var cpm = parseFloat($row.find('td:nth-child(7)').text()) || 0;
            var revenue = parseFloat($row.find('td:nth-child(8)').text()) || 0;
            var rate = (impressions / request) * 100;

            var pImp = parseInt((impressions * (change_count / 100)));
            var pCpm = (cpm * (change_share / 100));
            var pRevenue = (pImp / 1000 * pCpm);
            var profit = revenue - pRevenue;
            console.log(123, pCpm, change_share, cpm)

            $row.find('.pImp').text(pImp.toLocaleString("en-US", {useGrouping: true}));
            $row.find('.pCpm').text(pCpm.toFixed(3).toLocaleString("en-US", {minimumFractionDigits: 2, maximumFractionDigits: 2, useGrouping: true}));
            $row.find('.pRevenue').text(pRevenue.toFixed(2).toLocaleString("en-US", {minimumFractionDigits: 2, maximumFractionDigits: 2, useGrouping: true}));
            $row.find('.pProfit').text(profit.toFixed(2).toLocaleString("en-US", {minimumFractionDigits: 2, maximumFractionDigits: 2, useGrouping: true}));
        });

        $('button.btn-edit').on('click', function () {
            var $row = $(this).closest('tr');
            var itemId = $row.find('input[name="id"]').val();
            var cImpression = parseInt($row.find('.cImpression').text().replace(/\D/g, ''));
            var cCpm = parseFloat($row.find('.cCpm').text());
            $('.idChange').val(itemId);
            $('.ChangeImpressions').val(cImpression);
            $('.changeCpm').val(cCpm);
            var $this = $('#editReport');
            $this.modal('show');
        });
        $('button.btn-close').on('click', function () {
            var $this = $('#editReport');
            $this.modal('hide');
        });
        $('button.btn-update').on('click', function () {
            var itemId = $('.idChange').val();
            var cImpressions = $('.ChangeImpressions').val();
            var cCpm = $('.changeCpm').val();

            $.ajax({
                url: '/administrator/reports/update',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: itemId,
                    c_impressions: cImpressions,
                    c_cpm: cCpm,
                    type: 'UPDATE'
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


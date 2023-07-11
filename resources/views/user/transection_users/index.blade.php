@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

{{--    <div class="container-fluid list-products">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}

{{--                <div class="card">--}}

{{--                    <div class="card-body">--}}

{{--                        @include('user.components.checkbox_delete_table')--}}

{{--                        <div class="table-responsive product-table">--}}
{{--                            <table class="table table-hover ">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Amount</th>--}}
{{--                                    <th>Description</th>--}}
{{--                                    <th>Created</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($items as $item)--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            {!! (float) $item->amount < 0 ? "<p class='text-danger'>".$item->amount."$</p>" : "<p class='text-success'>".$item->amount."$</p>"!!}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {{ $item->description}}--}}
{{--                                        </td>--}}
{{--                                        <td>{{$item->created_at}}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}

{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            @include('user.components.footer_table')--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--    <style>--}}
{{--        .product-table span, .product-table p {--}}
{{--            color: #fff;--}}
{{--        }--}}
{{--    </style>--}}

<div class="content-main">
    <div class="list__payment">
        <a href="{{ route('user.wallet_users.index') }}" class="list__payment--item">
            <img src="{{ asset('assets/user/images/dashboard.svg') }}" alt="">
            Overview
        </a>
{{--        <a href="{{ route('user.withdraw_users.index') }}" class="list__payment--item">--}}
{{--            <img src="{{ asset('assets/user/images/order.svg') }}" alt="">--}}
{{--            Payment Orders--}}
{{--        </a>--}}
        <a href="{{ route('user.transection_users.index') }}" class="list__payment--item active">
            <img src="{{ asset('assets/user/images/transaction.svg') }}" alt="">
            Transactions
        </a>
{{--        <a href="{{ route('user.preferences_users.index') }}" class="list__payment--item">--}}
{{--            <img src="{{ asset('assets/user/images/payment.svg') }}" alt="">--}}
{{--            Payment Preferences--}}
{{--        </a>--}}
    </div>
    <div class="row">
{{--        <div class="col-md-12 col-xl-12 col-12">--}}
{{--            <div class="card">--}}
{{--                <form action="" method="get" autocomplete="off">--}}
{{--                    <div class="filter__value">--}}
{{--                        <h5 class="filter__title">Filter</h5>--}}
{{--                        <div class="card-header filter__value--content">--}}
{{--                            <div class="filter__content">--}}
{{--                                <div class="search__date row">--}}
{{--                                    <div class="col-md-2 col-xl-2 col-sm-4 col-12">--}}
{{--                                        <label>Date Range:</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-10 col-xl-10 col-sm-8 col-12 group__value">--}}
{{--                                        <a href="" class="item__filter active">--}}
{{--                                            <span>Today</span>--}}
{{--                                        </a>--}}
{{--                                        <a href="" class="item__filter">--}}
{{--                                            <span>Yesterday</span>--}}
{{--                                        </a>--}}
{{--                                        <a href="" class="item__filter">--}}
{{--                                            <span>Last 7 days</span>--}}
{{--                                        </a>--}}
{{--                                        <a href="" class="item__filter">--}}
{{--                                            <span>MTD</span>--}}
{{--                                        </a>--}}
{{--                                        <a href="" class="item__filter">--}}
{{--                                            <span>Last Month</span>--}}
{{--                                        </a>--}}
{{--                                        <div class="item__filter">--}}
{{--                                            <label for="custom_date">Custom Range</label>--}}
{{--                                            <input type="text" name="daterange" id="custom_date" data-target="#datepicker">--}}
{{--                                            <div class="input-group-text" data-target="#datepicker" data-toggle="datepicker">--}}
{{--                                                <i class="fa-solid fa-calendar-days"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="item__filter calendar__text" id="showDate">--}}
{{--                                            <span>Selected range: </span>--}}
{{--                                            05/03/2023 - 05/04/2023--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="divider"></div>--}}
{{--                        <div class="card-body divider">--}}
{{--                            <button class="filter__button">--}}
{{--                                <i class="fa-solid fa-search" style="color: #ffffff;"></i>--}}
{{--                                Search--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card">
                <div class="card-header pb-0 export__html">
                    <h5>Transactions</h5>
{{--                    <div class="export__filter">--}}
{{--                        <a href="" class="export__filter--item">Export XLSX</a>--}}
{{--                        <a href="" class="export__filter--item">Export CSV</a>--}}
{{--                    </div>--}}
                </div>
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="8%" scope="col">ID</th>
{{--                                <th width="20%" scope="col">Type</th>--}}
                                <th width="20%" scope="col">Amount</th>
                                <th scope="col">Time</th>
{{--                                <th scope="col">Category</th>--}}
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $index => $item)
                                <tr class="item1">
                                    <td scope="row" data-column="ID">
                                        <div class="info__payment">
                                            <span class="date-id">{{$index + 1}}</span>
                                            {{--                                        <img src="{{ asset('assets/user/images/copy.png') }}" alt="">--}}
                                        </div>
                                    </td>
{{--                                    <th class="column-primary" data-column="Type">--}}
{{--                                        <div class="info__payment">--}}
{{--                                            <span>test.com</span>--}}
{{--                                            <i class="fa-solid fa-caret-down" onclick="toogleItem(1)"></i>--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
                                    <td data-column="Amount">{{\App\Models\Formatter::formatMoney($item->amount)}}</td>
                                    <th data-column="Time">
                                        <p>{{$item->created_at}}</p>
{{--                                        <p>12:00 AM</p>--}}
                                    </th>
{{--                                    <th data-column="Category">--}}
{{--                                        123--}}
{{--                                    </th>--}}
                                    <th data-column="Description">
                                        {{$item->description}}
                                    </th>
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
@endsection

@section('js')

@endsection


@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')
<style>
    .payment__info.active{
        background-color: #eee !important;
    }
</style>
@endsection

@section('content')

{{--    <div class="container-fluid list-products">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xxl-6">--}}

{{--                <div class="card">--}}

{{--                    <div class="card-header">--}}

{{--                        @include('user.'.$prefixView.'.search')--}}

{{--                    </div>--}}

{{--                    <div class="card-body">--}}

{{--                        @include('user.components.checkbox_delete_table')--}}

{{--                        <div class="table-responsive product-table">--}}
{{--                            <table class="table table-hover ">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Type</th>--}}
{{--                                    <th>Email</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($items as $item)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{optional($item->withdrawType)->name}}</td>--}}
{{--                                        <td>{{$item->email}}</td>--}}
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
        <a href="{{ route('user.wallet_users.index') }}" class="list__payment--item active">
            <img src="{{ asset('assets/user/images/dashboard.svg') }}" alt="">
            Overview
        </a>
{{--        <a href="{{ route('user.withdraw_users.index') }}" class="list__payment--item">--}}
{{--            <img src="{{ asset('assets/user/images/order.svg') }}" alt="">--}}
{{--            Payment Orders--}}
{{--        </a>--}}
{{--        <a href="{{ route('user.transection_users.index') }}" class="list__payment--item">--}}
{{--            <img src="{{ asset('assets/user/images/transaction.svg') }}" alt="">--}}
{{--            Transactions--}}
{{--        </a>--}}
{{--        <a href="{{ route('user.preferences_users.index') }}" class="list__payment--item">--}}
{{--            <img src="{{ asset('assets/user/images/payment.svg') }}" alt="">--}}
{{--            Payment Preferences--}}
{{--        </a>--}}
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-6 col-12 wallet__item">
            <div class="card">
                <div class="card-header wallet__template">
                    <h5>Balance Info</h5>
                </div>
                <div class="card-body row" style="min-height: 175px;">
                    <div class="col-sm-3 text-primary">
                        <p class="general__info--item_name">Available</p>
                        <p class="general__info--item_desc">
                            $
                            <span class="value_item">{{$amountAvailable}}</span>
                        </p>
                    </div>
                    <div class="col-sm-3 text-warning">
                        <p class="general__info--item_name">Pending</p>
                        <p class="general__info--item_desc">
                            $
                            <span class="value_item">{{$amountPending}}</span>
                        </p>
                    </div>
                    <div class="col-sm-3 text-danger">
                        <p class="general__info--item_name">Rejected</p>
                        <p class="general__info--item_desc">
                            $
                            <span class="value_item">{{$amountReject}}</span>
                        </p>
                    </div>
                    <div class="col-sm-3 text-success">
                        <p class="general__info--item_name">Total withdrawn</p>
                        <p class="general__info--item_desc">
                            $
                            <span class="value_item">{{$amountTotalWithdraw}}</span>
                        </p>
                    </div>
                    <div class="col-sm-3 text-info">
                        <p class="general__info--item_name">Total Earning</p>
                        <p class="general__info--item_desc">
                            $
                            <span class="value_item">{{$totalEarning}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-6 col-12 wallet__item">
            <div class="card">
                <div class="card-header wallet__template" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                    <h5>Current Payment Method</h5>
                    <div class="see-full">
                        <a href="javascript:void(0)" class="btn__see" onclick="createMethod()">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.668 7.00014C13.668 10.6821 10.6832 13.6668 7.00133 13.6668C3.3194 13.6668 0.334625 10.6821 0.334625 7.00014C0.334625 3.31827 3.3194 0.333496 7.00133 0.333496C10.6832 0.333496 13.668 3.31827 13.668 7.00014ZM8.46086 6.5002L7.00119 5.04057C6.80599 4.8453 6.80599 4.52872 7.00119 4.33346C7.19646 4.1382 7.51306 4.1382 7.70833 4.33346L10.0215 6.64667C10.2168 6.84194 10.2168 7.15847 10.0215 7.35373L7.70846 9.6668C7.51326 9.86207 7.19666 9.86207 7.00139 9.6668C6.80613 9.47154 6.80613 9.15493 7.00139 8.95967L8.46086 7.5002H4.16796C3.89182 7.5002 3.66796 7.27634 3.66796 7.0002C3.66796 6.72407 3.89182 6.5002 4.16796 6.5002H8.46086Z" fill="#3FAE3B"></path></svg>
                            Add
                        </a>
                    </div>
                </div>
                <div class="list__payment--table">
                    @foreach($items as $item)
                        <div class="card-body payment__info {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? 'active' : '' }}" id="method{{ $item->id }}">
                            <div class="payment__info--payment">
                                <div class="general__info--payment-icon">
                                    <img src="{{ asset(optional($item->withdrawType)->image_path ?? '/public') }}" alt="">
                                </div>
                                <div class="payment__infoo--content">
                                    <p class="name__payment" {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? 'style=color:red' : '' }}>{{ optional($item->withdrawType)->name}} {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? '(Default)' : '' }}</p>
                                    <a href="mailto:{{$item->email}}">{{$item->email}}</a>
                                </div>
                            </div>
                            <div class="payment__action">
                                <div class="payment__info--action">
                                    <a href="javascript:void(0)" onclick="editMethod({{ $item->id }})" class="btn__payment">Update</a>
                                </div>
                                <div class="payment__info--action delete__method" style="margin-top: 10px;">
                                    <a href="javascript:void(0)" onclick="deleteMethod({{ $item->id }})" class="btn__payment">Remove</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card">
                <div class="card-header wallet__template" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                    <div class="left__title">
                        <h5>Recent Payment Orders</h5>
                        <div class="see-full">
                            <a href="javascript:void(0)" data-bs-toggle="modal" onclick="openOrder()" class="btn__see">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.668 7.00014C13.668 10.6821 10.6832 13.6668 7.00133 13.6668C3.3194 13.6668 0.334625 10.6821 0.334625 7.00014C0.334625 3.31827 3.3194 0.333496 7.00133 0.333496C10.6832 0.333496 13.668 3.31827 13.668 7.00014ZM8.46086 6.5002L7.00119 5.04057C6.80599 4.8453 6.80599 4.52872 7.00119 4.33346C7.19646 4.1382 7.51306 4.1382 7.70833 4.33346L10.0215 6.64667C10.2168 6.84194 10.2168 7.15847 10.0215 7.35373L7.70846 9.6668C7.51326 9.86207 7.19666 9.86207 7.00139 9.6668C6.80613 9.47154 6.80613 9.15493 7.00139 8.95967L8.46086 7.5002H4.16796C3.89182 7.5002 3.66796 7.27634 3.66796 7.0002C3.66796 6.72407 3.89182 6.5002 4.16796 6.5002H8.46086Z" fill="#3FAE3B"></path></svg>
                                New Request
                            </a>
                        </div>
                    </div>
{{--                    <div class="export__filter">--}}
{{--                        <a href="" class="export__filter--item">Export XLSX</a>--}}
{{--                        <a href="" class="export__filter--item">Export CSV</a>--}}
{{--                    </div>--}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="8%" scope="col">ID</th>
                                <th width="20%" scope="col">Method</th>
                                <th width="20%" scope="col">Status</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Order Time</th>
                                <th scope="col">Estimate Payment Time</th>
                            </tr>
                            </thead>
                            <tbody id="listOrder">
                            @foreach($transactions as $itemTransaction)
                                <tr>
                                    <td scope="row" data-column="ID">
                                        <div class="info__payment">
                                            <span class="date-id">{{$itemTransaction->id}}</span>
                                            {{--                                        <img src="{{ asset('assets/user/images/copy.png') }}" alt="">--}}
                                        </div>
                                    </td>
                                    <td class="column-primary p-0">
                                        <div class="info__payment">
                                            <div class="image__payment">
                                                <img src="{{ asset(optional(optional($itemTransaction->walletUser)->withdrawType)->image_path ?? '/public') }}" alt="">
{{--                                                <span class="name__payment">{{optional(optional($itemTransaction->walletUser)->withdrawType)->name}}</span>--}}
                                            </div>
{{--                                            <i class="fa-solid fa-caret-down" onclick="toogleItem(1)"></i>--}}
                                        </div>
                                    </td>
                                    <td data-column="Status">
                                        {!! \App\Models\WithdrawStatus::htmlStatus(optional($itemTransaction->statusWithdraw)->name) !!}
                                    </td>
                                    <td data-column="Amount">${{\App\Models\Formatter::formatMoney($itemTransaction->amount)}}</td>
                                    <th data-column="Order Time">
                                        <p>{{$itemTransaction->created_at}}</p>
{{--                                        <p>12:00 AM</p>--}}
                                    </th>
                                    <th data-column="Payment Time">
                                        @if($itemTransaction->withdraw_status_id != \App\Models\WithdrawUser::STATUS_REJECT)
                                            <p>{{$itemTransaction->updated_at != $itemTransaction->created_at ? $itemTransaction->updated_at : ''}}</p>
                                            {{--                                        <p>11:59 PM</p>--}}
                                        @endif

                                    </th>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="col-md-12 col-xl-12 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header wallet__template" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">--}}
{{--                    <div class="left__title">--}}
{{--                        <h5>Recent Transactions</h5>--}}
{{--                        <div class="see-full">--}}
{{--                            <a href="/transactions.html" class="btn__see">--}}
{{--                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.668 7.00014C13.668 10.6821 10.6832 13.6668 7.00133 13.6668C3.3194 13.6668 0.334625 10.6821 0.334625 7.00014C0.334625 3.31827 3.3194 0.333496 7.00133 0.333496C10.6832 0.333496 13.668 3.31827 13.668 7.00014ZM8.46086 6.5002L7.00119 5.04057C6.80599 4.8453 6.80599 4.52872 7.00119 4.33346C7.19646 4.1382 7.51306 4.1382 7.70833 4.33346L10.0215 6.64667C10.2168 6.84194 10.2168 7.15847 10.0215 7.35373L7.70846 9.6668C7.51326 9.86207 7.19666 9.86207 7.00139 9.6668C6.80613 9.47154 6.80613 9.15493 7.00139 8.95967L8.46086 7.5002H4.16796C3.89182 7.5002 3.66796 7.27634 3.66796 7.0002C3.66796 6.72407 3.89182 6.5002 4.16796 6.5002H8.46086Z" fill="#3FAE3B"></path></svg>--}}
{{--                                See full--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="export__filter">--}}
{{--                        <a href="" class="export__filter--item">Export XLSX</a>--}}
{{--                        <a href="" class="export__filter--item">Export CSV</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-hover">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th width="8%" scope="col">ID</th>--}}
{{--                                <th width="20%" scope="col">Type</th>--}}
{{--                                <th width="20%" scope="col">Amount</th>--}}
{{--                                <th scope="col">Time</th>--}}
{{--                                <th scope="col">Category</th>--}}
{{--                                <th scope="col">Description</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr class="item1">--}}
{{--                                <td scope="row" data-column="ID">--}}
{{--                                    <div class="info__payment">--}}
{{--                                        <span class="date-id">12345</span>--}}
{{--                                        <img src="{{ asset('assets/user/images/copy.png') }}" alt="">--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <th class="column-primary" data-column="Type">--}}
{{--                                    <div class="info__payment">--}}
{{--                                        <span>test.com</span>--}}
{{--                                        <i class="fa-solid fa-caret-down" onclick="toogleItem(1)"></i>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <td data-column="Amount">9,4439.07</td>--}}
{{--                                <th data-column="Time">--}}
{{--                                    <p>Feb 5th 2023</p>--}}
{{--                                    <p>12:00 AM</p>--}}
{{--                                </th>--}}
{{--                                <th data-column="Category">--}}
{{--                                    123--}}
{{--                                </th>--}}
{{--                                <th data-column="Description">--}}
{{--                                    123--}}
{{--                                </th>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>

<!-- Modal -->
<div class="modal" id="addMethod" tabindex="-1" role="dialog" aria-labelledby="addMethod"></div>

<!-- Update Modal -->
<div class="modal" id="editMethod" tabindex="-1" role="dialog" aria-labelledby="editMethod"></div>

<!-- Modal add ad unit -->
<div class="modal" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="addOrder"></div>

@endsection

@section('js')

    <script>
        function callAjax(method, url, data, success) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                type: method,
                url: url,
                beforeSend: function() {
                    $('#loader').removeClass('loading');
                },
                success: function( response, textStatus, jqXHR ) {
                    success(response);
                },
                complete: function(){
                    $('#loader').addClass('loading');
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    alert( errorThrown );
                }
            })
        }

        function createMethod() {
            var $this = $('#addMethod');
            $('#editMethod').empty();
            $('#addOrder').empty();
            callAjax(
                'GET',
                '{{ route('user.wallet_users.create') }}',
                {},
                (response) => {
                    $this.html(response.html);
                    $this.modal('show');
                }
            )
        }


        function chooseMethod(){
            var bank_id = $('select[name="method"]').val();
            if(bank_id == 0){
                $('.modal-payment__group--icons').empty();
                $('#infoMethod').empty();
            }else{
                callAjax(
                    'GET',
                    '{{ route('user.ajax.getmethod') }}' + '?bank_id='+bank_id,{},
                    (response) => {
                        $('.modal-payment__group--icons').html(response.image);
                        $('#infoMethod').html(response.html);
                        if(bank_id == 1 || bank_id == 2){
                            $('#payment_id').show();
                            $('#email_payment').show();
                            $('#type_crypto').hide();
                            $('#beneficiary').hide();
                            $('#acc_number').hide();
                            $('#bank_name').hide();
                            $('#swift_code').hide();
                            $('#bank_address').hide();
                            $('#routing_number').hide();
                        }else if(bank_id == 3){
                            $('#payment_id').hide();
                            $('#email_payment').hide();
                            $('#type_crypto').show();
                            $('#beneficiary').hide();
                            $('#acc_number').hide();
                            $('#bank_name').hide();
                            $('#swift_code').hide();
                            $('#bank_address').hide();
                            $('#routing_number').hide();
                            chooseType()
                        }else if(bank_id == 7){
                            $('#payment_id').hide();
                            $('#email_payment').hide();
                            $('#type_crypto').hide();
                            $('#beneficiary').show();
                            $('#acc_number').show();
                            $('#bank_name').show();
                            $('#swift_code').show();
                            $('#bank_address').show();
                            $('#routing_number').show();
                        }
                    }
                )
            }
        }

        function chooseType(){
            var type_id = $('select[name="type_crypto"]').val();
            callAjax(
                'GET',
                '{{ route('user.ajax.gettype') }}' + '?type_id='+type_id,{},
                (response) => {
                    $('#getType').html(response.html);
                    if(type_id == 4){
                        $('#usdt_network').show();
                        $('#eth_network').hide();
                        $('#bitcoin_network').hide();
                        $('#address_network').show();
                    }else if(type_id == 5){
                        $('#usdt_network').hide();
                        $('#eth_network').show();
                        $('#bitcoin_network').hide();
                        $('#address_network').show();
                    }else if(type_id == 6){
                        $('#usdt_network').hide();
                        $('#eth_network').hide();
                        $('#bitcoin_network').show();
                        $('#address_network').show();
                    }
                }
            )
        }



        function storeMethod(){
            var $this = $('#addMethod');
            callAjax(
                'POST',
                '{{ route('user.wallet_users.store') }}',
                {
                    'withdraw_type_id' : $this.find('select[name="method"]').val(),
                    'method_id' : $this.find('input[name="method_id"]').val(),
                    'email' : $this.find('input[name="email"]').val(),
                    'type_crypto' : $this.find('select[name="type_crypto"]').val(),
                    'usdt_network' : $this.find('select[name="usdt_network"]').val(),
                    'eth_network' : $this.find('select[name="eth_network"]').val(),
                    'bitcoin_network' : $this.find('select[name="bitcoin_network"]').val(),
                    'address_network' : $this.find('input[name="address_network"]').val(),
                    'beneficiary_name' : $this.find('input[name="beneficiary_name"]').val(),
                    'acc_number' : $this.find('input[name="acc_number"]').val(),
                    'bank_name' : $this.find('input[name="bank_name"]').val(),
                    'swift_code' : $this.find('input[name="swift_code"]').val(),
                    'bank_address' : $this.find('input[name="bank_address"]').val(),
                    'routing_number' : $this.find('input[name="routing_number"]').val(),
                    'default' : $this.find('input[name="default"]').val(),
                },
                (response) => {
                    if(response.status == false){
                        swal("Error!", response.message, "error");
                    }else{
                        $this.modal('hide');
                        swal("Success!", 'Add successful', "success");
                        $('.list__payment--table').html(response.html);
                    }

                }
            )
        }

        function editMethod(id){
            var $this = $('#editMethod');
            $('#addMethod').empty();
            $('#addOrder').empty();
            $this.find('form').attr('data-id', id);
            callAjax(
                "GET",
                "{{ route('user.ajax.editmethod') }}" + "?id="+id,{},
                (response) => {
                    $this.html(response.html);
                    $this.modal('show');
                }

            )
        }

        function updateMethod(){
            var $this = $('#editMethod');
            var id = $this.find('form').data('id');
            callAjax(
                "PUT",
                "{{ route('user.wallet_users.update') }}?id="+id,
                {
                    'withdraw_type_id' : $('#choose').val(),
                    'method_id' : $this.find('input[name="method_id"]').val(),
                    'email' : $('input[name="email"]').val(),
                    'type_crypto' : $this.find('select[name="type_crypto"]').val(),
                    'usdt_network' : $this.find('select[name="usdt_network"]').val(),
                    'eth_network' : $this.find('select[name="eth_network"]').val(),
                    'bitcoin_network' : $this.find('select[name="bitcoin_network"]').val(),
                    'address_network' : $this.find('input[name="address_network"]').val(),
                    'beneficiary_name' : $this.find('input[name="beneficiary_name"]').val(),
                    'acc_number' : $this.find('input[name="acc_number"]').val(),
                    'bank_name' : $this.find('input[name="bank_name"]').val(),
                    'swift_code' : $this.find('input[name="swift_code"]').val(),
                    'bank_address' : $this.find('input[name="bank_address"]').val(),
                    'routing_number' : $this.find('input[name="routing_number"]').val(),
                    'default' : $this.find('input[name="default"]').val(),
                },
                (response) => {
                    if(response.status == false){
                        swal("Error!", response.message, "error");
                    }else{
                        $this.modal('hide');
                        swal("Success!", 'Update successful', "success");
                        $('.list__payment--table').html(response.html);
                        // if(response.default == 1){
                        //     $('#method'+id).remove();
                        //     $('.list__payment--table').prepend(response.html);
                        //     $('#method14').removeClass('active');
                        // }else{
                        //     $('#method'+id).html(response.html);
                        // }
                    }
                }

            )
        }

        function openOrder() {
            var $this = $('#addOrder');
            $('#addMethod').empty();
            $('#editMethod').empty();
            callAjax(
                'GET',
                '{{ route('user.withdraw_users.create') }}',
                {},
                (response) => {
                    $this.html(response.html);
                    $this.modal('show');
                }
            )
        }

        function createOrder() {
            var $this = $('#addOrder');
            callAjax(
                'POST',
                '{{ route('user.withdraw_users.store') }}',
                {
                    'wallet_id' : $('select[name="wallet_id"]').val(),
                    'amount' : $('input[name="amount"]').val(),
                },
                (response) => {
                    if(response.status == false){
                        swal("Error!", response.message, "error");
                    }else{
                        $this.modal('hide');
                        swal("Success!", 'Add successful', "success");
                        $('#listOrder').prepend(response.html);
                        $('.general__info .text-primary .value_item').html(response.available);
                        $('.money__info .total__money').html('$'+response.available);
                        $('.general__info .text-warning .value_item').html(response.pending);
                        $('.general__info .text-danger .value_item').html(response.total);
                    }

                }
            )
        }


            function deleteMethod(id) {
                var result = confirm('Want to delete?');
                if(result){
                    callAjax(
                        "DELETE",
                        "{{ route('user.wallet_users.delete') }}?id="+id,
                        {},
                        (response) => {
                            if(response.status == false){
                                swal("Error!", response.message, "error");
                            }else{
                                swal("Success!",  response.message , "success");
                                $('#method'+id).remove();
                            }
                        }

                    )
                }

            }

        // $(document).ready(function () {
        //    console.log($('select[name="method"]').val());
        // })
    </script>
    <style>
        .general__info--item_desc{
            font-size: 32px;
            font-weight: 700;
            line-height: 48px;
            margin-top: 0;

        }
        .general__info--item_name{
            font-weight: 300;
            font-size: 12px;
            line-height: 16px;
        }

    </style>

@endsection


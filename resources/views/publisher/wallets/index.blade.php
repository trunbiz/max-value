@extends('publisher.base')
@section('title', 'Wallet')
@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="main-title mb-0">Welcome to Wallet</h4>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-sm-12 col-xl-12">
            <div class="row">
                <div class="col-6 col-sm-4 col-xl">
                    <div class="card card-one">
                        <div class="card-body p-3">
                            <div class="mb-1 text-primary ti--3"><i class="ri-coin-line fs-48"></i></div>
                            <h6 class="fw-semibold text-dark mb-1">Available</h6>
                            <p class="fs-xs text-secondary"><span class="ff-numerals">{{$amountAvailable}}</span> $</p>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-xl">
                    <div class="card card-one">
                        <div class="card-body p-3">
                            <div class="mb-1 text-warning ti--3"><i class="ri-coin-line fs-48"></i></div>
                            <h6 class="fw-semibold text-dark mb-1">Pending</h6>
                            <p class="fs-xs text-secondary"><span class="ff-numerals">{{$amountPending}}</span> $</p>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-xl">
                    <div class="card card-one">
                        <div class="card-body p-3">
                            <div class="mb-1 text-danger ti--3"><i class="ri-coin-line fs-48"></i></div>
                            <h6 class="fw-semibold text-dark mb-1">Rejected</h6>
                            <p class="fs-xs text-secondary"><span class="ff-numerals">{{$amountReject}}</span> $</p>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-xl">
                    <div class="card card-one">
                        <div class="card-body p-3">
                            <div class="mb-1 text-success ti--3"><i class="ri-coin-line fs-48"></i></div>
                            <h6 class="fw-semibold text-dark mb-1">Total withdrawn</h6>
                            <p class="fs-xs text-secondary"><span class="ff-numerals">{{$amountTotalWithdraw}}</span> $</p>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-6 col-sm-4 col-xl">
                    <div class="card card-one">
                        <div class="card-body p-3">
                            <div class="mb-1 text-primary ti--3"><i class="ri-coin-line fs-48"></i></div>
                            <h6 class="fw-semibold text-dark mb-1">Total Earning</h6>
                            <p class="fs-xs text-secondary"><span class="ff-numerals">{{$totalEarning}}</span> $</p>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card card-one">
                <div class="card-header">
                    <h6 class="card-title">Recent Payment Orders</h6>
                    <nav class="nav nav-icon nav-icon-sm ms-auto">
                        <a href="javascript:void(0)" class="btn btn-outline-primary" onclick="openOrder()"><i class="ri-add-circle-fill"></i> Add</a>
                    </nav>
                </div><!-- card-header -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Method</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Order Time</th>
                            <th scope="col">Estimate Payment Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <th scope="row">{{$transaction->id}}</th>
                            <td>
                                <div class="list-group-one">
                                    <div class="avatar bg-twitter text-white"><i class="{{\App\Models\WithdrawUser::TYPE_ICON[$transaction->walletUser->withdrawType->id]}}"></i></div>
                                    <div>
                                        <h6 class="mb-0">{{$transaction->walletUser->withdrawType->name ?? ''}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($transaction->withdraw_status_id == \App\Models\WithdrawUser::STATUS_PENDING)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($transaction->withdraw_status_id == \App\Models\WithdrawUser::STATUS_APPROVED)
                                    <span class="badge bg-success">Approved</span>
                                @elseif($transaction->withdraw_status_id == \App\Models\WithdrawUser::STATUS_REJECT)
                                    <span class="badge bg-danger">Reject</span>
                                @endif
                            </td>
                            <td>{{$transaction->amount}} $</td>
                            <td>{{$transaction->created_at}}</td>
                            <td>
                                @if($transaction->withdraw_status_id != \App\Models\WithdrawUser::STATUS_REJECT)
                                    {{$transaction->estimate_payment}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="padding: 20px;">
                        {{ $transactions->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->
        <div class="col-md-6 col-xl-4">
            <div class="card card-one">
                <div class="card-header">
                    <h6 class="card-title">Current Payment Method</h6>
                    <nav class="nav nav-icon nav-icon-sm ms-auto">
                        <a href="javascript:void(0)" class="btn btn-outline-primary" onclick="createMethod()"><i class="ri-add-circle-fill"></i> Add</a>
                    </nav>
                </div><!-- card-header -->
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        @foreach($items as $item)
                            <tr class="{{ isset($item->default) && !empty($item->default) && $item->default == 1 ? 'active' : '' }}" id="method{{ $item->id }}">
                                <th scope="row">
                                    <div class="list-group-one">
                                        <div class="avatar bg-twitter text-white"><i class="{{\App\Models\WithdrawUser::TYPE_ICON[$item->withdrawType->id  ?? '0']}}"></i></div>
                                    </div>
                                </th>
                                <td><p class="name__payment" {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? 'style=color:red' : '' }}>{{ optional($item->withdrawType)->name}} {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? '(Default)' : '' }}</p></td>
                                <td>{{$item->email ?? ''}}</td>
                                <td style="text-align: right">
                                    <button type="button" class="btn btn-primary" onclick="editMethod({{ $item->id }})"><i class="ri-edit-2-fill" title="edit"></i></button>
{{--                                    <button type="button" class="btn btn-danger" onclick="deleteMethod({{ $item->id }})"><i class="ri-close-fill" title="edit"></i></button>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->
    </div><!-- row -->

    <!-- Modal add ad unit -->
    <div class="modal" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="addOrder"></div>

    <!-- Modal -->
    <div class="modal" id="addMethod" tabindex="-1" role="dialog" aria-labelledby="addMethod"></div>

    <!-- Update Modal -->
    <div class="modal" id="editMethod" tabindex="-1" role="dialog" aria-labelledby="editMethod"></div>
    <script>
        function createMethod() {
            var $loading = $('#loading');
            $loading.modal('show');
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
                    $loading.modal('hide');
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
            $this.modal('hide');
            var $loading = $('#loading');
            $loading.modal('show');
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
                        $('.list__payment--table').html(response.html);
                        $loading.modal('hide');
                        window.location.reload();
                    }
                }

            )
        }

        function openOrder() {
            var $loading = $('#loading');
            $loading.modal('show');
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
                    $loading.modal('hide');
                }
            )
        }

        function createOrder() {
            var $loading = $('#loading');
            $loading.modal('show');
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
                        alert(response.message)
                    }else{
                        $this.modal('hide');
                        window.location.reload();
                    }
                    $loading.modal('hide');
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

        function chooseMethod(){
            console.log(223)
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

        function storeMethod(){
            var $this = $('#addMethod');
            var $loading = $('#loading');
            $loading.modal('show');
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
                        alert(response.message)
                    }else{
                        $this.modal('hide');
                        $('.list__payment--table').html(response.html);
                        window.location.reload();
                    }
                    $loading.modal('hide');
                }
            )
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
    </script>
@endsection

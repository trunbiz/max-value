@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        @include('administrator.'.$prefixView.'.search')

                    </div>

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table id="wallet__table" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Time</th>
                                    <th>Est. Payment</th>
                                    <th>Account Manager</th>
                                    <th>Publisher</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Method</th>
                                    <th>Paypal Email</th>
                                    <th>Payoneer Email</th>
                                    <th>Network</th>
                                    <th>Bitcoin Address</th>
                                    <th>Ethererum Address</th>
                                    <th>USDT Address</th>
                                    <th>Beneficiary Name</th>
                                    <th>Account Number</th>
                                    <th>Bank Name</th>
                                    <th>SWFTBIC</th>
                                    <th>Bank Address</th>
                                    <th>Routing Number</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($items as $index => $item)
                                    @php
                                        $checkDay = \Carbon\Carbon::make(\App\Models\Formatter::getDateTime($item->created_at))->format('d');
                                    @endphp
                                    <tr class="item{{ $item->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
                                        <td>
                                            {{\App\Models\Formatter::getDateTime($item->updated_at)}}
                                        </td>
                                        <td>
                                            {{ optional($item->user)->email}}
                                        </td>

                                        <td>
                                            {{ optional($item->user)->name}}
                                        </td>

                                        <td>
                                            ${{ number_format($item->amount)}}
                                        </td>

                                        <td>
                                            <label onclick="changeStatus({{ $item->id }})" class="p-1" style="cursor:pointer; border-radius: 10px;background-color: {{optional($item->statusWithdraw)->color}}">
                                                {{ optional($item->statusWithdraw)->name}}
                                            </label>
                                        </td>
                                        <td>{{ optional(optional($item->walletUser)->withdrawType)->name }}</td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 1)
                                                {{ optional($item->walletUser)->email }}
                                            @endif
                                        </td>

                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 2)
                                                {{ optional($item->walletUser)->email }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ optional($item->walletUser)->network }}
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 6)
                                                {{ optional($item->walletUser)->network_address }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 5)
                                                {{ optional($item->walletUser)->network_address }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 4)
                                                {{ optional($item->walletUser)->network_address }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 7)
                                                {{ optional($item->walletUser)->beneficiary_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 7)
                                                {{ optional($item->walletUser)->account_number }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 7)
                                                {{ optional($item->walletUser)->bank_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 7)
                                                {{ optional($item->walletUser)->swift }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 7)
                                                {{ optional($item->walletUser)->bank_address }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(optional($item->walletUser)->withdraw_type_id == 7)
                                                {{ optional($item->walletUser)->routing_number }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="changeStatus" aria-labelledby="changeStatus" aria-hidden="true"></div>

    <style>
        .product-table span, .product-table p {
            color: #fff;
        }
    </style>

@endsection

@section('js')

    <script>
        $('#wallet__table').dataTable({
            paging: false,
            searching: false,
            info: false,
        });

        function callAjax(method = "GET", url, data, success, error, is_loading = true){
            $.ajax({
                type: method,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: true,
                data: data,
                url: url,
                beforeSend: function () {
                    if(is_loading){
                        showLoading()
                    }
                },
                success: function (response) {
                    if(is_loading){
                        hideLoading()
                    }
                    success(response)
                },
                error: function (err) {
                    if(is_loading){
                        hideLoading()
                    }
                    Swal.fire(
                        {
                            icon: 'error',
                            title: err.responseText,
                        }
                    );
                    error(err)
                },
            });
        }

        function changeStatus(id) {
            var $this = $('#changeStatus');
            callAjax(
                'GET',
                '{{ route('administrator.withdraw_users.edit') }}?id='+id,
                {},
                (response) => {
                    $this.html(response.html);
                    $this.modal('show');
                }
            )
        }

    </script>

@endsection


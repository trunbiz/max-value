<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <form autocomplete="off" data-id="{{ $item->id }}">
            <div class="modal-body">
                <div class="modal-payment__title">
                    Edit payment method
                </div>
                <div class="modal-payment__choose">Choose Paymend Method&nbsp<span class="text-danger">*</span></div>
                <div class="modal-payment__group">
                    <div class="modal-payment__group--icons">
                        <img src="{{ asset(optional($item->withdrawType)->image_path ?? '/public') }}" alt="">
                    </div>
                    <div class="modal-payment__select">
                        <select class="form-select form-control" id="choose" aria-label="Default select example" onchange="chooseMethod2()">
                            @foreach($banks as $bank)
                                <option value="{{ $bank->id }}" {{ (isset($item['withdraw_type_id']) && !empty($item['withdraw_type_id']) && $item['withdraw_type_id'] == $bank->id ) ? 'selected' : '' }}>{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="infoMethod2">
                    <div class="modal-payment__group">
                        <div class="modal-payment__group--box"></div>
                        <p class="content__threshold">(Minimum Payment Threshold: {{ optional($item->withdrawType)->min }} USD)</p>
                    </div>
                    <div class="divider"></div>
                    <p class="text-danger">
                        Fields mark with <span>*</span> are required
                    </p>
                    <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 1 || $item->withdraw_type_id == 2 ? '' : 'hidden' }}" id="email_payment">
                        <div class="col-md-12 col-12">
                            <label for="emailMethod" style="color:#000; font-weight: 700">{{ optional($item->withdrawType)->name}} Email&nbsp<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="formInput form-control" value="{{ $item['email'] }}" placeholder="{{ optional($item->withdrawType)->name}} Email" id="emailMethod">
                        </div>
                    </div>

                    <div class="row form-group" id="type_crypto" {{ isset($item) && !empty($item) && $item->withdraw_type_id == 3 ? '' : 'hidden' }}>
                        <div class="col-md-12 col-12">
                            <label for="editCrypto" style="color:#000; font-weight: 700">Type crypto&nbsp<span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="type_crypto" onchange="chooseType2()" aria-label="Default select example" id="editCrypto">
                                @foreach($banks_child as $bank_child)
                                    <option value="{{ $bank_child->id }}" {{ isset($item) && !empty($item) && $item->type_crypto == $bank_child->id ? 'selected' : '' }}>{{ $bank_child->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="getType2">
                        <div class="row form-group {{ isset($item) && !empty($item) && $item->type_crypto == 4 ? '' : 'hidden' }}" id="usdt_network">
                            <div class="col-md-12 col-12">
                                <label for="networkUSDT" style="color:#000; font-weight: 700">Network&nbsp<span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="usdt_network" aria-label="Default select example" id="networkUSDT">
                                    <option value="BNB Smart Chain (BEP20)" {{ isset($item) && !empty($item) && $item->network == 'BNB Smart Chain (BEP20)' ? 'selected' : '' }}>BNB Smart Chain (BEP20)</option>
                                    <option value="Ethereum (ERC20)" {{ isset($item) && !empty($item) && $item->network == 'Ethereum (ERC20)' ? 'selected' : '' }}>Ethereum (ERC20)</option>
                                    <option value="Tron (TRC20)" {{ isset($item) && !empty($item) && $item->network == 'Tron (TRC20)' ? 'selected' : '' }}>Tron (TRC20)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group {{ isset($item) && !empty($item) && $item->type_crypto == 5 ? '' : 'hidden' }}" id="eth_network">
                            <div class="col-md-12 col-12">
                                <label for="networkETH" style="color:#000; font-weight: 700">Network&nbsp<span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="eth_network" aria-label="Default select example" id="networkETH">
                                    <option value="BNB Smart Chain (BEP20)" {{ isset($item) && !empty($item) && $item->network == 'BNB Smart Chain (BEP20)' ? 'selected' : '' }}>BNB Smart Chain (BEP20)</option>
                                    <option value="Ethereum (ERC20)" {{ isset($item) && !empty($item) && $item->network == 'Ethereum (ERC20)' ? 'selected' : '' }}>Ethereum (ERC20)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group {{ isset($item) && !empty($item) && $item->type_crypto == 6 ? '' : 'hidden' }}" id="bitcoin_network">
                            <div class="col-md-12 col-12">
                                <label for="networkBitcoin" style="color:#000; font-weight: 700">Network&nbsp<span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="bitcoin_network" aria-label="Default select example" id="networkBitcoin">
                                    <option value="BNB Smart Chain (BEP20)" {{ isset($item) && !empty($item) && $item->network == 'BNB Smart Chain (BEP20)' ? 'selected' : '' }}>BNB Smart Chain (BEP20)</option>
                                    <option value="Bitcoin" {{ isset($item) && !empty($item) && $item->network == 'Bitcoin' ? 'selected' : '' }}>Bitcoin</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 3  ? '' : 'hidden' }}" id="address_network">
                            <div class="col-md-12 col-12">
                                <label for="addressNetwork" style="color:#000; font-weight: 700">{{ $item->name}} Address&nbsp<span class="text-danger">*</span></label>
                                <input type="text" value="{{ isset($item) && !empty($item) ? $item->network_address : ''}}" name="address_network" class="formInput form-control" placeholder="{{ $item->name}} Address" id="addressNetwork">
                            </div>
                        </div>
                    </div>

                    <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 7 ? '' : 'hidden' }}" id="beneficiary">
                        <div class="col-md-12 col-12">
                            <label for="beneficiaryName" style="color:#000; font-weight: 700">Beneficiary Name&nbsp<span class="text-danger">*</span></label>
                            <input type="text" value="{{ isset($item) && !empty($item) ? $item->beneficiary_name : ''}}" name="beneficiary_name" class="formInput form-control" placeholder="Beneficiary Name" id="beneficiaryName">
                        </div>
                    </div>

                    <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 7 ? '' : 'hidden' }}" id="acc_number">
                        <div class="col-md-12 col-12">
                            <label for="accNumber" style="color:#000; font-weight: 700">Account Number&nbsp<span class="text-danger">*</span></label>
                            <input type="text" value="{{ isset($item) && !empty($item) ? $item->account_number : ''}}" name="acc_number" class="formInput form-control" placeholder="Account Number" id="accNumber">
                        </div>
                    </div>

                    <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 7 ? '' : 'hidden' }}" id="bank_name">
                        <div class="col-md-12 col-12">
                            <label for="bankName" style="color:#000; font-weight: 700">Bank Name&nbsp<span class="text-danger">*</span></label>
                            <input type="text" value="{{ isset($item) && !empty($item) ? $item->bank_name : ''}}" name="bank_name" class="formInput form-control" placeholder="Bank Name" id="bankName">
                        </div>
                    </div>

                    <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 7 ? '' : 'hidden' }}" id="swift_code">
                        <div class="col-md-12 col-12">
                            <label for="swiftCode" style="color:#000; font-weight: 700">SWIFT/BIC Code&nbsp<span class="text-danger">*</span></label>
                            <input type="text" value="{{ isset($item) && !empty($item) ? $item->swift : ''}}" name="swift_code" class="formInput form-control" placeholder="SWIFT/BIC Code" id="swiftCode">
                        </div>
                    </div>

                    <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 7 ? '' : 'hidden' }}" id="bank_address">
                        <div class="col-md-12 col-12">
                            <label for="bankAddress" style="color:#000; font-weight: 700">Bank Address&nbsp<span class="text-danger">*</span></label>
                            <input type="text" value="{{ isset($item) && !empty($item) ? $item->bank_address : ''}}" name="bank_address" class="formInput form-control" placeholder="Bank Address" id="bankAddress">
                        </div>
                    </div>

                    <div class="row form-group {{ isset($item) && !empty($item) && $item->withdraw_type_id == 7 ? '' : 'hidden' }}" id="routing_number">
                        <div class="col-md-12 col-12">
                            <label for="routingNumber" style="color:#000; font-weight: 700">Routing Number</label>
                            <input type="text" value="{{ isset($item) && !empty($item) ? $item->routing_number : ''}}" name="routing_number" class="formInput form-control" placeholder="Routing Number" id="routingNumber">
                        </div>
                    </div>

                    <div class="row form-group" id="setDefault">
                        <div class="col-md-12 col-12">
                            <label for="default" style="color:#000; font-weight: 700">Set default</label>
                            <input type="checkbox" name="default" id="default_edit" {{ isset($item) && !empty($item) && $item->default == 1 ? 'checked' : '' }} value="{{ isset($item) && !empty($item) && $item->default == 1 ? 1 : 0 }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-cancel filter__button" id="submit" onclick="updateMethod()">Update</button>
            </div>
        </form>

    </div>
</div>

<script>
    function chooseMethod2() {
        var bank_id = $('#choose').val();
        if(bank_id == ''){
            $('.modal-payment__group--icons').empty();
            $('#infoMethod2').empty();
        }else{
            callAjax(
                'GET',
                '{{ route('user.ajax.getmethod') }}' + '?bank_id='+bank_id,{},
                (response) => {
                    $('.modal-payment__group--icons').html(response.image);
                    $('#infoMethod2').html(response.html);
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

    function chooseType2(){
        var type_id = $('#editCrypto').val();
        callAjax(
            'GET',
            '{{ route('user.ajax.gettype') }}' + '?type_id='+type_id,{},
            (response) => {
                $('#getType2').html(response.html);
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

    $('#default_edit').click(function () {
        if($(this).prop('checked')){
            $(this).val(1);
        }else{
            $(this).val(0);
        }
    })
</script>


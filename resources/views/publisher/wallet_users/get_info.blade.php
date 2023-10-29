<div class="modal-payment__group">
    <div class="modal-payment__group--box"></div>
    <p class="content__threshold">(Minimum Payment Threshold: {{ $item->min }} USD)</p>
</div>
<div class="divider"></div>
<p class="text-danger">
    Fields mark with <span>*</span> are required
</p>
<div class="row form-group" id="email_payment">
    <div class="col-md-12 col-12">
        <label for="emailMethod" style="color:#000; font-weight: 700">{{ $item->name}} Email&nbsp<span class="text-danger">*</span></label>
        <input type="email" name="email" class="formInput form-control" placeholder="{{ $item->name}} Email" id="emailMethod">
    </div>
</div>

<div class="row form-group" id="type_crypto">
    <div class="col-md-12 col-12">
        <label for="typeCrypto" style="color:#000; font-weight: 700">Type crypto&nbsp<span class="text-danger">*</span></label>
        <select class="form-select form-control" name="type_crypto" onchange="chooseType()" aria-label="Default select example" id="typeCrypto">
            @foreach($banks_child as $bank_child)
                <option value="{{ $bank_child->id }}">{{ $bank_child->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div id="getType"></div>

<div class="row form-group" id="beneficiary">
    <div class="col-md-12 col-12">
        <label for="beneficiaryName" style="color:#000; font-weight: 700">Beneficiary Name&nbsp<span class="text-danger">*</span></label>
        <input type="text" name="beneficiary_name" class="formInput form-control" placeholder="Beneficiary Name" id="beneficiaryName">
    </div>
</div>

<div class="row form-group" id="acc_number">
    <div class="col-md-12 col-12">
        <label for="accNumber" style="color:#000; font-weight: 700">Account Number&nbsp<span class="text-danger">*</span></label>
        <input type="text" name="acc_number" class="formInput form-control" placeholder="Account Number" id="accNumber">
    </div>
</div>

<div class="row form-group" id="bank_name">
    <div class="col-md-12 col-12">
        <label for="bankName" style="color:#000; font-weight: 700">Bank Name&nbsp<span class="text-danger">*</span></label>
        <input type="text" name="bank_name" class="formInput form-control" placeholder="Bank Name" id="bankName">
    </div>
</div>

<div class="row form-group" id="swift_code">
    <div class="col-md-12 col-12">
        <label for="swiftCode" style="color:#000; font-weight: 700">SWIFT/BIC Code&nbsp<span class="text-danger">*</span></label>
        <input type="text" name="swift_code" class="formInput form-control" placeholder="SWIFT/BIC Code" id="swiftCode">
    </div>
</div>

<div class="row form-group" id="bank_address">
    <div class="col-md-12 col-12">
        <label for="bankAddress" style="color:#000; font-weight: 700">Bank Address&nbsp<span class="text-danger">*</span></label>
        <input type="text" name="bank_address" class="formInput form-control" placeholder="Bank Address" id="bankAddress">
    </div>
</div>

<div class="row form-group" id="routing_number">
    <div class="col-md-12 col-12">
        <label for="routingNumber" style="color:#000; font-weight: 700">Routing Number</label>
        <input type="text" name="routing_number" class="formInput form-control" placeholder="Routing Number" id="routingNumber">
    </div>
</div>

<div class="row form-group" id="setDefault">
    <div class="col-md-12 col-12">
        <label for="default" style="color:#000; font-weight: 700">Set default</label>
        <input type="checkbox" name="default" id="default" value="0">
    </div>
</div>


<script>
    $('#default').click(function () {
        if($(this).prop('checked')){
            $(this).val(1);
        }else{
            $(this).val(0);
        }
    })
</script>

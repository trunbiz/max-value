<div class="row form-group" id="usdt_network">
    <div class="col-md-12 col-12">
        <label for="networkUSDT" style="color:#000; font-weight: 700">Network&nbsp<span class="text-danger">*</span></label>
        <select class="form-select form-control" name="usdt_network" aria-label="Default select example" id="networkUSDT">
            <option value="BNB Smart Chain (BEP20)">BNB Smart Chain (BEP20)</option>
            <option value="Ethereum (ERC20)">Ethereum (ERC20)</option>
            <option value="Tron (TRC20)">Tron (TRC20)</option>
        </select>
    </div>
</div>

<div class="row form-group" id="eth_network">
    <div class="col-md-12 col-12">
        <label for="networkETH" style="color:#000; font-weight: 700">Network&nbsp<span class="text-danger">*</span></label>
        <select class="form-select form-control" name="eth_network" aria-label="Default select example" id="networkETH">
            <option value="BNB Smart Chain (BEP20)">BNB Smart Chain (BEP20)</option>
            <option value="Ethereum (ERC20)">Ethereum (ERC20)</option>
        </select>
    </div>
</div>

<div class="row form-group" id="bitcoin_network">
    <div class="col-md-12 col-12">
        <label for="networkBitcoin" style="color:#000; font-weight: 700">Network&nbsp<span class="text-danger">*</span></label>
        <select class="form-select form-control" name="bitcoin_network" aria-label="Default select example" id="networkBitcoin">
            <option value="BNB Smart Chain (BEP20)">BNB Smart Chain (BEP20)</option>
            <option value="Bitcoin">Bitcoin</option>
        </select>
    </div>
</div>

<div class="row form-group" id="address_network">
    <div class="col-md-12 col-12">
        <label for="addressNetwork" style="color:#000; font-weight: 700">{{ $item->name}} Address&nbsp<span class="text-danger">*</span></label>
        <input type="text" name="address_network" class="formInput form-control" placeholder="{{ $item->name}} Address" id="addressNetwork">
    </div>
</div>

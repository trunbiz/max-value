<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <form autocomplete="off">
            <div class="modal-body">
                <div class="modal-payment__title">
                    Add payment method
                </div>
                <div class="modal-payment__choose">Choose Paymend Method&nbsp<span class="text-danger">*</span></div>
                <div class="modal-payment__group">
                    <div class="modal-payment__group--icons">
                        <img src="{{ asset($item->image_path ?? '/public') }}" alt="{{ $item->name}}">
                    </div>
                    <div class="modal-payment__select">
                        <select class="form-select form-control" name="method" aria-label="Default select example" onchange="chooseMethod()">
                            <option value="">Choose</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->id }}" {{ (isset($item->id) && !empty($item->id) && $item->id == $bank->id ) ? 'selected' : '' }}>{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="infoMethod">
                    <div class="modal-payment__group">
                        <div class="modal-payment__group--box"></div>
                        <p class="content__threshold">(Minimum Payment Threshold: {{ $item->min }} USD)</p>
                    </div>
                    <div class="divider"></div>
                    <p class="text-danger">
                        Fields mark with <span>*</span> are required
                    </p>
                    <div class="row form-group">
                        <div class="col-md-12 col-12">
                            <label for="emailMethod" style="color:#000; font-weight: 700">{{ $item->name}} Email&nbsp<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="formInput form-control" placeholder="{{ $item->name}} Email" id="emailMethod">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-cancel filter__button" id="submit" onclick="storeMethod()">Add now</button>
            </div>
        </form>
    </div>
</div>

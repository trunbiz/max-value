<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" autocomplete="off">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="method">Method&nbsp<span class="text-danger">*</span></label>
                    <select class="form-select form-control" id="method" name="wallet_id"
                            aria-label="Default select example" required>
                        @foreach($items as $item)
                            @if($item->withdraw_type_id == 1 || $item->withdraw_type_id == 2)
                                <option value="{{ $item->id }}">{{ optional($item->withdrawType)->name}}
                                    - {{ $item->email }}</option>
                            @elseif($item->withdraw_type_id == 4 || $item->withdraw_type_id == 5 || $item->withdraw_type_id == 6)
                                <option value="{{ $item->id }}">{{ optional($item->withdrawType)->name}}
                                    - {{ $item->network_address }}</option>
                            @elseif($item->withdraw_type_id == 7)
                                <option value="{{ $item->id }}">{{ optional($item->withdrawType)->name}}
                                    - {{ $item->beneficiary_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="amount">Amount&nbsp<span class="text-danger">*</span></label>
                    <input type="text" name="amount" class="form-control" id="amount" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary filter__button" id="submit" onclick="createOrder()">Add
                    now
                </button>
            </div>
        </form>
    </div>
</div>

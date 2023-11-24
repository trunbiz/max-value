<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add payment method</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" autocomplete="off">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="method">Choose Paymend Method (<span class="text-danger">*</span>)</label>
                    <select class="form-select form-control" name="method" aria-label="Default select example" onchange="chooseMethod()">
                        @foreach($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="infoMethod"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary filter__button" id="submit" onclick="storeMethod()">Add
                    now
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    chooseMethod()
</script>


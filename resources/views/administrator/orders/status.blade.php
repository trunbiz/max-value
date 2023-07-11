<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cập nhật trạng thái</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="form-group mt-3">
                        <label>Trạng thái</label>
                        <select class="form-control select2_init" name="status">
                            <option value="">-Chọn-</option>
                            @foreach($status as $val).
                            <option value="{{ $val->id }}" {{ isset($item) && !empty($item) && $item->order_status_id == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" onclick="updateData({{$item->id}})">Lưu</button>
        </div>
    </div>
</div>

<style>
    @media (min-width: 1200px){
        .modal-xl {
            max-width: 1300px;
        }
    }
</style>

<script>
    $('.select2_init').select2({
        placeholder: "Chọn",
    });
</script>

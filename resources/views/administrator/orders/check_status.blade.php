<div class="col-xl-6" {{ $status == 1 ? '' : 'hidden' }}>
    <div class="card">
        <div class="form-group mt-3">
            <label>Tên nhà thuốc</label>
            <select class="form-control select2_init" name="parmacicy_id">
                <option value="">-Chọn-</option>
                @foreach($pharmas as $pharma).
                <option value="{{ $pharma->id }}" {{isset($item) && !empty($item) && $item->pharma_id == $pharma->id ? 'selected' : ''}}>{{ $pharma->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-xl-6" {{ $status == 1 ? '' : 'hidden' }}>
    <div class="card">
        <div class="form-group mt-3">
            <label>Người tạo</label>
            <select class="form-control select2_init" name="user_id">
                <option value="">-Chọn-</option>
                @foreach($users as $user).
                <option value="{{ $user->id }}" {{ isset($item) && !empty($item) && $item->user_id == $user->id ? 'selected' : ''  }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-xl-6" {{ $status == 1 ? 'hidden' : '' }}>
    <div class="card">
        <div class="form-group mt-3">
            <label>Tên nhà thuốc</label>
            <input class="form-control {{ $status == 1 ? '' : 'disabled' }}" value="{{optional($item->pharma)->name}}" disabled>
        </div>

    </div>
</div>
<div class="col-xl-6" {{ $status == 1 ? 'hidden' : '' }}>
    <div class="card">
        <div class="form-group mt-3">
            <label>Người tạo</label>
            <input class="form-control {{ $status == 1 ? '' : 'disabled' }}" value="{{optional($item->user)->name}}" disabled>
        </div>
    </div>
</div>

<script>
    $('.select2_init').select2({
        placeholder: "Chọn",
    });

</script>

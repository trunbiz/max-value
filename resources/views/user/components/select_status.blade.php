@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group mt-3">
    <label>Status</label>
    <select class="form-control" name="status">
        <option value="1" {{ $value == 1 ? 'selected' : ''}}>Pending</option>
        <option value="2" {{ $value == 2 ? 'selected' : ''}}>Published</option>
        <option value="3" {{ $value == 3 ? 'selected' : ''}}>Denied</option>
    </select>
    @error('category_id')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>

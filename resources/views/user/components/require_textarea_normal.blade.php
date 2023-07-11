@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group mt-3">
    <label>{{$label}} @include('user.components.lable_require')</label>
    <textarea style="min-height: 300px;" name="{{$name}}"
              class="form-control @error($name) is-invalid @enderror"
              rows="5" required>{{$value}}</textarea>
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>

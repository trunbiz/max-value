@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }
@endphp

<div class="form-group mt-3">
    <label>{{isset($label) ? $label :''}} @include('user.components.lable_require')</label>
    <select id="{{ $name }}" class="form-control choose_value select2_init{{(isset($can_create) && $can_create) ? '_tag' : ''}} @error($name) is-invalid @enderror" required
            name="{{$name}}">
        @if(!(isset($isDefaultFirst) && $isDefaultFirst))
            <option value="0">-Select-</option>
        @endif

        {!! $html_category !!}
    </select>
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>

<script>
    $('#{{ $name }}').val({{ $value }}).select2();
</script>

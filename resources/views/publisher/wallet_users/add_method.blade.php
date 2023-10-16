{{--<div class="card-body payment__info {{ isset($item) && !empty($item) && $item->default == 1 ? 'active' : '' }}" id="method{{ $item->id }}">--}}
{{--    <div class="payment__info--payment">--}}
{{--        <div class="general__info--payment-icon">--}}
{{--            <img src="{{ asset(optional($item->withdrawType)->image_path ?? '/public') }}" alt="">--}}
{{--        </div>--}}
{{--        <div class="payment__infoo--content">--}}
{{--            <p class="name__payment" {{ isset($item) && !empty($item) && $item->default == 1 ? 'style=color:red' : '' }}>{{ optional($item->withdrawType)->name}} {{ isset($item) && !empty($item) && $item->default == 1 ? '(Default)' : '' }}</p>--}}
{{--            <a href="mailto:demo123@gmail.com">{{$item->email}}</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="payment__action">--}}
{{--        <div class="payment__info--action">--}}
{{--            <a href="javascript:void(0)" onclick="editMethod({{ $item->id }})" class="btn__payment">Update</a>--}}
{{--        </div>--}}
{{--        <div class="payment__info--action delete__method" style="margin-top: 10px;">--}}
{{--            <a href="javascript:void(0)" onclick="deleteMethod({{ $item->id }})" class="btn__payment">Remove</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@foreach($items as $item)
    <div class="card-body payment__info {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? 'active' : '' }}" id="method{{ $item->id }}">
        <div class="payment__info--payment">
            <div class="general__info--payment-icon">
                <img src="{{ asset(optional($item->withdrawType)->image_path ?? '/public') }}" alt="">
            </div>
            <div class="payment__infoo--content">
                <p class="name__payment" {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? 'style=color:red' : '' }}>{{ optional($item->withdrawType)->name}} {{ isset($item->default) && !empty($item->default) && $item->default == 1 ? '(Default)' : '' }}</p>
                <a href="mailto:{{$item->email}}">{{$item->email}}</a>
            </div>
        </div>
        <div class="payment__action">
            <div class="payment__info--action">
                <a href="javascript:void(0)" onclick="editMethod({{ $item->id }})" class="btn__payment">Update</a>
            </div>
            <div class="payment__info--action delete__method" style="margin-top: 10px;">
                <a href="javascript:void(0)" onclick="deleteMethod({{ $item->id }})" class="btn__payment">Remove</a>
            </div>
        </div>
    </div>
@endforeach


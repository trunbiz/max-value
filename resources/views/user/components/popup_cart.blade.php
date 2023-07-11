@php
    $total = 0
@endphp
@if(isset($cart) && !empty($cart))
<ul class="header-card__list-item">

        @foreach($cart as $item)
            @php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            @endphp
            <li class="header-card__item">
                <img src="{{ $item['product_image'] }}"
                     alt="">

                <div class="header-card__item-info">
                    <div class="header-card__item-head">
                        <h5 class="header-card__item-name">
                            <a href="{{ route('user.home.filter_detail', ['slug' => $item['product_url']]) }}">
                                {{ $item['product_name'] }}
                            </a>
                        </h5>
                        <span class="header-card__item-quantity">Số lượng: {{ $item['quantity'] }}</span>

                    </div>
                    <span class="header-card__item-price">{{ number_format($item['price'], '0', '', '.') }}đ</span>
                </div>
            </li>
        @endforeach

</ul>
<div class="header-card__sum">
    <div class="header-card__sum-text">Tổng tiền ( {{ count($cart) }} ) sản phẩm</div>
    <div class="header-card__sum-price">{{ number_format($total, '0', '', '.') }}đ</div>
</div>
<button class="header-card__viewcart">
    <a href="{{ route('user.cart') }}" class="header-card__viewcart-text">Xem giỏ hàng</a>
</button>
</div>
@else
    <button class="header-card__viewcart">
        <a href="{{ route('user.home.filter') }}" class="header-card__viewcart-text">Mời bạn mua hàng</a>
    </button>
@endif

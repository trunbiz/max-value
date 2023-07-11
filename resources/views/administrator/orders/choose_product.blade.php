@php
    $total = 0;
    $cart = \Illuminate\Support\Facades\Session::get('cart');
@endphp
@foreach($cart as $item)
    @foreach($products as $product)
        @if($product->id == $item['product_id'])
            @php
                $subtotal = $product->sell_price * $item['quantity'];
                $total += $subtotal;
            @endphp
            <tr id="item{{ $item['product_id'] }}">
                <td><img class="img-fluid img-60" src="{{$product->image_url}}" alt="{{$product->name}}"></td>
                <td>
                    <div class="product-name"><h6>{{$product->name}}</h6></div>
                </td>
                <td>{{ number_format($product->sell_price, '0', '', '.') }}</td>
                <td>
                    <fieldset class="qty-box">
                        <div class="input-group bootstrap-touchspin">
                            <button class="btn btn-primary btn-square bootstrap-touchspin-down" type="button" onclick="minusQty({{$product->id}})"><i class="fa fa-minus"></i></button>
                            <span class="input-group-text bootstrap-touchspin-prefix" style="display: none;"></span>
                            <input class="touchspin text-center form-control" type="text" value="{{ (isset($item['quantity']) && !empty($item['quantity']) ? $item['quantity'] : 1) }}" name="quantity" onchange="updateQty({{$product->id}})" style="display: block;" min="1">
                            <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                            <button class="btn btn-primary btn-square bootstrap-touchspin-up" type="button" onclick="plusQty({{$product->id}})"><i class="fa fa-plus"></i></button>
                        </div>
                    </fieldset>
                </td>
                <td><span>{{ number_format($subtotal, '0', '', '.') }}</span> VNĐ</td>
                <td>
                    <div onclick="deleteItem({{$item['product_id']}})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </div>
                </td>
            </tr>
        @endif
    @endforeach
@endforeach
<tr>
    <td colspan="3"></td>
    <td class="total-amount">
        <h6 class="m-0 text-end"><span class="f-w-600">Tổng tiền :</span></h6>
    </td>
    <td><span>{{number_format($total, '0', '', '.')}}</span> VNĐ</td>
</tr>

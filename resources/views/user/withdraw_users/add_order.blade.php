<tr>
    <td scope="row" data-column="ID">
        <div class="info__payment">
            <span class="date-id">{{$item->id}}</span>
            {{--                                        <img src="{{ asset('assets/user/images/copy.png') }}" alt="">--}}
        </div>
    </td>
    <td class="column-primary p-0">
        <div class="info__payment">
            <div class="image__payment">
                <img src="{{ asset(optional(optional($item->walletUser)->withdrawType)->image_path ?? '/public') }}" alt="">
                {{--                                                <span class="name__payment">{{optional(optional($itemTransaction->walletUser)->withdrawType)->name}}</span>--}}
            </div>
            {{--                                            <i class="fa-solid fa-caret-down" onclick="toogleItem(1)"></i>--}}
        </div>
    </td>
    <td data-column="Status">
        {!! \App\Models\WithdrawStatus::htmlStatus(optional($item->statusWithdraw)->name) !!}
    </td>
    <td data-column="Amount">${{\App\Models\Formatter::formatMoney($item->amount)}}</td>
    <th data-column="Order Time">
        <p>{{$item->created_at}}</p>
        {{--                                        <p>12:00 AM</p>--}}
    </th>
    <th data-column="Payment Time">
        <p>{{$item->updated_at != $item->created_at ? $item->updated_at : ''}}</p>
        {{--                                        <p>11:59 PM</p>--}}
    </th>
</tr>

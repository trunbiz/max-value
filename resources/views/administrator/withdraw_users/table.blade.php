<tr class="item{{ $item->id }}">
    <td>{{ $position }}</td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        {{\App\Models\Formatter::getDateTime($item->updated_at)}}
    </td>
    <td>
        {{ optional($item->user)->email}}
    </td>

    <td>
        {{ optional($item->user)->name}}
    </td>

    <td>
        ${{ number_format($item->amount)}}
    </td>

    <td>
        <label onclick="changeStatus({{ $item->id }})" class="p-1" style="cursor:pointer; border-radius: 10px;background-color: {{optional($item->statusWithdraw)->color}}">
            {{ optional($item->statusWithdraw)->name}}
        </label>
    </td>
    <td>{{ optional(optional($item->walletUser)->withdrawType)->name }}</td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 1)
            {{ optional($item->walletUser)->email }}
        @endif
    </td>

    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 2)
            {{ optional($item->walletUser)->email }}
        @endif
    </td>
    <td>
        {{ optional($item->walletUser)->network }}
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 5)
            {{ optional($item->walletUser)->network_address }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 4)
            {{ optional($item->walletUser)->network_address }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 3)
            {{ optional($item->walletUser)->network_address }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 6)
            {{ optional($item->walletUser)->beneficiary_name }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 6)
            {{ optional($item->walletUser)->account_number }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 6)
            {{ optional($item->walletUser)->bank_name }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 6)
            {{ optional($item->walletUser)->swift }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 6)
            {{ optional($item->walletUser)->bank_address }}
        @endif
    </td>
    <td>
        @if(optional($item->walletUser)->withdraw_type_id == 6)
            {{ optional($item->walletUser)->routing_number }}
        @endif
    </td>
</tr>

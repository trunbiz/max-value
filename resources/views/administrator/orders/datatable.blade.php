<tr id="item{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>{{ $item->position }}</td>
    <td>
        {{ \App\Models\Helper::convert_date_from_db($item->created_at) }}
    </td>
    <td>
        {{optional($item->pharma)->name}}
    </td>
    <td>
        {{optional($item->user)->name}}
    </td>
    <td class="text-status">
        <span onclick="editStatus({{$item->id}})" class="btn btn-primary" style="color: #fff">{{ optional($item->orderStatus)->name}}</span>
    </td>
    <td>

        <a href="javascript:void(0)" onclick="editItem({{$item->id}})"
           class="btn btn-outline-secondary btn-sm edit" title="Xem đơn hàng">
            <i class="fa-solid fa-eye"></i>
        </a>

        <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete"
           title="Delete">
            <i class="fa-solid fa-x"></i>
        </a>
    </td>
</tr>

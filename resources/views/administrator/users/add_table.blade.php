<tr class="item{{ $item['api_publisher_id'] }}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item['api_publisher_id']}}">
    </td>
    <td>{{$item['api_publisher_id']}}</td>
    <td>
        {{ optional($item->manager)->name }}
    </td>
    <td>
        <form action="{{ route('administrator.imperrsonate') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $item['user_id'] }}">
            <button class="btn btn-primary"> {{$item['email']}}</button>
        </form>
    </td>
    <td></td>
    <td class="text-center">
        <i class="fa fa-check-circle" style="color: {{ (isset($item['email_verified_at']) && !empty($item['email_verified_at']) ? '#41C866' : '#aaaaaa') }}"></i>
    </td>
    <td>
        <a style="cursor: pointer;" onclick="onEditActiveModal('{{$item['api_publisher_id']}}','{{$item['active'] ? 'true' : 'false'}}')" data-bs-toggle="modal"
           data-bs-target="#editActiveModal">
            {{$item['active'] ? "Yes" : "No"}}
        </a>
    </td>
    <td>
        {{ '$'. $item->money}}
    </td>

    <td>{{$item['created_at']}}</td>
    <td>

        <a href="javascript:void(0)" onclick="edit({{ $item['api_publisher_id'] }})"
           title="Edit">
            <i class="fa-solid fa-pen"></i>
        </a>

        <a class="delete action_delete"
           href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item['api_publisher_id'] ])}}"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item['api_publisher_id'] ])}}"
           title="Delete">
            <i class="fa-solid fa-x text-danger"></i>
        </a>

    </td>
</tr>

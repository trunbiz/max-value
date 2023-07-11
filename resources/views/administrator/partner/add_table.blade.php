<tr class="item{{ $item['api_publisher_id'] }}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item['api_publisher_id']}}">
    </td>
    <td>{{$item['api_publisher_id']}}</td>
    <td>
        <form action="{{ route('administrator.imperrsonate') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $item['user_id'] }}">
            <button class="btn btn-primary"> {{$item['name']}}</button>
        </form>
    </td>
    <td>
       {{ $item['url'] }}
    </td>
    <td>{{ $item['partner_code'] }}</td>
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

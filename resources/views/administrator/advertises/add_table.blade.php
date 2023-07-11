<tr class="item{{ $item['id'] }}">
    <td>{{$item['id']}}</td>
    <td>{{$item['name']}}</td>
    <td>
        <a>{{ $item['site']['name'] }}</a>
    </td>
    <td>
        {{ $item['revenue_rate'] }}
    </td>
    <td id="container_adververs_{{$item['id']}}">
        <a STYLE="cursor: pointer;" onclick="showConfig('{{$item['id']}}')"
           title="Show">
            <i class="fa-regular fa-eye"></i>
        </a>
    </td>
    <td>
        {{ $item['created_at'] }}
    </td>
    <td>
        <div onclick="onEditZone('{{$item['id']}}','{{$item['status']['id']}}')"
             style="cursor: pointer;display: flex;" data-bs-toggle="modal"
             data-bs-target="#editZone">
            {!! \App\Models\Helper::htmlStatus($item['status']['name']) !!}
        </div>
    </td>

    <td>
        <a href="javascript:void(0)" {{ $item['status']['id'] == 7000 ? 'onclick=getCode('. $item["id"] . ')' : 'style=cursor:no-drop;opacity:0.5' }}
        title="Get code">
            <i class="fa-solid fa-eye"></i>
        </a>

        <a href="{{route('administrator.advertises.detail.index' , ['id'=> $item['id'] ])}}"
           title="Edit">
            <i class="fa-solid fa-pen"></i>
        </a>

        <a href="{{route('administrator.advertises.delete' , ['id'=> $item['id']])}}"
           data-url="{{route('user.advertises.delete' , ['id'=> $item['id']])}}"
           class="delete action_delete text-danger"
           title="Delete">
            <i class="fa-solid fa-x"></i>
        </a>
    </td>
</tr>

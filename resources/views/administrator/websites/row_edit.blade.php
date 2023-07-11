<td>{{ $item['id'] }}</td>
<td>
    <a style="text-decoration: underline;" target="_blank"
       href="{{ $item['url'] }}">{{ $item['url'] }}</a>
</td>
<td>
    @foreach($users as $itemUser)
        @if($item['publisher']['id'] == $itemUser->api_publisher_id)
            {{optional($itemUser->manager)->name}}
            @break
        @endif
    @endforeach
</td>
<td>{{ $item['publisher']['name'] }}</td>
<td>{{ $item['category']['name'] }}</td>
<td>
    <div onclick="oneditStatusModal('{{$item['id']}}','{{$item['status']['id']}}')"
         style="cursor: pointer;display: flex;" data-bs-toggle="modal"
         data-bs-target="#editStatusModal">
        {!! \App\Models\Helper::htmlStatus($item['status']['name']) !!}
    </div>
</td>
<td>
    <a style="cursor: pointer;" onclick="onEditActiveModal('{{$item['id']}}','{{$item['is_active'] ? 'true' : 'false'}}')" data-bs-toggle="modal"
       data-bs-target="#editActiveModal">
        {{$item['is_active'] ? "Yes" : "No"}}
    </a>
</td>
<td>
    <div style="max-height: 100px;overflow: auto;">

        @if(count($item['zones']) == 0)
            <a onclick="oneditStatusModal('{{$item['id']}}')" style="cursor: pointer;"
               data-bs-toggle="modal" data-bs-target="#createZoneModal">Create
                Zone</a>
        @else
            @foreach($item['zones'] as $itemZone)
                <a style="text-decoration: underline;"
                   href="{{route('administrator.advertises.detail.index' , ['id'=> $itemZone['id'] ])}}">{{$itemZone['name']}}</a>
            @endforeach
        @endif
    </div>
</td>
<td>
    {{$item['created_at']}}
</td>

<td>

    <a style="cursor: pointer;" onclick="onEditWebsiteModal('{{$item['id']}}','{{$item['publisher']['id']}}','{{$item['name']}}','{{$item['url']}}','{{$item['category']['id']}}')"
       title="Edit" data-bs-toggle="modal" data-bs-target="#editWebsiteModal">
        <i class="fa-solid fa-pen"></i>
    </a>

    <a
        href="{{route('user.advertises.index' , ['website_id'=> $item['id'] ])}}"
        title="Zones">
        <i class="fa-solid fa-cloud"></i>
    </a>

    <a
        href="{{route('user.reports.index' , ['website_id'=> $item['id'] ])}}"
        title="Report">
        <i class="fa-solid fa-chart-simple"></i>
    </a>

    <a onclick="oneditStatusModal('{{$item['id']}}')" style="cursor: pointer;"
       title="Add zone" data-bs-toggle="modal" data-bs-target="#createZoneModal">
        <i class="fa-solid fa-plus"></i>
    </a>

    <a class="delete action_delete"
       href="{{route('user.websites.delete' , ['id'=> $item['id'] ])}}"
       data-url="{{route('user.websites.delete' , ['id'=> $item['id'] ])}}"
       title="Delete Website">
        <i class="fa-solid fa-x text-danger"></i>
    </a>

</td>

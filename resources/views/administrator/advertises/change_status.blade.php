<div onclick="onEditZone('{{$item['id']}}','{{$item['status']['id']}}')"
     style="cursor: pointer;display: flex;" data-bs-toggle="modal"
     data-bs-target="#editZone">
    {!! \App\Models\Helper::htmlStatus($item['status']['name']) !!}
</div>

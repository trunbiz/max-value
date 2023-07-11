<div class="accordion-item" id="item{{ $item['id'] }}">
    <h2 class="accordion-header" id="heading{{ $item['id'] }}">
{{--        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item['id'] }}" aria-expanded="true" aria-controls="collapse{{ $item['id'] }}">--}}
        <button class="accordion-button" type="button" style="cursor:auto;">
            <div class="info__site">
                <div class="name__site">
                    {{$item['url']}}
                </div>
                <div class="status__site {{ strtolower($status) }}">
                    {{ $status }}
                </div>
                <div class="category__site">
                    <i class="fa-regular fa-folder"></i>
                    <span>{{ $category_name }}</span>
                </div>
            </div>
            @if($status == 'Approved')
                <div class="action__site">
    {{--                <a href="javascript:void(0)" class="action__site--item edit" onclick="getSite({{ $item['id'] }})">Edit</a>--}}
    {{--                <a href="javascript:void(0)" class="action__site--item add" data-bs-toggle="modal" data-bs-target="#addUnit">Create Ad unit</a>--}}
                </div>
            @endif
        </button>
    </h2>
    <div id="collapse{{ $item['id'] }}" data-id="{{ $item['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $item['id'] }}" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="list__advs">

            </div>
        </div>
    </div>
</div>

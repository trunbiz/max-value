<div class="list__advs--item">
    <div class="title__advs">
        <div class="title__advs--title">
            <span>{{ $item['name'] }}</span>
            <p>{{ $format }}</p>
        </div>
        <div class="title__advs--status {{ strtolower($status) }}">
            {{ $status }}
        </div>
    </div>
    <div class="info__advs">
        {{--                                            <div class="info__advs--edit">--}}
        {{--                                                <i class="fa-solid fa-pen-to-square"></i>--}}
        {{--                                                EDIT--}}
        {{--                                            </div>--}}
        <div class="info__advs--get" onclick="getCode({{ $item['id'] }})">
            <i class="fa-regular fa-clipboard"></i>
            GET CODE
        </div>
    </div>
</div>

<div>
{{--    <div class="row">--}}
{{--        <div class="col-md-1">--}}
{{--            <select name="limit" class="form-control select2_init">--}}
{{--                @foreach(config('_my_config.items_show_in_table') as $itemShowInTable)--}}
{{--                    <option--}}
{{--                        value="{{$itemShowInTable}}" {{request('limit') == $itemShowInTable ? 'selected' : ''}}>{{$itemShowInTable}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <div class="col-md-3">--}}
{{--            <input id="input_search_datetime" type="date"--}}
{{--                   class="bg-white form-control open-jquery-date-range" placeholder="--/--/--">--}}
{{--        </div>--}}

{{--        <div class="col-md-2">--}}
{{--            <select class="form-control" id="status">--}}
{{--                <option value="" {{ request('status') == '' ? 'selected' : ''}}>-Status-</option>--}}
{{--                <option value="1" {{ request('status') == 1 ? 'selected' : ''}}>Pending</option>--}}
{{--                <option value="2" {{ request('status') == 2 ? 'selected' : ''}}>Published</option>--}}
{{--                <option value="3" {{ request('status') == 3 ? 'selected' : ''}}>Denied</option>--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <div class="col-md-4 d-flex">--}}
{{--            <input id="input_search_query" type="text" class="form-control" placeholder="Search website..."--}}
{{--                   value="{{request('search_query')}}">--}}
{{--            <button class="btn btn-outline-primary ms-2" type="button" onclick="onSearchQuery()"><i--}}
{{--                    class="fa-solid fa-magnifying-glass"></i></button>--}}
{{--        </div>--}}


{{--    </div>--}}


    <a href="{{route('user.'.$prefixView.'.create')}}" class="btn btn-outline-success float-end"><i
            class="fa-solid fa-plus"></i></a>

{{--    <a href="{{route('user.'.$prefixView.'.export')}}" class="btn btn-outline-primary float-end me-2" data-bs-original-title="" title="Export excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>--}}

</div>


<script>

    $(document).ready(function (){

        $("#status").select2({
            placeholder: "-Status-",
        });
    })

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "search_query", value: $('#input_search_query').val()},
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
            {name: "status", value: $('#status').val()},
        ])
    }

</script>

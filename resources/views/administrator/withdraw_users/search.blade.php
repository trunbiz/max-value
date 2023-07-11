<div>
    <div class="mb-3">
        <a class="btn {{ request('withdraw_status_id') == 1 ? 'btn-secondary' : 'btn-primary'}}" href="{{ route('administrator.withdraw_users.index') }}?withdraw_status_id=1">Pending</a>
        <a class="btn {{ request('withdraw_status_id') == 2 ? 'btn-success' : 'btn-primary'}}" href="{{ route('administrator.withdraw_users.index') }}?withdraw_status_id=2">Approved</a>
        <a class="btn {{ request('withdraw_status_id') == 3 ? 'btn-danger' : 'btn-primary'}}" href="{{ route('administrator.withdraw_users.index') }}?withdraw_status_id=3">Reject</a>
    </div>

    <div class="row">

        <div class="col-md-1">
            <select name="limit" class="form-control select2_init">
                @foreach(config('_my_config.items_show_in_table') as $itemShowInTable)
                    <option
                        value="{{$itemShowInTable}}" {{request('limit') == $itemShowInTable ? 'selected' : ''}}>{{$itemShowInTable}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <input id="input_search_datetime" type="date"
                   class="bg-white form-control open-jquery-date-range" placeholder="--/--/--">
        </div>

{{--        <div class="col-md-2">--}}
{{--            <select class="form-control" id="status">--}}
{{--                <option value="" {{ request('status') == '' ? 'selected' : ''}}>-Status-</option>--}}
{{--                <option value="1" {{ request('status') == 1 ? 'selected' : ''}}>Pending</option>--}}
{{--                <option value="2" {{ request('status') == 2 ? 'selected' : ''}}>Published</option>--}}
{{--                <option value="3" {{ request('status') == 3 ? 'selected' : ''}}>Denied</option>--}}
{{--            </select>--}}
{{--        </div>--}}

        <div class="col-md-3 d-flex">
{{--            <input id="input_search_query" type="text" class="form-control" placeholder="Search..."--}}
{{--                   value="{{request('search_query')}}">--}}

            <button class="btn btn-outline-primary ms-2" type="button" onclick="onSearchQuery()"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <div class="col-md-5">
            <a href="{{route('administrator.'.$prefixView.'.export')}}?withdraw_status_id={{request('withdraw_status_id')}}" class="btn btn-outline-success float-end me-2" data-bs-original-title="" title="Export excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>

        </div>
    </div>


</div>


<script>
    $(document).ready(function () {
        $("#user").select2({
            placeholder: "-Publisher-",
        });

        $("#category").select2({
            placeholder: "-Category-",
        });

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
            {name: "category", value: $('#category').val()},
            {name: "user", value: $('#user').val()},
        ])
    }

</script>

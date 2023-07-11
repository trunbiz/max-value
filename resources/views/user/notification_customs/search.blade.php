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

{{--        <div class="col-md-2">--}}
{{--            <button class="btn btn-outline-primary ms-2" type="button" onclick="onSearchQuery()"><i--}}
{{--                    class="fa-solid fa-magnifying-glass"></i></button>--}}
{{--        </div>--}}


{{--    </div>--}}

    <a href="{{route('user.'.$prefixView.'.create')}}" class="btn btn-outline-success float-end"><i
            class="fa-solid fa-plus"></i></a>
</div>


<script>

    $(document).ready(function (){
        $("#website").select2({
            placeholder: "-Website-",
        });

        $("#status").select2({
            placeholder: "-Status-",
        });
    })

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
            {name: "status", value: $('#status').val()},
            {name: "website", value: $('#website').val()},
        ])
    }

</script>

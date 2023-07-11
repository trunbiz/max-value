<div>
    <div>
        <div class="float-start">
            <select name="limit" class="form-control select2_init">
                @foreach(config('_my_config.items_show_in_table') as $itemShowInTable)
                    <option
                        value="{{$itemShowInTable}}" {{request('limit') == $itemShowInTable ? 'selected' : ''}}>{{$itemShowInTable}}</option>
                @endforeach
            </select>
        </div>

        <div class="float-start ms-2">
            <select class="form-control" id="publisher_id" style="width: 200px;" name="publisher_id">
                <option value="">-Publisher-</option>
                @foreach($users as $user)
                    <option value="{{ $user['api_publisher_id'] }}" {{ request('publisher_id') == $user['api_publisher_id'] ? 'selected' : ''}}>{{ $user['email'] }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div>
        <a href="#" class="btn btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#createWebsiteModal"><i
                class="fa-solid fa-plus"></i></a>
    </div>

</div>


<script>
    $(document).ready(function (){
        $("#publisher_id").select2({
            placeholder: "- Publisher -",
        });
    })

    $('select[name="limit"]').on('change', function () {
        addUrlParameter('limit', this.value)
    });

    $('select[name="publisher_id"]').on('change', function () {
        addUrlParameter('publisher_id', this.value)
    });


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

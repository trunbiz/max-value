<div>
    <div class="row">
        <div class="col-md-1">
            <div class="mt-1">
                <select name="limit" class="form-control select2_init">
                    @foreach(config('_my_config.items_show_in_table') as $itemShowInTable)
                        <option
                            value="{{$itemShowInTable}}" {{request('limit') == $itemShowInTable ? 'selected' : ''}}>{{$itemShowInTable}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mt-1">
                <input id="input_search_datetime" type="date"
                       class="bg-white form-control open-jquery-date-range" placeholder="--/--/--">
            </div>
        </div>

        <div class="col-md-2">
            <div class="mt-1">
                <select class="form-control" id="website">
                    <option value="">-Website-</option>
                    @foreach($websites as $website)
                        <option value="{{ $website['id'] }}" {{ request('website_id') == $website['id'] ? 'selected' : ''}}>{{ $website['name'] }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="col-md-2">
            <div class="mt-1">
                <select class="form-control" id="zone">
                    <option value="">-Zone-</option>
                    @foreach($zones as $itemZone)
                        <option value="{{ $itemZone['id'] }}" {{ request('zone_id') == $itemZone['id'] ? 'selected' : ''}}>{{ $itemZone['name'] }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="col-md-2">
            <div class="mt-1">
                <button class="btn btn-outline-primary" type="button" onclick="onSearchQuery()"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>

        </div>


    </div>
</div>


<script>

    $(document).ready(function (){
        $("#website").select2({
            placeholder: "-Website-",
            allowClear: true
        });

        $("#zone").select2({
            placeholder: "-Zone-",
            allowClear: true
        });
    })

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
            {name: "status", value: $('#status').val()},
            {name: "website_id", value: $('#website').val()},
            {name: "zone_id", value: $('#zone').val()},
        ])
    }

</script>

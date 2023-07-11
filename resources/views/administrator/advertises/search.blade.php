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
            <select class="form-control" id="website_id" name="website_id">
                <option value="">-Website-</option>
                @foreach($websites as $itemWebsites)
                    <option value="{{ $itemWebsites['id'] }}" {{ request('website_id') == $itemWebsites['id'] ? 'selected' : ''}}>{{ $itemWebsites['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <a href="#" class="btn btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#createModal"><i
                class="fa-solid fa-plus"></i></a>
    </div>

</div>


<script>

    $(document).ready(function (){
        $("#website_id").select2({
            placeholder: "- Website -",
        });
    })

    $('select[name="limit"]').on('change', function () {
        addUrlParameter('limit', this.value)
    });

    $('select[name="website_id"]').on('change', function () {
        addUrlParameter('website_id', this.value)
    });

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "search_query", value: $('#input_search_query').val()},
            {name: "website_id", value: $('#website_id').val()},
        ])
    }

</script>

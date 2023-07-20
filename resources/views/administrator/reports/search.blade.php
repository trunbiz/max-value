<div>
    <form action="" method="GET">
        <div class="row">
            <div class="col-md-3">
                <div class="mt-1">
                    <input id="input_search_datetime" type="date" name="from"
                           class="bg-white form-control open-jquery-date-range" placeholder="--/--/--">
                </div>
            </div>

            <div class="col-md-2">
                <div class="mt-1">
                    <select class="form-control" id="advertiser" name="advertiser">
                        <option value="">-Advertiser-</option>
                        @foreach($adversier as $itemAdv)
                            <option
                                value="{{ $itemAdv['id'] }}" {{ request('advertiser') == $itemAdv['id'] ? 'selected' : ''}}>{{ $itemAdv['email'] }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-md-2">
                <div class="mt-1">
                    <select class="form-control" id="user_id" name="user_id">
                        <option value="">-User-</option>
                        @foreach($users as $itemUser)
                            <option
                                value="{{ $itemUser['id'] }}" {{ request('user_id') == $itemUser['id'] ? 'selected' : ''}}>{{ $itemUser['email'] }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-md-2">
                <div class="mt-1">
                    <select class="form-control" id="site" name="website_id">
                        <option value="">-Site-</option>
                        @foreach($websites as $website)
                            <option
                                value="{{ $website['id'] }}" {{ request('website_id') == $website['id'] ? 'selected' : ''}}>{{ $website['name'] }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-md-2">
                <div class="mt-1">
                    <select class="form-control" id="zone" name="zone_id">
                        <option value="">-Zone-</option>
                        @foreach($zones as $itemZone)
                            <option
                                value="{{ $itemZone['id'] }}" {{ request('zone_id') == $itemZone['id'] ? 'selected' : ''}}>{{ $itemZone['name'] }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-md-1">
                <div class="mt-1">
                    <button class="btn btn-outline-primary"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>

            </div>
        </div>
    </form>
</div>


<script>

    $(document).ready(function () {
        $("#advertiser").select2({
            placeholder: "-Advertiser-",
            allowClear: true
        });

        $("#site").select2({
            placeholder: "-Website-",
            allowClear: true
        });

        $("#zone").select2({
            placeholder: "-Zone-",
            allowClear: true
        });

        $("#user_id").select2({
            placeholder: "-Publisher-",
            allowClear: true
        });
    })

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
            {name: "user_id", value: $('#user_id').val()},
            {name: "website_id", value: $('#site').val()},
            {name: "zone_id", value: $('#zone').val()},
        ])
    }

</script>

<form action="{{route('administrator.websites.index')}}" method="GET">
        <div class="row">
            <div class="col-sm-3">
                <select class="form-control" id="publisher_id" name="publisher_id">
                    <option value="">-Publisher-</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('publisher_id') == $user->id ? 'selected' : ''}}>{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="website" name="website_id">
                    <option value="">-Website-</option>
                    @foreach($websites as $website)
                        <option value="{{ $website->id }}" {{ request('website_id') == $website->id ? 'selected' : ''}}>{{ $website->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="zone" name="zone_id">
                    <option value="">-Zone-</option>
                    @foreach($zones as $zone)
                        <option value="{{ $zone->id }}" {{ request('zone_id') == $zone->id ? 'selected' : ''}}>{{ $zone->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="status" name="status">
                    <option value="">-All status-</option>
                    <option value="3520" {{ request('status') == 3520 ? 'selected' : ''}}>Pending</option>
                    <option value="3500" {{ request('status') == 3500 ? 'selected' : ''}}>Approved</option>
                    <option value="3525" {{ request('status') == 3525 ? 'selected' : ''}}>Verification</option>
                    <option value="3510" {{ request('status') == 3510 ? 'selected' : ''}}>Rejected</option>
                </select>
            </div>
        </div>
    <br>
    <div class="row">
            <div class="col-sm-3">
                <select class="form-control" id="manager" name="manager_id">
                    <option value="">-manager-</option>
                    @foreach($listUserGroupAdmin as $am)
                        <option value="{{ $am->id }}" {{ request('manager_id') == $am->id ? 'selected' : ''}}>{{ $am->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
</form>

<div>
    <a href="#" class="btn btn-outline-success float-end" data-bs-toggle="modal" data-bs-target="#createWebsiteModal"><i
            class="fa-solid fa-plus"></i></a>
</div>
<script>
    $(document).ready(function () {
        $("#publisher_id, #website, #zone, #status, #manager").select2({});
    })

    $('select[name="limit"]').on('change', function () {
        addUrlParameter('limit', this.value)
    });

    // $('select[name="publisher_id"]').on('change', function () {
    //     addUrlParameter('publisher_id', this.value)
    // });


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

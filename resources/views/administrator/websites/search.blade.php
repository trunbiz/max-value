<form action="{{route('administrator.websites.index')}}" method="GET">
        <div class="row">
            <div class="col-sm-3">
                <select class="form-control" id="publisher_id" name="publisher_id">
                    <option value="">-Publisher-</option>
                    @foreach($users as $user)
                        <option value="{{ $user['api_publisher_id'] }}" {{ request('publisher_id') == $user['api_publisher_id'] ? 'selected' : ''}}>{{ $user['email'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="website" name="website_id">
                    <option value="">-Website-</option>
                    @foreach($websites as $website)
                        <option value="{{ $user['api_publisher_id'] }}" {{ request('publisher_id') == $user['api_publisher_id'] ? 'selected' : ''}}>{{ $user['email'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="zone" name="zone_id">
                    <option value="">-Zone-</option>
                    @foreach($zones as $zone)
                        <option value="{{ $user['api_publisher_id'] }}" {{ request('publisher_id') == $user['api_publisher_id'] ? 'selected' : ''}}>{{ $user['email'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="status" name="status">
                    <option value="">-Active-</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="manager" name="manager_id">
                    <option value="">-manager-</option>
                    @foreach($users as $user)
                        <option value="{{ $user['api_publisher_id'] }}" {{ request('publisher_id') == $user['api_publisher_id'] ? 'selected' : ''}}>{{ $user['email'] }}</option>
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
        $("#publisher_id, #website").select2({});
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

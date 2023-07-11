<div class="">

{{--    <a href="{{route('administrator.'.$prefixView.'.create')}}" class="btn btn-outline-success float-end"><i--}}
{{--            class="fa-solid fa-plus"></i></a>--}}
    @include('administrator.components.search')
</div>

<div class="form-group mt-3" style="position: relative; top: 20px; width: 10%">
    <select name="status" class="select2_init" onchange="onSearchQuery()">
        <option value="">Status</option>
        <option value="1" {{ (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 1) ? 'selected' : '' }}>Not Answer</option>
        <option value="2" {{ (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 2) ? 'selected' : '' }}>Answered</option>
        <option value="3" {{ (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 3) ? 'selected' : '' }}>Closed</option>
    </select>
</div>

<script>

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "search_query", value: $('#input_search_query').val()},
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
            {name: "status", value: $('select[name="status"]').val()},
        ])
    }

</script>

<div>
    @include('administrator.components.search')

    <a href="{{route('administrator.'.$prefixView.'.create')}}" class="btn btn-outline-success float-end"><i
            class="fa-solid fa-plus"></i></a>
</div>


<script>

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "search_query", value: $('#input_search_query').val()},
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
        ])
    }

</script>

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

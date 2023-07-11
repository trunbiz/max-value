@if(isset($items) && !empty($items))
    @foreach($items as $item)
        <li class="item__value" onclick="chooseProduct({{ $item->id }})">{{ $item->name }}</li>
    @endforeach
@endif

<script>
    function chooseProduct(id) {
         $this = $('#orderProduct');
        callAjax(
            'GET',
            '{{ route('ajax.administrator.orders.choose.product') }}',
            {
                'product_id' : id,
            },
            (response) => {
                $this.html(response.html);
                $('#result').empty();
                $('input[name="product_id"]').val('');
            }
        )
    }
</script>

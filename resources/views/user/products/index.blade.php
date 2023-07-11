<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<button onclick="addToCart(100)">Thêm vào giỏ</button>
<button onclick="addToCart(99)">Thêm vào giỏ</button>

<script src="{{asset('/assets/administrator/js/jquery-3.5.1.min.js')}}"></script>
<script>
    function callAjax(method, url, data, success) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            type: method,
            url: url,
            beforeSend: function() {
                $('#loader').removeClass('loading');
            },
            success: function( response, textStatus, jqXHR ) {
                success(response);
            },
            complete: function(){
                $('#loader').addClass('loading');
            },
            error: function( jqXHR, textStatus, errorThrown ) {
                alert( errorThrown );
            }
        })
    }

    function addToCart(id) {
        callAjax(
            'POST',
            '{{ route('user.checkout.add.to.cart') }}',
            {
                id : id,
                quantity : 1,
            },
            (response) => {
                alert('Thêm thành công');
            },
        )
    }
</script>

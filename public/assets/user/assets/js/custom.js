function handleDecrement(id) {
    var input = $('#item'+id).find('.quantity-number'),
        min = input.attr('min');
    $('.quantity-icon').addClass('disabled');
    var oldValue = parseFloat(input.html());
    if (oldValue <= min) {
        var newVal = oldValue;
    } else {
        var newVal = oldValue - 1;
    }
    $('#item'+id).find('.quantity-number').html(newVal).change();
}

function handleIncrement(id) {
    var input = $('#item'+id).find('.quantity-number');
    $('.quantity-icon').addClass('disabled');
    var oldValue = parseFloat(input.html());
    var newVal = oldValue + 1;
    $('#item'+id).find('.quantity-number').html(newVal).change();
}

function callAjax(method, url, data, success) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        type: method,
        url: url,
        beforeSend: function() {
            $('#loader').removeClass('load');
        },
        success: function( response, textStatus, jqXHR ) {
            success(response);
        },
        complete: function(){
            $('#loader').addClass('load');
        },
        error: function( err ) {
            swal("Success!", err.message, "success");
        }
    })
}

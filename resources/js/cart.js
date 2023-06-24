(function($) {



    $('.item-quantity').on('change',function(e) {

        $.ajax({
            url: "/cart/" + $(this).data('id'), //data-id
            method:'PUT',
            data:{
                quantity: $(this).val(),
                _token: csrf_token,
            }
        });
    });

        $('.remove-item').on('click',function(e) {
        let id = $(this).data('id');
        $.ajax({
            url: "/cart/" + id, //data-id
            method:'delete',
            data:{
                _token: csrf_token,
            },
            success: Response=>{
                $(`#${id}`).remove();
            }
        });
    });

    $('.add-to-cart').on('click', function (e) {
        let id = $(this).data('id');
        $.ajax({
            method: 'POST',
            data: {
                product_id: id,
                _token: csrf_token,
            },
            success: function (response) {
                // Handle the success response
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Handle the error response
                console.error(error);
            }
        });
    });

})(jQuery);

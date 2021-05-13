$(document).ready(function() {
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-primary btn-sm editable-submit">'+
        '<i class="icon-ok icon-white"></i>'+
        '</button>'+
        '<button type="button" class="btn btn-default btn-sm editable-cancel">'+
        '<i class="icon-remove"></i>'+
        '</button>';

    $('.quantity').editable({
        validate: function(value, old) {
            if($.trim(value) == '') {
                return 'This field is required';
            }
            if(parseInt($.trim(value)) > parseInt($(this).html())) {
                return 'You cannot change to a higher quantity';
            }

            var totalPrice = $('#totalPrice').text();
            totalPrice = parseInt(totalPrice, 10) - $(this).closest('td').prev('td').find(".productPrice").text();

            $('#totalPrice').text(totalPrice);

        },
        success: function(response, newValue) {
            if(response.status == 'error') return response.msg; //msg will be shown in editable form
            $(this).closest('td').prev('td').find(".productPrice").text(response);

            var totalPrice = $('#totalPrice').text();
            totalPrice = parseInt(totalPrice, 10) + parseInt(response);

            $('#totalPrice').text(totalPrice);

            window.location.reload();
        }
    });
});
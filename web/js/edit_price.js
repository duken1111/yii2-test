$(document).ready(function () {
    init('#price-create-form');

    $('.price-edit').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: '/price/get-modal-form?id=' + id,
            type: 'GET',
            success: function (data) {
                $("#price-modal .modal-body").html(data);
                $("#price-modal").modal('show');
                init('#price-edit-form');
            }
        });
    });
});

function init(wrapper) {
    if (!wrapper) {
        return;
    }

    var $wrapper = $(wrapper);
    var $quantity = $wrapper.find('#price-quantity');

    var priceValue = $wrapper.find('#price-price').val();
    if (!priceValue || priceValue == 0) {
        $quantity.prop("disabled", true);
    }

    $wrapper.find('#price-price').change(function () {
        var value = $(this).val();
        if (value > 0) {
            $quantity.prop("disabled", false);
        } else {
            $quantity.attr('value', 0);
            $quantity.prop("disabled", true);
        }
    });
}
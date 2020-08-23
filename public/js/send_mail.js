"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.send_mail').length) {
    $(".send_mail").bootstrapValidator({
        fields: {
            message: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your message'
                    }
                },
                required: true
            }

        }
    });
}


$('#rootwizard .finish').click(function () {
    var $validator = $('#send_mail').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("send_mail").submit();
    }
});

"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.course_form').length) {
    $(".course_form").bootstrapValidator({
        fields: {
            course_title: {
                validators: {
                    notEmpty: {
                        message: 'The course name is required'
                    }
                },
                required: true,
                minlength: 3
            },

            course_description: {
                validators: {
                    notEmpty: {
                        message: 'The course description is required'
                    }
                },
                required: true
            }

        }
    });
}


$('#rootwizard .finish').click(function () {
    var $validator = $('#course_form').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("course_form").submit();
    }
});

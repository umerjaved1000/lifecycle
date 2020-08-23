"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.submit_course_material').length) {
    $(".submit_course_material").bootstrapValidator({
        fields: {
            document_name: {
                validators: {
                    notEmpty: {
                        message: 'Enter documnet name'
                    }
                },
                required: true,
                minlength: 3
            },
            course_material: {
                validators: {
                    notEmpty: {
                        message: 'Select course file'
                    }
                }
            },
            document_description: {
                validators: {
                    notEmpty: {
                        message: 'Enter details'
                    }
                }
            }

        }
    });
}
$('#rootwizard .finish').click(function () {
    var $validator = $('#submit_course_material').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("submit_course_material").submit();
    }
});

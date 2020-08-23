"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.booking_form').length) {
    $(".booking_form").bootstrapValidator({
        fields: {
            customer_name: {
                validators: {
                    notEmpty: {
                        message: 'Customer name is required'
                    }
                },
                required: true
            },

            customer_email: {
                validators: {
                    notEmpty: {
                        message: 'Customer email is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                },
                required: true
            },
            customer_landline: {
                validators: {
                    notEmpty: {
                        message: 'Customer landline is required'
                    }
                },
                required: true
            },
            course: {
                validators: {
                    notEmpty: {
                        message: 'Course is required'
                    }
                },
                required: true
            },
            fees: {
                validators: {
                    notEmpty: {
                        message: 'Fees is required'
                    }
                },
                required: true
            },
            trainer: {
                validators: {
                    notEmpty: {
                        message: 'Please select trainer'
                    }
                }
            },
            cost: {
                validators: {
                    notEmpty: {
                        message: 'Cost is required'
                    }
                },
                required: true
            },
            venue: {
                validators: {
                    notEmpty: {
                        message: 'Please select venue'
                    }
                }
            },
            customer_discount: {
                validators: {
                    notEmpty: {
                        message: 'Please add discount rate'
                    }
                }
            },
            course_type: {
                validators: {
                    notEmpty: {
                        message: 'Please select course type'
                    }
                }
            },
            course_status: {
                validators: {
                    notEmpty: {
                        message: 'Please select coure status'
                    }
                }
            }
        }
    });
}
$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-tabs',
    'onNext': function (tab, navigation, index) {
        var $validator = $('.booking_form').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function (tab, navigation, index) {
        var $validator = $('.booking_form').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabShow: function (tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;

        // If it's the last tab then hide the last button and show the finish instead
        if ($current >= $total) {
            $('#rootwizard').find('.pager .next').hide();
            $('#rootwizard').find('.pager .finish').show();
            $('#rootwizard').find('.pager .finish').removeClass('disabled');
        } else {
            $('#rootwizard').find('.pager .next').show();
            $('#rootwizard').find('.pager .finish').hide();
        }
    }});

$('#rootwizard .finish').click(function () {
    var $validator = $('#booking_form').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("booking_form").submit();
    }
});
function get_customer() {
    var id = $('.select2').val();

    $.ajax({
        url: '/get_customer_details/' + id,
        type: 'get',
        dataType: 'json',
        success: function (result) {
            $('.customer_info').show();
            $('#customer_email').html(result.email);
            $('#customer_landline').html(result.landline);
            $('#customer_discount').html(result.discount_rate);
        }
    });
}
function get_trainer() {
    var course_id = $('.select_course').val();
    var venue_id = $('#select_venue').val();
    $.ajax({
        url: '/get_trainer/' + course_id + '/' + venue_id,
        type: 'get',
        dataType: 'json',
        success: function (result) {
            if (result.success === 1) {
                $("#tab3").html('');
                $("#tab3").html(result.html);
                $("#get_trainer_id").val(result.id);
            }
        }
    });
}
$('#course').change(function () {
    
    $('#select_venue').val('');
});

function show_other_trainers() {
    jQuery('.other_trainers').show();
    $("#other_trainer").change(function () {
        var trainer = $(this).val();
        $.ajax({
            url: '/other_trainer/' + trainer,
            type: 'get',
            dataType: 'json',
            success: function (result) {

                $("#tab3 .trainer_details").html('');
                $("#tab3 .trainer_details").html(result.html);
                $("#get_trainer_id").val(result.id);

            }
        });
    });
}
$("#other_trainer").change(function () {
    var trainer = $(this).val();
    $.ajax({
        url: '/other_trainer/' + trainer,
        type: 'get',
        dataType: 'json',
        success: function (result) {

            $("#tab3 .trainer_details").html('');
            $("#tab3 .trainer_details").html(result.html);
            $("#get_trainer_id").val(result.id);

        }
    });
});
$("#select_venue").change(function () {
    $('.venue_fees').removeClass('hidden');
    var venue = $(this).val();
    $.ajax({
        url: '/venue_fees/' + venue,
        type: 'get',
        dataType: 'json',
        success: function (result) {
            $("#input_venue_fees").val(result.fees);
        }
    });
});

function addDelegate() {
    var clone = $('.default-delegate').clone();
    $(clone).removeClass('default-delegate');
    $(clone).addClass('cloned_item');
    $(clone).find('.delete-delegate').removeClass('hidden');
    $(clone).children().find('.delegate_name').val('');
    $(clone).children().find('.delegate_email').val('');
    $(clone).children().find('.delegate_license').val('');
    $(clone).children().find('.delegate_telephone').val('');
    $('.delegates-container').append(clone);
}
function removeDelegate(item) {
    $(item).parent().parent().remove();
}


"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.trainer_form').length) {
    $(".trainer_form").bootstrapValidator({
        fields: {
            trainer_name: {
                validators: {
                    notEmpty: {
                        message: 'Trainer name is required'
                    }
                },
                required: true,
                minlength: 3
            },

            trainer_email: {
                validators: {
                    notEmpty: {
                        message: 'Trainer email is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                },
                required: true
            },
            trainer_address: {
                validators: {
                    notEmpty: {
                        message: 'Trainer address is required'
                    }
                },
                required: true
            },
            trainer_region: {
                validators: {
                    notEmpty: {
                        message: 'Trainer region is required'
                    }
                },
                required: true
            },
            trainer_post_code: {
                validators: {
                    notEmpty: {
                        message: 'Trainer post code is required'
                    }
                },
                required: true
            },
            trainer_landline: {
                validators: {
                    notEmpty: {
                        message: 'Trainer landline is required'
                    }
                },
                required: true
            },
            trainer_mobile: {
                validators: {
                    notEmpty: {
                        message: 'Trainer mobile is required'
                    }
                },
                required: true
            },
            trainer_fees: {
                validators: {
                    notEmpty: {
                        message: 'Trainer fees is required'
                    }
                },
                required: true
            },
            trainer_contact: {
                validators: {
                    notEmpty: {
                        message: 'Trainer contact is required'
                    }
                },
                required: true
            },
            trainer_courses: {
                validators: {
                    notEmpty: {
                        message: 'Please select trainer course'
                    }
                }
            },
            trainer_password: {
                validators: {
                    notEmpty: {
                        message: 'Trainer password is required'
                    }
                }
            },
            trainer_level: {
                validators: {
                    notEmpty: {
                        message: 'Please select Trainer level'
                    }
                }
            }
        }
    });
}

$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function (tab, navigation, index) {
        var $validator = $('#trainer_form').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function (tab, navigation, index) {
        var $validator = $('#trainer_form').data('bootstrapValidator').validate();
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
    var $validator = $('#trainer_form').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("trainer_form").submit();
    }
});

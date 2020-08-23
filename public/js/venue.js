"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.venue_form').length) {
    $(".venue_form").bootstrapValidator({
        fields: {
            venue_name: {
                validators: {
                    notEmpty: {
                        message: 'The venue name is required'
                    }
                },
                required: true,
                minlength: 3
            },

            venue_email: {
                validators: {
                    notEmpty: {
                        message: 'The venue email is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                },
                required: true
            },
            venue_post_code: {
                validators: {
                    notEmpty: {
                        message: 'The venue post code is required'
                    }
                },
                required: true
            },
            venue_landline: {
                validators: {
                    notEmpty: {
                        message: 'The venue landline is required'
                    }
                },
                required: true
            },
            venue_mobile: {
                validators: {
                    notEmpty: {
                        message: 'The venue mobile is required'
                    }
                },
                required: true
            },
            venue_address: {
                validators: {
                    notEmpty: {
                        message: 'The venue address is required'
                    }
                },
                required: true
            },
            venue_region: {
                validators: {
                    notEmpty: {
                        message: 'The venue region is required'
                    }
                },
                required: true
            },
            venue_contact_email: {
                validators: {
                    notEmpty: {
                        message: 'The  venue contact email is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                },
                required: true
            },
            venue_contact_name: {
                validators: {
                    notEmpty: {
                        message: 'The venue contact name is required'
                    }
                },
                required: true
            },
            venue_contact_landline: {
                validators: {
                    notEmpty: {
                        message: 'The venue contact landline is required'
                    }
                },
                required: true
            },
            venue_contact_mobile: {
                validators: {
                    notEmpty: {
                        message: 'The venue contact mobile is required'
                    }
                },
                required: true
            },
            venue_fees: {
                validators: {
                    notEmpty: {
                        message: 'Please select fees'
                    }
                },
                required: true
            },
            venue_facilities: {
                validators: {
                    notEmpty: {
                        message: 'Please select facility'
                    }
                },
                required: true
            }
        }
    });
}

$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-tabs',
    'onNext': function (tab, navigation, index) {
        var $validator = $('#venue_form').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function (tab, navigation, index) {
        var $validator = $('#venue_form').data('bootstrapValidator').validate();
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
    var $validator = $('#venue_form').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("venue_form").submit();
    }
});

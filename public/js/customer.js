"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.customer_form').length) {
    $(".customer_form").bootstrapValidator({
        fields: {
            customer_name: {
                validators: {
                    notEmpty: {
                        message: 'customer name is required'
                    }
                },
                required: true,
                minlength: 3
            },

            customer_email: {
                validators: {
                    notEmpty: {
                        message: 'customer email is required'
                    },
                    emailAddress: {
                        message: 'input is not a valid email address'
                    }
                },
                required: true
            },
            customer_post_code: {
                validators: {
                    notEmpty: {
                        message: 'customer post code is required'
                    }
                },
                required: true
            },
            customer_landline: {
                validators: {
                    notEmpty: {
                        message: 'customer landline is required'
                    }
                },
                required: true
            },
            customer_mobile: {
                validators: {
                    notEmpty: {
                        message: 'customer mobile is required'
                    }
                },
                required: true
            },
            customer_marketing_opt: {
                validators: {
                    notEmpty: {
                        message: 'customer customer marketing option is required'
                    }
                },
                required: true
            },
            customer_status: {
                validators: {
                    notEmpty: {
                        message: 'Please select customer status'
                    }
                }
            },
            client_type: {
                validators: {
                    notEmpty: {
                        message: 'Please select client type'
                    }
                }
            },
            contact_method: {
                validators: {
                    notEmpty: {
                        message: 'contact method is required'
                    }
                }
            },
            customer_discount: {
                validators: {
                    notEmpty: {
                        message: 'Please add customer discount rate'
                    }
                }
            }
        }
    });
}
$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-tabs',
    'onNext': function (tab, navigation, index) {
        var $validator = $('.customer_form').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function (tab, navigation, index) {
        var $validator = $('.customer_form').data('bootstrapValidator').validate();
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
    var $validator = $('#customer_form').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("customer_form").submit();
    }
});

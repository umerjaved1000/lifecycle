// bootstrap wizard//
$("#gender, #gender1").select2({
    theme: "bootstrap",
    placeholder: "",
    width: '100%'
});
$('input[type="checkbox"].custom-checkbox').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    increaseArea: '20%'
});

$("#commentForm").bootstrapValidator({
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'The name is required'
                }
            },
            required: true,
            minlength: 3
        },
        password: {
            validators: {
                different: {
                    field: 'first_name,last_name',
                    message: 'Password should not match first or last name'
                }
            }
        },
        password_confirmation: {
            validators: {
                identical: {
                    field: 'password'
                },
                different: {
                    field: 'first_name,last_name',
                    message: 'Confirm Password should match with password'
                }
            }
        },
        activate: {
            validators: {
                notEmpty: {
                    message: 'Please check the checkbox to activate'
                }
            }
        },
        group: {
            validators: {
                notEmpty: {
                    message: 'You must select a group'
                }
            }
        },

        trainer_address: {
            validators: {
                notEmpty: {
                    message: 'Address is required'
                }
            },
            required: true
        },
        trainer_region: {
            validators: {
                notEmpty: {
                    message: 'Region is required'
                }
            },
            required: true
        },
        trainer_post_code: {
            validators: {
                notEmpty: {
                    message: 'Post code is required'
                }
            },
            required: true
        },
        trainer_contact: {
            validators: {
                notEmpty: {
                    message: 'Contact is required'
                }
            },
            required: true
        },
        trainer_mobile: {
            validators: {
                notEmpty: {
                    message: 'Mobile is required'
                }
            },
            required: true
        }

    }
});

$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function (tab, navigation, index) {
        var $validator = $('#commentForm').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function (tab, navigation, index) {
        var $validator = $('#commentForm').data('bootstrapValidator').validate();
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
    var $validator = $('#commentForm').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("commentForm").submit();
    }

});
$('#activate').on('ifChanged', function (event) {
    $('#commentForm').bootstrapValidator('revalidateField', $('#activate'));
});
"use strict";
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
if (jQuery('.course_completet_form').length) {
    $(".course_completet_form").bootstrapValidator({
        fields: {

            course_edited: {
                validators: {
                    notEmpty: {
                        message: 'Please select'
                    }
                }
            }

        }
    });
}
$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-tabs',
    'onNext': function (tab, navigation, index) {
        var $validator = $('.course_completet_form').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function (tab, navigation, index) {
        var $validator = $('.course_completet_form').data('bootstrapValidator').validate();
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
    var $validator = $('#course_completet_form').data('bootstrapValidator').validate();
    if ($validator.isValid()) {
        document.getElementById("course_completet_form").submit();
    }
});

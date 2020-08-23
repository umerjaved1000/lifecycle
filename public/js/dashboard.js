$(document).ready(function () {
    "use strict";
    $('[data-toggle="tooltip"]').tooltip();
    var bookingCalendar;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    bookingCalendar = jQuery('#calendar').fullCalendar({
//Random default events
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        firstDay: 1,
        handleWindowResize: true,
        fixedWeekCount: false,
        editable: false,
        droppable: false,
        eventLimit: 3,
        displayEventTime: false,
        viewRender: function (view, element) {
            //Last parameter is used to manage calender start and end dates
            // 1 for render view as start and end date
            //2 for  month start and end date
            refresh_calendar_overview(view.start.format('YYYY-MM-DD'), view.end.format('YYYY-MM-DD'), view.intervalStart.format('YYYY-MM-DD'), view.intervalEnd.format('YYYY-MM-DD'), 2);
        },
        eventClick: function (event, jsEvent, view) {
            show_calender_event_details_overview(event.data);
        },
//        timezone: 'UTC'
    });

    function refresh_calendar_overview(start_render_view, end_render_view, start_month, end_month, render_view_status) {
        jQuery.ajax({
            url: '/admin/calendar',
            type: 'POST',
            data: {start_render_view: start_render_view, end_render_view: end_render_view, start_month: start_month, end_month: end_month, render_view_status: render_view_status},
            success: function (response) {
                bookingCalendar.fullCalendar('renderEvents', response);
            },
            error: function (xhr, textStatus, errorThrown) {
            }
        });
    }
    function show_calender_event_details_overview(data) {
        jQuery.ajax({
            type: "POST",
            url: '/admin/calendar_event_details',
            data: {data: data},
            success: function (response) {
                jQuery('#view_calender_event .modal-content').html(response);
                jQuery('#view_calender_event').modal('show');
            },
            error: function (xhr, textStatus, errorThrown) {
            }
        });
    }

}
);

@extends('layouts.master')
@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href='{{asset('plugins/components/fullcalendar/fullcalendar.css')}}' rel='stylesheet'>
@endpush

@section('content')
<div class="container-fluid">

    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="col-md-12 m-b-30 b-b p-l-0">
                    <div class="col-md-6">
                        <h2 class="box-title m-b-0 p-l-0">Bookings</h2>
                    </div>
                    <div class="col-md-6 p-t-5">
                        <a href="/create_booking" class="btn btn-success pull-right"><i class="icon-plus"></i>&nbsp; Add Booking</a>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="table-responsive">
                    <table id="myTable" class="table table-striped  text-capitalize">
                        <thead>
                            <tr>
                                <th>Ref No.</th>
                                <th>Customer</th>
                                <th>Trainer</th>
                                <th>Course</th>
                                <th>Venue</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Status</th>
                                <th style="width: 380px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>BK-LC-{{$booking->id}}</td>
                                <td>{{$booking->customer_name}}</td>
                                <td>{{$booking->trainer_name}}</td>
                                <td>{{$booking->course_title}}</td>
                                <td>{{$booking->venue_name}}</td>
                                <td>{{$booking->start_date}}</td>
                                <td>{{$booking->end_date}}</td>
                                <td>@if ($booking->status===0)
                                    <p style="color:#121213;"><i class="fa fa-clock-o"></i><b> Waiting for approval&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></p>
                                    @elseif($booking->status===1)
                                    <p style="color:black"><i class="fa fa-check"></i><b> Accepted &nbsp;</b> </p>
                                    @elseif($booking->status===2)
                                    <p style="color:red"><i class="fa fa-ban"></i><b> Rejecetd</b></p>
                                    @elseif($booking->status===3)
                                    <p style="color:green"><i class="fa fa-check-circle-o"></i><b> Completed</b></p>
                                    @endif                                       
                                </td>
                                <td>  
                                    @if ($booking->status===3)
                                    <a class="fcbtn btn btn-outline btn-success btn-1d btn-sm m-t-5" href="booking_details/{{$booking->id}}"><i class="icon-info"></i> Details</a>&nbsp;
                                    @else
                                    <a class="btn btn-success btn-sm m-t-5" href="edit_booking/{{$booking->id}}"><i class="icon-pencil"></i> Edit</a>&nbsp;
                                    <a class="btn btn-primary btn-sm m-t-5" href="/add-material/{{$booking->id}}"><i class="fa fa-plus-circle"></i> Add Material</a>&nbsp;
                                    <a class="btn btn-info btn-sm m-t-5" href="/view-course-material/{{$booking->id}}"><i class="fa fa-info-circle"></i> View Materials</a>
                                    @endif 
                                </td> 
                            </tr>
                            @endforeach                                                                                                                                   
                        </tbody>
                    </table>

                    <div id="bookingDetailsModel"  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" style="width: 100%">
                            <div class="modal-content text-capitalize">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Booking Details</h4></div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="white-box calendar-widget">
                                                <div id='calendar_bookings'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="modal-footer col-md-12">
                                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div> 
                </div>
            </div>
        </div>
        <!-- /.row -->
        @include('layouts.partials.right-sidebar')
    </div>

    @endsection

    @push('js')
    <script src                                                                                                                                        ="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src='{{asset('plugins/components/moment/moment.js')}}'></script>
    <script src='{{asset('plugins/components/fullcalendar/fullcalendar.js')}}'></script>
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script>
        function viewBookings(dates) {
        $('#bookingDetailsModel').modal('show');
        var array = dates.split(",");
        console.log("array :", array) //["2018-9-24", "2018-9-26", "2018-9-25"]
                console.log("array length", (array.length)); // 3

        var eventsArray = []
                for (var j = 0; j < array.length; j++) {
        eventsArray.push({ title: 'Booked', start: array[j] });
        }
        $('#calendar_bookings').fullCalendar({
        header: {
        left: 'prev',
                center: 'title',
                right: 'next'
        },
                firstDay: 1,
                handleWindowResize: true,
                fixedWeekCount: false,
                /*
                 editable: true allow user to edit events.
                 */
                editable: true,
                eventColor: 'transparent',
                /*
                 events is the main option for calendar.
                 for demo we have added predefined events in json object.
                 */
                events: eventsArray,
                eventRender: function(event, element, view) {
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#b72727');
                }
        });
        $(".fc-content").prepend('<i class="fa fa-circle m-r-5 font-10"></i>');
        }
    </script>
    <!-- end - This is for export functionality only -->
    <script>
                $(function () {

                $('#myTable').DataTable();
                $('.alert-success').delay(5000).slideUp('slow');
                });
                function delete_booking(t_id)
                {
                bootbox.confirm({
                title: 'Delete booking',
                        message: 'Do you really want to <b>Delete</b> this <b>booking?</b>',
                        buttons: {
                        cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                        },
                                confirm: {
                                label: '<i class="fa fa-check"></i> Confirm'
                                }
                        },
                        callback: function (result) {
                        if (result) {
                        document.location.href = "{!! url('delete_booking/" + t_id + "'); !!}";
                        }
                        }
                });
                }
                function booking_details(booking_id) {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                });
                $.ajax({
                url: 'booking_details/' + booking_id,
                        type: 'get',
                        dataType: 'json',
                        success: function (result) {
                        $('#bookingDetailsModel').modal('show');
                        $('.booking_details_name').html(result.name);
                        $('.booking_details_email').html(result.email);
                        $('.booking_details_address').html(result.address);
                        $('.booking_details_website').html(result.website);
                        $('.booking_details_region').html(result.region);
                        $('.booking_details_post_code').html(result.post_code);
                        $('.booking_details_landline').html(result.landline);
                        $('.booking_details_fax').html(result.fax);
                        $('.booking_details_contact_name').html(result.contact_name);
                        $('.booking_details_contact_email').html(result.contact_email);
                        $('.booking_details_contact_landline').html(result.contact_landline);
                        $('.booking_details_contact_mobile').html(result.contact_mobile);
                        $('.booking_details_contact_mobile').html(result.contact_mobile);
                        $('.booking_details_contact_facilities').html(result.facilities);
                        $('.booking_details_contact_copy').html(result.copy);
                        $('.booking_details_contact_notes').html(result.notes);
                        }
                });
                }
                @if (\Session::has('message'))
                        $.toast({
                        heading: '{{session()->get('heading')}}',
                                position: 'top-center',
                                text: '{{session()->get('message')}}',
                                loaderBg: '#ff6849',
                                icon: '{{session()->get('icon')}}',
                                hideAfter: 5000,
                                stack: 6
                        });
                @endif
    </script>

    @endpush
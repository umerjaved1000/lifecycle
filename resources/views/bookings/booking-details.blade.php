@extends('layouts.master')
@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href='{{asset('plugins/components/fullcalendar/fullcalendar.css')}}' rel='stylesheet'>
<style>
    .booking_details p{
        color: #000;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="col-md-12 m-b-30 p-l-0">
                    <div class="col-md-6">
                        <h2 class="box-title m-b-0 p-l-0">Booking Details</h2>
                    </div>

                </div>
                <hr class="hr-line">
                <div class="row">
                    <div class="booking_details text-capitalize p-l-40 p-r-40">
                        <div class="col-md-12">  
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p><b>Booking ID: {{request()->route('id')}}</b></p>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class="pull-right"><span class="font-bold ">Course Title: </span>{{$booking->course_title}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class=""><span class="font-bold ">Customer: </span>{{$booking->customer_name}}</p>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class="pull-right"><span class="font-bold ">Trainer: </span>{{$booking->trainer_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class=""><span class="font-bold ">Start Date: </span>{{$booking->start_date}}</p>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class="pull-right"><span class="font-bold ">End Date: </span>{{$booking->end_date}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class=""><span class="font-bold ">Behavior Issues: </span>{{$booking->behaviour_issue}}</p>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class="pull-right"><span class="font-bold ">Course Material Issues: </span>{{$booking->course_issue}}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class=""><span class="font-bold ">Venues Issues: </span>{{$booking->venue_issue}}</p>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p class="pull-right"><span class="font-bold ">Notes: </span>{{$booking->notes}}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="col-md-12">
                </div>

                <div class="table-responsive">

                    <div class="col-md-12"><h4 class="font-bold">Details</h4></div>

                    <table id="myTable" class="table table-striped  text-capitalize">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email </th>
                                <th>Telephone</th>
                                <th>License</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking_details as $booking_detail)
                            <tr>
                                <td>{{$booking_detail->delegate_name}}</td>
                                <td>{{$booking_detail->email}}</td>
                                <td>{{$booking_detail->telephone}}</td>
                                <td>{{$booking_detail->driving_license}}</td>

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
    <!-- end - This is for export functionality only -->
    <script>
        $(function () {

        $('#myTable').DataTable({
        "bLengthChange": false
        });
        });
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
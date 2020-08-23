@extends('layouts.master')

@push('css')
<link href='{{asset('plugins/components/fullcalendar/fullcalendar.css')}}' rel='stylesheet'>
<style>
    .carousel-inner img {
        width: 283px!important;
        height: 283px!important;
    }
    .temp-widget .left-part {
        width: 35%;
    }
    .temp-widget .right-part {
        margin-left: 35%;
        padding: 17px 17px 17px 17px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row colorbox-group-widget">
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-primary">
                    <div class="media-body">
                        <h3 class="info-count">{{$trainer_booking_count}} <span class="pull-right"><i class="fa fa-calendar"></i></span></h3>
                        <p class="info-text font-12">Total Bookings</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-success">
                    <div class="media-body">
                        <h3 class="info-count">{{$trainer_accepted_bookings}} <span class="pull-right"><i class="fa fa-calendar-check-o"></i></span></h3>
                        <p class="info-text font-12">Accepted Bookings</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-danger">
                    <div class="media-body">
                        <h3 class="info-count">{{$trainer_completed_bookings}} <span class="pull-right"><i class="fa fa-calendar-plus-o"></i></span></h3>
                        <p class="info-text font-12">Complete Bookings</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-warning">
                    <div class="media-body">
                        <h3 class="info-count">{{$trainer_courses}} <span class="pull-right"><i class="fa fa-list-ul"></i></span></h3>
                        <p class="info-text font-12">Total Courses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box calendar-widget">
                <div id='trainer_dashboard_calendar'></div>
            </div>
        </div>
    </div>
</div>
<div id="view_calender_event" class="modal fade" tabindex="-1" role="dialog" 
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
@endsection
@push('js')
<script src='{{asset('plugins/components/moment/moment.js')}}'></script>
<script src='{{asset('plugins/components/fullcalendar/fullcalendar.js')}}'></script>
<script src="{{asset('js/trainer_dashboard.js')}}"></script>
@endpush
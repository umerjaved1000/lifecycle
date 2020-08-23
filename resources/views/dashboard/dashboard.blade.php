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
        <a href="/bookings">  <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-primary">
                    <div class="media-body">
                        <h3 class="info-count">{{$get_bookings}} <span class="pull-right"><i class="fa fa-calendar"></i></span></h3>
                        <p class="info-text font-12">Bookings</p>
                    </div>
                </div>
            </div>
            </div> </a>
      <a href="/trainers">   <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-success">
                    <div class="media-body">
                        <h3 class="info-count">{{$get_trainers}} <span class="pull-right"><i class="fa fa-user"></i></span></h3>
                        <p class="info-text font-12">Trainer</p>
                    </div>
                </div>
            </div>
        </div></a>
    <a href="/customers">     <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-danger">
                    <div class="media-body">
                        <h3 class="info-count">{{$get_customers}} <span class="pull-right"><i class="fa fa-users"></i></span></h3>
                        <p class="info-text font-12">Customers</p>
                    </div>
                </div>
            </div>
        </div></a>
      <a href="/courses">   <div class="col-md-3 col-sm-6 info-color-box">
            <div class="white-box">
                <div class="media bg-warning">
                    <div class="media-body">
                        <h3 class="info-count">{{$get_courses}} <span class="pull-right"><i class="fa fa-list-ul"></i></span></h3>
                        <p class="info-text font-12">Courses</p>

                    </div>
                </div>
            </div>
        </div></a>
    </div>
    <div class="row">
        <div class="col-sm-6  ">
            <div class="white-box  h-592">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="box-title">Top 5 Courses</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table color-table info-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Bookings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_courses as $key => $course)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$course->title}}</td>
                                <td><span class="label label-primary">{{$course->count}}</span> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6  ">
            <div class="white-box  h-592">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="box-title">Top 5 Trainers</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table color-table info-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Bookings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_trainers as $key => $trainer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$trainer->name}}</td>
                                <td><span class="label label-primary">{{$trainer->count}}</span> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box calendar-widget">
                <div id='calendar'></div>
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
<script src="{{asset('js/dashboard.js')}}"></script>
@endpush
@extends('layouts.master')

@push('css')
<style>
    .info-box .info-count {
        margin-top: 0px !important;
    }
</style>
@endpush

@section('content')
@if(auth()->user()->hasRole('admin'))
<div class="row m-0">

    <div class="col-md-3 col-sm-6 info-box">
        <div class="media">
            <div class="media-left">
                <span class="icoleaf bg-primary text-white"><i
                        class="mdi mdi-checkbox-marked-circle-outline"></i></span>
            </div>
            <div class="media-body">
                <h3 class="info-count text-blue">{{$all_bookings}}</h3>
                <p class="info-text font-12">Bookings</p>
                <span class="hr-line"></span>
                <p class="info-ot font-15">Completed
                    <span class="label label-rounded label-success">{{$complete_bookings}}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 info-box">
        <div class="media">
            <div class="media-left">
                <span class="icoleaf bg-primary text-white"><i class="icon-people"></i></span>
            </div>
            <div class="media-body">
                <h3 class="info-count text-blue">{{$all_trainers}}</h3>
                <p class="info-text font-12">Trainers</p>
                <span class="hr-line"></span>
                <p class="info-ot font-15">Booked
                    <span class="label label-rounded label-danger">{{$booked_trainers}}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 info-box">
        <div class="media">
            <div class="media-left">
                <span class="icoleaf bg-primary text-white"><i class="icon-notebook fa-fw"></i></span>
            </div>
            <div class="media-body">
                <h3 class="info-count text-blue">{{$all_courses}}</h3>
                <p class="info-text font-12">Courses</p>
                <span class="hr-line"></span>
                <p class="info-ot font-15">Booked
                    <span class="label label-rounded label-danger">{{$booked_courses}}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 info-box">
        <div class="media">
            <div class="media-left">
                <span class="icoleaf bg-primary text-white"><i class="icon-user fa-fw"></i></span>
            </div>
            <div class="media-body">
                <h3 class="info-count text-blue">{{$all_customers}}</h3>
                <p class="info-text font-12">Total Customers</p>
                <span class="hr-line"></span>
                <p class="info-ot font-15">Current
                    <span class="label label-rounded label-danger">{{$booked_customers}}</span>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box user-table">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="box-title">Top 5 Courses</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Notes</th>
                                <th>Course Material</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top_courses as $top_course)
                            <tr>
                                <td><a href="javascript:void(0);" class="text-link">{{$top_course->id}}</a></td>
                                <td>{{$top_course->title}}</td>
                                <td>{{$top_course->notes}}</td>
                                <td>{{$top_course->material}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box user-table">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="box-title">Top 5 Trainers</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Bookings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($top_trainers as $top_trainer)
                            <tr>
                                <td><a href="#" class="text-link">{{$top_trainer->id}}</a></td>
                                <td>{{$top_trainer->name}}</td>
                                <td>{{$top_trainer->email}}</td>
                                <td>{{$top_trainer->top_trainers}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Right-Sidebar ===== -->
    {{--@include('layouts.partials.right-sidebar')--}}
    <!-- ===== Right-Sidebar-End ===== -->
</div>
@elseif(auth()->user()->hasRole('user'))
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="white-box bg-primary color-box">
                <h1 class="text-white font-light m-b-0">{{$get_trainer_bookings->trainer_bookings}} <span class="font-14">Bookings</span></h1>
                <span class="hr-line"></span>
                <p class="cb-text">Current bookings</p>
                <h6 class="text-white font-semibold">{{$get_trainer_current_bookings->trainer_current_bookings}}</h6>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="white-box bg-success color-box">
                <h1 class="text-white font-light m-b-0">{{$get_trainer_courses->trainer_courses}} <span class="font-14">Courses</span></h1>
                <span class="hr-line"></span>
                <p class="cb-text">current courses</p>
                <h6 class="text-white font-semibold">{{$get_trainer_current_courses->trainer_current_courses}}</h6>

            </div>
        </div> 
        <div class="col-md-4 col-sm-6">
            <div class="white-box bg-danger color-box">
                <h1 class="text-white font-light m-b-0">25%</h1>
                <span class="hr-line"></span>
                <p class="cb-text">Finished Tasks</p>
                <h6 class="text-white font-semibold">+15% <span class="font-light">Last Week</span></h6>

            </div>
        </div>
    </div></div>
@endif

@endsection

@push('js')
<script src="{{asset('js/db1.js')}}"></script>

@endpush
@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/components/custom-select/custom-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/components/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
<link href="{{ asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
<link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
<link href="{{asset('plugins/components/jqueryui/jquery-ui.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css">
<style>
    #rootwizard .nav.nav-tabs {
        margin-bottom: 25px;
    }
    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .nav-tabs>li>a{
        cursor: pointer;
        background-color: inherit;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        background: #0283cc!important;
        color: #fff!important;

    }
    .nav-tabs>li>a:focus,.nav-tabs>li>a:focus, .nav-tabs>li>a:hover, .nav-tabs>li>a:hover {
        border: 1px solid transparent!important;
        background-color: inherit!important;
    }
    .has-error .help-block {
        color: #EF6F6C;
    }
    .select2 {
        width: 100% !important;
    }
    .error-block{
        background-color: #ff9d9d;
        color: red;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title pull-left">Add Booking</h3>
                <div class="clearfix"></div>
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="form-horizontal schedule_form" 
                      id="schedule_form"
                      action="{{url('add-schedule-submit')}}" 
                      method="POST" 
                      enctype="multipart/form-data"  >

                    {{ csrf_field() }}
                    <div id="rootwizard">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Schedule</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <h2 class="hidden">&nbsp;</h2>

                                <div class="form-group {{ $errors->first('start', 'has-error') }} {{ $errors->first('end', 'has-error') }}">
                                    <label for="dates_requested" class="col-sm-2 control-label">Schedule</label>
                                    <div class="col-sm-10">
                                        <div class="input-daterange input-group" id="date-range">
                                            <span class="input-group-addon bg-info b-0 text-white">Start Date</span>
                                            <input type="text" autocomplete="off" id="start_date" class="form-control" name="start_date" /> 
                                            <span class="input-group-addon bg-info b-0 text-white">End Date</span>
                                            <input type="text" autocomplete="off" class="form-control" id="end_date" name="end_date" /> 
                                        </div>
                                        <span class="help-block">{{ $errors->first('start', ':message') }}</span><span class="help-block">{{ $errors->first('end', ':message') }}</span>
                                    </div>
                                </div> 
                            </div>

                            <ul class="pager wizard">
                                <li class="next finish" ><a href="javascript:;">Finish</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.partials.right-sidebar')
    @endsection

    @push('js')
    <script src="{{asset('plugins/components/custom-select/custom-select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/components/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script src="{{ asset('plugins/components/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{asset('plugins/components/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('plugins/components/icheck/icheck.init.js')}}"></script>
    <script src="{{asset('plugins/components/moment/moment.js')}}"></script>

    <script src="{{asset('plugins/components/jqueryui/jquery-ui.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"
    type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{ asset('/js/schedule.js') }}"></script>
    <script>
jQuery(document).ready(function () {
jQuery('#date-range').datepicker({
toggleActive: true,
        });
});</script>
    <script>

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
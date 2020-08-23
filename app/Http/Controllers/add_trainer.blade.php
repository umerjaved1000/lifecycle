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
                <h3 class="box-title pull-left">Add Trainer</h3>
                <div class="clearfix"></div>
                @if(count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="form-horizontal trainer_form" 
                      id="trainer_form"
                      action="{{url('store_trainer')}}" 
                      method="POST" 
                      enctype="multipart/form-data"  >

                    {{ csrf_field() }}
                    <div id="rootwizard">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Personal</a></li>
                            <li ><a href="#tab2" data-toggle="tab">Details</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <h2 class="hidden">&nbsp;</h2>

                                <div class="form-group {{ $errors->first('trainer_name', 'has-error') }}">
                                    <label for="trainer_name" class="col-sm-2 control-label">Name *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="trainer_name"  name="trainer_name"     class="form-control required" 
                                               placeholder="Trainer Name..." value="{!! old('trainer_name') !!}"/> 

                                        {!! $errors->first('trainer_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('trainer_email', 'has-error') }}">
                                    <label for="trainer_email" class="col-sm-2 control-label">Email *</label>
                                    <div class="col-sm-10">

                                        <input type="email" 
                                               class="form-control" 
                                               autocomplete="off"
                                               id="trainer_email"  
                                               name="trainer_email"  
                                               class="form-control required" 
                                               placeholder="Trainer Email..."
                                               value="{!! old('trainer_email') !!}"/> 

                                        {!! $errors->first('trainer_email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('trainer_password', 'has-error') }}">
                                    <label for="trainer_password" class="col-sm-2 control-label">Password *</label>
                                    <div class="col-sm-10">

                                        <input type="password" 
                                               autocomplete="off"
                                               class="form-control" 
                                               id="trainer_password"  name="trainer_password" 
                                               class="form-control required" 
                                               placeholder="Trainer Password..." 
                                               value="{!! old('trainer_password') !!}"
                                               /> 

                                        {!! $errors->first('trainer_password', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('trainer_address', 'has-error') }}">
                                    <label for="trainer_address" class="col-sm-2 control-label">Address *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="trainer_address"  name="trainer_address"     class="form-control required" 
                                               placeholder="Trainer Address..." value="{!! old('trainer_address') !!}"/> 

                                        {!! $errors->first('trainer_address', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('trainer_region', 'has-error') }}">
                                    <label for="trainer_region" class="col-sm-2 control-label">Region *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="trainer_region"  name="trainer_region"     class="form-control required" 
                                               placeholder="Trainer Region..." value="{!! old('trainer_region') !!}"/> 

                                        {!! $errors->first('trainer_region', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('trainer_post_code', 'has-error') }}">
                                    <label for="trainer_post_code" class="col-sm-2 control-label">Post Code *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="trainer_post_code"  name="trainer_post_code"     class="form-control required" 
                                               placeholder="Trainer Post Code..." value="{!! old('trainer_post_code') !!}"/> 

                                        {!! $errors->first('trainer_post_code', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('trainer_contact', 'has-error') }}">
                                    <label for="trainer_contact" class="col-sm-2 control-label">Home Contact *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="trainer_contact"  name="trainer_contact"     class="form-control required" 
                                               placeholder="Trainer Home Contact..." value="{!! old('trainer_contact') !!}"/> 

                                        {!! $errors->first('trainer_contact', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('trainer_mobile', 'has-error') }}">
                                    <label for="trainer_mobile" class="col-sm-2 control-label">Mobile *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="trainer_mobile"  name="trainer_mobile"     class="form-control required" 
                                               placeholder="Trainer Mobile..." value="{!! old('trainer_mobile') !!}"/> 

                                        {!! $errors->first('trainer_mobile', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">

                                <div class="form-group {{ $errors->first('trainer_courses', 'has-error') }}">
                                    <label for="trainer_courses" class="col-sm-2 control-label">Course *</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker text-capitalize form-control" required="" name="trainer_courses[]" data-style="form-control" multiple="multiple" data-placeholder="Select Course ">
                                            @foreach($courses as $course)

                                            <option value="{{$course->id}}">{{$course->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    {!! $errors->first('trainer_courses', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group {{ $errors->first('trainer_level', 'has-error') }}">
                                    <label for="trainer_level" class="col-sm-2 control-label">Level *</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" title="Select Trainer Level..." name="trainer_level">
                                            <option value="">Select</option>
                                            <option 
                                                value="bronze"
                                                @if(old('trainer_level') === "bronze") selected="selected" @endif >Bronze
                                        </option>
                                        <option 
                                            value="silver"
                                            @if(old('trainer_level') === "silver") selected="selected" @endif >Silver
                                    </option>
                                    <option 
                                        value="gold"
                                        @if(old('trainer_level') === "gold") selected="selected" @endif >Gold
                                </option>
                            </select>
                        </div>
                        <span class="help-block">{{ $errors->first('trainer_level', ':message') }}</span>
                    </div>  
                    <div class="form-group {{ $errors->first('trainer_fees', 'has-error') }}">
                        <label for="trainer_fees" class="col-sm-2 control-label">Fees *</label>
                        <div class="col-sm-10">

                            <select class="form-control" title="Select Trainer Fees..." name="trainer_fees">
                                 <option value="">Select</option>
                                @foreach($get_fees as $fee)
                                <option value="{{$fee->fees}} ">{{ucfirst($fee->fees_type)}}/{{$fee->fees}}</option>
                                @endforeach 
                            </select>

                            {!! $errors->first('trainer_fees', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->first('trainer_last_cpt', 'has-error') }}">
                        <label for="trainer_last_cpt" class="col-sm-2 control-label">Last CPD Training</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" autocomplete="off" name="trainer_last_cpt" id="datepicker-autoclose" value="{!! old('trainer_last_cpt') !!}"  placeholder="mm/dd/yyyy"/>

                            {!! $errors->first('trainer_last_cpt', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->first('trainer_induction_training', 'has-error') }}">
                        <label for="trainer_induction_training" class="col-sm-2 control-label">Induction Training</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" autocomplete="off" name="trainer_induction_training" id="datepicker-autoclose2" value="{!! old('trainer_induction_training') !!}"  placeholder="mm/dd/yyyy"/> 

                            {!! $errors->first('trainer_induction_training', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->first('trainer_note', 'has-error') }}">
                        <label for="trainer_note" class="col-sm-2 control-label">Notes </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="trainer_note" id="trainer_note">{!! old('trainer_note') !!}</textarea>

                            {!! $errors->first('trainer_note', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <ul class="pager wizard">
                <li class="previous"><a href="#">Previous</a></li>
                <li class="next"><a href="#">Next</a></li>
                <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
            </ul>
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
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{ asset('/js/trainer.js') }}"></script>

<script>
jQuery(document).ready(function () {
$('.selectpicker').selectpicker();
jQuery('#datepicker-autoclose').datepicker({
autoclose: true,
        todayHighlight: true
        });
jQuery('#datepicker-autoclose2').datepicker({
autoclose: true,
        todayHighlight: true
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


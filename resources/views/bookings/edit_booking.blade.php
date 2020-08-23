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
                <h3 class="box-title pull-left">Edit Booking</h3>
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

                <form class="form-horizontal booking_form" 
                      id="booking_form"
                      action="{{url('update_booking')}}" 
                      method="POST" 
                      enctype="multipart/form-data"  >

                    {{ csrf_field() }}
                    <div id="rootwizard">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Customer</a></li>
                            <li ><a href="#tab2" data-toggle="tab">Course</a></li>

                            <li ><a href="#tab4" data-toggle="tab">Details</a></li>
                            <li ><a href="#tab3" data-toggle="tab">Trainer</a></li>
                            <li ><a href="#tab5" data-toggle="tab">Delegates</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <h2 class="hidden">&nbsp;</h2>

                                <div class="form-group {{ $errors->first('customer_name', 'has-error') }}">
                                    <label for="customer_name" class="col-sm-2 control-label">Customer *</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2 text-capitalize" id="customer_name" name="customer_name" onchange="get_customer()">
                                            <option value="" >Select</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}" @if( $booking->customer_id==$customer->id) selected @endif>{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('customer_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="customer_info">
                                    <div class="form-group  ">
                                        <label for="trainer"   class="col-sm-2 control-label">Email :</label>
                                        <label for="trainer" id="customer_email" class="col-sm-10">{{$booking->customer_email}}</label>
                                    </div>
                                    <div class="form-group  ">
                                        <label for="trainer"   class="col-sm-2 control-label">Customer Land Line :</label>
                                        <label for="trainer" id="customer_landline" class="col-sm-10">{{$booking->customer_landline}}</label>
                                    </div>
                                    <div class="form-group  ">
                                        <label for="trainer"   class="col-sm-2 control-label">Discount Rate % :</label>
                                        <label for="trainer" id="customer_discount" class="col-sm-10">{{$booking->discount_rate}}</label>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab2" disabled="disabled">

                                <div class="form-group {{ $errors->first('course', 'has-error') }}">
                                    <label for="course" class="col-sm-2 control-label">Course *</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select_course text-capitalize" id="course" name="course">
                                            <option value="" >Select</option>
                                            @foreach ($courses as $course)
                                            <option value="{{$course->id}}" @if(old('course')===$course->id || $booking->course_id==$course->id) selected @endif>{{$course->title}}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('course', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('course_type', 'has-error') }}">
                                    <label for="course_type" class="col-sm-2 control-label">Course Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" title="Select..." name="course_type">
                                            <option value="">Select</option>
                                            <option 
                                                value="1"
                                                @if(old('course_type') === "1"||$booking->course_type=== "1") selected="selected" @endif >Private
                                        </option>
                                        <option 
                                            value="0"
                                            @if(old('course_type') === "0"||$booking->course_type=== "0") selected="selected" @endif >Public
                                    </option>
                                </select>
                            </div>
                            <span class="help-block">{{ $errors->first('course_type', ':message') }}</span>
                        </div>  
                        <div class="form-group {{ $errors->first('course_status', 'has-error') }}">
                            <label for="course_status" class="col-sm-2 control-label"> Course Status *</label>
                            <div class="col-sm-10">
                                <select class="form-control" title="Select  Course..." name="course_status">
                                    <option 
                                        value="1"
                                        @if(old('course_status') === "1"||$booking->status===1) selected="selected" @endif >Active
                                </option>
                                <option 
                                    value="0"
                                    @if(old('course_status') === "0"||$booking->status=== 0) selected="selected" @endif >Non Active
                            </option>
                        </select>
                    </div>
                    <span class="help-block">{{ $errors->first('course_type', ':message') }}</span>
                </div>

            </div>
            <div class="tab-pane" id="tab3" disabled="disabled">
                <div class="trainer_details">
                    <div class="form-group  ">
                        <h4 class="text-center">Current Trainer</h4>
                    </div>
                    <div class="form-group  ">
                        <label for="trainer" class="col-sm-2 control-label">Name</label>
                        <label for="trainer" class="col-sm-10 "><?php echo $trainer_details->name ?></label>
                    </div>
                    <div class="form-group  ">
                        <label for="trainer" class="col-sm-2 control-label">Address</label>
                        <label for="trainer" class="col-sm-10 "><?php echo $trainer_details->address ?></label>
                    </div>
                    <div class="form-group  ">
                        <label for="trainer" class="col-sm-2 control-label">Region</label>
                        <label for="trainer" class="col-sm-10"><?php echo $trainer_details->region ?></label>
                    </div>
                    <div class="form-group  ">
                        <label for="trainer" class="col-sm-2 control-label">Postal Code</label>
                        <label for="trainer" class="col-sm-10 "><?php echo $trainer_details->region ?></label>
                    </div>

                    <div class="col-md-12 m-b-20">
                        <button class="btn btn-primary pull-right" onclick="show_other_trainers()">Other Trainers</button>
                    </div>
                </div>

            </div>

            <div class="tab-pane" id="tab4" >
                <div class="form-group {{ $errors->first('cost', 'has-error') }}">
                    <label for="course_status" class="col-sm-2 control-label">Standard Unit Cost</label>
                    <div class="col-sm-10">
                        <select class="form-control" title="Select..." name="cost">
                            <option value="">Select</option>
                            <option 
                                value="10"
                                @if(old('cost') === "10"||$booking->cost==10) selected="selected" @endif >10
                        </option>
                        <option 
                            value="20"
                            @if(old('cost') === "20"||$booking->cost==20) selected="selected" @endif >20
                    </option>
                    <option 
                        value="0"
                        @if(old('cost') === "30"||$booking->cost==30) selected="selected" @endif >30
                </option>
            </select>
        </div>
        <span class="help-block">{{ $errors->first('cost', ':message') }}</span>
    </div>

    <div class="form-group {{ $errors->first('start', 'has-error') }} {{ $errors->first('end', 'has-error') }}">
        <label for="dates_requested" class="col-sm-2 control-label">Dates</label>
        <div class="col-sm-10">
            <div class="input-daterange input-group" id="date-range">
                <span class="input-group-addon bg-info b-0 text-white">Start Date</span>
                <input type="text"  
                       value="{!! old('start_date',$booking->start_date) !!}" 
                       id="start_date" 
                       class="form-control" 
                       name="start_date" /> 
                <span class="input-group-addon bg-info b-0 text-white">End Date</span>
                <input type="text" 
                       class="form-control" 
                       id="end_date" 
                       value="{!! old('end_date',$booking->end_date) !!}"
                       name="end_date" /> 
            </div>
            <span class="help-block">{{ $errors->first('start', ':message') }}</span><span class="help-block">{{ $errors->first('end', ':message') }}</span>
        </div>
    </div>
    <div class="form-group {{ $errors->first('venue', 'has-error') }}">
        <label for="venue" class="col-sm-2 control-label">Venue *</label>
        <div class="col-sm-10">
            <select class="form-control" name="venue" id="select_venue" onchange="get_trainer()">
                <option value="" >Select</option>
                @foreach ($venues as $venue)
                <option value="{{$venue->id}}" @if(old('venue')===$venue->id || $booking->venue==$venue->id) selected @endif>{{$venue->name}}</option>
                @endforeach
            </select>
        </div>
        <span class="help-block">{{ $errors->first('venue', ':message') }}</span>
    </div>
    <div class="form-group {{ $errors->first('fees', 'has-error') }}">
        <label for="fees" class="col-sm-2 control-label">Fees *</label>
        <div class="col-sm-10  venue_fees"  >
            <input type="number" 
                   class="form-control"  
                   id="input_venue_fees"
                   name="fees" 
                   readonly=""
                   placeholder="" 
                   value="{!! old('end_date',$booking->fees) !!}"/>
            {!! $errors->first('delegate_email', '<span class="help-block">:message</span>') !!}
        </div>

    </div>
    <input type="hidden" value="{{$booking->id}}" name='booking_id'>
</div> 
<div class="tab-pane" id="tab5">
    <h2 class="hidden">&nbsp;</h2>
    <h6><b>If there is no delegate information... please leave them empty</b></h6>

    <div class="col-md-12 delegates-container">

        <div class="col-md-12 p-b-10">
            <a onclick="addDelegate()" class="btn btn-primary pull-right "><i class="fa fa-plus"> Add Delegate</i></a>
        </div>
        <div class="col-md-12 default-delegate">

            <div class="form-group {{ $errors->first('delegate_name', 'has-error') }}">
                <label for="customer_name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" 
                           class="form-control delegate_name"  
                           id="" 
                           name="delegate_name[]" 
                           placeholder="Delegate Name..." 
                           value="{!! old('delegate_name') !!}"/> 
                    {!! $errors->first('delegate_name', '<span class="help-block">:message</span>') !!}

                </div>
            </div>

            <div class="form-group {{ $errors->first('delegate_email', 'has-error') }}">
                <label for="customer_name" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" 
                           class="form-control delegate_email"  
                           name="delegate_email[]" 
                           placeholder="Delegate Email..." value="{!! old('delegate_email') !!}"/>
                    {!! $errors->first('delegate_email', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->first('delegate_telephone', 'has-error') }}">
                <label for="delegate_telephone" class="col-sm-2 control-label">Telehone</label>
                <div class="col-sm-10">
                    <input type="text" 
                           class="form-control delegate_telephone" 
                           id=""
                           name="delegate_telephone[]"
                           placeholder="Delegate Telephone..." 
                           value="{!! old('delegate_telephone') !!}"/> 
                </div>
            </div>
            <div class="form-group {{ $errors->first('delegate_license', 'has-error') }}">
                <label for="delegate_license" class="col-sm-2 control-label">Driving License</label>
                <div class="col-sm-10">
                    <input type="text" 
                           class="form-control delegate_license" 
                           id="delegate_license"
                           name="delegate_license[]"
                           placeholder="Delegate Driving License..." 
                           value="{!! old('delegate_license') !!}"/> 
                </div>
            </div>
            <div class="col-md-12 p-b-10 delete-delegate hidden">
                <a onclick="removeDelegate(this)" class="btn btn-danger pull-right "><i class="fa fa-trash"> Remove Delegate</i></a>
            </div>
            <hr class="col-md-12">
        </div>
    </div>
</div>  

</div>
<ul class="pager wizard">
    <input type="hidden" name="trainer" id="get_trainer_id" value="{{$booking->trainer_id}}">
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
<scrip                                         t src="{{asset('plugins/components/custom-select/custom-select.min.js')}}" type="text/javascript"></script>
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
    <script src="{{ asset('/js/booking.js') }}"></script>
    <script>
                    jQuery(document).ready(function () {
                    jQuery('#date-range').datepicker({
                    toggleActive: true,
                            dateFormat: 'yy-mm-dd'
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
                function get_customer() {
                var id = $('.select2').val();
                $.ajax({
                url: '/edit_customer_details/' + id,
                        type: 'POST',
                        dataType: 'json',
                        success: function (result) {
                        $('.customer_info').show();
                        $('#customer_email').val(result.email);
                        $('#customer_landline').val(result.landline);
                        $('#customer_discount').val(result.discount_rate);
                        }
                });
                }
    </script>
    @endpush
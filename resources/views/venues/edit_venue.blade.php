@extends('layouts.master')

@push('css')
<link href="{{ asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
<link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
{{--<link href="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">--}}
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
                    <h3 class="box-title pull-left">Edit Venue</h3>
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

                    <form class="form-horizontal venue_form" 
                          id="venue_form"
                          action="{{url('update_venue')}}" 
                          method="POST" 
                          enctype="multipart/form-data"  >

                        {{ csrf_field() }}
                        <div id="rootwizard">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Venue </a></li>
                                <li><a href="#tab2" data-toggle="tab">Venue Contact </a></li>
                                <li><a href="#tab3" data-toggle="tab">Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <h2 class="hidden">&nbsp;</h2>

                                    <div class="form-group {{ $errors->first('venue_name', 'has-error') }}">
                                        <label for="venue_name" class="col-sm-2 control-label">Name *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_name"  name="venue_name"     class="form-control required" 
                                                   placeholder="Venue Name..." value="{!! old('venue_name',$venue->name) !!}"/> 

                                            {!! $errors->first('venue_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>    
                                    <div class="form-group {{ $errors->first('venue_email', 'has-error') }}">
                                        <label for="venue_email" class="col-sm-2 control-label">Email *</label>
                                        <div class="col-sm-10">

                                            <input type="email" class="form-control"  id="venue_email"  name="venue_email"     class="form-control required" 
                                                   placeholder="Venue Email..." value="{!! old('venue_email',$venue->email) !!}"/> 

                                            {!! $errors->first('venue_email', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('venue_address', 'has-error') }}">
                                        <label for="venue_address" class="col-sm-2 control-label">Address *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_address"  name="venue_address"     class="form-control required" 
                                                   placeholder="Venue Address..." value="{!! old('venue_address',$venue->address) !!}"/> 

                                            {!! $errors->first('venue_address', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('venue_region', 'has-error') }}">
                                        <label for="venue_region" class="col-sm-2 control-label">Region *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_region"  name="venue_region"     class="form-control required" 
                                                   placeholder="Venue Region..." value="{!! old('venue_region',$venue->region) !!}"/> 

                                            {!! $errors->first('venue_region', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('venue_post_code', 'has-error') }}">
                                        <label for="venue_post_code" class="col-sm-2 control-label">Post Code *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_post_code"  name="venue_post_code"     class="form-control required" 
                                                   placeholder="Venue Post Code..." value="{!! old('venue_post_code',$venue->post_code) !!}"/> 

                                            {!! $errors->first('venue_post_code', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('venue_landline', 'has-error') }}">
                                        <label for="venue_landline" class="col-sm-2 control-label">Land Line *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_landline"  name="venue_landline"     class="form-control required" 
                                                   placeholder="Venue Land Line..." value="{!! old('venue_landline',$venue->landline) !!}"/> 

                                            {!! $errors->first('venue_landline', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('venue_fax', 'has-error') }}">
                                        <label for="venue_fax" class="col-sm-2 control-label">Fax *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_fax"  name="venue_fax"     class="form-control required" 
                                                   placeholder="Venue Fax..." value="{!! old('venue_fax',$venue->fax) !!}"/> 

                                            {!! $errors->first('venue_fax', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('venue_website', 'has-error') }}">
                                        <label for="venue_website" class="col-sm-2 control-label">Website </label>
                                        <div class="col-sm-10">

                                            <input type="url" class="form-control"  id="venue_website"  name="venue_website"     class="form-control required" 
                                                   placeholder="Venue Website..." value="{!! old('venue_website',$venue->website) !!}"/> 

                                            {!! $errors->first('venue_website', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" disabled="disabled">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group {{ $errors->first('venue_contact_name', 'has-error') }}">
                                        <label for="venue_contact_name" class="col-sm-2 control-label">Contact Name *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_contact_name"  name="venue_contact_name"     class="form-control required" 
                                                   placeholder="Contact Name..." value="{!! old('venue_contact_name',$venue->contact_name) !!}"/> 

                                            {!! $errors->first('venue_contact_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('venue_contact_email', 'has-error') }}">
                                        <label for="venue_contact_email" class="col-sm-2 control-label">Contact Email *</label>
                                        <div class="col-sm-10">

                                            <input type="email" class="form-control"  id="venue_contact_email"  name="venue_contact_email"     class="form-control required" 
                                                   placeholder="Contact Email..." value="{!! old('venue_contact_email',$venue->contact_email) !!}"/> 

                                            {!! $errors->first('venue_contact_email', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('venue_contact_landline', 'has-error') }}">
                                        <label for="venue_contact_landline" class="col-sm-2 control-label">Contact Land Line *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_contact_landline"  name="venue_contact_landline"     class="form-control required" 
                                                   placeholder="Contact Land Line..." value="{!! old('venue_contact_landline',$venue->contact_landline) !!}"/> 

                                            {!! $errors->first('venue_contact_landline', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('venue_contact_mobile', 'has-error') }}">
                                        <label for="venue_contact_mobile" class="col-sm-2 control-label">Contact Mobile *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="venue_contact_mobile"  name="venue_contact_mobile"     class="form-control required" 
                                                   placeholder="Contact Mobile..." value="{!! old('venue_contact_mobile',$venue->contact_mobile) !!}"/> 

                                            {!! $errors->first('venue_contact_mobile', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <input type="hidden" name="venue_id" value="{{$venue->id}}">


                                </div>
                                <div class="tab-pane" id="tab3" disabled="disabled">
                                    <div class="tab-pane" id="tab3" disabled="disabled">
                                        <h6 class="m-t-20"><b>Fees</b></h6>

                                        <div class="form-group {{ $errors->first('venue_fees', 'has-error') }}">
                                            <label for="venue_fees" class="col-sm-2 control-label">Fees *</label>
                                            <div class="col-sm-10">

                                                <select class="form-control" title="Select Venue Fees..." name="venue_fees">
                                                    <option value="">Select</option>
                                                    @foreach($get_fees as $fee)
                                                    <option value="{{$fee->fees}} "@if(old('venue_fees') === $fee->fees || $fee->fees===$venue->fees) selected="selected" @endif>{{ucfirst($fee->fees_type)}} / {{$fee->fees}}</option>
                                                    @endforeach 
                                                </select>

                                                {!! $errors->first('venue_fees', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <hr class="col-md-12">
                                        <h6 class="m-t-20"><b>Facilities</b></h6>
                                        <div class="form-group {{ $errors->first('venue_facilities', 'has-error') }}">
                                            <label for="venue_facilities" class="col-sm-2 control-label">Facilities *</label>
                                            <div class="col-sm-10">

                                                <select class="form-control" title="Select Venue Facility..." name="venue_facilities">
                                                    <option value="">Select</option>
                                                    <option 
                                                        value="capacity"
                                                        @if(old('venue_facilities') === "capacity" || $venue->facilities==="capacity") selected="selected" @endif >Capacity
                                                </option>
                                                <option 
                                                    value="it available"
                                                    @if(old('venue_facilities') === "it available" || $venue->facilities==="it available") selected="selected" @endif >IT available
                                            </option>
                                                <option 
                                                    value="hot drinks"
                                                    @if(old('venue_facilities') === "hot drinks" || $venue->facilities==="hot drinks") selected="selected" @endif >Hot drinks
                                            </option>
                                            <option 
                                                value="food"
                                                @if(old('venue_facilities') === "food" || $venue->facilities==="food") selected="selected" @endif >Food
                                        </option>
                                        <option 
                                            value="onsite parking"
                                            @if(old('venue_facilities') === "onsite parking" || $venue->facilities==="onsite parking") selected="selected" @endif >Onsite parking
                                    </option>
                                </select>
                            </div>
                            {!! $errors->first('venue_facilities', '<span class="help-block">:message</span>') !!}
                        </div>
                        <hr class="col-md-12">
                        <h6 class="m-t-20"><b>Risk Assessment</b></h6>
                        <div class="form-group {{ $errors->first('date_completed', 'has-error') }}">
                            <label for="date_completed" class="col-sm-2 control-label">Date Completed</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date_completed" 
                                       id="datepicker-autoclose2" value="{!! old('date_completed',$venue->date_completed) !!}"  placeholder="yyyy-mm-dd"/> 

                                {!! $errors->first('date_completed', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('venue_copy', 'has-error') }}">
                            <label for="venue_copy" class="col-sm-2 control-label">Copy </label>
                            <div class="col-sm-10">
                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                        <input type="file" name="venue_copy"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                            </div>
                            {!! $errors->first('venue_copy', '<span class="help-block">:message</span>') !!}
                        </div>

                        <hr class="col-md-12">
                        <h6 class="m-t-20"><b>Notes</b></h6>
                        <div class="form-group {{ $errors->first('venue_notes', 'has-error') }}">
                            <label for="venue_notes" class="col-sm-2 control-label">Notes</label>
                            <div class="col-sm-10">

                                <textarea
                                    class="form-control"  
                                    id="venue_notes"  
                                    name="venue_notes"   
                                    placeholder="Notes..." 
                                    class="form-control required" 
                                    >{!! old('venue_notes',$venue->notes) !!}</textarea>

                                {!! $errors->first('venue_notes', '<span class="help-block">:message</span>') !!}
                            </div>
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
</div>

@include('layouts.partials.right-sidebar')
@endsection

@push('js')
<script src="{{ asset('plugins/components/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{asset('plugins/components/icheck/icheck.min.js')}}"></script>
<script src="{{asset('plugins/components/icheck/icheck.init.js')}}"></script>
<script src="{{asset('plugins/components/moment/moment.js')}}"></script>
{{--<script src="{{asset('plugins/components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>--}}
<script src="{{asset('plugins/components/jqueryui/jquery-ui.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"
type="text/javascript"></script>
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{ asset('/js/jquery.mask.js') }}"></script>
<script src="{{ asset('/js/venue.js') }}"></script>

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
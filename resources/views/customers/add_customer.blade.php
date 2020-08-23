@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/icheck/skins/all.css')}}" rel="stylesheet">
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
                <h3 class="box-title pull-left">Add Customer</h3>
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

                <form class="form-horizontal customer_form" 
                      id="customer_form"
                      action="{{url('store_customer')}}" 
                      method="POST" 
                      enctype="multipart/form-data"  >

                    {{ csrf_field() }}
                    <div id="rootwizard">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Personal</a></li>
                            <li ><a href="#tab2" data-toggle="tab">Specific Contact</a></li>
                            <li ><a href="#tab3" data-toggle="tab">Account Manager</a></li>
                            <li ><a href="#tab4" data-toggle="tab">Venue</a></li>
                            <li><a href="#tab5" data-toggle="tab">More Details</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <h2 class="hidden">&nbsp;</h2>
                                <div class="form-group {{ $errors->first('customer_name', 'has-error') }}">
                                    <label for="customer_name" class="col-sm-2 control-label">Name *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="customer_name"  name="customer_name"     class="form-control required" 
                                               placeholder="Customer Name..." value="{!! old('customer_name') !!}"/> 

                                        {!! $errors->first('customer_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('customer_email', 'has-error') }}">
                                    <label for="customer_email" class="col-sm-2 control-label">Email *</label>
                                    <div class="col-sm-10">

                                        <input type="email" class="form-control"  id="customer_email"  name="customer_email"     class="form-control required" 
                                               placeholder="Customer Email..." value="{!! old('customer_email') !!}"/> 

                                        {!! $errors->first('customer_email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('customer_post_code', 'has-error') }}">
                                    <label for="customer_post_code" class="col-sm-2 control-label">Post Code *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="customer_post_code"  name="customer_post_code"     class="form-control required" 
                                               placeholder="Customer Post Code..." value="{!! old('customer_post_code') !!}"/> 

                                        {!! $errors->first('customer_email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('customer_landline', 'has-error') }}">
                                    <label for="customer_landline" class="col-sm-2 control-label">Land Line *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="customer_landline"  name="customer_landline"     class="form-control required" 
                                               value="" placeholder="Customer Land Line..." value="{!! old('customer_landline') !!}"/> 
                                        {!! $errors->first('customer_landline', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('customer_mobile', 'has-error') }}">
                                    <label for="customer_mobile" class="col-sm-2 control-label">Mobile *</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="customer_mobile"  name="customer_mobile"     class="form-control required" 
                                               value="" placeholder="Customer Mobile..." value="{!! old('customer_mobile') !!}"/> 
                                        {!! $errors->first('customer_mobile', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('customer_fax', 'has-error') }}">
                                    <label for="customer_fax" class="col-sm-2 control-label">Fax </label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="customer_fax"  name="customer_fax"     class="form-control required" 
                                               value="" placeholder="Customer Fax..." value="{!! old('customer_fax') !!}"/> 
                                        {!! $errors->first('customer_fax', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('customer_website', 'has-error') }}">
                                    <label for="customer_website" class="col-sm-2 control-label">Website</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="customer_website"  name="customer_website"     class="form-control required" 
                                               value="" placeholder="Customer Website..." value="{!! old('customer_website') !!}"/> 
                                        {!! $errors->first('customer_website', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="form-group {{ $errors->first('contact_name', 'has-error') }}">
                                    <label for="contact_name" class="col-sm-2 control-label">Contact Name </label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  
                                               id="contact_name" 
                                               name="contact_name" 
                                               placeholder="Contact Name..." 
                                               value="{!! old('contact_name') !!}"/> 

                                        {!! $errors->first('contact_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('contact_position', 'has-error') }}">
                                    <label for="contact_position" class="col-sm-2 control-label">Contact Position </label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="contact_position" 
                                               name="contact_position"    
                                               class="form-control required" 
                                               placeholder="Contact Position..." 
                                               value="{!! old('contact_position') !!}"/> 

                                        {!! $errors->first('contact_position', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('direct_number', 'has-error') }}">
                                    <label for="direct_number" class="col-sm-2 control-label">Direct Number </label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="direct_number" 
                                               name="direct_number"    
                                               class="form-control required" 
                                               placeholder="Direct Number..." 
                                               value="{!! old('direct_number') !!}"/> 

                                        {!! $errors->first('direct_number', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('direct_email', 'has-error') }}">
                                    <label for="direct_email" class="col-sm-2 control-label">Direct Email </label>
                                    <div class="col-sm-10">

                                        <input type="email" 
                                               id="direct_email" 
                                               name="direct_email"    
                                               class="form-control required" 
                                               placeholder="Direct Email..." 
                                               value="{!! old('direct_email') !!}"/> 

                                        {!! $errors->first('direct_email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('contact_mobile', 'has-error') }}">
                                    <label for="contact_mobile" class="col-sm-2 control-label">Contact Mobile</label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="contact_mobile" 
                                               name="contact_mobile"    
                                               class="form-control required" 
                                               placeholder="Contact Mobile..." 
                                               value="{!! old('contact_mobile') !!}"/> 

                                        {!! $errors->first('contact_mobile', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab3">
                                <div class="form-group {{ $errors->first('account_manager_name', 'has-error') }}">
                                    <label for="account_manager_name" class="col-sm-2 control-label">Manager Name</label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="account_manager_name" 
                                               name="account_manager_name"    
                                               class="form-control" 
                                               placeholder="Account Manager Name..." 
                                               value="{!! old('account_manager_name') !!}"/> 

                                        {!! $errors->first('account_manager_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('manager_contact_number', 'has-error') }}">
                                    <label for="manager_contact_number" class="col-sm-2 control-label">Manager Contact</label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="manager_contact_number" 
                                               name="manager_contact_number"    
                                               class="form-control" 
                                               placeholder="Account Manager Contact..." 
                                               value="{!! old('manager_contact_number') !!}"/> 

                                        {!! $errors->first('manager_contact_number', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('manager_email', 'has-error') }}">
                                    <label for="manager_email" class="col-sm-2 control-label">Manager Email</label>
                                    <div class="col-sm-10">

                                        <input type="email" 
                                               id="manager_email" 
                                               name="manager_email"    
                                               class="form-control" 
                                               placeholder="Account Manager Email..." 
                                               value="{!! old('manager_email') !!}"/> 

                                        {!! $errors->first('manager_email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab4">
                                <div class="form-group {{ $errors->first('venue_id', 'has-error') }}">
                                    <label for="venue_id" class="col-sm-2 control-label">Venue </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="venue_id">
                                            <option value="" >Select</option>
                                            @foreach ($venues as $venue)
                                            <option value="{{$venue->id}}" @if(old('venue_id')===$venue->id) selected @endif>{{$venue->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="help-block">{{ $errors->first('venue_id', ':message') }}</span>
                                </div>
                                <div class="form-group {{ $errors->first('venue_contact_name', 'has-error') }}">
                                    <label for="venue_contact_name" class="col-sm-2 control-label">Venue Contact Name</label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="venue_contact_name" 
                                               name="venue_contact_name"    
                                               class="form-control" 
                                               placeholder="Venue Contact Name..." 
                                               value="{!! old('venue_contact_name') !!}"/> 

                                        {!! $errors->first('venue_contact_name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('venue_contact_email', 'has-error') }}">
                                    <label for="venue_contact_email" class="col-sm-2 control-label">Venue Contact Email</label>
                                    <div class="col-sm-10">

                                        <input type="email" 
                                               id="venue_contact_email" 
                                               name="venue_contact_email"    
                                               class="form-control" 
                                               placeholder="Venue Contact Email..." 
                                               value="{!! old('venue_contact_email') !!}"/> 

                                        {!! $errors->first('venue_contact_email', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('venue_contact_number', 'has-error') }}">
                                    <label for="venue_contact_number" class="col-sm-2 control-label">Venue Contact Number</label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="venue_contact_number" 
                                               name="venue_contact_number"    
                                               class="form-control" 
                                               placeholder="Venue Contact Number..." 
                                               value="{!! old('venue_contact_number') !!}"/> 

                                        {!! $errors->first('venue_contact_number', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('venue_contact_address', 'has-error') }}">
                                    <label for="venue_contact_address" class="col-sm-2 control-label">Venue Contact Address</label>
                                    <div class="col-sm-10">

                                        <input type="text" 
                                               id="venue_contact_address" 
                                               name="venue_contact_address"    
                                               class="form-control" 
                                               placeholder="Venue Contact Address..." 
                                               value="{!! old('venue_contact_address') !!}"/> 

                                        {!! $errors->first('venue_contact_address', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab5">
                                <h2 class="hidden">&nbsp;</h2>


                                <div class="form-group {{ $errors->first('customer_discount', 'has-error') }}">
                                    <label for="customer_discount" class="col-sm-2 control-label">Discount Rate %</label>
                                    <div class="col-sm-10">

                                        <input type="number" min="0" max="100" class="form-control"  id="customer_discount" name="customer_discount" class="form-control required" 
                                               value="" placeholder="Customer Discount Rate..." value="{!! old('customer_discount') !!}"/> 
                                        {!! $errors->first('customer_discount', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('customer_work_package', 'has-error') }}">
                                    <label for="customer_work_package" class="col-sm-2 control-label">Work Package Number</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control"  id="customer_work_package" name="customer_work_package" class="form-control required" 
                                               value="" placeholder="Customer Work Package..." value="{!! old('customer_work_package') !!}"/> 
                                        {!! $errors->first('customer_work_package', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->first('customer_status', 'has-error') }}">
                                    <label for="customer_status" class="col-sm-2 control-label">Status *</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" title="Select Customer Status..." name="customer_status">
                                            <option value="">Select</option>
                                            <option 
                                                value="1"
                                                @if(old('customer_status') === "1") selected="selected" @endif >Active
                                        </option>
                                        <option 
                                            value="0"
                                            @if(old('customer_status') === "0") selected="selected" @endif >Non Active
                                    </option>
                                </select>
                            </div>
                            <span class="help-block">{{ $errors->first('customer_status', ':message') }}</span>
                        </div>  
                        <div class="form-group {{ $errors->first('client_type', 'has-error') }}">
                            <label for="client_type" class="col-sm-2 control-label">Client Type *</label>
                            <div class="col-sm-10">
                                <select class="form-control" title="Select Customer Status..." name="client_type">
                                    <option value="">Select</option>
                                    <option 
                                        value="1"
                                        @if(old('client_type') === "1") selected="selected" @endif >Active
                                </option>
                                <option 
                                    value="0"
                                    @if(old('client_type') === "0") selected="selected" @endif >Non Active
                            </option>
                        </select>
                    </div>
                    <span class="help-block">{{ $errors->first('client_type', ':message') }}</span>
                </div> 
                <div class="form-group {{ $errors->first('customer_marketing_opt', 'has-error') }}">
                    <label for="customer_marketing_opt" class="col-sm-2 control-label">Marketing Option *</label>
                    <div class="radio-list">
                        <label class="radio-inline p-0">
                            <div class="radio radio-info">
                                <input type="radio" name="customer_marketing_opt" id="customer_marketing_opt" value="yes" required="" checked="">
                                <label for="radio1">Yes</label>
                            </div>
                        </label>
                        <label class="radio-inline">
                            <div class="radio radio-info">
                                <input type="radio" name="customer_marketing_opt" id="customer_marketing_opt" value="no">
                                <label for="radio2">No </label>
                            </div>
                        </label>
                    </div>
                    <span class="help-block">{{ $errors->first('customer_marketing_opt', ':message') }}</span>

                </div>

                <hr class="col-sm-12"> 
                <h6><b>Preferred Contact Method</b></h6>
                <div class="form-group {{ $errors->first('contact_method', 'has-error') }}">
                    <label for="contact_method" class="col-sm-2 control-label">Contact Via *</label>
                    <div class="radio-list">
                        <label class="radio-inline">
                            <div class="radio radio-info">
                                <input type="radio" name="contact_method" id="" value="email" checked="">
                                <label for="radio2">Email </label>
                            </div>
                        </label>
                        <label class="radio-inline p-0">
                            <div class="radio radio-info">
                                <input type="radio" name="contact_method" id="" value="letter" >
                                <label for="radio1">Letter</label>
                            </div>
                        </label>

                        <label class="radio-inline">
                            <div class="radio radio-info">
                                <input type="radio" name="contact_method" id="" value="sms">
                                <label for="radio2">SMS </label>
                            </div>
                        </label>
                        <label class="radio-inline">
                            <div class="radio radio-info">
                                <input type="radio" name="contact_method" id="" value="phone">
                                <label for="radio2">Phone </label>
                            </div>
                        </label>
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
<script src="{{ asset('plugins/components/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{asset('plugins/components/jqueryui/jquery-ui.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{ asset('js/customer.js') }}"></script>

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
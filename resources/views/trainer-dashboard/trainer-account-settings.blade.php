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
                    <h3 class="box-title pull-left">Account Settings</h3>
                    <div class="clearfix"></div>
                    <form id="commentForm" action="{{url('trainer-account-settings')}}"
                          method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                        <div id="rootwizard">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">User Profile</a></li>
                                <li><a href="#tab2" data-toggle="tab">Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group {{ $errors->first('name', 'has-error') }}">
                                        <label for="name" class="col-sm-2 control-label">Name *</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text"
                                                   placeholder="Name" class="form-control required"
                                                   value="{{$user->name}}"/>

                                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                        <label for="email" class="col-sm-2 control-label">Email *</label>
                                        <div class="col-sm-10">
                                            <input id="email" name="email"  disabled="" placeholder="E-mail" type="text"
                                                   class="form-control required email" value="{{$user->email}}"/>
                                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <h6><b>If you don't want to change password... please leave them empty</b></h6>

                                    <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                        <label for="password" class="col-sm-2 control-label">Password *</label>
                                        <div class="col-sm-10">
                                            <input id="password" name="password" type="password" placeholder="Password"
                                                   class="form-control required" value="{!! old('password') !!}"/>
                                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}">
                                        <label for="password_confirm" class="col-sm-2 control-label">Confirm Password
                                            *</label>
                                        <div class="col-sm-10">
                                            <input id="password_confirmation" name="password_confirmation"
                                                   type="password"
                                                   placeholder="Confirm Password " class="form-control required"/>
                                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
                                        <label for="pic" class="col-sm-2 control-label">Profile picture</label>
                                        <div class="col-sm-10">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 200px;">
                                                    @if($user->profile->pic != null)
                                                    <img src="{{asset('storage/uploads/users/'.$user->profile->pic)}}" alt="profile pic">
                                                    @else
                                                    <img src="http://placehold.it/200x200" alt="profile pic">
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 200px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input id="pic" name="pic_file" type="file" class="form-control"/>
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            <span class="help-block">{{ $errors->first('pic_file', ':message') }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab2" disabled="disabled">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group {{ $errors->first('trainer_address', 'has-error') }}">
                                        <label for="trainer_address" class="col-sm-2 control-label">Address *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="trainer_address"  name="trainer_address"     class="form-control required" 
                                                   placeholder="Trainer Address..." value="{!! old('trainer_address',$trainer->address) !!}"/> 

                                            {!! $errors->first('trainer_address', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('trainer_region', 'has-error') }}">
                                        <label for="trainer_region" class="col-sm-2 control-label">Region *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="trainer_region"  name="trainer_region"     class="form-control required" 
                                                   placeholder="Trainer Region..." value="{!! old('trainer_region',$trainer->region) !!}"/> 

                                            {!! $errors->first('trainer_region', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('trainer_post_code', 'has-error') }}">
                                        <label for="trainer_post_code" class="col-sm-2 control-label">Post Code *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="trainer_post_code"  name="trainer_post_code"     class="form-control required" 
                                                   placeholder="Trainer Post Code..." value="{!! old('trainer_post_code',$trainer->post_code) !!}"/> 

                                            {!! $errors->first('trainer_post_code', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('trainer_contact', 'has-error') }}">
                                        <label for="trainer_contact" class="col-sm-2 control-label">Home Contact *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="trainer_contact"  name="trainer_contact"     class="form-control required" 
                                                   placeholder="Trainer Home Contact..." value="{!! old('trainer_contact',$trainer->home_contact) !!}"/> 

                                            {!! $errors->first('trainer_contact', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('trainer_mobile', 'has-error') }}">
                                        <label for="trainer_mobile" class="col-sm-2 control-label">Mobile *</label>
                                        <div class="col-sm-10">

                                            <input type="text" class="form-control"  id="trainer_mobile"  name="trainer_mobile"     class="form-control required" 
                                                   placeholder="Trainer Mobile..." value="{!! old('trainer_mobile',$trainer->mobile) !!}"/> 

                                            {!! $errors->first('trainer_mobile', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>



                                </div>

                                <ul class="pager wizard">
                                    <li class="previous"><a href="#">Previous</a></li>
                                    <li class="next"><a href="#">Next</a></li>
                                    <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>


                    @if(count($errors) > 0)
                    <div class="alert alert-danger">Errors! Please fill form with proper details</div>
                    @endif

                </div>
            </div>
        </div>

        @include('layouts.partials.right-sidebar')
    </div>
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
<script src="{{ asset('/js/trainer-setting.js') }}"></script>

<script>
@if (\Session::has('message'))
        $.toast({
        heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
                }
        );
@endif
</script>
<scri    pt>
        $("#dob").datepicke        r({
        dateFormat: 'yy-m-        d',
        SetDate:"{{$user->profile->dob}        }",
            widgetPositionin            g:{
                vertical:'bott        om'
                   },
            keepOpen:fal        se,
            useCurrent: fal        se,
            maxDate: moment().add(1,'h').toDat    e()
                });
    </scri        pt>
@endpush
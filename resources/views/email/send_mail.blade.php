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
                    <h3 class="box-title pull-left">{{$details->name}}</h3>
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

                    <form class="form-horizontal send_mail" 
                          id="send_mail"
                          action="{{url('submit_mail')}}" 
                          method="POST" 
                          enctype="multipart/form-data"  >

                        {{ csrf_field() }}
                        <div id="rootwizard">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Email</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <h6 class="col-sm-offset-2"><b>{${{$details->type}}} will be replaced by {{$details->type}} name</b></h6>
                                    @if($details->key==="trainer_new_course_registeration")
                                    <h6 class="col-sm-offset-2"><b>{$course} will be replaced by course name</b></h6>
                                    @endif
                                    <div class="form-group {{ $errors->first('message', 'has-error') }}">
                                        <label for="message" class="col-sm-2 control-label">Message *</label>
                                        <div class="col-sm-10">
                                            <textarea 
                                                id="message" 
                                                name="message" 
                                                type="text" 
                                                rows="10"
                                                placeholder="Your Message..." 
                                                class="form-control">{!! old('message',$details->content) !!}</textarea>

                                            {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <ul class="pager wizard">
                                    <input type="hidden" name="template_id" value="{{$details->id}}">
                                    <input type="hidden" name="email_type" value="{{$details->type}}">
                                    <li class="next finish" ><a href="javascript:;">Finish</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
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
<script src="{{ asset('/js/jquery.mask.js') }}"></script>
<script src="{{ asset('/js/send_mail.js') }}"></script>

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
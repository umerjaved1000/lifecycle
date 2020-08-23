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
                    <h3 class="box-title pull-left">Complete Course</h3>
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

                    <form class="form-horizontal course_completet_form" 
                          id="course_completet_form"
                          action="{{url('complete_course_lifecycle')}}" 
                          method="POST" 
                          enctype="multipart/form-data"  >

                        {{ csrf_field() }}
                        {{ csrf_field() }}
                        <div id="rootwizard">
                            <ul class="nav nav-tabs">
                                <li ><a href="#tab2" data-toggle="tab">Course Summary</a></li>
                                <li ><a href="#tab3" data-toggle="tab">Other Information</a></li>
                            </ul>
                            <div class="tab-content">



                                <div class="tab-pane" id="tab2">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group {{ $errors->first('behavior_issues', 'has-error') }}">
                                        <label for="behavior_issues" class="col-sm-2 control-label">Behavior Issues</label>
                                        <div class="col-sm-10">
                                            <input type="text" 
                                                   class="form-control"  
                                                   id="behavior_issues" 
                                                   name="behavior_issues" 
                                                   placeholder="Behavior Issues..." 
                                                   value="{!! old('behavior_issues') !!}"/> 
                                            {!! $errors->first('behavior_issues', '<span class="help-block">:message</span>') !!}

                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('course_material_issues', 'has-error') }}">
                                        <label for="behavior_issues" class="col-sm-2 control-label">Course Material Issues</label>
                                        <div class="col-sm-10">
                                            <input type="text" 
                                                   class="form-control"  
                                                   id="course_material_issues" 
                                                   name="course_material_issues" 
                                                   placeholder="Course Material Issues..." 
                                                   value="{!! old('course_material_issues') !!}"/> 
                                            {!! $errors->first('course_material_issues', '<span class="help-block">:message</span>') !!}

                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('course_material_issues', 'has-error') }}">
                                        <label for="venue_issues" class="col-sm-2 control-label">Any Venue Issues</label>
                                        <div class="col-sm-10">
                                            <input type="text" 
                                                   class="form-control"  
                                                   id="venue_issues" 
                                                   name="venue_issues" 
                                                   placeholder="Venue Issues..." 
                                                   value="{!! old('venue_issues') !!}"/> 
                                            {!! $errors->first('venue_issues', '<span class="help-block">:message</span>') !!}

                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->first('course_edited', 'has-error') }}">
                                        <label for="course_edited" class="col-sm-2 control-label">Course Edited?</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" title="Select Customer Status..." name="course_edited">
                                                <option value="">Select</option>
                                                <option 
                                                    value="1"
                                                    @if(old('course_edited') === "1") selected="selected" @endif >Yes
                                            </option>
                                            <option 
                                                value="0"
                                                @if(old('course_edited') === "0") selected="selected" @endif >No
                                        </option>
                                    </select>
                                </div>
                                <span class="help-block">{{ $errors->first('course_edited', ':message') }}</span>
                            </div>  
                            <div class="form-group {{ $errors->first('notes', 'has-error') }}">
                                <label for="notes" class="col-sm-2 control-label">Notes</label>
                                <div class="col-sm-10">
                                    <textarea
                                        class="form-control"  
                                        id="notes" 
                                        name="notes"
                                        value="{!! old('notes') !!}"></textarea> 
                                    {!! $errors->first('notes', '<span class="help-block">:message</span>') !!}

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="col-md-12">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox1" name="delegates_information" type="checkbox">
                                            <label for="checkbox1"> Delegate information entered into system</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox2"   name="client_issues_closed" type="checkbox">
                                            <label for="checkbox2"> Any client issues closed in RCA system</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox3" name="certificates_emailed"  type="checkbox">
                                            <label for="checkbox3"> Certificate emailed / posted </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox4" name="invoice_paid"   type="checkbox">
                                            <label for="checkbox4"> Invoice Paid</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox5" name="kpis_updated" type="checkbox">
                                            <label for="checkbox5"> KPIs updated</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <ul class="pager wizard">
                        <input type="hidden" value="{{request()->route('id')}}" name="booking_id">
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
<script src="{{ asset('/js/complete-course.js') }}"></script>
<script>
function addDelegate() {
var clone = $('.default-delegate').clone();
$(clone).removeClass('default-delegate');
$(clone).addClass('cloned_item');
$(clone).find('.delete-delegate').removeClass('hidden');
$(clone).children().find('.delegate_name').val('');
$(clone).children().find('.delegate_email').val('');
$(clone).children().find('.delegate_license').val('');
$(clone).children().find('.delegate_telephone').val('');
$('.delegates-container').append(clone);
}
function removeDelegate(item) {
$(item).parent().parent().remove();
}
</script>
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
            < /s        cript>

            @endpush
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
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box calendar-widget">
                <div id='schedule_calendar'></div>
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
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('js/schedule.js')}}"></script>
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
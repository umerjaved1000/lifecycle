@extends('layouts.master')
@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<style>
    .delete{
        cursor: pointer;
    }
    .customer_details_headings{
        font-weight: bold;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="col-md-12 m-b-30 b-b p-l-0">
                    <div class="col-md-12">
                        <h2 class="box-title m-b-0 p-l-0">Current Booking</h2>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>Booking Id</th>
                                <th>Course</th>
                                <th>Venue</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_array($bookings) || is_object($bookings))
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{$booking->id}}</td>
                                <td>{{$booking->course_title}}</td>
                                <td>{{$booking->venue_name}}</td>
                                <td>{{$booking->customer_name}}</td>
                                <td>{{$booking->venue_address}}</td>
                                <td>{{$booking->start_date}}</td>
                                <td>{{$booking->end_date}}</td>
                                <td>
                                    @if($booking->end_date===date('Y-m-d'))
                                    <a class="btn btn-success btn-sm" href="/complete-course/{{$booking->id}}"><i class="fa fa-check"></i> Complete Course</a> 

                                    @else
                                    <a class="btn btn-primary btn-sm m-t-5" href="/add-course-material/{{$booking->id}}"><i class="fa fa-plus-circle"></i> Add Material</a>&nbsp; 
                                    <a class="btn btn-success btn-sm m-t-5" href="/view-course-material/{{$booking->id}}"><i class="fa fa-info-circle"></i> View Materials</a> 
                                    @endif
                                </td> 

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    @include('layouts.partials.right-sidebar')
</div>

@endsection

@push('js')
<script src     ="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script> 
<!-- end - This is for export functionality only -->
<script>
$(document).ready(function () {
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
        $('#myTable').DataTable();
$('.alert-success').delay(5000).slideUp('slow');
});
</script>

@endpush
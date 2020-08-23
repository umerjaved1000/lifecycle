@extends('layouts.master')
@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endpush
<style>
    .delete{
        cursor: pointer;
    }
    .booking_details p{
        color: #000;
    }
</style>
@section('content')
<div class="container-fluid">

    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="col-md-12 m-b-30 b-b p-l-0">
                    <h2 class="box-title m-b-0 p-l-0">Course Files</h2>

                </div>
                <div class="row">
                    <div class="booking_details text-capitalize p-l-30 p-r-40">
                        <div class="col-sm-12 col-xs-12">
                            <p><b>Course ID: CR-LC-{{request()->route('id')}}</b></p>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <p class=""><b>Course Title: </b>{{$course->title}}</p>
                        </div>
                        
                        <div class="col-sm-12 col-xs-12">
                            <p class=""><b>Notes: </b>{{$course->notes}}</p>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <p><b>Description:</b>{{$course->description}}</p>
                        </div>
                    </div>
                    <hr class="hr-line m-b-30">
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date Uploaded</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course_files as $file)
                            <tr>
                                <td>{{$file->file}}</td>       
                                <td>{{$file->created_at}}</td>       
                                <td>
                                    <a class="btn btn-primary" href="/upload/{{$file->file}}" target="blank"><i class="fa fa-download"></i> {{str_limit($file->file,10,'..')}}</a>
                                    <a class="btn btn-danger btn-sm" onclick="delete_file({{$file->id}})"><i class="icon-trash"></i> Delete</a> &nbsp;&nbsp;
                                </td>       
                            </tr>
                            @endforeach                                                                                                                                       
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
<script src                                                                                                                                        ="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
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
                                        function delete_file(c_id)
                                        {
                                        bootbox.confirm({
                                        title: 'Delete Course File',
                                                message: 'Do you really want to <b>Delete</b> this <b>file?</b>',
                                                buttons: {
                                                cancel: {
                                                label: '<i class="fa fa-times"></i> Cancel'
                                                },
                                                        confirm: {
                                                        label: '<i class="fa fa-check"></i> Confirm'
                                                        }
                                                },
                                                callback: function (result) {
                                                if (result) {
                                                document.location.href = "{!! url('delete_file/" + c_id + "'); !!}";
                                                }
                                                }
                                        });
                                        }
</script>

@endpush
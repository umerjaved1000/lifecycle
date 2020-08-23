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
                    <div class="col-md-6">
                        <h2 class="box-title m-b-0 p-l-0">Trainers</h2>
                    </div>
                    <div class="col-md-6 p-t-5">
                        <a href="/create_trainer" class="btn btn-success pull-right"><i class="icon-plus"></i>&nbsp; Add Trainer</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>Ref No.</th>
                                <th>Name</th>
                                <th>Post Code</th>
                                <th>Address</th>
                                <th>Home</th>
                                <th>Mobile</th>
                                <th>Level</th>
                                <th style="width: 250px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_array($trainers) || is_object($trainers))
                            @foreach($trainers as $trainer)
                            <tr>
                                <td>TR-LC-{{$trainer->id}}</td>
                                <td>{{$trainer->name}}</td>
                                <td>{{$trainer->post_code}}</td>
                                <td>{{$trainer->address}}</td>
                                <td>{{$trainer->home_contact}}</td>
                                <td>{{$trainer->mobile}}</td>
                                <td>{{$trainer->level}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="edit-trainer/{{$trainer->id}}"><i class="icon-pencil"></i>Edit</a>&nbsp;&nbsp
                                    <a class="btn btn-danger btn-sm" onclick="delete_trainer({{$trainer->login_id}})"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                                    <a class="btn btn-success btn-sm" href="edit-trainer/{{$trainer->id}}" ><i class="icon-info"></i> View</a>&nbsp;&nbsp;
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
<script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
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
                                        function delete_trainer(t_id)
                                        {
                                        bootbox.confirm({
                                        title: 'Delete Trainer',
                                                message: 'Do you really want to <b>Delete</b> this <b>trainer?</b>',
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
                                                document.location.href = "{!! url('delete_trainer/" + t_id + "'); !!}";
                                                }
                                                }
                                        });
                                        }
</script>

@endpush
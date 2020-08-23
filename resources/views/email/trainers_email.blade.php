@extends('layouts.master')
@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endpush
<style>
    .delete{
        cursor: pointer;
    }
</style>
@section('content')
<div class="container-fluid">

    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="col-md-12 m-b-30 b-b p-l-0">
                    <div class="col-md-6">
                        <h2 class="box-title m-b-0 p-l-0">Trainers Email</h2>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainer_emails as $email)
                            <tr>
                                <td>{{$email->name}}</td>           
                                <td>{{str_limit($email->content,200,'...')}}</td>       
                                <td><a href="/send_mail/{{$email->id}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a></td>       
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
<script src                                                                                                               ="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
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
function delete_course(c_id)
        {
        bootbox.confirm({
        title: 'Delete Course',
                message: 'Do you really want to <b>Delete</b> this <b>course?</b>',
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
                document.location.href = "{!! url('delete_course/" + c_id + "'); !!}";
                }
                }
        });
        }
</script>

@endpush
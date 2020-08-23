@extends('layouts.master')
@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<style>
    .delete{
        cursor: pointer;
    }
    .venue_details_headings{
        font-weight: bold;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="col-md-12 m-b-30 b-b p-l-0">
                    <div class="col-md-6">
                        <h2 class="box-title m-b-0 p-l-0">Venues</h2>
                    </div>
                    <div class="col-md-6 p-t-5">
                        <a href="/create_venue" class="btn btn-success pull-right"><i class="icon-plus"></i>&nbsp; Add Venue</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped  text-capitalize">
                        <thead>
                            <tr>
                                <th>Ref No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Region</th>
                                <th>Land Line</th>
                                <th style="width: 300px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venues as $venue)
                            <tr>
                                <td>VN-LC-{{str_limit($venue->id)}}</td>
                                <td>{{str_limit($venue->name)}}</td>
                                <td>{{str_limit($venue->email)}}</td>
                                <td>{{str_limit($venue->address)}}</td>
                                <td>{{$venue->region}}</td>
                                <td>{{str_limit($venue->landline)}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="edit_venue/{{$venue->id}}"><i class="icon-pencil"></i>Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" onclick="delete_venue({{$venue->id}})"><i class="icon-trash"></i> Delete</a>&nbsp;&nbsp;
                                    <a class="btn btn-success btn-sm" href="edit_venue/{{$venue->id}}" ><i class="icon-info"></i> View</a>

                                </td> 
                            </tr>
                            @endforeach                                                                                                                                       
                        </tbody>
                    </table>
                    <!-- <div id="venueDetailsModel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                          aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content text-capitalize">
                                 <div class="modal-header">
                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                     </button>
                                     <h4 class="modal-title" id="myModalLabel">Venue Details</h4></div>
                                 <div class="modal-body">
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Name: </span ><span class="venue_details_name"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Email: </span ><span class="venue_details_email"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Address: </span ><span class="venue_details_address"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Land Line: </span ><span class="venue_details_landline"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Fax: </span ><span class="venue_details_fax"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Region: </span ><span class="venue_details_region"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Post Code: </span ><span class="venue_details_post_code"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Website: </span ><span class="venue_details_website"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12">
                                         <span class="venue_details_headings">Contact Name: </span ><span class="venue_details_website"></span>
                                     </p>
                                     <p class="col-md-6 col-xs-12 col-sm-12"><span class="venue_details_headings">Contact Email: </span ><span class="venue_details_contact_email"></span></p>
                                     <p class="col-md-6 col-xs-12 col-sm-12"><span class="venue_details_headings">Contact Land Line: </span ><span class="venue_details_contact_landline"></span></p>
                                     <p class="col-md-6 col-xs-12 col-sm-12"><span class="venue_details_headings">Contact Mobile: </span ><span class="venue_details_contact_mobile"></span></p>
                                     <p class="col-md-6 col-xs-12 col-sm-12"><span class="venue_details_headings">Facilities: </span ><span class="venue_details_contact_facilities"></span></p>
                                     <p class="col-md-6 col-xs-12 col-sm-12"><span class="venue_details_headings">Copy: </span ><span class="venue_details_contact_copy"></span></p>
                                     <p class="col-md-12 col-xs-12 col-sm-12"><span class="venue_details_headings">Notes: </span ><span class="venue_details_contact_notes"></span></p>
 
                                 </div>
                                 <div class="clearfix">
                                     <div class="modal-footer col-md-12">
                                         <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close
                                         </button>
                                     </div>
                                 </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

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
                                        });
                                        function delete_venue(t_id)
                                        {
                                        bootbox.confirm({
                                        title: 'Delete Venue',
                                                message: 'Do you really want to <b>Delete</b> this <b>venue?</b>',
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
                                                document.location.href = "{!! url('delete_venue/" + t_id + "'); !!}";
                                                }
                                                }
                                        });
                                        }
</script>

    @endpush
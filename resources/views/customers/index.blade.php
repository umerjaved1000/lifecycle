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
                        <h2 class="box-title m-b-0 p-l-0">Customers</h2>
                    </div>
                    <div class="col-md-6 p-t-5">
                        <a href="/create_customer" class="btn btn-success pull-right"><i class="icon-plus"></i>&nbsp; Add Customer</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped text-capitalize">
                        <thead>
                            <tr>
                                <th>Ref No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post Code</th>
                                <th>Mobile</th>
                                <th>Date</th>
                                <th style="width: 230px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($customers->count() > 0)
                            @foreach($customers as $customer)

                            <tr>
                                <td>CT-LC-{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{str_limit($customer->email)}}</td>
                                <td>{{$customer->post_code}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->created_at}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="edit_customer/{{$customer->id}}" class=""><i class="icon-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" onclick="delete_customer({{$customer->id}})"><i class="icon-trash"></i> Delete</a>&nbsp;&nbsp;
                                    <a class="btn btn-success btn-sm" href="edit_customer/{{$customer->id}}" ><i class="icon-info"></i> View</a>&nbsp;&nbsp;
                                </td>      
                            </tr>
                            @endforeach   
                            @endif
                        </tbody>
                    </table>
                    <div id="customerDetailsModel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content text-capitalize">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Customer Details</h4></div>
                                <div class="modal-body">
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Name: </span ><span class="customer_details_name"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Email: </span ><span class="customer_details_email"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Land Line: </span ><span class="customer_details_landline"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Mobile: </span ><span class="customer_details_mobile"></span>;
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Fax: </span ><span class="customer_details_fax"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Post Code: </span ><span class="customer_details_post_code"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Website: </span ><span class="customer_details_website"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Discount: </span ><span class="customer_details_discount"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Status: </span ><span class="customer_details_status"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Work Package Number: </span ><span class="customer_details_work_package_number"></span>
                                    </p>
                                    <p class="col-md-6 col-xs-12 col-sm-12">
                                        <span class="customer_details_headings">Marketing Option: </span ><span class="customer_details_work_marketing_option"></span>
                                    </p>
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
                                        function delete_customer(t_id)
                                        {
                                        bootbox.confirm({
                                        title: 'Delete customer',
                                                message: 'Do you really want to <b>Delete</b> this <b>customer?</b>',
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
                                                document.location.href = "{!! url('delete_customer/" + t_id + "'); !!}";
                                                }
                                                }
                                        });
                                        }
                                        function customer_details(name, email, landline,
                                                post_code, mobile, fax, website, status, work_package_number,
                                                discount_rate, marketing_opt){
                                        $('#customerDetailsModel').modal('show');
                                        $('.customer_details_name').html(name);
                                        $('.customer_details_email').html(email);
                                        $('.customer_details_landline').html(landline);
                                        $('.customer_details_mobile').html(mobile);
                                        $('.customer_details_post_code').html(post_code);
                                        $('.customer_details_fax').html(fax);
                                        $('.customer_details_website').html(website);
                                        $('.customer_details_status').html(status);
                                        $('.customer_details_work_marketing_option').html(marketing_opt);
                                        $('.customer_details_work_package_number').html(work_package_number);
                                        $('.customer_details_discount').html(discount_rate);
                                        }

</script>

@endpush
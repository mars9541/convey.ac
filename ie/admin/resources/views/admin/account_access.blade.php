@extends('layouts.master')
@section('css')
<style>
    .login_user:hover{
        cursor: pointer;
    }
    .page-item.active .page-link {
        background-color: #3BC850 !important;
        border-color: #3BC850 !important;
    }
</style>
@endsection
@section('content')
<!-- Start right Content here -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                    <li class="breadcrumb-item active"><a href="#">Account Access</a></li>
                </ol>
            </div>
            <h4 class="page-title">Account Access</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card-body">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#business" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Business</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#HRIS" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">HRIS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#consultants" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Consultants</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#citizens" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Citizens</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="business" role="tabpanel">
                    <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2 ">
                            <select class="form-control bg-emerald text-white float-right" >
                                <option value="30" selected>Stats for 30 days</option>
                                <option value="all">life time stats</option>
                            </select>
                        </div>
                    </div>

                    <table id="business_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">CBR ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">NIs Added</th>
                            <th class="text-center">Introductions Made</th>
                            <th class="text-center">Total Spend</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane p-3" id="HRIS" role="tabpanel">
                    <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2 ">
                            <select class="form-control bg-emerald text-white float-right" >
                                <option value="30" selected>Stats for 30 days</option>
                                <option value="all">life time stats</option>
                            </select>
                        </div>
                    </div>

                    <table id="hris_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">CBR ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Connections Added</th>
                            <th class="text-center">NIS Added</th>
                            <th class="text-center">Introductions Made</th>
                            <th class="text-center">Total Funds Generated</th>
                            <th class="text-center">Manage</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">Order</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane p-3" id="consultants" role="tabpanel">
                    <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2 ">
                            <select class="form-control bg-emerald text-white float-right" >
                                <option value="30" selected>Stats for 30 days</option>
                                <option value="all">life time stats</option>
                            </select>
                        </div>
                    </div>

                    <table id="table_consultant" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">CBR ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Introductions Made</th>
                            <th class="text-center">Total Funds Generated</th>
                            <th class="text-center">Their 20%</th>
                            <th class="text-center">Manage</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane p-3" id="citizens" role="tabpanel">
                    <div class="form-group row">
                        <div class="offset-sm-10 col-sm-2 ">
                            <select class="form-control bg-emerald text-white float-right" >
                                <option value="30" selected>Stats for 30 days</option>
                                <option value="all">life time stats</option>
                            </select>
                        </div>
                    </div>
                    <table id="table_citizens" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">CUR ID</th>
                            <th class="text-center ">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>
</div>
<!-- end row -->

<div id="HrisOrderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Assign them a listing position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hris_id">
                <div class="row col-md-12">
                    <label class="col-md-4" for="orderList">Select Order</label>
                    <select class="col-md-6" id="orderList">

                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-emerald text-white waves-effect" id="save_order_btn">
                    <div class="loading-hide">
                        <span>Save changes</span>
                    </div>
                    <div style="display:none;" class="loading-show">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script>
    $('#business_table').DataTable({
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax:{
            url: "{{ route('get_business') }}",
            method:'post',
            data: function ( d ) {
                d.filter = $('#business select').val();
            },
        },
        columns:[
            {
                name: 'CBR ID',
                data: 'id',
                class: 'text-center cbr_id',

            },
            {
                name: 'Name',
                data: 'ocb_name',
                class: 'login_user',
            },
            {
                name: 'NIs Added',
                data: '',
                class: 'text-center p-2',
            },
            {
                name: 'Introductions Made',
                data: '',
                class: 'text-center p-2',
            },
            {
                name: 'Total Spend',
                data: '',
                class: 'text-center p-2',
            }
        ]
    });

    $('tbody').on('click','.login_user',function(){
        var user_id = $(this).closest('tr').find('.cbr_id').text();
        var url = "{{url('/')}}";
        var country_url = url.replace('admin','');
        window.open(country_url+"login_redirect/"+user_id, "_blank");
    });

    $('#business select').on('change',function(){
        $('#business_table').DataTable().ajax.reload();
    })

    $('#hris_table').DataTable({
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: true,
        autoWidth: false,
        ajax:{
            url: "{{ route('get_hris') }}",
            method:'post',
            data: function ( d ) {
                d.filter = $('#HRIS select').val();
            },
        },
        columns:[
            {
                name: 'CBR ID',
                data: 'id',
                class: 'text-center cbr_id',
            },
            {
                name: 'Name',
                data: 'ocb_name',
                class: 'login_user',
            },
            {
                name: 'Type',
                data: 'hris_type',
                class: 'text-center',
            },
            {
                name: 'Connections Added',
                data: '',
                class: 'text-center ',
            },
            {
                name: 'NIS Added',
                data: '',
                class: 'text-center',
            },
            {
                name: 'Introductions Made',
                data: '',
                class: 'text-center ',
            },
            {
                name: 'Total Funds Generated',
                data: '',
                class: 'text-center ',
            },
            {
                name: 'Manage',
                data: 'Approved_to_list',
                class: 'text-center ',
                render: function (data, type, row) {
                    if(data == '' || data == null)
                        return '';
                    else {
                        if(data == 'Ready')
                            return '<button class="bg-emerald text-white btn-border" onclick="hris_approve(\''+row.id+'\',1)">Approve</button>';
                        else
                            return '<button class="text-dark btn-border no-bg" onclick="hris_approve(\''+row.id+'\',0)">Approved</button>';
                    }
                }
            },
            {
                name: 'STATUS',
                data: 'Approved_to_list',
                class: 'text-center',
                render: function (data, type, row) {
                    if(data == '' || data == null)
                        return 'Not Listed';
                    else
                        return data;
                }
            },
            {
                name: 'Order',
                data: 'hris_order',
                class: 'text-center',
                render: function (data, type, row) {
                    if(row.Approved_to_list == 'Listed'){
                        if(data){
                            return '<a class="text-convey-green" href="javascript:edit_order(\''+row.id+'\')">'+data+'</a>';
                        }else{
                            return '<a class="text-convey-green" href="javascript:edit_order(\''+row.id+'\')">Random</a>';
                        }
                    }

                }
            },
        ]
    });

    $('#HRIS select').on('change',function(){
        $('#hris_table').DataTable().ajax.reload();
    })

    function hris_approve(id,stats)
    {
        $.ajax({
            url:"{{ route('hris_approve') }}",
            method:"POST",
            data: {id:id, stats:stats},
            dataType:"json",
            success:function(data)
            {
                alertify.logPosition("top right");
                alertify.error(data.status);
                $('#hris_table').DataTable().ajax.reload();
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    }

    function edit_order(id)
    {
        $.ajax({
            url:"{{ route('hris_order_list') }}",
            method:"POST",
            data: {id:id},
            dataType:"json",
            success:function(data)
            {
                let option = '';
                let selected = 0;
                for (let i = 1; i < 6; i++) {
                    let disabled = '';

                    data.hris_order.forEach(function (e,index){
                        if(i==e.hris_order)
                            disabled = 'disabled';
                    })
                    if(data.this_order == i){
                        option += '<option value="'+i+'" '+disabled+' selected >'+i+'</option>';
                        selected = 1;
                    }else{
                        option += '<option value="'+i+'" '+disabled+'>'+i+'</option>';
                    }
                }
                if(selected<1)
                    option += '<option value="" selected>Random</option>';
                else
                    option += '<option value="">Random</option>';
                $('#orderList').html(option);

                $('#hris_id').val(id);
                $('#HrisOrderModal').modal('show');

            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    }

    $('#save_order_btn').on('click',function ()
    {
        $('.loading-hide').hide();
        $('.loading-show').show();
        $.ajax({
            url:"{{ route('hris_order_update') }}",
            method:"POST",
            data: {
                id:$('#hris_id').val(),
                hris_order: $('#orderList').val()
            },
            dataType:"json",
            success:function(data)
            {
                $('.loading-hide').show();
                $('.loading-show').hide();
                alertify.logPosition("top right");
                alertify.error(data.status);
                $('#HrisOrderModal').modal('hide');
                $('#hris_table').DataTable().ajax.reload();
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
                $('.loading-hide').show();
                $('.loading-show').hide();
                $('#HrisOrderModal').modal('hide');
            }
        })

    })

    $('#table_consultant').DataTable({
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: true,
        autoWidth: false,
        ajax:{
            url: "{{ route('get_consultants') }}",
            method:'post',
            data: function ( d ) {
                d.filter = $('#consultants select').val();
            },
        },
        columns:[
            {
                name: 'CBR ID',
                data: 'id',
                class: 'text-center cbr_id',
            },
            {
                name: 'Name',
                data: 'ocb_name',
                class: 'login_user',

            },
            {
                name: 'Type',
                data: 'advisors_type',
                class: 'text-center',
                render: function (data, type, row) {
                    if (data == 'writer') {
                        return 'recruiter';
                    } else {
                        return data;
                    }

                }
            },
            {
                name: 'Introductions Made',
                data: '',
                class: 'text-center',
            },
            {
                name: 'Total Funds Generated',
                data: '',
                class: 'text-center',
            },
            {
                name: 'Their 20%',
                data: '',
                class: 'text-center',
            },
            {
                name: 'Manage',
                data: 'Approved_to_list',
                class: 'text-center ',
                render: function (data, type, row) {
                    if (row.advisors_type == null) {
                        return '';
                    } else {
                        if(data == 'Ready')
                            return '<button class="bg-emerald text-white btn-border"  onclick="consultants_approve(\'' + row.id + '\',1)">Approve</button>';
                        else if(data == 'Listed'){
                            return '<button class="text-dark btn-border no-bg " onclick="consultants_approve(\'' + row.id + '\',0)">Approved</button>';
                        }
                    }

                }
            },
            {
                name: 'STATUS',
                data: 'Approved_to_list',
                class: 'text-center',
                render: function (data, type, row) {
                    if(data == '' || data == null)
                        return 'Not Listed';
                    else
                        return data;
                }
            }
        ]
    })

    function consultants_approve(id,stats)
    {
        $.ajax({
            url:"{{ route('consultants_approve') }}",
            method:"POST",
            data: {id:id, stats:stats},
            dataType:"json",
            success:function(data)
            {
                alertify.logPosition("top right");
                alertify.error(data.status);
                $('#table_consultant').DataTable().ajax.reload();
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    }

    $('#consultants select').on('change',function(){
        $('#table_consultant').DataTable().ajax.reload();
    })

    $('#table_citizens').DataTable({
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax:{
            url: "{{ route('get_citizen') }}",
            method:'post',
            data: function ( d ) {
                d.filter = $('#citizens select').val();
            },
        },
        columns:[
            {
                name: 'CBR ID',
                data: 'id',
                class: 'text-center cbr_id',

            },
            {
                name: 'Name',
                data: 'id',
                class: 'login_user',
                render: function (data, type, row) {
                  return row.firstname+' '+row.lastname;
                }
            }
        ]
    });

    $('#citizens select').on('change',function(){
        $('#table_citizens').DataTable().ajax.reload();
    })
</script>
@endsection

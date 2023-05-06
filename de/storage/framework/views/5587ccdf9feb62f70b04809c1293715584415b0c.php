

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(url('hris/home')); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">API Connect</a></li>
                </ol>
            </div>
            <h4 class="page-title">Create an API Connection </h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">
            <div class="card-body color-black-light">
                <?php echo $data; ?>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs m-t-10" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" data-toggle="tab" href="#records" role="tab" id="5_records_tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                            <span class="d-none d-sm-inline-block">Last 5 Records</span>
                        </a>
                    </li>

                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link text-dark" data-toggle="tab" href="#record_errors" role="tab" id="record_errors_tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-record"></i></span>
                            <span class="d-none d-sm-inline-block">API record errors</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active p-3 " id="records" role="tabpanel">
                        <table id="record_history_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                                <tr>
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">API ref</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane p-3 " id="record_errors" role="tabpanel">
                        <table id="record_errors_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                            <tr>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Remove</th>
                                <th class="text-center">View</th>
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
</div>
<!-- end row -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:900px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Record Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">RDB Record Unique ID: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="rdb_record_unique_id" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">Ocb Name: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="ocb_name" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">CBR ID: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="cbr_id" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">HRIS ID: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="hris_id" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">Branch: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="branch" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">National Number: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="national_number" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">DOB: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="dob" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">Record Type: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="record_type" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">Record Date: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="record_date" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline" style="vertical-align:top;">Record Content: </label>
                        <div class="col-md-8 display-inline">
                            <textarea id="record_content" rows="5" name="content" class="form-control" readonly></textarea>

                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline" style="vertical-align:top;">Actual View: </label>
                        <div class="col-md-8 display-inline" id="actual_view">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">Parent ID: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="parent_id" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">Version: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="version" readonly />
                        </div>
                    </div>
                    <div class="col-md-12 m-t-5">
                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">Time Stamp: </label>
                        <div class="col-md-8 display-inline">
                            <input type="text" class="form-control" id="time_stamp" readonly />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-emerald col-sm-2 text-white waves-effect" data-dismiss="modal">Close</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    $('#5_records_tab').on('click',function (){
        $('#record_history_table').DataTable().ajax.reload();
    })
    $('#record_errors_tab').on('click',function (){
        $('#record_errors_table').DataTable().ajax.reload();
    })
    $('#record_history_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "<?php echo e(route('hris.get_api_record_list')); ?>",
            method:'post',
            data:{ }
        },
        columns:[
                {
                    name: 'Date Created',
                    data: 'time_stamp',
                    class: 'text-center p-2',
                },
                {
                    name: 'API ref',
                    data: 'time_stamp',
                    class: 'text-center p-2',
                },
                {
                    name: 'View',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                         return '<a href="javascript:view_record(\''+data+'\')" class="text-dark"><i class="ion-eye"></i></a>';
                    }
                }
                ]
        });

    $('#record_errors_table').DataTable({
        // lengthMenu: true,
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: true,
        info: false,
        autoWidth: false,
        ajax:{
            url: "<?php echo e(route('hris.get_api_record_error_list')); ?>",
            method:'post',
            data:{
                _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:[
            {
                name: 'Date Created',
                data: 'time_stamp',
                class: 'text-center p-2',
            },
            {
                name: 'Remove',
                data: 'id',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    return '<a href="javascript:delete_record(\''+data+'\')" class="text-dark"><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></a> ';
                }
            },
            {
                name: 'View',
                data: 'id',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    return '<a href="javascript:view_record(\''+data+'\')" class="text-dark"><i class="ion-eye"></i></a> ';
                }
            }
        ]
    });

    function view_record(id)
    {
        $.ajax({
            url:"<?php echo e(url('hris/get_api_record_info')); ?>/"+id,
            dataType:"json",
            success:function(html){
                $('#rdb_record_unique_id').val(html.data.id);
                $('#ocb_name').val(html.data.ocb_name);
                $('#cbr_id').val(html.data.CBR_id);
                $('#hris_id').val(html.data.HRIS_id);
                $('#branch').val(html.data.Branch);
                $('#national_number').val(html.data.NI_identity_number);
                $('#dob').val(html.data.DOB);
                $('#record_type').val(html.data.record_type);
                $('#record_date').val(html.data.record_date);
                $('#record_content').val(html.data.RECORD_content);
                $('#actual_view').html(html.data.RECORD_content);
                $('#parent_id').val(html.data.parent_id);
                $('#version').val(html.data.version);
                $('#time_stamp').val(html.data.time_stamp);
                $('#myModal').modal('show');
            }
        })
    }

    function delete_record(id)
    {
        $.ajax({
            url:"<?php echo e(url('hris/del_api_record')); ?>/"+id,
            dataType:"json",
            success:function(html){
                if(html.status == 'success'){
                    alertify.logPosition("top right");
                    alertify.success('Deleted Successfully!');
                    $('#record_errors_table').DataTable().ajax.reload();
                }
            },
            error:function ()
            {
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-hris', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/front/hris/api-connect.blade.php ENDPATH**/ ?>
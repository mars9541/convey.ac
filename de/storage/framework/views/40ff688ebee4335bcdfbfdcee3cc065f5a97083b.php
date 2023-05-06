<?php $__env->startSection('css'); ?>
    <style>
        .ion-edit:hover{
            cursor: pointer;
        }
        .login_user:hover{
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('business/home')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Branches</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Your Branches</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->


    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20 text-center">
                <div class="card-body" style="padding: 13px;">
                    <p class="m-0 color-black-light">If you have multiple locations you can activate our branch manager as a way of tracking search credit usage across your branches.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs m-t-20" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" data-toggle="tab" href="#settings" role="tab" id="settings_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                                <span class="d-none d-sm-inline-block">Settings</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#branches" role="tab" id="branches_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Branches</span>
                            </a>
                        </li>

                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link text-dark" data-toggle="tab" href="#credit_usage" role="tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-record"></i></span>
                                <span class="d-none d-sm-inline-block">Credit Usage</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link text-dark" data-toggle="tab" href="#record_types" role="tab" id="record_type_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Record Templates</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3 bg-custom-grey" id="settings" role="tabpanel">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <div class="col-md-12 display-inline" id="branch_manager_btn">
                                                <label class="col-form-label text-left col-sm-3 color-black-light font-20">Branch Manager</label>
                                                <?php if(Auth::user()->activate_branch_manager == "0"): ?>
                                                    <button type="button" class="btn bg-emerald text-white col-sm-1 waves-effect waves-light" id="branch_manager" data-value="1">
                                                        Activate
                                                    </button>
                                                <?php elseif(Auth::user()->activate_branch_manager == "1"): ?>
                                                    <?php if($branch == true): ?>
                                                        <button type="button" class="btn btn-blue-grey text-white  waves-effect waves-light" id="branch_manager" data-value="0" disabled>
                                                            Deactivate
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn bg-emerald text-white  waves-effect waves-light" id="branch_manager" data-value="0">
                                                            Deactivate
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-12 m-t-30 display-inline">
                                            <span class="col-form-label text-center color-black-light">
                                                Branch manager allows your branches to login to their own account to perform searches, whilst using a shared pool of ‘search credits’ (use with Direct Connection/API Connection/HRIS Connection). Read our guide <a href="javascript:view_guide_detail('branch_manager_of_business')" class="text-convey-green">here.</a>
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <div class="col-md-12 display-inline">
                                                <label class="col-form-label text-left col-sm-3 color-black-light font-20">Branch Level ‘Direct Connect’ </label>
                                                <?php if(Auth::user()->activate_branch_manager == "0"): ?>
                                                    <button type="button" class="btn btn-blue-grey text-white col-sm-1 waves-effect waves-light" disabled>
                                                        Activate
                                                    </button>
                                                <?php elseif(Auth::user()->activate_branch_manager == "1"): ?>
                                                    <?php if(Auth::user()->activate_branch_direct_connect == "0"): ?>
                                                        <button type="button" class="btn bg-emerald text-white col-sm-1 waves-effect waves-light" id="branch_direct_manager" data-value="1">
                                                            Activate
                                                        </button>
                                                    <?php elseif(Auth::user()->activate_branch_direct_connect == "1"): ?>
                                                        <button type="button" class="btn bg-emerald text-white waves-effect waves-light" id="branch_direct_manager" data-value="0">
                                                            Deactivate
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-12 m-t-30 display-inline">
                                                <span class="col-form-label text-center color-black-light">If you are using direct connect, you can activate ‘branch level direct connect’  (if you are using an API connection or a HRIS connection, this won't be required). Read our guide <a href="javascript:view_guide_detail('branch_level_direct_conect_of_business')" class="text-convey-green">here</a>.  </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane p-3 bg-custom-grey" id="branches" role="tabpanel">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <div class="col-md-12 m-t-10">
                                                <h6 class="text-center m-t-10 color-black-light">Add a New Branch</h6>
                                            </div>
                                            <span id="form_result"></span>
                                            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="col-md-12 m-t-30">
                                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="branch">Branch: </label>
                                                    <div class="col-md-9 display-inline">
                                                        <input type="text" class="form-control" name="branch_name" id="branch" />
                                                        <div class="">
                                                            <ul class="parsley-errors-list float-left" id="branch_name_required">
                                                                <li class="parsley-required">This value is required.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-t-15">
                                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline align-top" for="branch_email">Branch Email: </label>
                                                    <div class="col-md-9 display-inline">
                                                        <input type="text" class="form-control" name="branch_email" id="branch_email" />
                                                        <small style="display: none;" id="free_email_error" class="text-danger">
                                                            You cannot use a free email address.
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-t-15 display-inline">
                                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="Internal_identifier">Location ID: </label>
                                                    <div class="col-md-9 display-inline">
                                                        <input type="text" class="form-control" name="internal_identifier" id="Internal_identifier" />
                                                        <div class="">
                                                            <ul class="parsley-errors-list float-left" id="Internal_identifier_required">
                                                                <li class="parsley-required">This value is required.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-t-15 display-inline">
                                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="Branch_Postcode">Branch Postcode: </label>
                                                    <div class="col-md-9 display-inline">
                                                        <input type="text" class="form-control" name="branch_postcode" id="Branch_Postcode" />
                                                        <div class="">
                                                            <ul class="parsley-errors-list float-left" id="Branch_Postcode_required">
                                                                <li class="parsley-required">This value is required.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 m-t-15 display-inline">
                                                    <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="password">Password: </label>
                                                    <div class="col-md-9 display-inline">
                                                        <input type="password" class="form-control" name="password" id="password" />
                                                        <div class="">
                                                            <ul class="parsley-errors-list float-left" id="password_required">
                                                                <li class="parsley-required">This value is required.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="hidden_id" id="hidden_id" value="" />
                                                <?php if(Auth::user()->activate_branch_manager == "0"): ?>
                                                    <div class="col-md-12 m-t-30">
                                                        <button type="button" class="btn btn-blue-grey text-white offset-sm-9 col-sm-2 waves-effect waves-light" disabled>
                                                            Add a Branch
                                                        </button>
                                                    </div>
                                                <?php elseif(Auth::user()->activate_branch_manager == "1"): ?>
                                                    <div class="col-md-12 m-t-30">
                                                        <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light" id="add_branch">
                                                            Add a Branch
                                                        </button>
                                                    </div>
                                                <?php endif; ?>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="text-center m-t-10 color-black-light">Branch Manager</h6>
                                            <div class="col-md-12">
                                                <p class="mb-0 color-black-light">
                                                    <i class="ion-edit"></i>: Edit &nbsp;&nbsp;
                                                    <i class="ion-trash-a"></i>: Remove &nbsp;&nbsp;
                                                </p>
                                            </div>
                                            <table id="branch_list" class="table table-bordered table-striped m-t-20">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Branch</th>
                                                    <th class="text-center">Branch Email</th>
                                                    <th class="text-center">Branch ID</th>
                                                    <th class="text-center">Location ID</th>
                                                    <th class="text-center">Branch Postcode</th>
                                                    <th class="text-center">Password</th>
                                                    <th class="text-center">Manage</th>
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
                        <div class="tab-pane p-3 bg-custom-grey" id="record_types" role="tabpanel">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <div class="card m-b-20" id="create_tem_tab" style="display: none;">
                                        <div class="card-body">
                                            <div class="col-md-12 text-center m-t-20">
                                                If you don't want to use our default record Templates you can add your own here
                                            </div>
                                            <span id="form_result"></span>
                                            <input type="hidden" id="parent_record_id" name="parent_record_id" value="0" />
                                            <form method="post" id="record_type_form" class="form-horizontal" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="id" id="record_type_id">
                                                
                                                <div class="col-md-12 row text-center m-t-30">
                                                    <label class="col-form-label text-left  offset-2" for="record_type">Step 1.Give this record Template a name:</label>
                                                    <input type="text" class="col-md-2" name="record_type" id="record_type" style="margin-left: 1em;"/>
                                                    <label class="col-form-label text-right color-black-light" style="margin-left: 1em;" for="record_type">(<a href="javascript:view_guide_detail('default_record_types')" class="text-convey-green">view our default Templates</a>)</label>
                                                </div>
                                                <div class="test-font-16 text-center m-t-30" id="mode_radio">
                                                    <div class="col-md-12 row">
                                                        <div class="col-form-label text-left  offset-2" >Step 2. Tell us which type of record format you want to use for this new Template:</div>
                                                    </div>

                                                    <div class="col-md-12 row">
                                                        <div class="col-md-3">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="radio" name="type_mode" id="a" checked value="0">
                                                            <label for="a" >Plain Text Template </label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="radio" name="type_mode" id="b" value="1">
                                                            <label for="b">Q&A Template</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="question_div" hidden>
                                                    <div class="col-md-12 row text-center m-t-30">
                                                        <div class="col-form-label text-left offset-2" >Step 3. Add/manage your questions for this record:</div>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <a href="javascript:add_question_info('0')" class="text-convey-green"><i class="fa fa-plus"></i> Click to Add Your Questions Below...</a>
                                                    </div>
                                                    <table id="type_mode_table" class="table table-bordered table-striped m-t-20">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center" width="7%">No</th>
                                                            <th class="text-center" width="5%">#</th>
                                                            <th class="text-center">Question</th>
                                                            <th class="text-center" width="15%">Manage</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn bg-emerald text-white  waves-effect waves-light" id="save_new_record">
                                                        Save New Record Template
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card" id="recordTem_table_tab">
                                        <div class="card-body">
                                            <h6 class="text-center m-t-10 color-black-light">Manage Record Template</h6>
                                            <div class="m-b-10">
                                                <button type="button" class="btn bg-emerald text-white waves-effect waves-light offset-10 col-md-2" id="create_tem_btn">
                                                    Create New Template
                                                </button>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="mb-0 color-black-light">
                                                    <i class="ion-eye"></i>: View &nbsp;&nbsp;
                                                    <i class="ion-edit"></i>: Edit &nbsp;&nbsp;
                                                    <i class="fa fa-unlock"></i>: Visible &nbsp;&nbsp;
                                                    <i class="ion-locked"></i>: Invisible &nbsp;&nbsp;
                                                    <i class="ion-printer"></i>: Print &nbsp;&nbsp;
                                                    <i class="ion-trash-a"></i>: Remove &nbsp;&nbsp;
                                                </p>
                                            </div>
                                            <div class="d-block">
                                                <table id="record_type_table" class="table table-bordered table-striped m-t-20">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center" width="10%">No</th>
                                                        <th class="text-center">Template Name</th>
                                                        <th class="text-center" width="15%">Template Type</th>
                                                        <th class="text-center" width="17%">Manage</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div >
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-3" id="credit_usage" role="tabpanel">
                            <div class="table-rep-plugin">
                                <table id="branch_credits_his" class="table table-bordered table-striped m-t-40">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Branch</th>
                                        <th class="text-center">Location ID</th>
                                        <th class="text-center">Total used in last 12 month</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center p-2">Branch 1</td>
                                        <td class="text-center p-2"></td>
                                        <td class="text-center p-2"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center p-2">Branch 2</td>
                                        <td class="text-center p-2"></td>
                                        <td class="text-center p-2"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center p-2">Branch 3</td>
                                        <td class="text-center p-2"></td>
                                        <td class="text-center p-2"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center p-2">Branch 4</td>
                                        <td class="text-center p-2"></td>
                                        <td class="text-center p-2"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="modal fade bs-example-modal-lg" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="article_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div class="form-group" id="article_detail">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="questionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="current_question_id" />
                    <h5 class="modal-title mt-0" id="questionModalLabel">Question Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="col-md-3 text-right color-black-light" for="question_name" style="padding-top: 7px;">Question Text:</label>
                        <input type="text" class="col-md-8 form-control" name="question_name" id="question_name" />
                    </div>
                    <div class="row mt-3">
                        <label class="text-right col-md-3 color-black-light" for="#" style="padding-top: 7px;">Question Type:</label>
                        <div class="pr-3">
                            <input type="radio" id="normal" name="question_type" value="1" checked>
                            <label for="normal" class="col-form-label text-left color-black-light">Text Reply</label>
                        </div>

                        <div class="pr-3">
                            <input type="radio" id="check" name="question_type" value="2">
                            <label for="check" class="col-form-label text-left color-black-light">Tick Box Reply</label>
                        </div>
                        <div class="pr-3">
                            <input type="radio" id="radio" name="question_type" value="3">
                            <label for="radio" class="col-form-label text-left color-black-light">Radio Button Reply</label>
                        </div>
                        <div class="pr-3">
                            <input type="radio" id="star" name="question_type" value="4">
                            <label for="star" class="col-form-label text-left color-black-light">Star Rate Reply</label>
                        </div>

                    </div>
                    <div class="row" style="display: none;" id="answer_type_section">
                        <div class="col-md-3 text-right">
                            <button type="button" class="btn bg-emerald text-white waves-effect" id="add_input_btn">Add Option</button>
                        </div>
                        <div id="answer_type" >
                        </div>
                        <div class="col-md-1" style="display: none;" id="arrow_icon">
                            <i class="mdi mdi-arrow-up-bold arrow" style="cursor: pointer;"></i>
                            <i class="mdi mdi-arrow-down-bold arrow" style="cursor: pointer;"></i>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_question" class="btn bg-emerald col-sm-4 text-white waves-effect">
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

    <div id="recordViewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="recordTemplateLabel">Record Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="record_template_view">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        <?php if(session('error_msg')): ?>
        // Swal.fire(
        alertify.alert("Direct connect can only be accessed through 'Branch Level Direct Connect' unless you deactivate it below.");
        // )
        <?php endif; ?>

        $('#settings_tab').on('click',function(){
            window.location.href = window.location;
        })

        function view_guide_detail(input){
            $.ajax({
                url:"<?php echo e(route('business.get_guide_temp')); ?>",
                method:"POST",
                data: {
                    item:input,
                },
                dataType:"json",
                success:function(html){
                    $('#article_title').html('')
                    $('#article_detail').html(html);
                    $('.bs-example-modal-lg').modal('show');
                },
                error:function(){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');

                }
            })
        }

        $('#answer_type').summernote({
            height: 100,
            toolbar: false,
            // airMode: true
        })

        $('#branch_list').DataTable({
            // lengthMenu: false,
            searching: false,
            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            autoWidth: false,
            ajax:{
                url: "<?php echo e(route('business.branch_list')); ?>",
                method:'post',
                data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
            },
            columns:[
                {
                    name: 'Branch',
                    data: 'branch_name',
                    class: 'text-center p-2',
                },
                {
                    name: 'Branch Email',
                    data: 'branch_email',
                    class: 'text-center p-2',
                },
                {
                    name: 'Branch ID',
                    data: 'id',
                    class: 'text-center p-2 login_user branch_id',
                },
                {
                    name: 'Location ID',
                    data: 'internal_identifier',

                    class: 'text-center p-2',
                },
                {
                    name: 'Branch Postcode',
                    data: 'branch_postcode',

                    class: 'text-center p-2',
                },
                {
                    name: 'Password',
                    data: 'password',

                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        return '************';

                    }
                },
                {
                    name: 'Manage',
                    data: 'id',

                    class: 'text-center p-2',

                    render: function (data, type, row) {
                        return '<a href="javascript:edit_branch(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> |  ' +
                            '<a href="javascript:delete_branch(\''+data+'\')" class="text-dark" title="Remove"><i class="ion-trash-a"></i></a>';

                    }

                }
            ]
        });

        $('tbody').on('click','.login_user',function(){
            var branch_id = $(this).closest('tr').find('.branch_id').text();
            var url = "<?php echo e(url('/')); ?>";
            window.open(url+"/branch/login_redirect/" + branch_id, "_blank");
        });

        $('#branches_tab').click(function(){
            init_branches();
        })

        $('#branch_credits_his').DataTable({
            // lengthMenu: false,
            searching: false,
            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            autoWidth: false,
            ajax:{
                url: "<?php echo e(route('business.branch_list')); ?>",
                method:'post',
                data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
            },
            columns:[
                {
                    name: 'Branch',
                    data: 'branch_name',

                    class: 'text-center p-2',
                },
                {
                    name: 'Location ID',
                    data: 'internal_identifier',

                    class: 'text-center p-2',
                },
                {
                    name: 'Total used in last 12 month',
                    data: 'credits_his',

                    class: 'text-center p-2',
                }

            ]
        });
        $('#branch_manager').click(function(){
            var value = $(this).data('value');

            $.ajax({
                url: "<?php echo e(route('business.activate_branch_manager')); ?>",
                method: 'post',
                data: {
                    status:value
                },
                success: function(result){
                    window.location.reload();
                }
            })
        })

        $('#branch_direct_manager').click(function(){
            var value = $(this).data('value');

            $.ajax({
                url: "<?php echo e(route('business.activate_branch_direct_manager')); ?>",
                method: 'post',
                data: {
                    status:value
                },
                success: function(result){
                    window.location.reload();
                }
            })
        })

        $('#sample_form').on('submit', function(event){
            var id = $('#hidden_id').val();
            event.preventDefault();

            var error_detect = 0;

            if ($('#free_email_error').css('display') != 'none') {
                error_detect = 1;
            }

            if ($('#branch_email').val() == '') {
                $('input[name=branch_email]').css('box-shadow', '0px 0px 4px red');
                $('input[name=branch_email]').css('margin-bottom', '0px');
                $('#free_email_error').html('Invalid email address.');
                $('#free_email_error').show();
                error_detect = 1;
            }

            if ($('#password').val() < 8) {
                $('#password_error').addClass('filled');
                error_detect = 1;
            } else {
                $('#password_error').removeClass('filled');
            }

            if ($('#branch').val() == '') {
                $('#branch_error').addClass('filled');
                error_detect = 1;
            } else {
                $('#branch_error').removeClass('filled');
            }

            if ($('#Internal_identifier').val() == '') {
                $('#Internal_identifier_error').addClass('filled');
                error_detect = 1;
            } else {
                $('#Internal_identifier_error').removeClass('filled');
            }

            if ($('#Branch_Postcode').val() == '') {
                $('#Branch_Postcode_error').addClass('filled');
                error_detect = 1;
            } else {
                $('#Branch_Postcode_error').removeClass('filled');
            }


            if (error_detect == 1) {
                return false;
            }

            if($('#hidden_id').val() == '')
            {
                $.ajax({
                    url:"<?php echo e(route('business.branch_add')); ?>",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-convey-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            init_branches();
                        }
                        $('#form_result').html(html);
                        setTimeout(function () {
                            $('#form_result').empty();
                        }, 5000);
                    }
                })
            }

            if($('#hidden_id').val() != "")
            {
                $.ajax({
                    url:"<?php echo e(route('business.branch_update')); ?>",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-convey-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            init_branches();
                            $('#add_branch').text('Add a Branch');
                        }
                        $('#form_result').html(html);
                        setTimeout(function () {
                            $('#form_result').empty();
                        }, 5000);
                    }
                });
            }
        });

        $('#branch_email').on('input', function () {
            if ($('#user_type').val() == 'citizen') return false;

            var str = "<?php echo e($freeEmailList); ?>";
            var freeEmails = str.split(',');
            var input_email = $('#branch_email').val();

            for (let i = 0; i < freeEmails.length; i++) {
                if (input_email.indexOf(freeEmails[i]) < 0) {
                    $('input[name=branch_email]').css('box-shadow', '');
                    $('input[name=branch_email]').css('margin-bottom', '');
                    $('#free_email_error').hide();
                    continue;
                } else {
                    $('input[name=branch_email]').css('box-shadow', '0px 0px 4px red');
                    $('input[name=branch_email]').css('margin-bottom', '0px');
                    $('#free_email_error').html('You cannot use a free email address.');
                    $('#free_email_error').show();
                    break;
                }
            }
        })

        $("#branch_email").blur(function () {
            if ($('#free_email_error').css('display') != 'none') {
                return false;
            }

            if ($('#branch_email').val() == '') {
                return false;
            }

            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#branch_email').val())) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "<?php echo e(route('business.validation_email_duplication')); ?>",
                    method: 'post',
                    data: {
                        email: $('#branch_email').val(),
                        branch_id: $('#hidden_id').val()
                    },
                    success: function (result) {
                        if (result.status == false) {

                        } else {
                            $('input[name=branch_email]').css('box-shadow', '0px 0px 4px red');
                            $('input[name=branch_email]').css('margin-bottom', '0px');
                            $('#free_email_error').html('This email already exist.');
                            $('#free_email_error').show();
                            return false;
                        }
                    }
                })

            } else {
                $('input[name=branch_email]').css('box-shadow', '0px 0px 4px red');
                $('input[name=branch_email]').css('margin-bottom', '0px');
                $('#free_email_error').html('Invalid email address.');
                $('#free_email_error').show();
            }
        });

        function init_branches() {
            $('#sample_form')[0].reset();
            $('#hidden_id').val('');
            $('#branch_list').DataTable().ajax.reload();
        }

        function edit_branch(id){
            $('#form_result').html('');
            $.ajax({
                url:"<?php echo e(url('business/get_branch')); ?>/"+id,
                dataType:"json",
                success:function(html){
                    $('#branch').val(html.data.branch_name);
                    $('#branch_email').val(html.data.branch_email);
                    $('#Internal_identifier').val(html.data.internal_identifier);
                    $('#Branch_Postcode').val(html.data.branch_postcode);
                    $('#password').val('********');
                    $('#hidden_id').val(html.data.id);
                    $('#add_branch').text('Save Changes');
                }
            })
        };

        function delete_branch(id){
            $('#form_result').html('');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3bc850",
                cancelButtonColor: "#ec4561",
                confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url:"<?php echo e(url('business/delete_branch')); ?>/"+id,
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            if(data.success)
                            {
                                html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                                $('#sample_form')[0].reset();
                                $('#hidden_id').val('');
                                $('#branch_list').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#form_result').empty();
                            }, 5000);
                        }
                    })

                }
            });

        };
    </script>

    <script>

        /*
           * show question detail modal
           * 0: create, the others: update
        */
        function add_question_info(question_id) {
            if(question_id == 0) {
                $('#questionModal').modal('show');
                $('#question_name').val('');
                $('#current_question_id').val(question_id);
                $('#question_name').select();
                $('#normal').prop('checked',true);
                $('#answer_type_section').hide();
            } else {
                $.ajax({
                    url:"<?php echo e(route('business.get_current_question_info')); ?>",
                    method:"POST",
                    data: {
                        question_id: question_id,
                    },
                    dataType:"json",
                    success:function(html){
                        $('#questionModal').modal('show');
                        $('#question_name').val(html.data.question_name);
                        $('#current_question_id').val(question_id);
                        $('#question_name').select();
                        if(html.data.answer_type==1){
                            $('#normal').prop('checked',true);
                            $('#answer_type_section').hide();
                        }else{
                            if(html.data.answer_type==2){
                                $('#check').prop('checked',true);
                            }
                            if(html.data.answer_type==3){
                                $('#radio').prop('checked',true);
                            }
                            if(html.data.answer_type==4){
                                $('#star').prop('checked',true);
                            }
                            $('#answer_type_section').show();
                            $('#answer_type').next().addClass('col-md-8');
                            $('#answer_type').summernote('code',html.data.answer_text);

                        }

                    },
                    error:function(){
                        alertify.logPosition("top right");
                        alertify.error('Server Error!');
                    }
                })
            }
        }

        $('input[name=question_type]').on('change',function (){
            if($('#normal').prop('checked')==true){
                $('#answer_type_section').hide();
            }
            if($('#radio').prop('checked')==true){
                $('#answer_type_section').show();
                $('#answer_type').next().addClass('col-md-8');
                $('#answer_type').summernote('code', '<p><input type="radio" name="radio"/> Type Option Here... <br></p>');
            }
            if($('#check').prop('checked')==true){
                $('#answer_type_section').show();
                $('#answer_type').next().addClass('col-md-8');
                $('#answer_type').summernote('code', '<p><input type="checkbox"/> Type Option Here... <br></p>');
            }

            if($('#star').prop('checked')==true) {
                $('#answer_type_section').show();
                $('#answer_type').next().addClass('col-md-8');
                $('#answer_type').summernote('code', '<p><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>');
            }
        })

        $('#add_input_btn').on('click',function (){
            if($('#radio').prop('checked')==true){
                $('#answer_type').summernote('code', $('#answer_type').summernote('code')+'<p><input type="radio" name="radio"/> Type Option Here... <br></p>');
            }
            if($('#check').prop('checked')==true){
                $('#answer_type').summernote('code', $('#answer_type').summernote('code')+'<p><input type="checkbox" /> Type Option Here... <br></p>');
            }
        })

        $(document).on('click','p',function (){
            if($('#questionModal').is(':visible')){
                $('.bg-custom-grey').removeClass('bg-custom-grey');
                $(this).addClass('bg-custom-grey');
                $('#arrow_icon').show();
            }
        })
        $('.arrow').on('click',function (){
            if($('#questionModal').is(':visible')){
                var input_array = $('.bg-custom-grey').parent().find('p');
                var selected_input = $('.bg-custom-grey')[0];
                for (i = 0; i < input_array.length; i++){
                    if(input_array[i] == selected_input){
                        var current_index = i;
                    }
                }
                if($(this).hasClass('mdi-arrow-up-bold')){
                    if(current_index > 0){
                        var str = input_array[current_index-1];
                        input_array[current_index-1]= input_array[current_index];
                        input_array[current_index] = str;
                    }
                }
                if($(this).hasClass('mdi-arrow-down-bold')){
                    if(current_index < input_array.length-1){
                        var str = input_array[current_index+1];
                        input_array[current_index+1]= input_array[current_index];
                        input_array[current_index] = str;
                    }
                }
                var ss= input_array;
                $('#answer_type').summernote('code','');
                for (j = 0; j < ss.length; j++){
                    $('#answer_type').summernote('code',$('#answer_type').summernote('code')+ss[j].outerHTML);
                }

            }
        })

        /*
            * save and update question info
         */
        $('#btn_save_question').on('click', function () {
            if($('#question_name').val() == '') {
                alert('Please fill question name.');
                $('#question_name').select();
                return false;
            }
            var answer_text = '';
            var answer_type = 1;
            if($('#normal').prop('checked')==false){
                if($('#questionModal').is(':visible')){
                    $('.bg-custom-grey').removeClass('bg-custom-grey');
                }
                answer_text = $('#answer_type').summernote('code');

                if($('#check').prop('checked')==true)
                    answer_type = 2;
                if($('#radio').prop('checked')==true)
                    answer_type = 3;
                if($('#star').prop('checked')==true)
                    answer_type = 4;
            }
            $('.loading-hide').hide();
            $('.loading-show').show();

            $.ajax({
                url:"<?php echo e(route('business.save_question')); ?>",
                method:"POST",
                data: {
                    question_id: $('#current_question_id').val(),
                    record_type_id: $('#record_type_id').val(),
                    question_name: $('#question_name').val(),
                    answer_type: answer_type,
                    answer_text: answer_text
                },
                dataType:"json",
                success:function(html){
                    $('#current_question_id').val('0');
                    $('#question_name').val('');
                    $('#type_mode_table').DataTable().ajax.reload();

                    $('.loading-hide').show();
                    $('.loading-show').hide();
                    $('#questionModal').modal('hide');
                },
                error:function(){
                    $('.loading-hide').show();
                    $('.loading-show').hide();
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }
            })
        })

        $("input[type=radio]").change(function(){
            //record type mode value
            var type_mode = $(this).val();

            if(type_mode == 0) {
                $('#question_div').attr('hidden', 'hidden');
            } else {
                if($('#record_type').val() == '') {
                    alert('Please assign this template a name:');
                    $('#record_type').select();

                    $('#a').prop('checked',true);

                    return false;
                }
                $('#question_div').removeAttr('hidden');
            }
        });

        $('#create_tem_btn').on('click',function (){
            init_record_type_form();
            $('#save_new_record').text('Save New Record Template');
            $('#create_tem_tab').show();
            $('#recordTem_table_tab').hide();
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#record_logo_image').show();
                    $('#record_logo_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#record_logo").change(function() {
            readURL(this);
        });

        $('#record_type_table').DataTable({
            // lengthMenu: false,
            searching: false,
            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            autoWidth: false,
            ajax:{
                url: "<?php echo e(route('business.record_type_list')); ?>",
                method:'post',
                data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
            },
            columns:[
                {
                    name: 'No',
                    data: 'index',
                    class: 'text-center p-2',
                },
                {
                    name: 'Name',
                    data: 'record_type',
                    class: 'text-center p-2',
                },
                {
                    name: 'Name',
                    data: 'type_mode',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        if(row.type_mode =='0')
                            return 'Plain';
                        else
                            return 'Q & A';
                    }
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        if(row.priority=='1') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:visible_record_type(\''+data+'\',4)" class="text-dark" title="Visible"><i class="fa fa-unlock"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" class="text-dark" title="Print"><i class="ion-printer"></i></a>';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',4)" class="text-dark" title="Visible"><i class="fa fa-unlock"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" class="text-dark" title="Print"><i class="ion-printer"></i></a>';
                            }

                        }
                        else if(row.priority=='2') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',3)" class="text-dark" title="Visible"><i class="fa fa-unlock"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" class="text-dark" title="Print"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" class="text-dark" title="Remove"><i class="ion-trash-a"></i></a>';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',3)" class="text-dark" title="Visible"><i class="fa fa-unlock"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" class="text-dark" title="Print"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" class="text-dark" title="Remove"><i class="ion-trash-a"></i></a>';
                            }

                        }
                        else if(row.priority=='3') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',2)" class="text-dark" title="Invisible"><i class="ion-locked"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" class="text-dark" title="Print"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" class="text-dark" title="Remove"><i class="ion-trash-a"></i></a>';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',2)" class="text-dark" title="Invisible"><i class="ion-locked"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" class="text-dark" title="Print"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" class="text-dark" title="Remove"><i class="ion-trash-a"></i></a>';
                            }

                        }
                        else if(row.priority == '4') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:visible_record_type(\''+data+'\',1)" class="text-dark" title="Invisible"><i class="ion-locked"></i></a> ';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',1)" class="text-dark" title="Invisible"><i class="ion-locked"></i></a> ';
                            }

                        }
                    }
                }
            ]
        });

        $('#type_mode_table').DataTable({
            // lengthMenu: false,
            searching: false,
            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            autoWidth: false,
            ajax:{
                url: "<?php echo e(route('business.record_type_mode_list')); ?>",
                method:'post',
                data:{
                    parent_id: function() { return $('#parent_record_id').val() },
                }
            },
            columns:[
                {
                    name: 'No',
                    data: 'index',
                    class: 'text-center p-2',

                },
                {
                    name: 'Index',
                    data: 'id',
                    class: 'text-center pl-0 pr-0 pt-2',
                    render: function (data, type, row) {
                        return '<a href="javascript:order_up(\''+data+'\')" class="text-dark edit" ><i class="mdi mdi-arrow-up-bold arrow" style="cursor: pointer;"></i></a> | ' +
                            '<a href="javascript:order_down(\''+data+'\')" class="text-dark"><i class="mdi mdi-arrow-down-bold arrow" style="cursor: pointer;"></i></a>';
                    }
                },
                {
                    name: 'Question',
                    data: 'question_name',
                    class: 'text-center p-2',
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        if(row.priority=='1')
                            return '';
                        else
                            return '<a href="javascript:add_question_info(\''+data+'\')" class="text-dark edit" ><i class="ion-edit"></i></a> | ' +
                                '<a href="javascript:delete_question(\''+data+'\')" class="text-dark"><i class="ion-trash-a"></i></a>';
                    }
                }
            ]
        });

        function order_up(id){
            $.ajax({
                url:"<?php echo e(url('business/order_up')); ?>/"+id,
                dataType:"json",
                success:function(data){
                    if(data.success)
                    {
                        $('#type_mode_table').DataTable().ajax.reload();
                    }
                },
                error:function (){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }
            })
        }
        function order_down(id){
            $.ajax({
                url:"<?php echo e(url('business/order_down')); ?>/"+id,
                dataType:"json",
                success:function(data){
                    if(data.success)
                    {
                        $('#type_mode_table').DataTable().ajax.reload();
                    }
                },
                error:function (){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }
            })
        }

        function delete_question(id){
            $('#form_result').html('');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3bc850",
                cancelButtonColor: "#ec4561",
                confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url:"<?php echo e(url('business/delete_question')); ?>/"+id,
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            if(data.success)
                            {
                                html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                                $('#type_mode_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#form_result').empty();
                            }, 5000);
                        }
                    })

                }
            });
        }

        $('#record_type_tab').click(function(){
            $('#create_tem_tab').hide();
            $('#recordTem_table_tab').show();
            $('#record_type_table').DataTable().ajax.reload();
        })

        $('#record_type_form').on('submit', function(event){
            event.preventDefault();

            if($('#type_mode_table tr').eq(1).children('td').length == 1 && $('input[name=type_mode]:checked').val() == 1) {
                alert('There is no question you added. Please add your question. ');
                return false;
            }

            if($('#record_type_id').val() == '')
            {
                $.ajax({
                    url:"<?php echo e(route('business.record_type_add')); ?>",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-convey-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            init_record_type_form();
                        }

                        $('#form_result').html(html);
                        setTimeout(function () {
                            $('#form_result').empty();
                        }, 5000);
                    }
                })
            }

            if($('#record_type_id').val() != "")
            {
                $.ajax({
                    url: "<?php echo e(route('business.record_type_update')); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        var html = '';

                        if (data.errors) {
                            html = '<div class="alert alert-convey-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }

                        if (data.success) {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            init_record_type_form();
                        }

                        $('#form_result').html(html);
                        setTimeout(function () {
                            $('#form_result').empty();
                        }, 5000);
                    }
                });
            }
            // get_record_types();
        });

        function init_record_type_form() {
            $('#record_type_form')[0].reset();

            $('#record_type_id').val('');
            $('#record_type_table').DataTable().ajax.reload();

            $('#parent_record_id').val('0');
            $('#type_mode_table').DataTable().ajax.reload();
            $('#question_div').removeAttr('hidden');
            $('#question_div').attr('hidden', 'hidden');
            $('#a').prop('checked', true);
            $('#record_logo_image').hide();
            $('#create_tem_tab').hide();
            $('#recordTem_table_tab').show();
        }

        function edit_record_type(id) {
            $('#form_result').html('');
            $('#parent_record_id').val(id);

            $.ajax({
                url:"<?php echo e(url('business/get_record_type')); ?>/"+id,
                dataType:"json",
                success:function(html){

                    $('#record_type').val(html.data.record_type);
                    $('#record_type_id').val(html.data.id);
                    $('#create_tem_tab').show();
                    $('#recordTem_table_tab').hide();
                    $('#save_new_record').text('Save Changes');

                    if(html.data.record_logo) {
                        $('#record_logo_image').show();
                        var url = "<?php echo e(url('/public/upload')); ?>/";
                        $('#record_logo_image').attr('src', url+html.data.record_logo);
                    } else {
                        $('#record_logo_image').hide();
                    }

                    /*
                        * Check radio button and set hidden attribute of type mode table when type_mode is plain
                        * 0:plain, 1:QA
                    */

                    if(html.data.type_mode == 0) {
                        $('#a').prop('checked',true);
                        $('#question_div').attr('hidden', 'hidden');
                    } else {
                        $('#b').prop('checked',true);
                        $('#question_div').removeAttr('hidden');
                        $('#type_mode_table').DataTable().ajax.reload();
                    }
                }
            })
        }

        function visible_record_type(id,priority){
            $.ajax({
                url:"<?php echo e(route('business.visible_record_type')); ?>",
                method: 'post',
                data:{
                    id: id,
                    priority,priority
                },
                dataType:"json",
                success:function(data){
                    var html = '';
                    if(data.success)
                    {
                        html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                        $('#record_type_form')[0].reset();
                        $('#record_type_id').val('');
                        $('#record_type_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                    setTimeout(function () {
                        $('#form_result').empty();
                    }, 5000);
                }
            })
        }

        function delete_record_type(id){
            $('#form_result').html('');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3bc850",
                cancelButtonColor: "#ec4561",
                confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url:"<?php echo e(url('business/delete_record_type')); ?>/"+id,
                        dataType:"json",
                        success:function(data){
                            var html = '';
                            if(data.success)
                            {
                                html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                                $('#record_type_form')[0].reset();
                                $('#record_type_id').val('');
                                $('#record_type_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                            setTimeout(function () {
                                $('#form_result').empty();
                            }, 5000);
                        }
                    })
                }
            });
        }

        function view_record_type(id)
        {
            $.ajax({
                url:"<?php echo e(route('business.get_qa_type_info')); ?>",
                method:"POST",
                data:
                    {
                        parent_id: id
                    },
                dataType:"json",
                success:function(html)
                {
                    $('#record_template_view').html(html.data);
                    $('#recordTemplateLabel').text(html.record_title);
                    $('#recordViewModal').modal('show');
                }
            })
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-business', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/front/business/branches.blade.php ENDPATH**/ ?>
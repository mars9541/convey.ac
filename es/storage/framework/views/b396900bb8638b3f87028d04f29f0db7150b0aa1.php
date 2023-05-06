<?php $__env->startSection('css'); ?>
<style>
    .ion-edit:hover{
        cursor: pointer;
    }

    .display-block {
        display: block!important;
    }

    .display-none {
        display: none!important;
    }
    label {
        font-weight: 400 !important;
    }
    .marked{
        color: orange;
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
                    <li class="breadcrumb-item active"><a href="#">Direct Connect</a></li>
                </ol>
            </div>
            <h4 class="page-title">Create Records using DIRECT CONNECT</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div id="form_overlay">
            <div class="form_overlay_message">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo" height="50"></a>
                <div style="height: 15px;"></div>
                <span class="m-t-25">Loading Now. Please Wait.</span>
            </div>
        </div>

        <div class="card m-b-20 text-center">
            <div class="card-body" style="padding: 13px;">
                <p class="m-0 color-black-light">
                    If you want a simple way to create and then manage your employee records you can do so from here.
                </p>
            </div>
        </div>

        <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs m-t-10" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#add_new_record" role="tab" id="record_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-edit"></i></span>
                        <span class="d-none d-sm-inline-block">Add New Record</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#tab_employees" role="tab" id="employee_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Employees</span>
                    </a>
                </li>

                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-dark" data-toggle="tab" href="#tab_record_types" id="record_type_tab" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-copy"></i></span>
                        <span class="d-none d-sm-inline-block">Record Templates</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-dark" data-toggle="tab" href="#record_history" role="tab" id="record_history_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-history"></i></span>
                        <span class="d-none d-sm-inline-block">Record History</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="add_new_record" role="tabpanel">
                    <div class="table-rep-plugin">
                        <span id="n_form_result"></span>
                        <form id="new_record_form">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  m-t-30 row">
                                <input type="hidden" name="history_id" id="history_id" value="">
                                <label class="col-lg-2 col-form-label text-right color-black-light">Employee:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" id="employees" name="employee_id">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-right color-black-light">Record Template:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" id="record_types" name="record_type_id" required>

                                    </select>
                                    <div class="">
                                        <ul class="parsley-errors-list float-left" id="record_types_required">
                                            <li class="parsley-required">This value is required.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text_answer" class="col-lg-2 text-right col-form-label color-black-light">Comments:</label>
                                <div class="col-lg-10">
                                    <textarea id="text_answer"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-lg-2 col-sm-12 col-lg-10">
                                    <button class="btn bg-secondary col-12 col-sm-4 col-md-3 col-lg-2 text-white waves-effect waves-light" id="save_draft">
                                        <i class="fa fa-pencil-square-o"></i> Save as Draft
                                    </button>
                                    <button class="btn bg-rich-red offset-sm-0 offset-md-2 offset-lg-3 col-12 col-sm-4 col-md-3 col-lg-2 text-white waves-effect waves-light"
                                            id="clear_exit"><i class="fa fa-refresh"></i> Clear and Exit
                                    </button>
                                    <button type="submit" class="btn bg-emerald col-12 col-sm-4 col-md-3 col-lg-2 text-white waves-effect waves-light float-right">
                                        <i class="fa fa-save"></i> Add to DATABANK
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="tab-pane p-3 bg-custom-grey" id="tab_employees" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <div class="card m-b-20">
                                <div class="card-body">
                                    <div class="col-md-12 m-t-10">
                                        <h6 class="text-center m-t-30 color-black-light">Add a New Employee</h6>
                                    </div>
                                    <span id="e_form_result"></span>
                                    <form method="post" id="employee_form" class="form-horizontal" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" id="employee_id">
                                    <div class="col-md-12 m-t-30">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="first_name">First Name: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="first_name" id="first_name" />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="fname_required">
                                                    <li class="parsley-required">This value is required.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="second_name">Second Name: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="second_name" id="second_name" />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="sname_required">
                                                    <li class="parsley-required">This value is required.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light" for="dob">Date of Birth: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="date" max="9999-12-31" class="form-control" placeholder="mm/dd/yyyy"  name="date_of_birth" id="dob">
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="dob_required">
                                                    <li class="parsley-required">This value is required.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="ni">NIF: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="NI_Insurance_Number" id="ni" />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left"  id="space_error">
                                                    <li class="parsley-required">This value is not allowed - "space characters".</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 display-inline">
                                        <label class="col-form-label offset-sm-2 p-3 color-black-light display-inline">
                                            Date of birth and NIF can not be edited.
                                        </label>
                                    </div>
                                    <div class="col-md-12 m-t-30">
                                        <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light" id="new_employee">
                                            Create New Employee
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center m-t-10 color-black-light">Manage Existing Employees</h6>
                                    <div class="col-md-12">
                                        <p class="mb-0 color-black-light">
                                            <i class="ion-edit"></i>: Edit &nbsp;&nbsp;
                                            <i class="ion-trash-a"></i>: Remove &nbsp;&nbsp;
                                        </p>
                                    </div>
                                    <table id="employees_table" class="table table-bordered table-striped m-t-20">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="60%">Name</th>
                                            <th class="text-center" width="50%">Manage</th>
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
                <div class="tab-pane p-3 bg-custom-grey" id="tab_record_types" role="tabpanel">
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
                                            <label class="col-form-label text-left  offset-2" for="record_type">
                                                Step 1.Give this record Template a name:
                                            </label>
                                            <input type="text" class="col-md-2" name="record_type" id="record_type" style="margin-left: 1em;"/>
                                            <label class="col-form-label text-right color-black-light" style="margin-left: 1em;" for="record_type">
                                                (<a href="javascript:view_guide_detail('default_record_types')" class="text-convey-green">view our default Templates</a>)
                                            </label>
                                        </div>
                                        <div class="test-font-16 text-center m-t-30" id="mode_radio">
                                            <div class="col-md-12 row">
                                                <div class="col-form-label text-left offset-2" >
                                                    Step 2. Tell us which type of record format you want to use for this new Template:
                                                </div>
                                            </div>

                                            <div class="col-md-12 row">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="type_mode" id="a" checked value="0">
                                                    <label for="a">Plain Text Template </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="type_mode" id="b" value="1">
                                                    <label for="b">Q&A Template</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="question_div" hidden>
                                            <div class="col-md-12 row text-center m-t-30">
                                                <div class="col-form-label text-left offset-2" >
                                                    Step 3. Add/manage your questions for this record:
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <a href="javascript:add_question_info('0')" class="text-convey-green">
                                                    <i class="fa fa-plus"></i> Click to Add Your Questions Below...
                                                </a>
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
                                            <button type="submit" class="btn bg-emerald text-white waves-effect waves-light" id="save_new_record">
                                                Save New Record Template
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card" id="recordTem_table_tab">
                                <div class="card-body">
                                    <h6 class="text-center m-t-10 color-black-light">Manage Record Template</h6>
                                    <div class="row">
                                        <div class="col-md-10 pl-5">

                                        </div>
                                        <div class="col-md-2 text-right">
                                            <button type="button" class="btn bg-emerald text-white waves-effect waves-light" id="create_tem_btn">
                                                Create New Template
                                            </button>
                                        </div>

                                    </div>
                                    <div class="d-block">
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
                <div class="tab-pane p-3" id="record_history" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 float-right pr-0">
                            <select class="form-control bg-emerald text-white float-right" id="filter_employee">
                                <option value="all">All Employees</option>
                            </select>
                        </div>

                        
                        <table id="record_history_table" class="table table-bordered table-striped m-t-40 w-100">
                            <thead>
                            <tr>
                                <th class="text-center">Record Template</th>
                                <th class="text-center">Employee</th>
                                <th class="text-center">Date Created</th>
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

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Record Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p id="record_history_content"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-emerald col-sm-2 text-white waves-effect" data-dismiss="modal">Close</button>

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
var m_question_count = 0;
var m_answer_count = 0;
var m_current_record_type = 0;
var m_draft_flag = 0;

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


    $(document).ready(function(){
        first_load();
    })

    function first_load() {
        $('#form_overlay').delay(350).fadeIn('slow');

        $.ajax({
            url: "<?php echo e(route('business.get_employees')); ?>",
            method: "POST",
            dataType: "json",
            success: function (html) {
                $('#employees').empty();
                if (html.data.length > 0) {
                    var options = '';

                    for (var i = 0; i < html.data.length; i++) {
                        options += '<option value=' + html.data[i].id + '>' + html.data[i].first_name + ' ' + html.data[i].second_name + '</option>'
                    }

                    $('#employees').append(options);
                    $('#filter_employee').append(options);

                }

                $.ajax({
                    url: "<?php echo e(route('business.get_record_types')); ?>",
                    method: "POST",
                    dataType: "json",
                    success: function (html) {
                        if (html.data.length > 0) {
                            $('#record_types').empty();
                            var options = '<option value=0></option>';
                            for (var i = 0; i < html.data.length; i++) {
                                options += '<option value=' + html.data[i].id + ' record_type=' + html.data[i].type_mode + '>' + html.data[i].record_type + '</option>'
                            }
                            $('#record_types').append(options);
                        }

                        $.ajax({
                            url: "<?php echo e(route('business.get_draft_data')); ?>",
                            method: "POST",
                            dataType: "json",
                            success: function (res) {
                                if (res.length > 0) {
                                    var data = res[0];
                                    m_draft_flag = 1;
                                    $('#employees').val(data.employee_id).change();
                                    $('#employees').attr('disabled', 'disabled');
                                    $('#record_types').val(data.record_type_id).change();
                                    $('#record_types').attr('disabled', 'disabled');

                                    setTimeout(function () {
                                        $('#text_answer').summernote('code', data.RECORD_content);
                                        var text_content = $('#text_answer').summernote('code');
                                        var search_string_question = 'contenteditable="false"';

                                        m_question_count = text_content.split(search_string_question).length - 1;
                                        m_answer_count = (text_content.match(/>A:/g) || []).length;
                                    }, 500);

                                    var create_date = new Date(data.created_at),
                                        month = '' + (create_date.getMonth() + 1),
                                        day = '' + create_date.getDate(),
                                        year = create_date.getFullYear();
                                    var create_time = data.created_at.split(" ")[1];

                                    if (month.length < 2) {
                                        month = '0' + month;
                                    }

                                    if (day.length < 2) {
                                        day = '0' + day;
                                    }

                                    var created_date = 'Draft record last saved: ' + month + '/' + day + '/' + year + " " + create_time;
                                    var html = '<div class="alert alert-convey-danger">' + created_date + '</div>';

                                    $('#n_form_result').html(html);
                                } else {
                                    var record_type = $('#record_types option:selected').attr('record_type');
                                    /*
                                        * when record type is plain, fill the comments with blank
                                        * when record type is QA, fill the comments with QA data from ajax request.
                                     */
                                    if (record_type == 0) {
                                        $('#text_answer').summernote('code', '<p><br></p>');
                                    } else if (record_type == 1) {
                                        $.ajax({
                                            url: "<?php echo e(route('business.get_qa_type_info')); ?>",
                                            method: "POST",
                                            data:
                                                {
                                                    parent_id: $('#record_types').val()
                                                },
                                            dataType: "json",
                                            success: function (html) {
                                                $('#text_answer').summernote('code', html.data);
                                            }
                                        })
                                    }
                                }

                                $('#form_overlay').delay(350).fadeOut('slow');
                            }
                        })
                    }
                })
            }
        })
    }

    $('#filter_employee').on('change',function(){
        $('#record_history_table').DataTable().ajax.reload();
    })

    $('#record_tab').on('click', function(){
        m_draft_flag = 0;
        // reload_employees();
        // get_record_types();
        draft_entry();
        $('#n_form_result').empty();
        $('#history_id').val('');
        document.getElementById("save_draft").style.visibility = "visible";
    })

    $('#record_types').on('change', function () {
        var record_type = $('#record_types option:selected').attr('record_type');
        /*
            * when record type is plain, fill the comments with blank
            * when record type is QA, fill the comments with QA data from ajax request.
         */

        if(m_draft_flag == 1) {
            return false;
        }

        if($('#history_id').val() == '') {
            if($('#record_types').val() == 0) {
                $('#text_answer').summernote('code', '<p><br></p>');
            } else {
                $('#record_types_required').removeClass('filled');
            }

            if(record_type == 0) {
                $('#text_answer').summernote('code', '<p><br></p>');
            } else if(record_type == 1) {
                m_current_record_type = 1;

                $.ajax({
                    url:"<?php echo e(route('business.get_qa_type_info')); ?>",
                    method:"POST",
                    data:
                        {
                            parent_id: $('#record_types').val()
                        },
                    dataType:"json",
                    success:function(html)
                    {
                        $('#text_answer').summernote('code', html.data);

                        var text_content = $('#text_answer').summernote('code');
                        var search_string_question = 'contenteditable="false"';

                        m_question_count = text_content.split(search_string_question).length - 1;
                        m_answer_count = (text_content.match(/>A:/g) || []).length;
                    }
                })
            }
        } else {
            var text_content = $('#text_answer').summernote('code');
            var search_string_question = 'contenteditable="false"';

            m_question_count = text_content.split(search_string_question).length - 1;
            m_answer_count = (text_content.match(/>A:/g) || []).length;
        }
    })

    $('#text_answer').summernote({
        height: 200,
        toolbar: false,
        // airMode: true
        callbacks: {
            onKeyup: function(e) {
                var text_content = $('#text_answer').summernote('code');

                var search_string = 'contenteditable="false"';
                var question_count = text_content.split(search_string).length - 1;
                var answer_count = (text_content.match(/>A:/g) || []).length;

                if(e.which == 8 || e.which == 46) {
                    if(m_current_record_type == 1 && question_count != m_question_count) {
                        $('#text_answer').summernote('undo');
                    }

                    if(m_current_record_type == 1 && answer_count != m_answer_count) {
                        $('#text_answer').summernote('undo');
                    }
                }

                setTimeout(function(){

                },200);
            }
        }
    })

    function reload_employees(){
        $.ajax({
            url:"<?php echo e(route('business.get_employees')); ?>",
            method:"POST",
            dataType:"json",
            success:function(html)
            {
                $('#employees').empty();
                $('#filter_employee').empty();
                if(html.data.length > 0)
                {
                    var options = '';

                    for (var i = 0; i < html.data.length; i++) {
                        options += '<option value='+html.data[i].id+'>'+html.data[i].first_name+' '+html.data[i].second_name+'</option>'
                    }

                    $('#employees').append(options);
                    $('#filter_employee').append('<option value="all">All Employees</option>');
                    $('#filter_employee').append(options);
                }
            }
        })
    }

    function get_record_types(){
        $.ajax({
            url:"<?php echo e(route('business.get_record_types')); ?>",
            method:"POST",
            dataType:"json",
            success:function(html)
            {
                if(html.data.length>0)
                {
                    $('#record_types').empty();
                    var options = '<option value=0></option>';
                    for (var i = 0; i < html.data.length; i++) {
                        options +='<option value='+html.data[i].id + ' record_type=' + html.data[i].type_mode +'>' + html.data[i].record_type + '</option>'
                    }
                    $('#record_types').append(options);
                }
            }
        })
    }

    function draft_entry()
    {
        $.ajax({
            url:"<?php echo e(route('business.get_draft_data')); ?>",
            method:"POST",
            dataType:"json",
            success:function(res)
            {
                if(res.length > 0) {
                    var data = res[0];
                    m_draft_flag = 1;
                    $('#employees').val(data.employee_id).change();
                    $('#record_types').val(data.record_type_id).change();
                    setTimeout(function(){
                        $('#text_answer').summernote('code', data.RECORD_content);
                        var text_content = $('#text_answer').summernote('code');
                        var search_string_question = 'contenteditable="false"';

                        m_question_count = text_content.split(search_string_question).length - 1;
                        m_answer_count = (text_content.match(/>A:/g) || []).length;
                    }, 500);


                    var create_date = new Date(data.created_at),
                        month = '' + (create_date.getMonth() + 1),
                        day = '' + create_date.getDate(),
                        year = create_date.getFullYear();
                    var create_time = data.created_at.split(" ")[1];

                    if (month.length < 2) {
                        month = '0' + month;
                    }

                    if (day.length < 2) {
                        day = '0' + day;
                    }

                    var created_date = 'Draft record last saved: ' + day + '/' + month + '/' + year + " " + create_time;
                    var html = '<div class="alert alert-convey-danger">' + created_date + '</div>';
                    $('#n_form_result').html(html);
                } else {
                    var record_type = $('#record_types option:selected').attr('record_type');
                    /*
                        * when record type is plain, fill the comments with blank
                        * when record type is QA, fill the comments with QA data from ajax request.
                     */
                    if(record_type == 0) {
                        $('#text_answer').summernote('code', '<p><br></p>');
                    } else if(record_type == 1) {
                        $.ajax({
                            url:"<?php echo e(route('business.get_qa_type_info')); ?>",
                            method:"POST",
                            data:
                                {
                                    parent_id: $('#record_types').val()
                                },
                            dataType:"json",
                            success:function(html)
                            {
                                $('#text_answer').summernote('code', html.data);
                            }
                        })
                    }
                }
            }
        })
    }

    $('#new_record_form').on('submit', function(event) {
        event.preventDefault();

        var error_detect = 0;
        var record_type = $('#record_types option:selected').attr('record_type');

        $('#record_types').removeAttr('disabled');
        $('#employees').removeAttr('disabled');

        if($('#record_types').val() == 0) {
            $('#record_types_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#record_types_required').removeClass('filled');
        }

        if(error_detect == 1) {
            return false;
        }

        var formdata = new FormData(this);
        var text_answer_code = $('#text_answer').summernote('code');
        formdata.append('RECORD_content', text_answer_code);

        if(record_type == 1) {
            var text_content = $('#text_answer').summernote('code');
            var search_string = 'contenteditable="false"';
            var question_count = text_content.split(search_string).length - 1;
            var answer_count = (text_content.match(/>A:/g) || []).length;

            if(m_question_count != question_count) {
                var deleted_questions_count = m_question_count - question_count;

                if(deleted_questions_count > 1) {
                    alert('You deleted ' + deleted_questions_count + ' questions, please press the \'red button\' below to clear the screen, then reselect the record template and start again.');
                } else {
                    alert('You deleted one question, please press the \'red button\' below to clear the screen, then reselect the record template and start again.');
                }

                return false;
            }

            if(m_answer_count != answer_count) {
                alert('Please complete all answers. Thanks.');
                return false;
            }

            if(text_answer_code.match(/>A:\<\/p>/g)) {
                alert('Please complete all answers. Thanks.');
                return false;
            }
        } else {
            var condition_flag = '<p data-nsfw-filter-status="swf"><br></p>';
            var condition_flag1 = '<p><br></p>';

            if(condition_flag == text_answer_code || condition_flag1 == text_answer_code) {
                console.log('Please fill the comments');
                return false;
            }
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You want to save this record, once created records cannot be edited or deleted.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, I am sure.",
            cancelButtonText: "No, continue editing."
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:"<?php echo e(route('business.record_add')); ?>",
                    method:"POST",
                    data: formdata,
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

                            return false;
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            $('#new_record_form')[0].reset();
                            $('#text_answer').summernote('code', '<p><br></p>');
                            m_draft_flag = 0;
                        }

                        $('#n_form_result').html(html);
                        setTimeout(function () {
                            $('#n_form_result').empty();
                        }, 5000);
                        $('#history_id').val('');
                        $('#save_draft').removeAttr('hidden');
                        draft_entry();
                        document.getElementById("save_draft").style.visibility = "visible";
                    }
                })

            }
        });



    })

    $('#clear_exit').on('click', function () {
        $('#record_types').val(0);
        $('#text_answer').summernote('code', '<p><br></p>');
        $('#record_types').removeAttr('disabled');
        $('#employees').removeAttr('disabled');
        $('#n_form_result').empty();
        $('#history_id').val('');
        m_draft_flag = 0;
        document.getElementById("save_draft").style.visibility = "visible";

        $.ajax({
            url:"<?php echo e(route('business.clear_draft')); ?>",
            method:"POST",
            dataType:"json",
            success:function(data)
            {

            }
        })

        return false;
    })

    $('#save_draft').on('click', function() {
        if($('#text_answer').summernote('code') == '<p><br></p>') {
            return false;
        }

        $.ajax({
            url: "<?php echo e(route('business.save_draft')); ?>",
            method: "POST",
            data: {
                    employee_id : $('#employees').val(),
                    record_type_id : $('#record_types').val(),
                    RECORD_content : $('#text_answer').summernote('code')
            },
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
                    // $('#new_record_form')[0].reset();
                }

                $('#n_form_result').html(html);
                setTimeout(function () {
                    $('#n_form_result').empty();
                }, 5000);
                $('#history_id').val('');
            }
        })

        return false;
    })

    $(document).on('click', 'input[type=checkbox]', function () {
        var checkbox_name = this.name;

        if($(this).prop('checked') == true) {
            $(this).attr("checked", "checked");
        } else {
            $(this).removeAttr('checked');
        }
    })

    $(document).on('click', 'input[type=radio]', function () {
        var radio_name = this.name;
        $('input[name='+ radio_name + ']').each(function() {
            $(this).removeAttr('checked');
        })

        if($(this).prop('checked') == true) {
            $(this).attr("checked", "checked");
        }
    })

    $(document).on('click', 'p>span', function () {
        var star_array = $(this).parent().find('span');
        var class_name = $(this).attr('class');
        var current_star = $(this)[0];
        $('p>span').each(function() {
            if($(this).attr('class') == class_name) {
                $(this).removeClass('marked');    
            }
            
        })

        for (var i = 0; i < star_array.length; i++) {
            if(star_array[i] == current_star) {
                var current_star_index = i;
            }
        }

        for (var j = 0; j < star_array.length; j++) {
            if(j<current_star_index+1) {
                if(star_array[j].classList.value == "fa fa-star") {
                    $(star_array[j]).addClass("marked");
                }
            }
        }
    })
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
                    if(html.data.answer_type == 1) {
                        $('#normal').prop('checked', true);
                        $('#answer_type_section').hide();
                    } else {
                        if(html.data.answer_type == 2){
                            $('#check').prop('checked', true);
                        }

                        if(html.data.answer_type == 3){
                            $('#radio').prop('checked', true);
                        }

                        if(html.data.answer_type == 4){
                            $('#star').prop('checked', true);
                        }

                        $('#answer_type_section').show();
                        $('#answer_type').next().addClass('col-md-8');
                        $('#answer_type').summernote('code', html.data.answer_text);
                    }

                },
                error:function(){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }
            })
        }
    }

    $('input[name=question_type]').on('change', function () {
        if($('#normal').prop('checked') == true) {
            $('#answer_type_section').hide();
        }
        if($('#radio').prop('checked') == true) {
            $('#answer_type_section').show();
            $('#answer_type').next().addClass('col-md-8');
            $('#answer_type').summernote('code', '<p><input type="radio" name="radio"/> Type Option Here... <br></p>');
            $('#add_input_btn').show();
        }
        if($('#check').prop('checked') == true) {
            $('#answer_type_section').show();
            $('#answer_type').next().addClass('col-md-8');
            $('#answer_type').summernote('code', '<p><input type="checkbox" name="check"/> Type Option Here... <br></p>');
            $('#add_input_btn').show();
        }

        if($('#star').prop('checked') == true) {
            $('#answer_type_section').show();
            $('#answer_type').next().addClass('col-md-8');
            $('#answer_type').summernote('code', '<p><span class="fa fa-star"></span>' +
                                                    '<span class="fa fa-star"></span>' +
                                                    '<span class="fa fa-star"></span>' +
                                                    '<span class="fa fa-star"></span>' +
                                                    '<span class="fa fa-star"></span></p>');
            $('#add_input_btn').hide();
            $('#arrow_icon').hide();
        }
    })

    $('#add_input_btn').on('click', function () {
        if($('#radio').prop('checked') == true) {
            var code_info = $('#answer_type').summernote('code');
            var input_name = $(code_info).find('input')[0].name;
            $('#answer_type').summernote('code', $('#answer_type').summernote('code')+'<p><input type="radio" name="' + input_name +'"/> Type Option Here... <br></p>');
        }

        if($('#check').prop('checked') == true) {
            var code_info = $('#answer_type').summernote('code');
            var input_name = $(code_info).find('input')[0].name;
            $('#answer_type').summernote('code', $('#answer_type').summernote('code')+'<p><input type="checkbox" name="' + input_name +'" /> Type Option Here... <br></p>');
        }
    })

    $(document).on('click', 'p', function () {
        if($('#questionModal').is(':visible')) {
            $('.bg-custom-grey').removeClass('bg-custom-grey');
            $(this).addClass('bg-custom-grey');

            if($('#star').prop('checked') != true) {
                $('#arrow_icon').show();
            }
        }
    })

    $('.arrow').on('click',function () {
        if($('#questionModal').is(':visible')) {
            var input_array = $('.bg-custom-grey').parent().find('p');
            var selected_input = $('.bg-custom-grey')[0];
            for (var i = 0; i < input_array.length; i++){
                if(input_array[i] == selected_input){
                    var current_index = i;
                }
            }

            if($(this).hasClass('mdi-arrow-up-bold')) {
                if(current_index > 0) {
                    var str = input_array[current_index - 1];
                    input_array[current_index-1] = input_array[current_index];
                    input_array[current_index] = str;
                }
            }

            if($(this).hasClass('mdi-arrow-down-bold')) {
                if(current_index < input_array.length - 1){
                    var str = input_array[current_index + 1];
                    input_array[current_index + 1]= input_array[current_index];
                    input_array[current_index] = str;
                }
            }

            var ss = input_array;
            $('#answer_type').summernote('code', '');
            for (var j = 0; j < ss.length; j++){
                $('#answer_type').summernote('code', $('#answer_type').summernote('code') + ss[j].outerHTML);
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
        var answer_type_text = '';
        var answer_type = 1;
        if($('#normal').prop('checked') == false) {
            if($('#questionModal').is(':visible')) {
                $('.bg-custom-grey').removeClass('bg-custom-grey');
            }

            answer_text = $('#answer_type').summernote('code');

            if($('#check').prop('checked') == true) {
                answer_type = 2;
                answer_type_text = 'check';
            }

            if($('#radio').prop('checked') == true) {
                answer_type = 3;
                answer_type_text = 'radio';
            }

            if($('#star').prop('checked') == true) {
                answer_type = 4;
                answer_type_text = 'star';
            }
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
                answer_type_text: answer_type_text,
                answer_text: answer_text
            },
            dataType:"json",
            success:function(html) {
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

    $("input[type=radio]").change(function() {
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

    $('#create_tem_btn').on('click',function () {
        $('#form_result').empty();
        $('#save_new_record').text('Save New Record Template');
        init_record_type_form();
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
                        if(row.type_mode == '0')
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
                        if(row.priority == '1') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:visible_record_type(\''+data+'\',4)" title="Visible" class="text-dark"><i class="fa fa-unlock"></i></a> | ' +
                                        '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',4)" title="Visible" class="text-dark"><i class="fa fa-unlock"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                            }

                        }
                        else if(row.priority=='2') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',3)" title="Visible" class="text-dark"><i class="fa fa-unlock"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" title="Remove" class="text-dark"><i class="ion-trash-a"></i></a>';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',3)" title="Visible" class="text-dark"><i class="fa fa-unlock"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" title="Remove" class="text-dark"><i class="ion-trash-a"></i></a>';
                            }

                        }
                        else if(row.priority=='3') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',2)" title="Invisible" class="text-dark"><i class="ion-locked"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" title="Remove" class="text-dark"><i class="ion-trash-a"></i></a>';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:edit_record_type(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',2)" title="Invisible" class="text-dark"><i class="ion-locked"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordTemplateDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a> | ' +
                                    '<a href="javascript:delete_record_type(\''+data+'\')" title="Remove" class="text-dark"><i class="ion-trash-a"></i></a>';
                            }

                        }
                        else if(row.priority == '4') {
                            if(row.type_mode == '0') {
                                return '<a href="javascript:visible_record_type(\''+data+'\',1)" title="Invisible" class="text-dark"><i class="ion-locked"></i></a> ';
                            } else {
                                return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:visible_record_type(\''+data+'\',1)" title="Invisible" class="text-dark"><i class="ion-locked"></i></a> ';
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
        columns:
            [
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
                        return '<a href="javascript:order_up(\''+data+'\')" class="text-dark edit" ><i class="mdi mdi-arrow-up-bold arrow" style="cursor: pointer;"></i></a>  ' +
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

    function order_up(id) {
        $.ajax({
            url:"<?php echo e(url('business/order_up')); ?>/" + id,
            dataType:"json",
            success:function(data) {
                if(data.success)
                {
                    $('#type_mode_table').DataTable().ajax.reload();
                }
            },
            error:function () {
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    }
    function order_down(id) {
        $.ajax({
            url:"<?php echo e(url('business/order_down')); ?>/" + id,
            dataType:"json",
            success:function(data) {
                if(data.success)
                {
                    $('#type_mode_table').DataTable().ajax.reload();
                }
            },
            error:function () {
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    }

    function delete_question(id) {
        $('#form_result').html('');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:"<?php echo e(url('business/delete_question')); ?>/" + id,
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

    $('#record_type_tab').click(function() {
        $('#create_tem_tab').hide();
        $('#recordTem_table_tab').show();
        $('#record_type_table').DataTable().ajax.reload();
    })

    $('#record_type_form').on('submit', function(event) {
        event.preventDefault();

        if($('#type_mode_table tr').eq(1).children('td').length == 1 && $('input[name=type_mode]:checked').val() == 1) {
            alert('There is no question you added. Please add your question.');

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
                        get_record_types();
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
            });
        }

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
        $('#create_tem_tab').hide();
        $('#recordTem_table_tab').show();
    }

    function edit_record_type(id) {
        $('#form_result').html('');
        $('#parent_record_id').val(id);

        $.ajax({
            url:"<?php echo e(url('business/get_record_type')); ?>/" + id,
            dataType:"json",
            success:function(html) {

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
                    $('#b').prop('checked', true);
                    $('#question_div').removeAttr('hidden');
                    $('#type_mode_table').DataTable().ajax.reload();
                }
            }
        })
    }

    function visible_record_type(id, priority){
        $.ajax({
            url:"<?php echo e(route('business.visible_record_type')); ?>",
            method: 'post',
            data: {
                id: id,
                priority,priority
            },
            dataType:"json",
            success:function(data) {
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

    function delete_record_type(id) {
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
                    url: "<?php echo e(url('business/delete_record_type')); ?>/" + id,
                    dataType: "json",
                    success: function(data){
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
</script>


<script>

    $('#employees_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "<?php echo e(route('business.employee_list')); ?>",
            method: 'post',
            data: {
                    _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:
            [
                {
                    name: 'Name',
                    data: 'first_name',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                      return row.first_name+' '+row.second_name;
                    }
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                      return '<a href="javascript:edit_employee(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> |  ' +
                          '<a href="javascript:delete_employee(\''+data+'\')" class="text-dark" title="Remove"><i class="ion-trash-a"></i></a>';
                    }
                }
            ]
        });

    $('#employee_tab').click(function() {
        $('#employees_table').DataTable().ajax.reload();
    })

    $('#first_name').on('input',function() {
        $('#fname_required').removeClass('filled');
    })

    $('#second_name').on('input',function() {
        $('#sname_required').removeClass('filled');
    })

    $('#dob').on('input',function() {
        $('#dob_required').removeClass('filled');
    })

    $('#ni').on('input',function(e) {
        var NI_number = $('#ni').val();
        var NI_min_number = <?php echo e($NI_min_number); ?>;
        if(NI_number.search(' ') > 0) {
            $('#space_error').addClass('filled');
            $('#space_error li').html('This value is not allowed - "space characters".');
        } else if(NI_number.length < NI_min_number) {
            $('#space_error').addClass('filled');
            $('#space_error li').html('The NIF for the Spain is set so it must be at least ' + NI_min_number + ' characters long.');
        } else {
            $('#space_error').removeClass('filled');
        }
    })

    $('#employee_form').on('submit', function(event) {
        event.preventDefault();

        var error_detect = 0;
        var NI_number = $('#ni').val();
        var NI_min_number = <?php echo e($NI_min_number); ?>;

        if($('#first_name').val() == '') {
            $('#fname_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#fname_required').removeClass('filled');
        }

        if($('#second_name').val() == '') {
            $('#sname_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#sname_required').removeClass('filled');
        }

        if($('#dob').val() == '') {
            $('#dob_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#dob_required').removeClass('filled');
        }

        if(NI_number == '') {
            $('#space_error').addClass('filled');
            $('#space_error li').html('The NIF for the Spain is set so it must be at least ' + '<?php echo e($NI_min_number); ?>' + ' characters long.');
            error_detect = 1;
        } else {
            $('#space_error').removeClass('filled');
        }

        if(NI_number.search(' ') > 0) {
            error_detect = 1;
        } else if(NI_number.length < NI_min_number) {
            error_detect = 1;
        }

        if(error_detect == 1) {
            return false;
        }

        $('#new_employee').text('Create New Employee');

        if($('#employee_id').val() == '')
        {
            $.ajax({
                url:"<?php echo e(route('business.employee_add')); ?>",
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
                        $('#employee_form')[0].reset();
                        $('#employee_id').val('');
                        $('#employees_table').DataTable().ajax.reload();
                        reload_employees();
                    }

                    $('#e_form_result').html(html);
                    setTimeout(function () {
                        $('#e_form_result').empty();
                    }, 5000);
                }
            })
        }

        if($('#employee_id').val() != "")
        {
            $.ajax({
                url:"<?php echo e(route('business.employee_update')); ?>",
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
                        $('#employee_form')[0].reset();

                        $('#employee_id').val('');
                        $('#employees_table').DataTable().ajax.reload();
                        reload_employees();
                    }
                    $('#e_form_result').html(html);
                    setTimeout(function () {
                        $('#e_form_result').empty();
                    }, 5000);
                }
            });
        }

        $("#dob").removeAttr('readonly');
        $('#ni').removeAttr('readonly');

    });


    function edit_employee(id) {
        $('#e_form_result').html('');
        $.ajax({
            url: "<?php echo e(url('business/get_employee')); ?>/" + id,
            dataType: "json",
            success: function(html) {
                $('#first_name').val(html.data.first_name);
                $('#second_name').val(html.data.second_name);
                $('#dob').val(html.data.dob).click();
                $('#ni').val(html.data.NI_Insurance_Number);
                $('#employee_id').val(html.data.id);
                // if(html.used==true)
                // {
                $("#dob").attr('readonly','readonly');
                $('#ni').attr('readonly','readonly');
                $("#new_employee").text('Save Edits');
                // }else{
                //     $("#dob").removeAttr('readonly');
                //     $('#ni').removeAttr('readonly');
                // }

            }
        })
    }

    function delete_employee(id){
        $('#e_form_result').html('');
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
                    url: "<?php echo e(url('business/delete_employee')); ?>/" + id,
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        if(data.success)
                        {
                            Swal.fire("Deleted!", data.success, "success");
                            // html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            $('#employee_form')[0].reset();
                            $('#employee_id').val('');
                            $('#employees_table').DataTable().ajax.reload();
                            reload_employees();
                        }

                        if(data.warning)
                        {
                            Swal.fire("Cancelled!", data.warning, "error");
                            // html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                        }
                        // $('#e_form_result').html(html);
                    }
                })
            }
        });

    }
</script>

<script>
    $('#record_history_table').DataTable({
        // lengthMenu: false,
        "processing": true,
        "serverSide": true,
        searching: false,
        ajax:{
            url: "<?php echo e(route('business.record_history_list')); ?>",
            method: 'post',
            data: function ( d ) {
                d.filter = $('#filter_employee').val();
            },
        },
        columns:
            [
                {
                    name: 'Record Template',
                    data: 'record_type',
                    class: 'text-center p-2',
                },
                {
                    name: 'Employee',
                    data: 'full_name',
                    class: 'text-center p-2',
                },
                {
                    name: 'Date Created',
                    data: 'record_date',
                    class: 'text-center p-2',
                },
                {
                    name: 'View',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        if(row.max_version == 'yes') {
                            if(row.full_name == "Employee Off-boarded") {
                                return '<a href="javascript:view_record(\''+data+'\')" class="text-dark" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordHistoryDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                            } else {
                                return '<a href="javascript:view_record(\''+data+'\')" class="text-dark" title="View"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:edit_record(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> | ' +
                                    '<a href="<?php echo e(url("business/recordHistoryDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                            }
                        } else {
                            return '<a href="javascript:view_record(\'' + data + '\')" class="text-dark" title="View"><i class="ion-eye"></i></a> | ' +
                                '<a href="<?php echo e(url("business/recordHistoryDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                        }
                    }
                }
            ]
        });

    $('#record_history_tab').click(function(){
        $('#record_history_table').DataTable().ajax.reload();
    })

    function view_record(id)
    {
        $.ajax({
            url: "<?php echo e(url('business/get_record_history_content')); ?>/" + id,
            dataType: "json",
            success:function(html) {
                $('#record_history_content').html(html.data.content);
                $('#myModalLabel').text(html.data.record_type.record_type);
                $('#myModal').modal('show');
            }
        })
    }

    function edit_record(id)
    {
        $.ajax({
            url:"<?php echo e(route('business.get_draft_data')); ?>",
            method:"POST",
            dataType:"json",
            success:function(res)
            {
                if(res.length > 0) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You have a record saved as a draft. This action will delete it. \n Please confirm you want to proceed.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3bc850",
                        cancelButtonColor: "#ec4561",
                        confirmButtonText: "Yes, I am sure.",
                    }).then(function (result) {
                        if (result.value) {
                            m_draft_flag = 0;
                            $('#n_form_result').empty();
                            get_record_history_content(id);
                        }
                    });
                } else {
                    get_record_history_content(id);
                }
            }
        })

    }

    function get_record_history_content(id) {
        $.ajax({
            url: "<?php echo e(url('business/get_record_history_content')); ?>/" + id,
            dataType: "json",
            success:function(html) {
                $('#text_answer').summernote('code', html.data.content);
                $('#history_id').val(html.data.id);
                $('#employees').val(html.data.employee.id).change();
                $('#employees').attr('disabled', 'disabled');
                // $('#employees option[value='+html.data.employee.id+']').attr('selected','selected');
                $('#record_types').val(html.data.record_type.id).change();
                $('#record_types').attr('disabled', 'disabled');

                // $('#text_answer').val(html.data.content);
                $('.tab-pane').each(function (index, el) {
                    $(this).removeClass('active');
                });

                $('.nav-link').each(function (index, el) {
                    $(this).removeClass('active');
                });

                document.getElementById("save_draft").style.visibility = "hidden";

                $('#record_tab').addClass('active');
                $('#add_new_record').addClass('active');
            }
        })
    }

    function view_record_type(id)
    {
        $.ajax({
            url: "<?php echo e(route('business.get_qa_type_info')); ?>",
            method: "POST",
            data:
                {
                    parent_id: id
                },
            dataType: "json",
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

<?php echo $__env->make('layouts.master-business', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/front/business/direct-connect.blade.php ENDPATH**/ ?>
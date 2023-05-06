@extends('layouts.master')
@section('css')
<style>
.table-responsive table thead{
    display:none;
}


</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                    <li class="breadcrumb-item active"><a href="#">Records</a></li>
                </ol>
            </div>
            <h4 class="page-title">Records</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
 <div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 text-center">
            <div class="card-body" style="padding: 13px;">
                <p class="m-0 color-black-light">Perform a quick search here to reveal the employment records for a new applicant.</p>
            </div>

        </div>
        <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#search_view" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-search"></i></span>
                        <span class="d-none d-sm-inline-block">Search/View</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#monitor" role="tab" id="monitor_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-mobile-phone"></i></span>
                        <span class="d-none d-sm-inline-block">Monitor</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#remove" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-remove"></i></span>
                        <span class="d-none d-sm-inline-block">Remove</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#flag_rules" role="tab" id="flag_rules_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-sticky-note"></i></span>
                        <span class="d-none d-sm-inline-block">Flag Rules</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#test_data" role="tab" id="test_data_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-sticky-note"></i></span>
                        <span class="d-none d-sm-inline-block">Test Data</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="search_view" role="tabpanel">

                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label color-black-light">What is the Applicants numéro d'inscription au répertoire?</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" required placeholder="Enter NIR:" id="NI_search_number" />
                            <ul class="parsley-errors-list" id="space_error"><li class="parsley-required">This value is not allowed space characters.</li></ul>
                        </div>

                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right" id="search_btn">
                            Search
                        </button>
                    </div>



                    <div class="form-group row">
                        <div class="card-body">
                            <h4 class="card-title font-20 mt-0 color-black-light">Search Results for:  <span id="NI_review"></span></h4>
                        </div>
                    </div>
                    <div class="form-group row" id="search_result">
                        <!-- <div class="col-md-12">
                            <div class="card m-b-20 box-shadow-note">
                                <div class="card-body">
                                    <h6 class="card-text text-center color-black-light">No results to show.</h6>
                                    <h6 class="card-text text-center color-black-light">We have not deducted a credit for this search.</h6>
                                </div>
                            </div>
                        </div> -->
                    </div>

                </div>
                <div class="tab-pane p-3" id="monitor" role="tabpanel">
                    <div class="custom-padding-top">
                        <table id="table_monitor" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Record</th>
                                <th class="text-center">Added By</th>
                                <th class="text-center">On</th>
                                <th class="text-center">At</th>
                                <th class="text-center">IP</th>
                                <th class="text-center">Api Activity Id</th>
                                <th class="text-center">Flagged For</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane p-3" id="remove" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <div class="col-md-12 m-t-30 display-inline">
                                <input type="radio" class="" name="radio" style="margin-right: 10px; " checked>
                                <label class="col-form-label text-right color-black-light" for="record_type">Remove specific post: </label>
                                <div class="col-sm-2 display-inline">
                                    <input type="text" name="">
                                </div>

                            </div>
                            <div class="col-md-12 m-t-30">
                                <input type="radio" class="" name="radio" style="margin-right: 10px; ">
                                <label class="col-form-label text-right color-black-light" for="record_type">Remove: all records added by user: </label>
                                <input type="text" class="col-sm-2 display-inline" name="">
                                <label class="col-form-label text-right color-black-light" for="record_type"> between </label>
                                 <input type="text" class="col-sm-2 display-inline" name="">
                                <label class="col-form-label text-right color-black-light" for="record_type"> and </label>
                                 <input type="text" class="col-sm-2 display-inline" name="">
                            </div>
                            <div class="col-md-12 m-t-30">
                                <input type="radio" class="" name="radio" style="margin-right: 10px; ">
                                <label class="col-form-label text-right color-black-light" for="record_type">Remove all records added by </label>
                                <input type="text" class="col-sm-2 display-inline" name="">
                                <label class="col-form-label text-right color-black-light" for="record_type"> from IP </label>
                                <input type="text" class="col-md-2" data-mask="999.999.999.999" name="record_type" />
                            </div>
                            <div class="col-md-12 m-t-30">
                                <input type="radio" class="" name="radio" style="margin-right: 10px; ">
                                <label class="col-form-label text-right color-black-light" for="record_type">Remove records added on API Activity id </label>
                                <div class="col-sm-2 display-inline">
                                    <input type="text" name="">
                                </div>
                            </div>
                            <div class="col-md-12 text-right m-t-30">
                                <button type="submit" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light">
                                    Remove
                                </button>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="tab-pane p-3" id="flag_rules" role="tabpanel">
                    <div class="card-body custom-padding-btop ">

                        <div class="col-md-12 m-t-30 m-b-20 display-inline">
                            <label class="col-form-label text-right color-black-light" for="record_type">Unlikely Actions:</label>
                        </div>
                        <ul>
                            <li class="card-title mt-0 color-black-light">
                                3 records added for 1 NIR by different users in any 6 month period.
                            </li>
                            <li class="card-title mt-0 color-black-light">
                                Exact same text of 10 or more words repeated in multiple records.
                            </li>
                            <li class="card-title mt-0 color-black-light">
                                5 or more accounts per IP :
                            </li>
                            <li class="card-title mt-0  color-black-light">
                                Rules /Words/symbols/phrases:
                                <button class="btn bg-convey-green text-white" style="float: right;" id="flag_rule_add_btn">add</button>
                            </li>
                            <div class="table-responsive">
                                <table class="table table-hover" id="flag_rules_table">

                                </table>
                            </div>

                            <li class="card-title mt-0 color-black-light">
                                Blocked IPs:
                            </li>
                            <textarea required="" class="form-control card-title mt-0 " rows="10">
                            </textarea>
                            <li class="card-title mt-0 color-black-light">
                                To be added later:
                            </li>
                            <div class="col-md-12  display-inline">
                                <label class="col-form-label text-right color-black-light" for="record_type">Approved country IPs: </label>
                            </div>
                        </ul>

                    </div>

                </div>

                <div class="tab-pane p-3" id="test_data" role="tabpanel">
                    <div class="card-body custom-padding-btop ">

                        <div class="col-md-12 m-t-30 m-b-20 display-inline">
                            <label class="col-form-label text-right color-black-light" for="record_type">Test Data List:</label>
                            <button class="btn bg-convey-green text-white" style="float: right;" id="test_data_add_btn">add</button>
                        </div>

                        <div class="">

                            <table class="table table-bordered table-striped m-t-10 p-2 table-hover" id="test_data_table">
                                <thead>
                                <tr>
                                    <th class="text-center">NIR</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        </div>

    </div>
</div>
<!-- end row -->
<div class="modal fade" id="flag_rules_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Rule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="flag_rule_id">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Text</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text"  id="flag_rule_text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-emerald text-white" id="flag_rule_save_btn">Save & changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="test_data_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Test NIR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="test_data_id">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">NIR</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text"  id="test_data_text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-emerald text-white" id="test_data_save_btn">Save & changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="version_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Record Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">

                    <div class="col-sm-10 color-black-light" id="version_view_content">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-convey-green text-white" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection

@section('script')
<script>
    $('#NI_search_number').on('input',function(e){
        var NI_number = $('#NI_search_number').val();
        if(NI_number.search(' ')>0)
        {
            $('#space_error').addClass('filled');
        }else{
            $('#space_error').removeClass('filled');
        }
    })



    $('#search_btn').on('click',function(){

        if($('#space_error').hasClass('filled'))
        {
            return false;
        }
        $('#NI_review').html($('#NI_search_number').val());

        $.ajax({
            url:"{{url('records/search')}}",
            type: "POST",
            data: {
                NI_number:$('#NI_search_number').val(),
            },
            dataType:"json",
            success:function(res){
                var html = '';
                if(res.data.length>0){
                    res.data.forEach(function(item,key){

                        var version = '';
                    if(item.ids&&item.ids.length>0){

                        for (var i = 0; i < item.ids.length; i++) {
                            if(i==0)
                                version +='View Previous Versions... <a class="text-convey-green" href="javascript:version_view(\''+item.ids[item.ids.length-i-1]+'\')" style="margin-right:10px;">'+(i+1)+'</a>';
                            else
                                version +='/ <a class="text-convey-green" href="javascript:version_view(\''+item.ids[item.ids.length-i-1]+'\')" style="margin-right:10px;">'+(i+1)+'</a>';
                        }

                    }
                    var creat_date = formatDate(item.record_date);
                        if($('#NI_search_number').val()=='ABC123456789ABC')
                            item.ocb_name = 'Mars Partners Ltd';
                        html +='<div class="col-md-6 col-lg-6 col-xl-12">\n' +
                            '                            <div class="card m-b-20 box-shadow-note">\n' +
                            '                                <div class="card-body custom-padding-btop text-center">\n' +
                            '                                    <span class="card-title font-20 mt-0 align-middle font-weight-bolder color-black-light text-center">' + $('#NI_search_number').val() + '</span>\n' +
                            '                                </div>\n' +
                            '                                <div class="card-body ">\n' +
                            '                                    <p class="font-20 mt-0 align-middle color-black-light">Created By: <strong>'+item.ocb_name+'</strong></p>\n' +
                            '                                    <p class="ard-title font-20 mt-0 align-middle color-black-light">Type of record: <strong>'+item.record_type+'</strong></p>\n' +
                            '                                    <p class="ard-title font-20 mt-0 align-middle color-black-light">Data created: <strong>'+creat_date.substr(0,10)+'</strong></p>\n' +
                            '                                    <span class="card-title font-20 mt-0 align-middle color-black-light">Comments:</span>\n' +
                            '                                    <div class="color-black-light font-20 pl-5 mt-3">'+item.RECORD_content+'</div>\n' +
                            '                                    <p style="float: right; " class="color-black-light">'+version+'</p>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                        </div>';
                    });

                }else{
                    html='<div class="col-md-12">\n' +
'                            <div class="card m-b-20 box-shadow-note">\n' +
'                                <div class="card-body">\n' +
'                                    <h6 class="card-text text-center color-black-light">No results to show.</h6>\n' +
'                                    <h6 class="card-text text-center color-black-light">We have not deducted a credit for this search.</h6>\n' +
'                                </div>\n' +
'                            </div>\n' +
'                        </div>';
                }
                $('#search_result').html(html);

            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    })

    function formatDate(d) {
        date = new Date(d);
        var day = date.getDate();
        if (day < 10) {
            day = "0" + day;
        }
        var month = date.getMonth() + 1;
        if (month < 10) {
            month = "0" + month;
        }
        var year = date.getFullYear();
        return day + "/" + month + "/" + year;
    }
    function version_view(id)
    {
        $.ajax({
            url:"{{url('records/get_record_version')}}",
            type: "POST",
            data: {
                id:id,
            },
            dataType:"json",
            success:function(res){
                var data= res.data;
                $('#version_view_content').html('<p class="color-black-light">'+data.RECORD_content+'</p>');
                $('#version_view_modal').modal('show');
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    }

</script>


<script>
    $('#monitor_tab').on('click',function(){
        $('#table_monitor').DataTable().ajax.reload();
    })
    $('#table_monitor').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: false,
        autoWidth: false,

        ajax:{
            url: "{{ route('RDB_temp_list') }}",
            method:'post',
            data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
        },
        columns:[
                {
                    name: 'Record',
                    data: 'record_type',
                    class: 'text-center p-2',
                },
                {
                    name: 'Added By',
                    data: 'CBR_id',
                    class: 'text-center p-2',
                },
                {
                    name: 'On',
                    data: 'connection_type',
                    class: 'text-center p-2',
                },
                {
                    name: 'At',
                    data: 'record_date',
                    class: 'text-center p-2',
                },
                {
                    name: 'IP',
                    data: 'IP_address',
                    class: 'text-center p-2',
                },
                {
                    name: 'Api Activity Id',
                    data: 'API_Activity_ID',
                    class: 'text-center p-2',
                },
                {
                    name: 'Flagged For',
                    data: 'flaged_for',
                    class: 'text-center p-2',
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                      return '<a href="javascript:approve(\''+data+'\')"><button type="button" class="btn bg-emerald text-white" style="margin-right: 10px;">Approve</button></a><a href="javascript:remove(\''+data+'\')"><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></a>';

                    }
                }
                ]
        });



    function approve(id){

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, Approve it!"
          }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:"{{url('records/approve')}}/"+id,
                    dataType:"json",
                    success:function(data){
                       $('#table_monitor').DataTable().ajax.reload();
                    }
                })

            }
        });

    }

    function remove(id){

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, Remove it!"
          }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:"{{url('records/remove')}}/"+id,
                    dataType:"json",
                    success:function(data){
                        $('#table_monitor').DataTable().ajax.reload();
                    }
                })

            }
        });

    }
</script>


<script>
    $('#flag_rules_tab').on('click',function(){
        $('#flag_rules_table').DataTable().ajax.reload();
    })

    $('#flag_rules_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "{{url('records/flag_rules_list')}}",
            method:'post',
            data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
        },
        columns:[
                {
                    name: 'No',
                    data: 'text',
                    class: 'text-center p-2',
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                      return '<a href="javascript:insert_rule('+data+',\''+row.text+'\')" class="text-dark edit" ><i class="ion-edit"></i></a> |  <a href="javascript:delete_rule('+data+')" class="text-dark"><i class="ion-trash-a"></i></a>';
                    }
                }
                ]
        });
    $('#flag_rule_add_btn').on('click',function(){
        $('#flag_rule_id').val('');
        $('#flag_rule_text').val('');
        $('#flag_rules_modal').modal('show');
    })

    function insert_rule(id,text){
        $('#flag_rule_id').val(id);
        $('#flag_rule_text').val(text);
        $('#flag_rules_modal').modal('show');
    }

    $('#flag_rule_save_btn').on('click',function(){
        $.ajax({
            url:"{{url('records/flag_rules_save')}}",
            type: "POST",
            data: {
                id:$('#flag_rule_id').val(),
                text:$('#flag_rule_text').val()
            },
            dataType:"json",
            success:function(data){
                $('#flag_rules_table').DataTable().ajax.reload();

                alertify.logPosition("top right");
                alertify.success(data.success);
                $('#flag_rules_modal').modal('hide');
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
                $('#flag_rules_modal').modal('hide');

            }
        })

    });

    function delete_rule(id){

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, Remove it!"
          }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:"{{url('records/flag_rule_delete')}}/"+id,
                    dataType:"json",
                    success:function(data){
                        alertify.logPosition("top right");
                        alertify.success(data.success);

                        $('#flag_rules_table').DataTable().ajax.reload();
                        $('#flag_rules_modal').modal('hide');
                    }
                })

            }
        });

    }
</script>

<script>
    $('#test_data_tab').on('click',function(){
        $('#test_data_table').DataTable().ajax.reload();
    })

    $('#test_data_table').DataTable({
        lengthMenu: true,
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "{{url('records/test_data_list')}}",
            method:'post',
            data:{
                _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:[
            {
                name: 'NIR',
                data: 'NI_number',
                class: 'text-center p-2',
            },
            {
                name: 'Manage',
                data: 'id',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    return '<a href="javascript:insert_test_data('+data+',\''+row.NI_number+'\')" class="text-dark edit" ><i class="ion-edit"></i></a> |  <a href="javascript:delete_test_data('+data+')" class="text-dark"><i class="ion-trash-a"></i></a>';
                }
            }
        ]
    });
    $('#test_data_add_btn').on('click',function(){
        $('#test_data_id').val('');
        $('#test_data_text').val('');
        $('#test_data_modal').modal('show');
    })

    function insert_test_data(id,text){
        $('#test_data_id').val(id);
        $('#test_data_text').val(text);
        $('#test_data_modal').modal('show');
    }

    $('#test_data_save_btn').on('click',function(){
        $.ajax({
            url:"{{url('records/test_data_save')}}",
            type: "POST",
            data: {
                id:$('#test_data_id').val(),
                text:$('#test_data_text').val()
            },
            dataType:"json",
            success:function(data){
                $('#test_data_table').DataTable().ajax.reload();

                alertify.logPosition("top right");
                alertify.success(data.success);
                $('#test_data_modal').modal('hide');
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
                $('#test_data_modal').modal('hide');

            }
        })

    });

    function delete_test_data(id){

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, Remove it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:"{{url('records/test_data_delete')}}/"+id,
                    dataType:"json",
                    success:function(data){
                        alertify.logPosition("top right");
                        alertify.success(data.success);

                        $('#test_data_table').DataTable().ajax.reload();
                        $('#test_data_modal').modal('hide');
                    }
                })

            }
        });

    }
</script>
@endsection

@extends('layouts.master-advisors')
@section('css')
    <style>
        .ion-edit:hover{
            cursor: pointer;
        }
        .marked{
            color: orange;
        }
        .blue-underline {
            /*text-decoration-line: underline;
            text-decoration-color: blue;*/
            color: #524f4f;
            font-weight: 500;
        }
        div.rating-number:hover {
            cursor: pointer;
            color: #3BC850 !important;
        }
        .circle {
            border-radius: 50%;
            width: 27px;
            height: 27px;
            padding: 0px;
            background: #fff;
            border: 3px solid #3BC850;
            color: #3BC850!important;
            text-align: center;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="notification-div hide" id="notification_div">

        </div>
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{url('advisors/home')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Search</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Search the Convey Databank</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <button onclick="topFunction()" class="btn-move-top" id="btnMoveToTop" title="Go to top"><i class="mdi mdi-chevron-double-up"></i></button>
        <div class="col-md-12">
            <div class="card m-b-20 text-center">
                <div class="card-body" style="padding: 13px;">
                    <p class="m-0 color-black-light">Perform a quick search here to reveal the employment records for a new applicant uploaded by their previous employers.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs m-t-10" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" data-toggle="tab" href="#search_record" role="tab" id="search_record_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-edit"></i></span>
                                <span class="d-none d-sm-inline-block">Search</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#sent_request" role="tab" id="sent_request_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Sent Requests</span>
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="search_record" role="tabpanel">

                            <div class="col-lg-12 row" id="search_panel">
                                <div class="offset-1 col-lg-7 col-xl-9">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label col-md-12 text-center color-black-light display-inline font-20">
                                                What is the Applicants NIF<br> (or replacement search number):
                                            </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control col-sm-3  mx-auto" placeholder="Enter Insurance Number:" id="NI_search_number" value="ABC1234567">
                                            <div class="col-sm-3 mx-auto">
                                                <ul class="parsley-errors-list float-left" id="space_error">
                                                    <li class="parsley-required">This value is not allowed - "space characters".</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label col-md-12 text-center color-black-light display-inline font-20">What is the Applicants Date of Birth: </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input class="form-control col-sm-3 mx-auto" type="date" max="9999-12-31" id="dob" value="2000-12-20">
                                            <div class="col-sm-3 mx-auto">
                                                <ul class="parsley-errors-list float-left" id="dob_required"><li class="parsley-required">This value is required.</li></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-4">
                                        <button type="submit" class="btn bg-emerald offset-sm-5 col-sm-2 text-white waves-effect waves-light" id="search_btn">
                                            <div style="display:none;" class="loading-show2">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </div>
                                            Perform Search
                                        </button>
                                    </div>`
                                </div>
                                <div class="col-lg-4 col-xl-2">
                                    <div class="mt-2 color-black-light" style="border:1px solid lightgrey; padding: 10px; border-radius: 3px;">
                                        <label class="display-inline font-18">Search Options....</label>
                                        <p class="color-black-light font-12">Press the green 'Perform Search' button to view our sample records.</p>
                                        <p>or</p>
                                        <p class="color-black-light font-12">Replace the sample numbers with your own real numbers to perform an actual search</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="card-body">
                                    <h4 class="card-title font-20 mt-0 color-black-light">Search Results for:  <span id="NI_review"></span></h4>
                                </div>
                            </div>
                            <div class="form-group row" id="search_result">

                            </div>
                        </div>

                        <div class="tab-pane p-3" id="sent_request" role="tabpanel">
                            <div class="table-rep-plugin">
                                <h4 class="card-text text-center color-black-light">Departure Evaluation Requests</h4>
                                <p class="card-text color-black-light">
                                    These requests are sent to an applicant’s previous employer and are only possible if a  search show no results.  To ensure the recipient receives the request  we will send two automatic reminders over a 5 day period.
                                    To view an example  of the departure evaluation <a href="javascript:view_record_type('5')" class="text-dark edit" title="View"><u>click here</u></a>.
                                </p>

                                <table id="sent_request_table" class="table table-bordered table-striped m-t-40 w-100">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="15%">Applicants Name</th>
                                        <th class="text-center" width="15%">Previous Employers Business Name</th>
                                        <th class="text-center" width="15%">Request Sent To</th>
                                        <th class="text-center" width="20%">Sent On</th>
                                        <th class="text-center" width="20%">Last Reminder Sent On</th>
                                        <th class="text-center" width="10%">Status</th>
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


    <div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row text-center p-4">
                                <div class="col-12">
                                    <h2 class="">Just One More Step...</h2>
                                </div>
                                <div class="col-12 mt-4">
                                    <span class="font-18">It looks like you don’t have any</span><br/>
                                    <span class="font-18">credits to complete this search.</span>
                                </div>
                                <div class="col-12 mt-3">
                                    <span class="font-18">To purchase more credits please… </span>
                                </div>
                                <div class="col-12 text-white mt-2">
                                    <button class="btn bg-convey-green text-white">
                                        <a href="{{url('advisors/search-credits?tab=2')}}" class="text-white font-22">Click Here</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-4">
                            <div class="row h-100" style="background-color: #F2F2F2; margin-right: 10px;">
                                <div class="col-12 mt-4 m-l-30">
                                    <span class="font-20">&#10003; Check records created by </span><br/>
                                    <span class="font-20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;previous employers</span>
                                </div>
                                <div class="col-12 mt-4 m-l-30">
                                    <span class="font-20">&#10003; Recruit </span><span class="font-20" style="text-decoration: underline;">Smarter </span>
                                </div>
                                <div class="col-12 mt-4 mb-4 m-l-30 mb-2">
                                    <span class="font-20">&#10003; Hire Faster </span><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-convey-green text-white" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="record_lock_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0 color-black-light">Record Unlock Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="lock_modal_body">

                    <h5 class="color-black-light">Access to these records is restricted by the person the records are about.<br>To request access please click <a href="javascript:request_record_unlock()" class="text-convey-green">this link</a> and we will ask that you are given permission to view the records.</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-convey-green text-white p-1" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

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

    <!-- No search result modal -->
    <div class="modal fade" id="no_result_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center p-3">
                            <span class="font-25">No results to show…</span> <span class="font-20">(We have not deducted a credit for this search)</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div style="position: relative; padding-top: 56.25%;">
                                <iframe src="https://iframe.mediadelivery.net/embed/79061/d46ecad2-b01a-441d-a35f-490c0c30ccfa?autoplay=true" loading="lazy" 
                                    style="border: none; position: absolute; top: 0; height: 100%; width: 100%;" 
                                    allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;" allowfullscreen="true">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-6 p-3 text-muted">
                            <div class="col-12 text-center">
                                <span class="font-25">Get the Information</span><br/>
                                <span class="font-25">You need ...</span>
                            </div>
                            <div class="col-12 mt-3 text-center">
                                <span class="font-15">
                                    Some businesses have not uploaded all of their records yet so to help you get the information you need let’s send a request to your applicants 
                                    previous employers using the form underneath.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-convey-green text-white" data-dismiss="modal">Close + view form</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#NI_search_number').on('input',function(e){
            var NI_number = $('#NI_search_number').val();
            var NI_min_number = {{$NI_min_number}};
            if(NI_number.search(' ')>0)
            {
                $('#space_error').addClass('filled');
                $('#space_error li').html('This value is not allowed - "space characters".');
            }else if(NI_number.length < NI_min_number) {
                $('#space_error').addClass('filled');
                $('#space_error li').html('The NIF for the Spain is set so it must be at least ' + NI_min_number + ' characters long.');
            }else{
                $('#space_error').removeClass('filled');
            }
        })

        function show_notification() {
            $('#notification_div').removeClass('hide');
            setTimeout(hidden_notification, 5000);
        }

        function hidden_notification() {
            $('#notification_div').addClass('hide');
        }

        $('#dob').on('input',function(e){
            $('#dob_required').removeClass('filled');
        })

        function request_record_unlock() {
            var html = '';
            html='<h5 class="color-black-light text-center">Requesting now... Please wait.</h5>';

            $('#lock_modal_body').html(html);

            $.ajax({
                url: "{{ route('advisors.request_record_unlock') }}",
                method: "POST",
                data: {'ni_number': $('#NI_search_number').val(), 'dob': $('#dob').val()},
                dataType:"json",
                success: function (data) {

                    if (data.status) {
                        html='<h5 class="color-black-light text-center">A request has been sent, please check your emails for a response.</h5>';
                        $('#lock_modal_body').html(html);

                    }

                    $('#search_result').empty();

                },
                error: function () {
                    html='<h5 class="color-black-light text-center">Failed to request. Please try again.</h5>';
                    $('#lock_modal_body').html(html);

                    $('#search_result').empty();
                }
            })
        }

        $('#search_btn').on('click',function(){

            if($('#space_error').hasClass('filled'))
            {
                return false;
            }

            if ($('#dob').val()=='') {
                $('#dob_required').addClass('filled');
                return false;
            }

            $('#NI_review').html($('#NI_search_number').val());
            // brief pause
            html='<div class="col-md-12">\n' +
                '                            <div class="card m-b-20 box-shadow-note">\n' +
                '                                <div class="card-body">\n' +
                '                                    <h6 class="card-text text-center color-black-light">Searching Records...Please Wait.</h6>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>';
            $('#search_result').html(html);

            $('.loading-show2').css('display','contents');
            $('#search_btn').prop('disabled', true);
            $.ajax({
                url:"{{route('advisors.record_search')}}",
                type: "POST",
                data: {
                    NI_number: $('#NI_search_number').val(),
                    dob:$('#dob').val(),
                },
                dataType:"json",
                success:function(res){
                    $('.loading-show2').css('display','none');
                    $('#search_btn').prop('disabled', false);
                    if(res.errors) {
                        $('#space_error').addClass('filled');
                        $('#space_error li').html(res.errors[0]);
                    } else if(res.status == 'credits_count_error') {
                        $('#alert_modal').modal('show');
                    } else if(res.status == 'record_lock') {
                        if(res.record_lock_status >= 1) {
                            html='<h5 class="color-black-light">Access to these records is restricted by the person the records are about.<br>To request access please click <a href="javascript:request_record_unlock()" class="text-convey-green">this link</a> and we will ask that you are given permission to view the records.</h5>';

                        }/* else if(res.record_lock_status > 1) {
                        html='<h5 class="color-black-light text-center">A request has been sent, please check your emails for a response.</h5>';

                    }*/

                        $('#search_result').empty();
                        $('#lock_modal_body').html(html);
                        $('#record_lock_modal').modal('show');
                    } else {

                        var html = '';
                        var index_no = 0;

                        if(res.data.length > 0) {
                            res.data.forEach(function(item, key) {
                                var version = '';
                                index_no++;

                                if(item.ids && item.ids.length > 0) {
                                    for (var i = 0; i < item.ids.length; i++) {
                                        if( i==0 ) {
                                            version += 'View Previous Versions... <a class="text-convey-green" href="javascript:version_view(\'' + item.ids[item.ids.length - i - 1] + '\')" style="margin-right:10px;">' + (i + 1) + '</a>';
                                        } else {
                                            version += '/ <a class="text-convey-green" href="javascript:version_view(\'' + item.ids[item.ids.length - i - 1] + '\')" style="margin-right:10px;">' + (i + 1) + '</a>';
                                        }
                                    }
                                }

                                var creat_date = formatDate(item.record_date);

                                if($('#NI_search_number').val() == 'ABC1234567') {
                                    item.ocb_name = 'Mars Partners Ltd';
                                    item.CBR_id = "ES000000";
                                    item.website = "www.marspartnersltd.ccc";
                                }

                                var newDate = new Date();
                                var created_date = new Date(item.time_stamp.split(' ')[0]);
                                var millisecondsPerDay = 24 * 60 * 60 * 1000;
                                const diffInMs = newDate - created_date;
                                const diffInDays = diffInMs / millisecondsPerDay;
                                var past_days = 60 - diffInDays.toFixed();
                                var past_days_html = '';

                                if(past_days >= 1) {
                                    if(past_days == 60) {
                                        past_days_html = '<small style="color: #3BC850;">(Record added to the DATABANK today)</small>';
                                    } else if(past_days == 59) {
                                        past_days_html = '<small style="color: #3BC850;">(Record added to the DATABANK 1 day ago)</small>';
                                    } else {
                                        past_days_html = '<small style="color: #3BC850;">(Record added to the DATABANK ' + diffInDays.toFixed() + ' days ago)</small>';
                                    }

                                }

                                var ocb_name = item.ocb_name;
                                var cbr_id = item.CBR_id;
                                var after_cbr_id = '';
                                var website = item.website;

                                if(item.connection_type == 'guest') {
                                    ocb_name = item.Branch;
                                    cbr_id = 'NA';
                                    website = 'NA';
                                }

                                if(index_no < res.data.length) {
                                    after_cbr_id = res.data[index_no].CBR_id;
                                }

                                html +='<div class="col-md-12 col-lg-12 col-xl-12">\n' +
                                    '                            <div class="card m-b-20 box-shadow-note" style="padding-left: 20px">\n' +
                                    '                                <div class="card-body custom-padding-btop text-center" style="padding-top: 30px;">\n' +
                                    '                                    <span class="card-title font-20 mt-0 align-middle font-weight-bolder color-black-light text-center">' + $('#NI_search_number').val() + '</span>\n' +
                                    '                                </div>\n' +
                                    '                                <div class="card-body ">\n' +
                                    '                                    <p class="font-20 mt-0 align-middle color-black-light">Created By: <strong>'+ocb_name+'</strong></p>\n' +
                                    '                                    <p class="font-20 mt-0 align-middle color-black-light">Account Number: <strong>' + cbr_id + '</strong></p>\n' +
                                    '                                    <p class="font-20 mt-0 align-middle color-black-light">Website: <strong>' + website + '</strong></p>\n' +
                                    '                                    <p class="ard-title font-20 mt-0 align-middle color-black-light">Type of record: <strong>'+item.record_type+'</strong> '+ past_days_html +'</p>\n' +
                                    '                                    <p class="ard-title font-20 mt-0 align-middle color-black-light">Record Date: <strong>'+creat_date.substr(0,10)+'</strong></p>\n' +

                                    '                                    <div style="border:2px solid lightgrey; padding: 10px; border-radius: 3px;">\n'+
                                    '                                <div class="">\n' +
                                    '                                    <span class="card-title font-20 mt-0 color-black-light">Record Content:</span>\n' +
                                    '                                </div>\n' +
                                    '                                    <div class="color-black-light font-20 pl-5 mt-3">\n'+
                                    item.RECORD_content.replace(/\<p>A:/g, '<p class="blue-underline">A:') + '</div>\n' +

                                    '                                       </div>\n' +
                                    '                                    <p style="float: right; " class="color-black-light">'+version+'</p>\n' +
                                    '                        </div>';
                                if(cbr_id != 'NA' && cbr_id != 'ES000000') {
                                    if(after_cbr_id != cbr_id) {
                                        if(item.current_business_id != item.previous_business_id && item.rating_number == null) {
                                            html += '<div class="row m-b-30 ' + cbr_id + '">\n' +
                                                '                                <div class="col-12 col-md-12 col-lg-12 col-xl-12 text-center">\n' +
                                                '                                    <p class="color-black-light">How would you rate the records created by ' + ocb_name + ' : </p>\n' +
                                                '                                </div>\n' +
                                                '                                <div class="col-9 col-md-7 col-lg-7 col-xl-7 display-inline text-right">\n' +
                                                '                                    <div class="float-right">\n' +
                                                '                                        <div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number" onclick="onSetRating(this)">1</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">2</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">3</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">4</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">5</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">6</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">7</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">8</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">9</div>\n' +
                                                '                                            <div data-id="' + cbr_id + '" class="color-black-light display-inline ' + cbr_id + '-rating-number rating-number ml-4" onclick="onSetRating(this)">10</div>\n' +
                                                '                                        </div>\n' +
                                                '                                        <div>\n' +
                                                '                                            <div class="color-black-light display-inline float-left" style="margin-left: -2rem;">Not useful</div>\n' +
                                                '                                            <div class="color-black-light display-inline" style="margin-right: -2rem;">Very useful</div>\n' +
                                                '                                        </div>\n' +
                                                '                                    </div>\n' +

                                                '                                </div>\n' +
                                                '                                <div class="col-3 col-md-5 col-lg-5 col-xl-5 pl-5">\n' +
                                                '                                    <button onclick="onSaveRating(\'' + cbr_id + '\')" class="btn bg-emerald text-white waves-effect waves-light">Save Rating</button>\n' +
                                                '                                </div>\n' +
                                                '                            </div></div></div>';
                                        } else {
                                            html += '</div></div>';
                                        }

                                    } else {
                                        html += '</div></div>';

                                    }
                                } else {
                                    html += '</div></div>';
                                }
                            });


                        } else {
                            $("#no_result_modal").modal("show");
                            html='<div class="col-md-12">\n' +
                                '                            <div class="card m-b-20 box-shadow-note">\n' +
                                '                                <div class="card-body p-5">\n' +
                                '                                    <h4 class="card-text text-center color-black-light">Get the Information You Need …</h4>\n' +
                                '                                    <p class="card-text color-black-light">Not everyone has uploaded all of their records yet so to help you get the information you need we will send the applicants previous employer a request asking them to upload a departure evaluation (view an example departure evaluation <a href="javascript:view_record_type(5)" class="text-dark edit" title="View"><u>here</u></a>).</p>\n' +
                                '                                    <p class="card-text text-center color-black-light">To make sure they receive the request we will also send two follow up requests over the next 5 days.</p>\n' +
                                '<div class="table-rep-plugin">' +
                                '<span id="n_form_result"></span>' +
                                '<form method="post" id="sent_request_form" class="form-horizontal" enctype="multipart/form-data">' +
                                '@csrf' +
                                '<div class="form-group  m-t-30 row">' +
                                '<label class="col-lg-2 col-form-label text-right color-black-light">Previous Employers Email Address:</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" class="form-control" name="receiver_email" id="receiver_email" />' +
                                '<label class="col-form-label text-right color-black-light float-right">(Applicants Previous Employer)</label>' +
                                '<div class="">' +
                                '<ul class="parsley-errors-list float-left" id="receiver_email_required">' +
                                '<li class="parsley-required" id="li_receiver_email">This value is required.</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '<div class="form-group row">' +
                                '<label class="col-lg-2 col-form-label text-right color-black-light">Previous Employers Business Name:</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" class="form-control" name="business_name" id="business_name" />' +
                                '<div class="">' +
                                '<ul class="parsley-errors-list float-left" id="business_name_required">' +
                                '<li class="parsley-required">This value is required.</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '<div class="form-group row">' +
                                '<label class="col-lg-2 col-form-label text-right color-black-light">Applicants Name:</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" class="form-control" name="applicant_name" id="applicant_name" />' +
                                '<div class="">' +
                                '<ul class="parsley-errors-list float-left" id="applicant_name_required">' +
                                '<li class="parsley-required">This value is required.</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '<div class="form-group row">' +
                                '<label class="col-lg-2 col-form-label text-right color-black-light">GOV Number:</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" class="form-control" name="gov_number" id="gov_number" value="'+$('#NI_search_number').val()+'"/>' +
                                '<div class="">' +
                                '<ul class="parsley-errors-list float-left" id="gov_number_required">' +
                                '<li class="parsley-required">This value is required.</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '<div class="form-group row">' +
                                '<label class="col-lg-2 col-form-label text-right color-black-light">Date of Birth:</label>' +
                                '<div class="col-lg-10">' +
                                '<input type="text" class="form-control" name="dob_input" id="dob_input" value="' + $('#dob').val() + '"/>' +
                                '<div class="">' +
                                '<ul class="parsley-errors-list float-left" id="dob_input_required">' +
                                '<li class="parsley-required">This value is required.</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '<div class="form-group row">' +
                                '<div class="offset-lg-2 col-sm-12 col-lg-10">' +
                                '<a href="javascript:on_sent_request_click()" class="btn bg-emerald col-12 col-sm-5 col-md-4 col-lg-3 text-white waves-effect waves-light float-right" id="btn_request">' +
                                '<div style="display:none;" class="loading-show3">' +
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' +
                                '</div>'+
                                'Send Request Now' +
                                '</a>' +
                                '</div>' +
                                '</div>' +

                                '</form>' +
                                '</div>' +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '                        </div>';
                        }

                        $('#search_result').html(html);

                        var scroll_move = 0;
                        var width = $(window).width();
                        var search_panel_height = $('#search_panel').height();

                        if(width < 576) {
                            scroll_move = 835;
                        } else if(width >= 576 && width < 768) {
                            scroll_move = 650;
                        } else if(width >= 768 && width < 992) {
                            scroll_move = 615;
                        } else if(width >= 992 && width < 1200) {
                            scroll_move = 615;
                        } else {
                            scroll_move = 440 + (search_panel_height - 275);
                        }

                        doScrolling(scroll_move, 500);

                        if(res.email_sent_flag == 'true') {
                            setTimeout(show_notification, 10000);
                        }
                        // document.body.scrollTop = scroll_move;
                        // document.documentElement.scrollTop = scroll_move;
                    }
                },

                error:function(){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');

                    $('.loading-show2').css('display','none');
                    $('#search_btn').prop('disabled', false);

                }
            })
        })

        function view_record_type(id)
        {
            $.ajax({
                url: "{{ route('advisors.get_qa_type_info') }}",
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

        function auto_search(gov_number, dob) {
            $('#search_record_tab').click();
            $('#NI_search_number').val(gov_number);
            $('#dob').val(dob);
            $('#search_btn').click();
        }

        function on_sent_request_click() {
            var error_detect = 0;
            var NI_number = $('#gov_number').val();
            var NI_min_number = {{$NI_min_number}};

            if($('#receiver_email').val() == '') {
                $('#receiver_email_required').addClass('filled');
                error_detect = 1;
            } else {
                $('#receiver_email_required').removeClass('filled');
            }

            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#receiver_email').val())) {
                $('#receiver_email_required').removeClass('filled');

            } else {
                $('input[name=receiver_email]').css('box-shadow', '0px 0px 4px red');
                $('input[name=receiver_email]').css('margin-bottom', '0px');
                $('#li_receiver_email').html('Invalid email address.');
                $('#receiver_email_required').addClass('filled');
                error_detect = 1;
            }

            if($('#applicant_name').val() == '') {
                $('#applicant_name_required').addClass('filled');
                error_detect = 1;
            } else {
                $('#applicant_name_required').removeClass('filled');
            }

            if($('#business_name').val() == '') {
                $('#business_name_required').addClass('filled');
                error_detect = 1;
            } else {
                $('#business_name_required').removeClass('filled');
            }

            if($('#dob_input').val() == '') {
                $('#dob_input_required').addClass('filled');
                error_detect = 1;
            } else {
                $('#dob_input_required').removeClass('filled');
            }

            if(NI_number == '') {
                $('#gov_number_required').addClass('filled');
                $('#gov_number_required').html('The NIF for the Spain is set so it must be at least ' + '{{$NI_min_number}}' + ' characters long.');
                error_detect = 1;
            } else {
                $('#gov_number_required').removeClass('filled');
            }

            if(NI_number.search(' ') > 0) {
                error_detect = 1;
            } else if(NI_number.length < NI_min_number) {
                error_detect = 1;
            }

            if(error_detect == 1) {
                return false;
            }

            $('.loading-show3').css('display','contents');
            $('#btn_request').prop('disabled', true);
            $.ajax({
                url:"{{ route('advisors.sent_request_add') }}",
                method:"POST",
                data: {
                    'receiver_email': $('#receiver_email').val(),
                    'applicant_name': $('#applicant_name').val(),
                    'business_name': $('#business_name').val(),
                    'gov_number': $('#gov_number').val(),
                    'dob_input': $('#dob_input').val()
                },
                dataType:"json",
                success:function(data)
                {
                    $('.loading-show3').css('display','none');
                    $('#btn_request').prop('disabled', false);
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
                        $('#sent_request_table').DataTable().ajax.reload();
                        $('#sent_request_tab').click();
                        $('#search_result').html('');

                    }

                }
            })
        }

        $('.rating-number').on('click', function () {
            $('.rating-number').each(function() {
                $(this).removeClass('circle');

            })

            $(this).addClass('circle');

        })

        function onSetRating(obj) {
            var cbr_id = obj.getAttribute('data-id');

            $('.' + cbr_id + '-rating-number').each(function() {
                $(this).removeClass('circle');

            })

            $(obj).addClass('circle');
        }

        function onSaveRating(cbr_id) {
            var selected_value = 0;

            $('.' + cbr_id + '-rating-number').each(function() {
                var class_name = $(this).attr('class');

                if(class_name.includes('circle')) {
                    selected_value = $(this).html();
                }
            })

            if(selected_value == 0) {
                alert('Please select the rating value.');
                return false;
            }

            $.ajax({
                url:"{{ route('settings.save_rate_record') }}",
                method:"POST",
                data: {
                    'cbr_id': cbr_id,
                    'rating_number': selected_value,
                    'NI_number': $('#NI_search_number').val()
                },
                dataType:"json",
                success:function(data)
                {
                    $('div.' + cbr_id).hide();
                }
            })

        }

        $('#sent_request_table').DataTable({
            // lengthMenu: false,
            "processing": true,
            "serverSide": false,
            searching: false,
            ajax:{
                url: "{{ route('advisors.get_sent_request_history_list') }}",
                method: 'post',
            },
            columns:
                [
                    {
                        name: 'Applicants Name',
                        data: 'applicant_name',
                        class: 'text-center p-2',
                        width: '20%'
                    },
                    {
                        name: 'Previous Employers Business Name',
                        data: 'business_name',
                        class: 'text-center p-2',
                    },
                    {
                        name: 'Request Sent To',
                        data: 'receiver_email',
                        class: 'text-center p-2',
                    },
                    {
                        name: 'Sent On',
                        data: 'created_at',
                        class: 'text-center p-2',
                    },
                    {
                        name: 'Last Reminder Sent On',
                        data: 'last_reminder_sent_on',
                        class: 'text-center p-2',
                        render: function (data, type, row) {
                            if(row.status == '0') {
                                return '-';
                            } else if(row.status == '2') {
                                return data + '(1 of 2)';
                            } else {
                                return data + '(2 of 2)';
                            }
                        }
                    },
                    {
                        name: 'Status',
                        data: 'status',
                        class: 'text-center p-2',
                        render: function (data, type, row) {
                            if(row.status == '0') {
                                return 'Pending';
                            } else if(row.status == '2') {
                                return 'Closed <br>' + '<a href="javascript:auto_search(\''+row.gov_number+'\', \''+row.dob+'\')" class="text-dark">(view record)</a>';
                            } else {
                                return 'Closed <br>(no reply)';
                            }
                        }
                    }
                ]
        });

        function doScrolling(elementY, duration) {
            var startingY = window.pageYOffset;
            var diff = elementY - startingY;
            var start;

            // Bootstrap our animation - it will get called right before next frame shall be rendered.
            window.requestAnimationFrame(function step(timestamp) {
                if (!start) start = timestamp;
                // Elapsed milliseconds since start of scrolling.
                var time = timestamp - start;
                // Get percent of completion in range [0, 1].
                var percent = Math.min(time / duration, 1);

                window.scrollTo(0, startingY + diff * percent);

                // Proceed with animation as long as we wanted it to.
                if (time < duration) {
                    window.requestAnimationFrame(step);
                }
            })
        }

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
                url:"{{route('advisors.get_record_version')}}",
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
            });
        }



    </script>
    <script>
        //Get the button
        var btnMoveTop = document.getElementById("btnMoveToTop");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                btnMoveTop.style.display = "block";
            } else {
                btnMoveTop.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            // document.body.scrollTop = 0;
            // document.documentElement.scrollTop = 0;
            smoothScroll({ duration: 1000, direction: 'top' });
        }

        function getProgress(_ref) {
            var duration = _ref.duration,
                runTime = _ref.runTime;
            var percentTimeElapsed = runTime / duration;

            function easeOutCubic(x) {
                return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2 ;
            }

            return easeOutCubic(percentTimeElapsed);
        };

        function getTotalScroll(_ref) {
            var scrollableDomEle = _ref.scrollableDomEle,
                elementLengthProp = _ref.elementLengthProp,
                initialScrollPosition = _ref.initialScrollPosition,
                scrollLengthProp = _ref.scrollLengthProp,
                direction = _ref.direction;
            var totalScroll;

            var documentElement = document.documentElement;
            totalScroll = documentElement.offsetHeight;

            return !!~['left', 'top'].indexOf(direction) ? initialScrollPosition : totalScroll - initialScrollPosition;
        };

        function smoothScroll(_ref2) {
            var scrollableDomEle = window,
                direction = _ref2.direction,
                duration = _ref2.duration,
                scrollAmount = window.outerHeight - window.innerHeight + 5000;
            var startTime = null,
                scrollDirectionProp = null,
                scrollLengthProp = null,
                elementLengthProp = null,
                scrollDirectionProp = 'pageYOffset';
            elementLengthProp = 'innerHeight';
            scrollLengthProp = 'scrollHeight';

            var initialScrollPosition = scrollableDomEle[scrollDirectionProp];
            var totalScroll = getTotalScroll({
                scrollableDomEle: scrollableDomEle,
                elementLengthProp: elementLengthProp,
                initialScrollPosition: initialScrollPosition,
                scrollLengthProp: scrollLengthProp,
                direction: direction
            });

            if (!isNaN(scrollAmount) && scrollAmount < totalScroll) {
                totalScroll = scrollAmount;
            }

            var scrollOnNextTick = function scrollOnNextTick(timestamp) {
                var runTime = timestamp - startTime;
                var progress = getProgress({
                    runTime: runTime,
                    duration: duration
                });

                if (!isNaN(progress)) {
                    var scrollAmt = progress * totalScroll;
                    var scrollToForThisTick = direction === 'bottom' ? scrollAmt + initialScrollPosition : initialScrollPosition - scrollAmt;

                    if (runTime < duration) {
                        var xScrollTo = 0;
                        var yScrollTo = scrollToForThisTick;
                        window.scrollTo(xScrollTo, yScrollTo);

                        requestAnimationFrame(scrollOnNextTick);
                    } else {
                        var _scrollAmt = totalScroll;
                        var scrollToForFinalTick = direction === 'bottom' ? _scrollAmt + initialScrollPosition : initialScrollPosition - _scrollAmt;
                        var _xScrollTo = 0;
                        var _yScrollTo = scrollToForFinalTick;
                        window.scrollTo(_xScrollTo, _yScrollTo);
                    }
                }
            };

            requestAnimationFrame(function (timestamp) {
                startTime = timestamp;
                scrollOnNextTick(timestamp);
            });
        };
    </script>
@endsection

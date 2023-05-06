@extends('layouts.master-citizen')
@section('css')
    <style>
        .ion-edit:hover{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{url('citizen/home')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Settings</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Your Settings</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        {{--@if ($email_verify == 0)
            <div class="col-md-12 text-center px-0">
                <div class="alert alert-convey-danger bg-rich-red text-white" role="alert">
                    --}}{{--            <img src="{{asset('assets/images/question-mark.png')}}" style="width: 30px;">--}}{{--
                    Account restricted, please verify your email address
                </div>
            </div>
        @endif--}}

        <div class="col-md-12 bg-white">
            <div class="card-body">
                <!-- Nav tabs -->

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" data-toggle="tab" href="#account_settings" role="tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-search"></i></span>
                            <span class="d-none d-sm-inline-block">Account Settings</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark" data-toggle="tab" href="#account_details" role="tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-th-list"></i></span>
                            <span class="d-none d-sm-inline-block">Account Details</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark" data-toggle="tab" href="#record_settings" id="record_settings_tab" role="tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-search"></i></span>
                            <span class="d-none d-sm-inline-block">Record Settings</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active p-3" id="account_settings" role="tabpanel">
                        <div class="table-rep-plugin">
                            <span id="settings_form_result"></span>
                            <form  id="update_account">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <div class="col-md-12 m-t-30">
                                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">User Account Number: </label>
                                        <div class="col-md-8 display-inline">
                                            <input type="text" class="form-control" value="{{Auth::user()->id}}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-30">
                                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">User Email: </label>
                                        <div class="col-md-8 display-inline">
                                            <input type="text" class="form-control" value="{{Auth::user()->email}}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-40 display-inline">
                                        <label class="col-form-label col-md-3 text-right color-black-light" for="password">Password: </label>
                                        <div class="col-md-8 display-inline">
                                            <input type="text" class="form-control" name="password" id="password" />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="password_error">
                                                    <li class="parsley-required">Passwords need to be 8 characters or more.</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.getElementById('password').value = "***************";
                                        </script>
                                    </div>

                                    <div class="col-md-12 m-t-30">
                                        <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane p-3" id="account_details" role="tabpanel">
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <span id="form_result"></span>
                                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light" >First Name:</label>
                                        <div class="col-md-7 display-inline">
                                            <input type="text" class="form-control" name="firstname" value="{{$user_info->firstname}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light" >Last Name:</label>
                                        <div class="col-md-7 display-inline">
                                            <input type="text" class="form-control" name="lastname" value="{{$user_info->lastname}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light" >Date Of Birth:</label>
                                        <div class="col-md-7 display-inline">
                                            {{--@if ($user_info->dob_flag == 0)
                                            <div class="input-group">
                                                <input type="date" class="form-control display-inline" placeholder="mm/dd/yyyy" id="datepicker-autoclose"  name="DOB" value="{{$user_info->DOB}}" >
                                            </div>
                                            @else
                                            <div class="input-group disable-input-label">
                                                <input type="hidden" name="DOB" value="{{$user_info->DOB}}">
                                                <label class="col-form-label text-left color-black-light">{{$user_info->DOB}}</label>
                                            </div>
                                            @endif--}}
                                            <div class="input-group">
                                                <input type="date" class="form-control display-inline" placeholder="mm/dd/yyyy" id="datepicker-autoclose" max="9999-12-31"
                                                       @if ( $user_info->dob_flag >= 1 ) disabled @endif name="DOB" value="{{$user_info->DOB}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light">Country:</label>
                                        <div class="col-md-7 display-inline">
                                            <input type="hidden" value="AU" name="country">

                                            <select class="form-control" name="country_show" required disabled>
                                                @foreach ($countries as $key => $country)
                                                    <option value="{{ $key }}" @if ( $key == "AU" ) selected @endif>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light">Nationality:</label>
                                        <div class="col-md-7 display-inline">
                                            <select class="form-control" name="nationality" required>
                                                @foreach ($countries as $key => $country)
                                                    <option value="{{ $key }}" @if ( $user_info->nationality == $key ) selected @endif>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light" >House/Building Number:</label>
                                        <div class="col-md-7 display-inline">
                                            <input type="text" class="form-control" name="ma_HBN" value="{{$user_info->ma_HBN}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light" >Street/Road:</label>
                                        <div class="col-md-7 display-inline">
                                            <input type="text" class="form-control" name="ma_street" value="{{$user_info->ma_street}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light" >Town/City:</label>
                                        <div class="col-md-7 display-inline">
                                            <input type="text" class="form-control" name="ma_town_or_city" value="{{$user_info->ma_town_or_city}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-4 text-right color-black-light" >Postcode:</label>
                                        <div class="col-md-7 display-inline">
                                            <input type="text" class="form-control" name="ma_postcode" value="{{$user_info->ma_postcode}}" />
                                        </div>
                                    </div>

                                    <div class="col-md-12 m-t-30">
                                        <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane p-3" id="record_settings" role="tabpanel">
                        <div class="table-rep-plugin">
                            <span id="record_settings_result"></span>
                            <form  id="record_settings_from">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <div class="col-md-12 m-t-40 display-inline">
                                        <label class="col-form-label col-md-3 text-right color-black-light" for="ni">TF Number: </label>
                                        <div class="col-md-8 display-inline">
                                            <input type="text" class="form-control" name="NI_identity_number" id="ni" value="{{$user_info->NI_identity_number}}"
                                                   @if ( $user_info->ni_flag >= 1 ) disabled @endif />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="space_error">
                                                    <li class="parsley-required">This value is not allowed - "space characters".</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-3 text-right color-black-light" for="ni">CONVEY Replacement Search Number: </label>
                                        <div class="col-md-8 display-inline">
                                            <input type="text" class="form-control" name="replacement_search_number" id="replacement_search_number" value="{{$user_info->replacement_search_number}}" disabled />
                                            @if ( $user_info->NI_identity_number != '' )
                                                <a href="javascript:generate_replacement_number()" id="a_generate" class="float-right text-convey-green my-1">[generate]</a>
                                            @else
                                                <a href="javascript:generate_replacement_number()" id="a_generate" class="float-right color-black-light my-1" style="pointer-events: none">[generate]</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 display-inline">
                                        <label class="col-form-label col-md-3 text-right color-black-light display-inline">DOB: </label>
                                        <div class="col-md-8 display-inline">
                                            <div class="input-group">
                                                <input type="date" class="form-control" placeholder="mm/dd/yyyy" max="9999-12-31"
                                                       @if ( $user_info->dob_flag >= 1 ) disabled @endif
                                                       name="DOB" value="{{$user_info->DOB}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-3 text-right color-black-light" for="ni">Record Lock Status: </label>
                                        <div class="col-md-8 display-inline">
                                            <input type="text" class="form-control" name="record_lock_status" id="record_lock_status"
                                                   @if ($user_info->record_lock == 0)
                                                   value="UNLOCKED"
                                                   @else
                                                   value="LOCKED"
                                                   @endif disabled />
                                            @if ( $user_info->record_lock == 0 )
                                                <a href="javascript:on_record_lock('lock')" id="a_record_lock" class="float-right text-convey-green my-1">[lock]</a>
                                            @else
                                                <a href="javascript:on_record_lock('unlock')" id="a_record_lock" class="float-right text-convey-green my-1">[unlock]</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 m-t-30">
                                        <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <script>
        jQuery('document').ready(function(){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const tab = urlParams.get('tab');

            if(tab && tab == '3')
            {
                on_record_lock('unlock', true);
                $('#record_settings_tab').click();
            }
        })

        $('#ni').on('input',function(e) {
            var NI_number = $('#ni').val();
            var NI_min_number = {{$NI_min_number}};

            if(NI_number.search(' ') > 0) {
                $('input[name=NI_identity_number]').css('box-shadow', '0px 0px 4px red');
                $('input[name=NI_identity_number]').css('margin-bottom', '0px');
                $('#space_error').addClass('filled');
                $('#space_error li').html('This value is not allowed - "space characters".');
            } else if(NI_number.length != NI_min_number) {
                $('input[name=NI_identity_number]').css('box-shadow', '0px 0px 4px red');
                $('input[name=NI_identity_number]').css('margin-bottom', '0px');
                $('#space_error').addClass('filled');
                $('#space_error li').html('The TF Number for the Australia is set so it must be at least ' + NI_min_number + ' characters long.');
            } else if(NI_number == 'ABC123456') {
                $('input[name=NI_identity_number]').css('box-shadow', '0px 0px 4px red');
                $('input[name=NI_identity_number]').css('margin-bottom', '0px');
                $('#space_error').addClass('filled');
                $('#space_error li').html('This test number is internally controlled and cannot be added to.');
            } else {
                $('input[name=NI_identity_number]').css('box-shadow', '');
                $('input[name=NI_identity_number]').css('margin-bottom', '');
                $('#space_error').removeClass('filled');

                Swal.fire({
                    title: "Click to Confirm",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3bc850",
                    cancelButtonColor: "#ec4561",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url:"{{ route('citizen.auto_save_ni_number') }}",
                            method:"POST",
                            data: {NI_identity_number: $('#ni').val(), DOB: $('input[name="DOB"]').val()},
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

                                    return false;
                                }
                                if(data.success)
                                {
                                    html = '<div class="alert alert-convey-success">' + data.success + '</div>';

                                    if (data.ni_flag == 1) {
                                        $('input[name=NI_identity_number]').attr('disabled', 'disabled');
                                        $('#a_generate').removeClass('color-black-light');
                                        $('#a_generate').addClass('text-convey-green');
                                        $('#a_generate').removeAttr('style');
                                    }

                                }

                                $('#settings_form_result').html(html);
                                setTimeout(function () {
                                    $('#settings_form_result').empty();
                                }, 5000);

                            }
                        })

                    }
                });
            }

        })

        $('#password').on('input',function(e) {
            var password = $('#password').val();

            if(password.length < 8) {
                $('input[name=password]').css('box-shadow', '0px 0px 4px red');
                $('input[name=password]').css('margin-bottom', '0px');
                $('#password_error').addClass('filled');
            } else {
                $('input[name=password]').css('box-shadow', '');
                $('input[name=password]').css('margin-bottom', '');
                $('#password_error').removeClass('filled');
            }
        })

        $("#password").keyup(function( event ) {

        }).keydown(function( event ) {
            var password = $('#password').val();
            var star_count = 0;

            for(var i = 0;  i < password.length; i++) {
                if(password.substr(i, 1) == '*') {
                    star_count++;
                }
            }

            if(event.which == 8 || event.which == 46) {
                if(star_count == password.length || password.length == 15) {
                    $('#password').val('');
                }
            }
        });

        function generate_replacement_number()
        {
            $.ajax({
                url:"{{ route('citizen.generate_replacement_number') }}",
                method:"POST",
                data: {
                    item:'example_email',
                },
                cache:false,
                dataType:"json",
                success:function(data)
                {
                    $('#replacement_search_number').val(data.replacement_search_number);
                },
                error:function (e)
                {
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }

            })

        }

        function on_record_lock(lock_flag, email_flag = 'false')
        {
            $.ajax({
                url:"{{ route('citizen.record_lock') }}",
                method:"POST",
                data: {
                    lock_flag: lock_flag,
                    email_flag: email_flag
                },
                cache:false,
                dataType:"json",
                success:function(data)
                {
                    if(lock_flag == 'lock') {
                        $('#a_record_lock').attr('href', 'javascript:on_record_lock("unlock")');
                        record_lock = 'LOCK';
                        a_record_lock = '[unlock]';
                    } else {
                        $('#a_record_lock').attr('href', 'javascript:on_record_lock("lock")');
                        record_lock = 'UNLOCK';
                        a_record_lock = '[lock]';
                    }

                    $('#record_lock_status').val(record_lock);
                    $('#a_record_lock').text(a_record_lock);
                },
                error:function (e)
                {
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }

            })

        }

        $('#update_account').on('submit',function(event){
            event.preventDefault();

            var error_detect = 0;
            var NI_number = $('#ni').val();
            var NI_min_number = {{$NI_min_number}};
            var password = $('#password').val();

            if(NI_number == '') {
                $('#space_error').addClass('filled');
                $('#space_error li').html('The TF Number for the Australia is set so it must be at least ' + NI_min_number + ' characters long.');
                error_detect = 1;
            } else if(NI_number.search(' ') > 0) {
                error_detect = 1;
            } else if(NI_number.length != NI_min_number) {
                error_detect = 1;
            } else if(NI_number == 'ABC123456') {
                error_detect = 1;
            } else {
                $('#space_error').removeClass('filled');
            }

            if(password.length < 8) {
                $('#password_error').addClass('filled');
                error_detect = 1;
            } else {
                $('#password_error').removeClass('filled');
            }

            if(error_detect == 1) {
                return false;
            }

            var formdata = new FormData(this);
            formdata.append('replacement_search_number', $('#replacement_search_number').val());

            if($('#ni').attr('disabled') == 'disabled') {
                formdata.append('NI_identity_number', $('#ni').val());
            }

            if($('input[name=DOB]').attr('disabled') == 'disabled') {
                formdata.append('DOB', $('input[name=DOB]').val());
            }

            $.ajax({
                url: "{{ route('citizen.account_settings_update') }}",
                method: "POST",
                data: formdata,
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
                        if (data.dob_flag == 1) {
                            $('input[name=DOB]').attr('disabled', 'disabled');
                        }

                        if (data.ni_flag == 1) {
                            $('input[name=NI_identity_number]').attr('disabled', 'disabled');
                            $('#a_generate').removeClass('color-black-light');
                            $('#a_generate').addClass('text-convey-green');
                            $('#a_generate').removeAttr('style');
                        }

                    }
                    $('#settings_form_result').html(html);
                    setTimeout(function () {
                        $('#settings_form_result').empty();
                    }, 5000);
                    window.scrollTo(0, 0);
                },
                error: function () {
                }
            })

        })

        $('#record_settings_from').on('submit', function(event) {
            event.preventDefault();

            var error_detect = 0;
            var NI_number = $('#ni').val();
            var NI_min_number = {{$NI_min_number}};
            var password = $('#password').val();

            if(NI_number == '') {
                $('#space_error').addClass('filled');
                $('#space_error li').html('The NI Number for the UK is set so it must be at least ' + NI_min_number + ' characters long.');
                error_detect = 1;
            } else if(NI_number.search(' ') > 0) {
                error_detect = 1;
            } else if(NI_number.length != NI_min_number) {
                error_detect = 1;
            } else if(NI_number == 'ABC123456') {
                error_detect = 1;
            } else {
                $('#space_error').removeClass('filled');
            }

            if(error_detect == 1) {
                return false;
            }

            var formdata = new FormData(this);
            formdata.append('replacement_search_number', $('#replacement_search_number').val());

            if($('#ni').attr('disabled') == 'disabled') {
                formdata.append('NI_identity_number', $('#ni').val());
            }

            if($('input[name=DOB]').attr('disabled') == 'disabled') {
                formdata.append('DOB', $('input[name=DOB]').val());
            }

            $.ajax({
                url: "{{ route('citizen.record_settings_update') }}",
                method: "POST",
                data: formdata,
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
                        if (data.dob_flag == 1) {
                            $('input[name=DOB]').attr('disabled', 'disabled');
                        }

                        if (data.ni_flag == 1) {
                            $('input[name=NI_identity_number]').attr('disabled', 'disabled');
                            $('#a_generate').removeClass('color-black-light');
                            $('#a_generate').addClass('text-convey-green');
                            $('#a_generate').removeAttr('style');
                        }

                    }
                    $('#record_settings_result').html(html);
                    setTimeout(function () {
                        $('#record_settings_result').empty();
                    }, 5000);
                    window.scrollTo(0, 0);
                },
                error: function () {
                }
            })

        })

        $('#sample_form').on('submit', function(event){
            event.preventDefault();

            $.ajax({
                url: "{{ route('citizen.account_details_update') }}",
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
                        if (data.dob_flag == 1) {
                            $('input[name=DOB]').attr('disabled', 'disabled');
                        }

                    }
                    $('#form_result').html(html);
                    setTimeout(function () {
                        $('#form_result').empty();
                    }, 5000);
                    window.scrollTo(0, 0);

                }
            })
        });

    </script>
@endsection

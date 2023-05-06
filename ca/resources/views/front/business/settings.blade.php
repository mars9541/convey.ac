@extends('layouts.master-business')
@section('css')
    <style>
        .ion-edit:hover {
            cursor: pointer;
        }

        .loading-show2 {
            display: inline-block;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{url('business/home')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Settings</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Your Settings</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        @if ($email_verify == 0)
            <div class="col-md-12 text-center px-0">
                <div class="alert alert-convey-danger bg-rich-red text-white" role="alert">
                    {{--            <img src="{{asset('assets/images/question-mark.png')}}" style="width: 30px;">--}}
                    Account restricted, please verify your email address
                </div>
            </div>
        @endif

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
                        <a class="nav-link text-dark" data-toggle="tab" href="#logo_tab" role="tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-picture-o"></i></span>
                            <span class="d-none d-sm-inline-block">Logo</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active p-3" id="account_settings" role="tabpanel">
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <span id="settings_form_result"></span>
                                <form id="update_account">
                                    <div class="col-md-12 m-t-30">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline">
                                            CBR ID:
                                        </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" value="{{Auth::user()->id}}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-30">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline align-top">
                                            User Email:
                                        </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="email" id="email" value="{{Auth::user()->email}}"/>
                                            <small style="display: none;" id="free_email_error" class="text-danger">
                                                You cannot use a free email address.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-11 m-t-30">
                                        <button type="button"
                                                class="btn bg-emerald text-white float-right waves-effect waves-light"
                                                id="resend_email_btn">
                                            <div style="display:none;" class="loading-show2">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                            </div> &nbsp;Resend Confirmation Email
                                        </button>
                                    </div>
                                    <div class="col-md-12 m-t-40 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light"
                                               for="password">Password: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="password" id="password"/>
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="password_error">
                                                    <li class="parsley-required">Passwords need to be 8 characters or
                                                        more.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <script>
                                            document.getElementById('password').value = "***************";
                                        </script>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light"
                                               for="business_type">Business Type: </label>
                                        <div class="col-md-9 display-inline">
                                            <select class="custom-select" name="business_type" disabled>
                                                <option
                                                    value="company" {{Auth::user()->business_type == 'company' ? 'selected' : ''}}>
                                                    Company
                                                </option>
                                                <option
                                                    value="organisation" {{Auth::user()->business_type == 'organisation' ? 'selected' : ''}}>
                                                    Organisation
                                                </option>
                                                <option
                                                    value="selfemployed" {{Auth::user()->business_type == 'selfemployed' ? 'selected' : ''}}>
                                                    Self Employed
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light align-top"
                                               for="website">Website Address:</label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="website" id="website"
                                                   value="{{$user_info->website}}"/>
                                            <small style="display: none;" id="website_error" class="text-danger">Must
                                                start with 'www' and no spaces.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label
                                            class="col-form-label col-md-2 text-right color-black-light display-inline"
                                            for="market">Market: </label>
                                        <div class="col-md-9 display-inline">
                                            <select class="custom-select" name="market">
                                                @foreach($market as $item)
                                                    <option
                                                        value="{{$item->name}}" {{$user_info->market==$item->name?'selected':''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light"
                                               for="employees">Number of Employees: </label>
                                        <div class="col-md-9 display-inline">
                                            <select class="custom-select" name="employees">
                                                <option
                                                    value="1-9" {{$user_info->employees == '1-9' ? 'selected' : ''}}>1-9
                                                </option>
                                                <option
                                                    value="10-99" {{$user_info->employees == '10-99' ? 'selected' : ''}}>
                                                    10-99
                                                </option>
                                                <option
                                                    value="100-250" {{$user_info->employees == '100-250' ? 'selected' : ''}}>
                                                    100-250
                                                </option>
                                                <option
                                                    value="251+" {{$user_info->employees == '251+' ? 'selected' : ''}}>
                                                    251+
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light" for="employees">
                                            Chosen Connection Type:
                                        </label>
                                        <div class="col-md-3 display-inline">
                                            <input type="checkbox" name="direct_connect" {{$user_info->direct_connect_flag != 0 ? "checked" : ""}} class="rem_me" id="direct_connect_type">
                                            <label for="direct_connect_type" class="col-form-label color-black-light">
                                                DIRECT CONNECT
                                            </label>
                                        </div>
                                        <div class="col-md-3 display-inline">
                                            <input type="checkbox" name="hris_connect" {{$user_info->hris_connect_flag != 0 ? "checked" : ""}} class="rem_me" id="hris_connect_type">
                                            <label for="hris_connect_type" class="col-form-label color-black-light">
                                                HRIS CONNECT
                                            </label>
                                        </div>
                                        <div class="col-md-3 display-inline">
                                            <input type="checkbox" name="api_connect" {{$user_info->api_connect_flag != 0 ? "checked" : ""}} class="rem_me" id="api_connect_type">
                                            <label for="api_connect_type" class="col-form-label color-black-light">
                                                API CONNECT
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-11 m-t-30">
                                        <button type="submit" class="btn bg-emerald text-white float-right waves-effect waves-light">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                    <div class="tab-pane p-3" id="account_details" role="tabpanel">
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <span id="form_result"></span>
                                <form method="post" id="sample_form" class="form-horizontal"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if($user_info->business_type == 'organisation')
                                        <div class="col-md-12 m-t-30  display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Organisation
                                                Name:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ocb_name"
                                                       value="{{$user_info->ocb_name}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Organisation
                                                Headquarter - House/Building Number:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_HBN"
                                                       value="{{$user_info->company_ma_HBN}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Organisation
                                                Headquarter - Street/Road:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_street"
                                                       value="{{$user_info->company_ma_street}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Organisation
                                                Headquarter - Town/City:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_town_or_city"
                                                       value="{{$user_info->company_ma_town_or_city}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Organisation
                                                Headquarter - Country:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="hidden" value="CA" name="company_lrd_country">

                                                <select class="form-control" name="company_lrd_country_show" required
                                                        disabled>
                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $key == "CA" ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Organisation
                                                Headquarter - Postcode:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_postcode"
                                                       value="{{$user_info->company_ma_postcode}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">VAT: (If
                                                registered)</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="VAT_if_registered"
                                                       value="{{$user_info->VAT_if_registered}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Legal
                                                Representatives - First Name: </label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="lrd_firstname"
                                                       value="{{$user_info->lrd_firstname}}" required/>
                                            </div>

                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Legal
                                                Representatives - Last Name:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="lrd_lastname"
                                                       value="{{$user_info->lrd_lastname}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Legal
                                                Representatives - Date Of Birth:</label>
                                            <div class="col-md-7  display-inline">
                                                <div class="input-group ">
                                                    <input type="date" max="9999-12-31" class="form-control display-inline"
                                                           placeholder="mm/dd/yyyy" id="datepicker-autoclose"
                                                           name="lrd_DOB" value="{{$user_info->lrd_DOB}}" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Legal
                                                Representatives - Country:</label>
                                            <div class="col-md-7 display-inline">
                                                <select class="form-control" name="lrd_country" required>

                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $user_info->lrd_country == $key ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Legal
                                                Representatives - Nationality:</label>
                                            <div class="col-md-7 display-inline">
                                                <select class="form-control" name="lrd_nationality" required>
                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $user_info->lrd_nationality == $key ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - House/Building Number:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_HBN"
                                                       value="{{$user_info->ma_HBN}}" required/>
                                            </div>

                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Street/Road:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_street"
                                                       value="{{$user_info->ma_street}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Town/City:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_town_or_city"
                                                       value="{{$user_info->ma_town_or_city}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Postcode:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_postcode"
                                                       value="{{$user_info->ma_postcode}}"/>
                                            </div>

                                        </div>
                                        <hr>

                                    @elseif($user_info->business_type=='company')

                                        <div class="col-md-12 m-t-30  display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Company
                                                Name:</label>

                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ocb_name"
                                                       value="{{$user_info->ocb_name}}" required/>
                                            </div>
                                        </div>

                                        <div class="col-md-12 m-t-30  display-inline">
                                            <label
                                                class="col-form-label col-md-4 text-right color-black-light align-top">Company
                                                Number:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_no"
                                                       value="{{$user_info->company_no}}" required/>
                                                <small style="display: none;" id="company_no_error" class="text-danger">
                                                    Must be a 9 digit Canada company number at least.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Company
                                                Headquarter - House/Building Number:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_HBN"
                                                       value="{{$user_info->company_ma_HBN}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Company
                                                Headquarter - Street/Road:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_street"
                                                       value="{{$user_info->company_ma_street}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Company
                                                Headquarter - Town/City:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_town_or_city"
                                                       value="{{$user_info->company_ma_town_or_city}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Company
                                                Headquarter - Country:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="hidden" value="CA" name="company_lrd_country">

                                                <select class="form-control" name="company_lrd_country_show" required
                                                        disabled>
                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $key == "CA" ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Company
                                                Headquarter - Postcode:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="company_ma_postcode"
                                                       value="{{$user_info->company_ma_postcode}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">VAT: (If
                                                registered)</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="VAT_if_registered"
                                                       value="{{$user_info->VAT_if_registered}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Director
                                                - First Name:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="lrd_firstname"
                                                       value="{{$user_info->lrd_firstname}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Director
                                                - Last Name:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="lrd_lastname"
                                                       value="{{$user_info->lrd_lastname}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Director
                                                - Date Of Birth:</label>

                                            <div class="col-md-7  display-inline">
                                                <div class="input-group ">
                                                    <input type="date" max="9999-12-31" class="form-control display-inline"
                                                           placeholder="mm/dd/yyyy" id="datepicker-autoclose"
                                                           name="lrd_DOB" value="{{$user_info->lrd_DOB}}" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Director
                                                - Country:</label>
                                            <div class="col-md-7 display-inline">
                                                <select class="form-control" name="lrd_country" required>

                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $user_info->lrd_country == $key ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Director
                                                - Nationality:</label>
                                            <div class="col-md-7 display-inline">
                                                <select class="form-control" name="lrd_nationality" required>
                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $user_info->lrd_nationality == $key ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - House/Building Number:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_HBN"
                                                       value="{{$user_info->ma_HBN}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Street/Road:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_street"
                                                       value="{{$user_info->ma_street}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Town/City:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_town_or_city"
                                                       value="{{$user_info->ma_town_or_city}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Mailing Address - Postcode:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_postcode"
                                                       value="{{$user_info->ma_postcode}}"/>
                                            </div>
                                        </div>
                                        <hr>

                                    @elseif($user_info->business_type=='selfemployed')

                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">First
                                                Name:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="lrd_firstname"
                                                       value="{{$user_info->lrd_firstname}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Last
                                                Name:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="lrd_lastname"
                                                       value="{{$user_info->lrd_lastname}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Date Of
                                                Birth:</label>
                                            <div class="col-md-7  display-inline">
                                                <div class="input-group ">
                                                    <input type="date" max="9999-12-31" class="form-control display-inline"
                                                           placeholder="mm/dd/yyyy" id="datepicker-autoclose"
                                                           name="lrd_DOB" value="{{$user_info->lrd_DOB}}" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Country:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="hidden" value="CA" name="lrd_country">

                                                <select class="form-control" name="lrd_country_show" required disabled>

                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $key == "CA" ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Nationality:</label>
                                            <div class="col-md-7 display-inline">
                                                <select class="form-control" name="lrd_nationality" required>
                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $key }}"
                                                                @if ( $user_info->lrd_nationality == $key ) selected @endif>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12 m-t-30  display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Business
                                                Name:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ocb_name"
                                                       value="{{$user_info->ocb_name}}" required/>
                                            </div>
                                        </div>

                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">VAT: (If
                                                registered)</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="VAT_if_registered"
                                                       value="{{$user_info->VAT_if_registered}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">House/Building
                                                Number:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_HBN"
                                                       value="{{$user_info->ma_HBN}}" required/>
                                            </div>

                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Street/Road:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_street"
                                                       value="{{$user_info->ma_street}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Town/City:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_town_or_city"
                                                       value="{{$user_info->ma_town_or_city}}" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-t-15 display-inline">
                                            <label class="col-form-label col-md-4 text-right color-black-light">Postcode:</label>
                                            <div class="col-md-7 display-inline">
                                                <input type="text" class="form-control" name="ma_postcode"
                                                       value="{{$user_info->ma_postcode}}" required/>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-12 m-t-30">
                                        <button type="submit"
                                                class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                    <div class="tab-pane p-3" id="logo_tab" role="tabpanel">
                        <div class="table-rep-plugin">
                            <span id="logo_form_result"></span>
                            <form id="upload_logo_form">
                                <div class="col-md-12 m-t-30 display-inline">
                                    <div class="col-md-3 display-inline">
                                        <label class="col-form-label color-black-light text-right" for="#">Your Logo for
                                            Templates :</label><br>
                                        <label class="col-form-label color-black-light" for="#">Upload your own logo
                                            here to replace the CONVEY logo on your templates.</label>
                                        <label class="col-form-label color-black-light" for="#">Your logo should be
                                            resized to 280 x 50px.</label>
                                    </div>

                                    <div class="col-md-2 display-inline" style="vertical-align: top">
                                        <input type="file" class="filestyle" id="upload_logo" data-input="false"
                                               data-buttonname="btn-secondary" name="upload_logo"
                                               accept=".png, .jpg, .jpeg, .gif">
                                    </div>

                                    <div class="col-md-6 display-inline" style="vertical-align: top">
                                        @if(!is_null($logo_url))
                                            <img src="{{url('public/upload')}}/{{$logo_url}}" id="record_logo_image"
                                                 name="record_logo_image" alt="your image" width="200px">
                                        @else
                                            <img src="#" id="record_logo_image" name="record_logo_image" width="200px"
                                                 style="display: none;">
                                        @endif
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


    <div class="modal fade bs-example-modal-lg" id="article_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
@endsection

@section('script')
    <script>

        var rand = function () {
            return Math.random().toString(36).substr(2); // remove `0.`
        };

        var token = function () {
            return rand() + rand() + rand() + rand(); // to make it longer
        };

        function generate_token() {
            $('#token_key').val(token());
        }

        $('#email').on('input', function () {
            if ($('#user_type').val() == 'citizen')
                return false;
            var str = "{{$freeEmailList}}";
            var freeEmails = str.split(',');
            var input_email = $('#email').val();
            for (let i = 0; i < freeEmails.length; i++) {
                if (input_email.indexOf(freeEmails[i]) < 0) {
                    $('input[name=email]').css('box-shadow', '');
                    $('input[name=email]').css('margin-bottom', '');
                    $('#free_email_error').hide();
                    continue;
                } else {
                    $('input[name=email]').css('box-shadow', '0px 0px 4px red');
                    $('input[name=email]').css('margin-bottom', '0px');
                    $('#free_email_error').html('You cannot use a free email address.');
                    $('#free_email_error').show();
                    break;
                }
            }
        })

        $("#email").blur(function () {
            if ($('#free_email_error').css('display') != 'none') {
                return false;
            }

            if ($('#email').val() == '') {
                return false;
            }

            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#email').val())) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('settings.validation_email_duplication')}}",
                    method: 'post',
                    data: {
                        email: $('#email').val(),
                    },
                    success: function (result) {
                        if (result.status == false) {
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
                                        url: "{{ route('settings.auto_save_email') }}",
                                        method: "POST",
                                        data: {email: $('#email').val()},
                                        dataType: "json",
                                        success: function (data) {
                                            var html = '';

                                            if (data.errors) {
                                                html = '<div class="alert alert-convey-danger">';

                                                for (var count = 0; count < data.errors.length; count++) {
                                                    html += '<p>' + data.errors[count] + '</p>';
                                                }

                                                html += '</div>';

                                                return false;
                                            }

                                            if (data.success) {
                                                html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                                            }

                                            $('#settings_form_result').html(html);
                                            setTimeout(function () {
                                                $('#settings_form_result').empty();
                                            }, 5000);

                                        }
                                    })

                                }
                            });
                        } else {
                            $('input[name=email]').css('box-shadow', '0px 0px 4px red');
                            $('input[name=email]').css('margin-bottom', '0px');
                            $('#free_email_error').html('This email already exist.');
                            $('#free_email_error').show();
                            return false;
                        }
                    }
                })

            }
        });

        $('#password').on('input', function (e) {
            var password = $('#password').val();

            if (password.length < 8) {
                $('input[name=password]').css('box-shadow', '0px 0px 4px red');
                $('input[name=password]').css('margin-bottom', '0px');
                $('#password_error').addClass('filled');
            } else {
                $('input[name=password]').css('box-shadow', '');
                $('input[name=password]').css('margin-bottom', '');
                $('#password_error').removeClass('filled');
            }
        })

        $("#password").keyup(function (event) {

        }).keydown(function (event) {
            var password = $('#password').val();
            var star_count = 0;

            for (var i = 0; i < password.length; i++) {
                if (password.substr(i, 1) == '*') {
                    star_count++;
                }
            }

            if (event.which == 8 || event.which == 46) {
                if (star_count == password.length || password.length == 15) {
                    $('#password').val('');
                }
            }
        });

        $('#resend_email_btn').on('click', function () {
            $('.loading-show2').show();
            $('#resend_email_btn').prop('disabled', true);
            $.ajax({
                url: "{{route('settings.resend_email')}}",
                method: "POST",
                data: {},
                dataType: "json",
                success: function (res) {
                    $('.loading-show2').hide();
                    $('#resend_email_btn').prop('disabled', false);
                    alertify.logPosition("top right");
                    alertify.success(res.status);
                },
                error: function () {
                    $('.loading-show2').hide();
                    $('#resend_email_btn').prop('disabled', false);
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }
            })
        })

        $(document).on('input', 'input[name=website]', function () {
            var website_url = $('input[name=website]').val();
            var url_array = website_url.split(' ');

            if (website_url.substr(0, 4) != 'www.' || url_array.length > 1) {
                $('input[name=website]').css('box-shadow', '0px 0px 4px red');
                $('input[name=website]').css('margin-bottom', '0px');

                $('#website_error').show();
            } else {
                $('input[name=website]').css('box-shadow', '');
                $('input[name=website]').css('margin-bottom', '');

                $('#website_error').hide();
            }
        })


        $('#update_account').on('submit', function (event) {
            event.preventDefault();

            var website_url = $('input[name=website]').val();
            var url_array = website_url.split(' ');
            var password = $('#password').val();
            var error_detect = 0;

            if ($('#free_email_error').css('display') != 'none') {
                error_detect = 1;
            }

            if ($('#email').val() == '') {
                error_detect = 1;
            }

            if (website_url.substr(0, 4) != 'www.' || url_array.length > 1) {
                $('input[name=website]').css('box-shadow', '0px 0px 4px red');
                $('input[name=website]').css('margin-bottom', '0px');
                $('#website_error').show();
                $("html, body").animate({scrollTop: 100}, "slow");
                error_detect = 1;
            } else {
                $('input[name=website]').css('box-shadow', '');
                $('input[name=website]').css('margin-bottom', '');

                $('#website_error').hide();
            }

            if (password.length < 8) {
                $('#password_error').addClass('filled');
                $("html, body").animate({scrollTop: 100}, "slow");
                error_detect = 1;
            } else {
                $('#password_error').removeClass('filled');
            }

            if (error_detect == 1) {
                return false;
            }

            $.ajax({
                url: "{{ route('settings.account_settings_update') }}",
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

                        if ($('#direct_connect_type').prop('checked') == true) {
                            $('#direct_connect_li').removeClass('d-none');
                        } else {
                            $('#direct_connect_li').removeClass('d-none');
                            $('#direct_connect_li').addClass('d-none');
                        }

                        if ($('#hris_connect_type').prop('checked') == true) {
                            $('#hris_connect_li').removeClass('d-none');
                        } else {
                            $('#hris_connect_li').removeClass('d-none');
                            $('#hris_connect_li').addClass('d-none');
                        }

                        if ($('#api_connect_type').prop('checked') == true) {
                            $('#api_connect_li').removeClass('d-none');
                        } else {
                            $('#api_connect_li').removeClass('d-none');
                            $('#api_connect_li').addClass('d-none');
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

        $(document).on('input', 'input[name=company_no]', function () {
            var company_no = $('input[name=company_no]').val();
            if (!/^([A-Za-z0-9]{9})$/.test(company_no)) {
                $('input[name=company_no]').css('box-shadow', '0px 0px 4px red');
                $('input[name=company_no]').css('margin-bottom', '0px');

                $('#company_no_error').show();
            } else {
                $('input[name=company_no]').css('box-shadow', '');
                $('input[name=company_no]').css('margin-bottom', '');

                $('#company_no_error').hide();
            }
        })

        $('#sample_form').on('submit', function (event) {
            event.preventDefault();

            var business_type = $('select[name=business_type]').val();

            if (business_type == 'company') {
                var company_no = $('input[name=company_no]').val();

                if (!/^([A-Za-z0-9]{9})$/.test(company_no)) {
                    $('input[name=company_no]').css('box-shadow', '0px 0px 4px red');
                    $('input[name=company_no]').css('margin-bottom', '0px');
                    $('#company_no_error').show();
                    $("html, body").animate({scrollTop: 0}, "slow");

                    return false;
                } else {
                    $('input[name=company_no]').css('box-shadow', '');
                    $('input[name=company_no]').css('margin-bottom', '');

                    $('#company_no_error').hide();
                }
            }

            $.ajax({
                url: "{{ route('settings.account_details_update') }}",
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
                    }
                    $('#form_result').html(html);

                    setTimeout(function () {
                        $('#form_result').empty();
                    }, 5000);
                    window.scrollTo(0, 0);

                }
            })
        });

        function view_guide_detail(input) {
            $.ajax({
                url: "{{route('business.get_guide_temp')}}",
                method: "POST",
                data: {
                    item: input,
                },
                dataType: "json",
                success: function (html) {
                    $('#article_title').html('')
                    $('#article_detail').html(html);
                    $('.bs-example-modal-lg').modal('show');
                },
                error: function () {
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');

                }
            })
        }

        $('#a_upload_logo').on('click', function () {
            $('#upload_logo').click();
        })

        $("#upload_logo").change(function () {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#record_logo_image').show();
                    $('#record_logo_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string

                var img = document.getElementById('record_logo_image');
                var r = confirm("We will crop the upload file from the centre out, are you sure you want to proceed?");

                if (r == true) {
                    upload_logo();
                } else {
                    var html = '<div class="alert alert-convey-danger">Wrong image size. Please change your image size rate and upload again.</div>';
                    $('#logo_form_result').html(html);
                    $('#record_logo_image').attr('src', '');
                }

            }
        }

        function upload_logo() {
            var myForm = document.getElementById('upload_logo_form');
            var formData = new FormData(myForm);

            $.ajax({
                url: "{{ route('business.logo_add') }}",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    var html = '';

                    if (data.errors) {
                        html = '<div class="alert alert-convey-danger">' + data.errors + '</div>';
                        $('#record_logo_image').attr('src', '');
                        /*for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';*/
                    }

                    if (data.success) {
                        html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                        {{--$('#convey_logo').attr('src', "{{url('public/upload/')}}" + "/" + data.logo_url);--}}
                        $('#record_logo_image').attr('src', "{{url('public/upload/')}}" + "/" + data.logo_url);
                    }

                    $('#logo_form_result').html(html);
                }
            })
        }

        $(document).on('click', 'input[type=checkbox]', function () {
            if ($(this).prop('checked') == false) {
                if (!$('#direct_connect_type').prop('checked') && !$('#hris_connect_type').prop('checked') && !$('#api_connect_type').prop('checked')) {
                    $(this).prop("checked", true);
                }
            }
        })

    </script>
@endsection

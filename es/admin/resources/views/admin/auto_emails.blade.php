@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                        <li class="breadcrumb-item active"><a href="#">Auto Emails</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Auto Emails</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="">
                        <button type="button" class="btn bg-emerald text-white waves-effect waves-light">
                            Export addresses
                        </button>
                    </div>
                    <br>

                    <!-- Nav tabs -->

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" data-toggle="tab" href="#account" role="tab" id="account_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                                <span class="d-none d-sm-inline-block">Account</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#invites" role="tab" id="invites_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Invites</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#citizen" role="tab" id="citizen_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                                <span class="d-none d-sm-inline-block">Citizen</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#business" role="tab" id="business_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Business</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#hris" role="tab" id="hris_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">HRIS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#advisor" role="tab" id="advisors_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Advisor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#credit" role="tab" id="credit_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Credit Offer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#invite_sender" role="tab" id="invite_sender_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Invite Sender</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#action_ref" role="tab" id="action_ref_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Action Ref</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#rec_lock" role="tab" id="rec_lock_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Record Lock</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#req_dep_eva" role="tab" id="req_dep_eva_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Departure Evaluation Request</span>
                            </a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <input type="hidden" id="tab_name" value="account">
                        <div class="tab-pane active p-3" id="account" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                                <span class="card-title font-20 mt-0 align-middle color-black-light text-center">These emails are sent to all users</span>
                            </div>
                            <br>
                            <table id="account_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane p-3" id="invites" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                                <span class="card-title font-20 mt-0 align-middle color-black-light text-center">These emails are sent to people who have been sent a unique code</span>
                            </div>
                            <table id="invites_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-2">You need to keep a running total of those booking</td>
                                    <td class="text-center p-2">+2 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">6 days after being generated if not used</td>
                                    <td class="text-center p-2">+6 day</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">9 days after being generated if not used</td>
                                    <td class="text-center p-2">+9 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane p-3" id="citizen" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                                <span class="card-title font-20 mt-0 align-middle color-black-light text-center">These emails are sent to citizens</span>
                            </div>
                            <table id="citizen_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- <div class="form-group">
                                <div class="dropdown mo-mb-5">
                                    <button class="btn btn-secondary offset-sm-10 add_new  bg-emerald" type="button" >
                                        Add New
                                    </button>

                                </div>
                            </div> -->
                        </div>
                        <div class="tab-pane p-3" id="business" role="tabpanel">
                            <div class="card-body custom-padding-btop ">
                                <ul>
                                    <li class="card-title mt-0 color-black-light">
                                        a= sent to those that have yet to add any records.
                                    </li>
                                    <li class="card-title mt-0 color-black-light">
                                        b= sent to those that have added records but not purchased credits.
                                    </li>
                                    <li class="card-title mt-0 color-black-light">
                                        c= sent to those that have added records  and have purchased.
                                    </li>
                                </ul>

                            </div>
                            <table id="business_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email subject</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- <div class="form-group">
                                <div class="dropdown mo-mb-5">
                                    <button class="btn btn-secondary offset-sm-10 add_business_email  bg-emerald" type="button" >
                                        Add New
                                    </button>

                                </div>
                            </div> -->
                        </div>
                        <div class="tab-pane p-3" id="hris" role="tabpanel">
                            <div class="card-body custom-padding-btop ">
                                <ul>
                                    <li class="card-title mt-0 color-black-light">
                                        a= sent to those that have yet to add a user.
                                    </li>
                                    <li class="card-title mt-0 color-black-light">
                                        b=sent to those that have added users but no referrals.
                                    </li>
                                    <li class="card-title mt-0 color-black-light">
                                        c= sent to those that have added users and made referrals.
                                    </li>
                                </ul>
                            </div>
                            <table id="hris_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email subject</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-2">Email 1</td>
                                    <td class="text-center p-2">+3</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Version a</td>
                                    <td class="text-center p-2"></td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Version b</td>
                                    <td class="text-center p-2"></td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Version c</td>
                                    <td class="text-center p-2"></td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Email 2</td>
                                    <td class="text-center p-2">+8</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                </tr>
                                </tbody>
                            </table>
                            <!-- <div class="form-group">
                                <div class="dropdown mo-mb-5">
                                    <button class="btn btn-secondary offset-sm-10 add_hris_email  bg-emerald" type="button" >
                                        Add New
                                    </button>

                                </div>
                            </div> -->
                        </div>
                        <div class="tab-pane p-3" id="advisor" role="tabpanel">

                            <ul class="nav  nav-pills nav-justified" role="tablist">
                                <li class="nav-item active ">
                                    <a class="nav-link active text-dark" data-toggle="tab" href="#advisor_developers" role="tab" id="advisors1_tab">
                                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                                        <span class="d-none d-sm-inline-block">Developers</span>
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link text-dark" data-toggle="tab" href="#advisor_adviser" role="tab" id="advisors2_tab">
                                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                        <span class="d-none d-sm-inline-block">Advisors</span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link text-dark" data-toggle="tab" href="#advisor_writer" role="tab" id="advisors3_tab">
                                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                                        <span class="d-none d-sm-inline-block">Recruiters</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane p-3 active" id="advisor_developers" role="tabpanel">
                                    <div class="card-body custom-padding-btop ">
                                        <ul>
                                            <li class="card-title mt-0 color-black-light">
                                                a= sent to those that have yet to make any referrals.
                                            </li>
                                            <li class="card-title mt-0 color-black-light">
                                                b=sent to those that have made referrals.
                                            </li>
                                        </ul>
                                    </div>
                                    <table id="advisors_d_table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Email subject</th>
                                            <th class="text-center">Rule</th>
                                            <th class="text-center">Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="p-2">Email 1</td>
                                            <td class="text-center p-2">+3</td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version a</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version b</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version c</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Email 2</td>
                                            <td class="text-center p-2">+8</td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane p-3" id="advisor_adviser" role="tabpanel">
                                    <div class="card-body custom-padding-btop ">
                                        <ul>
                                            <li class="card-title mt-0 color-black-light">
                                                a= sent to those that have yet to make any referrals.
                                            </li>
                                            <li class="card-title mt-0 color-black-light">
                                                b=sent to those that have made referrals.
                                            </li>
                                        </ul>
                                    </div>
                                    <table id="advisors_a_table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Email subject</th>
                                            <th class="text-center">Rule</th>
                                            <th class="text-center">Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="p-2">Email 1</td>
                                            <td class="text-center p-2">+3</td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version a</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version b</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version c</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Email 2</td>
                                            <td class="text-center p-2">+8</td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane p-3" id="advisor_writer" role="tabpanel">
                                    <div class="card-body custom-padding-btop ">
                                        <ul>
                                            <li class="card-title mt-0 color-black-light">
                                                a= sent to those that have yet to make any referrals.
                                            </li>
                                            <li class="card-title mt-0 color-black-light">
                                                b=sent to those that have made referrals.
                                            </li>
                                        </ul>
                                    </div>
                                    <table id="advisors_w_table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Email subject</th>
                                            <th class="text-center">Rule</th>
                                            <th class="text-center">Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="p-2">Email 1</td>
                                            <td class="text-center p-2">+3</td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version a</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version b</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Version c</td>
                                            <td class="text-center p-2"></td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Email 2</td>
                                            <td class="text-center p-2">+8</td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <div class="dropdown mo-mb-5">-->
                                <!--        <button class="btn btn-secondary offset-sm-10 add_advisors_email bg-emerald" type="button" data-tab_section="advisors">-->
                                <!--            Add New-->
                                <!--        </button>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>


                        </div>
                        <div class="tab-pane p-3" id="credit" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                            <span class="card-title font-20 mt-0 align-middle color-black-light text-center">
                                The sequence will target those business account users that have had a ZERO balance for
                                14 days, 64 days, 120 days and every 120 days.
                            </span>
                            </div>
                            <table id="credit_offer_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-2">Email 1</td>
                                    <td class="text-center p-2">+14 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Email 2</td>
                                    <td class="text-center p-2">+64 day</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 3</td>
                                    <td class="text-center p-2">+120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 4</td>
                                    <td class="text-center p-2"> Every 120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane p-3" id="invite_sender" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                            <span class="card-title font-20 mt-0 align-middle color-black-light text-center">
                                Auto emails targeting Invite Code Generators
                            </span>
                            </div>
                            <table id="invite_sender_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-2">Email 1</td>
                                    <td class="text-center p-2">+14 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Email 2</td>
                                    <td class="text-center p-2">+64 day</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 3</td>
                                    <td class="text-center p-2">+120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 4</td>
                                    <td class="text-center p-2"> Every 120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane p-3" id="action_ref" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                            <span class="card-title font-20 mt-0 align-middle color-black-light text-center">
                                Auto emails targeting advisors/business who serach a record
                            </span>
                            </div>
                            <table id="action_ref_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-2">Email 1</td>
                                    <td class="text-center p-2">+14 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Email 2</td>
                                    <td class="text-center p-2">+64 day</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 3</td>
                                    <td class="text-center p-2">+120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 4</td>
                                    <td class="text-center p-2"> Every 120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane p-3" id="rec_lock" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                            <span class="card-title font-20 mt-0 align-middle color-black-light text-center">
                                Auto emails targeting advisors/business who search a record
                            </span>
                            </div>
                            <table id="rec_lock_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-2">Email 1</td>
                                    <td class="text-center p-2">+14 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Email 2</td>
                                    <td class="text-center p-2">+64 day</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 3</td>
                                    <td class="text-center p-2">+120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 4</td>
                                    <td class="text-center p-2"> Every 120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane p-3" id="req_dep_eva" role="tabpanel">
                            <div class="card-body custom-padding-btop text-center">
                            <span class="card-title font-20 mt-0 align-middle color-black-light text-center">
                                Auto emails targeting advisors/business who serach a record
                            </span>
                            </div>
                            <table id="req_dep_eva_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rule</th>
                                    <th class="text-center">Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-2">Email 1</td>
                                    <td class="text-center p-2">+14 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Email 2</td>
                                    <td class="text-center p-2">+64 day</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 3</td>
                                    <td class="text-center p-2">+120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" p-2">Email 4</td>
                                    <td class="text-center p-2"> Every 120 days</td>
                                    <td class="text-center font-20 p-1">
                                        <a href="#" class="text-dark"><i class="ion-edit"></i></a> | <a href="#" class="text-dark"><i class="fa fa-send m-l-10"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="form-group">
                            <div class="dropdown mo-mb-5">
                                <button class="btn btn-secondary offset-sm-10 add_new  bg-emerald" type="button" >
                                    Add New
                                </button>

                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Email edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="edit_temp_form">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="email_temp_id">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tab section</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="tab_section" name="tab_section" disabled>
                                        <option value="">Select</option>
                                        <option value="account">Account</option>
                                        <option value="invites">Invites</option>
                                        <option value="citizen">Citizen</option>
                                        <option value="business">Business</option>
                                        <option value="hris">HRIS</option>
                                        <option value="advisors1">Advisors Developers</option>
                                        <option value="advisors2">Advisors Advisers</option>
                                        <option value="advisors3">Advisors Recruiters</option>
                                        <option value="credit">Credit Offer</option>
                                        <option value="invite_sender">Invite Sender</option>
                                        <option value="action_ref">Action Ref</option>
                                        <option value="rec_lock">Record Lock</option>
                                        <option value="req_dep_eva">Departure Evaluation Request</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email Subject:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="subject" name="subject" id="title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Rule </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="rule" name="rule">
                                        <option value="0">Instant</option>
                                        @for($i = 1; $i < 61; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    <!-- <input type="text" class="form-control" name="rule" id="rule" required> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Header Image</label>
                                <div class=" col-sm-6">
                                    <input type="file" class="filestyle" name="header" id="header" data-buttonname="btn-secondary">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Footer Image</label>
                                <div class=" col-sm-6">
                                    <input type="file" class="filestyle" name="header" data-buttonname="btn-secondary">
                                </div>
                            </div> -->
                            <label class="col-sm-2 col-form-label">Content </label>
                            <textarea class="summernote" name="content"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary bg-emerald">
                                <div style="display:none;" class="loading-show2">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </div>Save changes
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade send_email_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Send Test Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="send_email_form" action="{{ route('send_html_email') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" id="send_email_id">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email_address" id="email_address" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary bg-emerald">
                                <div style="display:none;" class="loading-show2">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </div>
                                Send</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade group_email_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form id="group_email_form">
                        <div class="modal-body">
                            <input type="hidden" name="subject" id="group_subject">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tilte</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title"  required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Rule</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="group_rule" name="rule" required>
                                        <option value="0">Instant</option>
                                        @for($i = 1; $i < 61; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary bg-emerald">Send</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        @endsection
        @section('script')
            <script>
                $('.summernote').summernote({
                    height: 300,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                 // set focus to editable area after initializing summernote
                });
                $('.add_new').click(function(){
                    $('.bs-example-modal-lg').modal('show');
                    $('#email_temp_id').val('');
                    $('#edit_temp_form').trigger("reset");

                    if($(this).data('tab_section')) {
                        $('#tab_section').val($(this).data('tab_section')).click();
                    }

                    $('.bootstrap-filestyle').find('input').removeAttr('placeholder');
                    $('.summernote').summernote('code','');
                })

                $('.add_business_email').click(function(){
                    $('#group_subject').val('business');
                    $('#group_rule').val('');
                    $('.group_email_modal').modal('show');
                })

                $('.add_hris_email').click(function(){
                    $('#group_subject').val('hris');
                    $('#group_rule').val('');
                    $('.group_email_modal').modal('show');
                })

                $('.add_advisors_email').click(function(){
                    $('#group_subject').val('advisors');
                    $('#group_rule').val('');
                    $('.group_email_modal').modal('show');
                })

                $('#group_email_form').submit(function(event){
                    event.preventDefault();
                    $.ajax({
                        url:"{{ route('add_group_email') }}",
                        method:"POST",
                        data: new FormData(this),
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            $('.group_email_modal').modal('hide');
                            alertify.logPosition("top right");
                            alertify.error(data.success);
                            $('#business_table').DataTable().ajax.reload();
                            $('#hris_table').DataTable().ajax.reload();
                            $('#advisors_table').DataTable().ajax.reload();
                        },
                        error:function(){
                            alertify.logPosition("top right");
                            alertify.error('Server Error!');
                        }
                    })
                })

                function edit_email_temp(id){
                    $.ajax({
                        url:"{{url('get_email_temp')}}/"+id,
                        dataType:"json",
                        success:function(html){
                            if(html.data.header)
                                var header_image = html.data.header.split('_')[1];
                            else
                                var header_image='no image';
                            $('#email_temp_id').val(html.data.id);
                            $('#subject').val(html.data.subject);
                            $('#tab_section').val(html.data.tab_section).click();
                            $('#title').val(html.data.title);
                            $('#rule').val(html.data.rule).click();
                            $('.bootstrap-filestyle').find('input').attr('placeholder',header_image);
                            $('.summernote').summernote('code',html.data.content);
                            $('.bs-example-modal-lg').modal('show');
                        },
                        error:function(){
                            alertify.logPosition("top right");
                            alertify.error('Server Error!');

                        }
                    })
                }

                function send_email(id){
                    $('#send_email_form').trigger("reset");
                    $('#send_email_id').val(id);
                    $('.send_email_modal').modal('show');
                }

                $('#send_email_form').on('submit', function(event){
                    event.preventDefault();
                    $('.loading-show2').css('display','contents');

                    $.ajax({
                        url:"{{ route('send_html_email') }}",
                        method:"POST",
                        data: new FormData(this),
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            $('.loading-show2').css('display','none');
                            $('.send_email_modal').modal('hide');
                            alertify.logPosition("top right");
                            alertify.error(data.success);

                        },
                        error:function(){
                            $('.loading-show2').css('display','none');
                            $('.send_email_modal').modal('hide');
                            alertify.logPosition("top right");
                            alertify.error('Server Error!');

                        }
                    })
                });

                $('#edit_temp_form').on('submit', function(event){
                    event.preventDefault();
                    $('.loading-show2').css('display','contents');
                    var form_data = new FormData(this);
                    form_data.append('tab_section', $('#tab_section').val());

                    $.ajax({
                        url:"{{ route('save_email_temp') }}",
                        method:"POST",
                        data: form_data,
                        contentType: false,
                        cache:false,
                        processData: false,
                        dataType:"json",
                        success:function(data)
                        {
                            $('.loading-show2').css('display','none');
                            alertify.logPosition("top right");
                            alertify.error(data.success);
                            $('.bs-example-modal-lg').modal('hide');
                            $('#email_temp_id').val('');
                            $('#edit_temp_form').trigger("reset");
                            $('.bootstrap-filestyle').find('input').removeAttr('placeholder');
                            $('.summernote').summernote('code','');
                            // var s = $('.nav-link.active')[0].id;
                            $('#'+$('.nav-link.active')[0].id+'le').DataTable().ajax.reload();
                        },
                        error:function(){
                            $('.loading-show2').css('display','none');
                            $('.bs-example-modal-lg').modal('hide');
                            alertify.logPosition("top right");
                            alertify.error('Server Error!');

                        }
                    })
                });



                $('#account_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'account',
                            _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'p-2',
                            render: function (data, type, row) {
                                if(data == '0')
                                    return 'Instant';
                                else
                                    return data;
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>   |  <a target="_blank" href="{{url('preview_email')}}/'+data+'" class="text-dark"><i class="fa fa-eye m-l-10"></i></a>';
                            }

                        }
                    ]
                });

                $('#invites_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'invites',
                            _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(data == 0)
                                    return 'Instant';
                                else
                                    return data;
                            }

                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';
                            }

                        }
                    ]
                });

                $('#citizen_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'citizen',
                            _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',

                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';
                            }

                        }
                    ]
                });

                $('#business_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'business',
                            _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(row.parent_id == 0)
                                    return data;
                                else
                                    return '';
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(row.parent_id != 0)
                                    return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';
                                else
                                    return'';
                            }
                        }
                    ]
                });

                $('#hris_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'hris',
                            _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(row.parent_id == 0)
                                    return data;
                                else
                                    return '';
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                if(row.parent_id != 0)
                                    return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';
                                else
                                    return'';
                            }

                        }
                    ]
                });

                $('#advisors_d_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'advisors1',
                            // _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(row.parent_id == 0)
                                    return data;
                                else
                                    return '';
                            }

                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                if(row.parent_id != 0)
                                    return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';
                                else
                                    return'';
                            }
                        }
                    ]
                });
                $('#advisors_a_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'advisors2',
                            // _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(row.parent_id == 0)
                                    return data;
                                else
                                    return '';
                            }

                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                if(row.parent_id != 0)
                                    return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';
                                else
                                    return'';
                            }
                        }
                    ]
                });
                $('#advisors_w_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'advisors3',
                            // _token: $('meta[name="_token"]').attr('content')
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(row.parent_id == 0)
                                    return data;
                                else
                                    return '';
                            }

                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                if(row.parent_id != 0)
                                    return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';
                                else
                                    return'';
                            }
                        }
                    ]
                });

                $('#credit_offer_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'credit',
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(data == 0)
                                    return 'Instant';
                                else
                                    return data;
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp('+data+')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:send_email('+data+')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';

                            }

                        }
                    ]
                });

                $('#invite_sender_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'invite_sender',
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(data == 0)
                                    return 'Instant';
                                else
                                    return data;
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp(' + data + ')" class="text-dark edit" ><i class="ion-edit"></i></a> | <a href="javascript:send_email(' + data + ')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';

                            }

                        }
                    ]
                });

                $('#action_ref_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'action_ref',
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(data == 0)
                                    return 'Instant';
                                else
                                    return data;
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp(' + data + ')" class="text-dark edit" ><i class="ion-edit"></i></a> | <a href="javascript:send_email(' + data + ')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';

                            }

                        }
                    ]
                });

                $('#rec_lock_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'rec_lock',
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(data == 0)
                                    return 'Instant';
                                else
                                    return data;
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp(' + data + ')" class="text-dark edit" ><i class="ion-edit"></i></a> | <a href="javascript:send_email(' + data + ')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';

                            }

                        }
                    ]
                });

                $('#req_dep_eva_table').DataTable({
                    searching: false,
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    autoWidth: false,
                    ajax:{
                        url: "{{ route('email_temp_list') }}",
                        method:'post',
                        data:{
                            tab_section:'req_dep_eva',
                        }
                    },
                    columns:[
                        {
                            name: 'Email',
                            data: 'title',
                            class: 'text-center p-2',
                        },
                        {
                            name: 'Rule',
                            data: 'rule',
                            class: 'text-center p-2',
                            render: function (data, type, row) {
                                if(data == 0)
                                    return 'Instant';
                                else
                                    return data;
                            }
                        },
                        {
                            name: 'Manage',
                            data: 'id',
                            class: 'text-center p-2',

                            render: function (data, type, row) {
                                return '<a href="javascript:edit_email_temp(' + data + ')" class="text-dark edit" ><i class="ion-edit"></i></a> | <a href="javascript:send_email(' + data + ')" class="text-dark"><i class="fa fa-send m-l-10"></i></a>';

                            }

                        }
                    ]
                });

            </script>
@endsection

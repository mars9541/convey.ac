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
    .docs-example{
        margin-top: 85px;
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
                    <li class="breadcrumb-item active"><a href="#">Settings</a></li>
                </ol>
            </div>
            <h4 class="page-title">Settings</h4>
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
                    <a class="nav-link active text-dark" data-toggle="tab" href="#settings" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#api" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">API</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#email" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-mail-reply"></i></span>
                        <span class="d-none d-sm-inline-block">Emails Addresses</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="settings" role="tabpanel">
                    <!-- <form class="" action="#"> -->
                    <!-- </form> -->
                </div>
                <div class="tab-pane p-3" id="api" role="tabpanel">
                    <div class="form-group row mt-4">
                        <div class="col-md-5 col-xl-4 offset-1">
{{--                            <h2><span style="color: rgb(255, 180, 0);"> POST </span>&nbsp;&nbsp; login endpoint:</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                <span style="color: rgb(255, 180, 0);"> POST </span>&nbsp;&nbsp; login endpoint:
                            </label>
                        </div>
                        <div class="col-md-6 col-xl-7">
{{--                            <h2>/es/api/auth/login</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                /es/api/auth/login
                            </label>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-md-5 col-xl-4 offset-1">
{{--                            <h2><span style="color: rgb(255, 180, 0);"> POST </span>&nbsp;&nbsp; logout endpoint:</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                <span style="color: rgb(255, 180, 0);"> POST </span>&nbsp;&nbsp; logout endpoint:
                            </label>
                        </div>
                        <div class="col-md-6 col-xl-7">
{{--                            <h2>/es/api/auth/logout</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                /es/api/auth/logout
                            </label>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-md-5 col-xl-4 offset-1">
{{--                            <h2><span style="color: rgb(36, 156, 71);"> GET </span>&nbsp;&nbsp;&nbsp;&nbsp; user endpoint:</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                <span style="color: rgb(36, 156, 71);"> GET </span>&nbsp;&nbsp; user endpoint:
                            </label>
                        </div>
                        <div class="col-md-6 col-xl-7">
{{--                            <h2>/es/api/auth/user</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                /es/api/auth/user
                            </label>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-md-5 col-xl-4 offset-1">
{{--                            <h2><span style="color: rgb(36, 156, 71);"> GET </span>&nbsp;&nbsp;&nbsp;&nbsp; search record endpoint:</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                <span style="color: rgb(36, 156, 71);"> GET </span>&nbsp;&nbsp; search record endpoint:
                            </label>
                        </div>
                        <div class="col-md-6 col-xl-7">
{{--                            <h2>/es/api/search</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                /es/api/search
                            </label>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <div class="col-md-5 col-xl-4 offset-1">
{{--                            <h2><span style="color: rgb(255, 180, 0);"> POST </span>&nbsp;&nbsp;  record endpoint:</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                <span style="color: rgb(255, 180, 0);"> POST </span>&nbsp;&nbsp; record endpoint:
                            </label>
                        </div>
                        <div class="col-md-6 col-xl-7">
{{--                            <h2>/es/api/insert_multi_records</h2>--}}
                            <label class="col-form-label color-black-light display-inline font-20">
                                /es/api/insert_multi_records
                            </label>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="email" role="tabpanel">
                    <table id="hris_software_table" class="table table-bordered table-striped m-t-40">
                        <thead>
                        <tr>
                            <th class="text-center" width="10%">Email Address</th>
                            <th class="text-center">Used with These Emails</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($email_list as $email_info)
                                <tr>
                                    <td class="text-center">
                                        {{$email_info->from_email_address}}
                                    </td>
                                    <td class="text-left">
                                        {{$email_info->subjects}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- end row -->
@endsection



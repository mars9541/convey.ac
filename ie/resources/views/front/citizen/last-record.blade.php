@extends('layouts.master-citizen')
@section('css')
    <style>
        .ion-edit:hover {
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
                        <li class="breadcrumb-item active"><a href="#">Last Record</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Your Last Record</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="table-rep-plugin" style="min-height: 420px;">
                        <div class="form-group row">
                            @if($record !== null)
                                <label class="col-lg-12 text-center font-20 col-form-label color-black-light">This is
                                    the last record that was made conveyable by your employer.</label>
                            @else
                                <label class="col-lg-12 text-center font-20 col-form-label color-black-light">
                                    To view your last record please go to your settings page and enter your Personal Public Service Number
                                    . If you already have then no records currently exist.</label>
                            @endif
                        </div>

                        <div class="form-group row">
                            @if($record !== null)
                                <div class="col-md-6 col-lg-6 col-xl-12">
                                    <div class="card m-b-20 box-shadow-note">
                                        <div class="card-body custom-padding-btop text-center">
                                            <span
                                                class="card-title font-20 mt-0 align-middle font-weight-bolder color-black-light text-center">{{$record->NI_identity_number}}</span>
                                        </div>
                                        <div class="card-body color-black-light">
                                            <p class="font-20 mt-0 align-middle">Created By:
                                                <strong>{{$record->business_name}} </strong></p>
                                            <p class="ard-title font-20 mt-0 align-middle">Type of record:
                                                <strong>{{$record->record_type}}</strong></p>
                                            <p class="ard-title font-20 mt-0 align-middle">Data created:
                                                <strong>{{date_format(date_create($record->time_stamp),'Y-m-d')}}</strong>
                                            </p>
                                            <span class="card-title font-20 mt-0 align-middle">Comments:</span>
                                            <div
                                                class="color-black-light font-20 pl-5 mt-3">{!! $record->RECORD_content !!}</div>
                                        </div>
                                    </div>

                                </div>
                            @else
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->
@endsection

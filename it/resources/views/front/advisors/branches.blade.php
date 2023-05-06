@extends('layouts.master-advisors')
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
                    <li class="breadcrumb-item"><a href="{{url('advisors/home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Direct Connect</a></li>
                </ol>
            </div>
            <h4 class="page-title">Learn about Business Branches</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body color-black-light">
                {!! $data !!}
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection


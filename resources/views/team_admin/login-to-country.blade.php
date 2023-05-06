@extends('layouts.master-team')
@section('css')
<style>
    .login_admin:hover{
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
                <li class="breadcrumb-item"><a href="{{route('team.home')}}">Convey</a></li>
                <li class="breadcrumb-item active"><a href="#">Login to Country</a></li>
            </ol>
        </div>
        <h4 class="page-title">Login to Country</h4>
    </div>
</div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
<div class="col-md-12">
    <div class="card m-b-20">
        <div class="card-body">
            <table id="tech-companies-1" class="table table-bordered table-striped m-t-40">
                <thead>
                    <tr>
                        <th class="text-center">Country</th>
                        <th class="text-center">Login</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $item)
                    <tr>
                        <td class="text-center p-2">{{$item['country_name']}}</td>
                        <td class="text-center p-2 login_admin" data-country="{{$item['country_code']}}">Login Now</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>
<!-- end row -->
@endsection

@section('script')
<script>
    $('.login_admin').on('click',function(){
        var country_code = $(this).data('country');

        window.open("{{url('/')}}/"+country_code+"/admin/login_redirect/{{$team_admin->name}}", "_blank");
    });
</script>
@endsection
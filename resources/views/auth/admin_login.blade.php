@extends('layouts.master-blank')
@section('css')
<style>
    body::-webkit-scrollbar {
        display: none;
    }
</style>
@endsection
@section('content')
<!-- Begin page -->
<div class="wrapper-page">

    <div class="card">
        <div class="card-body">

            <h3 class="text-center m-0">
                <!-- <a href="index.html" class="logo logo-admin"><img src="assets/images/logo-dark.png" height="20" alt="logo"></a> -->
                <a href="" class="logo"><img src="{{ URL::asset('assets/images/logo.png')}}" height="20" alt="logo"></a>
            </h3>

            <div class="p-3">
                <h4 class="font-18 m-b-5 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Sign in to continue to Convey.</p>

                <form class="form-horizontal m-t-30" action="{{route('login')}}" method="post">
                    @csrf
                    @if ($errors->has('name'))
                    <div class="col-sm-12 alert alert-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Warning!</strong> {{ $errors->first('name') }}
                    </div>
                    @endif
                    @if ($errors->has('email'))
                    <div class="col-sm-12 alert alert-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Warning!</strong> {{ $errors->first('email') }}
                    </div>
                    @endif
                    @if (session('captch_error'))
                        <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ session('captch_error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="name" placeholder="Enter username" required>
                    </div>
                    

                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password" required>
                    </div>
                    <img id="captcha" src="{{url('vendor')}}/securimage/securimage_show.php" alt="CAPTCHA Image" style="width: 100%;" />
                    <div class="form-group">
                        <input type="text" name="captcha_code" size="28" maxlength="6" required placeholder="Solve and enter the above sum" />
                        <a href="#" onclick="document.getElementById('captcha').src = '{{url('vendor')}}/securimage/securimage_show.php?' + Math.random(); return false" class="text-convey-green">Change Image</a>
                    </div>
                    <div class="form-group row m-t-20">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn bg-emerald text-white" type="submit">Log In</button>
                        </div>
                    </div>

                    
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
   setTimeout(function () {
        var body_h = $('.wrapper-page').height();
        var h = $(window).height();
        if(body_h < h){
            var p = (h-body_h)/2;
            $('.wrapper-page').css('margin-block',p+'px');
        }else{
            $('.wrapper-page').css('margin-block',0+'%');
        }
    },1000);
</script>
@endsection
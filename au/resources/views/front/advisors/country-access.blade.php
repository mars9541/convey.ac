@extends('layouts.master-advisors')
@section('css')
<style>
    .ion-edit:hover {
        cursor: pointer;
    }

    .card a:hover {
        color: #3BC850;
    }

    .active_country:hover {
        cursor: pointer;
    }

    .access_country:hover {
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
                    <li class="breadcrumb-item active"><a href="#">Country Access</a></li>
                </ol>
            </div>
            <h4 class="page-title">Country Access</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">
            <div class="card-body color-black-light">
                <p class="mb-0">
                    If you operate across different countries you will need a different account for each country. You can create those quickly by choosing which countries you want to operate in and activating an account for each one below.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title font-20 mt-0 text-center color-black-light">Activate Multiple Countries Now
                    @if(!$active_flag)
                    <span id="begin_bracket">(</span><a id="a_activate" href="javascript:activate_country()" style="color: #3BC850;">click here to activate</a><span id="end_bracket">)</span>
                    @endif
                </h4>
                <table id="tech-companies-1" class="table table-bordered table-striped m-t-10">
                    <thead>
                        <tr>
                            <th class="text-center">Country</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center p-2">{{$country_info->country_name}}</td>
                            <td class="text-center p-2">Logged In Now</td>
                        </tr>

                        @foreach($country_list as $item)

                            @if($item->country_name == 'Russia')
                                @continue;
                            @endif

                        <tr>
                            <td class="text-center p-2">{{$item->country_name}}</td>
                            @if($active_flag)
                                @if($item->user_id)
                                <td class="text-center p-2 access_country" data-user_id="{{$item->user_id}}" data-country="{{$item->country_code}}">
                                    Click To Access
                                </td>
                                @else
                                <td class="text-center p-2 active_country" data-user_id="" data-country="{{$item->country_code}}">
                                    Click To Activate
                                </td>
                                @endif
                            @else
                                <td class="text-center p-2 disable_access" data-country="{{$item->country_code}}">
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- container -->

</div> <!-- Page content Wrapper -->

@endsection

@section('script')
<script>
    var m_active_flag = false;
    function activate_country() {
        $.ajax({
            url:"{{route('settings.active_country')}}",
            method:"POST",
            data: {
            },
            dataType:"json",
            success:function(html){
                $('#begin_bracket').hide();
                $('#end_bracket').hide();
                $('#a_activate').hide();

                $( ".disable_access" ).each(function( index ) {
                    $(this).html('Click To Activate');
                    $(this).removeClass('disable_access');
                    $(this).addClass('active_country');
                });
            },
            error:function(){

            }
        })
    };

    function access_country(objCountry) {
        var country_code = objCountry.data('country');
        var user_id = objCountry.data('user_id');
        var url = "{{url('/')}}";
        url = url.substring(0, url.length - 2);

        window.open(url + country_code + "/login_redirect/" + user_id, "_blank");
    }

    function active_another_country(objCountry) {
        // var objCountry = $(this);
        var country_code = objCountry.data('country');

        objCountry.html('Activation in Progress');
        objCountry.removeClass('active_country');

        $.ajax({
            url:"{{route('settings.active_other_country')}}",
            method:"POST",
            data: {
                country_code: country_code
            },
            dataType:"json",
            success:function(html){
                objCountry.html('Click To Access');

                objCountry.addClass('access_country');
                objCountry.attr('data-user_id', html.user_id);
            },
            error:function(){
                objCountry.addClass('active_country');
            }
        })
    }

    $('.access_country').on('click', function() {
        access_country($(this));
    });

    $('.active_country').on('click', function() {
        if($(this).hasClass('access_country')) {
            access_country($(this));
        } else if($(this).hasClass('active_country')) {
            active_another_country($(this));
        } else {
            return true;
        }
    });

    $('.disable_access').on('click', function() {
        if($(this).hasClass('disable_access')) {
            return false;
        } else if($(this).hasClass('active_country')) {
            active_another_country($(this));
        } else if($(this).hasClass('access_country')) {
            access_country($(this));
        }
    });

</script>
@endsection

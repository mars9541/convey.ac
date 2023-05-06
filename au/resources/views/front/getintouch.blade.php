@extends('layouts.frontend-master')
@section('css')
    <style>
        .loading-show2 {
            display: inline-block;
        }

    </style>
@endsection
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Get In Touch & Lets Talk...</h2>
                        <span class="title-border-middle"></span>
                    </div>
                    <br>
                </div>
{{--                <form action="{{route('send_contact_message')}}" method="post">--}}
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore euismod magna.</p>   -->

                        </div>
                        @if (session('captch_error'))
                            <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ session('captch_error') }}
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="user_name" placeholder="Your Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" id="user_email" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" id="user_number" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="user_message" rows="3" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-1">
{{--                            <div style="border: 1px solid #ccc;height: 70px;width: 240px;display: flex;align-items: center;justify-content: center;margin-bottom: 25px;opacity: 0.7;font-size: 24px;text-transform: uppercase;letter-spacing: 2px;cursor: none;">Captcha</div>--}}
                            <img id="captcha" src="{{url('vendor')}}/securimage/securimage_show.php" alt="CAPTCHA Image" />
                            <input type="text" name="captcha_code" id="captcha_code" size="28" maxlength="6" required placeholder="Solve and enter the above sum" style="padding-inline:5px;" autocomplete="off"/>
                            <a href="#" onclick="document.getElementById('captcha').src = '{{url('vendor')}}/securimage/securimage_show.php?' + Math.random(); return false" class="text-convey-green">Change Image</a>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn bussiness-btn-larg" id="btn_send_message">
                                    <div style="display:none;" class="loading-show2">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                              aria-hidden="true"></span>
                                    </div> &nbsp;Send Message
                                </button>
{{--                                <a id="btn_send_message" style="color: white;" class="btn bussiness-btn-larg">Send Message</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
{{--                </form>--}}
                <div class="col-md-6">
                    <h4 style="line-height: 160%;">Our team are 100% human (no bots here) and always ready to answer your questions</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-sc">
                                <img src="{{asset('landing_front')}}/images/team/team-1.jpg">
                                <span>Jeanette</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-sc">
                                <img src="{{asset('landing_front')}}/images/team/team-2.jpg">
                                <span>Alisha</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-sc">
                                <img src="{{asset('landing_front')}}/images/team/team-3.jpg">
                                <span>James</span>
                            </div>
                        </div>
                    </div>
                    <p style="text-align: center;">Team members are available 9-4 Monday to Friday</p>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
    <div class="padding-top-large"></div>

    <div class="business-cta-2x">
        <div class="business-cta-2-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="business-cta-left-2">
                            <h2>A Quantum Leap Forward ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">UPGRADE NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
@endsection

@section('script')
    <script>
        $(document).on('input', '#user_name', function () {
            $('#user_name').css('box-shadow', '');
            $('#user_name').css('margin-bottom', '');
        });

        $(document).on('input', '#user_email', function () {
            $('#user_email').css('box-shadow', '');
            $('#user_email').css('margin-bottom', '');
        });

        $(document).on('input', '#user_message', function () {
            $('#user_message').css('box-shadow', '');
            $('#user_message').css('margin-bottom', '');
        });

        $(document).on('input', '#captcha_code', function () {
            $('#captcha_code').css('box-shadow', '');
            $('#captcha_code').css('margin-bottom', '');
        });

        $('#btn_send_message').on('click', function () {
            $('.loading-show2').show();
            $('#btn_send_message').prop('disabled', true);

            var error_flag = 0;

            if($('#user_name').val() == "") {
                $('#user_name').css('box-shadow', '0px 0px 4px red');
                $('#user_name').css('margin-bottom', '0px');
                error_flag = 1;
            } else {
                $('#user_name').css('box-shadow', '');
                $('#user_name').css('margin-bottom', '');
            }

            if($('#user_email').val() == "") {
                $('#user_email').css('box-shadow', '0px 0px 4px red');
                $('#user_email').css('margin-bottom', '0px');
                error_flag = 1;
            } else {
                $('#user_email').css('box-shadow', '');
                $('#user_email').css('margin-bottom', '');
            }

            if($('#user_message').val() == "") {
                $('#user_message').css('box-shadow', '0px 0px 4px red');
                $('#user_message').css('margin-bottom', '0px');
                error_flag = 1;
            } else {
                $('#user_message').css('box-shadow', '');
                $('#user_message').css('margin-bottom', '');
            }

            if($('#captcha_code').val() == "") {
                $('#captcha_code').css('box-shadow', '0px 0px 4px red');
                error_flag = 1;
            } else {
                $('#captcha_code').css('box-shadow', '');
            }

            if(error_flag == 1) {
                $('#btn_send_message').prop('disabled', false);
                $('.loading-show2').hide();
                $("html, body").animate({scrollTop: 0}, "slow");

                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{route('send_contact_message')}}",
                method: "POST",
                data: {
                    user_name: $('#user_name').val(),
                    user_email: $('#user_email').val(),
                    user_number: $('#user_number').val(),
                    user_message: $('#user_message').val(),
                    captcha_code: $('#captcha_code').val()
                },
                dataType: "json",
                success: function (res) {
                    $('.loading-show2').hide();
                    $('#btn_send_message').prop('disabled', false);

                    if(res.status == "Message Sent") {
                        $('#user_name').val('');
                        $('#user_email').val('');
                        $('#user_number').val('');
                        $('#user_message').val('');
                        $('#captcha_code').val('');

                        alertify.logPosition("bottom right");
                        alertify.success('Message Sent!');
                    } else {
                        alertify.logPosition("bottom right");
                        alertify.error(res.status);
                    }

                },
                error: function () {
                    $('.loading-show2').hide();
                    $('#btn_send_message').prop('disabled', false);
                    alertify.logPosition("bottom right");
                    alertify.error('Server Error!');
                }
            })
        })
    </script>
@endsection

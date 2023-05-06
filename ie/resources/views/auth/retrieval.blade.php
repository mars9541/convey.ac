@include('auth.header')
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{asset('front')}}/images/logo-dark.png" alt="logo"></a>
            </div>
            <div class="loginDetail">
                <div class="loginDetail-inner">
                    <h2>Recover Your Details</h2>
					<p id="description" class="p-3 text-left">If you’ve Forgotten Your Sign in details, just tell us what email address
                        you signup up with and we will email them to you</p>
                    <input type="email" class="form-control" placeholder="Enter Your Email ID" id="email_address">
                    <div class="remember">

                    </div>
                </div>
            </div>
            <div class="loginBottom">
				<a href="javascript:send_email()" class="btn btn-primary submitBtn">Recover</a>
            </div>
        </div>
    </div>
</section>

<script>
    function send_email()
    {
        if($('#email_address').val()!=""){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });
            $.ajax({
                url: "{{ route('send_password')}}",
                method: 'post',
                data: {
                email:$('#email_address').val(),
                },
                success: function(result){
                    $('#description').addClass('bg-convey-green text-white');
                    $('#description').html('We will check our database and if that email is associated with an account we will send your password to that email address …. Please allow 5 minutes for the email to arrive. ')
                }
            })
        } else {

        }

    }
</script>

@include('auth.header')
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{asset('front')}}/images/logo-dark.png" alt="logo"></a>
            </div>
            <div class="loginDetail">
                <div class="loginDetail-inner">
                    <h2>アカウント詳細の回復</h2>
					<p id="description" class="p-3 text-left">サインインの詳細を忘れた場合はサインインに使用したEメールアドレスをお知らせいただければ必要な詳細をこちらからEメールします。</p>
                    <input type="email" class="form-control" placeholder="EメールIDを入力してください" id="email_address">
                    <div class="remember">

                    </div>
                </div>
            </div>
            <div class="loginBottom">
				<a href="javascript:send_email()" class="btn btn-primary submitBtn">回復</a>
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
                    $('#description').html('データベースを確認します。送っていただいたEメールがお客様のアカウントと一致する場合はそちらにパスワードを送ります。5分ほどお待ちください。')
                }
            })
        } else {

        }

    }
</script>

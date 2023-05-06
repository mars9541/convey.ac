@include('auth.header')
<style>

.text-convey-green {
  color: #3bc850!important;
}
</style>
<section class="login">
        <div class="container login-container">
            <div class="loginPage loginForm">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('front')}}/images/logo-dark.png" alt="logo"></a>
                </div>
                <form action="{{route('login_user')}}" method="post">
                    @csrf
                <div class="loginDetail">
                    <div class="loginDetail-inner" style="max-width: 440px;">
                        <h2>S'IDENTIFIER</h2>
                        @if ($errors->has('email'))
                        <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Attention!</strong> {{ $errors->first('email') }}
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
						<select class="form-control" id="country" required>
                            <option value="">Sélectionnez votre pays</option>
							@foreach($country as $c)
                                @if($c->country_code == 'ru')
                                    @continue;
                                @endif
                            <option value="{{$c->country_code}}"{{app()->getLocale()==$c->country_code?'selected':''}}>{{$c->country_name}}</option>
                            @endforeach
						</select>
                        <input type="email" class="form-control" name="email" placeholder="Saisissez votre adresse e-mail" required value="{{old('email')}}">
						<input type="password" name="password" class="form-control" placeholder="Saisissez votre mot de passe">
                        <img id="captcha" src="{{url('vendor')}}/securimage/securimage_show.php" alt="CAPTCHA Image" />
                        <input type="text" name="captcha_code" size="28" maxlength="6" required placeholder="Résoudre et entrer la somme ci-dessus" style="padding-inline:5px;" autocomplete="off"/>
                        <a href="#" onclick="document.getElementById('captcha').src = '{{url('vendor')}}/securimage/securimage_show.php?' + Math.random(); return false" class="text-convey-green">Changer l'image</a>
                    </div>
                </div>
                <div class="loginBottom" style="width: 440px;">
					<button  class="btn btn-primary submitBtn">S'IDENTIFIER</button>
					<a href="{{route('login_retrieval')}}" class="clickhere text-convey-green" >Cliquez ici pour accéder à vos données</a>
                </div>
                </form>
            </div>
        </div>
    </section>
    <script>
    $('#country').change(function (){
            if($('#country').val()!=''){
                var locale = "{{app()->getLocale()}}";
                locale = "/" + locale + "/";
                var change_country_code = "/" + $('#country').val() + "/";
                var url = window.location.href;
                if($('#country').val() != locale){
                    var url = url.replace(locale, change_country_code);
                    window.location.href = url;
                }
            }
        })

    </script>
  </body>
</html>

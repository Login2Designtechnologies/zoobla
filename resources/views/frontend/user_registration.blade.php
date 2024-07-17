@extends('frontend.layouts.app')
    <style>
      .icon_seen i{width: 38px;font-size: 16px !important;display: flex;
  justify-content: center;align-items: center;}
  .toggle-password.fa-regular.fa-eye {
  height: 38px;
}
 .enter_your_email  {height: 42.2px;}
 .toggle-password.fa-regular.fa-eye {
  height: 42px;}
    </style>


@section('content')
 
    <section class="gry-bg py-6">

        <div class="profile login_page">

            <div class="container">

                <div class="row align-items-center">

                    <!-- Right Side Image -->

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 image_signup_page" style='background:url("{{ static_asset('assets/img/sign-up.jpeg') }}")'>

                        <!-- <img src="{{ uploaded_asset(get_setting('register_page_image')) }}" alt="" class="img-fit h-100"> -->
                        <div class="des_login" style="text-align: center;">
                            <div class="nice_login">Nice to see you agian</div>
                            <div class="wel_login">WELCOME TO ZOOBLA</div>
                            <div class="small_des_login">An Account Manager will be contacting you to finalize your service details and supervise the account set-up.</div>
                        </div>
                        
                    </div>

                    <!-- Left Side -->

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 dis_login_page">
                        <!-- Register form -->
                        <div class="pt-3 pt-lg-4">

                            <div class="fill_des_login">
                                  <!-- Titles -->
                                <div class="fill_des">
                                    <div class="text-center">
                                        <h1 class="welcome_write">{{ translate('WELCOME')}}</h1>
                                        <div class="welcome_line"></div>
                                        <div class="login_your_account">{{ translate('Create Your Account')}}</div>
                                    </div>
                                </div>

                                <form id="reg-form" class="form-default custom-form" role="form" action="{{ route('register') }}" method="POST">

                                    @csrf

                                    <!-- Name -->
                                    <div class="input-field-id d-flex">
                                        <div class="icon_user ">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <!-- <label for="name" class="fs-12 fw-700 text-soft-dark">{{  translate('Full Name') }}</label> -->

                                            <input type="text" id="firstname" class="enter_your_email{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Enter Your name') }}" name="name" oninput="validateNameInput(this);">

                                            @if ($errors->has('name'))

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>{{ $errors->first('name') }}</strong>

                                                </span>

                                            @endif

                                        <!-- <input type="text" id="enter_your_email" name="name" placeholder="Enter Your name" value=""> -->
                                    </div>
                                        <span id="errorname" class="error text-center" style="color:red;"></span>
                                        <div id="errorname" class="text-center" style="color:red;"></div>
                                    <!-- <div class="form-group">

                                        <label for="name" class="fs-12 fw-700 text-soft-dark">{{  translate('Full Name') }}</label>

                                        <input type="text" class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">

                                        @if ($errors->has('name'))

                                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $errors->first('name') }}</strong>

                                            </span>

                                        @endif

                                    </div> -->



                                    <!-- Email or Phone -->
                                    <div class="input-field-id d-flex">
                                        <div class="icon_user ">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                            @if (addon_is_activated('otp_system'))

                                            <div class="form-group phone-form-group mb-1">

                                                <label for="phone" class="fs-12 fw-700 text-soft-dark">{{  translate('Phone') }}</label>

                                                <input type="tel" id="phone-code" class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">

                                            </div>



                                            <input type="hidden" name="country_code" value="">


                                            
                                            <div class="form-group email-form-group mb-1 d-none">

                                                <label for="email" class="fs-12 fw-700 text-soft-dark">{{  translate('Email') }}</label>

                                                <input type="email" class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off">

                                                @if ($errors->has('email'))

                                                    <span class="invalid-feedback" role="alert">

                                                        <strong>{{ $errors->first('email') }}</strong>

                                                    </span>

                                                @endif

                                            </div>



                                            <div class="form-group text-right">

                                                <button class="btn btn-link p-0 text-primary" type="button" onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>

                                            </div>

                                            @else

                                                <div class="form-group mb-0">

                                                    <!-- <label for="email" class="fs-12 fw-700 text-soft-dark">{{  translate('Email') }}</label> -->

                                                    <input type="email" class="enter_your_email form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">

                                                    @if ($errors->has('email'))

                                                        <span class="invalid-feedback" role="alert">

                                                            <strong>{{ $errors->first('email') }}</strong>

                                                        </span>

                                                    @endif

                                                </div>

                                            @endif
                                        <!-- <input type="text" id="enter_your_email" name="email" placeholder="Enter Your Email" value=""> -->
                                    </div>
                                   
                                    <!-- password -->
                                    <div class="input-field-pd d-flex">
                                        <div class="icon_seen " >
                                            <i onclick="myFunction1()" toggle="#password" class="toggle-password fa-regular fa-eye-slash"></i>
                                            
                                        </div>
                                        <!-- <label for="password" class="fs-12 fw-700 text-soft-dark">{{  translate('Password') }}</label> -->

                                        <input type="password" class="enter_your_email {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password" id="password1">
                        
                                        <!-- <div class="text-right mt-1">

                                            <span class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>

                                        </div> -->

                                        @if ($errors->has('password'))

                                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $errors->first('password') }}</strong>

                                            </span>

                                        @endif
                                        <!-- <input type="text" id="enter_your_email" name="password" placeholder="Enter Password" value=""> -->
                                    </div>
                                    <!-- <div class="form-group">

                                        <label for="password" class="fs-12 fw-700 text-soft-dark">{{  translate('Password') }}</label>

                                        <input type="password" class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">

                                        <div class="text-right mt-1">

                                            <span class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>

                                        </div>

                                        @if ($errors->has('password'))

                                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $errors->first('password') }}</strong>

                                            </span>

                                        @endif

                                    </div> -->



                                    <!-- password Confirm -->

                                    <div class="input-field-pd d-flex">
                                        <div class="icon_seen ">
                                            <i onclick="myFunction2()" toggle="#password2" class="toggle-password fa-regular fa-eye-slash"></i>
                                            
                                        </div>
                                        <!-- <label for="password" class="fs-12 fw-700 text-soft-dark">{{  translate('Password') }}</label> -->

                                        <input type="password" class="enter_your_email {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation" id="confirm-password">
                        
                                        <!-- <input type="text" id="enter_your_email" name="password" placeholder="Enter Password" value=""> -->
                                    </div>


                                    <!-- <div class="form-group">

                                        <label for="password_confirmation" class="fs-12 fw-700 text-soft-dark">{{  translate('Confirm Password') }}</label>

                                        <input type="password" class="form-control rounded-0" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">

                                    </div> -->



                                    <!-- Recaptcha -->

                                    @if(get_setting('google_recaptcha') == 1)

                                        <div class="form-group">

                                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>

                                        </div>

                                        @if ($errors->has('g-recaptcha-response'))

                                            <span class="invalid-feedback" role="alert" style="display: block;">

                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>

                                            </span>

                                        @endif

                                    @endif



                                    <!-- Terms and Conditions -->
<!-- 
                                    <div class="mb-3">

                                        <label class="aiz-checkbox">

                                            <input type="checkbox" name="checkbox_example_1" required>

                                            <span class="">{{ translate('By signing up you agree to our ')}} <a href="{{ route('terms') }}" class="fw-500">{{ translate('terms and conditions.') }}</a></span>

                                            <span class="aiz-square-check"></span>

                                        </label>

                                    </div> -->



                                    <!-- Submit Button -->
                                    <div style="text-align: center;    padding-bottom: 6%;">
                                        <button type="submit" id="submitBtn" class="theme-btn theme-btn1  fw-semibold headbtn" style="width: 39%;background: #2290df;">{{  translate('Create Account') }}</button>
                                        <!-- <input class="theme-btn theme-btn1  fw-semibold headbtn" type="submit" name="Register" id="" style="width: 39%;background: #2290df;"> -->
                                    </div>

                                    <!-- <div class="mb-4 mt-4">

                                        <button type="submit" class="btn btn-lg btn-primary btn-block fw-700 fs-14 rounded-2">{{  translate('Create Account') }}</button>

                                    </div> -->

                                </form>

                                

                                <!-- Social Login -->

                                @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)

                                    <div class="text-center mb-3">

                                        <span class="bg-white fs-12 text-gray">{{ translate('Or Join With')}}</span>

                                    </div>

                                    <ul class="list-inline social colored text-center mb-4">

                                        @if (get_setting('facebook_login') == 1)

                                            <li class="list-inline-item">

                                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">

                                                    <i class="lab la-facebook-f"></i>

                                                </a>

                                            </li>

                                        @endif

                                        @if(get_setting('google_login') == 1)

                                            <li class="list-inline-item">

                                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">

                                                    <i class="lab la-google"></i>

                                                </a>

                                            </li>

                                        @endif

                                        @if (get_setting('twitter_login') == 1)

                                            <li class="list-inline-item">

                                                <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">

                                                    <i class="lab la-twitter"></i>

                                                </a>

                                            </li>

                                        @endif

                                        @if (get_setting('apple_login') == 1)

                                            <li class="list-inline-item">

                                                <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">

                                                    <i class="lab la-apple"></i>

                                                </a>

                                            </li>

                                        @endif

                                    </ul>

                                @endif
                                 <!-- Log In -->
                                 <div class="dont_account d-flex">
                                 <p class="fs-17 text-dark mb-0">{{ translate('You already have an account?')}}</p> <a href="{{ route('user.login') }}" class="crt_ac fs-17"  style="color: rgb(15, 64, 186);"><u>{{ translate('Login')}}</u></a> 
                                </div>

                                <!-- <div class="text-center">

                                    <p class="fs-12 text-gray mb-0">{{ translate('Already have an account?')}}</p>

                                    <a href="{{ route('user.login') }}" class="fs-14 fw-700 animate-underline-primary">{{ translate('Log In')}}</a>

                                </div> -->

                            </div>



                           

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>

@endsection





@section('script')

    @if(get_setting('google_recaptcha') == 1)

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @endif




    <script type="text/javascript">
   
   $(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  
//   var input = $($(this).attr("toggle"));
//   if (input.attr("type") == "password") {
//     input.attr("type", "text");
//   } else {
//     input.attr("type", "password");
//   }
});
function myFunction1() {
    var x = document.getElementById("password1");
    if (x.type == "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  function myFunction2() {
    var x = document.getElementById("confirm-password");
    if (x.type == "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

        @if(get_setting('google_recaptcha') == 1)

        // making the CAPTCHA  a required field for form submission

        $(document).ready(function(){

            $("#reg-form").on("submit", function(evt)

            {

                var response = grecaptcha.getResponse();

                if(response.length == 0)

                {

                //reCaptcha not verified

                    alert("please verify you are humann!");

                    evt.preventDefault();

                    return false;

                }

                //captcha verified

                //do the rest of your validations here

                $("#reg-form").submit();

            });

        });

        @endif

    </script>





    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {

        function validateNameInput(element, errorId) {
            var value = $(element).val();
            var isValid = /^[A-Za-z\s]+$/.test(value);

            if (!isValid) {
                $(element).val(value.replace(/[^A-Za-z\s]/g, ''));
            }

            $(errorId).text(isValid ? '' : 'Only alphabetic characters and spaces are allowed.');
            return isValid;
        }

        function enableDisableSubmitButton() {
            var isValidFirstName = validateNameInput('#firstname', '#errorname');

            var isFormValid = isValidFirstName;

            $('#submitBtn').prop('disabled', !isFormValid);
        }

        $('#firstname').on('input', function(event) {
            validateNameInput('#firstname', '#errorname');
            enableDisableSubmitButton();
        });

    });
</script>

       

@endsection


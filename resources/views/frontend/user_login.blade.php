@extends('frontend.layouts.app')



@section('content')
  <style>
     
    .inpu-field-check.col-sm-6 {
    justify-content: center !important;
    }
    .icon_seen i.fa-regular.fa-eye{
        display: none;
    }
    .icon_seen i.fa-regular.fa-eye{
        position: relative;
        top: 14px;
        font-size: 20px;
        padding: 16px 6px;
    }
  </style>

    <section class="gry-bg py-6">
        <div class="profile login_page">
            <div class="container">
                <div class='row align-items-center'>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 image_login_page">

                        <!-- <img src="{{ uploaded_asset(get_setting('login_page_image')) }}" alt="" class="img-fit h-100"> -->
                        <div class="des_login" style="text-align: center;">
                            <div class="nice_login">Nice to see you agian</div>
                            <div class="wel_login">WELCOME TO ZOOBLA</div>
                            <div class="small_des_login">An Account Manager will be contacting you to finalize your service details and supervise the account set-up.</div>
                        </div>

                    </div>

                    <!-- Left Side -->

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 dis_login_page">

                        <div class='fill_des_login'>
                            <!-- Titles -->
                            <div class="text-center">
                                 
                                <h1 class="welcome_write">{{ translate('Welcome')}}</h1>
                                <div class="welcome_line"></div>
                                <h5 class="login_your_account">{{ translate('Login Your Account')}}</h5>

                            </div>
                                

                            <!-- Login form -->

                            <div class="pt-3 pt-lg-4">

                                <div class="">

                                    <form class="form-default custom-form" role="form" action="{{ route('login') }}" method="POST">

                                        @csrf

                                        <!-- Email or Phone -->
                                        <div class="detail_add_for_login d-flex" style="flex-direction: column;">
                                            <div class="input-field-id d-flex">
                                            <div class="icon_user ">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            
                                            @if (addon_is_activated('otp_system'))

                                            <div class="form-group phone-form-group mb-1">

                                                <label for="phone" class="fs-12 fw-700 text-soft-dark">{{  translate('Phone') }}</label>

                                                <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} rounded-0" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">

                                            </div>



                                            <input type="hidden" name="country_code" value="">

                                            
                                    
                                            <div class="form-group email-form-group mb-0 d-none">

                                                <!-- <label for="email" class="fs-12 fw-700 text-soft-dark">{{  translate('Email') }}</label> -->

                                                <input type="email" class="enter_your_email form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('johndoe@example.com') }}" name="email" id="email" autocomplete="off">

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

                                                        <input type="email" class="enter_your_email form-control{{ $errors->has('email') ? ' is-invalid' : '' }} rounded-0" value="{{ old('email') }}" placeholder="{{  translate('johndoe@example.com') }}" name="email" id="email" autocomplete="off">

                                                        @if ($errors->has('email'))

                                                            <span class="invalid-feedback" role="alert">

                                                                <strong>{{ $errors->first('email') }}</strong>

                                                            </span>

                                                        @endif

                                                    </div>

                                                @endif
                                            </div>
                                            <div class="input-field-pd d-flex">
                                                <div class="icon_seen" onclick="myFunction1()">
                                                    <i class="fa-regular fa-eye-slash" ></i>
                                                    <i class="fa-regular fa-eye" ></i>
                                                </div>
                                                    <div class="form-group mb-0">
                                                        <!-- <label for="password" class="fs-12 fw-700 text-soft-dark">{{  translate('Password') }}</label> -->
                                                        <input type="password" class="passwrd enter_your_email form-control rounded-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                                    </div>
                                                    <!-- <input type="text" id="enter_your_email" name="password" placeholder="Enter Your Password"> -->
                                            </div>
                                        </div>
                                        

                                            

                                        <!-- password -->
                                        <!-- 
                                        <div class="form-group">

                                            <label for="password" class="fs-12 fw-700 text-soft-dark">{{  translate('Password') }}</label>

                                           
                                            <input type="password" class="form-control rounded-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">

                                        </div> -->

                                        <div class="col d-flex">
                                            <div class="inpu-field-check col-sm-6">
                                            <label class="aiz-checkbox">

                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <span class="fs-18">{{  translate('Remember Me') }}</span>

                                                <span class="aiz-square-check"></span>

                                            </label>
                                            </div>
                                            <div class="col-6 text-center">

                                                <a href="{{ route('password.request') }}" class="fs-16"><u>{{ translate('Forgot password?')}}</u></a>

                                            </div>
                                        </div>

                                        <!-- <div class="row mb-2">

                                            

                                            <div class="col-6">

                                                <label class="aiz-checkbox">

                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <span class="has-transition fs-12 fw-400 text-gray-dark hov-text-primary">{{  translate('Remember Me') }}</span>

                                                    <span class="aiz-square-check"></span>

                                                </label>

                                            </div>

                                             

                                            <div class="col-6 text-right">

                                                <a href="{{ route('password.request') }}" class="text-reset fs-12 fw-400 text-gray-dark hov-text-primary"><u>{{ translate('Forgot password?')}}</u></a>

                                            </div>

                                        </div> -->



                                        <!-- Submit Button -->
                                        <div class="col butn_login">
                                            <button type="submit" class="submit_login" style="text-align: center;">{{  translate('LOG IN') }}</button>
                                            <!-- <button class="submit_login" name="submit" style="text-align: center;">LOG IN</button> -->
                                        </div>

                                        <!-- <div class="mb-4 mt-4 text-center">

                                            <button type="submit" class="btn btn-lg btn-primary btn-block fw-700 fs-14 rounded-2">{{  translate('Login') }}</button>

                                        </div> -->

                                    </form>



                                    <!-- DEMO MODE -->

                                    @if (env("DEMO_MODE") == "On")

                                        <div class="mb-4">

                                            <table class="table table-bordered mb-0">

                                                <tbody>

                                                    {{-- <tr>

                                                        <td>{{ translate('Seller Account')}}</td>

                                                        <td>

                                                            <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>

                                                        </td>

                                                    </tr> --}}

                                                    <tr>

                                                        <td>{{ translate('Customer Account')}}</td>

                                                        <td>

                                                            <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>

                                                        </td>

                                                    </tr>

                                                    {{-- <tr>

                                                        <td>{{ translate('Delivery Boy Account')}}</td>

                                                        <td>

                                                            <button class="btn btn-info btn-sm" onclick="autoFillDeliveryBoy()">{{ translate('Copy credentials') }}</button>

                                                        </td>

                                                    </tr> --}}

                                                </tbody>

                                            </table>

                                        </div>

                                    @endif



                                    <!-- Social Login -->

                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)

                                        <div class="text-center mb-3">

                                            <span class="bg-white fs-12 text-gray">{{ translate('Or Login With')}}</span>

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

                                                    <a href="{{ route('social.login', ['provider' => 'apple']) }}"

                                                        class="apple">

                                                        <i class="lab la-apple"></i>

                                                    </a>

                                                </li>

                                            @endif

                                        </ul>

                                    @endif

                                </div>



                                <!-- Register Now -->
                                <div class="dont_account d-flex">
                                <p class="fs-17 text-dark mb-0">{{ translate('Dont have an account?')}}</p> <a href="{{ route('user.registration') }}" class="fs-17 fw-700 animate-underline-primary crt_ac" style="color: rgb(15, 64, 186);"><u>{{ translate('Create Account')}}</u></a> 
                                </div>

                                <!-- <div class="text-center">

                                    <p class="fs-12 text-gray mb-0">{{ translate('Dont have an account?')}}</p>

                                    <a href="{{ route('user.registration') }}" class="fs-14 fw-700 animate-underline-primary">{{ translate('Register Now')}}</a>

                                </div> -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @php

            // dd(get_active_country_codes());

        @endphp

    </section>

@endsection



@section('script')

    <script type="text/javascript">

        function autoFillSeller(){

            $('#email').val('seller@example.com');

            $('#password').val('123456');

        }



        function autoFillCustomer(){

            $('#email').val('customer@example.com');

            $('#password').val('123456');

        }

        

        function autoFillDeliveryBoy(){

            $('#email').val('deliveryboy@example.com');

            $('#password').val('123456');

        }

    </script>
   <script>
   function myFunction1() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
    $(".fa-regular.fa-eye-slash").hide();
    $(".fa-regular.fa-eye").show();
  } else {
    x.type = "password";
    $(".fa-regular.fa-eye").hide();
    $(".fa-regular.fa-eye-slash").show();
  }
}
</script>
   
@endsection


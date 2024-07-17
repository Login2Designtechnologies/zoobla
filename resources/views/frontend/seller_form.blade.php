@extends('frontend.layouts.app')

<style>
    input[type=number]:invalid, input[type=number]:out-of-range {
    /* border: 2px solid #ff6347; */
    text-align: left;
    border: 1px solid #ddd!important;
    }
    input[type=number]:invalid, input[type=number]:out-of-range {
    border: 2px solid #e1e1e1!important;
    }
    input.form-control.rounded-0 {
    text-align: start;
    }
</style>
<style>
    .fastname {
    margin-right: 16px;
    }
    .citystatecontry select.form-control {
    color: #848b92 !important;
    }
    .fill_des_login .citystatecontry {
    margin-top: 16px;
    }
    .fill_des_login .login_your_account{
    padding-bottom: 10px;
    }
    .contact-input input {
    margin-top: 16px;
    width: 100%;
    }
    .inputccc {
    margin-left: 7px;
    }
    .inputddd {
    margin-left: 14px;
    }
    .form-floating>.form-control,
    .form-floating>.form-control-plaintext,
    .form-floating>.form-select {
    height: calc(1.6rem + 2px);
    line-height: 1.25;
    }
    .nav-tabs {
    display: inline-block;
    border-bottom: none;
    /*padding-top: 15px;*/
    font-weight: bold;
    }
    .nav-tabs>li {
    float: none;
    }
    .nav-tabs>li>a,
    .nav-tabs>li>a:hover,
    .nav-tabs>li>a:focus,
    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:hover,
    .nav-tabs>li.active>a:focus {
    border: none;
    border-radius: 0;
    }
    .nav-list {
    margin-bottom: 25px;
    }
    .nav-list>li {
    /*padding: 20px 15px 15px;
    border-left: 1px solid #eee; */
    display: block;
    }
    /*.nav-list > li:last-child { border-right: 1px solid #eee; }*/
    .nav-list>li>a:hover {
    text-decoration: none;
    }
    .nav-list>li>a>span {
    display: block;
    font-weight: bold;
    text-transform: uppercase;
    }
    .mega-dropdown1 {
    position: relative;
    }
    .mega-dropdown-menu1 {
    padding: 0;
    text-align: center;
    width: 900px;
    }
    /*=======================*/
    /*.tab-content{background: goldenrod;}*/
    .nav-tabs>li {}
    .nav-tabs>li a {
    padding: 29px 23px;
    background: #31aff5;
    font-size: 15px;
    color: #fff
    }
    .nav-tabs>li.active>a {
    background: #31aff5;
    color: #fff;
    }
    .ht-tab.col-md-2 {
    padding: 0;
    }
    .ht-tab.col-md-10 {
    padding: 0;
    }
    .ht-ul {
    text-align: left;
    }
    /*.ht-ul hr{margin: 10px 0;}*/
    @media screen and (max-width: 1169px) {
    .nav-tabs {
    display: block;
    }
    .mega-dropdown-menu1 {
    width: 100%;
    }
    .nav>li,
    .mega-dropdown1,
    .dropdown1 {
    position: unset;
    }
    }
    @media screen and (max-width: 1023px) {
    .ht-tab.col-md-2,
    .ht-tab.col-md-10 {
    float: left !important;
    }
    .ht-tab.col-md-2 {
    width: 20%;
    }
    .ht-tab.col-md-10 {
    width: 80%;
    }
    .ht-ul {
    float: left;
    }
    }
    @media screen and (max-width: 767px) {}
    .sub-btnjj button {
    background: #1eb2e6;
    color: #fff;
    border: none;
    padding: 8px 16px;
    font-weight: 500;
    margin-top: 24px;
    }
    .text-blue {
    color: deepskyblue;
    border-bottom: 5px solid white;
    font-weight: 700;
    }
    .cloud_sub_contain {
    font-size: 3rem;
    font-weight: 500;
    color: white;
    line-height: 2;
    }
    .zoobla-process::before {
    content: "";
    position: absolute;
    top: 0;
    /* left: 1080px; */
    left: 79%;
    right: 0 !important;
    background-image: none;
    height: 100%;
    width: 100%;
    z-index: -1;
    background-repeat: no-repeat;
    }
    .bg-gray {
    background: #e2e2e54d;
    }
    .platform-image {
    margin: 45px;
    }
    .platform-image img {
    border-radius: 20px;
    }
    .platform-content {
    margin: 20px;
    }
    .bottom-border {
    border: 3px solid #2198e1;
    width: 70px;
    ;
    width: 70px;
    }
    .timer {
    color: red;
    font-weight: 700;
    font-size: 20px;
    padding: 7px;
    }
    .text {
    margin: 3px;
    }
    .menu_box {
    width: 60%;
    }
    .dropdown-content_zoobla {
    display: none !important;
    position: absolute !important;
    background-color: #ffffff;
    /*min-width: 160px;*/
    left: 21%;
    /*right: 10px;*/
    width: 50%;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);
    z-index: 1;
    }
    .header {
    position: fixed;
    display: block;
    /*top: 100px;*/
    left: 0;
    right: 0;
    z-index: 11;
    /* padding: 1rem 0; */
    }
    .color-header {
    top: 0px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    / Firefox /
    input[type=number] {
      -moz-appearance: textfield;
    }

</style>

@section('content')

<section class="login_page">

    <div class="container">

        <div class="row" style="align-items: center;">

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">

                <img src="{{asset('public/frontimage/zoobla_partner.jpeg')}}" alt="" style="max-width: 100%;">
                
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 dis_login_page">

                <div class="fill_des_login">

                    <div class="welcome_write">WELCOME</div>

                    <div class="welcome_line"></div>

                    <div class="login_your_account">Register Partner</div>

                    <form id="shop" class="" action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="name-input">

                            <div class="row w-100">

                                <div class="col-md-6">

                                    <input type="text" id="firstname" class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('First Name') }}" name="name" oninput="validateNameInput(this);">

                                    @if ($errors->has('name'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('name') }}</strong>

                                        </span>

                                    @endif

                                <span id="errorname" class="error" style="color:red;"></span>
                                 <div id="errorname"  style="color:red;"></div>

                                </div>

                                <div class="col-md-6">

                                    <input type="text" id="lastname" class="form-control rounded-0{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ old('lastname') }}" placeholder="{{  translate('Last name') }}" name="lastname" oninput="validateLastNameInput(this);">

                                    @if ($errors->has('lastname'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('lastname') }}</strong>

                                        </span>

                                    @endif
                                   
                                    <span id="errorlast" class="error" style="color:red;"></span>
                                    <div id="errorlast"  style="color:red;"></div>
                                </div>

                            </div>
                            
                        </div>

                        <div class="contact-input">

                            <div class="row w-100">

                                <div class="col-12">

                                    <input type="text"  id="mobilenumber"  class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="{{  translate('Number') }}" name="phone" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >

                                    @if ($errors->has('phone'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('phone') }}</strong>

                                        </span>

                                    @endif

                                </div>

                                <span id="error2" class="error" style="color:red;"></span>
                                 <div id="error2"  style="color:red;"></div>

                            </div>

                            <div class="row w-100">

                                <div class="col-12">

                                  <input type="email" id="email" class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" oninput="validateEmailInput(this);">

                                    @if ($errors->has('email'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('email') }}</strong>

                                        </span>

                                    @endif

                                     <span id="erroremail" class="error" style="color:red;"></span>
                                    <div id="erroremail"  style="color:red;"></div>

                                </div>

                            </div>

                            <div class="form-group" style="display:none;">

                                <label>{{ translate('Address')}} <span class="text-primary">*</span></label>

                                <input type="text" class="form-control mb-3 rounded-0{{ $errors->has('address') ? ' is-invalid' : '' }}" value="jaipur" placeholder="{{ translate('Address')}}" name="address">

                                <!-- value="{{ old('address') }}" -->

                                @if ($errors->has('address'))

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $errors->first('address') }}</strong>

                                    </span>

                                @endif

                            </div>

                            <div class="row w-100">

                                <div class="col-12">

                                    <input type="text" id="shopname" class="form-control rounded-0{{ $errors->has('shop_name') ? ' is-invalid' : '' }}" value="{{ old('shop_name') }}" placeholder="{{ translate('Company Name')}}" name="shop_name" oninput="validateShopInput(this);">

                                    @if ($errors->has('shop_name'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('shop_name') }}</strong>

                                        </span>

                                    @endif

                                     <span id="errorshop" class="error" style="color:red;"></span>
                                    <div id="errorshop"  style="color:red;"></div>

                                </div>

                            </div>

                        </div>

                         @php
                          $countries = DB::table('countries')->get();
                        @endphp

                        <div class="citystatecontry">

                            <div class="row w-100">

                                <div class="col-4">
                                    
                                    <select id="country-dd" name="country" class="form-control rounded-0" required="">
                                        
                                        <option value="">Select Country</option>
                                        
                                        @foreach ($countries as $country)
                                        
                                        <option value="{{$country->id}}">
                                            
                                                {{$country->name}}
                                                
                                        </option>
                                        
                                        @endforeach
                                    
                                    </select>
                                    
                                </div>

                                <div class="col-4">

                                    <select id="state-dd" name="state" class="form-control rounded-0" required=""> </select>

                                </div>

                                <div class="col-4">

                                        <select id="city-dd" name="city" class="form-control rounded-0" required="">  </select>

                                </div>

                            </div>

                        </div>
                       
                        <div class="row w-100">

                            <div class="col-12">

                                <div class="form-group mt-3">
                                    
                                    <input type="password" class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" placeholder="{{  translate('Password') }}" name="password" >

                                    @if ($errors->has('password'))

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $errors->first('password') }}</strong>

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                        <div class="contact-input">

                            <div class="row w-100">

                                <div class="col-12">

                                     <input type="password" class="form-control rounded-0" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation" >

                                </div>

                            </div>

                        </div>

                        <div class="partner-code-input d-none">

                            <div class="row w-100">

                                <div class="col-12">

                                     <input type="hidden" class="form-control rounded-0" placeholder="{{  translate('Partner Code') }}" name="partner_code" value="{{generate_partner_code()}}">

                                </div>

                            </div>

                        </div>

                        @if(get_setting('google_recaptcha') == 1)
 
                        <div class="form-group mt-2 mx-auto row">

                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>

                        </div>

                        @endif

                        <div class="row w-100">

                            <div class="col-12">

                                <div class="sub-btnjj mt-2 d-flex justify-content-end">

                                    <button id="submitBtn" type="submit" class="btn btn-primary fw-600 rounded-0">{{ translate('Submit')}}</button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection



@section('script')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#country-dd').on('change', function () {
            var country = this.value;
            $("#state-dd").html('<option value="">Loading...</option>'); // Show loading message

            $.ajax({
                url: "{{ route('states') }}",
                type: "POST",
                data: {
                    country: country,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dd').html('<option value="">Select State</option>');
                    $.each(result, function (key, value) {
                        $("#state-dd").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#city-dd').html('<option value="">Select City</option>');
                }
            });
        });

     $('#state-dd').on('change', function () {
    var state = this.value;
    $("#city-dd").html('<option value="">Loading...</option');

    $.ajax({
        url: "{{ route('cities') }}",
        type: "POST",
        data: {
            state: state,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function (res) {
            $('#city-dd').html('<option value="">Select City</option>');
            $.each(res, function (key, value) {
                $("#city-dd").append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
});
    });
</script>


<script type="text/javascript">

    // making the CAPTCHA  a  field for form submission

    $(document).ready(function(){

        $("#shop").on("submit", function(evt)

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

</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        function validateMobileNumber() {
            var mobilenumber = $('#mobilenumber').val();
            var isValid = /^\d{10}$/.test(mobilenumber);

            $('#error2').text(isValid ? '' : 'Number with exactly 10 digits is required.');
            return isValid;
        }

        function validateNameInput(element, errorId) {
            var value = $(element).val();
            var isValid = /^[A-Za-z\s]+$/.test(value);

            if (!isValid) {
                $(element).val(value.replace(/[^A-Za-z\s]/g, ''));
            }

            $(errorId).text(isValid ? '' : 'Only alphabetic characters and spaces are allowed.');
            return isValid;
        }

        function validateEmailInput() {
            var email = $('#email').val();
            var isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

            $('#erroremail').text(isValidEmail ? '' : 'Please enter a valid email address.');
            return isValidEmail;
        }

        function validateShopInput() {
            var value = $('#shopname').val();
            var isValid = /^[A-Za-z\s]+$/.test(value);

            if (!isValid) {
                $('#shopname').val(value.replace(/[^A-Za-z\s]/g, ''));
            }

            $('#errorshop').text(isValid ? '' : 'Only alphabetic characters and spaces are allowed for the shop name.');
            return isValid;
        }

        function enableDisableSubmitButton() {
            var isValidMobile = validateMobileNumber();
            var isValidFirstName = validateNameInput('#firstname', '#errorname');
            var isValidLastName = validateNameInput('#lastname', '#errorlast');
            var isValidEmail = validateEmailInput();
            var isValidShop = validateShopInput();

            var isFormValid = isValidMobile && isValidFirstName && isValidLastName && isValidEmail && isValidShop;

            $('#submitBtn').prop('disabled', !isFormValid);
        }

        $('#mobilenumber').on('input', function(event) {
            enableDisableSubmitButton();
        });

        $('#firstname').on('input', function(event) {
            validateNameInput('#firstname', '#errorname');
            enableDisableSubmitButton();
        });

        $('#lastname').on('input', function(event) {
            validateNameInput('#lastname', '#errorlast');
            enableDisableSubmitButton();
        });

        $('#email').on('input', function(event) {
            validateEmailInput();
            enableDisableSubmitButton();
        });

        $('#shopname').on('input', function(event) {
            validateShopInput();
            enableDisableSubmitButton();
        });
    });
</script>




@endsection


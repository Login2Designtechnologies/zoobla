@extends('frontend.layouts.app')



@section('content')

<style>
    .stripe-form-box {
         display: none;
    }

    #loader span, .opacity {
        position: fixed;
        width: 100%;
        height: 100%;
        left: 50%;
        transform: translate(-50%, -50%);
        top: 50%;
        z-index: 99;
        background: rgba(255,255,255,0.8);
    }
    #loader span:after {
        background: url(https://login2design.in/zoobla_staging/public/assets/img/loading-gif-png-4.gif);
        content: '';
        position: absolute;
        z-index: 9999;
        width: 200px;
        height: 200px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .modal-card{    
        width: 500px;
        background: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 20px rgb(174 166 166 / 50%);
        border-radius: 5px;
        max-width: 100%;
        margin: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
    .modal-card .modal-card-info{   
        padding: 50px 20px 30px;
        text-align: center;
    }
    .modal-card .modal-card-info p{    
        margin-bottom: 0px;    font-size: 18px;
        color: green;    font-weight: 600;
    }
    .modal-card .modal-card-info i{   
        font-size: 60px;
        margin-bottom: 15px;
        color: #008021;
    }
</style>

    <div id="loader" style="display: none;">
        <span></span>
    </div>

    <!-- The Modal -->
    <div class="modal-card" id="modal-card" style="display: none;">
        
        <div class="modal-card-info">

            <i class="fa fa-check-circle-o" aria-hidden="true"></i>

            <p id="payment-status"></p>

            <input type="hidden" id="Transaction_id" >

            <div class="btn-block mt-2">

                <button type="button" id="okButton" class="btn btn-primary fs-16 fw-700 rounded-2 px-5">OK</button>

            </div>

        </div>
        
    </div>

    <span class="opacity" id="opacity" style="display: none;"></span>

    <!-- Steps -->

    <section class="pt-5 mb-4">

        <div class="container">

            <div class="row">

                <div class="col-xl-8 mx-auto">

                    <div class="row gutters-5 sm-gutters-10">

                        <div class="col done">

                            <div class="text-center border border-bottom-6px p-2 text-success">

                                <i class="la-3x mb-2 las la-shopping-cart"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart') }}</h3>

                            </div>

                        </div>

                        <div class="col done">

                            <div class="text-center border border-bottom-6px p-2 text-success">

                                <i class="la-3x mb-2 las la-map"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('2. Shipping info') }}

                                </h3>

                            </div>

                        </div>

                        <div class="col done">

                            <div class="text-center border border-bottom-6px p-2 text-success">

                                <i class="la-3x mb-2 las la-truck"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('3. Delivery info') }}

                                </h3>

                            </div>

                        </div>

                        <div class="col active">

                            <div class="text-center border border-bottom-6px p-2 text-primary">

                                <i class="la-3x mb-2 las la-credit-card cart-animate" style="margin-right: -100px; transition: 2s;"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('4. Payment') }}</h3>

                            </div>

                        </div>

                        <div class="col">

                            <div class="text-center border border-bottom-6px p-2">

                                <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('5. Confirmation') }}

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- Payment Info -->

    <section class="mb-4">

        <div class="container text-left">

            <div class="row">

                <div class="col-lg-8">

                    <div class="card rounded-0 border shadow-none">

                        <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">

                            @csrf

                            <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                            
                             <input type="hidden" name="amount" value="{{get_bundle_discount()['total_amount']}}">

                             <input type="hidden" name="bundle_discount" value="{{get_bundle_discount()['bundle_discount']}}">

                            <!-- Additional Info -->

                            <div class="card-header p-4 border-bottom-0">

                                <h3 class="fs-16 fw-700 text-dark mb-0">

                                    {{ translate('Any additional info?') }}

                                </h3>

                            </div>

                            <div class="form-group px-4">

                                <textarea name="additional_info" rows="5" class="form-control rounded-0" placeholder="{{ translate('Type your text...') }}"></textarea>

                            </div>



                            <div class="card-header p-4 border-bottom-0">

                                <h3 class="fs-16 fw-700 text-dark mb-0">

                                    {{ translate('Select a payment option') }}

                                </h3>

                            </div>

                            <!-- Payment Options -->

                            <div class="card-body text-center px-4 pt-0">

                                <div class="row gutters-10">

                                    <!-- Paypal -->

                                    @if (get_setting('paypal_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="paypal" class="online_payment" type="radio"

                                                    name="payment_option" onclick=" Showstripe('paypal')" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/paypal.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Paypal') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif 

                                        <!--Stripe -->

                                    @if (get_setting('stripe_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="stripe" class="online_payment" type="radio" name="payment_option" onclick=" Showstripe('stripe')" >    

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/stripe.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Stripe') }}</span>

                                                    </span>

                                                </span>

                                            </label>
                                        
                                        </div>

                                    @endif

                                    <!-- Mercadopago -->

                                    @if (get_setting('mercadopago_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="mercadopago" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/mercadopago.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Mercadopago') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- sslcommerz -->

                                    @if (get_setting('sslcommerz_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="sslcommerz" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/sslcommerz.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('sslcommerz') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- instamojo -->

                                    @if (get_setting('instamojo_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="instamojo" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/instamojo.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Instamojo') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- razorpay -->

                                    @if (get_setting('razorpay') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="razorpay" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/rozarpay.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Razorpay') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- paystack -->

                                    @if (get_setting('paystack') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="paystack" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/paystack.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Paystack') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- voguepay -->

                                    @if (get_setting('voguepay') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="voguepay" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/vogue.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('VoguePay') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- payhere -->

                                    @if (get_setting('payhere') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="payhere" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/payhere.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('payhere') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- ngenius -->

                                    @if (get_setting('ngenius') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="ngenius" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/ngenius.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('ngenius') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- iyzico -->

                                    @if (get_setting('iyzico') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="iyzico" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/iyzico.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Iyzico') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- nagad -->

                                    @if (get_setting('nagad') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="nagad" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/nagad.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Nagad') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- bkash -->

                                    @if (get_setting('bkash') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="bkash" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/bkash.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Bkash') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- aamarpay -->

                                    @if (get_setting('aamarpay') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="aamarpay" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/aamarpay.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Aamarpay') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- authorizenet -->

                                    @if (get_setting('authorizenet') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="authorizenet" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/authorizenet.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Authorize Net') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- payku -->

                                    @if (get_setting('payku') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="payku" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/payku.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Payku') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- African Payment Getaway -->

                                    @if (addon_is_activated('african_pg'))

                                        <!-- flutterwave -->

                                        @if (get_setting('flutterwave') == 1)

                                            <div class="col-6 col-xl-3 col-md-4">

                                                <label class="aiz-megabox d-block mb-3">

                                                    <input value="flutterwave" class="online_payment"

                                                        type="radio" name="payment_option" checked>

                                                    <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                        <img src="{{ static_asset('assets/img/cards/flutterwave.png') }}"

                                                            class="img-fit mb-2">

                                                        <span class="d-block text-center">

                                                            <span

                                                                class="d-block fw-600 fs-15">{{ translate('flutterwave') }}</span>

                                                        </span>

                                                    </span>

                                                </label>

                                            </div>

                                        @endif

                                        <!-- payfast -->

                                        @if (get_setting('payfast') == 1)

                                            <div class="col-6 col-xl-3 col-md-4">

                                                <label class="aiz-megabox d-block mb-3">

                                                    <input value="payfast" class="online_payment" type="radio"

                                                        name="payment_option" checked>

                                                    <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                        <img src="{{ static_asset('assets/img/cards/payfast.png') }}"

                                                            class="img-fit mb-2">

                                                        <span class="d-block text-center">

                                                            <span

                                                                class="d-block fw-600 fs-15">{{ translate('payfast') }}</span>

                                                        </span>

                                                    </span>

                                                </label>

                                            </div>

                                        @endif

                                    @endif

                                    <!--paytm -->

                                    @if (addon_is_activated('paytm') && get_setting('paytm_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="paytm" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/paytm.jpg') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Paytm') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- toyyibpay -->

                                    @if (addon_is_activated('paytm') && get_setting('toyyibpay_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="toyyibpay" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/toyyibpay.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('ToyyibPay') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- myfatoorah -->

                                    @if (addon_is_activated('paytm') && get_setting('myfatoorah') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="myfatoorah" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                    <img src="{{ static_asset('assets/img/cards/myfatoorah.png') }}"

                                                        class="img-fit mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('MyFatoorah') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- khalti -->

                                    @if (addon_is_activated('paytm') && get_setting('khalti_payment') == 1)

                                        <div class="col-6 col-xl-3 col-md-4">

                                            <label class="aiz-megabox d-block mb-3">

                                                <input value="Khalti" class="online_payment" type="radio"

                                                    name="payment_option" checked>

                                                <span class="d-block aiz-megabox-elem p-3">

                                                    <img src="{{ static_asset('assets/img/cards/khalti.png') }}"

                                                        class="img-fluid mb-2">

                                                    <span class="d-block text-center">

                                                        <span

                                                            class="d-block fw-600 fs-15">{{ translate('Khalti') }}</span>

                                                    </span>

                                                </span>

                                            </label>

                                        </div>

                                    @endif

                                    <!-- Cash Payment -->

                                    @if (get_setting('cash_payment') == 1)

                                        @php

                                            $digital = 0;

                                            $cod_on = 1;

                                            foreach ($carts as $cartItem) {

                                                $product = get_single_product($cartItem['product_id']);

                                                if ($product['digital'] == 1) {

                                                    $digital = 1;

                                                }

                                                if ($product['cash_on_delivery'] == 0) {

                                                    $cod_on = 0;

                                                }

                                            }

                                        @endphp

                                        @if ($digital != 1 && $cod_on == 1)

                                            <div class="col-6 col-xl-3 col-md-4">

                                                <label class="aiz-megabox d-block mb-3">

                                                    <input value="cash_on_delivery" class="online_payment"

                                                        type="radio" name="payment_option" checked>

                                                    <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                        <img src="{{ static_asset('assets/img/cards/cod.png') }}"

                                                            class="img-fit mb-2">

                                                        <span class="d-block text-center">

                                                            <span

                                                                class="d-block fw-600 fs-15">{{ translate('Cash on Delivery') }}</span>

                                                        </span>

                                                    </span>

                                                </label>

                                            </div>

                                        @endif

                                    @endif

                                    @if (Auth::check())

                                        <!-- Offline Payment -->

                                        @if (addon_is_activated('offline_payment'))

                                            @foreach (get_all_manual_payment_methods() as $method)

                                                <div class="col-6 col-xl-3 col-md-4">

                                                    <label class="aiz-megabox d-block mb-3">

                                                        <input value="{{ $method->heading }}" type="radio"

                                                            name="payment_option" class="offline_payment_option"

                                                            onchange="toggleManualPaymentData({{ $method->id }})"

                                                            data-id="{{ $method->id }}" checked>

                                                        <span class="d-block aiz-megabox-elem rounded-0 p-3">

                                                            <img src="{{ uploaded_asset($method->photo) }}"

                                                                class="img-fit mb-2">

                                                            <span class="d-block text-center">

                                                                <span

                                                                    class="d-block fw-600 fs-15">{{ $method->heading }}</span>

                                                            </span>

                                                        </span>

                                                    </label>

                                                </div>

                                            @endforeach



                                            @foreach (get_all_manual_payment_methods() as $method)

                                                <div id="manual_payment_info_{{ $method->id }}" class="d-none">

                                                    @php echo $method->description @endphp

                                                    @if ($method->bank_info != null)

                                                        <ul>

                                                            @foreach (json_decode($method->bank_info) as $key => $info)

                                                                <li>{{ translate('Bank Name') }} -

                                                                    {{ $info->bank_name }},

                                                                    {{ translate('Account Name') }} -

                                                                    {{ $info->account_name }},

                                                                    {{ translate('Account Number') }} -

                                                                    {{ $info->account_number }},

                                                                    {{ translate('Routing Number') }} -

                                                                    {{ $info->routing_number }}</li>

                                                            @endforeach

                                                        </ul>

                                                    @endif

                                                </div>

                                            @endforeach

                                        @endif

                                    @endif

                                </div>

                                

                                <!-- Offline Payment Fields -->

                                @if (addon_is_activated('offline_payment'))

                                    <div class="d-none mb-3 rounded border bg-white p-3 text-left">

                                        <div id="manual_payment_description">



                                        </div>

                                        <br>

                                        <div class="row">

                                            <div class="col-md-3">

                                                <label>{{ translate('Transaction ID') }} <span

                                                        class="text-danger">*</span></label>

                                            </div>

                                            <div class="col-md-9">

                                                <input type="text" class="form-control mb-3" name="trx_id"

                                                    id="trx_id" placeholder="{{ translate('Transaction ID') }}"

                                                    required>

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label class="col-md-3 col-form-label">{{ translate('Photo') }}</label>

                                            <div class="col-md-9">

                                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                                    <div class="input-group-prepend">

                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">

                                                            {{ translate('Browse') }}</div>

                                                    </div>

                                                    <div class="form-control file-amount">{{ translate('Choose image') }}

                                                    </div>

                                                    <input type="hidden" name="photo" class="selected-files">

                                                </div>

                                                <div class="file-preview box sm">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endif



                                <!-- Wallet Payment -->

                                @if (Auth::check() && get_setting('wallet_system') == 1)

                                    <div class="py-4 px-4 text-center bg-soft-warning mt-4">

                                        <div class="fs-14 mb-3">

                                            <span class="opacity-80">{{ translate('Or, Your wallet balance :') }}</span>

                                            <span class="fw-700">{{ single_price(Auth::user()->balance) }}</span>

                                        </div>

                                        @if (Auth::user()->balance < $total)

                                            <button type="button" class="btn btn-secondary" disabled>

                                                {{ translate('Insufficient balance') }}

                                            </button>

                                        @else

                                            <button type="button" onclick="use_wallet()" class="btn btn-primary fs-14 fw-700 px-5 rounded-0">

                                                {{ translate('Pay with wallet') }}

                                            </button>

                                        @endif

                                    </div>

                                @endif

                            </div>

                        </form>

 
                        <!-- Agree Box -->

                        <div class="pt-3 px-4 fs-14">

                            <label class="aiz-checkbox">

                                <input type="checkbox" required id="agree_checkbox">

                                <span class="aiz-square-check"></span>

                                <span>{{ translate('I agree to the') }}</span>

                            </label>

                            <a href="{{ route('terms') }}" class="fw-700">{{ translate('terms and conditions') }}</a>,

                            <a href="{{ route('returnpolicy') }}" class="fw-700">{{ translate('return policy') }}</a> &

                            <a href="{{ route('privacypolicy') }}" class="fw-700">{{ translate('privacy policy') }}</a>

                        </div>

                        <div class="row stripe-form-box ">

                            <div class="col-lg-12">
                                
                                {{-- <div class="card rounded-0 border shadow-none">                             --}}

                                    <form action="{{route('checkout.process.payment')}}" id="payment-form">

                                        <h6 class="stripe-ttl">Credit/Debit Cards <img class="img-fluid" src="../public/assets/images/strip-img.jpg" alt=""></h6>       
                                        
                                        <div id="card-element" class="stripe-input-box"></div>

                                        <div id="card-errors" role="alert"></div>

                                        <button id="submit" class="btn btn-primary fs-14 fw-700 rounded-0 px-4 float-right" style="margin-top:10px !important">Pay Now</button>

                                    </form>

                                    <script src="https://js.stripe.com/v3/"></script>
                                
                                    <script>
                                        
                                        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

                                        const elements = stripe.elements();
                                        
                                        // Custom styling can be passed to options when creating an Element.
                                        const style = {
                                        base: {
                                            // Add your base input styles here. For example:
                                            fontSize: '16px',
                                            color: '#32325d',
                                        },
                                        };
                                        
                                        // Create an instance of the card Element.
                                        const card = elements.create('card', {style});
                                        
                                        // Add an instance of the card Element into the `card-element` <div>.
                                        card.mount('#card-element');
                                        
                                        // Create a token or display an error when the form is submitted.
                                        const form = document.getElementById('payment-form');

                                        form.addEventListener('submit', async (event) => {

                                        event.preventDefault();
                                        
                                        const {token, error} = await stripe.createToken(card);
                                        
                                        if (error) {
                                            // Inform the customer that there was an error.
                                            const errorElement = document.getElementById('card-errors');
                                            errorElement.textContent = error.message;
                                        } else {
                                            // Send the token to your server.
                                            stripeTokenHandler(token);
                                        }
                                        });

                                        const stripeTokenHandler = (token) => {

                                            // Show loader
                                            document.getElementById('loader').style.display = 'block';

                                            // Retrieve CSRF token from the page
                                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                            // Submit the form
                                            var xhr = new XMLHttpRequest();
                                            var url = '{{ route('checkout.process.payment') }}';  // Replace with your server endpoint
                                            
                                            var stripeToken = token.id;  // Replace with your token

                                            xhr.open('POST', url, true);
                                            xhr.setRequestHeader('Content-Type', 'application/json');
                                            
                                            // Set the CSRF token in the request header
                                            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                                            xhr.onreadystatechange = function () {
                                                if (xhr.readyState == 4) {

                                                     // Hide loader
                                                     document.getElementById('loader').style.display = 'none';

                                                    if (xhr.status == 200) {
                                                        var scatterSeries = [];
                                                        scatterSeries.push(xhr.responseText);
                                                        var response = JSON.parse(scatterSeries);

                                                        // Handle the server response as needed
                                                        console.log(response);

                                                        if (response.status = "success") {

                                                            document.getElementById('modal-card').style.display = 'block';

                                                            document.getElementById('payment-status').textContent  = 'Your payment successful';

                                                            document.getElementById('Transaction_id').value  = response.Transaction_id;

                                                            document.getElementById('opacity').style.display = 'block';

                                                        } else {

                                                            document.getElementById('modal-card').style.display = 'block';

                                                            document.getElementById('payment-status').textContent  = 'Your payment failed';

                                                            document.getElementById('opacity').style.display = 'block';

                                                            // alert('Payment failed: ' + response.error);
                                                        }
                                                    }
                                                    else {
                                                        // Handle errors if any
                                                        console.log('Error:', xhr.statusText);
                                                    }
                                                }
                                            };

                                            var data = JSON.stringify({
                                                stripeToken: stripeToken
                                            });

                                            xhr.send(data);
                                        };

                                        document.getElementById("okButton").addEventListener("click", function() {

                                            const Transaction_id = document.getElementById("Transaction_id").value;

                                            const form = document.getElementById('checkout-form');

                                            const hiddenInput = document.createElement('input');

                                            hiddenInput.setAttribute('type', 'hidden');

                                            hiddenInput.setAttribute('name', 'trx_id');

                                            hiddenInput.setAttribute('value', Transaction_id);

                                            form.appendChild(hiddenInput);


                                            submitOrder();

                                        });

                                        
                                    </script>

                                {{-- </div> --}}

                            </div>

                        </div>

                        <div class="row align-items-center pt-3 px-4 mb-4">

                            <!-- Return to shop -->

                            <div class="col-3 pt-4 d-flex justify-content-between align-items-center">

                                <a href="{{ route('home') }}" class="btn btn-link fs-14 fw-700 px-0">

                                    <i class="las la-arrow-left fs-16"></i>

                                    {{ translate('Return to Home') }}

                                </a>

                            </div>

                             <!-- Return back -->

                             <div class="col-md-3 pt-4 text-center text-md-left order-1 order-md-0">

                                <a href="#" class="btn btn-link fs-14 fw-700 px-0" onclick="history.back()">

                                    <i class="las la-arrow-left fs-16"></i>

                                    {{ translate('Go Back')}}
                                    
                                </a>

                             </div>

                            <!-- Complete Ordert -->

                            <div class="col-6 text-right hide-button">

                                <button type="button" onclick="submitOrder(this)"

                                    class="btn btn-primary fs-14 fw-700 rounded-0 px-4">{{ translate('Complete Order') }}</button>

                            </div>

                        </div>

                    </div>

                   
                </div>



                <!-- Cart Summary -->

                <div class="col-lg-4 mt-lg-0 mt-4" id="cart_summary">

                    @include('frontend.partials.cart_summary')

                </div>

            </div>

        </div>

    </section>

@endsection



@section('script')

    <script type="text/javascript">

        function Showstripe(getway) {

            if (getway == 'stripe') {
                
                $('.stripe-form-box').show();
                
                $('.hide-button').hide();

                $('#agree_checkbox').prop('checked', true);

            } else {
                
                $('.stripe-form-box').hide();
                
                $('.hide-button').show();
            }
      
        }
       
            

        $(document).ready(function() {

            $(".online_payment").click(function() {

                $('#manual_payment_description').parent().addClass('d-none');

            });

            toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));

        });



        var minimum_order_amount_check = {{ get_setting('minimum_order_amount_check') == 1 ? 1 : 0 }};

        var minimum_order_amount =

            {{ get_setting('minimum_order_amount_check') == 1 ? get_setting('minimum_order_amount') : 0 }};



        function use_wallet() {

            $('input[name=payment_option]').val('wallet');

            if ($('#agree_checkbox').is(":checked")) {

                ;

                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {

                    AIZ.plugins.notify('danger',

                        '{{ translate('You order amount is less then the minimum order amount') }}');

                } else {

                    $('#checkout-form').submit();

                }

            } else {

                AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');

            }

        }



        function submitOrder(el) {

            $(el).prop('disabled', true);

            if ($('#agree_checkbox').is(":checked")) {

                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {

                    AIZ.plugins.notify('danger',

                        '{{ translate('You order amount is less then the minimum order amount') }}');

                } else {

                    var offline_payment_active = '{{ addon_is_activated('offline_payment') }}';

                    if (offline_payment_active == '1' && $('.offline_payment_option').is(":checked") && $('#trx_id').val() == '') {

                        AIZ.plugins.notify('danger', '{{ translate('You need to put Transaction id') }}');

                        $(el).prop('disabled', false);

                    } else {

                        $('#checkout-form').submit();

                    }

                }

            } else {

                AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');

                $(el).prop('disabled', false);

            }

        }



        function toggleManualPaymentData(id) {

            if (typeof id != 'undefined') {

                $('#manual_payment_description').parent().removeClass('d-none');

                $('#manual_payment_description').html($('#manual_payment_info_' + id).html());

            }

        }



        $(document).on("click", "#coupon-apply", function() {

            var data = new FormData($('#apply-coupon-form')[0]);



            $.ajax({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                method: "POST",

                url: "{{ route('checkout.apply_coupon_code') }}",

                data: data,

                cache: false,

                contentType: false,

                processData: false,

                success: function(data, textStatus, jqXHR) {

                    AIZ.plugins.notify(data.response_message.response, data.response_message.message);

                    $("#cart_summary").html(data.html);

                }

            })

        });



        $(document).on("click", "#coupon-remove", function() {

            var data = new FormData($('#remove-coupon-form')[0]);



            $.ajax({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                method: "POST",

                url: "{{ route('checkout.remove_coupon_code') }}",

                data: data,

                cache: false,

                contentType: false,

                processData: false,

                success: function(data, textStatus, jqXHR) {

                    $("#cart_summary").html(data);

                }

            })

        })

    </script>
@endsection


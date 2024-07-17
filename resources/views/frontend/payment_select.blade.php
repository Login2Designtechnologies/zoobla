@extends('frontend.layouts.app') @section('content')

<style>
    .checkout-section {
        padding: 50px 0px;
        background-color: #f5f5f5;
        display: flex;
        flex-direction: column;
    }
    .checkout-section .card {
        border: 1px solid transparent;
        background: #fff;
    }
    #accordionExample .card .card-header {
        background: #fff;
        border-bottom: 1px solid transparent;
        position: relative;
    }
    #accordionExample .card .card-header input {
        position: absolute;
        margin-top: 25px;
        left: 10px;
    }
    .checkout-section .card .card-header span {
        padding-left: 20px;color:#000
    }
    .checkout-section .card-header .nav-item a {
        padding: 2px;
    }
    .checkout-section .card-header .nav-item a.active{border: 1px solid #1dbde8;}
    .checkout-section .card-header .or-sec {
        text-align: center;
        position: relative;
    }
    .checkout-section .card-header .or-sec span:after {
        position: absolute;
        content: "";
        top: 14px;
        height: 1px;
        width: 100%;
        background: #bdbdbd;
        left: 0px;
    }

    .checkout-sec > .ttl {
        font-weight: 600;
        margin-top: 10px;
        font-size: 18px;
    }
    .checkout-sec.contact label {
      font-size: 14px;
      font-weight: 500;
      font-family: "Segoe UI";
      color: #000;
  }
  .checkout-sec.contact .ttl span {
    float: right;
    font-size: 15px;
}
.checkout-sec.contact .ttl a{color: #1773b0 !important;
  text-decoration: underline;}
  .checkout-sec .form-control {
    height: 50px;
    margin-bottom: 10px;
}

.checkout-sec.delivery,
.checkout-sec.delivery .form-group {
    position: relative;
}
.checkout-sec.delivery .form-group label {
    position: absolute;
    top: 2px;
    left: 13px;
    font-size: 12px;
    color: #555;
    font-weight: 500;
    font-family: "Public Sans";
}
.checkout-sec.delivery .form-group select {
    appearance: auto;
    padding-top: 13px;
}
.checkout-sec.delivery .form-group .form-control {
    font-family: "Public Sans";
    font-size: 14px;
    font-weight: 500;
}
.checkout-sec.delivery .form-group .search-icon {
    position: absolute;
    right: 10px;
    z-index: 9999;
    top: 18px;
    color: #999;
}

.checkout-sec.delivery .form-group .checkbox-label {
    padding: 2px 10px;
    font-size: 14px;
    color: #000;
}

.checkout-sec .accordion {
    border: 1px solid #ddd;
    border-radius: 10px !important;
    overflow: hidden;
}
.checkout-section .card span {
    font-weight: 600;
}
.checkout-section .card .card-body {
    background: #eaeaea;
}
.checkout-section .card .card-body p {
    margin-bottom: 0px;
    text-align: center;
    font-weight: 600;
}
#accordionExample .btn {
    display: flex;
    width: 100%;
    background: transparent;
    border:1px solid #ddd;border-top-left-radius: 5px !important;border-top-right-radius: 5px !important;overflow: hidden
}
.checkout-section .card [aria-expanded="true"] {
    border: 2px solid #64bbe4 !important;
    border-radius: 10px 10px 0px 0px !important;
    background: #eef7ff;
}

.checkout-summary .media .img-wrap {
  position: relative;
  width: 80px;
  height: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #ddd;
  margin-right: 10px;
}

.checkout-summary .media .img-wrap .round-badge {
    position: absolute;
    top: -1px;
    right: -8px;
    width: 20px;
    height: 20px;
    background: #797979;
    color: #fff;
    text-align: center;
    line-height: 20px;
    font-size: 12px;
    border-radius: 50px;
}

.media-body p {
    font-size: 14px;
    line-height: 1.2;
    font-weight: 400;
}

.inline-form {
    margin-top: 10px;
}
.inline-form .form-control {
    height: 50px;
}
.apply-btn {
    border: 1px solid #ddd;
    border-radius: 10px;
    margin-left: 15px;
    background: #e5e5e5;
    height: 50px;
}

.checkout-summary-sec .col-4 p {
    font-weight: 600;line-height: 30px;font-size: 15px;
}
.row.justify-content-between .col p.mb-1{font-size: 14px;line-height: 24px;}
.btn-paypal {
    display: flex;
    justify-content: center;
    border: 1px solid #0d6efd;
    padding: 10px;
    border-radius: 10px;
    background: #0d6efd;
    color: #fff;
    text-decoration: none;
    margin-top: 10px;
}


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

.accordion .card .card-header h2.mb-0{width: 100%;}

.question-icon, .search-icons{
  position: absolute;
  top: 13px;
  right: 10px;
}

.paynow-btn{width: 100%;background: #1773b0 !important;
  width: 100%;
  padding: 15px 10px;
  font-family: "Segoe UI";
  font-size: 18px;
  font-weight: 500;display: flex;
  justify-content: center;}
  .paynow-btn:hover{background: #105989;}

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


.checkout-sec.method label{width: 100%;
  border: 1px solid #ddd;
  padding: 16px 10px;}

  .radio-label.checked {
    border-color: #007BFF !important; 
}

#address-box2 label{display:flex;width:100%;border: 1px solid #ddd;padding: 16px 10px;}
#address-box2 label span {flex: 1;}
#address-box2 label .icon{text-align: right;}
</style>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
@if (Auth::check())
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}"></script>
@endif

@php $country = DB::table('countries')->where('id' , $shipping_info->country_id)->first()->name ?? ''; 
$city = DB::table('cities')->where('id' , $shipping_info->city_id)->first()->name ?? '';
@endphp


<section class="checkout-section">
    <div id="preloader" style="display: none;">
      <div id="spinner"></div>
  </div>
  <div id="loader" style="display: none;">
    <span></span>
</div>
<div class="container">

    <div class="row">

        <div class="col-xl-8">

            <div class="card">

                <div class="card-header" style="background: transparent; display: flex; flex-direction: column;">
                    @if (Auth::check())
                    <h5 class="ttl">Choose the second option for Credit Card & ACH</h5>
                    <!-- Credit card form tabs -->

                    <ul role="tablist" class="nav nav-pills rounded nav-fill mb-3 row">

                        <li class="nav-item col-sm-6">

                            <a data-bs-toggle="pill" href="#paypal" class="nav-link active">
                                <img class="img-fluid w-100" src="{{asset('public/assets/img/paypal.jpg')}}" alt="" />

                            </a>

                        </li>

                        <li class="nav-item col-sm-6">

                            <a data-bs-toggle="pill" href="#credit-card" class="nav-link">
                                <!-- {{asset('public/assets/images/stripe.jpg')}} -->
                                <img class="img-fluid w-100" src="https://login2design.in/zoobla_staging/public/assets/img/stripe.jpg" alt="" />

                            </a>

                        </li>

                    </ul>
                    @endif


                    <div class="tab-content w-100">

                        <!-- Paypal info -->

                        <div id="paypal" class="tab-pane fade show active pt-3">
                            <form method="POST" action="{{route('user.guestuser')}}">
                                @csrf
                                <div class="checkout-sec contact">

                                    @if (Auth::check())
                                            <!-- <h4 class="ttl">

                                            Contact <span><a href="javascript:void(0)">Log in</a></span>

                                        </h4> -->
                                        @else
                                        <h4 class="ttl">

                                            Guest User <span><a href="{{route('user.login')}}">Log in</a></span>

                                        </h4>
                                        @endif

                                        <div class="form-group">

                                            @if (Auth::check())
                                            <input type="text"  value="{{ Auth::user()->email }}" class="form-control" placeholder="Email" />
                                            @else
                                            <input type="text"  name="email" class="form-control" placeholder="Email" />
                                            <span style="color:red">
                                                @if($errors->has('email'))
                                                <div class="error">{{ $errors->first('email') }}</div>
                                                @endif
                                            </span>
                                            @endif

                                        </div>


                                        <div class="form-group">

                                            <input type="checkbox" class="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked />


                                            <label for="vehicle1"> Email me with news & offers</label>

                                        </div>

                                    </div>


                                    <div class="checkout-sec delivery">

                                        <h4 class="ttl">Delivery</h4>

                                        <div class="row gx-2">

                                            <div class="col-lg-12">

                                                <div class="form-group">

                                                    <label for="">Country/Reglon</label>
                                                    @if (Auth::check())
                                                    <input type="text" class="form-control" value="{{$country}}" placeholder="country" />
                                                    @else
                                                    <input type="text" class="form-control" placeholder="country" />
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                   @if (Auth::check())
                                                   <input type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="First name" />
                                                   @else
                                                   <input type="text" class="form-control" placeholder="First name" />
                                                   @endif

                                               </div>

                                           </div>

                                           <div class="col-lg-6">

                                            <div class="form-group">

                                                <input type="text" class="form-control" value="" placeholder="Last name" />

                                            </div>

                                        </div>

                                        <div class="col-lg-12">

                                            <div class="form-group">
                                                @if (Auth::check())
                                                <input type="text" class="form-control" value="{{$shipping_info->address}}" placeholder="Address" />
                                                @else
                                                <input type="text" class="form-control" placeholder="Address" />
                                                @endif
                                                <span class="search-icons"><i class="fa fa-search"></i></span>

                                            </div>

                                        </div>

                                        <div class="col-lg-12">

                                            <div class="form-group">

                                                <input type="text" class="form-control" placeholder="Apartment, suite, etc. (optional)" />

                                            </div>

                                        </div>

                                        <div class="col-lg-4">

                                            <div class="form-group">

                                                @if (Auth::check())
                                                <input type="text" class="form-control" value="{{$city}}" placeholder="City" />
                                                @else
                                                <input type="text" class="form-control" placeholder="City" />
                                                @endif

                                            </div>

                                        </div>

                                        <div class="col-lg-4">

                                            <div class="form-group">

                                                @if (Auth::check())
                                                <input type="text" class="form-control" value="{{$country}}" placeholder="country" />
                                                @else
                                                <input type="text" class="form-control" placeholder="country" />
                                                @endif

                                            </div>

                                        </div>

                                        <div class="col-lg-4">

                                            <div class="form-group">

                                                @if (Auth::check())
                                                <input type="text" class="form-control" value="{{$shipping_info->postal_code}}" placeholder="ZIP code" />
                                                @else
                                                <input type="text" class="form-control" placeholder="ZIP code" />
                                                @endif

                                            </div>

                                        </div>

                                        <div class="col-lg-12">

                                            <div class="form-group">
                                                @if (Auth::check())
                                                <input type="text" class="form-control" value="{{$shipping_info->phone}}" placeholder="Phone" />
                                                @else
                                                <input type="text" class="form-control" placeholder="Phone" />
                                                @endif


                                                <span class="question-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>

                                            </div>

                                        </div>



                                    </div>

                                </div>


                                <div class="checkout-sec method">

                                    <h4 class="ttl">Billing address</h4>



                                    <label class="radio-label">
                                        <input type="radio" name="billingAddress" value="same" checked>
                                        Same as shipping address
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="billingAddress" value="different">
                                        Use a different billing address
                                    </label>

                                    <div id="billing-address" style="display:none">
                                        <div class="checkout-sec delivery">
                                            <h4 class="ttl">Billing address</h4>

                                            <div class="row gx-2">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="country" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="First name" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="" placeholder="Last name" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Address" />
                                                        <span class="search-icons"><i class="fa fa-search" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Apartment, suite, etc. (optional)" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="City" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="country" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="ZIP code" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Phone" />
                                                        <span class="question-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!Auth::check())
                                    <div class="btn-block">
                                        <!-- <a href="{{route('user.guestuser')}}" class="btn btn-sm paynow-btn w-100">Continue</a> -->
                                        <input type="submit" class="btn btn-sm paynow-btn w-100" name="Continue" value="Continue">
                                    </div>
                                    @endif


                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" name="check_out_btn" style="display: none;">Checkout</button>
                                    <div id="paypal-button-container" class="mt-3"></div>
                                </div>
                            </form>

                        </div>

                        <!-- End -->

                        <!-- credit card info -->
                        <div id="credit-card" class="tab-pane fade show pt">                            
                            <div id="address-box2">

                                <label class="radio-label">
                                    <input type="radio" name="newbillingAddress" value="samevalue" checked>
                                    <span>Credit card</span>
                                    <div class="icons">
                                        <img src="https://i.imgur.com/2ISgYja.png" width="30" alt="Credit card" />
                                        <img src="https://i.imgur.com/W1vtnOV.png" width="30" alt="Credit card" />
                                        <img src="https://i.imgur.com/35tC99g.png" width="30" alt="Credit card" />
                                        <img src="https://i.imgur.com/2ISgYja.png" width="30" alt="Credit card" />
                                    </div>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="newbillingAddress" value="differentvalue">
                                    <span>Ach</span>
                                    <div class="icons">
                                        <img src="{{asset('public/assets/img/ach-icon.png')}}" width="30" alt="Paypal" />
                                    </div>
                                </label>

                                <div id="same-address-form" class="address-form" style="display: block;">
                                    <h3>Credit card</h3>
                                    <div class="form-group">
                                        <form action="{{route('checkout.process.payment')}}" id="payment-form">
                                            <input id="ach-payment" type="hidden" name="payment_method" value="stripe"/>

                                            <input type="hidden" name="amount" value="{{$total}}">

                                            <input type="hidden" name="id" value="1">
                                            <h6 class="stripe-ttl">Credit/Debit Cards <img class="img-fluid" src="../public/assets/images/strip-img.jpg" alt=""></h6>       

                                            <div id="card-element" class="stripe-input-box"></div>

                                            <div id="card-errors" role="alert"></div>
                                            @if (!Auth::check())
                                            <div class="btn-block">
                                                <!-- <a href="{{route('user.guestuser')}}" class="btn btn-sm paynow-btn w-100">Continue</a> -->
                                                <input type="submit" class="btn btn-sm paynow-btn w-100" name="Continue" value="Continue">
                                            </div>
                                            @else
                                            <button id="submit" class="btn btn-primary fs-14 fw-700 rounded-0 px-4 float-right" style="margin-top:10px !important">Pay Now</button>
                                            @endif
                                        </form>

                                    </div>
                                </div>
                                <div id="different-address-form" class="address-form">
                                    <form action="{{route('checkout.process.payment')}}" method="post" id="ach_stripe">

                                       @csrf

                                       <input id="ach-payment" type="hidden" name="payment_method" value="stripe_ach"/>

                                       <input type="hidden" name="amount" value="{{$total}}">

                                       <input type="hidden" name="id" value="1">

                                       <div class="form-group">
                                        <div class="btn-block">
                                            @if (!Auth::check())
                                            <div class="btn-block">
                                                <!-- <a href="{{route('user.guestuser')}}" class="btn btn-sm paynow-btn w-100">Continue</a> -->
                                                <input type="submit" class="btn btn-sm paynow-btn w-100" name="Continue" value="Continue">
                                            </div>
                                            @else
                                            <button id="submit" class="btn btn-primary fs-14 fw-700 rounded-0 px-4 float-right" style="margin-top:10px !important">Pay Now</button>
                                            @endif
                                        </div>
                                    </div>
                                </form> 
                            </div>

                        </div>
                    </div> 
                    <!-- ./credit card info -->
                </div>
                <!-- End -->
            </div>

        </div>

    </div>

    @php

    $cart_detail = DB::table('cloude_service')->where('id', session::get('cloud_service_id'))->first();

    $coupon_discount = 0;

    @endphp

    @if (Auth::check() && get_setting('coupon_system') == 1)

    @php

    $coupon_code = null;

    @endphp



    @foreach ($carts as $key => $cartItem)

    @php

    $product = get_single_product($cartItem['product_id']);

    @endphp

    @if ($cartItem->coupon_applied == 1)

    @php

    $coupon_code = $cartItem->coupon_code;

    break;

    @endphp

    @endif

    @endforeach



    @php

    $coupon_discount = carts_coupon_discount($coupon_code);

    @endphp

    @endif

    @php $subtotal_for_min_order_amount = 0; @endphp

    @foreach ($carts as $key => $cartItem)

    @php $subtotal_for_min_order_amount += cart_product_price($cartItem, $cartItem->product, false, false) * $cartItem['quantity']; @endphp

    @endforeach

    @if (get_setting('minimum_order_amount_check') == 1 && $subtotal_for_min_order_amount < get_setting('minimum_order_amount'))

    <span class="badge badge-inline badge-primary fs-12 rounded-0 px-2">

        {{ translate('Minimum Order Amount') . ' ' . single_price(get_setting('minimum_order_amount')) }}

    </span>

    @endif


    <div class="col-xl-4 d-flex">
        @php

        $subtotal = 0;

        $tax = 0;

        $shipping = 0;

        $product_shipping_cost = 0;

        $shipping_region = $shipping_info['city'];

        @endphp
        <div class="checkout-summary w-100">
            <div class="checkout-summary-sec">
                <div class="card-body pt-0">
                    <div class="overflowScroll">
                        @foreach ($carts as $key => $cartItem)    

                        @php

                        $product = get_single_product($cartItem['product_id']);


                        $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                        $tax += cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];

                        $product_shipping_cost = $cartItem['shipping_cost'];



                        $shipping += $product_shipping_cost;



                        $product_name = $product->getTranslation('name');



                        @endphp

                        <div class="row  justify-content-between">
                            <div class="col-auto col-md-8">
                                <div class="media d-flex flex-sm-row">
                                    <div class="img-wrap">
                                        <img class="img-fluid" src="{{uploaded_asset($product->thumbnail_img)}}" width="62" height="62">
                                        <span class="round-badge">{{$cartItem['quantity']}}</span>
                                    </div>                                
                                    <div class="media-body my-auto">
                                        <div class="row ">
                                            <div class="col-auto"><p class="mb-0"><b>{{$product_name}}</b></p><small class="text-muted">
                                                @if ($cartItem['variant'] != null) 

                                                {{$cartItem['variant'];}}

                                                @endif
                                            </small></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" pl-0 flex-sm-col col-auto  my-auto "><p><b>{{ single_price(cart_product_price($cartItem, $cartItem->product, false, false) * $cartItem['quantity']) }}</b></p></div>
                        </div>


                        @endforeach 

                        @php

                        if(auth()->check()) {
                            $user_id = auth()->user()->id;
                        } else {
                            $user_id = request()->ip();
                        }

                        $cloud = DB::table('cloude_service')->where('user_id', $user_id)->where('payment_status', 0)->first();
                        @endphp
                        @if(isset($cloud) && $cloud !== null)
                        <!--  -->
                        <div class="item{{$cartItem['id']}}">

                            <li class="list-group-item px-0">

                                <h6 class="cloud-ttl">Cloud Service </h6>

                            </li>

                            <li class="list-group-item px-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>{{ translate('Product')}}</th>
                                            <th>{{ translate('qty')}}</th>
                                            <th>{{ translate('Duration')}}</th>
                                            <th>{{ translate('total')}}</th>
                                        </tr>
                                        @foreach(json_decode($cloud->camera_detail) as  $value)

                                        @if($value->qty == '0' || $value->qty == null)

                                        @continue

                                        @endif
                                        <tr>
                                            <td>{{$value->cam_name}}</td>
                                            <td>{{$value->qty}}</td>
                                            <td>{{$cloud->storage_duration}} Days</td>
                                            <td>{{single_price($value->qty * $value->cam_price)}}</td>
                                        </tr>
                                        @endforeach

                                        <input type="hidden" value="{{$cloud->amount}}" id="cloudeamount">
                                    </table>
                                </div>
                            </li>


                        </div>
                        <!-- ./ -->

                        @endif      
                        @if (Auth::check() && get_setting('coupon_system') == 1)

                        @if ($coupon_discount > 0 && $coupon_code)

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="inline-form d-flex align-items-center">

                                    <form class="" id="remove-coupon-form" enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-control">{{ $coupon_code }}</div>

                                        <button type="button" id="coupon-remove" class="btn btn-primary">{{ translate('Change Coupon') }}</button>

                                    </form>

                                </div>

                            </div>

                        </div>

                        @else

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="inline-form d-flex align-items-center">

                                    <form class="" id="remove-coupon-form" enctype="multipart/form-data">

                                        @csrf

                                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">

                                        <input type="text" class="form-control rounded-0" name="code" onkeydown="return event.key != 'Enter';" placeholder="{{ translate('Have coupon code? Apply here') }}" required>

                                        <button type="button" id="coupon-apply" class="btn apply-btn  px-4">{{ translate('Apply') }}</button>

                                    </form>

                                </div>

                            </div>

                        </div>

                        @endif

                        @endif

                    </div>
                    <div class="row ">
                        <div class="col">
                            <div class="row justify-content-between">
                                <div class="col-4"><p class="mb-1">Subtotal</p></div>
                                <div class="flex-sm-col col-auto"><p class="mb-1"><b>
                                    @if(isset($cart_detail) && $cart_detail !== null)

                                    {{ single_price($subtotal+$cart_detail->amount) }}

                                    @else

                                    {{ single_price($subtotal) }}

                                @endif</b></p></div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col"><p class="mb-1">Shipping <i class="fa fa-question-circle" aria-hidden="true"></i></p></div>
                                <div class="flex-sm-col col-auto"><p class="mb-1">{{$shipping_info->address}},{{$city}},{{$country}},{{$shipping_info->postal_code}}</p></div>
                            </div>

                            <div class="row justify-content-between">

                                <div class="col">

                                    <p class="mb-1">Tax <i class="fa fa-question-circle" aria-hidden="true"></i></p>

                                </div>

                                <div class="flex-sm-col col-auto"><p class="mb-1">{{ single_price($tax) }}</p></div>

                            </div>

                            @php

                            if(isset($cart_detail) && ($cart_detail != null)){

                                $bundle_descount = get_bundle_discount($carts ,$subtotal, $cart_detail->amount)['bundle_discount'];
                                // dd($bundle_descount);
                            }else{

                                $bundle_descount = get_bundle_discount($carts ,$subtotal,null)['bundle_discount'];
                                // dd($bundle_descount);
                            }

                            @endphp

                            <div class="row justify-content-between">

                                <div class="col">

                                    <p class="mb-1">{{ translate('Bundle Discount')}} <i class="fa fa-question-circle" aria-hidden="true"></i></p>

                                </div>

                                <div class="flex-sm-col col-auto"><p class="mb-1">{{ single_price($bundle_descount) }}</p></div>

                            </div>

                            <div class="row justify-content-between">

                                <div class="col">

                                    <p class="mb-1">{{ translate('Total Shipping') }} <i class="fa fa-question-circle" aria-hidden="true"></i></p>

                                </div>

                                <div class="flex-sm-col col-auto"><p class="mb-1">{{ single_price($shipping) }}</p></div>

                            </div>

                            @php

                            if(isset($cart_detail) && ($cart_detail != null)){
                                $total = ($total+$cart_detail->amount) -$bundle_descount;
                            }else{
                                $total = $total - $bundle_descount;
                            }

                            @endphp

                            <div class="row justify-content-between">

                                <div class="col-4">

                                    <p><b>Total</b></p>

                                </div>

                                <div class="flex-sm-col col-auto">

                                    <p class="mb-1">USD<b>{{single_price($total) }}</b></p>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


</div>

</div>
</section>

@endsection 

@section('script')

<script>
    $(document).ready(function() {
        $('input[name="billingAddress"]').change(function() {
            $('.radio-label').removeClass('checked');
            if ($(this).val() === 'different') {
                $('#billing-address').slideDown();
            } else {
                $('#billing-address').slideUp();
            }
            $(this).closest('label').addClass('checked');
        });

    // Trigger the change event on page load to set the initial state
        $('input[name="billingAddress"]:checked').trigger('change');
    });
</script>

<script>
    $(document).ready(function() {
        $('#address-box2 input[name="newbillingAddress"]').change(function() {
            $('.radio-label').removeClass('checked');
            if ($(this).val() === 'differentvalue') {
                $('#different-address-form').slideDown();
                $('#same-address-form').slideUp();
            } else {
                $('#same-address-form').slideDown();
                $('#different-address-form').slideUp();
            }
            $(this).closest('label').addClass('checked');
        });

        // Trigger the change event on page load to set the initial state
        $('#address-box2 input[name="newbillingAddress"]:checked').trigger('change');
    });
</script>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    function resultMessage(message) {
        const container = document.querySelector("#result-message");
    // Uncomment the following line to display the message in the container
    // container.innerHTML = message;
        console.log(message);
    }

    paypal.Buttons({
      onClick(){

      //    $('.text-danger').remove();
      //    var counter = 0;
      //    if ($("#name").val() == "") {
      //       $("#name").after('<span class="text-danger">Name is required</span>');
      //       counter++;
      //    }
      //    if ($("#phone").val() == "") {
      //       $("#phone").after('<span class="text-danger">Phone is required</span>');
      //       counter++;
      //    }
      //    if ($("#email").val() == "") {
      //       $("#email").after('<span class="text-danger">Email is required</span>');
      //       counter++;
      //    }
      //    if ($("#address").val() == "") {
      //       $("#address").after('<span class="text-danger">Address is required</span>');
      //       counter++;
      //    }
      //    if ($("#pincode").val() == "") {
      //       $("#pincode").after('<span class="text-danger">Pincode is required</span>');
      //       counter++;
      //    }
      //    if ($("#city").val() == "") {
      //       $("#city").after('<span class="text-danger">City is required</span>');
      //       counter++;
      //    }

      //    if (counter > 0) {
      //       return false;
      //    }else{
      //       return true;
      //    }
      },

      createOrder: (data, actions)=> {

       return actions.order.create({
        purchase_units:[{
         amount:{
          value: "{{$total}}",
          currency_code: 'USD'
      }
  }]
    });
   },
   onApprove: (data, actions)=> {

       return actions.order.capture().then(function(orderData){
        const transaction = orderData.purchase_units[0].payments.captures[0];
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var pincode = $("#pincode").val();
        var productSummary = $("#product_summary").val();

        var formData = {
         '_token': '{{ csrf_token() }}',
         'name' : name,
         'email' : email,
         'phone': phone,
         'address' : address,
         'city' : city,
         'pincode' : pincode,
         'product_summary' : productSummary,
         'transaction_id' : transaction.id,
         'payment_status' : transaction.status,
         'check_out_btn' : true,
         'amount' : transaction.amount.value,
         'currency_code' : transaction.amount.currency_code,
         'create_time' : transaction.create_time
     };
     $('#preloader').css('display', 'block');
     $.ajax({
         method: "POST",
         url: "{{route('payment.checkout_paypal')}}",
         data: formData,
         success:function(response){
          if (response=="success") {
           window.location.href = "/zoobla_staging/dashboard";
       }else{
           window.location.href="/";
       }
   }
});
 });
   }
}).render('#paypal-button-container');

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();

        const style = {
            base: {
                fontSize: '16px',
                color: '#32325d',
            },
        };

        const card = elements.create('card', {style});
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            const errorElement = document.getElementById('card-errors');
            if (event.error) {
                errorElement.textContent = event.error.message;
            } else {
                errorElement.textContent = '';
            }
        });

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {token, error} = await stripe.createToken(card);

            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                stripeTokenHandler(token);
            }
        });

        const stripeTokenHandler = (token) => {
            document.getElementById('loader').style.display = 'block';

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var xhr = new XMLHttpRequest();
            var url = '{{ route('checkout.process.payment') }}' + '/{{$total}}' + '/stripe';

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    document.getElementById('loader').style.display = 'none';

                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);

                        document.getElementById('modal-card').style.display = 'block';
                        document.getElementById('opacity').style.display = 'block';

                        if (response.status === "success") {
                            document.getElementById('payment-status').textContent = 'Your payment was successful';
                            document.getElementById('Transaction_id').value = response.Transaction_id;
                        } else {
                            document.getElementById('payment-status').textContent = 'Your payment failed';
                        }
                    } else {
                        console.log('Error:', xhr.statusText);
                    }
                }
            };

            var data = JSON.stringify({ stripeToken: token.id });
            xhr.send(data);

                // Reset the card element for a new submission
            card.clear();
        };
    });
</script>


@endsection
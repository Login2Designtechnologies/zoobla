<style>
   .subscribe .ttl{color:#fff;font-weight:700;font-size:2rem;}
   .subscribe .sub-ttl{color:#fff;margin-bottom: 40px;
  margin-top: 24px;}

 .footer .foote_logo .menu-item-object-page{line-height:32px}
 .list-inline.social li a{display: flex;
  justify-content: center;
  align-items: center;}
</style>

<!-- Subscribe Section  -->
<section class="subscribe">
    <div class="container">
        <div class="row text-center subscribe-box text-center pt-3 mt-2 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
            <div class="col-lg-12">
                
                <h2 class="ttl">{{ translate('Get Our Newsletter') }}</h2>
                <h5 class="sub-ttl">Want the latest and greatest from our blog straight to your inbox ?<br> Check us your details and get a sweet weekly mail.</h2>
                <!-- <h5 class="sub-ttl">
                    {!! get_setting('about_us_description',null,App::getLocale()) !!}
                </h5> -->
                <div class="mb-3">
                    <form method="POST" class="form-subscribe" action="{{ route('subscribers.store') }}">
                        @csrf
                        <div class="row gutters-10">
                            <div class="input-group">
                                <input type="email" class="form-control input-lg" placeholder="{{ translate('Your Email Address') }}" name="email" required>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-success btn-lg">{{ translate('Subscribe') }}</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Subscribe Section  -->

<!-- footer Description -->
@if (get_setting('footer_title') != null || get_setting('footer_description') != null)
    <section class="bg-light border-top border-bottom mt-auto">
        <div class="container py-4">
            <h1 class="fs-18 fw-700 text-gray-dark mb-3">{{ get_setting('footer_title',null, get_system_language()->code) }}</h1>
            <p class="fs-13 text-gray-dark text-justify mb-0">
                {!! nl2br(get_setting('footer_description',null, get_system_language()->code)) !!}
            </p>
        </div>
    </section>
@endif

@php
    $col_values = ((get_setting('vendor_system_activation') == 1) || addon_is_activated('delivery_boy')) ? "col-lg-3 col-md-6 col-sm-6" : "col-md-4 col-sm-12 col-lg-2 footer-wrapperss";
@endphp
<section class="footer">
    <svg class="footer-wave-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100" preserveAspectRatio="none">
        <path class="footer-wave-path" d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z"></path>
    </svg>
    <!-- footer widgets ========== [Accordion Fotter widgets are bellow from this]-->
    <div class="container ftry">
        <div class="row">
            <!-- footer logo -->
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="foote_logo">
                    <a href="{{ route('home') }}" class="d-block">
                        @if(get_setting('footer_logo') != null)
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" width="60%">
                        @else
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" width="60%">
                        @endif
                    </a>
                </div>
                <div class="about_footer">
                    <p>{!! get_setting('about_us_description',null,App::getLocale()) !!}</p>
                </div> 
                <ul class="list-inline social colored mb-4">
                        <li class="list-inline-item ml-2 mr-2">
                            <a href="https://www.facebook.com/" target="_blank"
                                class="facebook"><i class="lab la-facebook-f"></i></a>
                        </li>
                        <li class="list-inline-item ml-2 mr-2">
                            <a href="https://www.instagram.com/" target="_blank"
                                class="instagram"><i class="lab la-instagram"></i></a>
                        </li>
                        <li class="list-inline-item ml-2 mr-2">
                            <a href="https://in.linkedin.com/" target="_blank"
                                class="linkedin"><i class="lab la-linkedin-in"></i></a>
                        </li>
                        <li class="list-inline-item ml-2 mr-2">
                            <a href="https://twitter.com/" target="_blank"
                                class="twitter"><i class="lab la-twitter"></i></a>
                        </li>
                </ul>
            </div>
            <!-- Quick links -->
            <div class="{{ $col_values }}">
                <div class="foote_logo mt-4">
                    <h5>
                        {{ get_setting('widget_one',null,App::getLocale()) }}
                    </h5>
                    <ul class="list-unstyled">
                        @if ( get_setting('widget_one_labels',null,App::getLocale()) !=  null )
                            @foreach (json_decode( get_setting('widget_one_labels',null,App::getLocale()), true) as $key => $value)
                            @php
								$widget_one_links = '';
								if(isset(json_decode(get_setting('widget_one_links'), true)[$key])) {
									$widget_one_links = json_decode(get_setting('widget_one_links'), true)[$key];
								}
							@endphp
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="{{ $widget_one_links }}">
                                    {{ $value }}
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Services -->
            <div class="col-md-4 col-sm-12 col-lg-2">
                <div class="foote_logo footer-wrapperss" style="padding-top: 20px !important;">
                    <h5>SERVICES</h5>
                    </div>
                    <div class="about_footer">
                    <ul id="menu-quick-links" class="footer-menu-list">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a rel="noopener noreferrer" href="#">Smart Home</a>
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a rel="noopener noreferrer" href="{{url('save-cloud')}}">Save Data in Cloud</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="{{url('home-security')}}">Home Security</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="{{url('terms')}}">Terms &amp; Condition</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <!-- ./Services -->

            <!-- SUPPORTS -->
            <div class="col-md-6 col-sm-12 col-lg-2">
                <div class="foote_logo footer-wrapperss" style="padding-top: 20px !important;">
                <h5>SUPPORTS</h5>
                </div>
                <div class="about_footer">
                <ul id="menu-quick-links" class="footer-menu-list">
                    <li class="menu-item menu-item-type-post_type_archive menu-item-object-customer">
                    <a href="{{url('support')}}">Support</a></li>
                    
                    <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a href="{{url('seller-policy')}}">Reseller Policy</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type_archive menu-item-object-customer">
                        <a href="{{url('privacy-policy')}}">Privacy Policy</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type_archive menu-item-object-customer">
                            <a href="{{ route('orders.track') }}">
                            {{ translate('Track Order') }}
                        </a>
                    </li>
                    
                </ul>
                </div>
            </div>
            <!-- ./SUPPORTS -->

            <!-- Contacts -->
            <div class="{{ $col_values }} col-lg-3 footer-end-sec">
                <div class="footer-call-to-action footer-wrapperss">
                    <h5 class="footer-call-to-action-title"> {{ translate('CONTACT US') }}</h5>
                </div>

                <div class="box-11 d-flex align-items-center my-3">
                    <div class="me-3"><i class="fa-solid fa-envelope fs-4"></i></div>
                    <div>
                        <h5 class="text-black fw-bold text-white mb-1">
                            {{ translate('Email') }}
                        </h5>
                        <h6 class="mt-1">
                            <a href="mailto:{{ get_setting('contact_email') }}" class="fs-13 text-soft-light hov-text-primary">{{ get_setting('contact_email')  }}</a>
                        </h6>
                    </div>
                </div>

                <div class="box-11 d-flex align-items-center my-3">
                    <div class="me-3"><i class="fa-solid fa-phone fs-4"></i></div>
                    <div>
                        <h5 class="text-black fw-bold text-white mb-1">
                        {{ translate('Mobile Number') }}
                        </h5>
                        <h6 class="mt-1">                        
                            <a href="tel:{{ get_setting('contact_phone') }}" class="fs-13 text-soft-light hov-text-primary">{{ get_setting('contact_phone') }}</a>
                        </h6>
                        
                    </div>
                </div>

                <div class="box-11 d-flex align-items-center my-3">
                    <div class="me-3"><i class="fa-solid fa-location-dot fs-4"></i></div>
                        <div>
                            <h5 class="text-black fw-bold text-white mb-1">
                            {{ translate('Address') }}
                            </h5>
                            <h6 class="mt-1">{{ get_setting('contact_address',null,App::getLocale()) }}</h6>
                        </div>
                    </div>
                    <div class="box-11 d-flex align-items-center my-3 ">
                        <div class="">
                            <img src="https://zoobla.com/frontend/images/stripe.png" class="img-fluid stripepay w-25">
                            <img src="https://zoobla.com/frontend/images/paypal.png" class="img-fluid paypalpay w-25">
                        </div>
                    </div>
                </div>

                

            <!--  -->

            <!-- Follow & Apps -->
            <div class="col-lg-4">
                <!-- Social -->
                @if ( get_setting('show_social_links') )
                    <h5 class="fs-14 fw-700 text-secondary text-uppercase mt-3 mt-lg-0">{{ translate('Follow Us') }}</h5>
                    <ul class="list-inline social colored mb-4">
                        @if (!empty(get_setting('facebook_link')))
                            <li class="list-inline-item ml-2 mr-2">
                                <a href="{{ get_setting('facebook_link') }}" target="_blank"
                                    class="facebook"><i class="lab la-facebook-f"></i></a>
                            </li>
                        @endif
                        @if (!empty(get_setting('twitter_link')))
                            <li class="list-inline-item ml-2 mr-2">
                                <a href="{{ get_setting('twitter_link') }}" target="_blank"
                                    class="twitter"><i class="lab la-twitter"></i></a>
                            </li>
                        @endif
                        @if (!empty(get_setting('instagram_link')))
                            <li class="list-inline-item ml-2 mr-2">
                                <a href="{{ get_setting('instagram_link') }}" target="_blank"
                                    class="instagram"><i class="lab la-instagram"></i></a>
                            </li>
                        @endif
                        @if (!empty(get_setting('youtube_link')))
                            <li class="list-inline-item ml-2 mr-2">
                                <a href="{{ get_setting('youtube_link') }}" target="_blank"
                                    class="youtube"><i class="lab la-youtube"></i></a>
                            </li>
                        @endif
                        @if (!empty(get_setting('linkedin_link')))
                            <li class="list-inline-item ml-2 mr-2">
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank"
                                    class="linkedin"><i class="lab la-linkedin-in"></i></a>
                            </li>
                        @endif
                    </ul>
                @endif

                <!-- Apps link -->
                @if((get_setting('play_store_link') != null) || (get_setting('app_store_link') != null))
                    <!-- <h5 class="fs-14 fw-700 text-secondary text-uppercase mt-3">{{ translate('Mobile Apps') }}</h5> -->
                    <div class="d-flex mt-3">
                        <div class="">
                            <a href="{{ get_setting('play_store_link') }}" target="_blank" class="mr-2 mb-2 overflow-hidden hov-scale-img">
                                <img class="lazyload has-transition" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/play.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                            </a>
                        </div>
                        <div class="ml-4">
                            <a href="{{ get_setting('app_store_link') }}" target="_blank" class="overflow-hidden hov-scale-img">
                                <img class="lazyload has-transition" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/app.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                            </a>
                        </div>
                    </div>
                @endif

            </div>
          
            <!-- Seller & Delivery Boy -->
            @if ((get_setting('vendor_system_activation') == 1) || addon_is_activated('delivery_boy'))
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="text-center text-sm-left mt-4">
                    <!-- Seller -->
                    @if (get_setting('vendor_system_activation') == 1)
                        <h4 class="fs-14 text-secondary text-uppercase fw-700 mb-3">{{ translate('Seller Zone') }}</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <p class="fs-13 text-soft-light mb-0">
                                    {{ translate('Become A Seller') }} 
                                    <a href="{{ route('shops.create') }}" class="fs-13 fw-700 text-warning ml-2">{{ translate('Apply Now') }}</a>
                                </p>
                            </li>
                            @guest
                                <li class="mb-2">
                                    <a class="fs-13 text-soft-light animate-underline-white" href="{{ route('seller.login') }}">
                                        {{ translate('Login to Seller Panel') }}
                                    </a>
                                </li>
                            @endguest
                            @if(get_setting('seller_app_link'))
                                <li class="mb-2">
                                    <a class="fs-13 text-soft-light animate-underline-white" target="_blank" href="{{ get_setting('seller_app_link')}}">
                                        {{ translate('Download Seller App') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif

                    <!-- Delivery Boy -->
                    @if (addon_is_activated('delivery_boy'))
                        <h4 class="fs-14 text-secondary text-uppercase fw-700 mt-4 mb-3">{{ translate('Delivery Boy') }}</h4>
                        <ul class="list-unstyled">
                            @guest
                                <li class="mb-2">
                                    <a class="fs-13 text-soft-light animate-underline-white" href="{{ route('deliveryboy.login') }}">
                                        {{ translate('Login to Delivery Boy Panel') }}
                                    </a>
                                </li>
                            @endguest
                            
                            @if(get_setting('delivery_boy_app_link'))
                                <li class="mb-2">
                                    <a class="fs-13 text-soft-light animate-underline-white" target="_blank" href="{{ get_setting('delivery_boy_app_link')}}">
                                        {{ translate('Download Delivery Boy App') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Accordion Fotter widgets -->
    <div class="d-lg-none bg-transparent">
        <!-- Quick links -->
        <div class="aiz-accordion-wrap bg-black">
            <div class="aiz-accordion-heading container bg-black">
                <button class="aiz-accordion fs-14 text-white bg-transparent">{{ get_setting('widget_one',null,App::getLocale()) }}</button>
            </div>
            <div class="aiz-accordion-panel bg-transparent" style="background-color: #212129 !important;">
                <div class="container">
                    <ul class="list-unstyled mt-3">
                        @if ( get_setting('widget_one_labels',null,App::getLocale()) !=  null )
                            @foreach (json_decode( get_setting('widget_one_labels',null,App::getLocale()), true) as $key => $value)
							@php
								$widget_one_links = '';
								if(isset(json_decode(get_setting('widget_one_links'), true)[$key])) {
									$widget_one_links = json_decode(get_setting('widget_one_links'), true)[$key];
								}
							@endphp
                            <li class="mb-2 pb-2 @if (url()->current() == $widget_one_links) active @endif">
                                <a href="{{ $widget_one_links }}" class="fs-13 text-soft-light text-sm-secondary animate-underline-white">
                                    {{ $value }}
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Contacts -->
        <div class="aiz-accordion-wrap bg-black">
            <div class="aiz-accordion-heading container bg-black">
                <button class="aiz-accordion fs-14 text-white bg-transparent">{{ translate('Contacts') }}</button>
            </div>
            <div class="aiz-accordion-panel bg-transparent" style="background-color: #212129 !important;">
                <div class="container">
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2">
                            <p  class="fs-13 text-secondary mb-1">{{ translate('Address') }}</p>
                            <p  class="fs-13 text-soft-light">{{ get_setting('contact_address',null,App::getLocale()) }}</p>
                        </li>
                        <li class="mb-2">
                            <p  class="fs-13 text-secondary mb-1">{{ translate('Phone') }}</p>
                            <p  class="fs-13 text-soft-light">{{ get_setting('contact_phone') }}</p>
                        </li>
                        <li class="mb-2">
                            <p  class="fs-13 text-secondary mb-1">{{ translate('Email') }}</p>
                            <p  class="">
                                <a href="mailto:{{ get_setting('contact_email') }}" class="fs-13 text-soft-light hov-text-primary">{{ get_setting('contact_email')  }}</a>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- My Account -->
        <div class="aiz-accordion-wrap bg-black">
            <div class="aiz-accordion-heading container bg-black">
                <button class="aiz-accordion fs-14 text-white bg-transparent">{{ translate('My Account') }}</button>
            </div>
            <div class="aiz-accordion-panel bg-transparent" style="background-color: #212129 !important;">
                <div class="container">
                    <ul class="list-unstyled mt-3">
                        @auth
                            <li class="mb-2 pb-2">
                                <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('logout') }}">
                                    {{ translate('Logout') }}
                                </a>
                            </li>
                        @else
                            <li class="mb-2 pb-2 {{ areActiveRoutes(['user.login'],' active')}}">
                                <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('user.login') }}">
                                    {{ translate('Login') }}
                                </a>
                            </li>
                        @endauth
                        <li class="mb-2 pb-2 {{ areActiveRoutes(['purchase_history.index'],' active')}}">
                            <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('purchase_history.index') }}">
                                {{ translate('Order History') }}
                            </a>
                        </li>
                        <li class="mb-2 pb-2 {{ areActiveRoutes(['wishlists.index'],' active')}}">
                            <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('wishlists.index') }}">
                                {{ translate('My Wishlist') }}
                            </a>
                        </li>
                        <li class="mb-2 pb-2 {{ areActiveRoutes(['orders.track'],' active')}}">
                            <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('orders.track') }}">
                                {{ translate('Track Order') }}
                            </a>
                        </li>
                        @if (addon_is_activated('affiliate_system'))
                            <li class="mb-2 pb-2 {{ areActiveRoutes(['affiliate.apply'],' active')}}">
                                <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('affiliate.apply') }}">
                                    {{ translate('Be an affiliate partner')}}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Seller -->
        @if (get_setting('vendor_system_activation') == 1)
        <div class="aiz-accordion-wrap bg-black">
            <div class="aiz-accordion-heading container bg-black">
                <button class="aiz-accordion fs-14 text-white bg-transparent">{{ translate('Seller Zone') }}</button>
            </div>
            <div class="aiz-accordion-panel bg-transparent" style="background-color: #212129 !important;">
                <div class="container">
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2 pb-2 {{ areActiveRoutes(['shops.create'],' active')}}">
                            <p class="fs-13 text-soft-light text-sm-secondary mb-0">
                                {{ translate('Become A Seller') }} 
                                <a href="{{ route('shops.create') }}" class="fs-13 fw-700 text-warning ml-2">{{ translate('Apply Now') }}</a>
                            </p>
                        </li>
                        @guest
                            <li class="mb-2 pb-2 {{ areActiveRoutes(['deliveryboy.login'],' active')}}">
                                <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('seller.login') }}">
                                    {{ translate('Login to Seller Panel') }}
                                </a>
                            </li>
                        @endguest
                        @if(get_setting('seller_app_link'))
                            <li class="mb-2 pb-2">
                                <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" target="_blank" href="{{ get_setting('seller_app_link')}}">
                                    {{ translate('Download Seller App') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Delivery Boy -->
        @if (addon_is_activated('delivery_boy'))
        <div class="aiz-accordion-wrap bg-black">
            <div class="aiz-accordion-heading container bg-black">
                <button class="aiz-accordion fs-14 text-white bg-transparent">{{ translate('Delivery Boy') }}</button>
            </div>
            <div class="aiz-accordion-panel bg-transparent" style="background-color: #212129 !important;">
                <div class="container">
                    <ul class="list-unstyled mt-3">
                        @guest
                            <li class="mb-2 pb-2 {{ areActiveRoutes(['deliveryboy.login'],' active')}}">
                                <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" href="{{ route('deliveryboy.login') }}">
                                    {{ translate('Login to Delivery Boy Panel') }}
                                </a>
                            </li>
                        @endguest
                        @if(get_setting('delivery_boy_app_link'))
                            <li class="mb-2 pb-2">
                                <a class="fs-13 text-soft-light text-sm-secondary animate-underline-white" target="_blank" href="{{ get_setting('delivery_boy_app_link')}}">
                                    {{ translate('Download Delivery Boy App') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- FOOTER -->
<footer class="pb-0 bg-black text-soft-light border-topcustom">
    <div class="container">
        <div class="row align-items-center py-3">
            <!-- Copyright -->
            <div class="col-lg-12 order-1 order-lg-0">
                <div class="text-center text-lg-left fs-12" current-verison="{{get_setting("current_version")}}">
                    {!! get_setting('frontend_copyright_text', null, App::getLocale()) !!}
                </div>
            </div>

            <!-- Payment Method Images -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="text-center text-lg-right">
                    <ul class="list-inline mb-0">
                        @if ( get_setting('payment_method_images') !=  null )
                            @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                <li class="list-inline-item mr-3">
                                    <img src="{{ uploaded_asset($value) }}" height="20" class="mw-100 h-auto" style="max-height: 20px" alt="{{ translate('payment_method') }}">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Mobile bottom nav -->
<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom border-top border-sm-bottom border-sm-left border-sm-right mx-auto mb-sm-2" style="background-color: rgb(255 255 255 / 90%)!important;">
    <div class="row align-items-center gutters-5">
        <!-- Home -->
        <div class="col">
            <a href="{{ route('home') }}" class="text-secondary d-block text-center pb-2 pt-3 {{ areActiveRoutes(['home'],'svg-active')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                    <g id="Group_24768" data-name="Group 24768" transform="translate(3495.144 -602)">
                      <path id="Path_2916" data-name="Path 2916" d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z" transform="translate(-3495.144 602)" fill="#b5b5bf"/>
                    </g>
                </svg>
                <span class="d-block mt-1 fs-10 fw-600 text-reset {{ areActiveRoutes(['home'],'text-primary')}}">{{ translate('Home') }}</span>
            </a>
        </div>

        <!-- Categories -->
        <div class="col">
            <a href="{{ route('categories.all') }}" class="text-secondary d-block text-center pb-2 pt-3 {{ areActiveRoutes(['categories.all'],'svg-active')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                    <g id="Group_25497" data-name="Group 25497" transform="translate(3373.432 -602)">
                      <path id="Path_2917" data-name="Path 2917" d="M126.713,0h-5V5a2,2,0,0,0,2,2h3a2,2,0,0,0,2-2V2a2,2,0,0,0-2-2m1,5a1,1,0,0,1-1,1h-3a1,1,0,0,1-1-1V1h4a1,1,0,0,1,1,1Z" transform="translate(-3495.144 602)" fill="#91919c"/>
                      <path id="Path_2918" data-name="Path 2918" d="M144.713,18h-3a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h5V20a2,2,0,0,0-2-2m1,6h-4a1,1,0,0,1-1-1V20a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1Z" transform="translate(-3504.144 593)" fill="#91919c"/>
                      <path id="Path_2919" data-name="Path 2919" d="M143.213,0a3.5,3.5,0,1,0,3.5,3.5,3.5,3.5,0,0,0-3.5-3.5m0,6a2.5,2.5,0,1,1,2.5-2.5,2.5,2.5,0,0,1-2.5,2.5" transform="translate(-3504.144 602)" fill="#91919c"/>
                      <path id="Path_2920" data-name="Path 2920" d="M125.213,18a3.5,3.5,0,1,0,3.5,3.5,3.5,3.5,0,0,0-3.5-3.5m0,6a2.5,2.5,0,1,1,2.5-2.5,2.5,2.5,0,0,1-2.5,2.5" transform="translate(-3495.144 593)" fill="#91919c"/>
                    </g>
                </svg>
                <span class="d-block mt-1 fs-10 fw-600 text-reset {{ areActiveRoutes(['categories.all'],'text-primary')}}">{{ translate('Categories') }}</span>
            </a>
        </div>
        @php
            $cart = get_user_cart();
        @endphp

        <!-- Cart -->
        @php
            $count = (isset($cart) && count($cart)) ? count($cart) : 0;
        @endphp
        <div class="col-auto">
            <a href="{{ route('cart') }}" class="text-secondary d-block text-center pb-2 pt-3 px-3 {{ areActiveRoutes(['cart'],'svg-active')}}">
                <span class="d-inline-block position-relative px-2">
                    <svg id="Group_25499" data-name="Group 25499" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16.001" height="16" viewBox="0 0 16.001 16">
                        <defs>
                        <clipPath id="clip-pathw">
                            <rect id="Rectangle_1383" data-name="Rectangle 1383" width="16" height="16" fill="#91919c"/>
                        </clipPath>
                        </defs>
                        <g id="Group_8095" data-name="Group 8095" transform="translate(0 0)" clip-path="url(#clip-pathw)">
                        <path id="Path_2926" data-name="Path 2926" d="M8,24a2,2,0,1,0,2,2,2,2,0,0,0-2-2m0,3a1,1,0,1,1,1-1,1,1,0,0,1-1,1" transform="translate(-3 -11.999)" fill="#91919c"/>
                        <path id="Path_2927" data-name="Path 2927" d="M24,24a2,2,0,1,0,2,2,2,2,0,0,0-2-2m0,3a1,1,0,1,1,1-1,1,1,0,0,1-1,1" transform="translate(-10.999 -11.999)" fill="#91919c"/>
                        <path id="Path_2928" data-name="Path 2928" d="M15.923,3.975A1.5,1.5,0,0,0,14.5,2h-9a.5.5,0,1,0,0,1h9a.507.507,0,0,1,.129.017.5.5,0,0,1,.355.612l-1.581,6a.5.5,0,0,1-.483.372H5.456a.5.5,0,0,1-.489-.392L3.1,1.176A1.5,1.5,0,0,0,1.632,0H.5a.5.5,0,1,0,0,1H1.544a.5.5,0,0,1,.489.392L3.9,9.826A1.5,1.5,0,0,0,5.368,11h7.551a1.5,1.5,0,0,0,1.423-1.026Z" transform="translate(0 -0.001)" fill="#91919c"/>
                        </g>
                    </svg>
                    @if($count > 0)
                        <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 5px;top: -2px;"></span>
                    @endif
                </span>
                <span class="d-block mt-1 fs-10 fw-600 text-reset {{ areActiveRoutes(['cart'],'text-primary')}}">
                    {{ translate('Cart') }}
                    (<span class="cart-count">{{$count}}</span>)
                </span>
            </a>
        </div>

        <!-- Notifications -->
        <div class="col">
            <a href="{{ route('all-notifications') }}" class="text-secondary d-block text-center pb-2 pt-3 {{ areActiveRoutes(['all-notifications'],'svg-active')}}">
                <span class="d-inline-block position-relative px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13.6" height="16" viewBox="0 0 13.6 16">
                        <path id="ecf3cc267cd87627e58c1954dc6fbcc2" d="M5.488,14.056a.617.617,0,0,0-.8-.016.6.6,0,0,0-.082.855A2.847,2.847,0,0,0,6.835,16h0l.174-.007a2.846,2.846,0,0,0,2.048-1.1h0l.053-.073a.6.6,0,0,0-.134-.782.616.616,0,0,0-.862.081,1.647,1.647,0,0,1-.334.331,1.591,1.591,0,0,1-2.222-.331H5.55ZM6.828,0C4.372,0,1.618,1.732,1.306,4.512h0v1.45A3,3,0,0,1,.6,7.37a.535.535,0,0,0-.057.077A3.248,3.248,0,0,0,0,9.088H0l.021.148a3.312,3.312,0,0,0,.752,2.2,3.909,3.909,0,0,0,2.5,1.232,32.525,32.525,0,0,0,7.1,0,3.865,3.865,0,0,0,2.456-1.232A3.264,3.264,0,0,0,13.6,9.249h0v-.1a3.361,3.361,0,0,0-.582-1.682h0L12.96,7.4a3.067,3.067,0,0,1-.71-1.408h0V4.54l-.039-.081a.612.612,0,0,0-1.132.208h0v1.45a.363.363,0,0,0,0,.077,4.21,4.21,0,0,0,.979,1.957,2.022,2.022,0,0,1,.312,1h0v.155a2.059,2.059,0,0,1-.468,1.373,2.656,2.656,0,0,1-1.661.788,32.024,32.024,0,0,1-6.87,0,2.663,2.663,0,0,1-1.7-.824,2.037,2.037,0,0,1-.447-1.33h0V9.151a2.1,2.1,0,0,1,.305-1.007A4.212,4.212,0,0,0,2.569,6.187a.363.363,0,0,0,0-.077h0V4.653a4.157,4.157,0,0,1,4.2-3.442,4.608,4.608,0,0,1,2.257.584h0l.084.042A.615.615,0,0,0,9.649,1.8.6.6,0,0,0,9.624.739,5.8,5.8,0,0,0,6.828,0Z" fill="#91919b"/>
                    </svg>
                    @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0)
                        <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 5px;top: -2px;"></span>
                    @endif
                </span>
                <span class="d-block mt-1 fs-10 fw-600 text-reset {{ areActiveRoutes(['all-notifications'],'text-primary')}}">{{ translate('Notifications') }}</span>
            </a>
        </div>

        <!-- Account -->
        <div class="col">
            @if (Auth::check())
                @if(isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-secondary d-block text-center pb-2 pt-3">
                        <span class="d-block mx-auto">
                            @if(Auth::user()->photo != null)
                                <img src="{{ custom_asset(Auth::user()->avatar_original)}}" alt="{{ translate('avatar') }}" class="rounded-circle size-20px">
                            @else
                                <img src="{{ static_asset('assets/img/avatar-place.png') }}" alt="{{ translate('avatar') }}" class="rounded-circle size-20px">
                            @endif
                        </span>
                        <span class="d-block mt-1 fs-10 fw-600 text-reset">{{ translate('My Account') }}</span>
                    </a>
                @elseif(isSeller())
                    <a href="{{ route('dashboard') }}" class="text-secondary d-block text-center pb-2 pt-3">
                        <span class="d-block mx-auto">
                            @if(Auth::user()->photo != null)
                                <img src="{{ custom_asset(Auth::user()->avatar_original)}}" alt="{{ translate('avatar') }}" class="rounded-circle size-20px">
                            @else
                                <img src="{{ static_asset('assets/img/avatar-place.png') }}" alt="{{ translate('avatar') }}" class="rounded-circle size-20px">
                            @endif
                        </span>
                        <span class="d-block mt-1 fs-10 fw-600 text-reset">{{ translate('My Account') }}</span>
                    </a>
                @else
                    <a href="javascript:void(0)" class="text-secondary d-block text-center pb-2 pt-3 mobile-side-nav-thumb" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                        <span class="d-block mx-auto">
                            @if(Auth::user()->photo != null)
                                <img src="{{ custom_asset(Auth::user()->avatar_original)}}" alt="{{ translate('avatar') }}" class="rounded-circle size-20px">
                            @else
                                <img src="{{ static_asset('assets/img/avatar-place.png') }}" alt="{{ translate('avatar') }}" class="rounded-circle size-20px">
                            @endif
                        </span>
                        <span class="d-block mt-1 fs-10 fw-600 text-reset">{{ translate('My Account') }}</span>
                    </a>
                @endif
            @else
                <a href="{{ route('user.login') }}" class="text-secondary d-block text-center pb-2 pt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <g id="Group_8094" data-name="Group 8094" transform="translate(3176 -602)">
                          <path id="Path_2924" data-name="Path 2924" d="M331.144,0a4,4,0,1,0,4,4,4,4,0,0,0-4-4m0,7a3,3,0,1,1,3-3,3,3,0,0,1-3,3" transform="translate(-3499.144 602)" fill="#b5b5bf"/>
                          <path id="Path_2925" data-name="Path 2925" d="M332.144,20h-10a3,3,0,0,0,0,6h10a3,3,0,0,0,0-6m0,5h-10a2,2,0,0,1,0-4h10a2,2,0,0,1,0,4" transform="translate(-3495.144 592)" fill="#b5b5bf"/>
                        </g>
                    </svg>
                    <span class="d-block mt-1 fs-10 fw-600 text-reset">{{ translate('My Account') }}</span>
                </a>
            @endif
        </div>

    </div>
</div>

<!-- User Side nav -->
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif

<style>
    .cart-items-footer {}
</style>

    <!-- New Cart -->
    <div class="new-cart" id="new-cart-modal">
        
            @include('frontend.partials.new_cart_details')
        
    </div>
</div>
    <!-- ./New Cart -->


                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="row align-items-center">
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <div class="modalheader-img">
                                                <img src="public/assets/images/headermodal-img.gif" alt="solution" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <div class="modal-header">
                                                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Schedule your demo with Zoobla!<br />
                                                    <p>Please enter your details here! We will get back to you in 24 hours.</p>
                                                </h1> -->
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Schedule your demo with Zoobla!
                                                </h1>
                                                <p>Please enter your details here! We will get back to you in 24 hours.</p>
                                                <form method="post" action="https://zoobla.design2login.com/store-book-demo">
                                                    <input type="hidden" name="_token" value="mvF4psnzXKkCSReXYyDFiHuFTtbidf7zBN2idCE0" />
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="">First Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control mt-0" name="name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="">Last Name  <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control mt-0" name="lastname" placeholder="Last name" aria-label="last name" aria-describedby="basic-addon1" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="">Email  <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control mt-0" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="">Mobile No.  <span class="text-danger">*</span></label>
                                                                <input type="Mobile No" class="form-control mt-0" name="mobile" placeholder="Mobile No" aria-label="Mobail No" aria-describedby="basic-addon1" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Business Type</label>
                                                                <input type="Mobile No" class="form-control mt-0" name="mobile" placeholder="Business Type" aria-label="Mobail No" aria-describedby="basic-addon1" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="">Additional Comments</label>
                                                                <textarea name="" id="" class="form-control mt-0" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="zoobla-theme-btn">
                                                    <div class="button-text-wrapper">
                                                        <input class="dark-button-text" type="submit" name="submit" />
                                                        <!-- <div class="dark-button-text" type="submit">Submit</div> -->
                                                    </div>
    
                                                    <div class="button-bg"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
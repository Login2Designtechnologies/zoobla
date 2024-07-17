@extends('frontend.layouts.app')

@section('content')
<style>
    .productbanner-sec{
        padding: 200px 0px 280px 0px !important;
        color:#fff;
    }
    .inner-banner-section{
        width:100%;
        background-size: cover !important;
    }
</style>
    <!-- Banner Section -->
    <section class="inner-banner-section" style="background: url({{ static_asset("assets/images/product-bannerbg.png") }});">
        <div class="container">
            <div class="productbanner-sec">
                <div class="produbanner-con">
                    <h3>Enjoy The Security of Zoobla </h3>
                    <p>The Centerpiece of your own personal property security eco-system</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ./Banner Section -->
    <!-- Breadcrumb -->
    <section class="pt-4 mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark">{{ translate('All Categories') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item has-transition opacity-60 hov-opacity-100">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            "{{ translate('All Categories') }}"
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- All Categories -->
    @if (count($featured_categories) > 0)  

       <section class="mb-2 mb-md-3 mt-2 mt-md-3">

            <div class="container-fluid">
 
                <!-- Categories -->

                <div class="bg-white px-sm-3">

                    <div class="aiz-carousel sm-gutters-17" data-items="5" data-xxl-items="5" data-xl-items="5" data-lg-items="5" data-md-items="3" data-sm-items="3" data-xs-items="2" data-arrows="true" data-dots="false" data-autoplay="true" data-infinite="true">

                        @foreach ($featured_categories as $key => $category)
                            <div class="MultiCarousel" >

                            <div class="MultiCarousel-inner">
                                   
                            <div class="pad15 carousel-box MultiCarousel-inner position-relative text-center hov-scale-img w-100">

                                <a href="{{ route('products.category', $category->slug) }}" class="d-block">

                                    <img src="{{ uploaded_asset($category->banner) }}" class="lazyload h-180px mx-auto has-transition mw-100"

                                        alt="{{ $category->getTranslation('name') }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">

                                </a>

                                <h6 class="text-center text-category">

                                    <a href="{{ route('products.category', $category->slug) }}" title="{{  $category->getTranslation('name')  }}">{{ $category->getTranslation('name') }}</a>

                                </h6>

                            </div>
                            </div>
                            </div>                
                        @endforeach

                    </div>

                </div>  

            </div>

        </section>     

    @endif  
    <!-- ./All Categories -->
    <!-- Camera Section -->
    <div data-aos="fade-up" data-aos-duration="3000" class="aos-init aos-animate">
        <section class="ca-imdscctv-wrapper">
            <div class="container">
            <div class="imdscctv-con">
                <h4>Enjoy The Security of Zoobla</h4>
                <p>The Zoobla Analytics service is available to small businesses. There’s no need to spend time and money on expensive hardware and software, installation, and complex integrations.</p>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="img-cctvs">
                    <img src="{{static_asset("assets/images/cctv-1.png")}}" alt="">
                </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="img-cctvs">
                    <img src="{{static_asset("assets/images/cctv-3.png")}}" alt="">
                </div>
                </div>
            </div>
            </div>
        </section>
    </div>  
    <!-- ./Camera Section -->
    <!-- cameras-nameswrapper -->
    <section class="cameras-nameswrapper">
        <div class="nameswrapper-bgimg">
        <img src="{{ static_asset("assets/images/nameswrapper-bgimg.png") }}" alt="">
        </div>
        <div class="container">
            <div class="cameras-namesec">
                <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="camname-1box">
                    <h4>Dual-Band WiFi</h4>
                    <p>Endure no more long waits and enjoy the smoother live view with the higher data rate and better anti-interference capability brought by the 5GHz (5.8GHz) WiFi. Feel free to stay with the 2.4GHz band or switch to the 5GHz band for the best network performance in multiple scenarios. Flexible to choose, easy to set up.</p>
                    <a href="#" class="zoobla-theme-btn ">
                        <div class="button-text-wrapper">
                        <div class="dark-button-text">Shop Now</div>
                        </div>
                        <div class="button-bg bg-2"></div>
                    </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="camname-1boximg">
                    <img src="{{ static_asset("assets/images/camname-img1.png") }}" alt="">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./cameras-nameswrapper -->
    <!-- camerasanni-2wrapper -->
    <section class="camerasanni-2wrapper">
        <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
            
                <div class="camname-2boximg">
                <img src="{{ static_asset("assets/images/camname-img2.png") }}" alt="">
                </div>
            
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="camname-2box">
                <h4>Explore Zoobla Features</h4>
                <p>The Zoobla Analytics service is available to small businesses. There’s no need to spend time and money on expensive hardware and software, installation, and complex integrations.</p>
                <p>The Zoobla Analytics service is available to small businesses. There’s no need to spend time and money on expensive.</p>
            </div>
            </div>
        </div>
        </div>
    </section>  
    <!-- camerasanni-2wrapper -->
    <!-- sec3-cammeradetwrapper -->
    <section class="sec3-cammeradetwrapper">
        <div class="cammeradetwrapper-bg">
        <img src="{{ static_asset("assets/images/nameswrapper-bgimg.png") }}" alt="">
        </div>
        <div class="container">
        <div class="sec3-cammeradetsec">
            <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="sec3cammera-det">
                <h4>Safe Home Security</h4>
                <p>For administrative and educational buildings, these are primarily the security of property, ensuring human safety, and maintaining discipline.</p>
                <a href="#" class="zoobla-theme-btn ">
                    <div class="button-text-wrapper">
                    <div class="dark-button-text">Shop Now</div>
                    </div>
                    <div class="button-bg bg-2"></div>
                </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="sec3-commeravid">
                <img src="{{ static_asset("assets/images/cctv-vid.gif") }}" alt="">
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- sec3-cammeradetwrapper -->
    <!-- partnerbottam-wrapper -->
    <section class="partnerbottam-wrapper">
        <div class="container">
            <div class="partnerbottam-sec p-0">
            <div class="partnerbottam-bg-img">
                <img src="{{ static_asset("assets/images/circleseffects.png") }}" alt="#">
            </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="partnerbottam-leftcon">
                            <img src="{{ static_asset("assets/images/partnerbottam-img.gif") }}" alt="#">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="partnerbottam-rightcon">
                            <h2>Multiple viewing options

                            </h2>
                            <p>The Zoobla Analytics service is available to small businesses. There’s no need to spend time and money on expensive hardware and software, installation, and complex integrations.</p>
                            
                            
                        
    
                            <a href="" class="zoobla-theme-btn ">
                            <div class="button-text-wrapper">
                                <div class="dark-button-text">Shop Now</div>
                            </div>
                            <div class="button-bg bg-2"></div>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./partnerbottam-wrapper -->

    {{--<section class="mb-5 pb-3">
        <div class="container">
            @foreach ($categories as $key => $category)
                <div class="mb-4 bg-white rounded-0 border">
                    <!-- Category Name -->
                    <div class="text-dark p-4 d-flex align-items-center">
                        <div class="size-60px overflow-hidden p-1 border mr-3">
                            <img src="{{ uploaded_asset($category->banner) }}" alt="" class="img-fit h-100">
                        </div>
                        <a href="{{ route('products.category', $category->slug) }}"
                            class="text-reset fs-16 fs-md-20 fw-700 hov-text-primary">{{ $category->getTranslation('name') }}</a>
                    </div>
                    <div class="px-4 py-2">
                        <div class="row row-cols-xl-5 row-cols-md-3 row-cols-sm-2 row-cols-1 gutters-16">
                            @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                <div class="col text-left mb-3">
                                    <!-- Sub Category Name -->
                                    <h6 class="text-dark mb-3">
                                        <a class="text-reset fw-700 fs-14 hov-text-primary"
                                            href="{{ route('products.category', get_single_category($first_level_id)->slug) }}">
                                            {{ get_single_category($first_level_id)->getTranslation('name') }}
                                        </a>
                                    </h6>
                                    <!-- Sub-sub Categories -->
                                    @php
                                        $first_level_categories = \App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id);
                                    @endphp
                                    <ul
                                        class="mb-2 list-unstyled has-transition mh-100 @if (count($first_level_categories) > 5) less @endif">
                                        @foreach ($first_level_categories as $key => $second_level_id)
                                            <li class="text-dark mb-2">
                                                <a class="text-reset fw-400 fs-14 hov-text-primary animate-underline-primary"
                                                    href="{{ route('products.category', get_single_category($second_level_id)->slug) }}">
                                                    {{ get_single_category($second_level_id)->getTranslation('name') }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if (count($first_level_categories) > 5)
                                        <a href="javascript:void(1)"
                                            class="show-hide-cetegoty text-primary hov-text-primary fs-12 fw-700">{{ translate('More') }}
                                            <i class="las la-angle-down"></i></a>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>--}}
@endsection

@section('script')
    <script>
        $('.show-hide-cetegoty').on('click', function() {
            var el = $(this).siblings('ul');
            if (el.hasClass('less')) {
                el.removeClass('less');
                $(this).html('{{ translate('Less') }} <i class="las la-angle-up"></i>');
            } else {
                el.addClass('less');
                $(this).html('{{ translate('More') }} <i class="las la-angle-down"></i>');
            }
        });
    </script>
@endsection

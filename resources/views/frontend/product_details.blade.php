@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    @php
        $availability = "out of stock";
        $qty = 0;
        if($detailedProduct->variant_product) {
            foreach ($detailedProduct->stocks as $key => $stock) {
                $qty += $stock->qty;
            }
        }
        else {
            $qty = optional($detailedProduct->stocks->first())->qty;
        }
        if($qty > 0){
            $availability = "in stock";
        }
    @endphp
    <!-- Schema.org markup for Google+ -->
    <!-- <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}"> -->

    <!-- Twitter Card data -->
    <!-- <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price"> -->

    <!-- Open Graph data -->
    <!-- <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:brand" content="{{ $detailedProduct->brand ? $detailedProduct->brand->name : env('APP_NAME') }}">
    <meta property="product:availability" content="{{ $availability }}">
    <meta property="product:condition" content="new">
    <meta property="product:price:amount" content="{{ number_format($detailedProduct->unit_price, 2) }}">
    <meta property="product:retailer_item_id" content="{{ $detailedProduct->slug }}">
    <meta property="product:price:currency"
        content="{{ get_system_default_currency()->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Slick Slider CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">




@endsection

@section('content')

<section class="bottam-menuwrapper bottam-menuwrapper2">
        <div class="container-fluid">
            <div class="bottam-menusec">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="bomenu-leftcon">
                        <!-- {{ $detailedProduct->getTranslation('name') }} -->
                        <!-- <h5> {{ $detailedProduct->getTranslation('name') }}</h5> -->
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-8">
                        <div class="bomenu-rightcon">
                            <!-- <ul id="scroller" class="nav nav-tabs navew-tabs navew-tabscmn mr-3 border-bottom-0">
                                <li class="active"><a href="#home">Product</a></li>
                                <li><a href="#description">Description</a></li>
                                <li><a href="#comparision">Comparision</a></li>
                                <li><a href="#features">Features</a></li>
                                <li><a href="#feedback">Feedback</a></li>
                            </ul> -->
                            <nav class="customNavTabs">
                                <ul class="nav nav-tabs navew-tabs navew-tabscmn mr-3 border-bottom-0">
                                    <li><a class="active" href="#section">Purchase</a></li>
                                    <li><a href="#section2">Overview</a></li>
                                    <li><a href="#section3">Comparision</a></li>
                                    <li><a href="#section5">Review</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>
<section class="product-dtl-section" id="section">
    
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6">

                  @include('frontend.product_details.new-image_gallery')
              
            </div>

            <div class="col-lg-6">

                  @include('frontend.product_details.new-details')

            </div>

        </div>

    </div>

</section>

<!-- Dual Camera Section -->

<div class="dual-camera-section">
    
    <img class="img-fluid w-100" src="{{uploaded_asset($detailedProduct->product_translations[0]->banner_image)}}" alt="">
    
</div>


<!-- ./Dual Camera Section -->

<!-- Big Pic section -->
<section id="section2">
    <div class="big-pic-section bg-black">
        
        <div class="container">
            
            <div class="row">
                
                <div class="col-md-6 mx-auto">
                    
                    <div class="big-pic-sec text-center">
                        
                    <h2 class="ttl"> {{$detailedProduct->product_translations[0]->sec_third_hedding}}</h2>
                    
                    <p>{{$detailedProduct->product_translations[0]->sec_third_details}}</p>
                    
                    <div class="img-wrap">
                        
                        <!-- <img class="img-fluid " src="{{uploaded_asset($detailedProduct->product_translations[0]->sec_third_image)}}" alt=""> -->
                        
                    </div>
                    
                    </div>
                    
                </div>
                <div class="col-lg-12">
                  <video class="video" autoplay="" loop="" muted="" style="opacity: 1;width:100%">
                  <source src="https://login2design.in/zoobla_staging/public/assets/images/video.mp4" type="video/mp4"></video>
                </div>
                
            </div>
            
        </div>
        
    </div>
</section>
<!-- ./Big Pic section -->

<!-- Nav tabs -->
<section class="main-box-section">
    <div class="container-fluid">


    <!-- timeLines 1 -->
    <?php
      $counter = 1;
      $carousel1 = json_decode($detailedProduct->product_translations[0]->carousel1);

    ?>
    @if($carousel1)
        <div class="timeLines">
          <div class="section-content">
              <div thumbsslider="" class="swiper mySwiper-timeline">
                  <div class="swiper-wrapper">
                    @foreach($carousel1 as $key2 => $value2)
                      <div class="swiper-slide">
                          <p><span>{{$key2}}</span></p>
                      </div>
                    @endforeach  
                  </div>
              </div>
              <div class="swiper mySwiper2-timeContent">
                  <div class="swiper-wrapper">
                    @foreach($carousel1 as $key2 => $value2)
                      <div class="swiper-slide">
                          <div class="product-feature">
                              <div class="feature-img">
                                  <img src="{{ uploaded_asset($value2) }}" alt="Dual View on One Screen" />
                              </div>
                          </div>
                      </div>
                    @endforeach  
                  </div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
              </div>
          </div>
        </div>
    @endif    
    <!-- ./ -->

    <!-- timeLines 2 -->

    <?php
      $counter = 1;
      $carousel2 = json_decode($detailedProduct->product_translations[0]->carousel2);

    ?>
    @if($carousel2)
        <div class="timeLines timeLines2">
            <div class="text">
                <h2 class="text-center">In-Camera Edge AI: Versatile Security Alerts</h2>
            </div>
            <div class="section-content">
                <div thumbsslider="" class="swiper mySwiper-timeline1">

                    <div class="swiper-wrapper">
                        @foreach($carousel2 as $key3 => $value3)
                            <div class="swiper-slide">
                                <p>
                                    @if($counter == 1 || $counter == 6 || $counter == 11)
                                        <img src="https://cdn.shopify.com/s/files/1/1487/4888/files/1_2x_a9b71b9c-952a-484a-a5e6-70cc48b79038.png?v=1713864336" alt="">
                                    @endif    
                                    @if($counter == 2 || $counter == 7 || $counter == 12)   
                                        <img src="https://cdn.shopify.com/s/files/1/1487/4888/files/5_2x_b186bb70-2467-4580-bfcf-a5a53b95fe26.png?v=1713864339" alt="">
                                    @endif  
                                    @if($counter == 3 || $counter == 8 || $counter == 13)   
                                        <img src="https://cdn.shopify.com/s/files/1/1487/4888/files/4_2x_0ffe8681-ec06-4415-b3dc-eb4715d5d116.png?v=1713864340" alt="">
                                    @endif  
                                    @if($counter == 4 || $counter == 9 || $counter == 14)   
                                        <img src="https://cdn.shopify.com/s/files/1/1487/4888/files/3_2x_07f74d20-d72f-449d-b7a2-e3334f66eb71.png?v=1713864339" alt="">
                                    @endif  
                                     @if($counter == 5 || $counter == 10 || $counter == 15)   
                                        <img src="https://cdn.shopify.com/s/files/1/1487/4888/files/2_2x_7af7893a-46b6-42d8-92b3-8fb34eb0a3d1.png?v=1713864340" alt="">
                                    @endif      
                                    <span class="desktop_img">{{$key3}}</span></p>
                            </div>
                            @php $counter++; @endphp
                        @endforeach
                    </div>
                </div>
                <div class="swiper mySwiper2-timeContent1">
                  <div class="swiper-wrapper">
                    @foreach($carousel2 as $key3 => $value3)
                        <div class="swiper-slide">
                            <div class="product-feature">
                                <div class="feature-img">
                                    <img src="{{ uploaded_asset($value3) }}" alt="Dual View on One Screen" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                  </div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    @endif
        
    <!-- ./ -->


    <!--  timeLines 3-->
    <?php
      $counter = 1;
      $carousel3 = json_decode($detailedProduct->product_translations[0]->carousel3);

    ?>
    @if($carousel3)
        <div class="timeLines timeLines2">
            <div class="section-content">
                <div thumbsslider="" class="swiper mySwiper-timeline2">
                    <div class="swiper-wrapper">
                        @foreach($carousel3 as $key4 => $value4)
                            <div class="swiper-slide">
                                <p><span>{{$key4}}</span></p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper mySwiper2-timeContent2">
                    <div class="swiper-wrapper">
                        @foreach($carousel3 as $key4 => $value4)
                            <div class="swiper-slide">
                                <div class="product-feature">
                                    <div class="feature-img">
                                        <img src="{{ uploaded_asset($value4) }}" alt="Dual View on One Screen">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    @endif    
    <!-- ./ -->

    <!-- timeLines 4 -->
    <?php
      $counter = 1;
      $carousel4 = json_decode($detailedProduct->product_translations[0]->carousel4);

    ?>
    @if($carousel4)
        <div class="timeLines">
            <div class="section-content">
                <div class="swiper mySwiper2-timeContent3">
                    <div class="swiper-wrapper">
                        @foreach($carousel4 as $key5 => $value5)
                            <div class="swiper-slide">
                                <div class="product-feature">
                                    <div class="feature-img">
                                        <img src="{{ uploaded_asset($value5) }}" alt="Dual View on One Screen">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div thumbsslider="" class="swiper mySwiper-timeline3">
                    <div class="swiper-wrapper" style="opacity: 0;">
                        <div class="swiper-slide">
                            <p><span></span></p>
                        </div>
                        <div class="swiper-slide">
                            <p><span></span></p>

                        </div>
                        <div class="swiper-slide">
                            <p><span></span></p>

                        </div>
                        <div class="swiper-slide">
                            <p><span></span></p>

                        </div>
                        <div class="swiper-slide">
                            <p><span></span></p>
                        </div>
                        <div class="swiper-slide">
                            <p><span></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif      
</div>
    <!-- ./ -->

     



  
  
    
  

  
    
  
    </div>
  </section>
  <!-- ./ -->

  


@php

    $first_product = App\Models\Product::where('id' , $detailedProduct->product_translations[0]->first_product_id)->first();
    $secound_product = App\Models\Product::where('id' , $detailedProduct->product_translations[0]->secound_product_id)->first();

@endphp

<!--  product comparison  -->
@if(!empty($first_product) && $secound_product)
<section class="scrollSec py-5 d-flex justify-content-center " id="section3">
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="text-center pt-5 aos-init aos-animate" data-aos="fade-up-left" data-aos-duration="1000" data-aos-once="true">
                    <h2>Product <span class="text-main text-capitalize">Comparison</span></h2>
                </div>
            </div>
       
            <div class="col-lg-6">
                <div class="card border-0 bg-transparent h-100 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    <div class="card-body p-lg-5 py-5 p-3">
                        <div class="mb-3">
                            <img src="{{ uploaded_asset($first_product->thumbnail_img) }}" class="img-fluid rounded-5" />
                      
                            <p class="mt-3">
                                 {{$first_product->name}}
                            </p>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle table-hover table-bordered border-white text-center">
                                <tbody>
                                    <tr>
                                        <td class="py-4 bg-main w-50">
                                            <span class="fs-15 fw-semibold text-white">
                                                Battery Life
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-15 fw-semibold">
                                                {{$first_product->product_translations[0]->battery}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                Local Storage
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                                {{$first_product->product_translations[0]->local_storage}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                Field of view 135
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                                {{$first_product->product_translations[0]->field_view}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                HomeBase Compatibility
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                                {{$first_product->product_translations[0]->homebase_compatibility}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                Resolution
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                               {{$first_product->product_translations[0]->resolution2}}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-6">
                <div class="card bg-transparent border-0 h-100 aos-init aos-animate" data-aos="fade-down-right" data-aos-duration="1000" data-aos-once="true">
                    <div class="card-body p-lg-5 py-5 p-3">
                        <div class="mb-3">
                            <!-- <img src="https://login2design.in/zoobla_reference//public/assets/images/new/n-25.png" class="img-fluid rounded-5" /> -->
                            <img src="{{uploaded_asset($secound_product->thumbnail_img) }}" class="img-fluid rounded-5" />
                         
                            <p class="mt-3">
                                {{$secound_product->name}}
                            </p>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle table-hover table-bordered border-white text-center">
                                <tbody>
                                    <tr>
                                        <td class="py-4 bg-main w-50">
                                            <span class="fs-15 fw-semibold text-white">
                                                Battery Life
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-15 fw-semibold">
                                                 {{$secound_product->product_translations[0]->battery}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                Local Storage
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                               {{$secound_product->product_translations[0]->local_storage}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                Field of view 135
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                                {{$secound_product->product_translations[0]->field_view}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                HomeBase Compatibility
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                                {{$secound_product->product_translations[0]->homebase_compatibility}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 bg-main">
                                            <span class="fs-14 fw-semibold text-white">
                                                Resolution
                                            </span>
                                        </td>
                                        <td class="py-4 bg-gray">
                                            <span class="fs-14 fw-semibold">
                                                 {{$secound_product->product_translations[0]->resolution2}}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</section>
@endif
<!-- ./product comparison -->

<!-- Review Section -->
<section class="reviews-section" id="section5">

    <div class="container-fluid">

        <h2 class="ttl mx-5">Customer Reviews</h2>

    </div>

    <div class="container">

      <div class="review-box">

        <div class="row align-items-center">

            <div class="col-lg-3">

                <div class="review-box-score">

                    @php

                        $total = 0;

                        $total += $detailedProduct->reviews->count();

                    @endphp

                    <div class="review-score">

                        {{ $detailedProduct->rating }} <span class="per-total">/5.0</span>

                    </div>

                    <div class="review-score-text">

                        <span class="rating rating-mr-1">

                            {{ renderStarRating($detailedProduct->rating) }}

                        </span>

                    </div>

                    <div class="review-score-base">

                        Form ({{ $total }} {{ translate('reviews') }})

                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <span class="text-center border-h"></span>
                <?php
                 $rating_count = $detailedProduct->reviews()->select('rating' , DB::raw('count(*) as total'))->groupBy('rating')->orderBy('rating', 'asc')->get();
                ?>
                <div class="review-sumary">

                    @foreach($rating_count as $val)
                        <?php
                        $prograss = ($val->total/5)*100
                        ?>
                        <div class="item">

                            <div class="label">

                              {{$val->rating}} <i class="fa fa-star"></i>

                            </div>

                            <div class="progress w-100">

                                <div class="progress-bar" style="width:{{$prograss}}%"></div>

                            </div> 

                            <div class="number">{{$val->total}}</div>

                        </div>

                    @endforeach

              </div>

            </div>

            <div class="col-lg-3 text-center">

                <button type="button" onclick="product_review('{{ $detailedProduct->id }}')"  class="btn btn-theme">Write A Review</button>

            </div>

        </div>

      </div>

    </div>

</section>
  <!-- ./Review Section -->

  <section class="review-qus-section">
    @php
    $menu_name = json_decode($detailedProduct->product_translations[0]->faq_questions);
    $menu_answers = json_decode($detailedProduct->product_translations[0]->faq_answers);
    @endphp
    <div class="container-fluid px-5">
      <!-- Nav pills -->
        <ul class="nav nav-pills review-qus-nav-pill">

          <li class="nav-item">

             <a class="nav-link active" data-bs-toggle="pill" href="#review">Reviews({{$total}})</a>

          </li>

          <li class="nav-item">

                <a class="nav-link" data-bs-toggle="pill" href="#question">Questions({{count($menu_name ?? [])}})</a>

          </li>

        </ul>
  
        <!-- Tab panes -->
        <div class="tab-content mt-0">

            <div class="tab-pane active reviews-area" id="review" >

                @include('frontend.product_details.reviews')

            </div>

            <div class="tab-pane fade" id="question">

                @if($menu_name != null)
                    <div class="accordion pt-0" id="accordionExample">
                        @foreach ($menu_name as $key => $question)
                            @php $a = $key + 1; @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$a}}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$a}}" aria-expanded="false" aria-controls="collapse{{$a}}">
                                        {{$question}}
                                    </button>
                                </h2>
                                @if(isset($menu_answers[$key]))
                                    <div id="collapse{{$a}}" class="accordion-collapse collapse" aria-labelledby="heading{{$a}}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="fs-14">
                                                {{$menu_answers[$key]}}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else

                    <div class="text-center fs-18 opacity-70">

                        {{ translate('There have been no question for this product yet.') }}
            
                    </div>

                @endif

    
            </div>

        </div>

    </div>

  </section>


<!-- Hide Extra Section -->
{{-- <section class="mb-4">
    <div class="container">
        @if ($detailedProduct->auction_product)
      
            <!-- Reviews & Ratings -->
            @include('frontend.product_details.review_section')
            
            <!-- Description, Video, Downloads -->
            @include('frontend.product_details.description')
            
            <!-- Product Query -->
            @include('frontend.product_details.product_queries')
        @else
      
            <div class="row gutters-16">
                <!-- Left side -->
                <div class="col-lg-3">
                    <!-- Seller Info -->
                    @include('frontend.product_details.seller_info')

                    <!-- Top Selling Products -->
                    <div class="d-none d-lg-block">
                        @include('frontend.product_details.top_selling_products')
                    </div>
                </div>

                <!-- Right side -->
                <div class="col-lg-9">
                    
                    <!-- Reviews & Ratings -->
                     @include('frontend.product_details.review_section')  

                    <!-- Description, Video, Downloads -->
                    @include('frontend.product_details.description')
                    
                    <!-- Related products -->
                    <!-- @include('frontend.product_details.related_products') -->

                    <!-- Product Query -->
                    @include('frontend.product_details.product_queries')
                    
                    <!-- Top Selling Products -->
                    <div class="d-lg-none">
                            @include('frontend.product_details.top_selling_products')
                    </div>

                </div>
                        
                 
                        
                <section id="4menu" class="content1">
                    <div class='col-lg-12' >
                        <!-- Reviews & Ratings -->
                        @include('frontend.product_details.review_section')
                    </div>
                </section>
                
                <div class='col-lg-12'>
                    <!-- Related products -->
                    @include('frontend.product_details.related_products')
                </div>
                
            </div>
        @endif
    </div>
</section>  --}}


@endsection

@section('modal')
    <!-- Image Modal -->
    <div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="p-4">
                    <div class="size-300px size-lg-450px">
                        <img class="img-fit h-100 lazyload"
                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src=""
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Modal -->
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3 rounded-0" name="title"
                                value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control rounded-0" rows="8" name="message" required
                                placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600 rounded-0"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary fw-600 rounded-0 w-100px">{{ translate('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bid Modal -->
    @if($detailedProduct->auction_product == 1)
        @php 
            $highest_bid = $detailedProduct->bids->max('amount');
            $min_bid_amount = $highest_bid != null ? $highest_bid+1 : $detailedProduct->starting_bid; 
        @endphp
        <div class="modal fade" id="bid_for_detail_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('Bid For Product') }} <small>({{ translate('Min Bid Amount: ').$min_bid_amount }})</small> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{{ route('auction_product_bids.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                            <div class="form-group">
                                <label class="form-label">
                                    {{translate('Place Bid Price')}}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="form-group">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="amount" min="{{ $min_bid_amount }}" placeholder="{{ translate('Enter Amount') }}" required>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Product Review Modal -->
    <div class="modal fade" id="product-review-modal">
        <div class="modal-dialog">
            <div class="modal-content" id="product-review-modal-content">

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Slick Slider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function(){
        // Initialize main slider
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.slider-nav',
        autoplay: true, // Add autoplay option
        autoplaySpeed: 2000 // Set autoplay speed in milliseconds (optional)
        });
        // Initialize thumbnail slider
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            centerMode: true,
            focusOnSelect: true,
            vertical: true
        });
        // Initialize Fancybox
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                "slideShow",
                "thumbs",
                "zoom",
                "fullScreen",
                "share",
                "close"
            ],
            loop: true,
            protect: true
        });
    });
</script>

    <script>
         $('document').ready(function() {
            // Set up the scroll event listener
            $(window).scroll(function() {
            // Get the current scroll position
            var scrollPosition = $(this).scrollTop();

            // Iterate through each section
            $('.scrollSec').each(function() {
                // Get the position of the section
                var sectionTop = $(this).offset().top - 250; // Adjusted to highlight the section slightly before reaching it

                // Check if the current scroll position is within the section
                if (scrollPosition >= sectionTop) {
                // Remove the active class from all navigation links
                $('.customNavTabs a').removeClass('active');
                
                // Get the corresponding link and add the active class
                var targetId = $(this).attr('id');
                $('.customNavTabs a[href="#' + targetId + '"]').addClass('active');
                }
            });
            });
        });

        $(document).ready(function(){
            $(".toggle-btn").click(function(){
                $(".row-data").toggle();
            });
        });
    </script>



<!--  -->
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
   var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
   })
</script>
<!-- ./ -->





@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
        });

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }

        function show_chat_modal() {
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

        // Pagination using ajax
        $(window).on('hashchange', function() {
            if(window.history.pushState) {
                window.history.pushState('', '/', window.location.pathname);
            } else {
                window.location.hash = '';
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.product-queries-pagination .pagination a', function(e) {
                getPaginateData($(this).attr('href').split('page=')[1], 'query', 'queries-area');
                e.preventDefault();
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.product-reviews-pagination .pagination a', function(e) {
                getPaginateData($(this).attr('href').split('page=')[1], 'review', 'reviews-area');
                e.preventDefault();
            });
        });

        function getPaginateData(page, type, section) {
            $.ajax({
                url: '?page=' + page,
                dataType: 'json',
                data: {type: type},
            }).done(function(data) {
                $('.'+section).html(data);
                location.hash = page;
            }).fail(function() {
                alert('Something went worng! Data could not be loaded.');
            });
        }
        // Pagination end

        function showImage(photo) {
            $('#image_modal img').attr('src', photo);
            $('#image_modal img').attr('data-src', photo);
            $('#image_modal').modal('show');
        }

        function bid_modal(){
            @if (isCustomer() || isSeller())
                $('#bid_for_detail_product').modal('show');
            @elseif (isAdmin())
                AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers & Sellers can Bid.") }}');
            @else
                $('#login_modal').modal('show');
            @endif
        }

        function product_review(product_id) {
            @if (isCustomer())
                @if ($review_status == 1)
                    $.post('{{ route('product_review_modal') }}', {
                        _token: '{{ @csrf_token() }}',
                        product_id: product_id
                    }, function(data) {
                        $('#product-review-modal-content').html(data);
                        $('#product-review-modal').modal('show', {
                            backdrop: 'static'
                        });
                        AIZ.extra.inputRating();
                    });
                @else
                    AIZ.plugins.notify('warning', '{{ translate("Sorry, You need to buy this product to give review.") }}');
                @endif
            @elseif (Auth::check() && !isCustomer())
                AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers can give review.") }}');
            @else
                $('#login_modal').modal('show');
            @endif
        }
    </script>
<script>
   window.addEventListener("scroll", function () {
    var container = document.querySelector(".video-container"),
        image = document.querySelector(".image"),
        video = document.querySelector(".video"),
        rect = container.getBoundingClientRect(),
        windowHeight = window.innerHeight || document.documentElement.clientHeight;
    rect.top <= 100 ? ((image.style.opacity = 0), (video.style.opacity = 1), video.play()) : ((image.style.opacity = 1), (video.style.opacity = 0), video.pause(), (video.currentTime = 0));
});
function initializeSwiper(swiperContainer, thumbsContainer, config = {}) {
    const mergedConfig = {
        ...{
            autoplay: !0,
            autoplay: { delay: 6e3 },
            breakpoints: { "@0.00": { slidesPerView: 5, spaceBetween: 10 }, "@0.75": { slidesPerView: 5, spaceBetween: 10 }, "@1.00": { slidesPerView: 5, spaceBetween: 10 }, "@1.50": { slidesPerView: 5, spaceBetween: 10 } },
            freeMode: !0,
            watchSlidesProgress: !0,
            grabCursor: !0,
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        },
        ...config,
    };
    var swiper = new Swiper(swiperContainer, mergedConfig),
        swiper2 = new Swiper(thumbsContainer, { autoplay: mergedConfig.autoplay, spaceBetween: 10, grabCursor: mergedConfig.grabCursor, navigation: mergedConfig.navigation, thumbs: { swiper } });
}
initializeSwiper(".mySwiper-timeline", ".mySwiper2-timeContent"),
initializeSwiper(".mySwiper-timeline1", ".mySwiper2-timeContent1"),
initializeSwiper(".mySwiper-timeline2", ".mySwiper2-timeContent2"),
initializeSwiper(".mySwiper-timeline3", ".mySwiper2-timeContent3", { autoplay: !1 });
</script>
    
@endsection

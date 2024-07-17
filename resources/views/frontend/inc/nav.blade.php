<?php
$carts = get_user_cart();
?>
<header class="desktop-header ">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                @php
                    $header_logo = get_setting('header_logo');
                @endphp

                @if ($header_logo != null)
                    <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                        class="img-fluid">
                @else
                    <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"
                        class="img-fluid">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li id="Cloud Storage" class="nav-item dropdown position-static">
                        {{--<a class="nav-link nav-menu" href="{{route('cloud_storage')}}">--}}
                        <a class="nav-link nav-menu dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cloud Storage
                        </a>
                        <div class="dropdown-content_zoobla dropdown-menu cloud-storage-menu" aria-labelledby="navbarDropdown">
                            <div class="menu_box" style="display: flex; width: 100%;">
                                <div class="me-3 business-hover-menu">
                                    <h5 style="font-size: 1rem; font-weight: 800; border-bottom: 1px solid lightgray; padding-bottom: 10px;">
                                        Video Analytics
                                    </h5>
                                    <a href="{{url('/video-analytics')}}" onmouseenter="changeImage('images/Homepage/dome-img2.png')">Video analytics</a>
                                    <a href="{{url('/facial-recognition')}}" onmouseenter="changeImage('images/Homepage/c2.png')">Facial Recognition</a>
                                    <a href="{{url('/people-counter')}}" onmouseenter="changeImage('images/Homepage/c.png')">People Counter</a>
                                    <a href="{{url('/zoobla-people')}}" onmouseenter="changeImage('images/Homepage/c3.png')">Zoobla People</a>
                                    <a href="{{url('/cash-register-control')}}" onmouseenter="changeImage('images/Homepage/c3.png')">Cash register control</a>
                                    <a href="{{url('/access-control')}}" onmouseenter="changeImage('images/Homepage/c3.png')">Access Control</a>
                                    <a href="{{url('/licence-plate')}}" onmouseenter="changeImage('images/Homepage/c3.png')">License Plate Recognition</a>
                                    <a href="{{url('/retail-security')}}" onmouseenter="changeImage('images/Homepage/c3.png')">Retail Security</a>
                                </div>
                                <div class="business-hover-menu2">
                                    <h5 style="font-size: 1rem; font-weight: 800; border-bottom: 1px solid lightgray; padding-bottom: 10px;">
                                        Connect To The Cloud
                                    </h5>
                                    <a href="{{url('/zoobla-bridge')}}" onmouseenter="changeImage('images/Homepage/dome-img2.png')">Zoobla Bridge</a>
                                    <a href="{{url('/loss-prevention')}}" onmouseenter="changeImage('images/Homepage/c2.png')">Loss Prevention</a>
                                    <a href="{{url('/save-data')}}" onmouseenter="changeImage('images/Homepage/c.png')">Save Data In Cloud</a>
                                    <a href="{{url('/home-security')}}" onmouseenter="changeImage('images/Homepage/c3.png')">Home Security</a>
                                    <a href="{{url('/all-industries')}}" onmouseenter="changeImage('images/Homepage/c3.png')">All Industries Data Secure</a>
                                    <a href="{{url('/features')}}" onmouseenter="changeImage('images/Homepage/c3.png')">Features</a>
                                    <a  onmouseenter="changeImage('images/Homepage/c3.png')" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Get Started</a>
                                    <a href="{{url('/cloudstorage')}}">Cloud Storage</a>
                                    <a href="{{url('/cloud-storage')}}" >Cloud Storage Calculator</a>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                                        <div class="modalheader-img">
                                                            <img src="assets/images/headermodal-img.gif" alt="solution" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Schedule your demo with Zoobla!<br />
                                                                <p>Please enter your details here! We will get back to you in 24 hours.</p>
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="https://zoobla.design2login.com/store-book-demo">
                                                                <input type="hidden" name="_token" value="mvF4psnzXKkCSReXYyDFiHuFTtbidf7zBN2idCE0" />
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control" name="name" placeholder="Name" />
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input type="email" class="form-control" name="email" placeholder="Email" />
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input type="Mobile No" class="form-control" name="mobile" placeholder="Mobile No" />
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="imgArea">
                                    <img src="{{asset('/public/assets/images/dome-img2.png')}}" alt="" id="imagechangemenu1" />
                                </div>
                            
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown custom-megamenu mega1" id="Home_Solutions">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                            Home Solutions
                        </a>
                        @php
                          $homsolution = get_category_list(94) ?? [];
                         $home_sub_category = get_category_list(94 , 8)['subcate'] ?? [];

                         $newproducts =  get_new_product_home(8);
                         $row = 1;
                        @endphp
                        <ul class="dropdown-menu">
                            <li class="has-megasubmenu active">
                                <a class="dropdown-item dropdown-toggle" id="hasmegasubmenu0" href="#">New Arrivals<span><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="megasubmenu dropdown-menu" id="megasubmenu0" style="display:block !important">
                                    <li>
                                        <div class="form-row px-3">
                                            @foreach($newproducts as  $newproduct)
                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                <div class="dropdown-menu-list w-100">
                                                    <div class="head">
                                                        <div class="img-wrap">
                                                            <img class="img-fluid" src="{{uploaded_asset($newproduct['thumbnail_img'])}}" alt="">
                                                        </div>
                                                        <div class="desc">
                                                            <h5 class="title">{{$newproduct->name}}</h5>
                                                        </div>
                                                        <ul class="list-unstyled">
                                                            <li><a href="{{route('product',['slug' => $newproduct['slug']])}}">{{$newproduct->slug}}</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="btn-block">
                                                        <a href="{{route('product',['slug' => $newproduct['slug']])}}">View<i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                              @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @foreach($home_sub_category as $home_sub_cate)
                                @php
                                $products     = get_top_selling_product($home_sub_cate->id , 8) ?? null;
                                $home_childsub_category = get_category_list($home_sub_cate->id , 8)['subcate'] 
                                ?? [];

                                //dd($home_childsub_category);
                                @endphp
                            <li class="has-megasubmenu" >
                                <a class="dropdown-item dropdown-toggle"  href="#">{{$home_sub_cate->name}} <span><i class="fa fa-chevron-right"></i></a>
                                <ul class="megasubmenu dropdown-menu" id="megasubmenu{{$row}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @if(!empty($products))
                                                @foreach( $products as  $newproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproduct['thumbnail_img'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproduct['slug']])}}">{{$newproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $home_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @elseif(!empty($home_childsub_category))
                                                @foreach( $home_childsub_category as  $newproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproduct['icon'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="#">{{$newproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $home_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @else
                                             <div class="col-md-3 d-flex">No Products available</div>
                                            @endif 
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php $row++ ?>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown custom-megamenu mega2" id="Business_Solutions">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                        Business Solutions
                        </a>
                        @php
                          $Business_solutions = get_category_list(96) ?? [];
                          $Business_sub_category = get_category_list(96 , 8)['subcate'] ?? [];

                         $newproductsBus =  get_new_product_business(8);
                         $row = 1;
                        @endphp
                        <ul class="dropdown-menu">
                            <li class="has-megasubmenu active" >
                                <a class="dropdown-item dropdown-toggle" id="Bhasmegasubmenu{{$row+1}}" href="#">New Arrivals<span><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="megasubmenu dropdown-menu" id="Bmegasubmenu{{$row+1}}" style="display:block !important">
                                    <li>
                                        <div class="form-row px-3">
                                            @foreach($newproductsBus as  $newproductsBu)
                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                <div class="dropdown-menu-list w-100">
                                                    <div class="head">
                                                        <div class="img-wrap">
                                                            <img class="img-fluid" src="{{uploaded_asset($newproductsBu['thumbnail_img'])}}" alt="">
                                                        </div>
                                                        <div class="desc">
                                                                <h5 class="title">{{$newproductsBu->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductsBu['slug']])}}">{{$newproductsBu->slug}}</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="btn-block">
                                                        <a href="{{route('product',['slug' => $newproductsBu['slug']])}}">View <i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                              @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @foreach($Business_sub_category as $bus_sub_cate)
                                @php
                                $productsBus     = get_top_selling_product($bus_sub_cate->id , 8) ?? null;
                                $bus_childsub_category = get_category_list($bus_sub_cate->id , 8)['subcate'] ?? [];

                                //dd($productsBus,$bus_childsub_category);
                                @endphp
                            <li class="has-megasubmenu" >
                                <a class="dropdown-item dropdown-toggle" id="Bhasmegasubmenuss{{$row}}" href="#">{{$bus_sub_cate->name}} <span><i class="fa fa-chevron-right"></i></a>
                                <ul class="megasubmenu dropdown-menu" id="Bmegasubmenuss{{$row}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @if(!empty($productsBus))
                                                @foreach( $productsBus as  $newproductbus)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproductbus['thumbnail_img'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproductbus->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductbus['slug']])}}">{{$newproductbus->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $bus_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @elseif(!empty($bus_childsub_category))
                                                @foreach( $bus_childsub_category as  $busNewproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($busNewproduct['icon'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$busNewproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('products.category',['category_slug' => $busNewproduct['slug']])}}">{{$busNewproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $busNewproduct['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @else
                                             <div class="col-md-3 d-flex">No Products available</div>
                                            @endif 
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php $row++ ?>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown custom-megamenu mega3" id="Smart_Solutions">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                        Smart Solutions
                        </a>
                        @php
                          $smart_solutions = get_category_list(97) ?? [];
                          $smart_sub_category = get_category_list(97 , 8)['subcate'] ?? [];

                         $newproductsSm =  get_new_product_smart(8);
                         $row = 1;
                        @endphp
                        <ul class="dropdown-menu">
                            <li class="has-megasubmenu active">
                                <a class="dropdown-item dropdown-toggle" id="Shasmegasubmenu{{$row+1}}" href="#">New Arrivals<span><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="megasubmenu dropdown-menu" id="Smegasubmenu{{$row+1}}" style="display:block !important">
                                    <li>
                                        <div class="form-row px-3">
                                            @foreach($newproductsSm as  $newproductsSm)
                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                <div class="dropdown-menu-list w-100">
                                                    <div class="head">
                                                        <div class="img-wrap">
                                                            <img class="img-fluid" src="{{uploaded_asset($newproductsSm['thumbnail_img'])}}" alt="">
                                                        </div>
                                                        <div class="desc">
                                                                <h5 class="title">{{$newproductsSm->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductsSm['slug']])}}">{{$newproductsSm->slug}}</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="btn-block">
                                                        <a href="{{route('product',['slug' => $newproductsSm['slug']])}}">View <i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                              @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @foreach($smart_sub_category as $sm_sub_cate)
                                @php
                                $productsSm     = get_top_selling_product($sm_sub_cate->id , 8) ?? null;
                                $sm_childsub_category = get_category_list($sm_sub_cate->id , 8)['subcate'] ?? [];

                                //dd($productsBus,$sm_childsub_category);
                                @endphp
                            <li class="has-megasubmenu" >
                                <a class="dropdown-item dropdown-toggle" id="shasmegasubmenuss{{$row}}" href="#">{{$sm_sub_cate->name}} <span><i class="fa fa-chevron-right"></i></a>
                                <ul class="megasubmenu dropdown-menu" id="smegasubmenuss{{$row}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @if(!empty($productsSm))
                                                @foreach( $productsSm as  $newproductSm)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproductSm['thumbnail_img'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproductSm->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductSm['slug']])}}">{{$newproductSm->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $sm_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @elseif(!empty($sm_childsub_category))
                                                @foreach( $sm_childsub_category as  $smNewproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($smNewproduct['icon'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$smNewproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('products.category',['category_slug' => $sm_sub_cate['slug']])}}">{{$smNewproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $sm_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @else
                                             <div class="col-lg-3 col-md-4 col-sm-6 d-flex">No Products available</div>
                                            @endif 
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php $row++ ?>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('industries')}}">
                        Industries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('partners')}}">
                        Partners
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('support')}}">
                        Support
                        </a>
                    </li>
                    <li class="nav-item mob-show-only">
                        <button type="button" class="btn btn-lg btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Book Demo
                        </button>
                    </li>
                </ul>
            </div>

            <div class="right-sec">
                <div class="search-wrapper">
                    <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                        <div class="d-flex position-relative align-items-center">
                            <div class="d-none" data-toggle="class-toggle"
                                data-target=".front-header-search">
                                <button class="btn px-2" type="button"><i
                                        class="la la-2x la-long-arrow-left"></i></button>
                            </div>
                            <div class="search-input-box">
                                <input type="text"
                                    class="form-control fs-14 "
                                    id="search" name="keyword"
                                    @isset($query)
                                    value="{{ $query }}"
                                @endisset
                                    placeholder="{{ translate('Search Here') }}" autocomplete="off" style='border-color:#fff !important;'>

                                <svg id="Group_723" data-name="Group 723" xmlns="http://www.w3.org/2000/svg"
                                    width="20.001" height="20" viewBox="0 0 20.001 20">
                                    <path id="Path_3090" data-name="Path 3090"
                                        d="M9.847,17.839a7.993,7.993,0,1,1,7.993-7.993A8,8,0,0,1,9.847,17.839Zm0-14.387a6.394,6.394,0,1,0,6.394,6.394A6.4,6.4,0,0,0,9.847,3.453Z"
                                        transform="translate(-1.854 -1.854)" fill="#b5b5bf" />
                                    <path id="Path_3091" data-name="Path 3091"
                                        d="M24.4,25.2a.8.8,0,0,1-.565-.234l-6.15-6.15a.8.8,0,0,1,1.13-1.13l6.15,6.15A.8.8,0,0,1,24.4,25.2Z"
                                        transform="translate(-5.2 -5.2)" fill="#b5b5bf" />
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="cart_btn">
                    <a href="javacript::void(0)" class="open-cart border-btn" onclick="openCart()">
                        <i class="fa-solid fa-cart-shopping" id="cart_items" aria-hidden="true"></i>
                        <span id="totalp">{{count($carts)}}</span>
                    </a>
                </div> -->
                <div class="cart_btn">
                    @if(count($carts) > 0)
                    <a href="javacript::void(0)" class="open-cart border-btn" onclick="openCart()">
                        <i class="fa-solid fa-cart-shopping" id="cart_items" aria-hidden="true" style="color:red"></i>
                        <span id="totalp" class="cart-count">{{count($carts)}}</span>
                    </a>
                    
                    @else
                    <a href="javacript::void(0)" class="open-cart border-btn" onclick="openCart()">
                        <i class="fa-solid fa-cart-shopping" id="cart_items" aria-hidden="true"></i>
                        <span id="totalp">{{count($carts)}}</span>
                    </a>
                    @endif
                </div>
               
                <!--  -->
                <div class="dropdown user-menu position-static">
                    <button type="button" class="border-btn" data-toggle="dropdown">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @auth
                            @if(isAdmin())
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"> {{ translate('My Account') }}</a>
                            @else
                                <a class="dropdown-item" href="{{ route('dashboard') }}">{{ translate('My Account') }}</a>
                            @endif
                            @if (isCustomer())
                                {{-- <a class="dropdown-item" href="{{ route('all-notifications') }}">{{ translate('Notifications') }}</a> --}}
                                {{-- <a class="dropdown-item" href="{{ route('wishlists.index') }}">{{ translate('Wishlist') }}</a> --}}
                                {{-- <a class="dropdown-item" href="{{ route('compare') }}">{{ translate('Compare') }}</a> --}}
                            @endif
                               <a class="dropdown-item" href="{{ route('logout') }}">{{ translate('Logout') }}</a>
                        @else
                            <a class="dropdown-item" href="{{route('user.login')}}">Login</a>
                            <a class="dropdown-item" href="{{route('user.registration')}}">Sign Up</a>
                            <a class="dropdown-item" href="{{ route('shops.create') }}">Partner</a>
                        @endauth
                            
                    </div>

                    
                </div> 

                <div class="ml-3 desktop-show-only">
                    <button type="button" class="btn btn-lg btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Book Demo
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Header mobile -->
<header class="mob-header d-none" style="display:none">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                @php
                    $header_logo = get_setting('header_logo');
                @endphp

                @if ($header_logo != null)
                    <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                        class="img-fluid">
                @else
                    <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"
                        class="img-fluid">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li id="Cloud Storage" class="nav-item position-static">
                        <a class="nav-link nav-menu">
                            Cloud Storage
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown custom-megamenu mega1" id="Home_Solutions">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                            Home Solutions
                        </a>
                        @php
                          $homsolution = get_category_list(94) ?? [];
                         $home_sub_category = get_category_list(94 , 8)['subcate'] ?? [];

                         $newproducts =  get_new_product_home(8);
                         $row = 1;
                        @endphp
                        <ul class="dropdown-menu">
                            <li class="has-megasubmenu active">
                                <a class="dropdown-item dropdown-toggle" id="hasmegasubmenu0" href="#">New Arrivals<span><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="megasubmenu dropdown-menu" id="megasubmenu0">
                                    <li>
                                        <div class="form-row px-3">
                                            @foreach($newproducts as  $newproduct)
                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                <div class="dropdown-menu-list w-100">
                                                    <div class="head">
                                                        <div class="img-wrap">
                                                            <img class="img-fluid" src="{{uploaded_asset($newproduct['thumbnail_img'])}}" alt="">
                                                        </div>
                                                        <div class="desc">
                                                            <h5 class="title">{{$newproduct->name}}</h5>
                                                        </div>
                                                        <ul class="list-unstyled">
                                                            <li><a href="{{route('product',['slug' => $newproduct['slug']])}}">{{$newproduct->slug}}</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="btn-block">
                                                        <a href="{{route('product',['slug' => $newproduct['slug']])}}">View<i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                              @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @foreach($home_sub_category as $home_sub_cate)
                                @php
                                $products     = get_top_selling_product($home_sub_cate->id , 8) ?? null;
                                $home_childsub_category = get_category_list($home_sub_cate->id , 8)['subcate'] 
                                ?? [];

                                //dd($home_childsub_category);
                                @endphp
                            <li class="has-megasubmenu" >
                                <a class="dropdown-item dropdown-toggle"  href="#">{{$home_sub_cate->name}} <span><i class="fa fa-chevron-right"></i></a>
                                <ul class="megasubmenu dropdown-menu" id="megasubmenu{{$row}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @if(!empty($products))
                                                @foreach( $products as  $newproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproduct['thumbnail_img'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproduct['slug']])}}">{{$newproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $home_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @elseif(!empty($home_childsub_category))
                                                @foreach( $home_childsub_category as  $newproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproduct['icon'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="#">{{$newproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $home_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @else
                                             <div class="col-md-3 d-flex">No Products available</div>
                                            @endif 
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php $row++ ?>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown custom-megamenu mega2" id="Business_Solutions">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                        Business Solutions
                        </a>
                        @php
                          $Business_solutions = get_category_list(96) ?? [];
                          $Business_sub_category = get_category_list(96 , 8)['subcate'] ?? [];

                         $newproductsBus =  get_new_product_business(8);
                         $row = 1;
                        @endphp
                        <ul class="dropdown-menu">
                            <li class="has-megasubmenu active" >
                                <a class="dropdown-item dropdown-toggle" id="Bhasmegasubmenu{{$row+1}}" href="#">New Arrivals<span><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="megasubmenu dropdown-menu" id="Bmegasubmenu{{$row+1}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @foreach($newproductsBus as  $newproductsBu)
                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                <div class="dropdown-menu-list w-100">
                                                    <div class="head">
                                                        <div class="img-wrap">
                                                            <img class="img-fluid" src="{{uploaded_asset($newproductsBu['thumbnail_img'])}}" alt="">
                                                        </div>
                                                        <div class="desc">
                                                                <h5 class="title">{{$newproductsBu->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductsBu['slug']])}}">{{$newproductsBu->slug}}</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="btn-block">
                                                        <a href="{{route('product',['slug' => $newproductsBu['slug']])}}">View <i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                              @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @foreach($Business_sub_category as $bus_sub_cate)
                                @php
                                $productsBus     = get_top_selling_product($bus_sub_cate->id , 8) ?? null;
                                $bus_childsub_category = get_category_list($bus_sub_cate->id , 8)['subcate'] ?? [];

                                //dd($productsBus,$bus_childsub_category);
                                @endphp
                            <li class="has-megasubmenu" >
                                <a class="dropdown-item dropdown-toggle" id="Bhasmegasubmenuss{{$row}}" href="#">{{$bus_sub_cate->name}} <span><i class="fa fa-chevron-right"></i></a>
                                <ul class="megasubmenu dropdown-menu" id="Bmegasubmenuss{{$row}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @if(!empty($productsBus))
                                                @foreach( $productsBus as  $newproductbus)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproductbus['thumbnail_img'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproductbus->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductbus['slug']])}}">{{$newproductbus->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $bus_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @elseif(!empty($bus_childsub_category))
                                                @foreach( $bus_childsub_category as  $busNewproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($busNewproduct['icon'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$busNewproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('products.category',['category_slug' => $busNewproduct['slug']])}}">{{$busNewproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $busNewproduct['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @else
                                             <div class="col-md-3 d-flex">No Products available</div>
                                            @endif 
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php $row++ ?>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown custom-megamenu mega3" id="Smart_Solutions">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                        Smart Solutions
                        </a>
                        @php
                          $smart_solutions = get_category_list(97) ?? [];
                          $smart_sub_category = get_category_list(97 , 8)['subcate'] ?? [];

                         $newproductsSm =  get_new_product_smart(8);
                         $row = 1;
                        @endphp
                        <ul class="dropdown-menu">
                            <li class="has-megasubmenu active">
                                <a class="dropdown-item dropdown-toggle" id="Shasmegasubmenu{{$row+1}}" href="#">New Arrivals<span><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="megasubmenu dropdown-menu" id="Smegasubmenu{{$row+1}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @foreach($newproductsSm as  $newproductsSm)
                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                <div class="dropdown-menu-list w-100">
                                                    <div class="head">
                                                        <div class="img-wrap">
                                                            <img class="img-fluid" src="{{uploaded_asset($newproductsSm['thumbnail_img'])}}" alt="">
                                                        </div>
                                                        <div class="desc">
                                                                <h5 class="title">{{$newproductsSm->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductsSm['slug']])}}">{{$newproductsSm->slug}}</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="btn-block">
                                                        <a href="{{route('product',['slug' => $newproductsSm['slug']])}}">View <i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                              @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @foreach($smart_sub_category as $sm_sub_cate)
                                @php
                                $productsSm     = get_top_selling_product($sm_sub_cate->id , 8) ?? null;
                                $sm_childsub_category = get_category_list($sm_sub_cate->id , 8)['subcate'] ?? [];

                                //dd($productsBus,$sm_childsub_category);
                                @endphp
                            <li class="has-megasubmenu" >
                                <a class="dropdown-item dropdown-toggle" id="shasmegasubmenuss{{$row}}" href="#">{{$sm_sub_cate->name}} <span><i class="fa fa-chevron-right"></i></a>
                                <ul class="megasubmenu dropdown-menu" id="smegasubmenuss{{$row}}">
                                    <li>
                                        <div class="form-row px-3">
                                            @if(!empty($productsSm))
                                                @foreach( $productsSm as  $newproductSm)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproductSm['thumbnail_img'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproductSm->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('product',['slug' => $newproductSm['slug']])}}">{{$newproductSm->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $sm_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @elseif(!empty($sm_childsub_category))
                                                @foreach( $sm_childsub_category as  $smNewproduct)
                                                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($smNewproduct['icon'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$smNewproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="{{route('products.category',['category_slug' => $sm_sub_cate['slug']])}}">{{$smNewproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="{{route('products.category',['category_slug' => $sm_sub_cate['slug']])}}">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @else
                                             <div class="col-md-3 d-flex">No Products available</div>
                                            @endif 
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php $row++ ?>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('industries')}}">
                        Industries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('partners')}}">
                        Partners
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('support')}}">
                        Support
                        </a>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-lg btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Book Demo
                        </button>
                    </li>
                </ul>
            </div>

            <div class="right-sec">
                <div class="search-wrapper">
                    <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                        <div class="d-flex position-relative align-items-center">
                            <div class="d-none" data-toggle="class-toggle"
                                data-target=".front-header-search">
                                <button class="btn px-2" type="button"><i
                                        class="la la-2x la-long-arrow-left"></i></button>
                            </div>
                            <div class="search-input-box">
                                <input type="text"
                                    class="form-control fs-14 "
                                    id="search" name="keyword"
                                    @isset($query)
                                    value="{{ $query }}"
                                @endisset
                                    placeholder="{{ translate('Search Here') }}" autocomplete="off" style='border-color:#fff !important;'>

                                <svg id="Group_723" data-name="Group 723" xmlns="http://www.w3.org/2000/svg"
                                    width="20.001" height="20" viewBox="0 0 20.001 20">
                                    <path id="Path_3090" data-name="Path 3090"
                                        d="M9.847,17.839a7.993,7.993,0,1,1,7.993-7.993A8,8,0,0,1,9.847,17.839Zm0-14.387a6.394,6.394,0,1,0,6.394,6.394A6.4,6.4,0,0,0,9.847,3.453Z"
                                        transform="translate(-1.854 -1.854)" fill="#b5b5bf" />
                                    <path id="Path_3091" data-name="Path 3091"
                                        d="M24.4,25.2a.8.8,0,0,1-.565-.234l-6.15-6.15a.8.8,0,0,1,1.13-1.13l6.15,6.15A.8.8,0,0,1,24.4,25.2Z"
                                        transform="translate(-5.2 -5.2)" fill="#b5b5bf" />
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="cart_btn">
                    @if(count($carts) > 0)
                    <a href="javacript::void(0)" class="open-cart border-btn" onclick="openCart()">
                        <i class="fa-solid fa-cart-shopping" id="cart_items" aria-hidden="true" style="color:red"></i>
                        <span id="totalp">{{count($carts)}}</span>
                    </a>
                    
                    @else
                    <a href="javacript::void(0)" class="open-cart border-btn" onclick="openCart()">
                        <i class="fa-solid fa-cart-shopping" id="cart_items" aria-hidden="true"></i>
                        <span id="totalp">{{count($carts)}}</span>
                    </a>
                    @endif
                </div>
               
                <!--  -->
                <div class="dropdown user-menu position-static">
                    <button type="button" class="border-btn" data-toggle="dropdown">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @auth
                            @if(isAdmin())
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"> {{ translate('My Account') }}</a>
                            @else
                                <a class="dropdown-item" href="{{ route('dashboard') }}">{{ translate('My Account') }}</a>
                            @endif
                            @if (isCustomer())
                                {{-- <a class="dropdown-item" href="{{ route('all-notifications') }}">{{ translate('Notifications') }}</a> --}}
                                {{-- <a class="dropdown-item" href="{{ route('wishlists.index') }}">{{ translate('Wishlist') }}</a> --}}
                                {{-- <a class="dropdown-item" href="{{ route('compare') }}">{{ translate('Compare') }}</a> --}}
                            @endif
                               <a class="dropdown-item" href="{{ route('logout') }}">{{ translate('Logout') }}</a>
                        @else
                            <a class="dropdown-item" href="{{route('user.login')}}">Login</a>
                            <a class="dropdown-item" href="{{route('user.registration')}}">Sign Up</a>
                            <a class="dropdown-item" href="{{ route('shops.create') }}">Partner</a>
                        @endauth
                            
                    </div>
                </div> 

                <div class="ml-3">
                    <button type="button" class="btn btn-lg btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Book Demo
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- ./Header Mobile -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- 
<script>
    $(document).ready(function(){
        $("#Home_Solutions").removeClass('active');

        $("#Business_Solutions").removeClass('active');

        $("#Smart_Solutions").removeClass('active');
    });

    $(".navbar-nav > li").click(function(){
        alert('sdsaf');
        $("#Business_Solutions").removeClass('active');
        $("#Smart_Solutions").removeClass('active');
        $("#Home_Solutions").addClass('active');
    });

    $("#Business_Solutions").click(function(){
        $("#Home_Solutions").removeClass('active');
        $("#Smart_Solutions").removeClass('active');
        $("#Business_Solutions").addClass('active');
    });

    $("#Smart_Solutions").click(function(){
        $("#Home_Solutions").removeClass('active');
        $("#Business_Solutions").removeClass('active');
        $("#Smart_Solutions").addClass('active');
    });
</script> -->
 <!-- mega 1 -->
 <script type="text/javascript">

	window.addEventListener("resize", function () {
    "use strict";
    // window.location.reload();
});

document.addEventListener("DOMContentLoaded", function () {
    /////// Prevent closing from click inside dropdown
    document.querySelectorAll(".mega1 .dropdown-menu").forEach(function (element) {
        element.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    });

    // make it as accordion for smaller screens
    if (window) {
        // close all inner dropdowns when parent is closed
        document.querySelectorAll(".navbar .dropdown").forEach(function (everydropdown) {
            everydropdown.addEventListener("hidden.dropdown", function () {
                // after dropdown is hidden, then find all submenus
                this.querySelectorAll(".mega1 .megasubmenu").forEach(function (everysubmenu) {
                    // hide every submenu as well
                    everysubmenu.style.display = "none";
                });
            });
        });

        let previousId = 'megasubmenu0';

        document.querySelectorAll(".mega1 .has-megasubmenu > a").forEach(function (element) {
            element.addEventListener("click", function (e) {
              
                let nextEl = this.nextElementSibling;
                let currentId = nextEl.id;
                let parentEl = this.parentElement;
               

                if (nextEl && nextEl.classList.contains("megasubmenu")) {
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();

                    if (previousId && previousId != currentId) {
                        
                        document.getElementById(previousId).style.display = "none";
                        document.querySelectorAll(".mega1 .has-megasubmenu").forEach(function (el) {
                            el.classList.remove("active");
                        });

                        document.getElementById(currentId).style.display = "block";
                        parentEl.classList.add("active"); // Add active class to the parent element
                        previousId = currentId;
                       
                    } else {

                        document.getElementById(previousId).style.display = "block";
                        
                        // console.log(previousId , currentId);
                    }
                }
            });
        });

    }
    // end if innerWidth
});
</script>
<!-- mega 2 -->
 <script type="text/javascript">
	window.addEventListener("resize", function () {
    "use strict";
    // window.location.reload();
});

document.addEventListener("DOMContentLoaded", function () {
    /////// Prevent closing from click inside dropdown
    document.querySelectorAll(".mega2 .dropdown-menu").forEach(function (element) {
        element.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    });

    // make it as accordion for smaller screens
    if (window) {
        // close all inner dropdowns when parent is closed
        document.querySelectorAll(".navbar .dropdown").forEach(function (everydropdown) {
            everydropdown.addEventListener("hidden.dropdown", function () {
                // after dropdown is hidden, then find all submenus
                this.querySelectorAll(".mega2 .megasubmenu").forEach(function (everysubmenu) {
                    // hide every submenu as well
                    everysubmenu.style.display = "none";
                });
            });
        });

        let previousId = 'megasubmenu0';

        document.querySelectorAll(".mega2 .has-megasubmenu > a").forEach(function (element) {
            element.addEventListener("click", function (e) {
              
                let nextEl = this.nextElementSibling;
                let currentId = nextEl.id;
                let parentEl = this.parentElement;
               

                if (nextEl && nextEl.classList.contains("megasubmenu")) {
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();

                    if (previousId && previousId != currentId) {
                        
                        document.getElementById(previousId).style.display = "none";
                        document.querySelectorAll(".mega2 .has-megasubmenu").forEach(function (el) {
                            el.classList.remove("active");
                        });

                        document.getElementById(currentId).style.display = "block";
                        parentEl.classList.add("active"); // Add active class to the parent element
                        previousId = currentId;
                       
                    } else {

                        document.getElementById(previousId).style.display = "block";
                        
                        // console.log(previousId , currentId);
                    }
                }
            });
        });

    }
    // end if innerWidth
});
</script>

<!-- mega 3 -->
<script type="text/javascript">
	window.addEventListener("resize", function () {
    "use strict";
    // window.location.reload();
});

document.addEventListener("DOMContentLoaded", function () {
    /////// Prevent closing from click inside dropdown
    document.querySelectorAll(".mega3 .dropdown-menu").forEach(function (element) {
        element.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    });

    // make it as accordion for smaller screens
    if (window) {
        // close all inner dropdowns when parent is closed
        document.querySelectorAll(".navbar .dropdown").forEach(function (everydropdown) {
            everydropdown.addEventListener("hidden.dropdown", function () {
                // after dropdown is hidden, then find all submenus
                this.querySelectorAll(".mega3 .megasubmenu").forEach(function (everysubmenu) {
                    // hide every submenu as well
                    everysubmenu.style.display = "none";
                });
            });
        });

        let previousId = 'megasubmenu0';

        document.querySelectorAll(".mega3 .has-megasubmenu > a").forEach(function (element) {
            element.addEventListener("click", function (e) {
              
                let nextEl = this.nextElementSibling;
                let currentId = nextEl.id;
                let parentEl = this.parentElement;
               

                if (nextEl && nextEl.classList.contains("megasubmenu")) {
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();

                    if (previousId && previousId != currentId) {
                        
                        document.getElementById(previousId).style.display = "none";
                        document.querySelectorAll(".mega3 .has-megasubmenu").forEach(function (el) {
                            el.classList.remove("active");
                        });

                        document.getElementById(currentId).style.display = "block";
                        parentEl.classList.add("active"); // Add active class to the parent element
                        previousId = currentId;
                       
                    } else {

                        document.getElementById(previousId).style.display = "block";
                        
                        // console.log(previousId , currentId);
                    }
                }
            });
        });

    }
    // end if innerWidth
});
</script>

  
    

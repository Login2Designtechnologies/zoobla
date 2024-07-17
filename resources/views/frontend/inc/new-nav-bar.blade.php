<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>

        header .dropdown-toggle::after{display:none}
header nav.navbar{position: relative;
    background: linear-gradient(45deg, #2290df, #1bcfec);
    background-repeat: repeat;
    background-size: auto;
  display: block;
  top: 0;
  left: 0;
  right: 0;
  background-size: 100% 100%;
  background-repeat: no-repeat;
  padding: 18px 0rem;
  z-index: 90;}
  header .navbar .navbar-brand{width: 120px;}
  .custom-megamenu{position: static;}

  
  .nav-item.dropdown > .dropdown-menu.show {
  width: 100%;
  height: 80vh;
}
.dropdown-item.dropdown-toggle {
  width: 280px;
}


  .dropdown-submenu .dropdown-menu {
    top: 0;
    left: 300px;
    margin-top: -1px;width: 100%;min-height: 80vh;
    width: calc(100% - 300px);
  }

  .dropdown-menu.show .dropdown-menu.show {overflow-y: scroll;overflow-x: hidden;
  height: 80vh;}


  .dropdown-menu-list .head .desc .title{font-weight: 600;font-size: 18px;}


  /*  */
  .custom-megamenu ul.dropdown-menu{background:#fff;}
  .custom-megamenu ul.dropdown-menu  .dropdown-submenu ul.overflow-dropdown{padding: 20px;}
  .dropdown-menu-list{background: #f5f5f5;border-radius: 10px;padding:15px;position: relative;margin-bottom:20px}
  .dropdown-menu-list .head .img-wrap{text-align:center;}
  .dropdown-menu-list .head img{width: 150px;max-width: 100%;margin: auto;}
  .dropdown-menu-list .head ul.list-unstyled{min-height: 150px;}
  .dropdown-menu-list  .btn-block{position: absolute;
  bottom: 10px;
  left: 0;
  padding: 0px 15px;}
  .


  header .navbar-light .navbar-nav .nav-link:hover,  header .navbar-light .navbar-nav .nav-link:focus{color:#fff}
  header .navbar-light .navbar-nav .nav-link{font-family: "Public Sans";color: #fff;font-size: 15px;font-weight:400;}
  
  header .dropdown-submenu > a{ margin: 0 10px;
  padding: 10px 15px;
  border-radius: 50px;
  font-weight: 500;}
  header .dropdown-submenu.show > a {
  background: #f5f5f5;
 font-weight:600;
  color: #26386e;
}
header .dropdown-menu .dropdown-submenu  .dropdown-item.dropdown-toggle > span{float: right;display:none}
header .dropdown-menu .dropdown-submenu.show  .dropdown-item.dropdown-toggle > span{display:block;float: right;}

.dropdown-menu-list .head .desc .title{font-weight: 600;
  font-size: 18px;}
  .dropdown-menu-list .head ul.list-unstyled li a {color: #4b7678;
  font-weight: 600;
  font-size: 15px;}
  .dropdown-menu-list .btn-block a{color: #000;font-weight: 600;}
  .dropdown-menu-list .btn-block a i{font-size: 14px;}

  /*  */
  .right-sec{display: flex;align-items: center;}
  .right-sec > .cart_btn {margin: 0 15px;}
  .right-sec .search-input-box {position: relative;width:200px}
  .right-sec .search-input-box input {border-radius: 50px;padding-right: 36px;}
  .right-sec .search-input-box svg{position: absolute;right: 10px;top: 10px;width: 25px;}

  .right-sec .border-btn {
  border: 1px solid #ddd;
  border-radius: 50px;
  width: 35px;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: transparent;
  color: #fff;
}

.right-sec .user-menu .dropdown-menu {min-width: 250px;
  border-radius: 10px;
  padding: 20px 10px;
  box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);}
  .right-sec .user-menu .dropdown-menu  a{font-family: "Public Sans";
  font-size: 16px;
  padding: 6px 15px;}


 .dropdown-menu-list .head img{width: 150px;height:150px;max-width: 100%;margin: auto;object-fit: cover;margin-bottom: 10px}


    </style>
</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <li class="nav-item dropdown custom-megamenu" id="Home Solutions">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Home Solutions
                    </a>
                    @php
                      $homsolution = get_category_list(94) ?? [];
                     $home_sub_category = get_category_list(94 , 8)['subcate'] ?? [];

                     $newproducts =  get_new_product(8);
                     
                    @endphp
                    <ul class="dropdown-menu" aria-labelledby="Home Solutions">
                        <li class="dropdown-submenu show">
                            <a class="dropdown-item dropdown-toggle" href="#">New Arrivals<span><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="dropdown-menu show">
                                <li>
                                    <div class="form-row px-3">
                                        @foreach($newproducts as  $newproduct)
                                        <div class="col-md-3 d-flex">

                                            <div class="dropdown-menu-list w-100">
                                                <div class="head">
                                                    <div class="img-wrap">
                                                        <img class="img-fluid" src="{{uploaded_asset($newproduct['thumbnail_img'])}}" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        <h5 class="title">{{$newproduct->name}}</h5>
                                                    </div>
                                                    <ul class="list-unstyled">
                                                        <li><a href="#">{{$newproduct->slug}}</a></li>
                                                    </ul>
                                                </div>
                                                <div class="btn-block">
                                                    <a href="javascript:void(0)">Shop All <i class="fa fa-chevron-right"></i></a>
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
                            $home_childsub_category = get_category_list($home_sub_cate->id , 8)['subcate'] ?? [];

                            //dd($products,$home_childsub_category);
                            @endphp
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">{{$home_sub_cate->name}} <span><i class="fa fa-chevron-right"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="form-row px-3">
                                        @if(!empty($products))
                                            @foreach( $products as  $newproduct)
                                            <div class="col-md-3 d-flex">

                                                <div class="dropdown-menu-list w-100">
                                                    <div class="head">
                                                        <div class="img-wrap">
                                                            <img class="img-fluid" src="{{uploaded_asset($newproduct['thumbnail_img'])}}" alt="">
                                                        </div>
                                                        <div class="desc">
                                                            <h5 class="title">{{$newproduct->name}}</h5>
                                                        </div>
                                                        <ul class="list-unstyled">
                                                            <li><a href="#">{{$newproduct->slug}}</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="btn-block">
                                                        <a href="javascript:void(0)">Shop All <i class="fa fa-chevron-right"></i></a>
                                                    </div>
                                                </div>

                                            </div>
                                            @endforeach
                                        @elseif(!empty($home_childsub_category))
                                            @foreach( $home_childsub_category as  $newproduct)
                                            <div class="col-md-3 d-flex">

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
                                                        <a href="javascript:void(0)">Shop All <i class="fa fa-chevron-right"></i></a>
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
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown custom-megamenu" id="Business Solutions">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Business Solutions
                    </a>
                    @php
                        $Business_solutions = get_category_list(96) ?? [];
                        $Business_sub_category = get_category_list(96 , 8)['subcate'] ?? [];
                        //dd($Business_solutions);
                    @endphp
                    <ul class="dropdown-menu" aria-labelledby="Business Solutions">
                        @foreach($Business_sub_category as $bus_sub_cate)
                            @php
                                $products     = get_top_selling_product($bus_sub_cate->id , 8) ?? null;
                                $bus_childsub_category = get_category_list($bus_sub_cate->id , 8)['subcate'] ?? [];

                             //dd($products,$bus_childsub_category);
                            @endphp
                            <li class="dropdown-submenu show">
                                <a class="dropdown-item dropdown-toggle" href="#">{{$bus_sub_cate->name}}</a>
                                <ul class="dropdown-menu show">
                                    <li>
                                        <div class="form-row px-3">
                                            @if(count($products)>0)
                                                @foreach( $products as  $newproduct)
                                                <div class="col-md-3 d-flex">

                                                    <div class="dropdown-menu-list w-100">
                                                        <div class="head">
                                                            <div class="img-wrap">
                                                                <img class="img-fluid" src="{{uploaded_asset($newproduct['thumbnail_img'])}}" alt="">
                                                            </div>
                                                            <div class="desc">
                                                                <h5 class="title">{{$newproduct->name}}</h5>
                                                            </div>
                                                            <ul class="list-unstyled">
                                                                <li><a href="#">{{$newproduct->slug}}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-block">
                                                            <a href="javascript:void(0)">Shop All <i class="fa fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            @elseif(count($bus_childsub_category) > 0)
                                                @foreach( $bus_childsub_category as  $newproduct)
                                                <div class="col-md-3 d-flex">

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
                                                            <a href="javascript:void(0)">Shop All <i class="fa fa-chevron-right"></i></a>
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
                        @endforeach    
                    </ul>
                </li>
                <li class="nav-item dropdown custom-megamenu" id="Business Solutions">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Smart Solution
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="Business Solutions">
                        <li class="dropdown-submenu show">
                            <a class="dropdown-item dropdown-toggle" href="#">Product 1</a>
                            <ul class="dropdown-menu show">
                                <li>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="dropdown-menu-list">
                                                <div class="head">
                                                    <div class="img-wrap">
                                                        <img class="img-fluid" src="https://login2design.in/zoobla_staging/public/uploads/all/8yqbKTBPYNxtOgVXKRxQm4CBBC2VgFWlUXiyNvvT.png" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        <h5 class="title">Title Menu One</h5>
                                                        <h6 class="sub-title">Title Menu One</h6>
                                                    </div>
                                                    <ul class="list-unstyled">
                                                        <li><a href="#">Custom Menu</a></li>
                                                        <li><a href="#">Custom Menu</a></li>
                                                    </ul>
                                                </div>
                                                <div class="btn-block">
                                                    <a href="javascript:void(0)">Shop All <i class="fa fa-chevron-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">b</div>
                                        <div class="col-md-3">c</div>
                                        <div class="col-md-3">c</div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Product 2</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Subproduct 1</a></li>
                                <li><a class="dropdown-item" href="#">Subproduct 2</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Product 3</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Subproduct 3</a></li>
                                <li><a class="dropdown-item" href="#">Subproduct 4</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">
                    Industries
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">
                    Partners
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">
                    Support
                    </a>
                </li>
            </ul>
        </div>

        <div class="right-sec">
            <div class="search-wrapper">
                <form action="" method="GET" class="stop-propagation">
                    <div class="d-flex position-relative align-items-center">
                        <div class="search-input-box">
                            <input type="text" class="form-control fs-14 " id="search" name="keyword" placeholder="Search Here" autocomplete="off" style="border-color:#fff !important;">

                            <svg id="Group_723" data-name="Group 723" xmlns="http://www.w3.org/2000/svg" width="20.001" height="20" viewBox="0 0 20.001 20">
                                <path id="Path_3090" data-name="Path 3090" d="M9.847,17.839a7.993,7.993,0,1,1,7.993-7.993A8,8,0,0,1,9.847,17.839Zm0-14.387a6.394,6.394,0,1,0,6.394,6.394A6.4,6.4,0,0,0,9.847,3.453Z" transform="translate(-1.854 -1.854)" fill="#b5b5bf"></path>
                                <path id="Path_3091" data-name="Path 3091" d="M24.4,25.2a.8.8,0,0,1-.565-.234l-6.15-6.15a.8.8,0,0,1,1.13-1.13l6.15,6.15A.8.8,0,0,1,24.4,25.2Z" transform="translate(-5.2 -5.2)" fill="#b5b5bf"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
            <div class="cart_btn">
                <a href="javacript::void(0)" class="open-cart border-btn" onclick="openCart()"><i class="fa-solid fa-cart-shopping" id="cart_items" aria-hidden="true"></i></a>
            </div>
           
            <!--  -->
            <div class="dropdown user-menu position-static">
                <button type="button" class="border-btn" data-toggle="dropdown">
                    <i class="fa-solid fa-user" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="">Login</a>
                    <a class="dropdown-item" href="">Sign Up</a>
                    <a class="dropdown-item" href="">Partner</a>
                </div>
            </div> 
        </div>
    </div>
</nav>
</header>

<div>
    <img class="img-fluid" style="width:100%" src="https://login2design.in/zoobla_staging/public/uploads/all/g7YZDJpm4QLvMRNYHevkgNFjG4wRG5NJbGJdVRNu.png" alt="">
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('.dropdown-submenu .dropdown-toggle').on('click', function(e) {
            var $el = $(this);
            var $parent = $(this).offsetParent(".dropdown-menu");
            if (!$el.next().hasClass('show')) {
                $el.parents('.dropdown-menu').first().find('.show').removeClass('show');
            }
            var $submenu = $(this).next('.dropdown-menu');
            $submenu.toggleClass('show');
            $(this).parent('li.dropdown-submenu').toggleClass('show');
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                $('.dropdown-submenu .show').removeClass('show');
            });
            return false;
        });
    });
</script>

</body>
</html>

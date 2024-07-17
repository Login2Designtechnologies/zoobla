<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>ZOOBLA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/public/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="shortcut icon" type="image/x-icon" href="public/public/assets/images/favicon.ico">
    <link rel="stylesheet" href="public/assets/css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/style2.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/custom.css">
    <link rel="stylesheet" href="public/assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />



</head>

<body>

    <header class="header color-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="header-logo">
                    <a href="index.html" class="logo-warp">
                        <img class="img-fluid" src="public/assets/images/zoobla Logo Final File-03.png" alt="Zoobla" style="width: 165px;" />
                    </a>
                </div>
    
                <button
                    style="background-color: transparent !important;"
                    class="navbar-toggler border-0"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <img class="w-30-30" src="public/assets/images/menu.png" onclick="toggle()" alt="" />
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="cloudstorage.html">Cloud Storage</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown_zoobla">
                                <button class="dropbtn_zoobla">
                                    <a>Business</a>
                                </button>
                                <div class="dropdown-content_zoobla" style="margin-left: -11% !important; margin-left: 0% !important;">
                                    <div class="menu_box" style="display: flex; width: 100%;">
                                        <div class="me-3 business-hover-menu">
                                            <h5 style="font-size: 1rem; font-weight: 800; border-bottom: 1px solid lightgray; padding-bottom: 10px;">
                                                Video Analytics
                                            </h5>
                                            <a href="video-analytics.html" onmouseenter="changeImage('images/Homepage/dome-img2.png')">Video analytics</a>
                                            <a href="facial-recognition.html" onmouseenter="changeImage('images/Homepage/c2.png')">Facial Recognition</a>
                                            <a href="people-counter.html" onmouseenter="changeImage('images/Homepage/c.png')">People Counter</a>
                                            <a href="zoobla-people.html" onmouseenter="changeImage('images/Homepage/c3.png')">Zoobla People</a>
                                            <a href="cash-register-control.html" onmouseenter="changeImage('images/Homepage/c3.png')">Cash register control</a>
                                            <a href="access-control.html" onmouseenter="changeImage('images/Homepage/c3.png')">Access Control</a>
                                            <a href="licence-plate.html" onmouseenter="changeImage('images/Homepage/c3.png')">License Plate Recognition</a>
                                            <a href="retail-security.html" onmouseenter="changeImage('images/Homepage/c3.png')">Retail Security</a>
                                        </div>
                                        <div class="business-hover-menu2">
                                            <h5 style="font-size: 1rem; font-weight: 800; border-bottom: 1px solid lightgray; padding-bottom: 10px;">
                                                Connect To The Cloud
                                            </h5>
                                            <a href="zoobla-bridge.html" onmouseenter="changeImage('images/Homepage/dome-img2.png')">Zoobla Bridge</a>
                                            <a href="loss-prevention.html" onmouseenter="changeImage('images/Homepage/c2.png')">Loss Prevention</a>
                                            <a href="save-data.html" onmouseenter="changeImage('images/Homepage/c.png')">Save Data In Cloud</a>
                                            <a href="home-security.html" onmouseenter="changeImage('images/Homepage/c3.png')">Home Security</a>
                                            <a href="all-industries.html" onmouseenter="changeImage('images/Homepage/c3.png')">All Industries Data Secure</a>
                                            <a href="features.html" onmouseenter="changeImage('images/Homepage/c3.png')">Features</a>
                                            <a href="get-started.html" onmouseenter="changeImage('images/Homepage/c3.png')"> Get Started</a>
    
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-12 col-lg-6">
                                                                <div class="modalheader-img">
                                                                    <img src="public/assets/images/headermodal-img.gif" alt="solution" />
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
                                        <img src="public/assets/images/dome-img2.png" alt="" id="imagechangemenu1" />
                                    </div>
                                </div>
                            </div>
                        </li>
    
                        <li class="nav-item me-3 dropdownshow position-relative">
                            <a class="nav-link fs-14 text-capitalize" href="">
                                shop
                            </a>
    
                            <div class="drodpwncust w-100">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-md-4 col-lg-3">
                                            <div class="left-tab scrollcs">
                                                <ul class="nav nav-tabs list-unstyled lh-lg listside text-start" id="example-tabs" role="tablist">
                                                    <div class="sidenav">
                                                        <li class="tabs-title text-start">
                                                            <a href="#10" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">WIFI Cameras</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#11" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">PTZ Cameras</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#12" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Doorbells</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#13" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Solar Cameras</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#14" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Analog Cameras</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#15" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Network Video Recorder</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#16" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Digital Video Recorder</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#17" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Complete System</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#18" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">IP Cameras</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#19" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Security Camera Kits</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#20" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">POE Camera Kit</a>
                                                        </li>
                                                        <li class="tabs-title text-start">
                                                            <a href="#21" class="text-start blackClass" role="tab" data-toggle="tab" style="font-size: 14px;">Accesories</a>
                                                        </li>
                                                    </div>
                                                </ul>
                                                <a href="viewAllCategories.html" class="me-2 btncust text-center d-block text-white text-capitalize text-decoration-none">
                                                    all Categories
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-8 ht-tab" id="tab-contents">
                                            <div class="right-side scrollcs p-4 pt-2 tab-content" id="v-pills-tabContent">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">WiFi Cameras</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Outdoor</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/13.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        Dc 12V2A Home Security Kit Ip Camera
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Indoor</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Baby Monitor</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Wireless Camera Kit</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/n-21.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        WIFI Camera Wireless
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">3MP WiFi NVR Kit</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">5MP WiFi NVR Kit</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">WiFi LCD NVR Kit</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/n-26.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        Microphone And Speaker 10 Ch Solar Panel Camera
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Wireless IP Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Wireless NVR 4 Ch</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Wireless NVR 8 Ch</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Battery AI Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">WiFi AI Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Solar Powered AI Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">PTZ Cameras</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/n-27.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        wifi PTZ camera 6 infrared LED 6 white LED
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">DoorBell Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Wifi Doorbell</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Video Doorbells</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Solar Cameras</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/tb-16.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        2MP Built-in Rechargeable Battery Waterproof
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">4G-Solar-Powered-PTZ-Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">3MP-HD-wifi-security-camera-battery</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Battery Camera Kit</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Outdoor Battery Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Indoor Battery Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Solar Powered Battery Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">4 Channels</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">8 Channels</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">16 Channels</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">32 Channels</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">64Channels</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">128 Channels</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">256 Channels</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">4 Channel</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">8 Channel</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">16 Channel</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">32 Channel</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">4CH Complete Systems</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/n-31.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        Professional Battery Camera System Kit
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">8CH Complete Systems</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">16CH Complete Systems</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">32CH Complete Systems</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">64CH Complete Systems</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Bullet Cameras</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/tb-20.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        ip camera cctv camera mini Bullet Network
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Turret Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">License Plate Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Floodlight Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/tb-13.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        Smart life Floodlight Night vision security camera
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Wall Light Camera</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Analog HD Camera Kits</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">PoE IP Camera Kits</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">POE Wired Camera System Kit</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">4CH Camera Kit(PoE)</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">8CH Camera Kit(PoE)</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6">
                                                                        <div class="col">
                                                                            <div>
                                                                                <a href="single_product_view.html" class="d-block text-center text-decoration-none fs-14">
                                                                                    <img src="public/assets/images/tb-6.png" class="img-fluid" />
                                                                                    <p class="text-main">
                                                                                        Inch Monitor 4pcs 3Mp Camera Kit
                                                                                    </p>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">16CH Camera Kit(PoE)</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">24CH Camera Kit(PoE)</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">32CH Camera Kit(PoE)</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">POE NVR /IP NVR</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="retail">
                                                        <div class="row">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                    <li class="breadcrumb-item fs-14">
                                                                        <a class="text-decoration-none text-dark text-capitalize" href="more-products.html">
                                                                            more products
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-comparison.html" class="text-decoration-none">
                                                                            product comparison
                                                                        </a>
                                                                    </li>
                                                                    <li class="breadcrumb-item fs-14 active text-dark" aria-current="page">
                                                                        <a href="product-finder.html" class="text-decoration-none">
                                                                            product finder
                                                                        </a>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Home Security</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Touch Screen Panel</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Door Sensor</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Window Sensor</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Motion Detector</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Glass Break Detector</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Key Remote</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Medical Button</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Environmental Detectors</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Smoke Detector</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 ht-ul">
                                                                <div style="margin: 0px 0 0 20px;">
                                                                    <h5 class="text-black-1 fw-bold text-capitalize mb-3">Flood Sensor</h5>
    
                                                                    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-6"></div>
                                                                    <hr class="text-dark" />
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
                        </li>
                        <li class="nav-item me-3 dropdownshow-2 position-relative">
                            <a class="nav-link fs-14 text-capitalize" href="">
                                product
                            </a>
    
                            <div class="drodpwncust-p w-100">
                                <div class="container">
                                    <div class="row g-3">
                                        <div class="col-md-8 col-lg-9">
                                            <div class="right-side p-4 py-3 scrollcs">
                                                <div class="text-center mb-2">
                                                    <h5 class="fw-semibold text-main text-capitalize">cameras</h5>
                                                </div>
                                                <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-lg-4">
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/tb-16.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">2MP Built-in Rechargeable Battery Waterproof</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        2MP Built-in Rechargeable Battery Waterproof
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/tb-13.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">Smart life Floodlight Night vision security camera</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        Smart life Floodlight Night vision security camera
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/13.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">Dc 12V2A Home Security Kit Ip Camera</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        Dc 12V2A Home Security Kit Ip Camera
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/n-26.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">Microphone And Speaker 10 Ch Solar Panel Camera</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        Microphone And Speaker 10 Ch Solar Panel Camera
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/n-31.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">Professional Battery Camera System Kit</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        Professional Battery Camera System Kit
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/tb-20.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">ip camera cctv camera mini Bullet Network</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        ip camera cctv camera mini Bullet Network
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/tb-6.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">Inch Monitor 4pcs 3Mp Camera Kit</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        Inch Monitor 4pcs 3Mp Camera Kit
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="single_product_view.html" class="text-decoration-none text-center position-relative bg-light-main rounded-4 card h-100 border-hover">
                                                            <div class="badge-cust text-uppercase">
                                                                4k
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="overflow-hidden">
                                                                    <div class="padCard">
                                                                        <img src="public/assets/images/n-27.png" class="img-fluid w-75h m-auto" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h6 class="text-capitalize mb-1 fs-15 fw-semibold m-auto text-dark text-truncate col-8">wifi PTZ camera 6 infrared LED 6 white LED</h6>
                                                                    <p class="text-gray fs-13 mb-0 text-truncate col-12">
                                                                        wifi PTZ camera 6 infrared LED 6 white LED
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="#" class="text-decoration-none text-main fw-semibold fs-12 text-capitalize">
                                                        shop & compare cameras
                                                        <span class="ps-2">
                                                            <img src="public/assets/images/next.png" style="width: 16px;" class="img-fluid" />
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            <div class="p-4 py-3 scrollcs doorBells">
                                                <div class="text-center mb-2">
                                                    <h5 class="fw-semibold text-main text-capitalize">doorbells</h5>
                                                </div>
                                                <div class="row g-3 justify-content-center"></div>
                                                <div class="mt-3 ps-lg-4">
                                                    <a href="#" class="text-decoration-none text-main fw-semibold fs-12 text-capitalize">
                                                        shop & compare cameras
                                                        <span class="ps-2">
                                                            <img src="public/assets/images/next.png" style="width: 16px;" class="img-fluid" />
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link" href="solutions.html">Solutions</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link" href="industries.html">Industries</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link" href="partners.html">Partners</a>
                        </li>
                    </ul>
    
                    <button class="dropbtn_zoobla header-icon header-iconbtn">
                        <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </button>
    
                    <button class="dropbtn_zoobla header-icon">
                        <a href=" cart.html "><i class="fa-solid fa-cart-shopping me-3"></i></a>
                    </button>
    
                    <form class="d-flex" role="search">
                        <div class="dropdown_zoobla">
                            <button class="dropbtn_zoobla header-icon">
                                <i class="fa-solid fa-user me-3"></i>
                            </button>
    
                            <div class="dropdown-content_zoobla dropdown-button-profile">
                                <div>
                                    <a class="dropdown-item" href="login-page.html">Log In</a>
                                    <a class="dropdown-item" href="signup.html">Sign Up</a>
                                    <a class="dropdown-item" href="register-partner.html">Partner</a>
                                </div>
                            </div>
                        </div>
                        <!-- <button type="button" class="btn btn-primary btn-outline-success header-icon" data-bs-toggle="modal" data-bs-target="#exampleModal">
        
        
        </button> -->
    
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Book Demo
                        </button>
    
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <div class="modalheader-img">
                                                <img src="public/assets/images/headermodal-img.gif" alt="solution" />
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
                                                        <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" />
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" />
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="Mobile No" class="form-control" name="mobile" placeholder="Mobile No" aria-label="Mobail No" aria-describedby="basic-addon1" />
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
                    </form>
                </div>
            </nav>
        </div>
    </header>
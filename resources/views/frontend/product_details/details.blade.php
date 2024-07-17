<style>
    .border-btmcustom{
        border-bottom: 1px solid #000;
        width: 100%;
        display: flex;
        margin-bottom: 10px
    }
    #chosen_price_div .product-quantity .btn-icon.btn-sm.btn-light{
        border: none;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }
    #tab_default_1 .text-left.aiz-editor-data{
        overflow: auto !important;
    }
    #tab_default_1 .cke_show_border td{
        border: 1px solid #e9e2e2;
        padding: 12px 2px;
    }
    #tab_default_1 .cke_show_border td p{
        white-space: nowrap;
    }
    #tab_default_1 h1{
        font-size: 26px;
        font-weight: 700;
        color: #052f39;
    }
    #tab_default_1 h2{
        font-size: 23px;
        font-weight: 700;
        color: #1fade5;
    }
    #tab_default_1 .cke_show_border h3{
        font-size: 18px;
    }
    #tab_default_1 table.cke_show_border{
  overflow-x: auto;
}
#tab_default_1 .cke_show_border td .cke_show_border td:first-child{
    border-right: 1px solid gray;
    padding: 5px 2px;
}
#tab_default_1 .cke_show_border td .cke_show_border tr:first-child{
  border-bottom: 1px solid gray;
}
#tab_default_1 .cke_show_border td .cke_show_border td{
  border: none;
}


.snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: 20%;
  background-color: #54b1d5;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

.snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
.aiz-megabox .aiz-megabox-elem {
  border: 1px solid #c0c0c6;}
</style>
{{-- @dd(json_decode ($detailedProduct->product_translations[0]['specification'])) --}}
{{-- @dd($cloud_data) --}}
<!-- select modal popup -->
<style type="text/css">
          .calculator-data-sec .contant-a h2 {
                font-size: 40px;
                font-weight: 700;
                color: #fff;
            }

            /* Chrome, Safari, Edge, Opera */
           .calculator-data-sec input::-webkit-outer-spin-button,
           .calculator-data-sec input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            .calculator-data-sec input[type="number"] {
                -moz-appearance: textfield;
            }

            .calculator-data-sec .lable {
                font-size: 16px;
                color: #242424;
                font-weight: 200;
                margin-bottom: 5px;
            }
            .calculator-data-sec .addcart {
                width: 10%;
                border-radius: 5px;
                background-color: #f0f0f0;
                border: 1px solid #e5e5e5;
                color: #3a6cab;
                font-size: 16px;
            }
            .calculator-data-sec .text-center {
                font-weight: 400;
                color: #000;
            }
            .calculator-data-sec .mx-3.crt {
                color: #000;
                font-weight: 400;
                font-size: 14px;
            }
            .calculator-data-sec .minusbtn {
                border-radius: 100% !important;
                border: 1px solid #e5e5e5 !important;
                color: #000 !important;
                font-weight: 400;
                background-color: #f0f0f0 !important;
                display: flex;
                height: 20px;
                width: 20px;
                justify-content: center;
                align-items: center;
            }
            .calculator-data-sec .w-25.p-2.px-2.border.border-primary.border-3.rounded-3.shadow.bg-body.rounded-3.text-center {
                border-color: #2ac4f1 !important;
            }

            .calculator-data-sec .w-75.p-2.border-start.border-primary.border-3.mx-4 {
                border-color: #2ac4f1 !important;
            }

            .calculator-data-sec .contant-a p {
                margin: 10px 0px;
                color: #fff;
                font-size: 14px;
                padding-right: 35em;
                line-height: 26px;
            }
            .calculator-data-sec .contant-a {
                padding: 170px 0px;
            }
            .calculator-data-sec .calculator-data-sec h2 {
                padding: 0;
                font-size: 40px;
                font-weight: 700;
                color: #242424;
                margin-bottom: 50px;
            }
            .calculator-data-sec .supported-camera-sec.solutionn {
                padding: 0px 0px !important;
            }
            .calculator-data-sec ul.valueea {
                display: flex;
                justify-content: space-between;
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .calculator-data-sec .slidecontainer {
                width: 100%;
            }

            .calculator-data-sec .slider{
                margin-left: 15px;
                width: 95%;
            }

            .calculator-data-sec p.value-sec {
                margin: 0;
            }
            .calculator-data-sec p.value-sec {
                border: 1px solid #e5e5e5;
                background-color: #f0f0f0;
                padding: 5px 0px;
                color: #3a6cab;
                text-align: center;
                font-size: 20px;
                border-radius: 5px;
                font-family: monospace;
            }
            .calculator-data-sec p.hed-a {
                font-size: 20px;
                color: #242424;
                font-weight: 600;
                margin-bottom: 5px;
            }
            .calculator-data-sec ul.valueea li {
                color: #242424;
                font-size: 16px;
            }
            .calculator-data-sec .slidecontainer.sec-2b {
                margin-top: 70px;
            }
            .calculator-data-sec button.btn.calculatbtn:hover {
                background-color: #0056bb;
            }
            .calculator-data-sec  button.btn.calculatbtn {
                margin-top: 25px;
                background-color: #2ac4f1;
                color: #fff;
                padding: 10px 50px;
                font-size: 16px;
                font-weight: 400;
                border-radius: inherit;
            }
            .calculator-data-sec h6.total-payment {
                margin-top: 40px;
                font-size: 22px;
                font-weight: bold;
                color: #242424;
            }
            .calculator-data-sec .calculator-sec .row {
                align-items: center;
            }
            @media screen and (max-width: 768px) {
              .calculator-data-sec  .contant-a p {
                    padding-right: 0em;
                }
                .calculator-data-sec  .calculator-data-sec h2 {
                    margin-top: 30px;
                }
            }

            @media screen and (max-width: 425px) {
              .calculator-data-sec .contant-a h2 {
                    font-size: 30px;
                }
                .calculator-data-sec .contant-a {
                    padding: 60px 0px;
                }
                .calculator-data-sec .contant-a p {
                    line-height: 24px;
                    font-size: 14px;
                }
            }
            .modal-content .row{
                 background: transparent;
            }
            .calculator-data-sec .w-75.p-2.border-start.border-primary.border-3.mx-4{
                border-top: none !important;
                border-right: none !important;
                border-bottom: none !important;
            }
            #selectModal .btn.btn-danger.btn-sm.rounded-pill {
                    color: #fff;
                    background-color: #dc3545;
                    border-color: #dc3545;
            }
            #selectModal .slider{
                background-color: transparent;
            }
            #selectModal .modal-content .row{
                padding: 0px 0px;
            }
            #selectModal .modal-content .modal-header{
                border-bottom: 2px solid #21b4e6;
            }
            #selectModal .modal-content .modal-header h4{
                color: #1eb3e6;
            }
            #selectModal .modal-dialog.modal-md .modal-content{
  border-radius: 21px !important;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
            #selectModal .modal-dialog.modal-md{
                max-width: 50%;
            }
            #selectModal .modal-content button{
  padding: 8px 8px;
}
#selectModal .modal-content .modal-body{
    /* max-width: 100vh; */
    min-width: 100%;
}
#selectModal .modal-content .modal-body{
  padding: 20px 40px 10px;
}
#selectModal .modal-footer .btn.btn-submit{
  color: #fff !important;
}

        </style>

       
<div class="text-left p-4 bg-gray">

            @if (home_price($detailedProduct) != home_discounted_price($detailedProduct))
                <div class="row no-gutters ml-0">
                     <!-- Product Name -->
                    <h1 class="fs-28 fw-400 mb-0 pro-name">
                        {{ $detailedProduct->getTranslation('name') }}
                    </h1>
                    <!-- <div class="col-sm-2">
                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>
                    </div> -->
                    <!-- Brand Logo & Name -->
                    @if ($detailedProduct->brand != null)

                    <div class="row no-gutters ml-0">
                        <div class="col-sm-6 d-flex flex-wrap align-items-center mb-2 mt-2">
                            <span class="text-secondary fs-14 fw-400 mr-4 w-50px">{{ translate('Brand') }}</span>
                            <a href="{{ route('products.brand', $detailedProduct->brand->slug) }}"
                                class="text-reset hov-text-primary fs-14 fw-700">{{ $detailedProduct->brand->name }}</a>
                        </div>
                        <div class="col-sm-6 d-flex align-items-center justify-content-end">
                            <!-- Discount Price -->
                            <strong class="fs-20 fw-700 text-primary">
                                {{ home_discounted_price($detailedProduct) }}
                            </strong>
                            <!-- Home Price -->
                            <del class="fs-18 opacity-60 ml-2">
                                {{ home_price($detailedProduct) }}
                            </del>
                            <!-- Unit -->
                            <!-- @if ($detailedProduct->unit != null)
                                <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span>
                            @endif -->
                            <!-- Discount percentage -->
                            <!-- @if (discount_in_percentage($detailedProduct) > 0)
                                <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center p-1"
                                    style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($detailedProduct) }}%</span>
                            @endif -->
                            <!-- Club Point -->
                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1"
                                    style="width: fit-content;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 12 12">
                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"
                                                cy="6" r="6" transform="translate(973 633)"
                                                fill="#fff" />
                                            <g id="Group_23920" data-name="Group 23920"
                                                transform="translate(973 633)">
                                                <path id="Path_28698" data-name="Path 28698"
                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" />
                                                <path id="Path_28699" data-name="Path 28699"
                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" opacity="0.5" />
                                                <path id="Path_28700" data-name="Path 28700"
                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                    fill="#f3af3d" />
                                            </g>
                                        </g>
                                    </svg>
                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:
                                        {{ $detailedProduct->earn_point }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    
                </div>
                    
            @else
                
                    
                <div class="row no-gutters mb-2 ml-0">
                    <!-- <div class="col-sm-2">
                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>
                    </div> -->
                    <div class="col-sm-10">
                        <div class="d-flex align-items-center">
                            <!-- Discount Price -->
                            <strong class="fs-16 fw-700 text-primary">
                                {{ home_discounted_price($detailedProduct) }}
                            </strong>
                            <!-- Unit -->
                            @if ($detailedProduct->unit != null)
                                <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                            @endif
                            <!-- Club Point -->
                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                            
                                <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1"
                                
                                    style="width: fit-content;">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    
                                        viewBox="0 0 12 12">
                                        
                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                            
                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"
                                            
                                                cy="6" r="6" transform="translate(973 633)"
                                                
                                                fill="#fff" />
                                                
                                            <g id="Group_23920" data-name="Group 23920"
                                            
                                                transform="translate(973 633)">
                                                
                                                <path id="Path_28698" data-name="Path 28698"
                                                
                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                    
                                                    fill="#f3af3d" />
                                                    
                                                <path id="Path_28699" data-name="Path 28699"
                                                
                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                    
                                                    fill="#f3af3d" opacity="0.5" />
                                                    
                                                <path id="Path_28700" data-name="Path 28700"
                                                
                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                    
                                                    fill="#f3af3d" />
                                                    
                                            </g>

                                        </g>

                                    </svg>

                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:

                                        {{ $detailedProduct->earn_point }}</small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif

            <div class="row align-items-center mb-2 ml-0">
                <!-- Review -->
                <!-- @if ($detailedProduct->auction_product != 1)
                    <div class="col-12">
                        @php
                            $total = 0;
                            $total += $detailedProduct->reviews->count();
                        @endphp
                        <span class="rating rating-mr-1">
                            {{ renderStarRating($detailedProduct->rating) }}
                        </span>
                        <span class="ml-1 opacity-50 fs-14">({{ $total }}
                            {{ translate('reviews') }})</span>
                    </div>
                @endif -->
                <!-- Estimate Shipping Time -->
                @if ($detailedProduct->est_shipping_days)
                    <div class="col-auto fs-14 mt-1">
                        <small class="mr-1 opacity-50 fs-14">{{ translate('Estimate Shipping Time') }}:</small>
                        <span class="fw-500">{{ $detailedProduct->est_shipping_days }} {{ translate('Days') }}</span>
                    </div>
                @endif
                <!-- In stock -->
                @if ($detailedProduct->digital == 1)
                    <div class="col-12 mt-1">
                        <span class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock') }}</span>
                    </div>
                @endif
            </div>

            
            
            <span class='row border-btmcustom ml-0'></span>
            <!-- ./Add on Section -->

            <div class="row align-items-center ml-0">
                <div class="col-lg-12">
                    <div class="right-tick-info">

                        <h6 class="ttl fs-14"><?=$detailedProduct->product_translations[0]['short_desc']?></h6>
                        
                        
                        @php
                            
                            $specification = json_decode($detailedProduct->product_translations[0]['specification']) ?? [];

                        @endphp
                        <ul class="">

                            @foreach($specification as $key => $value)

                                <li class="d-flex align-items-center">
                                    <span class="pe-2">
                                        <img src="https://login2design.in/zoobla_reference//public/assets/images/checked.png" class="img-fluid">
                                    </span>
                                    <span class="fs-14">
                                        {{$value}}
                                    </span>
                                </li>
                                
                            @endforeach
                           
                            {{-- <li class="d-flex align-items-center">
                                <span class="pe-2">
                                    <img src="https://login2design.in/zoobla_reference//public/assets/images/checked.png" class="img-fluid">
                                </span>
                                <span class="fs-14">
                                    Rechargeable Battery
                                </span>
                            </li>

                            <li class="d-flex align-items-center">
                                <span class="pe-2">
                                    <img src="https://login2design.in/zoobla_reference//public/assets/images/checked.png" class="img-fluid">
                                </span>
                                <span class="fs-14">
                                Premium two-way audio
                                </span>
                            </li>

                            <li class="d-flex align-items-center">
                                <span class="pe-2">
                                    <img src="https://login2design.in/zoobla_reference//public/assets/images/checked.png" class="img-fluid">
                                </span>
                                <span class="fs-14">
                                Integrated Spotlight
                                </span>
                            </li>

                            <li class="d-flex align-items-center">
                                <span class="pe-2">
                                    <img src="https://login2design.in/zoobla_reference//public/assets/images/checked.png" class="img-fluid">
                                </span>
                                <span class="fs-14">
                                Ultra-wide viewing angle
                                </span>
                            </li>

                            <li class="d-flex align-items-center">
                                <span class="pe-2">
                                    <img src="https://login2design.in/zoobla_reference//public/assets/images/checked.png" class="img-fluid">
                                </span>
                                <span class="fs-14">
                                    Arlo Secure trial included
                                </span>
                            </li> --}}
                        </ul>
                    </div>
                </div>

                <!-- Ask about this product -->
                {{--<div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 mb-3">
                    <a href="javascript:void();" onclick="goToView('product_query')" class="text-primary fs-14 fw-600 d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                            <g id="Group_25571" data-name="Group 25571" transform="translate(-975 -411)">
                                <g id="Path_32843" data-name="Path 32843" transform="translate(975 411)" fill="#fff">
                                    <path
                                        d="M 16 31 C 11.9933500289917 31 8.226519584655762 29.43972969055176 5.393400192260742 26.60659980773926 C 2.560270071029663 23.77347946166992 1 20.00665092468262 1 16 C 1 11.9933500289917 2.560270071029663 8.226519584655762 5.393400192260742 5.393400192260742 C 8.226519584655762 2.560270071029663 11.9933500289917 1 16 1 C 20.00665092468262 1 23.77347946166992 2.560270071029663 26.60659980773926 5.393400192260742 C 29.43972969055176 8.226519584655762 31 11.9933500289917 31 16 C 31 20.00665092468262 29.43972969055176 23.77347946166992 26.60659980773926 26.60659980773926 C 23.77347946166992 29.43972969055176 20.00665092468262 31 16 31 Z"
                                        stroke="none" />
                                    <path
                                        d="M 16 2 C 12.26045989990234 2 8.744749069213867 3.456249237060547 6.100500106811523 6.100500106811523 C 3.456249237060547 8.744749069213867 2 12.26045989990234 2 16 C 2 19.73954010009766 3.456249237060547 23.2552490234375 6.100500106811523 25.89949989318848 C 8.744749069213867 28.54375076293945 12.26045989990234 30 16 30 C 19.73954010009766 30 23.2552490234375 28.54375076293945 25.89949989318848 25.89949989318848 C 28.54375076293945 23.2552490234375 30 19.73954010009766 30 16 C 30 12.26045989990234 28.54375076293945 8.744749069213867 25.89949989318848 6.100500106811523 C 23.2552490234375 3.456249237060547 19.73954010009766 2 16 2 M 16 0 C 24.8365592956543 0 32 7.163440704345703 32 16 C 32 24.8365592956543 24.8365592956543 32 16 32 C 7.163440704345703 32 0 24.8365592956543 0 16 C 0 7.163440704345703 7.163440704345703 0 16 0 Z"
                                        stroke="none" fill="#f3af3d" />
                                </g>
                                <path id="Path_32842" data-name="Path 32842"
                                    d="M28.738,30.935a1.185,1.185,0,0,1-1.185-1.185,3.964,3.964,0,0,1,.942-2.613c.089-.095.213-.207.361-.344.735-.658,2.252-2.032,2.252-3.555a2.228,2.228,0,0,0-2.37-2.37,2.228,2.228,0,0,0-2.37,2.37,1.185,1.185,0,1,1-2.37,0,4.592,4.592,0,0,1,4.74-4.74,4.592,4.592,0,0,1,4.74,4.74c0,2.577-2.044,4.432-3.028,5.333l-.284.255a1.89,1.89,0,0,0-.243.948A1.185,1.185,0,0,1,28.738,30.935Zm0,3.561a1.185,1.185,0,0,1-.835-2.026,1.226,1.226,0,0,1,1.671,0,1.061,1.061,0,0,1,.148.184,1.345,1.345,0,0,1,.113.2,1.41,1.41,0,0,1,.065.225,1.138,1.138,0,0,1,0,.462,1.338,1.338,0,0,1-.065.219,1.185,1.185,0,0,1-.113.207,1.06,1.06,0,0,1-.148.184A1.185,1.185,0,0,1,28.738,34.5Z"
                                    transform="translate(962.004 400.504)" fill="#f3af3d" />
                            </g>
                        </svg>
                        <span class="ml-2 text-primary animate-underline-blue">{{ translate('Product Inquiry') }}</span>
                    </a>
                </div>

                <div class="col mb-3">
                    @if ($detailedProduct->auction_product != 1)
                        <div class="d-flex">
                            <!-- Add to wishlist button -->
                            <a href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})"
                                class="mr-3 fs-14 text-dark opacity-60 has-transitiuon hov-opacity-100">
                                <i class="la la-heart-o mr-1"></i>
                                {{ translate('Add to Wishlist') }}
                            </a>
                            <!-- Add to compare button -->
                            <a href="javascript:void(0)" onclick="addToCompare({{ $detailedProduct->id }})"
                                class="fs-14 text-dark opacity-60 has-transitiuon hov-opacity-100">
                                <i class="las la-sync mr-1"></i>
                                {{ translate('Add to Compare') }}
                            </a>
                        </div>
                    @endif
                </div>--}}

                @if (home_price($detailedProduct) != home_discounted_price($detailedProduct))


                        <div class="row no-gutters mb-2 ml-0">
                            <div class="col-sm-12">
                                <div class="radio-sec row">
                           {{-- @foreach(json_decode($detailedProduct->choice_options) as $attribute)
                               @php
                                    $all_attribute_values = \App\Models\AttributeValue::where('attribute_id', $attribute->attribute_id)->first();
                               @endphp
                                        <div class="col-lg-6">
                                            <input type="radio" id="radio1" name="myRadio" checked>
                                            <label for="radio1">{{ $all_attribute_values->value }}</label>
                                        </div>
                              @endforeach --}}


                                   <!--  <div class="col-lg-6">
                                        <input type="radio" id="radio2" name="myRadio">
                                        <label for="radio2"> 2 Camera Kit</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="radio" id="radio3" name="myRadio">
                                        <label for="radio3">3 Camera Kit</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="radio" id="radio4" name="myRadio">
                                        <label for="radio4">4 Camera Kits</label>
                                    </div> -->
                                </div>
                            </div>
                            <!-- Faq with hr Tag -->
                            <div class="col-lg-12"><hr></div>
                            <div class="col-lg-12">
                                <div>
                                    <a href="#section4" class="d-flex align-items-center justify-content-between text-decoration-none text-dark">
                                        <h6 class="fs-14 mb-0">FAQ</h6>
                                        <div>
                                            <img src="https://login2design.in/zoobla_reference//public/assets/images/down-arrow.png" class="img-fluid" />
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12"><hr></div>
                            <!-- ./Faq with hr Tag -->
                            
                            <!-- Price -->
                            <div class="col-sm-4">
                                <div class="text-dark fs-20 fw-700">{{ translate('Product Price') }}</div>
                            </div>
                            <div class="col-sm-8">
                                <div class="d-flex align-items-center w-100">
                                    <!-- Discount Price -->
                                    <strong class="fs-20 ml-2 fw-700 w-100">
                                        {{ home_discounted_price($detailedProduct) }}
                                         x <span> <input type="number" name="quantity"
                                            class="border-0 text-start flex-grow-1 fs-20 input-number bg-none" placeholder="1"
                                            value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}"
                                            max="10" lang="en"></span>
                                    </strong>  
                                    <!-- Home Price -->
                                    <!-- <strong class="fs-20 ml-2">
                                        {{ home_price($detailedProduct) }} x
                                    </strong> &nbsp -->
                                   
                                    <!-- Unit -->
                                    <!-- @if ($detailedProduct->unit != null)
                                        <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                    @endif -->
                                    <!-- Discount percentage -->
                                    <!-- @if (discount_in_percentage($detailedProduct) > 0)
                                        <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center p-1"
                                            style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($detailedProduct) }}%</span>
                                    @endif -->
                                    <!-- Club Point -->
                                    <!-- @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                        <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1"
                                            style="width: fit-content;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 12 12">
                                                <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                                    <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"
                                                        cy="6" r="6" transform="translate(973 633)"
                                                        fill="#fff" />
                                                    <g id="Group_23920" data-name="Group 23920"
                                                        transform="translate(973 633)">
                                                        <path id="Path_28698" data-name="Path 28698"
                                                            d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                            fill="#f3af3d" />
                                                        <path id="Path_28699" data-name="Path 28699"
                                                            d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                            fill="#f3af3d" opacity="0.5" />
                                                        <path id="Path_28700" data-name="Path 28700"
                                                            d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                            fill="#f3af3d" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:
                                                {{ $detailedProduct->earn_point }}</small>
                                        </div>
                                    @endif -->
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="row no-gutters mb-3 ml-0">
                                <div class="col-sm-6">
                                    <div class="text-secondary fs-14 fw-400">{{ translate('Product Price') }}</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <!-- Discount Price -->
                                        <!-- <strong class="fs-16 fw-700 text-primary">
                                            {{ home_discounted_price($detailedProduct) }}
                                        </strong> -->
                                        <!-- Unit -->
                                        <!-- @if ($detailedProduct->unit != null)
                                            <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                        @endif -->
                                        <!-- Club Point -->
                                        @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                            <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1"
                                                style="width: fit-content;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    viewBox="0 0 12 12">
                                                    <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                                        <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"
                                                            cy="6" r="6" transform="translate(973 633)"
                                                            fill="#fff" />
                                                        <g id="Group_23920" data-name="Group 23920"
                                                            transform="translate(973 633)">
                                                            <path id="Path_28698" data-name="Path 28698"
                                                                d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                                fill="#f3af3d" />
                                                            <path id="Path_28699" data-name="Path 28699"
                                                                d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                                fill="#f3af3d" opacity="0.5" />
                                                            <path id="Path_28700" data-name="Path 28700"
                                                                d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                                fill="#f3af3d" />
                                                        </g>
                                                    </g>
                                                </svg>
                                                <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:
                                                    {{ $detailedProduct->earn_point }}</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>

                <!-- <span class='row border-btmcustom ml-0'></span>  -->
                


            

    

    <!-- Seller Info -->
    {{--<div class="d-flex flex-wrap align-items-center">
        <div class="d-flex align-items-center mr-4">
            <!-- Shop Name -->
            @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                <span class="text-secondary fs-14 fw-400 mr-4 w-50px">{{ translate('Sold by') }}</span>
                <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                    class="text-reset hov-text-primary fs-14 fw-700">{{ $detailedProduct->user->shop->name }}</a>
            @else
                <p class="mb-0 fs-14 fw-700">{{ translate('Inhouse product') }}</p>
            @endif
        </div>
        <!-- Messase to seller -->
        @if (get_setting('conversation_system') == 1)
            <div class="">
                <button class="btn btn-sm btn-soft-warning btn-outline-warning hov-svg-white hov-text-white rounded-4"
                    onclick="show_chat_modal()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                        class="mr-2 has-transition">
                        <g id="Group_23918" data-name="Group 23918" transform="translate(1053.151 256.688)">
                            <path id="Path_3012" data-name="Path 3012"
                                d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z"
                                transform="translate(-1178 -341)" fill="#f4b650" />
                            <path id="Path_3013" data-name="Path 3013"
                                d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1"
                                transform="translate(-1182 -337)" fill="#f4b650" />
                            <path id="Path_3014" data-name="Path 3014"
                                d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                transform="translate(-1181 -343.5)" fill="#f4b650" />
                            <path id="Path_3015" data-name="Path 3015"
                                d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1"
                                transform="translate(-1181 -346.5)" fill="#f4b650" />
                        </g>
                    </svg>

                    {{ translate('Message Seller') }}
                </button>
            </div>
        @endif
    </div>

    <hr>--}}

    <!-- For auction product -->
    @if ($detailedProduct->auction_product)

        <div class="row no-gutters mb-3 ml-0">
            <div class="col-sm-2">
                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Auction Will End') }}</div>
            </div>
            <div class="col-sm-10">
                @if ($detailedProduct->auction_end_date > strtotime('now'))
                    <div class="aiz-count-down align-items-center"
                        data-date="{{ date('Y/m/d H:i:s', $detailedProduct->auction_end_date) }}"></div>
                @else
                    <p>{{ translate('Ended') }}</p>
                @endif

            </div>
        </div>

        <div class="row no-gutters mb-3 ml-0">
            <div class="col-sm-2">
                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Starting Bid') }}</div>
            </div>
            <div class="col-sm-10">
                <span class="opacity-50 fs-20">
                    {{ single_price($detailedProduct->starting_bid) }}
                </span>
                @if ($detailedProduct->unit != null)
                    <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                @endif
            </div>
        </div>

        @if (Auth::check() &&
                Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first() != null)
            <div class="row no-gutters mb-3 ml-0">
                <div class="col-sm-2">
                    <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('My Bidded Amount') }}</div>
                </div>
                <div class="col-sm-10">
                    <span class="opacity-50 fs-20">
                        {{ single_price(Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first()->amount) }}
                    </span>
                </div>
            </div>
            <hr>
        @endif

        @php $highest_bid = $detailedProduct->bids->max('amount'); @endphp
        <div class="row no-gutters my-2 mb-3 ml-0">
            <div class="col-sm-2">
                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Highest Bid') }}</div>
            </div>
            <div class="col-sm-10">
                <strong class="h3 fw-600 text-primary">
                    @if ($highest_bid != null)
                        {{ single_price($highest_bid) }}
                    @endif
                </strong>
            </div>
        </div>
    @else
        <!-- Without auction product -->
        @if ($detailedProduct->wholesale_product == 1)
            <!-- Wholesale -->
            <table class="table  mb-3">
                <thead>
                    <tr>
                        <th class="border-top-0">{{ translate('Min Qty') }}</th>
                        <th class="border-top-0">{{ translate('Max Qty') }}</th>
                        <th class="border-top-0">{{ translate('Unit Price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailedProduct->stocks->first()->wholesalePrices as $wholesalePrice)
                        <tr>
                            <td>{{ $wholesalePrice->min_qty }}</td>
                            <td>{{ $wholesalePrice->max_qty }}</td>
                            <td>{{ single_price($wholesalePrice->price) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        
            <!-- Without Wholesale -->
           {{--@if (home_price($detailedProduct) != home_discounted_price($detailedProduct))
                <div class="row no-gutters mb-3 ml-0">
                    <div class="col-sm-2">
                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>
                    </div>
                    <div class="col-sm-10">
                        <div class="d-flex align-items-center">
                            <!-- Discount Price -->
                            <strong class="fs-16 fw-700 text-primary">
                                {{ home_discounted_price($detailedProduct) }}
                            </strong>
                            <!-- Home Price -->
                            <del class="fs-14 opacity-60 ml-2">
                                {{ home_price($detailedProduct) }}
                            </del>
                            <!-- Unit -->
                            @if ($detailedProduct->unit != null)
                                <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span>
                            @endif
                            <!-- Discount percentage -->
                            @if (discount_in_percentage($detailedProduct) > 0)
                                <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center p-1"
                                    style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($detailedProduct) }}%</span>
                            @endif
                            <!-- Club Point -->
                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1"
                                    style="width: fit-content;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 12 12">
                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"
                                                cy="6" r="6" transform="translate(973 633)"
                                                fill="#fff" />
                                            <g id="Group_23920" data-name="Group 23920"
                                                transform="translate(973 633)">
                                                <path id="Path_28698" data-name="Path 28698"
                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" />
                                                <path id="Path_28699" data-name="Path 28699"
                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" opacity="0.5" />
                                                <path id="Path_28700" data-name="Path 28700"
                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                    fill="#f3af3d" />
                                            </g>
                                        </g>
                                    </svg>
                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:
                                        {{ $detailedProduct->earn_point }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row no-gutters mb-3 ml-0">
                    <div class="col-sm-2">
                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>
                    </div>
                    <div class="col-sm-10">
                        <div class="d-flex align-items-center">
                            <!-- Discount Price -->
                            <strong class="fs-16 fw-700 text-primary">
                                {{ home_discounted_price($detailedProduct) }}
                            </strong>
                            <!-- Unit -->
                            @if ($detailedProduct->unit != null)
                                <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                            @endif
                            <!-- Club Point -->
                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1"
                                    style="width: fit-content;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 12 12">
                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"
                                                cy="6" r="6" transform="translate(973 633)"
                                                fill="#fff" />
                                            <g id="Group_23920" data-name="Group 23920"
                                                transform="translate(973 633)">
                                                <path id="Path_28698" data-name="Path 28698"
                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" />
                                                <path id="Path_28699" data-name="Path 28699"
                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" opacity="0.5" />
                                                <path id="Path_28700" data-name="Path 28700"
                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                    fill="#f3af3d" />
                                            </g>
                                        </g>
                                    </svg>
                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:
                                        {{ $detailedProduct->earn_point }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif--}}
        @endif
    @endif

    @if ($detailedProduct->auction_product != 1)
        <form id="option-choice-form">
            @csrf
            <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

            @if ($detailedProduct->digital == 0)
                <!-- Choice Options -->
                @if ($detailedProduct->choice_options != null)
                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                        <div class="row no-gutters mb-3 ml-0">
                           {{-- <div class="col-sm-2">
                                <div class="text-secondary fs-14 fw-400 mt-2 ">
                                    {{ get_single_attribute_name($choice->attribute_id) }}
                                </div>
                            </div> --}}
                            <div class="col-sm-11">
                                <div class="aiz-radio-inline">
                                    <div class="row">
                                    @foreach ($choice->values as $key => $value)
                                      <div class="col-sm-6 mt-3">
                                        <label class="aiz-megabox pl-0 mb-0 w-100">
                                            <input type="radio" name="attribute_id_{{ $choice->attribute_id }}"
                                                value="{{ $value }}"
                                                @if ($key == 0) checked @endif>
                                            <span
                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-3 px-3">
                                                {{ $value }}
                                            </span>
                                        </label>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- Color Options -->
                @if ($detailedProduct->colors != null && count(json_decode($detailedProduct->colors)) > 0)
                    <div class="row no-gutters mb-3 ml-0">
                        <div class="col-sm-2">
                            <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Color') }}</div>
                        </div>
                        <div class="col-sm-10">
                            <div class="aiz-radio-inline">
                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                    <label class="aiz-megabox pl-0 mr-2 mb-0" data-toggle="tooltip"
                                        data-title="{{ get_single_color_name($color) }}">
                                        <input type="radio" name="color"
                                            value="{{ get_single_color_name($color) }}"
                                            @if ($key == 0) checked @endif>
                                        <span
                                            class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center p-1">
                                            <span class="size-25px d-inline-block rounded"
                                                style="background: {{ $color }};"></span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Quantity + Add to cart -->
                {{--<div class="row no-gutters mb-3 ml-0">
                    <div class="col-sm-2">
                        <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Quantity') }}</div>
                    </div>
                    <div class="col-sm-10">
                        
                        <div class="product-quantity d-flex align-items-center">
                            <div class="row no-gutters align-items-center aiz-plus-minus mr-3 ml-0" style="width: 130px;">
                                <button class="col-auto btn-icon btn-sm btn-light rounded-0" type="button"
                                    data-type="minus" data-field="quantity" disabled="">
                                    <i class="las la-minus"></i>
                                </button>
                                <input type="number" name="quantity"
                                    class="col border-0 text-center flex-grow-1 fs-16 input-number bg-none" placeholder="1"
                                    value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}"
                                    max="10" lang="en">
                                <button class="col-auto btn-icon btn-sm btn-light rounded-0" type="button"
                                    data-type="plus" data-field="quantity">
                                    <i class="las la-plus"></i>
                                </button>
                            </div>
                            @php
                                $qty = 0;
                                foreach ($detailedProduct->stocks as $key => $stock) {
                                    $qty += $stock->qty;
                                }
                            @endphp
                            <div class="avialable-amount opacity-60">
                                @if ($detailedProduct->stock_visibility_state == 'quantity')
                                    (<span id="available-quantity">{{ $qty }}</span>
                                    {{ translate('available') }})
                                @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                    (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                @endif
                            </div>
                        </div>
                    </div>
                </div>--}}
            @else
                <!-- Quantity -->
                <input type="hidden" name="quantity" value="1">
            @endif
@php

if (Session::has('cloud_service_id') && $detailedProduct->id == Session::get('cloud_service_product_id') ) {
    
    $id = Session::get('cloud_service_id');

    $cloud_amount = DB::table('cloude_service')->where('id' , $id)->first();

    $total_amount = $cloud_amount->amount + (float)preg_replace('/[^\d.]/', '', home_discounted_price($detailedProduct));

}else{

    Session::forget('cloud_service_product_id');

    DB::table('cloude_service')->where('id' , Session::get('cloud_service_id'))->delete();

    Session::forget('cloud_service_id');
    
}
@endphp
            <!-- Total Price -->
            <div class="row mt-1 mb-3 ml-0" id="chosen_price_div">
                <div class="col-sm-4">
                    <!-- <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Total Price') }}</div> -->
                    <div class="text-dark fs-20 fw-700">@if(Session::has('cloud_service_id') && $detailedProduct->id == Session::get('cloud_service_product_id') ) {{ translate('Product price')  }} @else {{ translate('total') }} @endif</div>
                    @if(Session::has('cloud_service_id') &&  $detailedProduct->id == Session::get('cloud_service_product_id'))
                      <div class="text-dark fs-20 fw-700">{{ translate('Cloud Service price') }}</div>

                      <div class="text-dark fs-20 fw-700">{{ translate('Total Price') }}</div>
                    @endif
                </div>
                <div class="col-sm-8">
                    <div class="product-price">
                        

                            @if(Session::has('cloud_service_id') && $detailedProduct->id == Session::get('cloud_service_product_id'))
                            <strong  class="fs-20 fw-700 text-dark">
                              {{ home_discounted_price($detailedProduct) }}
                            </strong><br>
                            <strong class="fs-20 fw-700 text-dark">
                              {{ format_price($cloud_amount->amount) }}
                            </strong><br>
                            <strong id="chosen_price" class="fs-20 fw-700 text-dark">
                              {{ format_price($total_amount) }}
                            </strong>
                            @else
                            <strong id="chosen_price" class="fs-20 fw-700 text-dark">
                             {{ home_discounted_price($detailedProduct) }}
                             </strong>
                            @endif
                       
                    </div>
                </div>
                <div class="col-lg-12"><hr></div>
                <div class="col-sm-6">
                        <div class="product-quantity d-flex align-items-center">
                            <div class="row align-items-center aiz-plus-minus ml-0" style="width: 150px;">
                                <button class="col-auto btn-icon btn-sm btn-light rounded-0" type="button"
                                    data-type="minus" data-field="quantity" disabled="">
                                    <i class="las la-minus"></i>
                                </button>
                                <input type="number" name="quantity"
                                    class="col border-0 text-center flex-grow-1 fs-16 input-number bg-none" placeholder="1"
                                    value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}"
                                    max="10" lang="en">
                                <button class="col-auto btn-icon btn-sm btn-light rounded-0" type="button"
                                    data-type="plus" data-field="quantity">
                                    <i class="las la-plus"></i>
                                </button>
                            </div>
                            @php
                                $qty = 0;
                                foreach ($detailedProduct->stocks as $key => $stock) {
                                    $qty += $stock->qty;
                                }
                            @endphp
                            <!-- <div class="avialable-amount opacity-60">
                                @if ($detailedProduct->stock_visibility_state == 'quantity')
                                    (<span id="available-quantity">{{ $qty }}</span>
                                    {{ translate('available') }})
                                @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                    (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                @endif
                            </div> -->
                        </div>
                </div>


                <div class="col-sm-6">
                    @if ($detailedProduct->digital == 0)
                        @if ($detailedProduct->external_link != null)
                            <a type="button" class="btn btn-primary buy-now fw-600 add-to-cart px-4 rounded-0"
                                href="{{ $detailedProduct->external_link }}">
                                <i class="la la-share"></i> {{ translate($detailedProduct->external_link_btn) }}
                            </a>
                        @else
                            {{-- <button type="button"
                                    class="btn-dark mr-2 add-to-cart fw-600 border-0 rounded-2 p-2 text-white"
                                    @if (Auth::check()) onclick="addToCart()" @else onclick="showLoginModal1()" @endif>
                                    <i class="las la-shopping-bag"></i>
                                    <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                                </button> --}}

                            <button type="button"
                                class="btn-dark mr-2 add-to-cart fw-600 border-0 rounded-2 p-2 text-white" onclick="addToCart()">
                                <i class="las la-shopping-bag"></i>
                                <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                            </button>
                            
                            <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0"
                                @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal1()" @endif>
                                <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                            </button>
                            
                        @endif
                        <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                            <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}
                        </button>
                    @elseif ($detailedProduct->digital == 1)
                        <button type="button"
                            class="btn-dark mr-2 add-to-cart fw-600 border-0 rounded-2 p-2 text-white" onclick="addToCart()">
                            <i class="las la-shopping-bag"></i>
                            <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                        </button>
                        <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0"
                            @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal1()" @endif>
                            <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                        </button>
                    @endif
                </div>
            </div>

            <div class="col-lg-12"><hr></div>

            <div class="col-lg-12">
                <div class="btn-block">
                    <button type="button" class="toggle-btn">Build your own bundles & save</button>
                    <div class="row-data" style="display:none">
                        <!-- Add on Section -->
                        <div class="mb-3 dropdown_section form-row">
                            
                            @if($detailedProduct->product_translations[0]->add_on != '' && $detailedProduct->product_translations[0]->add_on != "null")
                                <div class="col-sm-6">
                                    <div class="hdd">
                                        <div class="dropdown_title">Add-on<span></span></div>
                                        
                                        <div class="dropdown">
                                            
                                            <!-- <button class="btn btn-secondary dropdown-toggle drophdd" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                
                                                Select here..
                                                
                                            </button> -->
                                            <a  class="btn btn-primary" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#selectModal1">
                                                Select here..
                                            </a>
                                            <?php //$product_id = json_decode($detailedProduct->product_translations[0]->add_on) ?>
                                            
                                            {{-- <div class="dropdown-menu custom-drop" aria-labelledby="dropdownMenuButton" style="display: none;">
                                                
                                                @foreach($product_id as $key => $id)
                                                    <?php 
                                                    // $addon_product =  \App\Models\Product::where('id', $id)->first();
                                                    ?>

                                                    <a class="dropdown-item" href="#" onclick="addOn({{$key}},'{{$addon_product->name }}',{{ home_discounted_price($addon_product)}}">{{$addon_product->name}}</a>
                                                @endforeach --}}
                                                
                                                
                                                {{-- <a class="dropdown-item" href="#" onclick="addOn(2,'camera 5k',150)">camera 5k - $150</a>
                                                
                                                <a class="dropdown-item" href="#" onclick="addOn(3,'pen drive',152)">pen drive - $152</a> --}}
                                                
                                                                        
                                                
                                            {{-- </div> --}}
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                            <!-- dropdown select pendrive -->
                            <div class="col-sm-6">
                                <div class="pendive">
                                    <div class="dropdown_title">Cloud Storage<span></span></div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#selectModal">
                                        Select 
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- pendrive end -->
                        </div>
                    </div>
                </div>
            </div>

        </form>
    @endif



    @if ($detailedProduct->auction_product)
        @php
            $highest_bid = $detailedProduct->bids->max('amount');
            $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $detailedProduct->starting_bid;
        @endphp

        <!-- @if ($detailedProduct->auction_end_date >= strtotime('now'))
            <div class="mt-4">
                @if (Auth::check() && $detailedProduct->user_id == Auth::user()->id)
                    <span
                        class="badge badge-inline badge-danger">{{ translate('Seller cannot Place Bid to His Own Product') }}</span>
                @else
                    <button type="button" class="btn btn-primary buy-now  fw-600 min-w-150px rounded-0"
                        onclick="bid_modal()">
                        <i class="las la-gavel"></i>
                        @if (Auth::check() &&
                                Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first() != null)
                            {{ translate('Change Bid') }}
                        @else
                            {{ translate('Place Bid') }}
                        @endif
                    </button>
                @endif
            </div>
        @endif -->
        
    @else
        <!-- Add to cart & Buy now Buttons -->
        {{--<div class="mt-3">
            @if ($detailedProduct->digital == 0)
                @if ($detailedProduct->external_link != null)
                    <a type="button" class="btn btn-primary buy-now fw-600 add-to-cart px-4 rounded-0"
                        href="{{ $detailedProduct->external_link }}">
                        <i class="la la-share"></i> {{ translate($detailedProduct->external_link_btn) }}
                    </a>
                @else
                    <button type="button"
                        class="btn-dark mr-2 add-to-cart fw-600 border-0 rounded-2 p-2 text-white" onclick="addToCart()" >
                        <i class="las la-shopping-bag"></i>
                        <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                    </button>
                    <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0"
                        @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal()" @endif>
                        <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                    </button>
                @endif
                <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                    <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}
                </button>
            @elseif ($detailedProduct->digital == 1)
                <button type="button"
                    class="btn-dark mr-2 add-to-cart fw-600 border-0 rounded-2 p-2 text-white" onclick="addToCart()">
                    <i class="las la-shopping-bag"></i>
                    <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                </button>
                <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0"
                    @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal()" @endif>
                    <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                </button>
            @endif
        </div>--}}
       
        <!-- Promote Link -->
        <div class="d-table width-100 mt-3">
            <div class="d-table-cell">
                @if (Auth::check() &&
                        addon_is_activated('affiliate_system') &&
                        get_affliate_option_status() &&
                        Auth::user()->affiliate_user != null &&
                        Auth::user()->affiliate_user->status)
                    @php
                        if (Auth::check()) {
                            if (Auth::user()->referral_code == null) {
                                Auth::user()->referral_code = substr(Auth::user()->id . Str::random(10), 0, 10);
                                Auth::user()->save();
                            }
                            $referral_code = Auth::user()->referral_code;
                            $referral_code_url = URL::to('/product') . '/' . $detailedProduct->slug . "?product_referral_code=$referral_code";
                        }
                    @endphp
                    <div>
                        <button type="button" id="ref-cpurl-btn" class="btn btn-secondary w-200px rounded-0"
                            data-attrcpy="{{ translate('Copied') }}" onclick="CopyToClipboard(this)"
                            data-url="{{ $referral_code_url }}">{{ translate('Copy the Promote Link') }}</button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Refund -->
        @php
            $refund_sticker = get_setting('refund_sticker');
        @endphp
        @if (addon_is_activated('refund_request'))
            <!-- <div class="row no-gutters mt-3 ml-0">
                <div class="col-sm-2">
                    <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Refund') }}</div>
                </div>
                <div class="col-sm-10">
                    @if ($detailedProduct->refundable == 1)
                        <a href="{{ route('returnpolicy') }}" target="_blank">
                            @if ($refund_sticker != null)
                                <img src="{{ uploaded_asset($refund_sticker) }}" height="36">
                            @else
                                <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">
                            @endif
                        </a>
                        <a href="{{ route('returnpolicy') }}" class="text-blue hov-text-primary fs-14 ml-3"
                            target="_blank">{{ translate('View Policy') }}</a>
                    @else
                        <div class="text-dark fs-14 fw-400 mt-2">{{ translate('Not Applicable') }}</div>
                    @endif
                </div>
            </div> -->
        @endif

        <!-- Seller Guarantees -->
        <!-- @if ($detailedProduct->digital == 1)
            @if ($detailedProduct->added_by == 'seller')
                <div class="row no-gutters mt-3 ml-0">
                    <div class="col-2">
                        <div class="text-secondary fs-14 fw-400">{{ translate('Seller Guarantees') }}</div>
                    </div>
                    <div class="col-10">
                        @if ($detailedProduct->user->shop->verification_status == 1)
                            <span class="text-success fs-14 fw-700">{{ translate('Verified seller') }}</span>
                        @else
                            <span class="text-danger fs-14 fw-700">{{ translate('Non verified seller') }}</span>
                        @endif
                    </div>
                </div>
            @endif
        @endif -->
    @endif 
   
    <!-- Share -->
    <!-- <div class="row no-gutters mt-4">
        <div class="col-sm-2">
            <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Share') }}</div>
        </div>
        <div class="col-sm-10">
            <div class="aiz-share"></div>
        </div>
    </div> -->
</div>

<!-- select modal popup -->
<div class="modal" id="selectModal1">
  <div class="modal-dialog modal-md  modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title w-100 text-center">Multipleselect Products</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

        <!-- Modal body -->
        @if($detailedProduct->product_translations[0]->add_on != "null")
         {{-- @dd($detailedProduct->id) --}}
            <div class="modal-body">
            
                    <div class="row product-container p-0 justify-content-center">
                    <?php $addon_product_ids = json_decode($detailedProduct->product_translations[0]->add_on) ?? [] ?>
                        @foreach($addon_product_ids as $key => $add_on_product_id)

                            <?php 

                                $key =  ++$key ;

                                $product_details = App\Models\Product::where('id' , $add_on_product_id)->first();
                                
                            ?>  
                            <div class="col-lg-3">
                                
                                <form id="option-choice-form{{$key}}">
                                    
                                    @csrf

                                    <!-- Product 1 -->
                                    <div class="product-item">
                                    
                                        {{-- <button onclick="removeFromCart(94)">sub</button> --}}
                                        {{-- id="product{{$key}}" --}}
                                        <input type="hidden" name="quantity" value="1">

                                        <input type="hidden" name="addon_product_id" value="{{$detailedProduct->id}}">

                                        <input type="checkbox" onclick="getaddon({{$product_details->id}} ,'product{{$key}}', 'option-choice-form{{$key}}')" id="product{{$key}}" class="product-checkbox"  name="id"  value="{{$product_details->id}}">


                                        <label for="product{{$key}}" class="custom-checkbox" >
                                            <img class="img-fluid lazyload"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($product_details->thumbnail_img) }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </label>

                                        <h6 class="text-center">{{home_discounted_price($product_details)}}</h6> 

                                    </div>

                                </form>

                            </div>
                        @endforeach
                
                    </div>
                
            </div>
        @endif
        <!-- Modal-footer -->
        <div class="modal-footer">
            {{-- <a href="" class="btn btn-submit">Submit</a> --}}
            <button type="button" class="btn btn-submit" data-bs-dismiss="modal">OK</button>
        </div>
    </div>
  </div>
</div>
<!-- ./ -->


<!-- cloud storage->select modal popup -->
<div class="modal" id="selectModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title w-100 text-center">Cloud Storage</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <!-- calculator section start here -->
         <section class="calculator-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="calculator-data-sec">
                            <h2>Storage Calculator</h2>
                            <div class="slidecontainer">
                                <div class="row">
                                    <p class="hed-a">How many camera storage you looking for ?</p>
                                </div>
                            </div>

                            <form method="POST" action="{{route('cart.store-cloud-service')}}"  id="cloud-service">

                                @csrf

                                <input type="hidden" name="product_id" value="{{$detailedProduct->id}}">
                                <?php $a = null; ?>

                                @foreach ($cloud_data as $key => $item)

                                    <div class="d-flex my-2">
                                        <div class="d-flex align-items-sm-center col-sm-4">
                                            <label class="lable" for="quantity"><b class="2bcam">{{$item->product}}</b></label>
                                        </div>
                                        <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-sm-end">
                                            <button type="button" class="quantity-left-minus{{$a}} btn-number rounded-circle minusbtn" data-type="minus" data-field="">-</button>
                                        </div>
                                        <!-- <input type="hidden" name="" class="cat1_price" value="10"> -->
                                        {{-- <input type="number" min="0" id="quantity{{$a}}" name="cam{{$a}}_quantity" class="input-number text-center addcart inp{{++$key}}" value="0" /> --}}
                                        <input type="number" min="0" id="quantity{{$a}}" name="qty[]" class="input-number text-center addcart inp{{++$key}}" value="0" />
                                        <input type="hidden" min="0"  name="cam_name[]" class="input-number text-center addcart inp{{++$key}}" value="{{$item->product}}" />
                                        

                                        <div class="col-sm-1 d-flex align-items-sm-center mx-2">
                                            <button type="button" class="quantity-right-plus{{$a}} btn-number rounded-circle minusbtn" data-type="plus" data-field="">+</button>
                                        </div>
                                    </div>

                                    <?php
                                        $a = $a+1;
                                    ?>
                                @endforeach

                                {{-- <div class="d-flex my-2">
                                    <div class="d-flex align-items-sm-center col-sm-4">
                                        <label class="lable" for="quantity1"><b class="2bcam">4MP cameras</b></label>
                                    </div>
                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-sm-end">
                                        <button type="button" class="quantity-left-minus1 btn-number rounded-circle minusbtn" data-type="minus" data-field="">-</button>
                                    </div>
                                    <!-- <input type="hidden" name="" value="10"> -->
                                    <input type="number" min="0" id="quantity1" name="cam2_quantity" class="input-number text-center addcart inp2" value="0" />

                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2">
                                        <button type="button" class="quantity-right-plus1 btn-number rounded-circle minusbtn" data-type="plus" data-field="">+</button>
                                    </div>
                                </div>

                                <div class="d-flex mt-2">
                                    <div class="d-flex align-items-sm-center col-sm-4">
                                        <label class="lable" for="quantity2"><b class="2bcam">8MP/4K cameras</b></label>
                                    </div>
                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-sm-end">
                                        <button type="button" class="quantity-left-minus2 btn-number rounded-circle minusbtn" data-type="minus" data-field="">-</button>
                                    </div>
                                    <input type="hidden" name="" value="10" />
                                    <input type="number" min="0" id="quantity2" name="cam3_quantity" class="input-number text-center addcart inp3" value="0" />

                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2">
                                        <button type="button" class="quantity-right-plus2 btn-number rounded-circle minusbtn" data-type="plus" data-field="">+</button>
                                    </div>
                                </div> --}}


                                <div class="row my-2">
                                    <p class="hed-a my-4">Select cloud storage duration:</p>
                                    <div class="d-flex justify-content-between" style="width: 380px;">
                                        <div class="">
                                            <div style="opacity: 0;">0</div>
                                            <div class="text-center div_1 daydd">
                                                7 <br />
                                                Days
                                            </div>
                                        </div>
                                        <div class=" ">
                                            <div class="btn btn-danger btn-sm rounded-pill">Popular</div>
                                            <div class="text-center div_2 daydd">
                                                30 <br />
                                                Days
                                            </div>
                                        </div>
                                        <div class=" ">
                                            <div style="opacity: 0;">0</div>
                                            <div class="text-center div_3 daydd">
                                                90 <br />
                                                Days
                                            </div>
                                        </div>
                                        <div class=" ">
                                            <div style="opacity: 0;">0</div>
                                            <div class="text-center div_4 daydd">
                                                180 <br />
                                                Days
                                            </div>
                                        </div>
                                        <div class=" ">
                                            <div style="opacity: 0;">0</div>
                                            <div class="text-center div_5 daydd">
                                                365 <br />
                                                Days
                                            </div>
                                        </div>
                                    </div>
                                    <div class="colaling col-7 text-center">
                                        <input type="range" min="0" max="100" step="25" name="storage" value="25" class="slider" id="myRangecaa" />
                                    </div>

                                    <div class="col-2" style="opacity: 0;">
                                        <p class="value-sec"><span id="democaa"></span></p>
                                    </div>

                                    <div class="d-flex my-3">
                                        <div class="w-25 p-2 px-2 border border-primary border-3 rounded-3 shadow bg-body rounded-3 text-center">
                                            <div style="color: #000; font-weight: 500;">$<span class="cat_qty">0.00</span> Monthly</div>
                                            <small style="color: #000; font-weight: 500; margin-top: 15px; float: left; text-align: center; width: 100%; margin-bottom: 10px;">Cancel anytime</small>
                                        </div>

                                        <div class="w-75 p-2 border-start border-primary border-3 mx-4">
                                            <div class="mx-3 cat1_qty crt"></div>
                                            <div class="mx-3 cat2_qty crt"></div>
                                            <div class="mx-3 cat3_qty crt"></div>
                                        </div>
                                    </div>

                                    {{-- <input type="hidden" class="mx-3 cam_1_price" name="cam_1_price" />
                                    <input type="hidden" class="mx-3 cam_2_price" name="cam_2_price" />
                                    <input type="hidden" class="mx-3 cam_3_price" name="cam_3_price" /> --}}

                                    <input type="hidden" class="mx-3 cam_1_price" name="cam_price[]" />
                                    <input type="hidden" class="mx-3 cam_2_price" name="cam_price[]" />
                                    <input type="hidden" class="mx-3 cam_3_price" name="cam_price[]" />

                                    <input type="hidden" class="mx-3 days" name="cloud_storage" />
                                    
                                    <input type="hidden" class="mx-3 total_price" name="total_price" />

                                    <small class="text-danger submit_check"></small>
                                </div>


                                <?php $b = 1;?>
                                @foreach ($cloud_data as $item)
                                    <?php $b = $b*2 ; ?>
                                    <input type="hidden" name="" value="{{$item->product}}" id="{{$b}}name" />

                                    <input type="hidden" name="" value="{{$item->first_days}}"   id="7d_amount{{$b}}" />
                                    <input type="hidden" name="" value="{{$item->secound_days}}" id="30d_amount{{$b}}" />
                                    <input type="hidden" name="" value="{{$item->third_days}}"   id="90d_amount{{$b}}" />
                                    <input type="hidden" name="" value="{{$item->fourth_days}}"  id="180d_amount{{$b}}" />
                                    <input type="hidden" name="" value="{{$item->fifth_days}}"   id="365d_amount{{$b}}" />
                                @endforeach

                                {{-- <input type="hidden" name="" value="2MP cameras" id="2name" />
                                <input type="hidden" name="" value="4MP cameras" id="4name" />
                                <input type="hidden" name="" value="8MP/4K cameras" id="8name" />

                                <input type="hidden" name="" value="5.99" id="7d_amount2" />
                                <input type="hidden" name="" value="8.49" id="30d_amount2" />
                                <input type="hidden" name="" value="18.99" id="90d_amount2" />
                                <input type="hidden" name="" value="19.99" id="180d_amount2" />
                                <input type="hidden" name="" value="21.99" id="365d_amount2" />

                                <input type="hidden" name="" value="6.99" id="7d_amount4" />
                                <input type="hidden" name="" value="9.99" id="30d_amount4" />
                                <input type="hidden" name="" value="19.99" id="90d_amount4" />
                                <input type="hidden" name="" value="21.99" id="180d_amount4" />
                                <input type="hidden" name="" value="24.99" id="365d_amount4" />

                                <input type="hidden" name="" value="6.99" id="7d_amount8" />
                                <input type="hidden" name="" value="9.99" id="30d_amount8" />
                                <input type="hidden" name="" value="24.99" id="90d_amount8" />
                                <input type="hidden" name="" value="28.99" id="180d_amount8" />
                                <input type="hidden" name="" value="35.99" id="365d_amount8" /> --}}


                            </form>
                        </div>
                    </div>

                    
                </div>
            </div>
        </section>
      </div>

        <!-- Modal-footer -->
        <div class="modal-footer">

            <button type="button" class="btn calculatbtn submit d-none">Continue</button>

            <button type="button" class="btn  submit ">Continue</button>

            {{-- <a href="" class="btn btn-submit">Submit</a> --}}
        </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function getaddon(product_id,checkbox_id,form_id) {
        
        if ($('#'+checkbox_id).is(':checked')) {

            $("#"+checkbox_id).addClass("myClass");

            addToaddon(form_id);

        }else{

            $("#"+checkbox_id).removeClass("myClass");

            removeFromCartaddon(product_id);
            // removeFromCartView(event, product_id)
        }

    }


    function addToaddon(id){

        var url = "{{ route('cart.addToCart') }}";

        if(checkAddToCartValidity()) {
            
            $('#addToCart').modal();
            
            $('.c-preloader').show();
            
            $.ajax({
                
            type:"POST",
            
            url: url,
            
            data: $('#'+id).serializeArray(),
            
            success: function(data){
                
            $('#addToCart-modal-body').html(null);
            
            $('.c-preloader').hide();
            
            $('#modal-size').removeClass('modal-lg');
            
            $('#addToCart-modal-body').html(data.modal_view);
            
            AIZ.extra.plusMinus();
            
                AIZ.plugins.slickCarousel();
                
                updateNavCart(data.nav_cart_view,data.cart_count);
                
                AIZ.plugins.notify('success', "Cart Updated Sucessfully");
                
                }
                
            });
            
        }
        else{
            
          AIZ.plugins.notify('warning', "Please choose all the options");
        
        }
        
    }

    function removeFromCartaddon(key){
            
        var urlsec = "{{ route('cart.removeFromCartaddon') }}";

            $.post(urlsec, {
                _token  : AIZ.data.csrf,
                id      :  key
            }, function(data){
                console.log(updateNavCart(data.nav_cart_view,data.cart_count));        
                $('#cart-summary').html(data.cart_view);
                AIZ.plugins.notify('success', "Item has been removed from cart");
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            });
    }


</script>
<script>
         $(document).ready(function(){
            $('.drophdd').on("mouseover", function () {
                $('.custom-drop').css('display','block');
            })
            .mouseout(function(){
                $('.custom-drop').css('display','none');
            });
         })
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var quantitiy = 0;
        /*plans name*/
        var name2 = $("#2name").val();
        var name4 = $("#4name").val();
        var name8 = $("#8name").val();
        /*plans name*/
        /*plans amount*/
        var price2mp_7 = $("#7d_amount2").val();
        var price2mp_30 = $("#30d_amount2").val();
        var price2mp_90 = $("#90d_amount2").val();
        var price2mp_180 = $("#180d_amount2").val();
        var price2mp_365 = $("#365d_amount2").val();

        var price4mp_7 = $("#7d_amount4").val();
        var price4mp_30 = $("#30d_amount4").val();
        var price4mp_90 = $("#90d_amount4").val();
        var price4mp_180 = $("#180d_amount4").val();
        var price4mp_365 = $("#365d_amount4").val();

        var price8mp_7 = $("#7d_amount8").val();
        var price8mp_30 = $("#30d_amount8").val();
        var price8mp_90 = $("#90d_amount8").val();
        var price8mp_180 = $("#180d_amount8").val();
        var price8mp_365 = $("#365d_amount8").val();

        /*plans amount*/
        $(".div_2").css("color", "red");

        $(".quantity-right-plus").click(function (e) {
            e.preventDefault();

            var slider_val = $("#democaa").text();

            var quantity = parseFloat($("#quantity").val());
            $("#quantity").val(quantity + 1);

            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".cam_1_price").val(price1);
                $(".days").val(7);
            }
            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".cam_1_price").val(price1);
                $(".days").val(30);
            }
            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".cam_1_price").val(price1);
                $(".days").val(90);
            }
            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".cam_1_price").val(price1);
                $(".days").val(180);
            }
            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".cam_1_price").val(price1);
                $(".days").val(365);
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat3_qty").text(c_val2 + "× " + name8 + price2 * c_val2.toFixed(2) + "/month");

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".quantity-left-minus").click(function (e) {
            e.preventDefault();
            var quantity = parseFloat($("#quantity").val());
            if (quantity > 0) {
                var slider_val = $("#democaa").text();
                $("#quantity").val(quantity - 1);

                if (slider_val == 0) {
                    var price1 = price2mp_7;
                    var price2 = price4mp_7;
                    var price3 = price8mp_7;
                    $(".cam_1_price").val(price1);
                    $(".days").val(7);
                }
                if (slider_val == 25) {
                    var price1 = price2mp_30;
                    var price2 = price4mp_30;
                    var price3 = price8mp_30;
                    $(".cam_1_price").val(price1);
                    $(".days").val(30);
                }
                if (slider_val == 50) {
                    var price1 = price2mp_90;
                    var price2 = price4mp_90;
                    var price3 = price8mp_90;
                    $(".cam_1_price").val(price1);
                    $(".days").val(90);
                }
                if (slider_val == 75) {
                    var price1 = price2mp_180;
                    var price2 = price4mp_180;
                    var price3 = price8mp_180;
                    $(".cam_1_price").val(price1);
                    $(".days").val(180);
                }
                if (slider_val == 100) {
                    var price1 = price2mp_365;
                    var price2 = price4mp_365;
                    var price3 = price8mp_365;
                    $(".cam_1_price").val(price1);
                    $(".days").val(365);
                }

                var c_val0 = parseFloat($("#quantity").val());
                var c_val1 = parseFloat($("#quantity1").val());
                var c_val2 = parseFloat($("#quantity2").val());

                $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
                $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
                $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");

                var n_1 = price1 * c_val0;
                var n_2 = price2 * c_val1;
                var n_3 = price3 * c_val2;

                var p_1 = n_1 + n_2 + n_3;
                var p_2 = p_1.toFixed(2);

                $(".cat_qty").text(p_2);
                $(".total_price").val(p_2);
            }
        });

        var quantitiy1 = 0;
        $(".quantity-right-plus1").click(function (e) {
            e.preventDefault();
            var slider_val = $("#democaa").text();
            var quantity1 = parseFloat($("#quantity1").val());
            $("#quantity1").val(quantity1 + 1);

            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".cam_2_price").val(price2);
                $(".days").val(7);
            }
            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".cam_2_price").val(price2);
                $(".days").val(30);
            }
            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".cam_2_price").val(price2);
                $(".days").val(90);
            }
            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".cam_2_price").val(price2);
                $(".days").val(180);
            }
            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".cam_2_price").val(price2);
                $(".days").val(365);
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".quantity-left-minus1").click(function (e) {
            e.preventDefault();
            var quantity1 = parseFloat($("#quantity1").val());
            if (quantity1 > 0) {
                var slider_val = $("#democaa").text();
                $("#quantity1").val(quantity1 - 1);

                if (slider_val == 0) {
                    var price1 = price2mp_7;
                    var price2 = price4mp_7;
                    var price3 = price8mp_7;
                    $(".cam_2_price").val(price2);
                    $(".days").val(7);
                }
                if (slider_val == 25) {
                    var price1 = price2mp_30;
                    var price2 = price4mp_30;
                    var price3 = price8mp_30;
                    $(".cam_2_price").val(price2);
                    $(".days").val(30);
                }
                if (slider_val == 50) {
                    var price1 = price2mp_90;
                    var price2 = price4mp_90;
                    var price3 = price8mp_90;
                    $(".cam_2_price").val(price2);
                    $(".days").val(90);
                }
                if (slider_val == 75) {
                    var price1 = price2mp_180;
                    var price2 = price4mp_180;
                    var price3 = price8mp_180;
                    $(".cam_2_price").val(price2);
                    $(".days").val(180);
                }
                if (slider_val == 100) {
                    var price1 = price2mp_365;
                    var price2 = price4mp_365;
                    var price3 = price8mp_365;
                    $(".cam_2_price").val(price2);
                    $(".days").val(365);
                }

                var c_val0 = parseFloat($("#quantity").val());
                var c_val1 = parseFloat($("#quantity1").val());
                var c_val2 = parseFloat($("#quantity2").val());

                $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
                $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
                $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");

                var n_1 = price1 * c_val0;
                var n_2 = price2 * c_val1;
                var n_3 = price3 * c_val2;

                var p_1 = n_1 + n_2 + n_3;
                var p_2 = p_1.toFixed(2);

                $(".cat_qty").text(p_2);
                $(".total_price").val(p_2);
            }
        });

        var quantitiy2 = 0;
        $(".quantity-right-plus2").click(function (e) {
            e.preventDefault();
            var slider_val = $("#democaa").text();
            var quantity2 = parseFloat($("#quantity2").val());
            $("#quantity2").val(quantity2 + 1);
            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".cam_3_price").val(price3);
                $(".days").val(7);
            }
            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".cam_3_price").val(price3);
                $(".days").val(30);
            }
            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".cam_3_price").val(price3);
                $(".days").val(90);
            }
            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".cam_3_price").val(price3);
                $(".days").val(180);
            }
            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".cam_3_price").val(price3);
                $(".days").val(365);
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".quantity-left-minus2").click(function (e) {
            e.preventDefault();
            var quantity2 = parseFloat($("#quantity2").val());
            if (quantity2 > 0) {
                var slider_val = $("#democaa").text();
                $("#quantity2").val(quantity2 - 1);
                if (slider_val == 0) {
                    var price1 = price2mp_7;
                    var price2 = price4mp_7;
                    var price3 = price8mp_7;
                    $(".cam_3_price").val(price3);
                    $(".days").val(7);
                }
                if (slider_val == 25) {
                    var price1 = price2mp_30;
                    var price2 = price4mp_30;
                    var price3 = price8mp_30;
                    $(".cam_3_price").val(price3);
                    $(".days").val(30);
                }
                if (slider_val == 50) {
                    var price1 = price2mp_90;
                    var price2 = price4mp_90;
                    var price3 = price8mp_90;
                    $(".cam_3_price").val(price3);
                    $(".days").val(90);
                }
                if (slider_val == 75) {
                    var price1 = price2mp_180;
                    var price2 = price4mp_180;
                    var price3 = price8mp_180;
                    $(".cam_3_price").val(price3);
                    $(".days").val(180);
                }
                if (slider_val == 100) {
                    var price1 = price2mp_365;
                    var price2 = price4mp_365;
                    var price3 = price8mp_365;
                    $(".cam_3_price").val(price3);
                    $(".days").val(365);
                }

                var c_val0 = parseFloat($("#quantity").val());
                var c_val1 = parseFloat($("#quantity1").val());
                var c_val2 = parseFloat($("#quantity2").val());

                $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
                $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
                $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");

                var n_1 = price1 * c_val0;
                var n_2 = price2 * c_val1;
                var n_3 = price3 * c_val2;

                var p_1 = n_1 + n_2 + n_3;
                var p_2 = p_1.toFixed(2);

                $(".cat_qty").text(p_2);
                $(".total_price").val(p_2);
            }
        });

        var slider = document.getElementById("myRangecaa");
        var output = document.getElementById("democaa");
        output.innerHTML = slider.value;

        slider.oninput = function () {
            output.innerHTML = this.value;
        };

        $("#myRangecaa").on("change", function (e) {
            e.preventDefault();
            var slider_val = $("#democaa").text();

            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".days").val(7);
                $(".div_1").css("color", "red");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "black");
            }
            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".days").val(30);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "red");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "black");
            }
            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".days").val(90);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "red");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "black");
            }
            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".days").val(180);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "red");
                $(".div_5").css("color", "black");
            }
            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".days").val(365);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "red");
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cam_1_price").val(price1);
            $(".cam_2_price").val(price2);
            $(".cam_3_price").val(price3);

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        /*plans name*/
        var name2 = $("#2name").val();
        var name4 = $("#4name").val();
        var name8 = $("#8name").val();
        /*plans name*/
        /*plans amount*/
        var price2mp_7 = $("#7d_amount2").val();
        var price2mp_30 = $("#30d_amount2").val();
        var price2mp_90 = $("#90d_amount2").val();
        var price2mp_180 = $("#180d_amount2").val();
        var price2mp_365 = $("#365d_amount2").val();

        var price4mp_7 = $("#7d_amount4").val();
        var price4mp_30 = $("#30d_amount4").val();
        var price4mp_90 = $("#90d_amount4").val();
        var price4mp_180 = $("#180d_amount4").val();
        var price4mp_365 = $("#365d_amount4").val();

        var price8mp_7 = $("#7d_amount8").val();
        var price8mp_30 = $("#30d_amount8").val();
        var price8mp_90 = $("#90d_amount8").val();
        var price8mp_180 = $("#180d_amount8").val();
        var price8mp_365 = $("#365d_amount8").val();

        /*plans amount*/
        $(".inp1").keyup(function () {
            var slider_val = $("#democaa").text();
            var data1 = $(".inp1").val();

            if (data1 == "") {
                $(".inp1").val(0);
            }

            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".days").val(7);
            }
            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".days").val(30);
            }
            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".days").val(90);
            }
            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".days").val(180);
            }
            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".days").val(365);
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cam_1_price").val(price1);

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat1_qty0").val(price1 * c_val0);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".inp2").keyup(function () {
            var slider_val = $("#democaa").text();
            var data2 = $(".inp2").val();

            if (data2 == "") {
                $(".inp2").val(0);
            }

            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".days").val(7);
            }
            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".days").val(30);
            }
            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".days").val(90);
            }
            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".days").val(180);
            }
            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".days").val(365);
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat2_qty1").val(price2 * c_val1);

            $(".cam_1_price").val(price1);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".inp3").keyup(function () {
            var slider_val = $("#democaa").text();
            var data3 = $(".inp3").val();

            if (data3 == "") {
                $(".inp3").val(0);
            }
            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".days").val(7);
            }
            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".days").val(30);
            }
            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".days").val(90);
            }
            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".days").val(180);
            }
            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".days").val(365);
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");
            $(".cat3_qty2").val(price3 * c_val2);

            $(".cam_1_price").val(price1);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".submit").on("click", function (e) {
            e.preventDefault();
            value = true;
            var z = $(".cat_qty").text();

            if (z == 0.0) {
                value = false;
                $(".submit_check").text("** Please select an camera first");
            }

            if (value == true) {
                $("#cloud-service").submit();
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        /*plans name*/
        var name2 = $("#2name").val();
        var name4 = $("#4name").val();
        var name8 = $("#8name").val();
        /*plans name*/
        /*plans amount*/
        var price2mp_7 = $("#7d_amount2").val();
        var price2mp_30 = $("#30d_amount2").val();
        var price2mp_90 = $("#90d_amount2").val();
        var price2mp_180 = $("#180d_amount2").val();
        var price2mp_365 = $("#365d_amount2").val();

        var price4mp_7 = $("#7d_amount4").val();
        var price4mp_30 = $("#30d_amount4").val();
        var price4mp_90 = $("#90d_amount4").val();
        var price4mp_180 = $("#180d_amount4").val();
        var price4mp_365 = $("#365d_amount4").val();

        var price8mp_7 = $("#7d_amount8").val();
        var price8mp_30 = $("#30d_amount8").val();
        var price8mp_90 = $("#90d_amount8").val();
        var price8mp_180 = $("#180d_amount8").val();
        var price8mp_365 = $("#365d_amount8").val();

        /*plans amount*/
        $(".div_1").on("click", function () {
            $("#myRangecaa").val(0);
            $("#democaa").text(0);
            var slider_val = $("#democaa").text();

            if (slider_val == 0) {
                var price1 = price2mp_7;
                var price2 = price4mp_7;
                var price3 = price8mp_7;
                $(".days").val(7);
                $(".div_1").css("color", "red");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "black");
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat1_qty0").val(price1 * c_val0);

            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat2_qty1").val(price2 * c_val1);

            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");
            $(".cat3_qty2").val(price3 * c_val2);

            $(".cam_1_price").val(price1);
            $(".cam_2_price").val(price2);
            $(".cam_3_price").val(price3);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".div_2").on("click", function () {
            $("#myRangecaa").val(25);
            $("#democaa").text(25);
            var slider_val = $("#democaa").text();

            if (slider_val == 25) {
                var price1 = price2mp_30;
                var price2 = price4mp_30;
                var price3 = price8mp_30;
                $(".days").val(30);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "red");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "black");
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat1_qty0").val(price1 * c_val0);

            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat2_qty1").val(price2 * c_val1);

            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");
            $(".cat3_qty2").val(price3 * c_val2);

            $(".cam_1_price").val(price1);
            $(".cam_2_price").val(price2);
            $(".cam_3_price").val(price3);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".div_3").on("click", function () {
            $("#myRangecaa").val(50);
            $("#democaa").text(50);
            var slider_val = $("#democaa").text();

            if (slider_val == 50) {
                var price1 = price2mp_90;
                var price2 = price4mp_90;
                var price3 = price8mp_90;
                $(".days").val(90);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "red");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "black");
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat1_qty0").val(price1 * c_val0);

            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat2_qty1").val(price2 * c_val1);

            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");
            $(".cat3_qty2").val(price3 * c_val2);

            $(".cam_1_price").val(price1);
            $(".cam_2_price").val(price2);
            $(".cam_3_price").val(price3);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".div_4").on("click", function () {
            $("#myRangecaa").val(75);
            $("#democaa").text(75);
            var slider_val = $("#democaa").text();

            if (slider_val == 75) {
                var price1 = price2mp_180;
                var price2 = price4mp_180;
                var price3 = price8mp_180;
                $(".days").val(180);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "red");
                $(".div_5").css("color", "black");
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat1_qty0").val(price1 * c_val0);

            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat2_qty1").val(price2 * c_val1);

            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");
            $(".cat3_qty2").val(price3 * c_val2);

            $(".cam_1_price").val(price1);
            $(".cam_2_price").val(price2);
            $(".cam_3_price").val(price3);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });

        $(".div_5").on("click", function () {
            $("#myRangecaa").val(100);
            $("#democaa").text(100);
            var slider_val = $("#democaa").text();

            if (slider_val == 100) {
                var price1 = price2mp_365;
                var price2 = price4mp_365;
                var price3 = price8mp_365;
                $(".days").val(365);
                $(".div_1").css("color", "black");
                $(".div_2").css("color", "black");
                $(".div_3").css("color", "black");
                $(".div_4").css("color", "black");
                $(".div_5").css("color", "red");
            }

            var c_val0 = parseFloat($("#quantity").val());
            var c_val1 = parseFloat($("#quantity1").val());
            var c_val2 = parseFloat($("#quantity2").val());

            $(".cat1_qty").text(c_val0 + "× " + name2 + price1 * c_val0.toFixed(2) + "/month");
            $(".cat1_qty0").val(price1 * c_val0);

            $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + "/month");
            $(".cat2_qty1").val(price2 * c_val1);

            $(".cat3_qty").text(c_val2 + "× " + name8 + price3 * c_val2.toFixed(2) + "/month");
            $(".cat3_qty2").val(price3 * c_val2);

            $(".cam_1_price").val(price1);
            $(".cam_2_price").val(price2);
            $(".cam_3_price").val(price3);

            var n_1 = price1 * c_val0;
            var n_2 = price2 * c_val1;
            var n_3 = price3 * c_val2;

            var p_1 = n_1 + n_2 + n_3;
            var p_2 = p_1.toFixed(2);

            $(".cat_qty").text(p_2);
            $(".total_price").val(p_2);
        });
    });
</script>


<script>
    function showLoginModal1() {
      var x = document.getElementsByClassName("snackbar")[0];
      x.className = "snackbar show";
      setTimeout(function(){ x.className = "snackbar"; }, 3000);
    }
</script>

<div class="snackbar">Please Login as a customer to add products to the Cart.</div>

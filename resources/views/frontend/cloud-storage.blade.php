@extends('frontend.layouts.app')

@section('content')

<style>
    .getstart-leftcon h2 {
        font-weight: 600;
        margin-bottom: 10%;
    }
    
    .getstart-leftcon h5 {
        font-weight: 700;
        margin-bottom: 8%;
    }
    
    .gstartleft-1con ul li {
        display: inline-block;
        padding-right: 15%;
    }
    
    .gstartleft-2con ul li {
        display: inline-block;
        padding-right: 24.5%;
    }
    
    .gstartleft-3con ul li {
        display: inline-block;
        padding-right: 19.8%;
    }
    
    span.counting {
        background: #f0f0f0;
        padding: 4px 22px;
        margin: 0 8px;
        border-radius: 6px;
    }
    
    .containerdd span2 {
        background: #f0f0f0;
        padding: 3px 10px;
        border-radius: 36px;
    }
    
    .getstart-letwoftcon h5 {
        font-weight: 700;
        margin: 10% 0 5%;
    }
    
    .sidenav li a:hover {
        color: #1dbbe8 !important;
    }
    
    ul.mobox-no1 {
        border: 3px solid #2ac4f1;
        padding: 10px;
        border-radius: 4px;
    }
    
    .monthyybtn {
        background: #2ac4f1;
        margin: 5% 0 52px 0;
        padding: 8px 16px;
        color: #fff !important;
    }
    
    .mobox-no1 {
        height: 100px;
        width: 150px;
        margin-top: 82px;
    }
    
    ul#moboxwww li {
        font-weight: 700;
        padding: 8px 0;
        font-size: 14px;
    }
    
    .mobox-no2 {
        margin-left: 16px;
        border-left: 3px solid #2ac4f1;
        height: 78px;
        padding-left: 20px;
        border-radius: 2px;
    }
    
    .mobox-no2 p {
        margin: 2px 0;
    }
    
    .monthly-box ul {
        display: inline-block;
    }
    
    .monthly-box ul {
        padding: 0;
    }
</style>
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
                font-size: 16px;min-width: 10%;
                min-height: 40px;
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
                height: 40px;
                width: 40px;min-width:40px;
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

            .calculator-data-sec .slider {
                margin-left: 10px;
                width: 100%;
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
            .btn.btn-danger.btn-sm.rounded-pill {
                color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
  background: #f92c8b;
  background: -moz-linear-gradient(left, #f92c8b 0%, #b02cd6 100%);
  background: -webkit-linear-gradient(left, #f92c8b 0%,#b02cd6 100%);
  background: linear-gradient(to right, #f92c8b 0%,#b02cd6 100%);
  -webkit-box-shadow: 0 10px 15px 0px rgba(175, 0, 202, .2);
  box-shadow: 0 10px 15px 0px rgba(175, 0, 202, .2);
}
#myRangecaa.slider{
    background-color: transparent;
}
.calculator-data-sec .w-75.p-2.border-start.border-primary.border-3.mx-4{
    border-top: none !important;
  border-right: none !important;
  border-bottom: none !important;
}
.getstarted-sec .img-sec{
  padding: 0px 10px 40px 0px;
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
                .calculator-data-sec .text-center{font-size:14px}
                .btn.btn-danger.btn-sm.rounded-pill{font-size:12px}
            }
        </style>
{{-- @dd($cloud_data) --}}


<section class="getstarted-wrapper" style="">

    <div class="container">

        <div class="getstarted-sec">

            <div class="row ">

                <div class="col-sm-12 col-md-12 col-lg-6">

                <section class="calculator-sec py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="calculator-data-sec">
                            <h2>Storage Calculator</h2>
                            <div class="slidecontainer">
                                <div class="row">
                                    <p class="hed-a">How many camera storage you looking for ?</p>
                                </div>
                            </div>
                            <form method="POST" action="">

                                <?php $a = null; ?>

                                @foreach ($cloud_data as $key => $item)

                                    <div class="d-flex my-4 align-items-center">

                                        <div class="d-flex align-items-sm-center col-sm-4">
                                            <label class="lable" for="quantity"><b class="2bcam">{{$item->product}}</b></label>
                                        </div>
                                        <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-center">
                                            <button type="button" class="quantity-left-minus{{$a}} btn-number rounded-circle minusbtn" data-type="minus" data-field="">-</button>
                                        </div>
                                        <!-- <input type="hidden" name="" class="cat1_price" value="10"> -->
                                        <input type="number" min="0" id="quantity{{$a}}" name="cam{{++$key}}_quantity" class="input-number text-center addcart inp{{++$key}}" value="0" />

                                        <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-center">
                                            <button type="button" class="quantity-right-plus{{$a}} btn-number rounded-circle minusbtn" data-type="plus" data-field="">+</button>
                                        </div>

                                    </div>
                                    <?php
                                        $a = $a+1;
                                    ?>
                                    {{-- {{ $a}} --}}
                                @endforeach

                                

                                {{-- <div class="d-flex my-4">
                                    <div class="d-flex align-items-sm-center col-sm-4">
                                        <label class="lable" for="quantity1"><b class="2bcam">4MP cameras</b></label>
                                    </div>
                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-center">
                                        <button type="button" class="quantity-left-minus1 btn-number rounded-circle minusbtn" data-type="minus" data-field="">-</button>
                                    </div>
                                    <!-- <input type="hidden" name="" value="10"> -->
                                    <input type="number" min="0" id="quantity1" name="cam2_quantity" class="input-number text-center addcart inp2" value="0" />

                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-center">
                                        <button type="button" class="quantity-right-plus1 btn-number rounded-circle minusbtn" data-type="plus" data-field="">+</button>
                                    </div>
                                </div>

                                <div class="d-flex mt-4">
                                    <div class="d-flex align-items-sm-center col-sm-4">
                                        <label class="lable" for="quantity2"><b class="2bcam">8MP/4K cameras</b></label>
                                    </div>
                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-center">
                                        <button type="button" class="quantity-left-minus2 btn-number rounded-circle minusbtn" data-type="minus" data-field="">-</button>
                                    </div>
                                    <input type="hidden" name="" value="10" />
                                    <input type="number" min="0" id="quantity2" name="cam3_quantity" class="input-number text-center addcart inp3" value="0" />
 
                                    <div class="col-sm-1 d-flex align-items-sm-center mx-2 justify-content-center">
                                        <button type="button" class="quantity-right-plus2 btn-number rounded-circle minusbtn" data-type="plus" data-field="">+</button>
                                    </div>
                                </div> --}}

                                <input type="hidden" name="_token" value="mINRhUNXdiVIVDOLFovGfcwQnPs5xl47ztH9KIRY" />

                                <div class="my-4 w-100">
                                    <p class="hed-a my-4">Select cloud storage duration:</p>
                                    <div class="d-flex justify-content-between">
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
                                    <div class="colaling text-center">
                                        <input type="range" min="0" max="100" step="25" name="storage" value="25" class="slider" id="myRangecaa" />
                                    </div>

                                    <div class="col-2" style="opacity: 0;">
                                        <p class="value-sec"><span id="democaa"></span></p>
                                    </div>

                                    <div class="form-row my-3">
                                        <div class="col-lg-4 d-flex">
                                            <div class="custom-border text-center w-100">
                                                <div class="ttl">$<span class="cat_qty">0.00</span> Monthly</div>
                                                <small class="sub-ttl">Cancel anytime</small>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 d-flex">
                                            <div class="custom-border w-100">
                                                <div class="mx-3 cat1_qty crt"></div>
                                                <div class="mx-3 cat2_qty crt"></div>
                                                <div class="mx-3 cat3_qty crt"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="mx-3 cam_1_price" name="cam_1_price" />
                                    <input type="hidden" class="mx-3 cam_2_price" name="cam_2_price" />
                                    <input type="hidden" class="mx-3 cam_3_price" name="cam_3_price" />
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

                                {{-- <input type="hidden" name="" value="4MP cameras" id="4name" />
                                <input type="hidden" name="" value="8MP/4K cameras" id="8name" /> --}}

                                

                                {{-- <input type="hidden" name="" value="6.99" id="7d_amount4" />
                                <input type="hidden" name="" value="9.99" id="30d_amount4" />
                                <input type="hidden" name="" value="19.99" id="90d_amount4" />
                                <input type="hidden" name="" value="21.99" id="180d_amount4" />
                                <input type="hidden" name="" value="24.99" id="365d_amount4" />

                                <input type="hidden" name="" value="6.99" id="7d_amount8" />
                                <input type="hidden" name="" value="9.99" id="30d_amount8" />
                                <input type="hidden" name="" value="24.99" id="90d_amount8" />
                                <input type="hidden" name="" value="28.99" id="180d_amount8" />
                                <input type="hidden" name="" value="35.99" id="365d_amount8" /> --}}

                                <button type="submit" class="btn calculatbtn submit d-none">Continue</button>
                            </form>
                        </div>
                    </div>

                    
                </div>
            </div>
        </section>

                </div>



                <div class="col-sm-12 col-md-12 col-lg-6">

                    <div class="img-sec">
                    <img src="https://login2design.in/zoobla_staging/public/frontimage/storageCalculator2.png" alt="" class="img-fluid">
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>





@endsection







@section('script')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

          $(".cat2_qty").text(c_val1 + "× " + name4 + price2 * c_val1.toFixed(2) + " /month");
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
              $("form").unbind("submit").submit();
          }
      });
  });
</script>

{{-- <script type="text/javascript">

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

</script> --}}

@endsection





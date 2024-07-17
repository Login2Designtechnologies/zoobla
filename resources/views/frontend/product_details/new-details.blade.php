<div class="product-dtl-info">

    <h1 class="ttl">{{ $detailedProduct->getTranslation('name') }}</h1>

    <div class="rating d-flex align-items-center">

        <div class="stars row">

            <div class="col-12">

                @php

                $total = 0;

                $total += $detailedProduct->reviews->count();

                @endphp

                <span class="rating rating-mr-1">

                    <a href="#section5">{{ renderStarRating($detailedProduct->rating) }} </a>

                </span>{{$detailedProduct->rating}} &nbsp;

                <a href="#section5"> <span class="ml-1 opacity-1 fs-16">({{ $total }}

                {{ translate('reviews') }})</span> </a>

            </div> 

        </div> &nbsp;| &nbsp;
        <?php $faq =  json_decode($detailedProduct->product_translations[0]->faq_questions) == null ? [] : json_decode($detailedProduct->product_translations[0]->faq_questions)?>
        <a href="#section5"><div class="qus"><i></i>Questions ({{count($faq)}})</div></a>

    </div>

    @if (home_base_price($detailedProduct) != home_discounted_base_price($detailedProduct))

    @php

    $discount =  home_base_price($detailedProduct , false) - home_discounted_base_price($detailedProduct , false);

    @endphp

    <div class="price-sec"><del>{{ home_base_price($detailedProduct) }}</del><span class="price">{{ home_discounted_base_price($detailedProduct) }}</span> <span class="badge bg-danger" style="width: auto" >SAVE {{single_price($discount)}}</span></div>

    @else

    <div class="price-sec"><span class="price">{{ home_discounted_base_price($detailedProduct) }}</span></div>

    @endif

    <!--  -->
    <div class="pro-desc">

        <?php

        $specifications = json_decode($detailedProduct->product_translations[0]->specification);

        ?>

        @foreach($specifications as $heading => $test)

        <p><b>• {{$heading}} :</b> {{$test}}</p>

        @endforeach

    </div>

    <form id="option-choice-form">

     @csrf

     <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

     <!-- extra Add Section -->

     @if ($detailedProduct->choice_options != null)
     @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
     <div class="extra-add-section">
        <h4 class="ttl">{{ get_single_attribute_name($choice->attribute_id) }}</h4>
        <ul class="nav nav-tabs">
            @foreach ($choice->values as $key => $value)
            <li class="nav-item">
                <input type="radio" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}">
                <a class="nav-link active" data-bs-toggle="tab"> {{ $value }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    @endforeach
    @endif

    <div class="extra-add-section">
        <h4 class="ttl">CLOUD STORAGE:</h4>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#selectModal">
           Choose Cloud Storage
       </button>
   </div>
   <!-- ./extra Add Section -->


   <!-- Btn Block -->
   <div class="btn-block">

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

    {{-- (<span id="available-quantity">{{ $qty }}</span>

    {{ translate('available') }}) --}}

    @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)

    (<span id="available-quantity">{{ translate('In Stock') }}</span>)

    @endif

</div>

</form>

<button type="button" class="btn btn-md btn-theme" onclick="addToCart()">ADD TO CART</button>

</div>
<!-- ./Btn Block -->

<!-- extra-ADD Section -->
<div class="extra-add-section mb-3">
    <h4 class="ttl">Safe Checkout</h4>
    <div class="img-wrap">
        <img src="https://login2design.in/zoobla_staging/public/assets/img/checkout-img.jpg" alt="" />
    </div>
</div>
<!-- ./extra Add Section -->
</div>



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
                          <h3>Storage Calculator</h3>
                          <div class="slidecontainer">
                              <div class="row">
                                  <p class="hed-a">How many camera storage you looking for ?</p>
                              </div>
                          </div>

                          <form method="POST" action="{{route('cart.store-cloud-service')}}"  id="cloud-service">

                              @csrf

                              <input type="hidden" class="product_id" name="product_id" value="{{$detailedProduct->id}}">
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
                                  <input type="number" min="0" id="quantity{{$a}}" name="qty[]" class="input-number text-center addcart inp{{++$key}} qty" value="0" />
                                  <input type="hidden" min="0"  name="cam_name[]" class="input-number text-center addcart inp{{++$key}} cam_name" value="{{$item->product}}" />


                                  <div class="col-sm-1 d-flex align-items-sm-center mx-2">
                                      <button type="button" class="quantity-right-plus{{$a}} btn-number rounded-circle minusbtn" data-type="plus" data-field="">+</button>
                                  </div>
                              </div>

                              <?php
                              $a = $a+1;
                              ?>
                              @endforeach

                              <div class="row my-2">
                                  <p class="hed-a my-3">Select cloud storage duration:</p>
                                  <div class="d-flex flex-column">
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
                                  <div class="colaling text-center" style="width: 380px;">
                                      <!-- <input type="range" min="0" max="100" step="25" name="storage" value="25" class="slider" style="position: relative;" id="myRangecaa" /> -->

                                      <input type="range" min="0" max="100" step="25" name="storage" value="25" style="position: relative;" id="myRangecaa" />
                                  </div>
                              </div>

                              <div class="col-2" style="opacity: 0;">
                                  <p class="value-sec"><span id="democaa"></span></p>
                              </div>

                              <div class="d-flex my-2">
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

                              <input type="hidden" class="mx-3 cam_1_price cam_price" name="cam_price[]" />
                              <input type="hidden" class="mx-3 cam_2_price cam_price" name="cam_price[]" />
                              <input type="hidden" class="mx-3 cam_3_price cam_price" name="cam_price[]" />

                              <input type="hidden" class="mx-3 days cloud_storage_data" name="cloud_storage" />

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

            var qty = $('.qty').map(function() {
                return $(this).val();
            }).get();

            var cam_name = $('.cam_name').map(function() {
                return $(this).val();
            }).get();

            var cam_price = $('.cam_price').map(function() {
                return $(this).val();
            }).get();
            
            var cloud_storage = $('.cloud_storage_data').val();
            var product_id = $('.product_id').val();
            var total_price = $('.total_price').val();

            $.ajax({
                method: "POST",
                url: "{{route('cart.check-cloud-service')}}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'qty' : qty,
                    'cam_name' : cam_name,
                    'cam_price': cam_price,
                    'cloud_storage' : cloud_storage,
                    'product_id' : product_id,
                    'total_price' : total_price
                },
                success:function(response){  
                    if (response=="success") {
                        if (value == true) {
                            $("#cloud-service").submit();
                        }
                    }else{
                    //window.location.href="/";
                    //window.location.href="<?php echo url('/checkout/payment-select'); ?>";
                    }
                }
            });
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

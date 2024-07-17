<div class="overlay" id="overlay" onclick="closeCart()"></div>

<div class="cart-drawer" id="cartDrawer">

    <div class="cart-header">

        <h2>Your cart <span class="close-btn" onclick="closeCart()"><i class="fa fa-times" aria-hidden="true"></i></span></h2>

    </div>

    @php

        $total = 0;

        if(auth()->check()) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = request()->ip();
        }

        $carts = get_user_cart();
        // $count = (isset($cart) && count($cart)) ? count($cart) : 0;

        $cloud = DB::table('cloude_service')->where('user_id' , $user_id)->where('payment_status' , 0)->first();
        
    @endphp
    @if( $carts && count($carts) > 0 )

        <div class="overflow-items" id="productcontainer">

            <ul class="cart-items simple-items mb-0 pb-0">
                
                <!-- Example item -->
                @foreach ($carts as $key => $cartItem)

                    @php
                        $product = get_single_product($cartItem['product_id']);

                        $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();

                        // $total = $total + ($cartItem['price']  + $cartItem['tax']) * $cartItem['quantity'];

                        $total = $total + cart_product_price($cartItem, $product, false) * $cartItem['quantity'];

                        $product_name_with_choice = $product->getTranslation('name');

                        if ($cartItem['variation'] != null) {

                            $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];

                        }

                    @endphp


                    <li class="cart-item item{{$cartItem['id']}}">

                        <div class="d-flex">

                            <div class="img-wrap">

                                <img class="product-img" src="{{ uploaded_asset($product->thumbnail_img) }}"

                                 alt="{{ $product->getTranslation('name') }}"

                                 onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">

                            </div>

                            <div class="product-info">

                                <h5 class="product-name">{{ $product_name_with_choice }}</h5>

                                <h6 class="product-option"><dt>Pack:</dt><dd>White, 1-Pack</h6>

                                <div class="d-flex align-items-center">

                                    @if ($cartItem['digital'] != 1 && $product->auction_product == 0)

                                        <div class="d-flex aiz-plus-minus border">

                                            <button 

                                                class="btn btn-icon btn-sm btn-circle border-0" 

                                                type="button" data-type="minus" 

                                                data-field="quantity[{{ $cartItem['id'] }}]">

                                                <i class="las la-minus"></i>

                                            </button>

                                            <input type="number" name="quantity[{{ $cartItem['id'] }}]" 
                                            
                                            class="border-0 fs-14 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" 
                                            
                                            min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" 

                                            onchange="updateQuantity({{ $cartItem['id'] }}, this , 'price{{$cartItem['id']}}')" />

                                            <button class="btn btn-icon btn-sm btn-circle border-0" 

                                            type="button" data-type="plus" 

                                            data-field="quantity[{{ $cartItem['id'] }}]">

                                                <i class="las la-plus"></i>

                                            </button>

                                        </div>

                                    @elseif($product->auction_product == 1)

                                        <span class="fw-700 fs-14">1</span>

                                    @endif

                                    <div class="delete-btn">

                                        <a href="javascript:void(0)" onclick="removeFromCarts({{ $cartItem['id'] }}) ; removeitem('item{{$cartItem['id']}}' , 'price{{$cartItem['id']}}')" class="btn btn-icon btn-sm btn-soft-primary bg-soft-warning hov-bg-primary btn-circle d-flex align-items-center justify-content-center ml-2 stop-propagation"> 
                                        {{-- <a href="javascript:void(0)" onclick="removeitem('item{{$cartItem['id']}}' , 'price{{$cartItem['id']}}')" class="btn btn-icon btn-sm btn-soft-primary bg-soft-warning hov-bg-primary btn-circle d-flex align-items-center justify-content-center ml-2 stop-propagation">  --}}

                                            <i class="las la-trash fs-16"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="price">

                            <h6 id="price{{$cartItem['id']}}">{{ single_price(cart_product_price($cartItem, $product, false) * $cartItem['quantity']) }}</h6>

                        </div>

                    </li>

                @endforeach

                @if(isset($cloud) && $cloud !== null)

                <div class="item">

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
                @endif

            </ul>


            <!-- Card Items Footer -->
            
            <div class="cart-items-footer">

                @if(isset($cloud) && $cloud !== null)

                    <h4 class="subtotalElement">Subtotal · <span id="totalp">{{count($carts)}}, (Cloud Service) items</span> <span id='subtotal'>{{ single_price($total+$cloud->amount) }}</span></h4>

                @else

                    <h4 class="subtotalElement">Subtotal · <span id="totalp">{{count($carts)}} items</span>  <span id='subtotal'>{{ single_price($total) }}</span></h4>

                @endif

                {{-- <h4 class="subtotalElement">Subtotal ·{{$count}} items <span id='subtotal'>{{ single_price($total) }}</span></h4> --}}

                <a href="{{ route('checkout.shipping_info') }}" class="checkout-btn"><i class="fa fa-lock" aria-hidden="true"></i> Check out </a>

            </div>

            <!-- ./Card Items Footer -->

        </div>

    @else

        {{-- <div class="row">

            <div class="col-xl-8 mx-auto">

                <div class="border bg-white p-4"> --}}

                    <!-- Empty cart -->

                    <div class="text-center p-3">

                        <i class="las la-frown la-3x opacity-60 mb-3"></i>

                        <h3 class="h4 fw-700">{{translate('Your Cart is empty')}}</h3>

                    </div>

                {{-- </div>

            </div>

        </div> --}}

    @endif

    
    <div class="releted-sec">

        <h6><b>Releted Products</b></h6>
        
        <ul class="cart-items releted-items">



            @foreach (get_best_selling_products_for_cart() as $key => $top_product)

                <li class="cart-item">

                    <form id="optiontest-choice-form{{$key}}">

                        @csrf

                        <input type="hidden" name="quantity" value="1">
        
                        <input type="hidden" id="productkey{{$key}}"   name="id"  value="{{$top_product->id}}">
                        
                        <div class="d-flex align-items-center">

                                <div class="img-wrap">

                                    <img class="product-img img-fit lazyload h-80px h-md-150px h-lg-80px has-transition" 

                                    data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"

                                    alt="{{ $top_product->getTranslation('name') }}"

                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">

                                </div>

                                <div class="product-info">

                                    <h5 class="product-name">{{ $top_product->getTranslation('name') }}</h5>

                                    <div class="price">

                                        <h6>{{ home_discounted_base_price($top_product) }}</h6>

                                    </div>

                                </div>

                        </div>

                    </form>
                    
                    <div class="btn-sec">

                        <a href="javascript:void(0)" onclick="addToaddon('optiontest-choice-form{{$key}}')" class="btn btn-md btn-blue text-white px-3"> Add </a>

                    </div> 

                </li>

            @endforeach
            
        </ul>

    </div>


</div>

{{-- <script type="text/javascript">

    AIZ.extra.plusMinus();

</script> --}}

<script>

    function updateQuantity(key, element , price) {

        $.post('https://login2design.in/zoobla_staging/cart/updateQuantity', {

            _token: AIZ.data.csrf,

            id: key,

            quantity: element.value

        }, function(data) {

            updateNavCart(data.nav_cart_view, data.cart_count);

            $('#new-cart-modal').html(null);
            
            $('#cart-summary').html(data.cart_view);

            $('#new-cart-modal').html(data.cart_view);

            var newSubtotal = data.sub_total;

            $('#subtotal').text('$' + newSubtotal+'.00');

            $('#'+price).text(' $' + data.current_price +'.00')

            $('#cart-summary').html(data.cart_view);

        });

    }

    function addToaddon(id){

        var url = "{{ route('cart.addToCart') }}";

        if(checkAddToCartValidity()) {
            
            // $('#addToCart').modal();
            
            // $('.c-preloader').show();
            
            $.ajax({
                
            type:"POST",
            
            url: url,
            
            data: $('#'+id).serializeArray(),
            
            success: function(data){
                
            // $('#addToCart-modal-body').html(null);

            $('#new-cart-modal').html(null);
            
            // $('.c-preloader').hide();
            
            // $('#modal-size').removeClass('modal-lg');
            
            // $('#addToCart-modal-body').html(data.modal_view);

            $('#new-cart-modal').html(data.new_cart_view);

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

    function removeitem(itemid , pid){

        let subtotal = parseInt($('#subtotal').text().replace(/[^0-9]/g, ''), 10)/100 ;

        let price    =  $('#'+pid).text();

        $('.' + itemid).each(function () {
        
            var cloudeamountElement = $(this).find('#cloudeamount');

            if (cloudeamountElement.length > 0) {
            
                let cloudeamount = $('#cloudeamount').val();

                subtotal = subtotal - parseInt(cloudeamount);
            }

        });

        const newsubtotal  = subtotal - parseInt(price.replace(/[^0-9]/g, ''), 10)/100;

        if(newsubtotal == 0){

            $('.cart-items-footer').remove();

            // $('#productcontainer , ').remove();

            const htmlContent = '<div class="text-center p-3">' +
                            '<i class="las la-frown la-3x opacity-60 mb-3"></i>' +
                            '<h3 class="h4 fw-700">{{translate("Your Cart is empty")}}</h3>' +
                            '</div>';

            $('#productcontainer').append(htmlContent);

           
        }else{

            $('#subtotal').text('');

            let count = parseInt($('#totalp').text()) - 1;

            $('#totalp').text('');

            $('#totalp').text(count);

            $('#subtotal').text('$' + newsubtotal +'.00');

        }
            
        $('.'+itemid).remove();

    }

    function removeFromCarts(key){

            $.post('{{ route('cart.removeFromCart') }}', {

                _token  : AIZ.data.csrf,

                id      :  key

            }, function(data){

                updateNavCart(data.nav_cart_view,data.cart_count);

                $('#new-cart-modal').html(null);

                $('#cart-summary').html(data.cart_view);
                
                $('#new-cart-modal').html(data.cart_view);

                AIZ.plugins.notify('success', "{{ translate('Item has been removed from cart') }}");

                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            });
        }
</script>
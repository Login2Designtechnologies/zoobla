 @extends('frontend.layouts.user_panel')
   @section('panel_content')

{{-- @extends('frontend.layouts.app') --}}
{{-- @section('content') --}}

    <!-- Steps -->

<div class="back-btn" style="margin-left:14px;">
    <a href="{{url('/')}}" class="btn btn-sm btn-dark">Back</a>
</div>

    <section class="pt-5 mb-4">

        <div class="container">

            <div class="row">

                <div class="col-xl-8 mx-auto">

                    <div class="row gutters-5 sm-gutters-10">

                        <div class="col active">

                            <div class="text-center border border-bottom-6px p-2 text-primary">

                                <i class="la-3x mb-2 las la-shopping-cart cart-animate" style="margin-left: -100px; transition: 2s;"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart') }}</h3>

                            </div>

                        </div>

                        <div class="col">

                            <div class="text-center border border-bottom-6px p-2">

                                <i class="la-3x mb-2 opacity-50 las la-map"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('2. Shipping info') }}

                                </h3>

                            </div>

                        </div>

                        <div class="col">

                            <div class="text-center border border-bottom-6px p-2">

                                <i class="la-3x mb-2 opacity-50 las la-truck"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('3. Delivery info') }}

                                </h3>

                            </div>

                        </div>

                        <div class="col">

                            <div class="text-center border border-bottom-6px p-2">

                                <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('4. Payment') }}</h3>

                            </div>

                        </div>

                        <div class="col">

                            <div class="text-center border border-bottom-6px p-2">

                                <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>

                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('5. Confirmation') }}

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- Cart Details -->
{{-- @dd($carts ,$cloud) --}}
    <section class="mb-4" id="cart-summary">
        @if (Session::has('cloud_service_id')) 

            @include('frontend.partials.cart_details', ['carts' => $carts ,'cloud' =>$cloud])
        
        @else

            @include('frontend.partials.cart_details', ['carts' => $carts ])

        @endif

    </section>



@endsection



@section('script')

    <script type="text/javascript">

        function removeFromCartView(e, key) {

            e.preventDefault();

            removeFromCart(key);

        }



        function updateQuantity(key, element) {

            $.post('{{ route('cart.updateQuantity') }}', {

                _token: AIZ.data.csrf,

                id: key,

                quantity: element.value

            }, function(data) {

                updateNavCart(data.nav_cart_view, data.cart_count);

                $('#cart-summary').html(data.cart_view);

            });

        }

    </script>

@endsection


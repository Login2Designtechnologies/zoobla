@extends('frontend.layouts.user_panel')

@section('panel_content')

<style>
    .stripe-form-box {
         display: none;
    }

    .stripe-ttl {
        display: none;
    }
    #loader span, .opacity {
        position: fixed;
        width: 100%;
        height: 100%;
        left: 50%;
        transform: translate(-50%, -50%);
        top: 50%;
        z-index: 99;
        background: rgba(255,255,255,0.8);
    }
    #loader span:after {
        background: url(https://login2design.in/zoobla_staging/public/assets/img/loading-gif-png-4.gif);
        content: '';
        position: absolute;
        z-index: 9999;
        width: 200px;
        height: 200px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .modal-card{    
        width: 500px;
        background: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 20px rgb(174 166 166 / 50%);
        border-radius: 5px;
        max-width: 100%;
        margin: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
    .modal-card .modal-card-info{   
        padding: 50px 20px 30px;
        text-align: center;
    }
    .modal-card .modal-card-info p{    
        margin-bottom: 0px;    font-size: 18px;
        color: green;    font-weight: 600;
    }
    .modal-card .modal-card-info i{   
        font-size: 60px;
        margin-bottom: 15px;
        color: #008021;
    }
    .payment-img.ach-img img {
        width: 40px;
        height: 40px;
    }
</style>

    <div id="loader" style="display: none;">
        <span></span>
    </div>

    <!-- The Modal -->
    <div class="modal-card" id="modal-card" style="display: none;">
        
        <div class="modal-card-info">

            <i class="fa fa-check-circle-o" aria-hidden="true"></i>

            <p id="payment-status"></p>

            <input type="hidden" id="Transaction_id" >

            <div class="btn-block mt-2">

                <!-- <button type="button"  class="btn btn-primary fs-16 fw-700 rounded-2 px-5">OK</button> -->
                    <a href="{{route('service-detail', encrypt($order->id))}}" id="okButton" class="btn btn-primary fs-16 fw-700 rounded-2 px-5"> OK</a>
            </div>

        </div>
        
    </div>

    <span class="opacity" id="opacity" style="display: none;"></span>


<table class="table table-bordered">
    <thead>
        <tr>
            <th class="product-name">Product</th>
            <th class="product-quantity">Quantity</th>
            <th class="product-total">Totals</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th scope="row" colspan="2">Subtotal:</th>
            <td class="product-total">
                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{ single_price($order->amount) }}</span>
            </td>
        </tr>
        <!-- <tr>
            <th scope="row" colspan="2">Shipping:</th>
            <td class="product-total">Free shipping</td>
        </tr> -->
        <tr>
            <th scope="row" colspan="2">Tax:</th>
            <td class="product-total">
                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>00.00</span>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Payment method:</th>
            <td class="product-total">Via ACH Payment</td>
        </tr>
        <tr>
            <th scope="row" colspan="2">Total:</th>
            <td class="product-total">
                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{ single_price($order->amount) }} / month
            </td>
        </tr>
    </tfoot>
    
    <tbody>
        @foreach (json_decode($order->camera_detail)  as $key => $orderDetail)

            @if($orderDetail->qty == 0)

                @continue

            @endif
      
            <tr>

                <td class="product-name">
                    @if ($orderDetail->cam_name != null)

                        {{$orderDetail->cam_name}}

                    @else

                    <strong>{{ translate('N/A') }}</strong>

                    @endif
                </td>

                <td class="product-quantity">{{ $orderDetail->qty}}</td>

                <td class="product-subtotal">

                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{ single_price($orderDetail->cam_price * $orderDetail->qty) }} / month

                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>


    <div id="payment">
        <ul class="payment_methods methods">

            <li class="payment_method stripe-payment_li">

                <input id="stripe-payment" type="radio" class="input-radio" name="payment_method" value="stripe_cc" onclick=" Showstripe('stripe')"/>

                <label for="stripe-payment">
                    Credit/Debit Cards

                    <span class="payment-img credit-img">

                        <img decoding="async" class="amex" src="https://login2design.in/zoobla_staging/public/assets/images/card-payment.jpg"/>

                    </span>

                </label>

                <div class="row stripe-form-box ">

                    <div class="col-lg-12">
                        
                       <!-- <div class="card rounded-0 border shadow-none"> -->

                            <form action="{{route('checkout.process.payment')}}" id="payment-form">

                                <h6 class="stripe-ttl">Credit/Debit Cards <img class="img-fluid" src="../public/assets/images/strip-img.jpg" alt=""></h6>       
                                
                                <div id="card-element" class="stripe-input-box"></div>

                                <div id="card-errors" role="alert"></div>

                                <button id="submit" class="btn btn-primary fs-14 fw-700 rounded-0 px-4 float-right" style="margin-top:10px !important">Pay Now</button>

                            </form>

                            <script src="https://js.stripe.com/v3/"></script>
                        
                            <script>
                                
                                var stripe = Stripe('{{ env('STRIPE_KEY') }}');

                                const elements = stripe.elements();
                                
                                // Custom styling can be passed to options when creating an Element.
                                const style = {
                                base: {
                                    // Add your base input styles here. For example:
                                    fontSize: '16px',
                                    color: '#32325d',
                                },
                                };
                                
                                // Create an instance of the card Element.
                                const card = elements.create('card', {style});
                                
                                // Add an instance of the card Element into the `card-element` <div>.
                                card.mount('#card-element');
                                
                                // Create a token or display an error when the form is submitted.
                                const form = document.getElementById('payment-form');

                                form.addEventListener('submit', async (event) => {

                                event.preventDefault();
                                
                                const {token, error} = await stripe.createToken(card);
                                
                                if (error) {
                                    // Inform the customer that there was an error.
                                    const errorElement = document.getElementById('card-errors');
                                    errorElement.textContent = error.message;
                                } else {
                                    // Send the token to your server.
                                    stripeTokenHandler(token);
                                }
                                });

                                const stripeTokenHandler = (token) => {

                                    // Show loader
                                    document.getElementById('loader').style.display = 'block';

                                    // Retrieve CSRF token from the page
                                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                    // Submit the form
                                    var xhr = new XMLHttpRequest();
                                    var url = '{{ route('checkout.process.payment') }}'+'/{{$order->amount}}'+'/{{$order->id}}';  // Replace with your server endpoint
                                    
                                    var stripeToken = token.id;  // Replace with your token

                                    xhr.open('POST', url, true);
                                    xhr.setRequestHeader('Content-Type', 'application/json');
                                    
                                    // Set the CSRF token in the request header
                                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState == 4) {

                                                // Hide loader
                                                document.getElementById('loader').style.display = 'none';

                                            if (xhr.status == 200) {
                                                var scatterSeries = [];
                                                scatterSeries.push(xhr.responseText);
                                                var response = JSON.parse(scatterSeries);

                                                // Handle the server response as needed
                                                console.log(response);

                                                if (response.status = "success") {

                                                    document.getElementById('modal-card').style.display = 'block';

                                                    document.getElementById('payment-status').textContent  = 'Your payment successful';

                                                    document.getElementById('Transaction_id').value  = response.Transaction_id;

                                                    document.getElementById('opacity').style.display = 'block';

                                                } else {

                                                    document.getElementById('modal-card').style.display = 'block';

                                                    document.getElementById('payment-status').textContent  = 'Your payment failed';

                                                    document.getElementById('opacity').style.display = 'block';

                                                    // alert('Payment failed: ' + response.error);
                                                }
                                            }
                                            else {
                                                // Handle errors if any
                                                console.log('Error:', xhr.statusText);
                                            }
                                        }
                                    };

                                    var data = JSON.stringify({
                                        stripeToken: stripeToken
                                    });

                                    xhr.send(data);
                                };

                                document.getElementById("okButton").addEventListener("click", function() {

                                    document.getElementById('modal-card').style.display = 'none';
                                    
                                    document.getElementById('opacity').style.display = 'none';

                                    window.location.back();
                                });

                                
                            </script>

                        <!-- </div>  -->

                    </div>

                </div>

            </li>
           
            <!-- <li class="payment_method googlepay-payment_li">

                <input id="googlepay-payment" type="radio" class="input-radio" name="payment_method" value="stripe_googlepay" onclick=" Showstripe('googlepay')"/>

                <label for="googlepay-payment">Google Pay

                    <span class="payment-img gpay-img">

                        <img decoding="async" src="https://pay.zoobla.com/wp-content/plugins/woo-stripe-payment/assets/img/googlepay_round_outline.svg" alt="Google Pay" />

                    </span>

                </label>

                <div class="payment_box googlepay-payment hide">

                    G Pay

                </div>

            </li>
-->
            <li class="payment_method ach-payment_li" >

               <form action="{{route('checkout.process.payment')}}" method="post" id="ach_stripe">
                    
                    @csrf
                                
                    <input id="ach-payment" type="radio" class="input-radio" name="payment_method" value="stripe_ach"/>

                    <input type="hidden" name="amount" value="{{$order->amount}}">

                    <input type="hidden" name="id" value="{{$order->id}}">

                </form> 

                <label for="ach-payment">ACH Payment
                    <span class="payment-img ach-img">
                        <img decoding="async" src="https://pay.zoobla.com/wp-content/plugins/woo-stripe-payment/assets/img/ach.svg" alt="ACH Payment" />
                    </span>
                </label>
                <!-- <div class="payment_box ach-payment hide">
                    Ach Payment
                </div> -->
            </li> 
        </ul>
        <div class="btn-block d-flex justify-content-end">
            <button type="submit" form="ach_stripe" class="btn btn-md btn-primary">Pay Now</button>
        </div>
    
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function Showstripe(getway) {

        if (getway == 'stripe') {
            
            $('.stripe-form-box').show();
            
            $('.hide-button').hide();

            $('#agree_checkbox').prop('checked', true);

        } else {
            
            $('.stripe-form-box').hide();
            
            $('.hide-button').show();
        }

    }
    $(document).ready(function() {
        // Initially hide all payment boxes except the one that is checked
        $('.payment_methods li:not(:has(input:checked)) .payment_box').hide();
    
        // When a radio button is clicked
        $('input[type=radio][name=payment_method]').change(function() {
            // Hide all payment boxes
            $('.payment_box').hide();
            
            // Show the payment box corresponding to the selected payment method
            $(this).closest('li').find('.payment_box').show();
        });
    });
</script>


@endsection





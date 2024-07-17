<?php



namespace App\Http\Controllers;



use App\Utility\PayfastUtility;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Cart;

use App\Models\OrderDetail;

use App\Models\Order;

use App\Models\Coupon;

use App\Models\CouponUsage;

use App\Models\Address;

use App\Models\Carrier;

use App\Models\CombinedOrder;

use App\Models\Product;

use App\Utility\PayhereUtility;

use App\Utility\NotificationUtility;

use Session;

use Auth;

use Mail;

use DB;

class CheckoutController extends Controller

{



    public function __construct()

    {

        //

    }



    //check the selected payment gateway and redirect to that controller accordingly

    public function checkout_paypal(Request $request)

    {   

        // dd($request->all());

        // Minumum order amount check

        if($request->payment_status == 'COMPLETED'){

            $carts = Cart::where('user_id', Auth::user()->id)

                ->get();



            if ($carts->isEmpty()) {

                flash(translate('Your cart is empty'))->warning();

                return redirect()->route('home');

            }



            $address = Address::where('id', $carts[0]['address_id'])->first();



            $shippingAddress = [];

            if ($address != null) {

                $shippingAddress['name']        = Auth::user()->name;

                $shippingAddress['email']       = Auth::user()->email;

                $shippingAddress['address']     = $address->address;

                $shippingAddress['country']     = $address->country->name;

                $shippingAddress['state']       = $address->state->name;

                $shippingAddress['city']        = $address->city->name;

                $shippingAddress['postal_code'] = $address->postal_code;

                $shippingAddress['phone']       = $address->phone;

                if ($address->latitude || $address->longitude) {

                    $shippingAddress['lat_lang'] = $address->latitude . ',' . $address->longitude;

                }

            }



            $combined_order = new CombinedOrder;

            $combined_order->user_id = Auth::user()->id;

            $combined_order->shipping_address = json_encode($shippingAddress);

            $combined_order->save();



            $seller_products = array();

            foreach ($carts as $cartItem) {

                $product_ids = array();

                $product = Product::find($cartItem['product_id']);

                if (isset($seller_products[$product->user_id])) {

                    $product_ids = $seller_products[$product->user_id];

                }

                array_push($product_ids, $cartItem);

                $seller_products[$product->user_id] = $product_ids;

            }



            foreach ($seller_products as $seller_product) {

                $order = new Order;

                $order->combined_order_id = $combined_order->id;

                $order->user_id = Auth::user()->id;

                $order->shipping_address = $combined_order->shipping_address;

                $order->additional_info = $request->additional_info;

                $order->payment_type = $request->payment_option;

                $order->delivery_viewed = '0';

                $order->payment_status = 'paid';

                $order->payment_type = 'paypal';

                $order->payment_details = '{"status":"Success"}';

                $order->payment_status_viewed = '0';

                $order->code = date('Ymd-His') . rand(10, 99);

                $order->date = strtotime('now');

                $order->save();



                $subtotal = 0;

                $tax = 0;

                $shipping = 0;

                $coupon_discount = 0;



                //Order Details Storing

                foreach ($seller_product as $cartItem) {

                    $product = Product::find($cartItem['product_id']);

                    $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                    $tax +=  cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];

                    $coupon_discount += $cartItem['discount'];



                    $product_variation = $cartItem['variation'];



                    $product_stock = $product->stocks->where('variant', $product_variation)->first();

                    if ($product->digital != 1 && $cartItem['quantity'] > $product_stock->qty) {

                        flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();

                        $order->delete();

                        // return redirect()->route('cart')->send();

                        return 'failed';

                    } elseif ($product->digital != 1) {

                        $product_stock->qty -= $cartItem['quantity'];

                        $product_stock->save();

                    }

                    


                    $order_detail = new OrderDetail;

                    $order_detail->order_id = $order->id;

                    $order_detail->seller_id = $product->user_id;

                    $order_detail->product_id = $product->id;

                    $order_detail->variation = $product_variation;

                    $order_detail->price = cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                    $order_detail->tax = cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];

                    $order_detail->shipping_type = $cartItem['shipping_type'];

                    $order_detail->product_referral_code = (Session::has('partner-code')) ? Session::get('partner-code') : $cartItem['product_referral_code'];

                    $order_detail->shipping_cost = $cartItem['shipping_cost'];



                    $shipping += $order_detail->shipping_cost;

                    //End of storing shipping cost



                    $order_detail->quantity = $cartItem['quantity'];



                    if (addon_is_activated('club_point')) {

                        $order_detail->earn_point = $product->earn_point;

                    }

                    

                    $order_detail->save();



                    $product->num_of_sale += $cartItem['quantity'];

                    $product->save();



                    $order->seller_id = $product->user_id;

                    $order->shipping_type = $cartItem['shipping_type'];

                    

                    if ($cartItem['shipping_type'] == 'pickup_point') {

                        $order->pickup_point_id = $cartItem['pickup_point'];

                    }

                    if ($cartItem['shipping_type'] == 'carrier') {

                        $order->carrier_id = $cartItem['carrier_id'];

                    }



                    if ($product->added_by == 'seller' && $product->user->seller != null) {

                        $seller = $product->user->seller;

                        $seller->num_of_sale += $cartItem['quantity'];

                        $seller->save();

                    }



                    if (addon_is_activated('affiliate_system')) {

                        if ($order_detail->product_referral_code) {

                            $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();



                            $affiliateController = new AffiliateController;

                            $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);

                        }

                    }

                }



                // $order->grand_total = $subtotal + $tax + $shipping;
                $order->grand_total = $request['amount'];

                $product_price   = $subtotal + $tax + $shipping;

                if ($seller_product[0]->coupon_code != null) {

                    $order->coupon_discount = $coupon_discount;

                    $order->grand_total -= $coupon_discount;



                    $coupon_usage = new CouponUsage;

                    $coupon_usage->user_id = Auth::user()->id;

                    $coupon_usage->coupon_id = Coupon::where('code', $seller_product[0]->coupon_code)->first()->id;

                    $coupon_usage->save();

                }



                $combined_order->grand_total += $order->grand_total;

                if($order->save()){

                    DB::table('orders')->where('id' , $order->id)->update(['product_price' => $product_price ,'bundle_discount'=> $request['bundle_discount']]);
                    
                }

            }



            $combined_order->save();



            foreach($combined_order->orders as $order){

                NotificationUtility::sendOrderPlacedNotification($order);

            }



            $request->session()->put('combined_order_id', $combined_order->id);

            $emailData = [
                 'key1' => 'value1', // Replace with your actual data
                 'key2' => 'value2',
                 // Add more key-value pairs as needed
             ];

             Mail::send(['html' => 'frontend.paymentemail'], $emailData, function ($message) use ($request) {
                 $message->to('sandeepjangid@login2design.com')->subject('zoobla');
                 $message->from('info@login2design.com', 'Zoobla');
             });

             $request->session()->put('payment_type', 'cart_payment');

             $combined_order = CombinedOrder::findOrFail($combined_order->id);

             $check_storage = DB::table('cloude_service')->where('user_id', Auth::user()->id)->where('payment_status', 1)->first();

             if(!empty($check_storage)){

                 $order = Order::where('combined_order_id' ,$request->session()->get('combined_order_id'))->first();

                 $updatcloude =[
                     'order_id'              =>     $order->code,
                     'order_status'          =>     2,
                     'payment_status'        =>     2,
                 ];

                 $cart_detail = DB::table('cloude_service')->where('id', $check_storage->id)->update($updatcloude);

                
             }
        
            Cart::where('user_id', $combined_order->user_id)->delete();

             return 'success';
        } else {

            return 'failed';
        }

        

    }

    public function checkout(Request $request)

    {   

        // Minumum order amount check

        if(get_setting('minimum_order_amount_check') == 1){

            $subtotal = 0;

            foreach (Cart::where('user_id', Auth::user()->id)->get() as $key => $cartItem){ 

                $product = Product::find($cartItem['product_id']);

                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

            }

            if ($subtotal < get_setting('minimum_order_amount')) {

                flash(translate('You order amount is less than the minimum order amount'))->warning();

                return redirect()->route('home');

            }

        }


        // Minumum order amount check end

           $emailData = [
                'key1' => 'value1', // Replace with your actual data
                'key2' => 'value2',
                // Add more key-value pairs as needed
            ];

            Mail::send(['html' => 'frontend.paymentemail'], $emailData, function ($message) use ($request) {
                $message->to('sandeepjangid@login2design.com')->subject('zoobla');
                $message->from('info@login2design.com', 'Zoobla');
            });

        if ($request->payment_option != null) {

            // dd($request->all());
            (new OrderController)->store($request);



            $request->session()->put('payment_type', 'cart_payment');

            

            $data['combined_order_id'] = $request->session()->get('combined_order_id');

            $request->session()->put('payment_data', $data);



            if ($request->session()->get('combined_order_id') != null) {

               $update =  CombinedOrder::where('id', $request->session()->get('combined_order_id'))->update(['grand_total' => $request->amount]);

                // If block for Online payment, wallet and cash on delivery. Else block for Offline payment
                if($request->payment_option != 'Stripe'){

                  
                    $decorator = __NAMESPACE__ . '\\Payment\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $request->payment_option))) . "Controller";

                    if (class_exists($decorator)) {

                        return (new $decorator)->pay($request);

                    }else {

                        $combined_order = CombinedOrder::findOrFail($request->session()->get('combined_order_id'));
    
                        $manual_payment_data = array(
    
                            'name'   => $request->payment_option,
    
                            'amount' => $combined_order->grand_total,
    
                            'trx_id' => $request->trx_id,
    
                            'photo'  => ($request->photo != null) ? $request->photo : ''
    
                        );
    
                        
                        foreach ($combined_order->orders as $order) {
    
                            $order->manual_payment = 1;
    
                            $order->manual_payment_data = json_encode($manual_payment_data);
    
                            $order->save();
    
                        }
    
                        flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
    
                        return redirect()->route('order_confirmed');
    
                    }

                }else{

                    if (Session::has('cloud_service_id')) {

                        $order = Order::where('combined_order_id' ,$request->session()->get('combined_order_id'))->first();

                        $updatcloude =[
                            'order_id'              =>     $order->code,
                            'order_status'          =>     2,
                            'payment_status'        =>     2,
                        ];

                        $cart_detail = DB::table('cloude_service')->where('id', session::get('cloud_service_id'))->update($updatcloude);

                       
                    }

                   $payment = ["status" => "Success"];

                   if($this->checkout_done($request->session()->get('combined_order_id') , json_encode($payment))){

                       Session::forget('cloud_service_id');

                       return redirect()->route('order_confirmed');

                   }

                }

            }

        } else {

            flash(translate('Select Payment Option.'))->warning();

            return back();

        }

    }

    public function check(Request $request , $amount = null , $id = null)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // dd($id);
        if($request->payment_method == 'stripe_ach'){

            $decorator = __NAMESPACE__ . '\\Payment\\AchController';

            if (class_exists($decorator)) {

                return (new $decorator)->pay($request);

            }

         
        }else{

            if($amount != null){

                $subtotal = intval($amount) ;

            
            }else{

                $subtotal = intval(get_bundle_discount()['total_amount']);

            }
            
           
            $existingRecord = DB::table('stripe_details')->where('user_id', Auth::user()->id)->first();
            
            $customer = \Stripe\Customer::create([

                'description' => Auth::User()->name,
    
                'email' => Auth::User()->email,
    
                'source' => $request->stripeToken,
    
            ]);

            $customer_id = $customer->id;

            if ($existingRecord) {
            
                DB::table('stripe_details')->where('user_id', Auth::user()->id)->update(['customer_id' => $customer->id,]);
            
            } else {

                DB::table('stripe_details')->insert(['user_id' => Auth::user()->id,'customer_id' => $customer->id,]);
            }

            $array  =  [

                'amount' =>  $subtotal*100,

                'currency' => strtolower(\App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code),

                'customer' => $customer_id,

            ];
        
            $charge = \Stripe\Charge::create($array);
        
            $chargeJson = $charge->jsonSerialize();
        
            if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {

                $dataDB = [
                    'bk_id' => $request->input('bookid'),

                    'paid_amount' => $chargeJson['amount'] / 100,

                    'paid_amount_currency' => $chargeJson['currency'],

                    'txn_id' => $chargeJson['balance_transaction'],

                    'payment_status' => $chargeJson['status'],

                    'created' => now(),

                    'modified' => now(),

                ];
        
                if ($chargeJson['status'] == 'succeeded') {

                    $carts = Cart::where('user_id', Auth::user()->id)

                        ->get();



                    if ($carts->isEmpty()) {

                        flash(translate('Your cart is empty'))->warning();

                        return redirect()->route('home');

                    }



                    $address = Address::where('id', $carts[0]['address_id'])->first();



                    $shippingAddress = [];

                    if ($address != null) {

                        $shippingAddress['name']        = Auth::user()->name;

                        $shippingAddress['email']       = Auth::user()->email;

                        $shippingAddress['address']     = $address->address;

                        $shippingAddress['country']     = $address->country->name;

                        $shippingAddress['state']       = $address->state->name;

                        $shippingAddress['city']        = $address->city->name;

                        $shippingAddress['postal_code'] = $address->postal_code;

                        $shippingAddress['phone']       = $address->phone;

                        if ($address->latitude || $address->longitude) {

                            $shippingAddress['lat_lang'] = $address->latitude . ',' . $address->longitude;

                        }

                    }



                    $combined_order = new CombinedOrder;

                    $combined_order->user_id = Auth::user()->id;

                    $combined_order->shipping_address = json_encode($shippingAddress);

                    $combined_order->save();



                    $seller_products = array();

                    foreach ($carts as $cartItem) {

                        $product_ids = array();

                        $product = Product::find($cartItem['product_id']);

                        if (isset($seller_products[$product->user_id])) {

                            $product_ids = $seller_products[$product->user_id];

                        }

                        array_push($product_ids, $cartItem);

                        $seller_products[$product->user_id] = $product_ids;

                    }

                    $code = date('Ymd-His') . rand(10, 99);

                    foreach ($seller_products as $seller_product) {

                        $order = new Order;

                        $order->combined_order_id = $combined_order->id;

                        $order->user_id = Auth::user()->id;

                        $order->shipping_address = $combined_order->shipping_address;

                        $order->additional_info = $request->additional_info;

                        $order->payment_type = $request->payment_option;

                        $order->delivery_viewed = '0';

                        $order->payment_status = 'paid';

                        $order->payment_type = 'Stripe';

                        $order->payment_details = '{"status":"Success"}';

                        $order->payment_status_viewed = '0';

                        $order->code = $code;

                        $order->date = strtotime('now');

                        $order->save();



                        $subtotal = 0;

                        $tax = 0;

                        $shipping = 0;

                        $coupon_discount = 0;



                        //Order Details Storing

                        foreach ($seller_product as $cartItem) {

                            $product = Product::find($cartItem['product_id']);

                            $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                            $tax +=  cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];

                            $coupon_discount += $cartItem['discount'];



                            $product_variation = $cartItem['variation'];



                            $product_stock = $product->stocks->where('variant', $product_variation)->first();

                            if ($product->digital != 1 && $cartItem['quantity'] > $product_stock->qty) {

                                flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();

                                $order->delete();

                                // return redirect()->route('cart')->send();

                                return 'failed';

                            } elseif ($product->digital != 1) {

                                $product_stock->qty -= $cartItem['quantity'];

                                $product_stock->save();

                            }

                            


                            $order_detail = new OrderDetail;

                            $order_detail->order_id = $order->id;

                            $order_detail->seller_id = $product->user_id;

                            $order_detail->product_id = $product->id;

                            $order_detail->variation = $product_variation;

                            $order_detail->price = cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                            $order_detail->tax = cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];

                            $order_detail->shipping_type = $cartItem['shipping_type'];

                            $order_detail->product_referral_code = (Session::has('partner-code')) ? Session::get('partner-code') : $cartItem['product_referral_code'];

                            $order_detail->shipping_cost = $cartItem['shipping_cost'];



                            $shipping += $order_detail->shipping_cost;

                            //End of storing shipping cost



                            $order_detail->quantity = $cartItem['quantity'];



                            if (addon_is_activated('club_point')) {

                                $order_detail->earn_point = $product->earn_point;

                            }

                            

                            $order_detail->save();



                            $product->num_of_sale += $cartItem['quantity'];

                            $product->save();



                            $order->seller_id = $product->user_id;

                            $order->shipping_type = $cartItem['shipping_type'];

                            

                            if ($cartItem['shipping_type'] == 'pickup_point') {

                                $order->pickup_point_id = $cartItem['pickup_point'];

                            }

                            if ($cartItem['shipping_type'] == 'carrier') {

                                $order->carrier_id = $cartItem['carrier_id'];

                            }



                            if ($product->added_by == 'seller' && $product->user->seller != null) {

                                $seller = $product->user->seller;

                                $seller->num_of_sale += $cartItem['quantity'];

                                $seller->save();

                            }



                            if (addon_is_activated('affiliate_system')) {

                                if ($order_detail->product_referral_code) {

                                    $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();



                                    $affiliateController = new AffiliateController;

                                    $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);

                                }

                            }

                        }



                        // $order->grand_total = $subtotal + $tax + $shipping;
                        $order->grand_total = $request['amount'];

                        $product_price   = $subtotal + $tax + $shipping;

                        if ($seller_product[0]->coupon_code != null) {

                            $order->coupon_discount = $coupon_discount;

                            $order->grand_total -= $coupon_discount;



                            $coupon_usage = new CouponUsage;

                            $coupon_usage->user_id = Auth::user()->id;

                            $coupon_usage->coupon_id = Coupon::where('code', $seller_product[0]->coupon_code)->first()->id;

                            $coupon_usage->save();

                        }



                        $combined_order->grand_total += $order->grand_total;

                        if($order->save()){

                            DB::table('orders')->where('id' , $order->id)->update(['product_price' => $product_price ,'bundle_discount'=> $request['bundle_discount']]);
                            
                        }

                    }



                    $combined_order->save();



                    foreach($combined_order->orders as $order){

                        NotificationUtility::sendOrderPlacedNotification($order);

                    }



                    $request->session()->put('combined_order_id', $combined_order->id);

                    $emailData = [
                         'key1' => 'value1', // Replace with your actual data
                         'key2' => 'value2',
                         // Add more key-value pairs as needed
                     ];

                     Mail::send(['html' => 'frontend.paymentemail'], $emailData, function ($message) use ($request) {
                         $message->to('sandeepjangid@login2design.com')->subject('zoobla');
                         $message->from('info@login2design.com', 'Zoobla');
                     });

                     $request->session()->put('payment_type', 'cart_payment');

                     $combined_order = CombinedOrder::findOrFail($combined_order->id);

                    
                    Cart::where('user_id', $combined_order->user_id)->delete();
                    
                    $check_storage = DB::table('cloude_service')->where('user_id', $combined_order->user_id)->where('order_id', NULL)->first();

                    if(!empty($check_storage)){
                        DB::table('cloude_service')->where('user_id', $check_storage->id)->update(['payment_status' => 2, 'order_status' => 2, 'order_id' => $code]);
                    }

                    $data = [

                        'msg' => 'Payment made successfully. Your Transaction NO : ' . $chargeJson['balance_transaction'],

                        'Transaction_id' => $chargeJson['balance_transaction'],

                        'status' => 'success',

                    ];

                } else {

                    $data = [

                        'msg' => 'Transaction has been failed.',

                        'status' => 'error',

                    ];

                }

            } else {

                $data = [

                    'msg' => 'Invalid Token',

                    'status' => 'error',

                ];

            }

            // if($id != null){

            //     $ser = DB::table('cloude_service')->where('id', $id)->select('order_id')->first();

            //     $add = Order::where('code' , $ser->order_id)->select('shipping_address')->first();

            //     $renew = [
                
            //     'address' => $add->shipping_address,
                
            //     'renew_date' => strtotime('now'),
                
            //     'tax' => 0,
                
            //     'txn_id' => $data['Transaction_id'] ?? null,
                
            //     'payment_status' => 2,
                
            //     'order_status' => 2,
                
            //     'amount' => $subtotal
                
            //     ];
                
            
                
            //     DB::table('cloude_service')->where('id', $id)->update($renew);

            // }

            return response()->json($data);
        }
    }

    public function check2(Request $request , $amount = null , $id = null)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // dd($id);
        if($request->payment_method == 'stripe_ach'){

            $decorator = __NAMESPACE__ . '\\Payment\\AchController';

            if (class_exists($decorator)) {

                return (new $decorator)->pay2($request);

            }

         
        }else{

            if($amount != null){

                $subtotal = intval($amount) ;

            
            }else{

                $subtotal = intval(get_bundle_discount()['total_amount']);

            }
            
           
            $existingRecord = DB::table('stripe_details')->where('user_id', Auth::user()->id)->first();
            
            $customer = \Stripe\Customer::create([

                'description' => Auth::User()->name,
    
                'email' => Auth::User()->email,
    
                'source' => $request->stripeToken,
    
            ]);

            $customer_id = $customer->id;

            if ($existingRecord) {
            
                DB::table('stripe_details')->where('user_id', Auth::user()->id)->update(['customer_id' => $customer->id,]);
            
            } else {

                DB::table('stripe_details')->insert(['user_id' => Auth::user()->id,'customer_id' => $customer->id,]);
            }

            $array  =  [

                'amount' =>  $subtotal*100,

                'currency' => strtolower(\App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code),

                'customer' => $customer_id,

            ];
        
            $charge = \Stripe\Charge::create($array);
        
            $chargeJson = $charge->jsonSerialize();
        
            if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {

                $dataDB = [
                    'bk_id' => $request->input('bookid'),

                    'paid_amount' => $chargeJson['amount'] / 100,

                    'paid_amount_currency' => $chargeJson['currency'],

                    'txn_id' => $chargeJson['balance_transaction'],

                    'payment_status' => $chargeJson['status'],

                    'created' => now(),

                    'modified' => now(),

                ];
        
                if ($chargeJson['status'] == 'succeeded') {

                    // $carts = Cart::where('user_id', Auth::user()->id)

                    //     ->get();



                    // if ($carts->isEmpty()) {

                    //     flash(translate('Your cart is empty'))->warning();

                    //     return redirect()->route('home');

                    // }



                    $address = Address::where('user_id', Auth::user()->id)->first();



                    $shippingAddress = [];

                    if ($address != null) {

                        $shippingAddress['name']        = Auth::user()->name;

                        $shippingAddress['email']       = Auth::user()->email;

                        $shippingAddress['address']     = $address->address;

                        $shippingAddress['country']     = $address->country->name;

                        $shippingAddress['state']       = $address->state->name;

                        $shippingAddress['city']        = $address->city->name;

                        $shippingAddress['postal_code'] = $address->postal_code;

                        $shippingAddress['phone']       = $address->phone;

                        if ($address->latitude || $address->longitude) {

                            $shippingAddress['lat_lang'] = $address->latitude . ',' . $address->longitude;

                        }

                    }



                    $combined_order = new CombinedOrder;

                    $combined_order->user_id = Auth::user()->id;

                    $combined_order->shipping_address = json_encode($shippingAddress);

                    $combined_order->save();



                    $seller_products = array();

                    foreach ($carts as $cartItem) {

                        $product_ids = array();

                        $product = Product::find($cartItem['product_id']);

                        if (isset($seller_products[$product->user_id])) {

                            $product_ids = $seller_products[$product->user_id];

                        }

                        array_push($product_ids, $cartItem);

                        $seller_products[$product->user_id] = $product_ids;

                    }

                    $code = date('Ymd-His') . rand(10, 99);

                    foreach ($seller_products as $seller_product) {

                        $order = new Order;

                        $order->combined_order_id = $combined_order->id;

                        $order->user_id = Auth::user()->id;

                        $order->shipping_address = $combined_order->shipping_address;

                        $order->additional_info = $request->additional_info;

                        $order->payment_type = $request->payment_option;

                        $order->delivery_viewed = '0';

                        $order->payment_status = 'paid';

                        $order->payment_type = 'Stripe';

                        $order->payment_details = '{"status":"Success"}';

                        $order->payment_status_viewed = '0';

                        $order->code = $code;

                        $order->date = strtotime('now');

                        $order->save();



                        $subtotal = 0;

                        $tax = 0;

                        $shipping = 0;

                        $coupon_discount = 0;



                        //Order Details Storing

                        foreach ($seller_product as $cartItem) {

                            $product = Product::find($cartItem['product_id']);

                            $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                            $tax +=  cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];

                            $coupon_discount += $cartItem['discount'];



                            $product_variation = $cartItem['variation'];



                            $product_stock = $product->stocks->where('variant', $product_variation)->first();

                            if ($product->digital != 1 && $cartItem['quantity'] > $product_stock->qty) {

                                flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();

                                $order->delete();

                                // return redirect()->route('cart')->send();

                                return 'failed';

                            } elseif ($product->digital != 1) {

                                $product_stock->qty -= $cartItem['quantity'];

                                $product_stock->save();

                            }

                            


                            $order_detail = new OrderDetail;

                            $order_detail->order_id = $order->id;

                            $order_detail->seller_id = $product->user_id;

                            $order_detail->product_id = $product->id;

                            $order_detail->variation = $product_variation;

                            $order_detail->price = cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                            $order_detail->tax = cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];

                            $order_detail->shipping_type = $cartItem['shipping_type'];

                            $order_detail->product_referral_code = (Session::has('partner-code')) ? Session::get('partner-code') : $cartItem['product_referral_code'];

                            $order_detail->shipping_cost = $cartItem['shipping_cost'];



                            $shipping += $order_detail->shipping_cost;

                            //End of storing shipping cost



                            $order_detail->quantity = $cartItem['quantity'];



                            if (addon_is_activated('club_point')) {

                                $order_detail->earn_point = $product->earn_point;

                            }

                            

                            $order_detail->save();



                            $product->num_of_sale += $cartItem['quantity'];

                            $product->save();



                            $order->seller_id = $product->user_id;

                            $order->shipping_type = $cartItem['shipping_type'];

                            

                            if ($cartItem['shipping_type'] == 'pickup_point') {

                                $order->pickup_point_id = $cartItem['pickup_point'];

                            }

                            if ($cartItem['shipping_type'] == 'carrier') {

                                $order->carrier_id = $cartItem['carrier_id'];

                            }



                            if ($product->added_by == 'seller' && $product->user->seller != null) {

                                $seller = $product->user->seller;

                                $seller->num_of_sale += $cartItem['quantity'];

                                $seller->save();

                            }



                            if (addon_is_activated('affiliate_system')) {

                                if ($order_detail->product_referral_code) {

                                    $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();



                                    $affiliateController = new AffiliateController;

                                    $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);

                                }

                            }

                        }



                        // $order->grand_total = $subtotal + $tax + $shipping;
                        $order->grand_total = $request['amount'];

                        $product_price   = $subtotal + $tax + $shipping;

                        if ($seller_product[0]->coupon_code != null) {

                            $order->coupon_discount = $coupon_discount;

                            $order->grand_total -= $coupon_discount;



                            $coupon_usage = new CouponUsage;

                            $coupon_usage->user_id = Auth::user()->id;

                            $coupon_usage->coupon_id = Coupon::where('code', $seller_product[0]->coupon_code)->first()->id;

                            $coupon_usage->save();

                        }



                        $combined_order->grand_total += $order->grand_total;

                        if($order->save()){

                            DB::table('orders')->where('id' , $order->id)->update(['product_price' => $product_price ,'bundle_discount'=> $request['bundle_discount']]);
                            
                        }

                    }



                    $combined_order->save();



                    foreach($combined_order->orders as $order){

                        NotificationUtility::sendOrderPlacedNotification($order);

                    }



                    $request->session()->put('combined_order_id', $combined_order->id);

                    $emailData = [
                         'key1' => 'value1', // Replace with your actual data
                         'key2' => 'value2',
                         // Add more key-value pairs as needed
                     ];

                     Mail::send(['html' => 'frontend.paymentemail'], $emailData, function ($message) use ($request) {
                         $message->to('sandeepjangid@login2design.com')->subject('zoobla');
                         $message->from('info@login2design.com', 'Zoobla');
                     });

                     $request->session()->put('payment_type', 'cart_payment');

                     $combined_order = CombinedOrder::findOrFail($combined_order->id);

                    
                    Cart::where('user_id', $combined_order->user_id)->delete();
                    
                    $check_storage = DB::table('cloude_service')->where('user_id', $combined_order->user_id)->where('order_id', NULL)->first();

                    if(!empty($check_storage)){
                        DB::table('cloude_service')->where('user_id', $check_storage->id)->update(['payment_status' => 2, 'order_status' => 2, 'order_id' => $code]);
                    }

                    $data = [

                        'msg' => 'Payment made successfully. Your Transaction NO : ' . $chargeJson['balance_transaction'],

                        'Transaction_id' => $chargeJson['balance_transaction'],

                        'status' => 'success',

                    ];

                } else {

                    $data = [

                        'msg' => 'Transaction has been failed.',

                        'status' => 'error',

                    ];

                }

            } else {

                $data = [

                    'msg' => 'Invalid Token',

                    'status' => 'error',

                ];

            }

            // if($id != null){

            //     $ser = DB::table('cloude_service')->where('id', $id)->select('order_id')->first();

            //     $add = Order::where('code' , $ser->order_id)->select('shipping_address')->first();

            //     $renew = [
                
            //     'address' => $add->shipping_address,
                
            //     'renew_date' => strtotime('now'),
                
            //     'tax' => 0,
                
            //     'txn_id' => $data['Transaction_id'] ?? null,
                
            //     'payment_status' => 2,
                
            //     'order_status' => 2,
                
            //     'amount' => $subtotal
                
            //     ];
                
            
                
            //     DB::table('cloude_service')->where('id', $id)->update($renew);

            // }

            return response()->json($data);
        }
    }
    
    


    //redirects to this method after a successfull checkout

    public function checkout_done($combined_order_id, $payment)

    {

        $combined_order = CombinedOrder::findOrFail($combined_order_id);


        // dd($combined_order);
        foreach ($combined_order->orders as $key => $order) {

            $order = Order::findOrFail($order->id);

            $order->payment_status = 'paid';

            $order->payment_details = $payment;

            $order->save();

            calculateCommissionAffilationClubPoint($order);
            
        }
        
        
        Session::put('combined_order_id', $combined_order_id);

        // $this->order_confirmed();
        return redirect()->route('order_confirmed');

    }



    public function get_shipping_info(Request $request)

    {
        // dd($request->all());
        if(auth()->check()) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = $request->ip();
        }
        $carts = Cart::where('user_id', $user_id)->get();

         //   if (Session::has('cart') && count(Session::get('cart')) > 0) {

        if ($carts && count($carts) > 0) {

            $categories = Category::all();

            // return view('frontend.shipping_info', compact('categories', 'carts'));

            return redirect()->route('checkout.store_shipping_infostore');

        }

        flash(translate('Your cart is empty'))->success();

        return back();

    }



    public function store_shipping_info(Request $request)

    {

        if(auth()->check()) {
            $user_id = auth()->user()->id;
            $address_id = $request->address_id;
        } else {
            $user_id = $request->ip();
            $address_id = 1;
        }

        if ($address_id == null) {

            $address_id = 1;

            // flash(translate("Please add shipping address"))->warning();

            // return back();

        }



        $carts = Cart::where('user_id', $user_id)->get();

        if($carts->isEmpty()) {

            flash(translate('Your cart is empty'))->warning();

            return redirect()->route('home');

        }



        foreach ($carts as $key => $cartItem) {

            $cartItem->address_id = $address_id;

            $cartItem->save();

        }



        $carrier_list = array();

        if(get_setting('shipping_type') == 'carrier_wise_shipping'){

            $zone = \App\Models\Country::where('id',$carts[0]['address']['country_id'])->first()->zone_id;



            $carrier_query = Carrier::query();

            $carrier_query->whereIn('id',function ($query) use ($zone) {

                $query->select('carrier_id')->from('carrier_range_prices')

                ->where('zone_id', $zone);

            })->orWhere('free_shipping', 1);

            $carrier_list = $carrier_query->get();

        }

        

        // return view('frontend.delivery_info', compact('carts','carrier_list'));
        return redirect()->route('checkout.store_delivery_info');

    }



    public function store_delivery_info(Request $request)

    {

        // dd($request->all());

        if(auth()->check()) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = $request->ip();
        }

        $carts = Cart::where('user_id', $user_id)->get();
        



        if($carts->isEmpty()) {

            flash(translate('Your cart is empty'))->warning();

            return redirect()->route('home');

        }



        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();

        $total = 0;

        $tax = 0;

        $shipping = 0;

        $subtotal = 0;



        if ($carts && count($carts) > 0) {

            foreach ($carts as $key => $cartItem) {

                $product = Product::find($cartItem['product_id']);

                $tax += cart_product_tax($cartItem, $product,false) * $cartItem['quantity'];

                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                $cartItem['shipping_type'] = 'home_delivery';

                $cartItem['shipping_cost'] = getShippingCost($carts, $key);

                // if(get_setting('shipping_type') != 'carrier_wise_shipping' || $request['shipping_type_' . $product->user_id] == 'pickup_point'){

                //     if ($request['shipping_type_' . $product->user_id] == 'pickup_point') {

                //         $cartItem['shipping_type'] = 'pickup_point';

                //         $cartItem['pickup_point'] = $request['pickup_point_id_' . $product->user_id];

                //     } else {

                //         $cartItem['shipping_type'] = 'home_delivery';

                //     }

                //     $cartItem['shipping_cost'] = 0;

                //     if ($cartItem['shipping_type'] == 'home_delivery') {

                //         $cartItem['shipping_cost'] = getShippingCost($carts, $key);

                //     }

                // }

                // else{

                //     $cartItem['shipping_type'] = 'carrier';

                //     $cartItem['carrier_id'] = $request['carrier_id_' . $product->user_id];

                //     $cartItem['shipping_cost'] = getShippingCost($carts, $key, $cartItem['carrier_id']);

                // }



                $shipping += $cartItem['shipping_cost'];

                $cartItem->save();

            }

            $total = $subtotal + $tax + $shipping;

            // dd($total);
            Session::put('total',$total);
            Session::put('link',route('checkout.store_delivery_info'));
            // dd(session()->all());
            return view('frontend.payment_select', compact('carts', 'shipping_info', 'total'));
            // return redirect()->route('checkout.store_delivery_info');


        } else {

            flash(translate('Your Cart was empty'))->warning();

            return redirect()->route('home');

        }

    }



    public function apply_coupon_code(Request $request)

    {

        $coupon = Coupon::where('code', $request->code)->first();

        $response_message = array();



        if ($coupon != null) {

            if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {

                if (CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null) {

                    $coupon_details = json_decode($coupon->details);



                    $carts = Cart::where('user_id', Auth::user()->id)

                                    ->where('owner_id', $coupon->user_id)

                                    ->get();



                    $coupon_discount = 0;

                    

                    if ($coupon->type == 'cart_base') {

                        $subtotal = 0;

                        $tax = 0;

                        $shipping = 0;

                        foreach ($carts as $key => $cartItem) { 

                            $product = Product::find($cartItem['product_id']);

                            $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];

                            $tax += cart_product_tax($cartItem, $product,false) * $cartItem['quantity'];

                            $shipping += $cartItem['shipping_cost'];

                        }

                        $sum = $subtotal + $tax + $shipping;

                        if ($sum >= $coupon_details->min_buy) {

                            if ($coupon->discount_type == 'percent') {

                                $coupon_discount = ($sum * $coupon->discount) / 100;

                                if ($coupon_discount > $coupon_details->max_discount) {

                                    $coupon_discount = $coupon_details->max_discount;

                                }

                            } elseif ($coupon->discount_type == 'amount') {

                                $coupon_discount = $coupon->discount;

                            }



                        }

                    } elseif ($coupon->type == 'product_base') {

                        foreach ($carts as $key => $cartItem) { 

                            $product = Product::find($cartItem['product_id']);

                            foreach ($coupon_details as $key => $coupon_detail) {

                                if ($coupon_detail->product_id == $cartItem['product_id']) {

                                    if ($coupon->discount_type == 'percent') {

                                        $coupon_discount += (cart_product_price($cartItem, $product, false, false) * $coupon->discount / 100) * $cartItem['quantity'];

                                    } elseif ($coupon->discount_type == 'amount') {

                                        $coupon_discount += $coupon->discount * $cartItem['quantity'];

                                    }

                                }

                            }

                        }

                    }



                    if($coupon_discount > 0){

                        Cart::where('user_id', Auth::user()->id)

                            ->where('owner_id', $coupon->user_id)

                            ->update(

                                [

                                    'discount' => $coupon_discount / count($carts),

                                    'coupon_code' => $request->code,

                                    'coupon_applied' => 1

                                ]

                            );

                        $response_message['response'] = 'success';

                        $response_message['message'] = translate('Coupon has been applied');

                    }

                    else{

                        $response_message['response'] = 'warning';

                        $response_message['message'] = translate('This coupon is not applicable to your cart products!');

                    }

                    

                } else {

                    $response_message['response'] = 'warning';

                    $response_message['message'] = translate('You already used this coupon!');

                }

            } else {

                $response_message['response'] = 'warning';

                $response_message['message'] = translate('Coupon expired!');

            }

        } else {

            $response_message['response'] = 'danger';

            $response_message['message'] = translate('Invalid coupon!');

        }



        $carts = Cart::where('user_id', Auth::user()->id)

                ->get();

        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();



        $returnHTML = view('frontend.partials.cart_summary', compact('coupon', 'carts', 'shipping_info'))->render();

        return response()->json(array('response_message' => $response_message, 'html'=>$returnHTML));

    }



    public function remove_coupon_code(Request $request)

    {

        Cart::where('user_id', Auth::user()->id)

                ->update(

                        [

                            'discount' => 0.00,

                            'coupon_code' => '',

                            'coupon_applied' => 0

                        ]

        );



        $coupon = Coupon::where('code', $request->code)->first();

        $carts = Cart::where('user_id', Auth::user()->id)

                ->get();



        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();



        return view('frontend.partials.cart_summary', compact('coupon', 'carts', 'shipping_info'));

    }



    public function apply_club_point(Request $request) {

        if (addon_is_activated('club_point')){



            $point = $request->point;



            if(Auth::user()->point_balance >= $point) {

                $request->session()->put('club_point', $point);

                flash(translate('Point has been redeemed'))->success();

            }

            else {

                flash(translate('Invalid point!'))->warning();

            }

        }

        return back();

    }



    public function remove_club_point(Request $request) {

        $request->session()->forget('club_point');

        return back();

    }

    public function order_confirmed()

    {
   
        $combined_order = CombinedOrder::findOrFail(Session::get('combined_order_id'));

        
        Cart::where('user_id', $combined_order->user_id)->delete();

        return view('frontend.order_confirmed', compact('combined_order'));

    }

    public function auto_pay(Request $request)  {
        
        $customer_id = DB::table('stripe_details')->where('user_id', Auth::user()->id)->first()->customer_id;
        $userId = Auth::user()->id;

        $cloudedetails = DB::table('cloude_service')->where('cloude_service.user_id', $userId)
                        ->leftJoin('stripe_subscription', function ($join) use ($userId) {
                            $join->on('cloude_service.id', '=', 'stripe_subscription.cloud_service_id')
                                ->where('stripe_subscription.user_id', '=', $userId);
                         })
                        ->whereNull('stripe_subscription.cloud_service_id')
                        ->select('cloude_service.id' , 'cloude_service.user_id' , 'cloude_service.amount', 'cloude_service.storage_duration' )
                        ->get();
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $currentDate = date('Y-m-d');
        
        if ($cloudedetails->isNotEmpty()) {

            foreach ($cloudedetails as $cloud) {

                switch ($cloud->storage_duration) {
                    case 7:
                        $interval = 'week';
                        break;
                    case 30:
                        $interval = 'month';
                        break;
                    case 90:
                        $interval = strtotime(date('Y-m-d', strtotime('+90 days', strtotime($currentDate))));
                        break;
                    case 180:
                        $interval = strtotime(date('Y-m-d', strtotime('+180 days', strtotime($currentDate))));
                        break;
                    case 365:
                        $interval = 'yearly';
                        break;
                    default:
                        $interval = 'month';
                }

                dd($interval);
            
                $currencyCode = \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code;
            
                if(gettype($interval) == 'integer'){

                    $price = $stripe->prices->create([
                                'currency' => strtolower($currencyCode),
                                'unit_amount' => intval($cloud->amount),
                                'recurring' => ['interval' => 'month'],
                                'product_data' => ['name' => 'service,' . $cloud->id],
                             ]);

                    $sub =  $stripe->subscriptions->create([
                                'customer' => $customer_id,
                                'items' => [['price' => $price->id]],
                                'billing_cycle_anchor' => $interval,
                             ]);
                }else{

                    $price = $stripe->prices->create([
                                'currency' => strtolower($currencyCode),
                                'unit_amount' => intval($cloud->amount),
                                'recurring' => ['interval' => $interval],
                                'product_data' => ['name' => 'service,' . $cloud->id],
                            ]);

                    $sub =  $stripe->subscriptions->create([
                                'customer' => $customer_id,
                                'items' => [['price' =>  $price->id]],
                                'payment_settings' => [
                                    'payment_method_types' => ['card']
                                ]
                            ]);
                }
                
                $data =   DB::table('stripe_subscription')->insert([
                        'user_id'           => Auth::user()->id,
                        'cloud_service_id'  => $cloud->id,
                        'product_id'        => $price->product,
                        'product_price_id'  => $price->id,
                        'subscription_id'   => $sub->id,
                        'subscription_type' => $interval,
                        'start_date'        => $sub->current_period_start,
                        'end_date'          => $sub->current_period_end,
                        'status'            => ('active' == 'active') ? 1 : 0,
                    ]);
                    
            }

        }
            return response()->json(['status' => true ]);
    }

}


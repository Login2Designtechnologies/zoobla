<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;

use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\CustomerPackageController;

use App\Http\Controllers\SellerPackageController;

use App\Http\Controllers\WalletController;

use App\Models\Cart;

use App\Models\Address;

use Illuminate\Http\Request;

use App\Models\CombinedOrder;

use App\Models\CustomerPackage;

use App\Models\SellerPackage;

use App\Models\User;

use App\Models\OrderDetail;

use App\Models\Order;

use App\Models\Coupon;

use App\Models\CouponUsage;

use App\Models\Product;

use App\Utility\PayhereUtility;

use App\Utility\NotificationUtility;

use Session;

use Auth;

use Mail;

use DB;


class AchController extends Controller
{
    
    public function pay(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    
        $user = Auth::user();

        $existingRecord = DB::table('stripe_details')->where('user_id', $user->id)->first();
    
        if ($existingRecord) {
            $customer_id = $existingRecord->customer_id;
        } else {
            $customer = $stripe->customers->create([
                'description' => $user->name,
                'email' => $user->email,
            ]);
    
            $customer_id = $customer->id;
    
            DB::table('stripe_details')->insert([
                'user_id' => $user->id,
                'customer_id' => $customer_id,
            ]);
        }
    
        $currency = \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code;
        $amount = intval($request->amount * 100); // Convert to cents
    
        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'customer' => $customer_id,
            'payment_method_types' => ['us_bank_account'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'unit_amount' => $amount,
                        'product_data' => ['name' => 'Payment'],
                    ],
                    'quantity' => 1,
                ],
            ],
            'success_url' => url("/ach/success?session_id={CHECKOUT_SESSION_ID}&id=" . $request->id),

            'cancel_url' => route('ach.cancel'),
        ]);

        session()->put('service', $request->id);
        // Redirect the user to the Stripe Checkout URL
        return redirect($session->url);
    }
    
    public function success(Request $request) {

        $serviceid = Session::get('service') ?? $request->id;
       
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $session = $stripe->checkout->sessions->retrieve($request->session_id);

            $payment = ["status" => "Success"];

                $carts = Cart::where('user_id', Auth::user()->id)

                    ->get();



                if ($carts->isEmpty()) {

                    flash(translate('Your cart is empty'))->warning();

                    return redirect()->route('home');

                }



                $address = Address::where('id', $carts[0]['address_id'])->first();

 
                if ($address != null) {

                    $shippingAddress['name']        = Auth::user()->name;

                    $shippingAddress['email']       = Auth::user()->email;

                    $shippingAddress['address']     = $address->address;

                    $shippingAddress['country']     = $address->country_id;

                    $shippingAddress['state']       = $address->state_id;

                    $shippingAddress['city']        = $address->city_id;

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

                    $order->payment_type = 'ach';

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

                        DB::table('orders')->where('id' , $order->id)->update(['product_price' => $product_price ,'grand_total' => $product_price ,'bundle_discount'=> $request['bundle_discount']]);
                        
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

                $check_storage = DB::table('cloude_service')->where('user_id', $combined_order->user_id)->where('order_id', NULL)->first();

                if(!empty($check_storage)){
                    DB::table('cloude_service')->where('id', $check_storage->id)->update(['payment_status' => 2, 'order_status' => 2, 'order_id' => $code]);
                }

                 $request->session()->put('payment_type', 'cart_payment');

                 $combined_order = CombinedOrder::findOrFail($combined_order->id);

                
                Cart::where('user_id', $combined_order->user_id)->delete();

            //     $ser = DB::table('cloude_service')->where('id',$serviceid)->select('order_id' , 'amount')->first();
             
            //     $add = Order::where('code' , $combined_order->id)->select('shipping_address')->first();

            //     $renew = [
                
            //     'address' => $shippingAddress,
                
            //     'renew_date' => strtotime('now'),
                
            //     'tax' => 0,
                
            //     'txn_id' => $session ?? null,
                
            //     'payment_status' => 2,
                
            //     'order_status' => 2,
                                
            //     ];
                
        
            // DB::table('cloude_service')->where('id', $serviceid)->update($renew);

            
            return redirect('dashboard');

    }

    public function pay2(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    
        $user = Auth::user();

        $existingRecord = DB::table('stripe_details')->where('user_id', $user->id)->first();
    
        if ($existingRecord) {
            $customer_id = $existingRecord->customer_id;
        } else {
            $customer = $stripe->customers->create([
                'description' => $user->name,
                'email' => $user->email,
            ]);
    
            $customer_id = $customer->id;
    
            DB::table('stripe_details')->insert([
                'user_id' => $user->id,
                'customer_id' => $customer_id,
            ]);
        }
    
        $currency = \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code;
        $amount = intval($request->amount * 100); // Convert to cents
    
        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'customer' => $customer_id,
            'payment_method_types' => ['us_bank_account'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'unit_amount' => $amount,
                        'product_data' => ['name' => 'Payment'],
                    ],
                    'quantity' => 1,
                ],
            ],
            'success_url' => url("/ach/success?session_id={CHECKOUT_SESSION_ID}&id=" . $request->id),

            'cancel_url' => route('ach.cancel'),
        ]);

        session()->put('service', $request->id);
        // Redirect the user to the Stripe Checkout URL
        return redirect($session->url);
    }
    
    public function success2(Request $request) {

        $serviceid = Session::get('service') ?? $request->id;
       
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $session = $stripe->checkout->sessions->retrieve($request->session_id);

            $payment = ["status" => "Success"];

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

                    $order->payment_type = 'ach';

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

                        DB::table('orders')->where('id' , $order->id)->update(['product_price' => $product_price ,'grand_total' => $product_price ,'bundle_discount'=> $request['bundle_discount']]);
                        
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

                $check_storage = DB::table('cloude_service')->where('user_id', $combined_order->user_id)->where('order_id', NULL)->first();

                if(!empty($check_storage)){
                    DB::table('cloude_service')->where('id', $check_storage->id)->update(['payment_status' => 2, 'order_status' => 2, 'order_id' => $code]);
                }

                 $request->session()->put('payment_type', 'cart_payment');

                 $combined_order = CombinedOrder::findOrFail($combined_order->id);

                
                Cart::where('user_id', $combined_order->user_id)->delete();

            //     $ser = DB::table('cloude_service')->where('id',$serviceid)->select('order_id' , 'amount')->first();
             
            //     $add = Order::where('code' , $combined_order->id)->select('shipping_address')->first();

            //     $renew = [
                
            //     'address' => $shippingAddress,
                
            //     'renew_date' => strtotime('now'),
                
            //     'tax' => 0,
                
            //     'txn_id' => $session ?? null,
                
            //     'payment_status' => 2,
                
            //     'order_status' => 2,
                                
            //     ];
                
        
            // DB::table('cloude_service')->where('id', $serviceid)->update($renew);

            
            return redirect('dashboard');

    }

    public function cancel(Request $request){

        flash(translate('Payment is cancelled'))->error();

        $serviceid = Session::get('service');

        return redirect()->route('service-detail' , encrypt($serviceid));
    }

    // public function Store(Request $request) {

    //     $details = $request->all();
    
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    
    //     $customer = $stripe->customers->create([
            
    //         'name' => 'Jenny Rosen',

    //         'email' => 'jennyrosen@example.com',
            
    //     ]);
      
    //     $existingRecord = DB::table('stripe_details')->where('user_id', Auth::user()->id)->first();
    
    //     if ($existingRecord) {
        
    //         DB::table('stripe_details')->where('user_id', Auth::user()->id)->update(['customer_id' => $customer->id]);

    //     } else {
            
    //         DB::table('stripe_details')->insert(['user_id' => Auth::user()->id,'customer_id' => $customer->id,]);

    //     }
    
    //     $this->genratebanktoken($details);

    // }
    
    // public function genratebanktoken($req) {
        
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
    //     $bank = $stripe->tokens->create([
    //         'bank_account' => [
    //             'country'    => 'US',
    //             'currency'   => 'usd',
    //             'account_holder_name' => $req['account_holder_name'],
    //             'account_holder_type' => $req['account_holder_type'],
    //             'routing_number'      => $req['routing_number'],
    //             'account_number'      => $req['account_number'],
    //         ],
    //     ]);
        
    //     DB::table('stripe_details')->where('user_id', Auth::user()->id)->update(['bank_token' => $bank->id]);
     
    //     $this->AddbanktokentoCustomer();
    // }
    
    // public function AddbanktokentoCustomer() {

    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //     $detail = DB::table('stripe_details')->where('user_id', Auth::user()->id)->first();

    //     $source = $stripe->customers->createSource($detail->customer_id , ['source' => $detail->bank_token]);

    //     DB::table('stripe_details')->where('user_id', Auth::user()->id)->update(['source_token' => $source->id]);

    //     $this->verifybanck($detail->customer_id , $source->id);
    // }

    // public function verifybanck($c_id,$s_id){

    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //     $response = $stripe->customers->verifySource($c_id,$s_id,['amounts' => [32, 45]]);
    
    //     DB::table('stripe_details')->where('user_id', Auth::user()->id)->update(['verification_status' => $response->status]);

    //     $de =  DB::table('stripe_details')->get();
        
    //     return view('frontend.user.profile');
    // }

    // public function pay() {
        
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //     $detail  = DB::table('stripe_details')->where('user_id', Auth::user()->id)->first();
        
    //     $res = $stripe->charges->create([

    //         'amount' => 1099,

    //         'currency' => 'usd',

    //         'customer' =>  $detail->customer_id,
            
    //     ]);

    //     dd($res);
    // }
}

<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Category;

use App\Models\Cart;

use Auth;

use App\Utility\CartUtility;

use Session;

use Cookie;

use DB;

use Illuminate\Support\Facades\Redirect;



class CartController extends Controller

{

    public function index(Request $request)

    {

        if (auth()->user() != null) {

            $user_id = Auth::user()->id;

            $cloud = null;

            if ($request->session()->get('temp_user_id')) {

                Cart::where('temp_user_id', $request->session()->get('temp_user_id'))

                    ->update(

                        [

                            'user_id' => $user_id,

                            'temp_user_id' => null

                        ]

                    );



                Session::forget('temp_user_id');

            }

            $carts = Cart::where('user_id', $user_id)->get();

        } else {

            $temp_user_id = $request->session()->get('temp_user_id');

            // $carts = Cart::where('temp_user_id', $temp_user_id)->get();

            $carts = ($temp_user_id != null) ? Cart::where('temp_user_id', $temp_user_id)->get() : [];

        }

        Session::put('carts' ,  $carts);

        if (Session::has('cloud_service_id')) {
    
            $id = Session::get('cloud_service_id');
            
            $cloud = DB::table('cloude_service')->where('id' , $id)->first();

            $productsInCart = array_map(function ($cart) {

                return $cart['product_id'];

            }, $carts->toArray());
            
              $cloudProductId = $cloud->product_id;
            
            if (in_array($cloudProductId, $productsInCart)) {
                
                return view('frontend.view_cart', compact('carts' ,'cloud'));
               
            } else {

                Session::forget('cloud_service_product_id');

                DB::table('cloude_service')->where('id' , Session::get('cloud_service_id'))->delete();
            
                Session::forget('cloud_service_id');
    
            }

        }
        
        return view('frontend.view_cart', compact('carts'));

    }



    public function showCartModal(Request $request)

    {

        $product = Product::find($request->id);

        return view('frontend.partials.addToCart', compact('product'));

    }



    public function showCartModalAuction(Request $request)

    {

        $product = Product::find($request->id);

        return view('auction.frontend.addToCartAuction', compact('product'));

    }



    

    public function addToCart(Request $request)
{
   
    if(auth()->check()) {
        $user_id = auth()->user()->id;
    } else {
        $user_id = $request->ip();
    }
    
    $carts = Cart::where('user_id', $user_id)->get();

    $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);

    $product = Product::find($request->id);

    $carts = array();

    if($check_auction_in_cart && $product->auction_product == 0) {
        return array(
            'status' => 0,
            'cart_count' => count($carts),
            'modal_view' => view('frontend.partials.removeAuctionProductFromCart')->render(),
            'nav_cart_view' => view('frontend.partials.cart')->render(),
            'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
        );
    }

    $quantity = $request['quantity'];
    $addon_product_id = $request['addon_product_id'] ?? null;

    if ($quantity < $product->min_qty) {
        return array(
            'status' => 0,
            'cart_count' => count($carts),
            'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
            'nav_cart_view' => view('frontend.partials.cart')->render(),
            'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
        );
    }

    $str = CartUtility::create_cart_variant($product, $request->all());
    $product_stock = $product->stocks->where('variant', $str)->first();

    $cart = Cart::firstOrNew([
        'variation' => $str,
        'user_id' => $user_id, 
        'product_id' => $request['id']
    ]);

    if ($cart->exists && $product->digital == 0) {
        if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
            return array(
                'status' => 0,
                'cart_count' => count($carts),
                'modal_view' => view('frontend.partials.auctionProductAlredayAddedCart')->render(),
                'nav_cart_view' => view('frontend.partials.cart')->render(),
                'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
            );
        }
        if ($product_stock->qty < $cart->quantity + $request['quantity']) {
            return array(
                'status' => 0,
                'cart_count' => count($carts),
                'modal_view' => view('frontend.partials.outOfStockCart')->render(),
                'nav_cart_view' => view('frontend.partials.cart')->render(),
                'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
            );
        }
        $quantity = $cart->quantity + $request['quantity'];
    }

    $price = CartUtility::get_price($product, $product_stock, $request->quantity);
    $tax = CartUtility::tax_calculation($product, $price);

    CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity , $addon_product_id);

    $carts = Cart::where('user_id', $user_id)->get();

    return array(
        'status' => 1,
        'cart_count' => count($carts),
        'modal_view' => view('frontend.partials.addedToCart', compact('product', 'cart'))->render(),
        'nav_cart_view' => view('frontend.partials.cart')->render(),
        'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
    );
}







    // public function addToCart(Request $request)

    // {

    //     // dd($request->all());

    //     $carts = Cart::where('user_id', auth()->user()->id)->get();

    //     $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);

    //     $product = Product::find($request->id);

    //     $carts = array();

        

    //     if($check_auction_in_cart && $product->auction_product == 0) {

    //         return array(

    //             'status' => 0,

    //             'cart_count' => count($carts),

    //             'modal_view' => view('frontend.partials.removeAuctionProductFromCart')->render(),

    //             'nav_cart_view' => view('frontend.partials.cart')->render(),

    //             'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
    //         );

    //     }

        

    //     $quantity = $request['quantity'];

    //     $addon_product_id = $request['addon_product_id'] ?? null;

    //     if ($quantity < $product->min_qty) {

    //         return array(

    //             'status' => 0,

    //             'cart_count' => count($carts),

    //             'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),

    //             'nav_cart_view' => view('frontend.partials.cart')->render(),

    //             'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
    //         );

    //     }



    //     //check the color enabled or disabled for the product

    //     $str = CartUtility::create_cart_variant($product, $request->all());

    //     $product_stock = $product->stocks->where('variant', $str)->first();



    //     $cart = Cart::firstOrNew([

    //         'variation' => $str,

    //         'user_id' => auth()->user()->id,

    //         'product_id' => $request['id']

    //     ]);



    //     if ($cart->exists && $product->digital == 0) {

    //         if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {

    //             return array(

    //                 'status' => 0,

    //                 'cart_count' => count($carts),

    //                 'modal_view' => view('frontend.partials.auctionProductAlredayAddedCart')->render(),

    //                 'nav_cart_view' => view('frontend.partials.cart')->render(),

    //                 'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
    //             );

    //         }

    //         if ($product_stock->qty < $cart->quantity + $request['quantity']) {

    //             return array(

    //                 'status' => 0,

    //                 'cart_count' => count($carts),

    //                 'modal_view' => view('frontend.partials.outOfStockCart')->render(),

    //                 'nav_cart_view' => view('frontend.partials.cart')->render(),

    //                 'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
    //             );

    //         }

    //         $quantity = $cart->quantity + $request['quantity'];

    //     }



    //     $price = CartUtility::get_price($product, $product_stock, $request->quantity);

    //     $tax = CartUtility::tax_calculation($product, $price);

        

    //     CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity , $addon_product_id);

        

    //     $carts = Cart::where('user_id', auth()->user()->id)->get();
        

    //     return array(

    //         'status' => 1,

    //         'cart_count' => count($carts),

    //         'modal_view' => view('frontend.partials.addedToCart', compact('product', 'cart'))->render(),

    //         'nav_cart_view' => view('frontend.partials.cart')->render(),

    //         'new_cart_view' => view('frontend.partials.new_cart_details')->render(),

    //     );

    // }



    //removes from Cart

    public function removeFromCart(Request $request)

    {

        Cart::destroy($request->id);

        if (auth()->user() != null) {

            $user_id = Auth::user()->id;

            $carts = Cart::where('user_id', $user_id)->get();

        } else {

            $temp_user_id = $request->session()->get('temp_user_id');

            $carts = Cart::where('temp_user_id', $temp_user_id)->get();

        }



        return array(

            'cart_count' => count($carts),

            // 'cart_view' => view('frontend.partials.cart_details', compact('carts'))->render(),
            'cart_view' => view('frontend.partials.new_cart_details')->render(),

            'nav_cart_view' => view('frontend.partials.cart')->render(),

        );

    }

    public function removeFromCartaddon(Request $request)

    {

        
        if (auth()->user() != null) {

            Cart::where('user_id', Auth::user()->id)->where('product_id' , $request->id)->delete();

            $user_id = Auth::user()->id;

            $carts = Cart::where('user_id', $user_id)->get();

        } else {

            $temp_user_id = $request->session()->get('temp_user_id');

            $carts = Cart::where('temp_user_id', $temp_user_id)->get();

        }



        return array(

            'cart_count' => count($carts),

            // 'cart_view' => view('frontend.partials.cart_details', compact('carts'))->render(),
            'cart_view' => view('frontend.partials.new_cart_details')->render(),

            'nav_cart_view' => view('frontend.partials.cart')->render(),

        );

    }

    //updated the quantity for a cart item

    public function updateQuantity(Request $request)

    {
        // dd($request);
        $cartItem = Cart::findOrFail($request->id);

        if ($cartItem['id'] == $request->id) {

            $product = Product::find($cartItem['product_id']);

            $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();

            $quantity = $product_stock->qty;

            $price = $product_stock->price;

            //discount calculation

            $discount_applicable = false;



            if ($product->discount_start_date == null) {

                $discount_applicable = true;

            } elseif (

                strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&

                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date

            ) {

                $discount_applicable = true;

            }

            if ($discount_applicable) {

                if ($product->discount_type == 'percent') {

                    $price -= ($price * $product->discount) / 100;

                } elseif ($product->discount_type == 'amount') {

                    $price -= $product->discount;

                }

            }

            if ($quantity >= $request->quantity) {

                if ($request->quantity >= $product->min_qty) {

                    $cartItem['quantity'] = $request->quantity;

                }

            }

            if ($product->wholesale_product) {

                $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $request->quantity)->where('max_qty', '>=', $request->quantity)->first();

                if ($wholesalePrice) {

                    $price = $wholesalePrice->price;

                }

            }

            $cartItem['price'] = $price;

            $cartItem->save();

        }

        if (auth()->user() != null) {

            $user_id = Auth::user()->id;

            $carts = Cart::where('user_id', $user_id)->get();
            

        } else {

            $temp_user_id = $request->session()->get('temp_user_id');

            $carts = Cart::where('temp_user_id', $temp_user_id)->get();

        }

        $cartss = DB::table('carts')->where('user_id', $user_id)->get(); 

        $total = 0;

        foreach ($carts as $data) {

            $total += (($data->price + $data->tax) * $data->quantity);
        }

        $product_quantity = DB::table('carts')->where('id', $request->id)->first(); 

        $current_product_price = ($product_quantity->quantity * $product_quantity->price);

        // dd($product_quantity->quantity,$current_product_price);

        return array(

            'cart_count' => count($carts),

            // 'cart_view' => view('frontend.partials.cart_details', compact('carts'))->render(),
            'cart_view' => view('frontend.partials.new_cart_details')->render(),

            'nav_cart_view' => view('frontend.partials.cart')->render(),

            'new_price' => $cartItem['price'],

            'current_price' => $current_product_price,

            'sub_total' => $total,
            
        );

    }


    // Cloud Service

    public function check_cloud_service(Request $request)
    {
        if(auth()->check()) {
            $user_id = auth()->user()->id;

            $getAddress = DB::table('addresses')->where('user_id', $user_id)->orderBy('id', 'desc')->first();
            if(!empty($getAddress)){
                $addressId = $getAddress->id;
            }else {
                $addressId = 0;
            }
        } else {
            $user_id = $request->ip();
            $addressId = 0;
        }

        if(!empty($addressId)){

            foreach($request->qty as $key => $value){

                    $newArray[] = [
                        
                        'qty'        => $request->qty[$key],
                        'cam_name'   => $request->cam_name[$key],
                        'cam_price'  => $request->cam_price[$key],
                    ];

            }

            $check_storage2 = DB::table('cloude_service')->where('user_id', $user_id)->where('camera_detail', json_encode($newArray))->where('storage_duration', $request->cloud_storage)->where('amount', $request->total_price)->where('addressId', $addressId)->first();

            if(!empty($check_storage2)){
                return 'failed';
            } else {
                return 'success';
            }
        } else {
            return 'success';
        }



    }

    public function store_cloud_service(Request $request) {

        $insert = '';
        if(auth()->check()) {
            $user_id = auth()->user()->id;

            $getAddress = DB::table('addresses')->where('user_id', $user_id)->orderBy('id', 'desc')->first();
            if(!empty($getAddress)){
                $addressId = $getAddress->id;
            }else {
                $addressId = 0;
            }
        } else {
            $user_id = $request->ip();
            $addressId = 0;
        }

        $check_storage = DB::table('cloude_service')->where('user_id', $user_id)->where('order_id', NULL)->first();

        // dd($check_storage);
        if(empty($check_storage)){

            foreach($request->qty as $key => $value){

                    $newArray[] = [
                        
                        'qty'        => $request->qty[$key],
                        'cam_name'   => $request->cam_name[$key],
                        'cam_price'  => $request->cam_price[$key],
                    ];

            }

            $value = [

                'user_id' =>$user_id,

                'camera_detail' => json_encode($newArray),

                'storage_duration' =>   $request->cloud_storage,

                'product_id' => $request->product_id,

                'amount' => $request->total_price

            ];

            if(!empty($addressId)){

                $check_storage2 = DB::table('cloude_service')->where('user_id', $user_id)->where('camera_detail', json_encode($newArray))->where('storage_duration', $request->cloud_storage)->where('amount', $request->total_price)->where('addressId', $addressId)->first();

                if(!empty($check_storage2)){

                }
            }


            $insert = DB::table('cloude_service')->insertGetId($value);
        }
           if($insert){
                
                if(auth()->check()) {
                    $user_id = auth()->user()->id;
                } else {
                    $user_id = $request->ip();
                }
                
                $carts = Cart::where('user_id', $user_id)->get();

                $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);

                $product = Product::find($request->product_id);

                $carts = array();

                if($insert){
                    $quantity = 1;
                    $addon_product_id = $request['addon_product_id'] ?? null;

                    $str = CartUtility::create_cart_variant($product, $request->all());
                    $product_stock = $product->stocks->where('variant', $str)->first();

                    $cart = Cart::firstOrNew([
                        'variation' => $str,
                        'user_id' => $user_id, 
                        'product_id' => $request->product_id,
                        'cloud_storage_id' => $insert,
                    ]);


                    $price = CartUtility::get_price($product, $product_stock, 1);
                    $tax = CartUtility::tax_calculation($product, $price);

                    // CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity , $addon_product_id);
                    CartUtility::save_cart_data($cart, $product, $price, $tax, 1 , $addon_product_id);

                    $carts = Cart::where('user_id', $user_id)->get();

                    Session::put('cloud_service_id', $insert);

                    Session::put('cloud_service_product_id',  $request->product_id);

                     return back()->with('id' , $insert);

                } else {
                    if($check_auction_in_cart && $product->auction_product == 0) {
                        return array(
                            'status' => 0,
                            'cart_count' => count($carts),
                            'modal_view' => view('frontend.partials.removeAuctionProductFromCart')->render(),
                            'nav_cart_view' => view('frontend.partials.cart')->render(),
                            'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
                        );
                    }

                    $quantity = $request['quantity'];
                    $addon_product_id = $request['addon_product_id'] ?? null;

                    if ($quantity < $product->min_qty) {
                        return array(
                            'status' => 0,
                            'cart_count' => count($carts),
                            'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
                            'nav_cart_view' => view('frontend.partials.cart')->render(),
                            'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
                        );
                    }

                    $str = CartUtility::create_cart_variant($product, $request->all());
                    $product_stock = $product->stocks->where('variant', $str)->first();

                    $cart = Cart::firstOrNew([
                        'variation' => $str,
                        'user_id' => $user_id, 
                        'product_id' => $request['id']
                    ]);

                    if ($cart->exists && $product->digital == 0) {
                        if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
                            return array(
                                'status' => 0,
                                'cart_count' => count($carts),
                                'modal_view' => view('frontend.partials.auctionProductAlredayAddedCart')->render(),
                                'nav_cart_view' => view('frontend.partials.cart')->render(),
                                'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
                            );
                        }
                        if ($product_stock->qty < $cart->quantity + $request['quantity']) {
                            return array(
                                'status' => 0,
                                'cart_count' => count($carts),
                                'modal_view' => view('frontend.partials.outOfStockCart')->render(),
                                'nav_cart_view' => view('frontend.partials.cart')->render(),
                                'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
                            );
                        }
                        $quantity = $cart->quantity + $request['quantity'];
                    }

                    $price = CartUtility::get_price($product, $product_stock, $request->quantity);
                    $tax = CartUtility::tax_calculation($product, $price);

                    CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity , $addon_product_id);

                    $carts = Cart::where('user_id', $user_id)->get();

                    return array(
                        'status' => 1,
                        'cart_count' => count($carts),
                        'modal_view' => view('frontend.partials.addedToCart', compact('product', 'cart'))->render(),
                        'nav_cart_view' => view('frontend.partials.cart')->render(),
                        'new_cart_view' => view('frontend.partials.new_cart_details')->render(),
                    );
                }

                

           } else {
                flash(translate('You have already a product in your cart. You can purchage single at a time.'))->warning();

                return redirect()->route('home');
           }
    }
}


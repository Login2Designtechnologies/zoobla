<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\CommissionHistory;

use App\Models\Wallet;

use App\Models\User;

use App\Models\Order;

use App\Models\Address;

use App\Models\OrderDetail;

use App\Models\Search;

use App\Models\Shop;

use Auth;

use DB;


class ReportController extends Controller

{

    public function __construct() {

        // Staff Permission Check

        $this->middleware(['permission:in_house_product_sale_report'])->only('in_house_sale_report');

        $this->middleware(['permission:seller_products_sale_report'])->only('seller_sale_report');

        $this->middleware(['permission:products_stock_report'])->only('stock_report');

        $this->middleware(['permission:product_wishlist_report'])->only('wish_report');

        $this->middleware(['permission:user_search_report'])->only('user_search_report');

        $this->middleware(['permission:commission_history_report'])->only('commission_history');

        $this->middleware(['permission:wallet_transaction_report'])->only('wallet_transaction_history');

    }



    public function stock_report(Request $request)

    {

        $sort_by =null;

        $products = Product::orderBy('created_at', 'desc');

        if ($request->has('category_id')){

            $sort_by = $request->category_id;

            $products = $products->where('category_id', $sort_by);

        }

        $products = $products->paginate(15);

        return view('backend.reports.stock_report', compact('products','sort_by'));

    }



    public function in_house_sale_report(Request $request)

    {

        $sort_by =null;

        $products = Product::orderBy('num_of_sale', 'desc')->where('added_by', 'admin');

        if ($request->has('category_id')){

            $sort_by = $request->category_id;

            $products = $products->where('category_id', $sort_by);

        }

        $products = $products->paginate(15);

        return view('backend.reports.in_house_sale_report', compact('products','sort_by'));

    }



    public function seller_sale_report(Request $request)

    {

        $sort_by =null;

        // $sellers = User::where('user_type', 'seller')->orderBy('created_at', 'desc');

        $sellers = Shop::with('user')->orderBy('created_at', 'desc');

        if ($request->has('verification_status')){

            $sort_by = $request->verification_status;

            $sellers = $sellers->where('verification_status', $sort_by);

        }

        $sellers = $sellers->paginate(10);

        return view('backend.reports.seller_sale_report', compact('sellers','sort_by'));

    }



    public function wish_report(Request $request)

    {

        $sort_by =null;

        $products = Product::orderBy('created_at', 'desc');

        if ($request->has('category_id')){

            $sort_by = $request->category_id;

            $products = $products->where('category_id', $sort_by);

        }

        $products = $products->paginate(10);

        return view('backend.reports.wish_report', compact('products','sort_by'));

    }



    public function user_search_report(Request $request){

        $searches = Search::orderBy('count', 'desc')->paginate(10);

        return view('backend.reports.user_search_report', compact('searches'));

    }

    

    public function commission_history(Request $request) {

        $seller_id = null;

        $date_range = null;

        

        if(Auth::user()->user_type == 'seller') {

            $seller_id = Auth::user()->id;

        } if($request->seller_id) {

            $seller_id = $request->seller_id;

        }

        

        $commission_history = CommissionHistory::orderBy('created_at', 'desc');

        

        if ($request->date_range) {

            $date_range = $request->date_range;

            $date_range1 = explode(" / ", $request->date_range);

            $commission_history = $commission_history->where('created_at', '>=', $date_range1[0]);

            $commission_history = $commission_history->where('created_at', '<=', $date_range1[1]);

        }

        if ($seller_id){

            

            $commission_history = $commission_history->where('seller_id', '=', $seller_id);

        }

        

        $commission_history = $commission_history->paginate(10);

        if(Auth::user()->user_type == 'seller') {

            return view('seller.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));

        }

        return view('backend.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));

    }

    

    public function wallet_transaction_history(Request $request) {

        $user_id = null;

        $date_range = null;

        

        if($request->user_id) {

            $user_id = $request->user_id;

        }

        

        $users_with_wallet = User::whereIn('id', function($query) {

            $query->select('user_id')->from(with(new Wallet)->getTable());

        })->get();



        $wallet_history = Wallet::orderBy('created_at', 'desc');

        

        if ($request->date_range) {

            $date_range = $request->date_range;

            $date_range1 = explode(" / ", $request->date_range);

            $wallet_history = $wallet_history->where('created_at', '>=', $date_range1[0]);

            $wallet_history = $wallet_history->where('created_at', '<=', $date_range1[1]);

        }

        if ($user_id){

            $wallet_history = $wallet_history->where('user_id', '=', $user_id);

        }

        

        $wallets = $wallet_history->paginate(10);



        return view('backend.reports.wallet_history_report', compact('wallets', 'users_with_wallet', 'user_id', 'date_range'));

    }

    public function user_registration_history(Request $request)  {

        $sort_search = null;

        $date    = $request->date;

        $country = $request->country_id;

        $state   = $request->state_id;

        $city    = $request->city_id;

        $users = User::join('addresses' , 'addresses.user_id' , 'users.id')->where('user_type', 'customer')->where('email_verified_at', '!=', null)->orderBy('created_at', 'desc');

        if($country != null){

            $users = $users->where('addresses.country_id' , $country);

        }

        if($state != null){

            $users = $users->where('addresses.state_id' , $state);

        }

        if($city != null){

            $users = $users->where('addresses.city_id' , $city);
            
        }

        if ($request->has('search')){

            $sort_search = $request->search;

            $users->where(function ($q) use ($sort_search){

                $q->where('users.name', 'like', '%'.$sort_search.'%')->orWhere('users.email', 'like', '%'.$sort_search.'%');

            });

        }

        if($date != null){

            $users = $users->where('users.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])) . '  00:00:00')

            ->where('users.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])) . '  23:59:59');

        }

        $users = $users->select('users.*')->paginate(15);


        return view('backend.reports.user_history_report' , compact('users', 'sort_search' ,'date' ,'country' ,'state' ,'city'));

    }   

    public function partner_history(Request $request) {

        $sort_search = null;

        $country = $request->country_id;

        $state   = $request->state_id;

        $city    = $request->city_id;

        $shops = Shop::whereIn('user_id', function ($query) {

            $query->select('id')

                ->from(with(new User)->getTable());

        })->latest();

        if ($request->has('search')) {

            $sort_search = $request->search;

            $user_ids = User::where('user_type', 'seller')->where(function ($user) use ($sort_search) {

                $user->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');

            })->pluck('id')->toArray();

            $shops = $shops->where(function ($shops) use ($user_ids) {

                $shops->whereIn('user_id', $user_ids);

            });

        }

        if ($request->approved_status != null) {

            $approved = $request->approved_status;

            $shops = $shops->where('verification_status', $approved);

        }

        if($request->country_id != null){

            $shops = $shops->whereHas('user', function ($query) use ($country) {

                $query->where('country',  $country);

            });

        }

        if($request->state_id != null){

            $shops = $shops->whereHas('user', function ($query) use ($state) {

                $query->where('state',  $state);

            });
        }

        if ($request->city_id != null) {
            
            $shops = $shops->whereHas('user', function ($query) use ($city) {

                $query->where('city',  $city);

            });
        }

        $shops = $shops->paginate(15);

        return view('backend.reports.partner_history_report' , compact('shops'));

    }

    public function sales_report(Request $request) {

        $date    = $request->date;

        $partner = $request->partner;

        $country_id = $request->country_id;

        $user    = $request->user_id;

        $orders = Order::orderBy('id', 'desc');

        if($partner != null){

            $orders = $orders->whereHas('orderDetails', function ($query) use($partner) {

                $query->where('product_referral_code', base64_encode($partner));

            });

        }

        if($country_id != null){

            $orders = $orders->where('shipping_address', 'like', '%' .str_replace('_' , ' ' ,$country_id)  . '%');

        }

        if($user != null){

            $orders = $orders->where('user_id', $user);

        }

        if ($date != null) {

            $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])) . '  00:00:00')

                ->where('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])) . '  23:59:59');

        }

        $orders = $orders->paginate(15);
       
        $sellers = Shop::with('user')->where('verification_status', 1)->whereHas('user', function ($query) {    $query->whereNotNull('partner_code');})->orderBy('created_at', 'desc')->get();

        $users    = User::where('user_type', 'customer')->orderBy('created_at', 'desc')->get();
       
        return view('backend.reports.sales_report' , compact('orders' ,'sellers' ,'partner' ,'users' ,'date' ,'country_id' ,'user'));
        
    }


    public function service_sales_report(Request $request){

        $date    = $request->date;

        $partner = $request->partner;

        $user    = $request->user_id;


        $sort_search = null;

        $delivery_status = null;

        $payment_status = '';

        $seller_type = null;

     
     // $orders = DB::table('cloude_service')->orderBy('cloude_service.id', 'desc')

     $orders = DB::table('cloude_service')
        ->join('orders', 'cloude_service.order_id', '=', 'orders.code')
        ->join('order_details' ,'order_details.order_id' , '=' , 'orders.id');

        if($partner != null){

          $orders = $orders->where('order_details.product_referral_code', base64_encode($partner));

        }

        if($user != null){

            $orders = $orders->where('cloude_service.user_id', $user);

        }

        if ($date != null) {

            $orders = $orders->where('cloude_service.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])) . '  00:00:00')

                ->where('cloude_service.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])) . '  23:59:59');

        }



        $orders = $orders->select('cloude_service.*')->paginate(15);

        

        // $orders = $orders->select('cloude_service.*')->paginate(15);

        $sellers = Shop::with('user')->where('verification_status', 1)->whereHas('user', function ($query) {    $query->whereNotNull('partner_code');})->orderBy('created_at', 'desc')->get();

        $users    = User::where('user_type', 'customer')->orderBy('created_at', 'desc')->get();

        return view('backend.reports.service_sales_report', compact('orders','partner','user','date', 'sort_search', 'payment_status', 'delivery_status', 'date' ,'seller_type' ,'sellers' ,'users'));
    }


    public function sales_comparison_report(Request $request){
        
       return view('backend.reports.Sales-comparison-report');
       
    }
}


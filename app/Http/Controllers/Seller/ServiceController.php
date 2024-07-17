<?php



namespace App\Http\Controllers\Seller;



use App\Models\Order;

use App\Models\ProductStock;

use App\Models\SmsTemplate;

use App\Models\User;

use App\Utility\NotificationUtility;

use App\Utility\SmsUtility;

use Illuminate\Http\Request;

use Auth;

use App\Models\CommissionHistory;

use DB;



class ServiceController extends Controller

{

    /**

     * Display a listing of the resource to seller.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {   

        $payment_status = null;

        $orders = DB::table('cloude_service')

                 ->join('orders' , 'cloude_service.order_id' , 'orders.code')

                 ->join('order_details' ,'orders.id' , 'order_details.order_id')

                 ->where('order_details.product_referral_code' , base64_encode(Auth::user()->partner_code))

                 ->select('cloude_service.*')

                 ->paginate(15);

         
        
        return view('seller.service.index', compact('orders'));
    }


   public function service_show($id =null){


        $order = DB::table('cloude_service')->where('id' , decrypt($id))->first();

        $info = Order::where('code' , $order->order_id)->first();
        
        return view('seller.service.show', compact('order', 'info'));

   } 

   public function commission_history(Request $request) {

        $orders = Order::orderBy('id', 'desc');

        $orders = $orders->whereHas('orderDetails', function ($query) {

            $query->where('product_referral_code', '=', base64_encode (Auth::user()->partner_code));
            
        })->select('orders.id')->distinct();

        $orders = $orders->paginate(15);

        return view('seller.commission_history.index', compact('orders'));

   }

}


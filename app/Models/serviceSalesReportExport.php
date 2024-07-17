<?php



namespace App\Models;



use App\Models\Product;

use App\Models\Order;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;



class serviceSalesReportExport implements FromCollection, WithMapping, WithHeadings

{

    public function collection()

    {

        return  DB::table('cloude_service')->orderBy('cloude_service.id', 'desc')->select('cloude_service.*')->get();

    }



    public function headings(): array

    {

        return [

            'Order Code',

            'Num. of Products',

            'Customer',

            'Seller',

            'Amount',

            'Status',

            'Payment method',

            'Payment Status',

        ];

    }



    /**

    * @var Product $product

    */

    public function map($order): array

    {
        
        $detail = json_decode($order->camera_detail); 
        $count = 0;
        
        foreach ($detail as $key => $value) {
            if ($value->qty > 0) {
                $count++;
            }
        }

        $name = null;

        $userdata = DB::table('users')->where('id',$order->user_id)->first();

        $related = Order::where('code' , $order->order_id)->first();

         if(isset($related->orderDetails[0]['product_referral_code']) && $related->orderDetails[0]['product_referral_code'] != null){

                                     $name = DB::table('users')->where('partner_code', base64_decode($related->orderDetails[0]['product_referral_code']))->select('name','id')->first();

                                 }


       if ($order->status == '2'){
            $statusdata = 'Active';
        }else{
            $statusdata = 'Inactive';
        }


        if ($related->payment_status == 'paid'){
            $paymentstatusdata = 'Paid';
        }else{ 
            $paymentstatusdata = 'Unpaid';
        }


        if($name != null){

           $nameshop = $name->name;

        }else{

            if(isset($related->user)){

                if ($related->shop){

                    $nameshop =  $related->shop->name;

                }else{

                    $nameshop = 'Inhouse Order';

                }

            }else{
                   $nameshop = 'Inhouse Order';
            }

        }

        return [

            $order->order_id,

            $count,

            $userdata->name,
            
            $nameshop,

            $order->amount,

            $statusdata,

            $related->payment_type,

            $paymentstatusdata,

        ];

//         return [

//             $order->order_id,

//             $count,

//             $Product->added_by,

//             $product->user_id,

//             $product->amount,

//             $product->brand_id,

//             $product->video_provider,

//             $product->video_link,

//             $product->unit_price,

//             $product->purchase_price,

//             $product->unit,

// //            $product->current_stock,

//             $qty,

//             $product->est_shipping_days,

//             $product->meta_title,

//             $product->meta_description,

//         ];

    }

}


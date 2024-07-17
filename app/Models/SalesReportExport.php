<?php



namespace App\Models;



use App\Models\Product;

use App\Models\Order;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;


class SalesReportExport implements FromCollection, WithMapping, WithHeadings

{

    public function collection()

    {
    
        return Order::OrderBy('id', 'desc')->get();

    }



    public function headings(): array

    {


        return [

            'Order Code',

            'Num of Products',

            'Cuestomer',

            'Country',

            'Seller',

            'Amount',

            'Delivery Status',

            'Payment methode',

            'Payment Status',

            'Date',

        ];

    }



    /**

    * @var Order $Order

    */

    public function map($Order): array

    {
        $name = null;
        
        $payment_status = null;

        $address = json_decode($Order->shipping_address)->country ;
                         
        if(isset($Order->OrderDetails[0]['product_referral_code']) && $Order->OrderDetails[0]['product_referral_code'] != null){

                $name = DB::table('users')->where('partner_code', base64_decode($Order->OrderDetails[0]['product_referral_code']))->select('name','id')->first()->name;
    
        }else {

            if ($Order->shop){

                $name = $Order->shop->name ;

            }else{

                $name ='Inhouse Order';
            }
            
        }

        if ($Order->payment_status == 'paid'){

            $payment_status = 'Paid';

        }else{

            $payment_status = 'Unpaid';

        }

        return [

            $Order->code,

            count($Order->OrderDetails),

            $Order->user->name ?? '',

            $address,

            $name,

            single_price(($Order->product_price > 0) ? $Order->product_price : $Order->grand_total),

            ucfirst(str_replace('_', ' ', $Order->delivery_status)),

            ucfirst(str_replace('_', ' ', $Order->payment_type)),

            $payment_status,

            date('m-d-Y' , strtotime($Order->created_at)),

        ];

    }

}


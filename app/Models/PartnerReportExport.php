<?php



namespace App\Models;



use App\Models\Product;

use App\Models\Shop;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;


class PartnerReportExport implements FromCollection, WithMapping, WithHeadings

{

    public function collection()

    {

        return Shop::whereIn('user_id', function ($query) {

            $query->select('id')

                ->from(with(new User)->getTable());

        })->latest()->get();

    }



    public function headings(): array

    {

        return [

            'Registration Date',

            'Name',

            'Phone',

            'Email',

            'Address',

            'Approval',

        ];

    }



    /**

    * @var Shop $shop

    */

    public function map($shop): array

    {
        $city        = '';
        $state       = '';
        $country     = '';
        $address     = '';
        $postal_code = '';

        $status = null;

        if(isset($shop->user) && $shop->user->address != null){

            $address     = $shop->user->address;

        }

        if(isset($shop->user) && $shop->user->postal_code != null){

            $postal_code = $shop->user->postal_code;

        }

        if(isset($shop->user) && $shop->user->city != null ){

            $city = DB::table('cities')->where('id' ,$shop->user->city)->first()->name;

        }

        if(isset($shop->user) && $shop->user->state != null ){

                $state = DB::table('states')->where('id' ,$shop->user->state)->first()->name;

        }

        if(isset($shop->user) && $shop->user->country != null ){

                $country = DB::table('countries')->where('id' ,$shop->user->country)->first()->name;

        }

        if($shop->verification_status == 1){

            $status = 'Approved';

        }else{

            $status = 'Rejected';

        }

        $adrs = ($address ? $address . ', ' : '') . 
                ($city ? $city . ', ' : '') . 
                ($state ? $state . ', ' : '') . 
                ($postal_code ? $postal_code . ', ' : '') . 
                ($country ?? '');

        return [

            date('m-d-Y' , strtotime($shop->created_at)),

            $shop->name,

            $shop->user->phone,
            
            $shop->user->email,

            $adrs,

            $status,

        ];

    }

}


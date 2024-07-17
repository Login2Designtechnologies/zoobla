<?php



namespace App\Models;



use App\Models\Product;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class UserReportExport implements FromCollection, WithMapping, WithHeadings

{

    public function collection()

    {

        return User::join('addresses' , 'addresses.user_id' , 'users.id')->where('user_type', 'customer')->where('email_verified_at', '!=', null)->orderBy('created_at', 'desc')->select('users.*')->get();

    }



    public function headings(): array

    {

        return [

            'Registration Date',

            'Name',

            'Email',

            'Phone No.',

            'Address',

        ];

    }



    /**

    * @var User $user

    */

    public function map($user): array

    {
        $phone = null;

        $city        = '';
        $state       = '';
        $country     = '';
        $addressf    = '';
        $postal_code = '';

        $address = DB::table('addresses')->where('user_id' ,$user->id)->first();

        if(isset($address) && $address->address != null){

            $addressf     = $address->address;
            
        }

        if(isset($address) && $address->postal_code != null){

            $postal_code = $address->postal_code;

        }

        if(isset($address) && $address->city_id != null ){

            $city = DB::table('cities')->where('id' ,$address->city_id)->first()->name;

        }

        if(isset($address) && $address->state_id != null ){

            $state = DB::table('states')->where('id' ,$address->state_id)->first()->name;

        }

        if(isset($address) && $address->country_id != null ){
            
            $country = DB::table('countries')->where('id' ,$address->country_id)->first()->name;
            
        }

        if ($user->phone != '') {

            $phone = $user->phone;

        }else {

            if(isset($address->phone)) {

                $phone = $address->phone;

            }

        }

        $adrs = ($addressf ? $addressf . ', ' : '') . 
                ($city ? $city . ', ' : '') . 
                ($state ? $state . ', ' : '') . 
                ($postal_code ? $postal_code . ', ' : '') . 
                ($country ?? '');
 

        return [

            date('m-d-Y' , strtotime($user->created_at)),

            $user->name,

            $user->email,

            $phone,

            $adrs,

        ];

    }

}


<?php



namespace App\Http\Controllers;



use App\Http\Requests\SellerRegistrationRequest;

use Illuminate\Http\Request;

use App\Models\Shop;

use App\Models\User;

use App\Models\BusinessSetting;

use Auth;

use DB;
use Hash;

use App\Notifications\EmailVerificationNotification;

use Illuminate\Support\Facades\Notification;



class ShopController extends Controller

{



    public function __construct()

    {

        $this->middleware('user', ['only' => ['index']]);

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $shop = Auth::user()->shop;

        return view('seller.shop', compact('shop'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        if (Auth::check()) {

			if((Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'customer')) {

				flash(translate('Admin or Customer cannot be a seller'))->error();

				return back();

			} if(Auth::user()->user_type == 'seller'){

				flash(translate('This user already a seller'))->error();

				return back();

			}

        } else {

            return view('frontend.seller_form');

        }

    }


 public function states(Request $request)

    {
    	 $countryId = $request->input('country');
        $state = DB::table('states')
         ->select('name', 'id')
        ->where('country_id', $countryId) // Adjust this based on your database schema
        ->get();
         // dd($state);
        return response()->json($state);

    }

  public function cities(Request $request)
{
    // Ensure that the state ID is passed via AJAX request
    $stateId = $request->input('state');

    // Query the cities table for cities in the selected state
    $cities = DB::table('cities')
        ->select('name', 'id')
        ->where('state_id', $stateId) // Adjust this based on your database schema
        ->get();

    return response()->json($cities);
}

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(SellerRegistrationRequest $request)

    {

    	// dd($request->all());
        $user = new User;

        $user->name = $request->name .' '.$request->lastname;

        $user->email = $request->email;

        $user->phone = $request->phone;

        $user->country = $request->country;

        $user->state = $request->state;

        $user->city = $request->city;

        $user->user_type = "seller";

        $user->password = Hash::make($request->password);

        
        if ($user->save()) {

            if ($request->partner_code != null || $request->partner_code != '') {
                
                DB::table('users')->where('id' ,$user->id)->update(['partner_code' => $request->partner_code]);

            }

            $shop = new Shop;

            $shop->user_id = $user->id;

            $shop->name = $request->shop_name;

            $shop->address = $request->address;

            $shop->slug = preg_replace('/\s+/', '-', str_replace("/", " ", $request->shop_name));

            $shop->save();



            auth()->login($user, false);

            if (BusinessSetting::where('type', 'email_verification')->first()->value == 0) {

                $user->email_verified_at = date('Y-m-d H:m:s');

                $user->save();

            } else {

                $user->notify(new EmailVerificationNotification());

            }



            flash(translate('Your Shop has been created successfully!'))->success();

            return redirect()->route('seller.shop.index');

        }


        dd($user);
        flash(translate('Sorry! Something went wrong.'))->error();

        return back();

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    public function destroy($id)

    {

        //

    }

}


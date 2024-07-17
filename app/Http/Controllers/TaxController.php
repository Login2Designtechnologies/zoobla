<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Tax;

use Illuminate\Support\Facades\DB;



class TaxController extends Controller

{

    public function __construct() {

        // Staff Permission Check

        $this->middleware(['permission:vat_&_tax_setup'])->only('index','create','edit','destroy');

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $all_taxes = Tax::orderBy('created_at', 'desc')->get();

        return view('backend.setup_configurations.tax.index', compact('all_taxes'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $tax = new Tax;

        $tax->name = $request->name;

//        $pickup_point->address = $request->address;

        

        if ($tax->save()) {



            flash(translate('Tax has been inserted successfully'))->success();

            return redirect()->route('tax.index');



        }

        else{

            flash(translate('Something went wrong'))->error();

            return back();

        }

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

        $tax = Tax::findOrFail($id);

        return view('backend.setup_configurations.tax.edit', compact('tax'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $tax = Tax::findOrFail($id);

        $tax->name = $request->name;

//        $language->code = $request->code;

        if($tax->save()){

            flash(translate('Tax has been updated successfully'))->success();

            return redirect()->route('tax.index');

        }

        else{

            flash(translate('Something went wrong'))->error();

            return back();

        }

    }

    

    public function change_tax_status(Request $request) {

        $tax = Tax::findOrFail($request->id);

        if($tax->tax_status == 1) {

            $tax->tax_status = 0;

        } else {

            $tax->tax_status = 1;

        }

        

        if($tax->save()) {

            return 1;

        } 

        return 0;

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {   

        if(Tax::destroy($id)){

            flash(translate('Tax has been deleted successfully'))->success();

            return redirect()->route('tax.index');

        }

        else{

            flash(translate('Something went wrong'))->error();

            return back();

        }

    }

    public function cloud_list()

    {

        $cloud_list = DB::table('cloud_storage')->paginate(10);

        return view('backend.setup_configurations.cloud_storage.list', compact('cloud_list'));

    }


    public function cloud_create()

    {

        return view('backend.setup_configurations.cloud_storage.create');
    
    }

    public function cloud_store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [

            'days' => 'required',
            'amount' => 'required',
        ]);
        $data = [
            
            'days' => $request->days,
            'amount' => $request->amount,
            'status' => 1,
            'created' => date('Y-m-d H:i:s'),
        ];

        DB::table('cloud_storage')->insert($data);

        flash(translate('data inserted successfully'))->success();
        return redirect()->route('tax.cloud_list');
    }

    public function cloud_edit($id)

    {

        $cloud_data = DB::table('cloud_storage')->where('id', $id)->first();

        return view('backend.setup_configurations.cloud_storage.edit', compact('cloud_data'));

    }

    public function cloud_update(Request $request, $id)
    {
        // $this->authorize('admin_users_badges_edit');
        
        $cloud_data = [
            'days' => $request->days,
            'amount' => $request->amount,
            'status' => $request->status,
        ];

        
        DB::table('cloud_storage')->where('id', $id)->update($cloud_data);

        flash(translate('data updated successfully'))->success();
        return redirect()->route('tax.cloud_list');
        
        
    }

    public function cloud_delete(Request $request, $id)
    {

        DB::table('cloud_storage')->where('id', $id)->delete();

        return back();
    }

    // cloud products

    public function cloud_product_list()

    {

        $cloud_product_list = DB::table('cloud_product')->paginate(10);

        return view('backend.setup_configurations.cloud_product.list', compact('cloud_product_list'));

    }


    public function cloud_product_create()

    {

        return view('backend.setup_configurations.cloud_product.create');
    
    }

    public function cloud_product_store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [

            'product'       => 'required',
            'first_days'    => 'required',
            'secound_days'  => 'required',
            'third_days'    => 'required',
            'fourth_days'   => 'required',
            'fifth_days'    => 'required',
        ]);

        $data = [
            
            'product'        => $request->product,
            'first_days'     => $request->first_days,
            'secound_days'   => $request->secound_days,
            'third_days'     => $request->third_days,
            'fourth_days'    => $request->fourth_days,
            'fifth_days'     => $request->fifth_days,
            'status'         => 1
        ];

        DB::table('cloud_product')->insert($data);

        flash(translate('data inserted successfully'))->success();
        return redirect()->route('tax.cloud_product_list');
    }

    public function cloud_product_edit($id)

    {

        $cloud_data = DB::table('cloud_product')->where('id', $id)->first();

        return view('backend.setup_configurations.cloud_product.edit', compact('cloud_data'));

    }

    public function cloud_product_update(Request $request, $id)
    {
        // $this->authorize('admin_users_badges_edit');
        
        $cloud_data = [
            'product'        => $request->product,
            'first_days'     => $request->first_days,
            'secound_days'   => $request->secound_days,
            'third_days'     => $request->third_days,
            'fourth_days'    => $request->fourth_days,
            'fifth_days'     => $request->fifth_days,
            'status'         => $request->status,
        ];

        
        DB::table('cloud_product')->where('id', $id)->update($cloud_data);

        flash(translate('data updated successfully'))->success();
        return redirect()->route('tax.cloud_product_list');
        
        
    }

    public function cloud_product_delete(Request $request, $id)
    {

        DB::table('cloud_product')->where('id', $id)->delete();

        return back();
    }


}


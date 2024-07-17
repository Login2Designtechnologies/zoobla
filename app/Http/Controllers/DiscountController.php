<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use DB;


class DiscountController extends Controller
{

    public function index() {

        $discounts = DB::table('discount')->paginate('10');

        return view('backend.discount.index' , compact('discounts'));

    }

    public function create() {

        return view('backend.discount.create');

    }

    public function edit($id) {

        $discount = DB::table('discount')->where('id' , $id)->first();

        return view('backend.discount.edit' , compact('discount'));

    }

    public function store(Request $request) {

        $validatedData = $request->validate([

            'discount_name'     => 'required',

            'discount'          => 'required|numeric',

            'discount_type'     => 'required',

        ]);

        $value =[

            'discount_name'     => $request->discount_name,

            'discount_type'     => $request->discount_type,

            'discount'          => $request->discount
        ];

        $insert = DB::table('discount')->insert($value);

        if($insert){

            flash(translate('Discount has been saved successfully'))->success();

            return redirect()->route('discount.index');

        }

    }

    public function update(Request $request , $id) {
        
        $validatedData = $request->validate([

            'discount_name'     => 'required',

            'discount'          => 'required|numeric',

            'discount_type'     => 'required',

        ]);

        $value =[

            'discount_name'     => $request->discount_name,

            'discount_type'     => $request->discount_type,

            'discount'          => $request->discount
        ];

        $update = DB::table('discount')->where('id' , $id)->update($value);

        if($update){

            flash(translate('Discount has been updated successfully'))->success();

            return redirect()->route('discount.index');

        }

    }
    
}

<?php



namespace App\Http\Controllers;



use AizPackages\CombinationGenerate\Services\CombinationService;

use App\Http\Requests\ProductRequest;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\ProductTranslation;

use App\Models\Category;

use App\Models\ProductTax;

use App\Models\AttributeValue;

use App\Models\Cart;

use App\Models\Wishlist;

use App\Models\User;

use Illuminate\Support\Facades\Mail;

use App\Notifications\ShopProductNotification;

use Carbon\Carbon;

use Combinations;

use CoreComponentRepository;

use Artisan;

use DB;

use Cache;

use Str;

use App\Services\ProductService;

use App\Services\ProductTaxService;

use App\Services\ProductFlashDealService;

use App\Services\ProductStockService;

use Illuminate\Support\Facades\Notification;



class ProductController extends Controller

{

    protected $productService;

    protected $productTaxService;

    protected $productFlashDealService;

    protected $productStockService;



    public function __construct(

        ProductService $productService,

        ProductTaxService $productTaxService,

        ProductFlashDealService $productFlashDealService,

        ProductStockService $productStockService

    ) {

        $this->productService = $productService;

        $this->productTaxService = $productTaxService;

        $this->productFlashDealService = $productFlashDealService;

        $this->productStockService = $productStockService;



        // Staff Permission Check

        $this->middleware(['permission:add_new_product'])->only('create');

        $this->middleware(['permission:show_all_products'])->only('all_products');

        $this->middleware(['permission:show_in_house_products'])->only('admin_products');

        $this->middleware(['permission:show_seller_products'])->only('seller_products');

        $this->middleware(['permission:product_edit'])->only('admin_product_edit', 'seller_product_edit');

        $this->middleware(['permission:product_duplicate'])->only('duplicate');

        $this->middleware(['permission:product_delete'])->only('destroy');

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */


      public function allcategories(Request $request)
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', 'categories.cover_image', 'categories.featured','products.category_id')
            ->get();
        return view('frontend.allcategories', compact('products'));
    }


    public function admin_products(Request $request)

    {

        CoreComponentRepository::instantiateShopRepository();



        $type = 'In House';

        $col_name = null;

        $query = null;

        $sort_search = null;



        $products = Product::where('added_by', 'admin')->where('auction_product', 0)->where('wholesale_product', 0);



        if ($request->type != null) {

            $var = explode(",", $request->type);

            $col_name = $var[0];

            $query = $var[1];

            $products = $products->orderBy($col_name, $query);

            $sort_type = $request->type;

        }

        if ($request->search != null) {

            $sort_search = $request->search;

            $products = $products

                ->where('name', 'like', '%' . $sort_search . '%')

                ->orWhereHas('stocks', function ($q) use ($sort_search) {

                    $q->where('sku', 'like', '%' . $sort_search . '%');

                });

        }



        $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);



        return view('backend.product.products.index', compact('products', 'type', 'col_name', 'query', 'sort_search'));

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function seller_products(Request $request, $product_type)

    {

        $col_name = null;

        $query = null;

        $seller_id = null;

        $sort_search = null;

        $products = Product::where('added_by', 'seller')->where('auction_product', 0)->where('wholesale_product', 0);

        if ($request->has('user_id') && $request->user_id != null) {

            $products = $products->where('user_id', $request->user_id);

            $seller_id = $request->user_id;

        }

        if ($request->search != null) {

            $products = $products

                ->where('name', 'like', '%' . $request->search . '%');

            $sort_search = $request->search;

        }

        if ($request->type != null) {

            $var = explode(",", $request->type);

            $col_name = $var[0];

            $query = $var[1];

            $products = $products->orderBy($col_name, $query);

            $sort_type = $request->type;

        }

        $products = $product_type == 'physical' ? $products->where('digital', 0) : $products->where('digital', 1);

        $products = $products->orderBy('created_at', 'desc')->paginate(15);

        $type = 'Seller';



        if($product_type == 'digital'){

            return view('backend.product.digital_products.index', compact('products', 'sort_search', 'type'));

        }

        return view('backend.product.products.index', compact('products', 'type', 'col_name', 'query', 'seller_id', 'sort_search'));





    }



    public function all_products(Request $request)

    {

        $col_name = null;

        $query = null;

        $seller_id = null;

        $sort_search = null;

        $products = Product::where('auction_product', 0)->where('wholesale_product', 0);

        if ($request->has('user_id') && $request->user_id != null) {

            $products = $products->where('user_id', $request->user_id);

            $seller_id = $request->user_id;

        }

        if ($request->search != null) {

            $sort_search = $request->search;

            $products = $products

                ->where('name', 'like', '%' . $sort_search . '%')

                ->orWhereHas('stocks', function ($q) use ($sort_search) {

                    $q->where('sku', 'like', '%' . $sort_search . '%');

                });

        }

        if ($request->type != null) {

            $var = explode(",", $request->type);

            $col_name = $var[0];

            $query = $var[1];

            $products = $products->orderBy($col_name, $query);

            $sort_type = $request->type;

        }



        $products = $products->orderBy('created_at', 'desc')->paginate(15);

        $type = 'All';



        return view('backend.product.products.index', compact('products', 'type', 'col_name', 'query', 'seller_id', 'sort_search'));

    }





    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        CoreComponentRepository::initializeCache();



        $categories = Category::where('parent_id', 0)

            ->where('digital', 0)

            ->with('childrenCategories')

            ->get();

        $admin_id = \App\Models\User::where('user_type', 'admin')->first()->id;

        $products = filter_products(\App\Models\Product::where('user_id', $admin_id))->get();

        return view('backend.product.products.create', compact('categories' ,'products'));

    }



    public function add_more_choice_option(Request $request)

    {

        $all_attribute_values = AttributeValue::with('attribute')->where('attribute_id', $request->attribute_id)->get();



        $html = '';



        foreach ($all_attribute_values as $row) {

            $html .= '<option value="' . $row->value . '">' . $row->value . '</option>';

        }



        echo json_encode($html);

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(ProductRequest $request)

    {
       
        $product = $this->productService->store($request->except([

            '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'

        ]));

        $request->merge(['product_id' => $product->id]);



        //VAT & Tax

        if ($request->tax_id) {

            $this->productTaxService->store($request->only([

                'tax_id', 'tax', 'tax_type', 'product_id' 

            ]));

        }



        //Flash Deal

        $this->productFlashDealService->store($request->only([

            'flash_deal_id', 'flash_discount', 'flash_discount_type'

        ]), $product);



        //Product Stock

        $this->productStockService->store($request->only([

            'colors_active', 'colors', 'choice_no', 'unit_price', 'sku', 'current_stock', 'product_id'

        ]), $product);



        // Product Translations

        $request->merge(['lang' => env('DEFAULT_LANGUAGE')]);

        ProductTranslation::create($request->only([

            'lang', 'name', 'unit', 'description', 'product_id' 

        ]));

        $specification = [];

        foreach($request->heading as $key =>  $val){

           $specification[$val] = $request->text[ $key];

        }

        $carousel1 = [];
        $carousel2 = [];
        $carousel3 = [];

        if($request->carousel_title){

            foreach($request->carousel_title as $key =>  $val){

               $carousel1[$val] = $request->carousel_img1[$key];

            }
        }

        if($request->carousel_title2){
            foreach($request->carousel_title2 as $key =>  $val1){

               $carousel2[$val1] = $request->carousel_img2[$key];

            }

        }

        if($request->carousel_title3){

            foreach($request->carousel_title3 as $key =>  $val3){

               $carousel3[$val3] = $request->carousel_img3[$key];

            }
        }

        //dd($carousel1, $carousel2, $carousel3);
        DB::table('product_translations')->where('product_id' , $product->id)->update(
            
            [ 
                'add_on'                            => json_encode($request->product_ids) , 
                'resolution'                        => $request->resolution,
                'battery'                           => $request->battery_life,
                'local_storage'                     => $request->local_storage,
                'field_view'                        => $request->field_view,
                'homebase_compatibility'            => $request->homebase_compatibility,
                'specification'                     => json_encode($specification),
                'carousel1'                         => json_encode($carousel1),
                'carousel2'                         => json_encode($carousel2),
                'carousel3'                         => json_encode($carousel3),
                'banner_image'                      => $request->banner_img,
                'faq_questions'                     => json_encode($request->faq_questions),
                'faq_answers'                       => json_encode($request->faq_answers),
                'first_product_id'                  => $request->first_product_id,
                'secound_product_id'                => $request->secound_product_id,
                'sec_third_hedding'                 => $request->sec_third_hedding,
                'sec_third_details'                 => $request->sec_third_description,
                'sec_third_image'                   => $request->sec_third_image,
            ]

        );

        flash(translate('Product has been inserted successfully'))->success();



        Artisan::call('view:clear');

        Artisan::call('cache:clear');



        return redirect()->route('products.admin');

    }

    // public function processDetails($requestKey,$resultArray , $request){

        
    //     $resultArray = array();

    //     // if ($request[$requestKey][0] != null) {

    //     //     foreach (json_decode($request[$requestKey][0]) as $key => $detail) {

    //     //         array_push($resultArray, $detail->value);

    //     //     }
    //     // }

    //     return  $resultArray;
    // }


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

    public function admin_product_edit(Request $request, $id)

    {

        CoreComponentRepository::initializeCache();



        $product = Product::findOrFail($id);

        if ($product->digital == 1) {

            return redirect('admin/digitalproducts/' . $id . '/edit');

        }



        $lang = $request->lang;

        $tags = json_decode($product->tags);

        $categories = Category::where('parent_id', 0)

            ->where('digital', 0)

            ->with('childrenCategories')

            ->get();

        $admin_id = \App\Models\User::where('user_type', 'admin')->first()->id;

        $products = filter_products(\App\Models\Product::where('user_id', $admin_id))->get();

        return view('backend.product.products.edit', compact('product', 'categories', 'tags', 'lang' ,'products'));

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function seller_product_edit(Request $request, $id)

    {

        $product = Product::findOrFail($id);

        if ($product->digital == 1) {

            return redirect('digitalproducts/' . $id . '/edit');

        }

        $lang = $request->lang;

        $tags = json_decode($product->tags);

        // $categories = Category::all();

        $categories = Category::where('parent_id', 0)

            ->where('digital', 0)

            ->with('childrenCategories')

            ->get();



        return view('backend.product.products.edit', compact('product', 'categories', 'tags', 'lang'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(ProductRequest $request, Product $product)

    {

        // dd($request->all());
        //Product


    $mailData = DB::table('mailnotifications')->where('id', 16)->where('status', 1)->first();

    $checkwishlists = DB::table('wishlists')
        ->where('wishlists.product_id', $request->id)
        ->join('products', 'products.id', '=', 'wishlists.product_id')
        ->join('users', 'users.id', '=', 'wishlists.user_id')
        ->select('products.*', 'products.name as productsfullname', 'users.*')
        ->get();
     
     $olddatacheckall = DB::table('products')->where('id', $request->id)->first();
     $olddatacheck = $olddatacheckall->unit_price;
     $newdatacheck = $request->unit_price;

     if ($olddatacheck > $newdatacheck) {

        if (!$checkwishlists->isEmpty() && $mailData) {
            foreach ($checkwishlists as $wishlistsvalue) {
                $messageBodyAdmin = str_replace(
                    ["{{name}}", "{{product_name}}", "{{price}}", "{{date}}"],
                    [$wishlistsvalue->name, $wishlistsvalue->productsfullname, $request->unit_price - 2, date('d-m-Y')],
                    $mailData->contant
                );

                $dataAdmin = [
                    'messageBodyAdmin' => $messageBodyAdmin,
                ];

                // Send email to admin
                Mail::send([], $dataAdmin, function ($message) use ($messageBodyAdmin, $mailData, $wishlistsvalue) {
                    $message->to($wishlistsvalue->email)
                        ->subject($mailData->subject)
                        ->from('info@login2design.com', 'Zoobla')
                        ->html($messageBodyAdmin);
                });
            }
        }

   }




        $product = $this->productService->update($request->except([

            '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'

        ]), $product);



        //Product Stock

        foreach ($product->stocks as $key => $stock) {

            $stock->delete();

        }



        $request->merge(['product_id' => $product->id]);

        $this->productStockService->store($request->only([

            'colors_active', 'colors', 'choice_no', 'unit_price', 'sku', 'current_stock', 'product_id'

        ]), $product);



        //Flash Deal

        $this->productFlashDealService->store($request->only([

            'flash_deal_id', 'flash_discount', 'flash_discount_type'

        ]), $product);



        //VAT & Tax

        if ($request->tax_id) {

            ProductTax::where('product_id', $product->id)->delete();

            $this->productTaxService->store($request->only([

                'tax_id', 'tax', 'tax_type', 'product_id'

            ]));

        }



        // Product Translations

        ProductTranslation::updateOrCreate(

            $request->only([

                'lang', 'product_id'

            ]),

            $request->only([

                'name', 'unit', 'description'

            ])

        );
        
        $specification = [];

       if(!empty($request->heading)){
            foreach($request->heading as $key =>  $val){

               $specification[$val] = $request->text[ $key];

            }
       }

        $carousel1 = [];
        $carousel2 = [];
        $carousel3 = [];

        if($request->carousel_title){

            foreach($request->carousel_title as $key =>  $val){

               $carousel1[$val] = $request->carousel_img1[$key];

            }
        }

        if($request->carousel_title2){
            foreach($request->carousel_title2 as $key =>  $val1){

               $carousel2[$val1] = $request->carousel_img2[$key];

            }

        }

        if($request->carousel_title3){

            foreach($request->carousel_title3 as $key =>  $val3){

               $carousel3[$val3] = $request->carousel_img3[$key];

            }
        }

        

       DB::table('product_translations')->where('product_id' , $product->id)->update(
            
            [ 
                'add_on'                            => json_encode($request->product_ids) , 
                'resolution'                        => $request->resolution,
                'battery'                           => $request->battery_life,
                'local_storage'                     => $request->local_storage,
                'field_view'                        => $request->field_view,
                'homebase_compatibility'            => $request->homebase_compatibility,
                'specification'                     => json_encode($specification),
                'carousel1'                         => json_encode($carousel1),
                'carousel2'                         => json_encode($carousel2),
                'carousel3'                         => json_encode($carousel3),
                'banner_image'                      => $request->banner_img,
                'faq_questions'                     => json_encode($request->faq_questions),
                'faq_answers'                       => json_encode($request->faq_answers),
                'first_product_id'                  => $request->first_product_id,
                'secound_product_id'                => $request->secound_product_id,
                'sec_third_hedding'                 => $request->sec_third_hedding,
                'sec_third_details'                 => $request->sec_third_description,
                'sec_third_image'                   => $request->sec_third_image,
            ]

        );
        

        flash(translate('Product has been updated successfully'))->success();



        Artisan::call('view:clear');

        Artisan::call('cache:clear');



        return back();

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $product = Product::findOrFail($id);



        $product->product_translations()->delete();

        $product->stocks()->delete();

        $product->taxes()->delete();



        if (Product::destroy($id)) {

            Cart::where('product_id', $id)->delete();

            Wishlist::where('product_id', $id)->delete();



            flash(translate('Product has been deleted successfully'))->success();



            Artisan::call('view:clear');

            Artisan::call('cache:clear');



            return back();

        } else {

            flash(translate('Something went wrong'))->error();

            return back();

        }

    }



    public function bulk_product_delete(Request $request)

    {

        if ($request->id) {

            foreach ($request->id as $product_id) {

                $this->destroy($product_id);

            }

        }



        return 1;

    }



    /**

     * Duplicates the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function duplicate(Request $request, $id)

    {

        $product = Product::find($id);

        

        //Product

        $product_new = $this->productService->product_duplicate_store($product);



        //Product Stock

        $this->productStockService->product_duplicate_store($product->stocks, $product_new);



        //VAT & Tax

        $this->productTaxService->product_duplicate_store($product->taxes, $product_new);



        flash(translate('Product has been duplicated successfully'))->success();

        if ($request->type == 'In House')

            return redirect()->route('products.admin');

        elseif ($request->type == 'Seller')

            return redirect()->route('products.seller');

        elseif ($request->type == 'All')

            return redirect()->route('products.all');

    }



    public function get_products_by_brand(Request $request)

    {

        $products = Product::where('brand_id', $request->brand_id)->get();

        return view('partials.product_select', compact('products'));

    }



    public function updateTodaysDeal(Request $request)

    {

        $product = Product::findOrFail($request->id);

        $product->todays_deal = $request->status;

        $product->save();

        Cache::forget('todays_deal_products');

        return 1;

    }



    public function updatePublished(Request $request)

    {

        $product = Product::findOrFail($request->id);

        $product->published = $request->status;



        if ($product->added_by == 'seller' && addon_is_activated('seller_subscription') && $request->status == 1) {

            $shop = $product->user->shop;

            if (

                $shop->package_invalid_at == null

                || Carbon::now()->diffInDays(Carbon::parse($shop->package_invalid_at), false) < 0

                || $shop->product_upload_limit <= $shop->user->products()->where('published', 1)->count()

            ) {

                return 0;

            }

        }



        $product->save();



        Artisan::call('view:clear');

        Artisan::call('cache:clear');

        return 1;

    }



    public function updateProductApproval(Request $request)

    {

        $product = Product::findOrFail($request->id);

        $product->approved = $request->approved;



        if ($product->added_by == 'seller' && addon_is_activated('seller_subscription')) {

            $shop = $product->user->shop;

            if (

                $shop->package_invalid_at == null

                || Carbon::now()->diffInDays(Carbon::parse($shop->package_invalid_at), false) < 0

                || $shop->product_upload_limit <= $shop->user->products()->where('published', 1)->count()

            ) {

                return 0;

            }

        }



        $product->save();



        $product_type   = $product->digital ==  0 ? 'physical' : 'digital';

        $status         = $request->approved == 1 ? 'approved' : 'rejected';

        $users          = User::findMany([User::where('user_type', 'admin')->first()->id, $product->user_id]);

        Notification::send($users, new ShopProductNotification($product_type, $product, $status));



        Artisan::call('view:clear');

        Artisan::call('cache:clear');

        return 1;

    }



    public function updateFeatured(Request $request)

    {

        $product = Product::findOrFail($request->id);

        $product->featured = $request->status;

        if ($product->save()) {

            Artisan::call('view:clear');

            Artisan::call('cache:clear');

            return 1;

        }

        return 0;

    }



    public function sku_combination(Request $request)

    {

        $options = array();

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {

            $colors_active = 1;

            array_push($options, $request->colors);

        } else {

            $colors_active = 0;

        }



        $unit_price = $request->unit_price;

        $product_name = $request->name;



        if ($request->has('choice_no')) {

            foreach ($request->choice_no as $key => $no) {

                $name = 'choice_options_' . $no;

                // foreach (json_decode($request[$name][0]) as $key => $item) {

                if (isset($request[$name])) {

                    $data = array();

                    foreach ($request[$name] as $key => $item) {

                        // array_push($data, $item->value);

                        array_push($data, $item);

                    }

                    array_push($options, $data);

                }

            }

        }



        $combinations = (new CombinationService())->generate_combination($options);

        return view('backend.product.products.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));

    }



    public function sku_combination_edit(Request $request)

    {

        $product = Product::findOrFail($request->id);



        $options = array();

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {

            $colors_active = 1;

            array_push($options, $request->colors);

        } else {

            $colors_active = 0;

        }



        $product_name = $request->name;

        $unit_price = $request->unit_price;



        if ($request->has('choice_no')) {

            foreach ($request->choice_no as $key => $no) {

                $name = 'choice_options_' . $no;

                // foreach (json_decode($request[$name][0]) as $key => $item) {

                if (isset($request[$name])) {

                    $data = array();

                    foreach ($request[$name] as $key => $item) {

                        // array_push($data, $item->value);

                        array_push($data, $item);

                    }

                    array_push($options, $data);

                }

            }

        }



        $combinations = (new CombinationService())->generate_combination($options);

        return view('backend.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));

    }



  
 public function lowquantity_cronmail(Request $request)
{
    // Retrieve all products data
    $products = DB::table('products')->get();

    // Iterate over each product
    foreach ($products as $product) {
        $currentStock = $product->current_stock;

        // Get count of ordered products for the current product
        $ordersCount = DB::table('order_details')
            ->where('product_id', $product->id)
            ->count();

        $remainingStock = $currentStock - $ordersCount;

        // Check if the remaining stock is below the threshold
        if ($remainingStock >= 1) {
            // Retrieve the email template data
            $mailData = DB::table('mailnotifications')
                ->where('id', 7)
                ->where('status', 1)
                ->first();

            if ($mailData) {
                // Replace placeholders in the email content
                $messageBodyAdmin = str_replace(
                    ["{{product_name}}", "{{current_stock}}", "{{date}}"],
                    [$product->name, '1', date('d-m-Y')],
                    $mailData->contant
                );

                $dataAdmin = [
                    'messageBodyAdmin' => $messageBodyAdmin,
                ];

                // Send email to admin
                Mail::send([], $dataAdmin, function ($message) use ($messageBodyAdmin, $mailData) {
                    $message->to('kishanyadav@login2design.com')
                        ->subject($mailData->subject)
                        ->from('info@login2design.com', 'Zoobla')
                        ->html($messageBodyAdmin);
                });
            }
        }
    }
}

  
public function wishlist_cronmail(Request $request)
{
    $wishlistsdata = DB::table('wishlists')->groupBy('user_id')->get();

    $mailData = DB::table('mailnotifications')
        ->where('id', 26)
        ->where('status', 1)
        ->first();

    if (!empty($mailData)) {
        foreach ($wishlistsdata as $wishlistsvalue) {
            $userlistdata = DB::table('users')->where('id', $wishlistsvalue->user_id)->first();

            if (!empty($userlistdata)) {
                $messageBodyAdmin = str_replace(
                    ["{{name}}"],
                    [$userlistdata->name],
                    $mailData->contant
                );

                $dataAdmin = [
                    'messageBodyAdmin' => $messageBodyAdmin,
                ];

                // Send the email
                Mail::send([], $dataAdmin, function ($message) use ($messageBodyAdmin, $mailData,$userlistdata) {
                    $message->to($userlistdata->email)
                        ->subject($mailData->subject)
                        ->from('info@login2design.com', 'Zoobla')
                        ->html($messageBodyAdmin);
                });
            }
        }
    }
}













}


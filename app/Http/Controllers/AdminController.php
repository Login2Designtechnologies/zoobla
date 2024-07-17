<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use App\Models\Customer;

use App\Models\User;

use \App\Models\Order;

use DB;

use Artisan;

use Cache;

use CoreComponentRepository;



class AdminController extends Controller

{

    /**

     * Show the admin dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function admin_dashboard(Request $request)

    {   

        CoreComponentRepository::initializeCache();

        $root_categories = Category::where('level', 0)->get();



        $cached_graph_data = Cache::remember('cached_graph_data', 86400, function() use ($root_categories){

            $num_of_sale_data = null;

            $qty_data = null;

            foreach ($root_categories as $key => $category){

                $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);

                $category_ids[] = $category->id;



                $products = Product::with('stocks')->whereIn('category_id', $category_ids)->get();

                $qty = 0;

                $sale = 0;

                foreach ($products as $key => $product) {

                    $sale += $product->num_of_sale;

                    foreach ($product->stocks as $key => $stock) {

                        $qty += $stock->qty;

                    }

                }

                $qty_data .= $qty.',';

                $num_of_sale_data .= $sale.',';

            }

            $item['num_of_sale_data'] = $num_of_sale_data;

            $item['qty_data'] = $qty_data;



            return $item;

        });

        $users = User::where('user_type', 'customer')
            ->whereNotNull('email_verified_at')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
        ->get();

        $result = [];

        foreach ($users as $data) {

            $year = $data->year;
            $month =  date('M', mktime(0, 0, 0, $data->month, 1));
            $count = $data->count;

            if (!isset($result[$year])) {

                $result[$year] = [
                    'total' => 0, 
                    'months' => []
                ];

            }

            if (!isset($result[$year]['months'][$month])) {
                $result[$year]['months'][$month] = 0;
            }

            $result[$year]['months'][$month] += $count;

            $result[$year]['total'] += $count;
        }
        
        $ordersQuery = Order::select(DB::raw('COUNT(orders.id) as order_count'), DB::raw('SUM(orders.grand_total) as grand_total'))
            // ->groupBy('users.country')
            ->get();
        
        // dd($ordersQuery);
        
      
        return view('backend.dashboard', compact('root_categories', 'cached_graph_data' ,'result'));

    }



    function clearCache(Request $request)

    {

        Artisan::call('optimize:clear');

        flash(translate('Cache cleared successfully'))->success();

        return back();

    }

}


<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Product;

use App\Models\Order;

use App\Models\Address;

use App\Models\OrderDetail;

use App\Models\Search;

use App\Models\Shop;

use Auth;

use DB;

use App\Models\UserReportExport;

use App\Models\PartnerReportExport;

use App\Models\SalesReportExport;

use App\Models\serviceSalesReportExport;

use PDF;

use Maatwebsite\Excel\Facades\Excel;



class ReportExportController extends Controller

{

    public function __construct() {



        $this->middleware(['permission:product_bulk_import'])->only('index');

        $this->middleware(['permission:product_bulk_export'])->only('export');

    }



    public function index()

    {

        if (Auth::user()->user_type == 'seller') {

            if(Auth::user()->shop->verification_status){

                return view('seller.product_bulk_upload.index');

            }

            else{

                flash(translate('Your shop is not verified yet!'))->warning();

                return back();

            }

        }

        elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {

            return view('backend.product.bulk_upload.index');

        }

    }



    public function export(){

        return Excel::download(new SalesReportExport, 'Sales.xlsx');

    }

    public function user_export() {

        return Excel::download(new UserReportExport, 'Users.xlsx');

    }

    public function partner_export(){

        return Excel::download(new PartnerReportExport, 'partners.xlsx');
    }

    public function service_sales_export(){

        return Excel::download(new serviceSalesReportExport, 'servicesales.xlsx');
    }

    // public function pdf_download_category()

    // {

    //     $categories = Category::all();



    //     return PDF::loadView('backend.downloads.category',[

    //         'categories' => $categories,

    //     ], [], [])->download('category.pdf');

    // }



    // public function pdf_download_brand()

    // {

    //     $brands = Brand::all();



    //     return PDF::loadView('backend.downloads.brand',[

    //         'brands' => $brands,

    //     ], [], [])->download('brands.pdf');

    // }



    // public function pdf_download_seller()

    // {

    //     $users = User::where('user_type','seller')->get();



    //     return PDF::loadView('backend.downloads.user',[

    //         'users' => $users,

    //     ], [], [])->download('user.pdf');



    // }



    // public function bulk_upload(Request $request)

    // {

    //     if($request->hasFile('bulk_file')){

    //         $import = new ProductsImport;

    //         Excel::import($import, request()->file('bulk_file'));

    //     }

        

    //     return back();

    // }



}


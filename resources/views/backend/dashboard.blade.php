@extends('backend.layouts.app')



<?php
    $countryordersall = DB::table('combined_orders')
    ->select(DB::raw('shipping_address->>"$.country" AS country'), DB::raw('COUNT(*) AS totalcount'))
    ->groupBy('country')
    ->get();

    $labels = [];
    $series = [];
    foreach($countryordersall as $countryvalue){
         $labels[] = $countryvalue->country;
         $series[] = $countryvalue->totalcount;
     }

    $alllabels  = json_encode($labels); 
    $allseries = str_replace(['"'], '', json_encode($series));

   $currentMonth = date('Y-m-01');
    $previousMonth = date('Y-m-01', strtotime('-1 month'));

    $currentMonthOrders = DB::table('orders')
        ->select(DB::raw('COUNT(*) as totalcount'))
        ->whereBetween('created_at', [$currentMonth, now()])
        ->count();

    $previousMonthOrders = DB::table('orders')
        ->select(DB::raw('COUNT(*) as totalcount'))
        ->whereBetween('created_at', [$previousMonth, $currentMonth])
        ->count();

    $currentMonthGrandTotal = DB::table('orders')
        ->whereBetween('created_at', [$currentMonth, now()])
        ->sum('grand_total');

    $previousMonthGrandTotal = DB::table('orders')
        ->whereBetween('created_at', [$previousMonth, $currentMonth])
        ->sum('grand_total');
?>


@section('content')

@if(auth()->user()->can('smtp_settings') && env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)

    <div class="">

        <div class="alert alert-danger d-flex align-items-center">

            {{translate('Please Configure SMTP Setting to work all email sending functionality')}},

            <a class="alert-link ml-2" href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>

        </div>

    </div>

@endif

@can('admin_dashboard')

<div class="row gutters-10">

    <div class="col-lg-12">

        <div class="row gutters-10">

            <div class="col-3">
              
              <a href="{{url('/admin/customers')}}">
                <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">

                    <div class="px-3 pt-3 d-flex align-items-center justify-content-between">

                        <div class="opacity-100">

                            <span class="fs-14 d-block fw-700">{{ translate('Total') }}</span>

                            {{ translate('Users') }}

                        </div>

                        <div class="h3 fw-700 mb-0">

                            {{ \App\Models\User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->count() }}

                        </div>

                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">

                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>

                    </svg>

                </div>
               </a>

            </div>

            <div class="col-3">
             
             <a href="{{url('/admin/all_orders')}}">
                <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">

                    <div class="px-3 pt-3 d-flex align-items-center justify-content-between">

                        <div class="opacity-100">

                            <span class="fs-14 d-block fw-700">{{ translate('Total') }}</span>

                            {{ translate('Order') }}

                        </div>

                        <div class="h3 fw-700 mb-0">{{ \App\Models\Order::count() }}</div>

                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">

                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>

                    </svg>

                </div>
             </a>

            </div>

            <div class="col-3">
              
              <a href="{{url('/admin/categories')}}">
                <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">

                    <div class="px-3 pt-3 d-flex align-items-center justify-content-between">

                        <div class="opacity-100">

                            <span class="fs-14 d-block fw-700">{{ translate('Total') }}</span>

                            {{ translate('Product category') }}

                        </div>

                        <div class="h3 fw-700 mb-0">{{ \App\Models\Category::count() }}</div>

                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">

                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>

                    </svg>

                </div>
              </a>

            </div>

            <div class="col-3">
              
              <a href="{{url('/admin/sellers')}}">
                <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">

                    <div class="px-3 pt-3 d-flex align-items-center justify-content-between">

                        <div class="opacity-100">

                            <span class="fs-14 d-block fw-700">{{ translate('Total') }}</span>

                            {{ translate('Partners') }}

                        </div>

                        <!-- <div class="h3 fw-700 mb-0">{{ \App\Models\Brand::count() }}</div> -->
                        <div class="h3 fw-700 mb-0">{{ App\Models\Shop::where('verification_status' , 1)->count() }}</div>

                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">

                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>

                    </svg>

                </div>
              </a>
              
            </div>

        </div>

    </div>



    <div class="col-lg-12">


        <div class="row gutters-10">

            <div class="col-12 d-flex flex-column">

            <div class="form-row">
                <div class="col-lg-7 d-flex">
                    <div class="card mb-3 w-100">

                        <div class="row">

                            <div class="col-lg-4 border-right">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col">

                                            <p class="mb-0 fw-semibold text-muted-dark">Total Product</p>

                                            <h3 class="mt-2 mb-1 text-dark fw-semibold">{{App\Models\Product::where('auction_product', 0)->where('wholesale_product', 0)->where('published', 1)->count()}}</h3>

                                            <!-- <p class="text-muted fs-12 mb-0">

                                                <span class="text-body fw-semibold"><i class="fa fa-arrow-up text-success me-1"> </i>23% </span> in this year

                                            </p> -->

                                        </div>

                                        <div class="col mt-3 col-auto">
                                        
                                            <span> <i class="las la-briefcase mb-3 text-white p-3 bg-secondary fs-24 rounded-circle mb-1"></i> </span>

                                        </div>

                                    </div>

                                    <!-- <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary w-50"></div></div> -->

                                </div>

                            </div>

                            <div class="col-lg-4 border-right">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col">

                                            <p class="mb-0 fw-semibold text-muted-dark">Total Orders</p>
                                            
                                            @php
                                                $currentyear = \App\Models\Order::whereYear('created_at', date('Y'))->count();

                                                $pastyear = \App\Models\Order::whereYear('created_at', date('Y')-1)->count();  

                                                $growth = get_growth($currentyear , $pastyear);
                                                
                                            @endphp

                                            <h3 class="mt-2 mb-1 text-dark fw-semibold">{{$currentyear}}</h3>

                                            <p class="text-muted fs-12 mb-0">

                                                <span class="text-body fw-semibold"><i class="fa fa-arrow-up text-success me-1"> </i>{{$growth}}% </span> in this year

                                            </p>

                                        </div>

                                        <div class="col mt-3 col-auto">

                                            <span> <i class="las la-truck mb-3 text-white p-3 bg-danger -transparent fs-24 rounded-circle mb-1"></i> </span>

                                        </div>

                                    </div>

                                    <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:{{$growth}}%"></div></div>

                                </div>

                            </div>

                            <div class="col-lg-4 border-right">

                                <div class="card-body">

                                    <div class="row">
                                        @php
                                            $currentyearsall = \App\Models\Order::whereYear('created_at', date('Y'))->sum('grand_total'); 
                                            
                                            $lastyearsall    = \App\Models\Order::whereYear('created_at', date('Y')-1)->sum('grand_total'); 
                                        @endphp
                                        <div class="col p-0">

                                            <p class="mb-0 fw-semibold text-muted-dark">Total Sales</p>

                                            <h3 class="mt-2 mb-1 text-dark fw-semibold" style="font-size: 20px;">{{format_price($currentyearsall)}}</h3>

                                            <p class="text-muted fs-12 mb-0">

                                                <span class="text-body fw-semibold"><i class="fa fa-arrow-down text-danger me-1"> </i>{{get_growth($currentyearsall,$lastyearsall)}}% </span> in this year

                                            </p>

                                        </div>

                                        <div class="col mt-3 col-auto">

                                            <span> <i class="las la-chart-bar mb-3 text-white p-3 bg-primary fs-24 rounded-circle mb-1"></i> </span>

                                        </div>

                                    </div>

                                    <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-primary " style="width:{{get_growth($currentyearsall,$lastyearsall)}}%"></div></div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-5 d-flex">
                    <div class="card mb-3 w-100">

                        <div class="row">

                            <div class="col-lg-6 border-right">

                                <div class="card-body">

                                    <div class="row form-row">

                                        <div class="col col-auto">
                                            @php
                                            $total_income =  \App\Models\Order::whereYear('created_at', date('Y'))->sum('grand_total') - get_grand_total_commission('year');

                                            $last_income =  \App\Models\Order::whereYear('created_at', date('Y')-1)->sum('grand_total') - get_grand_total_commission('lastyear');
                                            
                                            @endphp
                                            <p class="mb-0 fw-semibold text-muted-dark">Total Income</p>

                                            <h6 class="mt-2 mb-1 text-dark fw-semibold">{{format_price($total_income)}}</h6>

                                            <p class="text-muted fs-12 mb-0">

                                                <span class="text-body fw-semibold"><i class="las la-wave-square text-success me-1"> </i>{{get_growth($total_income , $last_income)}}% </span> in this year

                                            </p>

                                        </div>

                                        <div class="col mt-3 ">

                                            <span> <i class="las la-dollar-sign mb-3 text-white p-3 bg-secondary fs-24 rounded-circle mb-1"></i> </span>

                                        </div>

                                    </div>

                                    <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" style="width:{{get_growth($total_income , $last_income)}}%"></div></div>

                                </div>

                            </div>

                            <div class="col-lg-6 border-right">

                                <div class="card-body">

                                    <div class="row form-row">

                                        <div class="col col-auto">
                                            @php

                                            $monthly_income =  \App\Models\Order::whereMonth('created_at' ,  date('m'))->sum('grand_total') - get_grand_total_commission('month');

                                            $last_month_income =  \App\Models\Order::whereMonth('created_at' ,  date('m')-1)->sum('grand_total') - get_grand_total_commission('lastmonth');
                                            
                                            @endphp

                                            <p class="mb-0 fw-semibold text-muted-dark">Monthly Income</p>

                                            <h6 class="mt-2 mb-1 text-dark fw-semibold">{{format_price($monthly_income)}}</h6>

                                            <p class="text-muted fs-12 mb-0">

                                                <span class="text-body fw-semibold"><i class="fa fa-arrow-up text-success me-1"> </i>{{get_growth($monthly_income , $last_month_income)}}% </span> in this month

                                            </p>

                                        </div>

                                        <div class="col mt-3">

                                            <span> <i class="las la-store mb-3 text-white p-3 bg-danger -transparent fs-24 rounded-circle mb-1"></i> </span>

                                        </div>

                                    </div>

                                    <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger " style="width:{{get_growth($monthly_income , $last_month_income)}}%"></div></div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
                <div class="card mb-3 d-none">

                    <div class="row">

                        <div class="col-lg-4 border-right">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col">

                                        <p class="mb-0 fw-semibold text-muted-dark">Total Product</p>

                                        <h3 class="mt-2 mb-1 text-dark fw-semibold">{{App\Models\Product::where('auction_product', 0)->where('wholesale_product', 0)->where('published', 1)->count()}}</h3>

                                        <!-- <p class="text-muted fs-12 mb-0">

                                            <span class="text-body fw-semibold"><i class="fa fa-arrow-up text-success me-1"> </i>23% </span> in this year

                                        </p> -->

                                    </div>

                                    <div class="col mt-3 col-auto">
                                    
                                        <span> <i class="las la-briefcase mb-3 text-white p-3 bg-secondary fs-24 rounded-circle mb-1"></i> </span>

                                    </div>

                                </div>

                                <!-- <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary w-50"></div></div> -->

                            </div>

                        </div>

                        <div class="col-lg-4 border-right">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col p-0">

                                        <p class="mb-0 fw-semibold text-muted-dark">Total Orders</p>
                                        
                                        @php
                                             $currentyear = \App\Models\Order::whereYear('created_at', date('Y'))->count();

                                             $pastyear = \App\Models\Order::whereYear('created_at', date('Y')-1)->count();  

                                             $growth = get_growth($currentyear , $pastyear);
                                            
                                        @endphp

                                        <h3 class="mt-2 mb-1 text-dark fw-semibold">{{$currentyear}}</h3>

                                        <p class="text-muted fs-12 mb-0">

                                            <span class="text-body fw-semibold"><i class="fa fa-arrow-up text-success me-1"> </i>{{$growth}}% </span> in this year

                                        </p>

                                    </div>

                                    <div class="col mt-3 col-auto">

                                        <span> <i class="las la-truck mb-3 text-white p-3 bg-danger -transparent fs-24 rounded-circle mb-1"></i> </span>

                                    </div>

                                </div>

                                <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:{{$growth}}%"></div></div>

                            </div>

                        </div>

                        <div class="col-lg-4 border-right">

                            <div class="card-body">

                                <div class="row">
                                    @php
                                        $currentyearsall = \App\Models\Order::whereYear('created_at', date('Y'))->sum('grand_total'); 
                                        
                                        $lastyearsall    = \App\Models\Order::whereYear('created_at', date('Y')-1)->sum('grand_total'); 
                                    @endphp
                                    <div class="col">

                                        <p class="mb-0 fw-semibold text-muted-dark">Total Sales</p>

                                        <h3 class="mt-2 mb-1 text-dark fw-semibold" style="font-size: 20px;">{{format_price($currentyearsall)}}</h3>

                                        <p class="text-muted fs-12 mb-0">

                                            <span class="text-body fw-semibold"><i class="fa fa-arrow-down text-danger me-1"> </i>{{get_growth($currentyearsall,$lastyearsall)}}% </span> in this year

                                        </p>

                                    </div>

                                    <div class="col mt-3 col-auto">

                                        <span> <i class="las la-chart-bar mb-3 text-white p-3 bg-primary fs-24 rounded-circle mb-1"></i> </span>

                                    </div>

                                </div>

                                <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-primary " style="width:{{get_growth($currentyearsall,$lastyearsall)}}%"></div></div>

                            </div>

                        </div>

                    </div>

                </div>

            
                <div class="card w-100">

                    <div class="card-header">

                        <h6 class="mb-0 fs-14">{{ translate('Sales Overview') }}</h6>
                        <div class="ms-auto"> 
                            <a href="javascript:void(0);" class="btn btn-sm text-dark fs-13 fw-semibold px-2 allButton" data-value="daily">Daily</a> 

                           <a href="javascript:void(0);" class="btn btn-sm text-dark fs-13 fw-semibold px-2 allButton" data-value="Weekly">Weekly</a>

                             <a href="javascript:void(0);" class="btn btn-sm text-dark fs-13 fw-semibold px-2 allButton" data-value="monthly">Monthly</a> 

                             <a href="javascript:void(0);" class="btn btn-sm text-dark fs-13 fw-semibold px-2 allButton" data-value="yearly">Yearly</a>

                             <!--  <a href="javascript:void(0);" class="btn btn-sm fs-13 fw-semibold btn-primary"><i class="fe fe-download"></i> Report</a>  -->

                          </div>
                    </div>

                    <div class="card-body">
                        <div class="salechart-new"></div>
                        <!-- <canvas id="pie-1" class="w-100" height="305"></canvas> -->


                    </div>

                </div> 
            </div>

        
            <div class="col-4 d-flex flex-column" style="display:none !important">

                <div class="card mb-3">

                    <div class="row">

                        <div class="col-lg-6 border-right">

                            <div class="card-body">

                                <div class="row form-row">

                                    <div class="col col-auto">
                                        @php
                                         $total_income =  \App\Models\Order::whereYear('created_at', date('Y'))->sum('grand_total') - get_grand_total_commission('year');

                                         $last_income =  \App\Models\Order::whereYear('created_at', date('Y')-1)->sum('grand_total') - get_grand_total_commission('lastyear');
                                         
                                        @endphp
                                        <p class="mb-0 fw-semibold text-muted-dark">Total Income</p>

                                        <h6 class="mt-2 mb-1 text-dark fw-semibold">{{format_price($total_income)}}</h6>

                                        <p class="text-muted fs-12 mb-0">

                                            <span class="text-body fw-semibold"><i class="las la-wave-square text-success me-1"> </i>{{get_growth($total_income , $last_income)}}% </span> in this year

                                        </p>

                                    </div>

                                    <div class="col mt-3 ">

                                        <span> <i class="las la-dollar-sign mb-3 text-white p-3 bg-secondary fs-24 rounded-circle mb-1"></i> </span>

                                    </div>

                                </div>

                                <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" style="width:{{get_growth($total_income , $last_income)}}%"></div></div>

                            </div>

                        </div>

                        <div class="col-lg-6 border-right">

                            <div class="card-body">

                                <div class="row form-row">

                                    <div class="col col-auto">
                                        @php

                                         $monthly_income =  \App\Models\Order::whereMonth('created_at' ,  date('m'))->sum('grand_total') - get_grand_total_commission('month');

                                         $last_month_income =  \App\Models\Order::whereMonth('created_at' ,  date('m')-1)->sum('grand_total') - get_grand_total_commission('lastmonth');
                                         
                                        @endphp

                                        <p class="mb-0 fw-semibold text-muted-dark">Monthly Income</p>

                                        <h6 class="mt-2 mb-1 text-dark fw-semibold">{{format_price($monthly_income)}}</h6>

                                        <p class="text-muted fs-12 mb-0">

                                            <span class="text-body fw-semibold"><i class="fa fa-arrow-up text-success me-1"> </i>{{get_growth($monthly_income , $last_month_income)}}% </span> in this month

                                        </p>

                                    </div>

                                    <div class="col mt-3">

                                        <span> <i class="las la-store mb-3 text-white p-3 bg-danger -transparent fs-24 rounded-circle mb-1"></i> </span>

                                    </div>

                                </div>

                                <div class="progress progress-xs mb-0 mt-3"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger " style="width:{{get_growth($monthly_income , $last_month_income)}}%"></div></div>

                            </div>

                        </div>

                    </div>

                </div>

                

               {{-- <div class="card w-100">

                    <div class="card-header">

                        <h6 class="mb-0 fs-14">{{ translate('Revenue') }}</h6>
                        <div class="ms-auto">
                            <select name="" id="" class="form-control form-control-sm">
                                <option value="">Monthly</option>
                                <option value="">Yearly</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-body">

                        <!-- <canvas id="pie-2" class="w-100" height="305"></canvas> -->
                        <div id="revenue"></div>

                    </div>

                </div> --}}

            </div>
            
            

        </div>

    </div>

</div>

<div  class="row gutters-10">
        <div class="col-md-7 d-flex">

        <div class="card w-100">

            <div class="card-header">

                <h6 class="mb-0 fs-14">{{ translate('Order By Location (USA)') }}</h6>

            </div>

            <div class="card-body">
                
                <!-- <canvas id="graph-1" class="w-100" height="500"></canvas> -->
                <div id="locationchart1"></div>
                 
            </div>

        </div>

        <a href=""></a>

        </div>


  <div class="col-md-5 d-flex">

        <div class="card w-100">

            <div class="card-header">

                <h6 class="mb-0 fs-14">Total Order By Location</h6>

            </div>

            <div class="card-body">
                
                <!-- <canvas id="graph-1" class="w-100" height="500"></canvas> -->
                <div class="mt-5" id="totalorders"></div>
                 
            </div>

        </div>

        <a href=""></a>

</div>



</div>

<div class="row gutters-10">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">

                <h6 class="mb-0 fs-14">{{ translate('Order By Location') }}</h6>

            </div>

            <div class="card-body">
                
                <!-- <canvas id="graph-1" class="w-100" height="500"></canvas> -->
                <div id="locationchart"></div>

            </div>

        </div>

        <a href=""></a>

    </div>

    <div class="col-md-6 d-flex">

        <div class="card w-100">

            <div class="card-header">

                <h6 class="mb-0 fs-14">{{ translate('Total User') }}</h6>
                 {{-- <div class="ms-auto">
                    <select name="" id="" class="form-control form-control-sm">
                        <option value="">Weekly</option>
                        <option value="">Monthly</option>
                        <option value="">Yearly</option>
                    </select>
                </div> --}}

            </div>

            <div class="card-body">

                <!-- <canvas id="graph-2" class="w-100" height="380"></canvas> -->
                <div id="userchart"></div>

            </div>

        </div>

    </div>

</div>

<!--  -->
<div class="row">
    <div class="col-md-7 d-flex">
        <div class="card d-inline-block overflow-hidden w-100">
            <div class="card-header custom-header"><h3 class="mb-0 fs-14">Popular Products</h3></div>
            <div class="card-body overflow-hidden p-0">
                <div class="table-responsive">
                    <table class="table border-0 mb-0 text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0 text-dark fw-semibold ps-5 fs-13">s.no</th>
                                <th class="border-top-0 text-dark fw-semibold fs-13">Product Name</th>
                                <th class="border-top-0 text-dark fw-semibold fs-13">Popularity</th>
                                <th class="border-top-0 text-dark fw-semibold pe-5 text-end fs-13">Percentage %</th>
                            </tr>
                        </thead>
                        <tbody>

                        @php
                             $colorMapping = [ 1 => 'primary', 2 => 'secondary', 3 => 'info', 4 => 'success', 5 => 'warning', 6 => 'pink' , 7 => ''];
                        @endphp

                        @foreach (filter_products(\App\Models\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $product)

                            @php
                                    $per = num_of_sale($product->num_of_sale);

                            @endphp
                            
                            <tr class="border-bottom">
                                <td class="ps-5"><div class="text-body">{{++$key}}</div></td>
                                <td><div class="text-dark fw-semibold" style="width: 400px;
                                    white-space: wrap;">{{ $product->getTranslation('name') }}</div></td>

                                <td>
                                    <div class="progress progress-xs"><div class="progress-bar progress-bar-striped progress-bar-animated bg-{{$colorMapping[$key]}} rounded" style="width: {{$per}}%"> </div></div>
                                </td>
                                <td class="text-end pe-5">
                                    <div><span class="btn btn-sm btn-outline-{{$colorMapping[$key]}} bg-{{$colorMapping[$key]}}-transparent">{{$per}}%</span></div>
                                </td>
                            </tr>

                        @endforeach

                            <!-- <tr class="border-bottom">
                                <td class="ps-5"><div class="text-body">02</div></td>
                                <td><div class="text-dark fw-semibold">Kids Wear</div></td>
                                <td>
                                    <div class="progress progress-xs"><div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary w-20 rounded"></div></div>
                                </td>
                                <td class="text-end pe-5">
                                    <div><span class="btn btn-sm btn-outline-secondary bg-secondary-transparent">20%</span></div>
                                </td>
                            </tr>

                            <tr class="border-bottom">
                                <td class="ps-5"><div class="text-body">03</div></td>
                                <td><div class="text-dark fw-semibold">Home Decores</div></td>
                                <td>
                                    <div class="progress progress-xs"><div class="progress-bar progress-bar-striped progress-bar-animated bg-info w-30 rounded"></div></div>
                                </td>
                                <td class="text-end pe-5">
                                    <div><span class="btn btn-sm btn-outline-info bg-info-transparent">30%</span></div>
                                </td>
                            </tr>

                            <tr class="border-bottom">
                                <td class="ps-5"><div class="text-body">04</div></td>
                                <td><div class="text-dark fw-semibold">Furnitures</div></td>
                                <td>
                                    <div class="progress progress-xs"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-50 rounded"></div></div>
                                </td>
                                <td class="text-end pe-5">
                                    <div><span class="btn btn-sm btn-outline-success bg-success-transparent">45%</span></div>
                                </td>
                            </tr>

                            <tr class="border-bottom">
                                <td class="ps-5"><div class="text-body">05</div></td>
                                <td><div class="text-dark fw-semibold">Electroni Gadgets</div></td>
                                <td>
                                    <div class="progress progress-xs"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning w-70 rounded"></div></div>
                                </td>
                                <td class="text-end pe-5">
                                    <div><span class="btn btn-sm btn-outline-warning bg-warning-transparent">70%</span></div>
                                </td>
                            </tr>

                            <tr class="border-bottom-0">
                                <td class="ps-5"><div class="text-body">06</div></td>
                                <td><div class="text-dark fw-semibold">Mechanical Parts</div></td>
                                <td>
                                    <div class="progress progress-xs"><div class="progress-bar progress-bar-striped progress-bar-animated bg-pink w-50 rounded"></div></div>
                                </td>
                                <td class="text-end pe-5">
                                    <div><span class="btn btn-sm btn-outline-pink bg-pink-transparent">45%</span></div>
                                </td>
                            </tr> -->

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
     <div class="col-md-5 d-flex">
        <div class="card w-100">
            <div class="card-header border-bottom"><h3 class="mb-0 fs-14">Sales Activities</h3></div>
            <div class="card-body">
                <div class="timeline-label">


                    <div class="sales-activity mb-4 fs-13">
                        <div class="tab-pane active" id="orders-notifications" role="tabpanel">
                            <x-notification :notifications="auth()->user()->unreadNotifications()->where('type', 'App\Notifications\OrderNotification')->take(20)->get()" />

                        </div>
                    </div>


                    <a href="{{ route('admin.all-notification') }}" class="text-reset d-block py-2 text-center">

                        {{ translate('View All Notifications') }}

                    </a>

                   <!--  <div class="sales-activity mb-4">
                        <span class="text-muted ms-5">08:00</span>
                        <h6 class="my-1 mb-0 ms-5 fw-semibold">Potential Customer</h6>
                        <p class="mb-0 ms-5 text-muted fs-12">User <a href="#" class="text-azure">Charlie_T</a> checked out <a href="#" class="text-purple">Item #42</a>. <a href="#" class="text-success fw-semibold">View</a></p>
                    </div>
                    <div class="sales-activity mb-4">
                        <span class="text-muted ms-5">16:24</span>
                        <h6 class="my-1 mb-0 ms-5 fw-semibold">New Ticket Arrived</h6>
                        <p class="mb-0 ms-5 text-muted fs-12">User <a href="#" class="text-azure">Michael85</a> Submitted a ticket <a href="#" class="text-success fw-semibold">Details</a></p>
                    </div>
                    <div class="sales-activity">
                        <span class="text-muted ms-5">04:16</span>
                        <h6 class="my-1 mb-0 ms-5 fw-semibold">Monthly Sales Report</h6>
                        <p class="mb-0 ms-5 text-muted fs-12"><a href="#" class="text-danger">4 days left</a> notification to submit the monthly sales report. <a href="#" class="text-success fw-semibold">View report</a></p>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
   {{-- <div class="col-md-3 d-flex">
        <div class="card w-100">
            <div class="card-header border-bottom"><h3 class="mb-0 fs-14">Recent Orders</h3></div>
            <div class="card-body px-0">
                <div id="recent-orders"></div>
            </div>
            <div class="card-footer">
                <div class="row pb-0 mb-0 w-100">
                    <div class="col-6 justify-content-center text-center border-right">
                        <p class="mb-0 d-flex fw-semibold text-muted justify-content-center"><span class="legend bg-primary"></span>Last Month</p>
                         <h6 class="mb-0 fw-semibold">{{$previousMonthGrandTotal}}</h6> 
                        <h6 class="mb-0 fw-semibold">500</h6>
                    </div>
                    <div class="col-6 text-center float-end">
                        <p class="mb-0 d-flex fw-semibold text-muted justify-content-center"><span class="legend bg-secondary"></span>This Month</p>
                         <h6 class="mb-0 fw-semibold">{{$currentMonthGrandTotal}}</h6>
                        <h6 class="mb-0 fw-semibold">100</h6>
                    </div>
                </div>   
            </div>
        </div>
    </div> --}}
</div>
<!--  -->

<div class="card">

    <div class="card-header">

        <h6 class="mb-0">{{ translate('Top 10 Products') }}</h6>

    </div>

    <div class="card-body">

        <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-arrows='true'>

            @foreach (filter_products(\App\Models\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(12)->get() as $key => $product)

                <div class="carousel-box">

                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">

                        <div class="position-relative">

                            <!-- <a href="{{ route('product', $product->slug) }}" class="d-block"> -->

                                <img

                                    class="img-fit lazyload mx-auto h-210px"

                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"

                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"

                                    alt="{{  $product->getTranslation('name')  }}"

                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"

                                >

                            <!-- </a> -->

                        </div>

                        <div class="p-md-3 p-2 text-left">

                            <div class="fs-15">

                                @if(home_base_price($product) != home_discounted_base_price($product))

                                    <del class="fw-600 opacity-100 mr-1">{{ home_base_price($product) }}</del>

                                @endif

                                <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>

                            </div>

                            <div class="rating rating-sm mt-1">

                                {{ renderStarRating($product->rating) }}

                            </div>

                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">

                                <a href="#" class="d-block text-reset">{{ $product->getTranslation('name') }}</a>

                                <!-- <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{ $product->getTranslation('name') }}</a> -->

                            </h3>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>




@endcan





@endsection



<?php
    $ordersalldata = DB::table('combined_orders')
    ->select(DB::raw('shipping_address->>"$.country" AS country'), DB::raw('shipping_address->>"$.state" AS state'), DB::raw('COUNT(*) AS totalcount'))
    ->whereJsonContains('shipping_address->country', 'United States')
    ->groupBy('country', 'state')
    ->get();



   // Initialize arrays
    $saledata = [];
    $dates = [];
    $totalOrders = [];

    // Generate date range for the last 12 days
    for ($i = 11; $i >= 0; $i--) {
        $date = strtotime("-$i days");
        $formattedDate = date('d M', $date);
        $saledata[] = $formattedDate;
    }

   use Carbon\Carbon;
    // Fetch orders data from the database for the last 12 days
    $saleOrdersData = DB::table('orders')
    ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS total'))
    ->whereBetween(DB::raw('DATE(created_at)'), [Carbon::now()->subDays(11)->toDateString(), Carbon::now()->toDateString()])
    ->groupBy(DB::raw('DATE(created_at)'))
    ->get();
    // Process data to align with the date range
    foreach ($saledata as $categoryDate) {
        $found = false;

        // Check if orders data exists for the current date
        foreach ($saleOrdersData as $data) {
            if (date('d M', strtotime($data->date)) == $categoryDate) {
                $dates[] = $categoryDate;
                $totalOrders[] = $data->total;
                $found = true;
                break;
            }
        }

        // If no orders data exists for the current date, set count to 0
        if (!$found) {
            $dates[] = $categoryDate;
            $totalOrders[] = 0;
        }
    }


    //////////// week ////////////////


   $saledata2 = [];
    $dates2 = [];
    $totalOrders2 = [];

    // Generate date range for the last 12 weeks
    for ($i = 11; $i >= 0; $i--) {
        $date = Carbon::now()->subWeeks($i);
        $formattedDate = $date->format('d M'); // Use Y-m-d format for comparison
        $saledata2[] = $formattedDate;
    }

    // Fetch orders data from the database for the last 12 weeks
    $saleOrdersData2 = DB::table('orders')
        ->select(DB::raw('WEEK(created_at) AS week'), DB::raw('COUNT(*) AS total'))
        ->whereBetween(DB::raw('created_at'), [
            Carbon::now()->subWeeks(11)->startOfWeek()->toDateString(), 
            Carbon::now()->endOfWeek()->toDateString()
        ])
        ->groupBy(DB::raw('WEEK(created_at)'))
        ->get();

    // Process data to align with the date range
    foreach ($saledata2 as $index => $categoryDate) {
        $found = false;

        // Check if orders data exists for the current week
        foreach ($saleOrdersData2 as $data) {
            if ($data->week == Carbon::parse($categoryDate)->week) {
                $dates2[] = $categoryDate;
                $totalOrders2[] = $data->total;
                $found = true;
                break;
            }
        }

        // If no orders data exists for the current week, set count to 0
        if (!$found) {
            $dates2[] = $categoryDate;
            $totalOrders2[] = 0;
        }
    }


    //////////// monthly ////////////////


   
    $saledata3 = [];
    $dates3 = [];
    $totalOrders3 = [];

    // Generate date range for the last 12 months
    for ($i = 11; $i >= 0; $i--) {
        $date = Carbon::now()->subMonths($i);
        $formattedDate = $date->format('M Y'); // Use M Y format for comparison
        $saledata3[] = $formattedDate;
    }

    // Fetch orders data from the database for the last 12 months
    $saleOrdersData2 = DB::table('orders')
        ->select(DB::raw('MONTH(created_at) AS month'), DB::raw('COUNT(*) AS total'))
        ->whereBetween(DB::raw('created_at'), [
            Carbon::now()->subMonths(11)->startOfMonth()->toDateString(), 
            Carbon::now()->endOfMonth()->toDateString()
        ])
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

    // Process data to align with the date range
    foreach ($saledata3 as $index => $categoryDate) {
        $found = false;

        // Check if orders data exists for the current month
        foreach ($saleOrdersData2 as $data) {
            if ($data->month == Carbon::parse($categoryDate)->month) {
                $dates3[] = $categoryDate;
                $totalOrders3[] = $data->total;
                $found = true;
                break;
            }
        }

        // If no orders data exists for the current month, set count to 0
        if (!$found) {
            $dates3[] = $categoryDate;
            $totalOrders3[] = 0;
        }
    }



   ////////////////yearly/////////// 
    

    $saledata4 = [];
    $dates4 = [];
    $totalOrders4 = [];

    // Generate date range for the last 12 years
    $currentYear = Carbon::now()->year;
    for ($i = $currentYear - 11; $i <= $currentYear; $i++) {
        $formattedDate = $i; // Use the year as the format
        $saledata4[] = $formattedDate;
    }

    // Fetch orders data from the database for the last 12 years
    $saleOrdersData3 = DB::table('orders')
        ->select(DB::raw('YEAR(created_at) AS year'), DB::raw('COUNT(*) AS total'))
        ->whereBetween(DB::raw('created_at'), [
            Carbon::now()->subYears(11)->startOfYear()->toDateString(), 
            Carbon::now()->endOfYear()->toDateString()
        ])
        ->groupBy(DB::raw('YEAR(created_at)'))
        ->get();

    // Process data to align with the date range
    foreach ($saledata4 as $index => $categoryDate) {
        $found = false;

        // Check if orders data exists for the current year
        foreach ($saleOrdersData3 as $data) {
            if ($data->year == $categoryDate) {
                $dates4[] = $categoryDate;
                $totalOrders4[] = $data->total;
                $found = true;
                break;
            }
        }

        // If no orders data exists for the current year, set count to 0
        if (!$found) {
            $dates4[] = $categoryDate;
            $totalOrders4[] = 0;
        }
    }




?>


 


@section('script')

<script type="text/javascript">
    

    AIZ.plugins.chart('#pie-1',{

        type: 'doughnut',

        data: {

            labels: [

                '{{translate('Total published products')}}',

                '{{translate('Total sellers products')}}',

                '{{translate('Total admin products')}}'

            ],

            datasets: [

                {

                    data: [

                        {{ \App\Models\Product::where('published', 1)->count() }},

                        {{ \App\Models\Product::where('published', 1)->where('added_by', 'seller')->count() }},

                        {{ \App\Models\Product::where('published', 1)->where('added_by', 'admin')->count() }}

                    ],

                    backgroundColor: [

                        "#fd3995",

                        "#34bfa3",

                        "#5d78ff",

                        '#fdcb6e',

                        '#d35400',

                        '#8e44ad',

                        '#006442',

                        '#4D8FAC',

                        '#CA6924',

                        '#C91F37'

                    ]

                }

            ]

        },

        options: {

            cutoutPercentage: 70,

            legend: {

                labels: {

                    fontFamily: 'Poppins',

                    boxWidth: 10,

                    usePointStyle: true

                },

                onClick: function () {

                    return '';

                },

                position: 'bottom'

            }

        }

    });



    AIZ.plugins.chart('#pie-2',{

        type: 'doughnut',

        data: {

            labels: [

                '{{translate('Total sellers')}}',

                '{{translate('Total approved sellers')}}',

                '{{translate('Total pending sellers')}}'

            ],

            datasets: [

                {

                    data: [

                        {{ \App\Models\Shop::count() }},

                        {{ \App\Models\Shop::where('verification_status', 1)->count() }},

                        {{ \App\Models\Shop::where('verification_status', 0)->count() }}

                    ],

                    backgroundColor: [

                        "#fd3995",

                        "#34bfa3",

                        "#5d78ff",

                        '#fdcb6e',

                        '#d35400',

                        '#8e44ad',

                        '#006442',

                        '#4D8FAC',

                        '#CA6924',

                        '#C91F37'

                    ]

                }

            ]

        },

        options: {

            cutoutPercentage: 70,

            legend: {

                labels: {

                    fontFamily: 'Montserrat',

                    boxWidth: 10,

                    usePointStyle: true

                },

                onClick: function () {

                    return '';

                },

                position: 'bottom'

            }

        }

    });

    AIZ.plugins.chart('#graph-1',{

        type: 'bar',

        data: {

            labels: [

                @foreach ($root_categories as $key => $category)

                '{{ $category->getTranslation('name') }}',

                @endforeach

            ],

            datasets: [{

                label: '{{ translate('Number of sale') }}',

                data: [

                    {{ $cached_graph_data['num_of_sale_data'] }}

                ],

                backgroundColor: [

                    @foreach ($root_categories as $key => $category)

                        'rgba(55, 125, 255, 0.4)',

                    @endforeach

                ],

                borderColor: [

                    @foreach ($root_categories as $key => $category)

                        'rgba(55, 125, 255, 1)',

                    @endforeach

                ],

                borderWidth: 1

            }]

        },

        options: {

            scales: {

                yAxes: [{

                    gridLines: {

                        color: '#f2f3f8',

                        zeroLineColor: '#f2f3f8'

                    },

                    ticks: {

                        fontColor: "#8b8b8b",

                        fontFamily: 'Poppins',

                        fontSize: 10,

                        beginAtZero: true

                    }

                }],

                xAxes: [{

                    gridLines: {

                        color: '#f2f3f8'

                    },

                    ticks: {

                        fontColor: "#8b8b8b",

                        fontFamily: 'Poppins',

                        fontSize: 10

                    }

                }]

            },

            legend:{

                labels: {

                    fontFamily: 'Poppins',

                    boxWidth: 10,

                    usePointStyle: true

                },

                onClick: function () {

                    return '';

                },

            }

        }

    });

    AIZ.plugins.chart('#graph-2',{

        type: 'bar',

        data: {

            labels: [

                @foreach ($root_categories as $key => $category)

                '{{ $category->getTranslation('name') }}',

                @endforeach

            ],

            datasets: [{

                label: '{{ translate('Number of Stock') }}',

                data: [

                    {{ $cached_graph_data['qty_data'] }}

                ],

                backgroundColor: [

                    @foreach ($root_categories as $key => $category)

                        'rgba(253, 57, 149, 0.4)',

                    @endforeach

                ],

                borderColor: [

                    @foreach ($root_categories as $key => $category)

                        'rgba(253, 57, 149, 1)',

                    @endforeach

                ],

                borderWidth: 1

            }]

        },

        options: {

            scales: {

                yAxes: [{

                    gridLines: {

                        color: '#f2f3f8',

                        zeroLineColor: '#f2f3f8'

                    },

                    ticks: {

                        fontColor: "#8b8b8b",

                        fontFamily: 'Poppins',

                        fontSize: 10,

                        beginAtZero: true

                    }

                }],

                xAxes: [{

                    gridLines: {

                        color: '#f2f3f8'

                    },

                    ticks: {

                        fontColor: "#8b8b8b",

                        fontFamily: 'Poppins',

                        fontSize: 10

                    }

                }]

            },

            legend:{

                labels: {

                    fontFamily: 'Poppins',

                    boxWidth: 10,

                    usePointStyle: true

                },

                onClick: function () {

                    return '';

                },

            }

        }

    });

    // userchart
var options = {
  series: [
    {
      name: "Actual",
      data: [
        
        @foreach($result as $key => $val)
            {
            x: {{$key}},
            y: {{$val['total']}},

            meta: {

                  @foreach($val['months'] as $name => $count)

                    {{$name}}: {{$count}},

                  @endforeach
              }

            },
        @endforeach
        

        // {
        //   x: "2021",
        //   y: 44,
        //   meta: {
        //     "24-30 aug": 13,
        //     "16-23 aug": 10,
        //     "1-7 aug": 51
        //   }
        // },
        // {
        //   x: "2022",
        //   y: 54,
        //   meta: {
        //     "24-30 aug": 3,
        //     "16-23 aug": 0,
        //     "1-7 aug": 13
        //   }
        // },
        // {
        //   x: "2023",
        //   y: 66,
        //   meta: {
        //     "24-30 aug": 2,
        //     "16-23 aug": 2,
        //     "1-7 aug": 1
        //   }
        // }
      ]
    }
  ],
  chart: {
    height: 350,
    type: "bar"
  },
  plotOptions: {
    bar: {
      // horizontal: true,
    }
  },
  colors: ["#00E396"],

  tooltip: {
    custom: (opts) => {
      const { seriesIndex, dataPointIndex, w } = opts;

      const meta = w.config.series[seriesIndex].data[dataPointIndex].meta;
      return Object.entries(meta)
        .map(([k, v]) => {
          return `
                <div>
                  ${k} - ${v}  
                </div>
              `;
        })
        .join("");
    }
  }
};

var chart = new ApexCharts(document.querySelector("#userchart"), options);
chart.render();

// recent-orders
var options1 = {

        // series: [
        //     @foreach($countryordersall as $countryvalue)
        //         '{{$countryvalue->totalcount}}',
        //     @endforeach
        //     ],

        // series: [44, 55],
        series: '{{$allseries}}',
        colors: ["#ffb822"], 


        chart: {
            
            type: 'donut',
          width: 300
        },
        dataLabels: {
            enabled: false
        },

        labels: '{{$alllabels}}',

        legend: {
            show: false,
        },
        fill: {
            type: 'gradient',
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        tooltip: {
    custom: function({ series, seriesIndex, dataPointIndex, w }) {
      return (
        // '<div class="arrow_box">' +
        // '<img style="margin: 10px" width="20" height="20" src="https://cdn.pixabay.com/photo/2020/12/29/10/07/coast-5870088_960_720.jpg">' +
        
        // "<span>" +
        w.globals.labels[seriesIndex] +
        ": " +
        series[seriesIndex] +
        "</span>" +
        "</div>"
      );
    }
  },
        plotOptions: {
            pie: {
                expandOnClick: false,
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '20px',
                            offsetY: -5
                        },
                        value: {
                            show: true,
                            fontSize: '16px',
                            color: undefined,
                            offsetY: +5,
                            formatter: function (val) {
                                return val
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            color: '#ffa500',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => {
                                    return a + b
                                }, 0)
                            }
                        }
                    }
                }
            }
        }
    };

    var chart1 = new ApexCharts(document.querySelector("#recent-orders"), options1);
    chart1.render();


    // USA State Chart
    var state = {
  series: [
    {
      data: [

     @foreach($ordersalldata as $valuedata)
        {
          x: '{{ $valuedata->state }}',
          y: {{ $valuedata->totalcount }}
        },
     @endforeach

         
      ]
    }
  ],
  chart: {
    type: "bar",
    height: 350
  },
  plotOptions: {
    bar: {
      horizontal: false,
      distributed: true
    }
  },
  dataLabels: {
    enabled: false
  },
 
  legend: {
    show: false
  }
};

var chart = new ApexCharts(document.querySelector("#locationchart1"), state);
chart.render();
 


 
 $(document).ready(function() {
      var options = {
        chart: {
          type: 'line',
          height: 350
        },
        series: [{
          name: 'Product Trend',
          data: {!! json_encode($totalOrders) !!},
        }],
        xaxis: {
          categories: {!! json_encode($dates) !!}, 
        },
        title: {
          text: 'Product Trends by Month'
        }
      };

      var chart = new ApexCharts(document.querySelector(".salechart-new"), options);
      chart.render();
    });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all elements with class "allButton"
        var allButtons = document.querySelectorAll(".allButton");
        
        // Add event listener to each button
        allButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the default action
                
                // Get the interval value from the data-value attribute of clicked button
                var interval = button.getAttribute("data-value");
                
                // Call the getData function with the interval value
                getData(interval);
            });
        });
    });


 function getData(interval) {

    switch(interval) {

     case 'daily':
      var options = {
        chart: {
          type: 'line',
          height: 350
        },
        series: [{
          name: 'Product Trend',
          data: {!! json_encode($totalOrders) !!},
        }],
        xaxis: {
          categories: {!! json_encode($dates) !!}, 
        },
        title: {
          text: 'Product Trends by Daily'
        }
      };

    break;  

    case 'Weekly':
              
    var options = {
        chart: {
          type: 'line',
          height: 350
        },
        series: [{
          name: 'Product Trend',
          data: {!! json_encode($totalOrders2) !!},
        }],
        xaxis: {
          categories: {!! json_encode($saledata2) !!}, 
        },
        title: {
          text: 'Product Trends by Weekly'
        }
      };

        break;
    case 'monthly':
        
        var options = {
            chart: {
              type: 'line',
              height: 350
            },
            series: [{
              name: 'Product Trend',
              data: {!! json_encode($totalOrders3) !!},
            }],
            xaxis: {
              categories: {!! json_encode($saledata3) !!}, 
            },
            title: {
              text: 'Product Trends by Monthly'
            }
          };


        break;
    case 'yearly':
           
            var options = {
            chart: {
              type: 'line',
              height: 350
            },
            series: [{
              name: 'Product Trend',
              data: {!! json_encode($totalOrders4) !!},
            }],
            xaxis: {
              categories: {!! json_encode($saledata4) !!}, 
            },
            title: {
              text: 'Product Trends by Yearly'
            }
          };

        break;
       // default:
       //  console.log('Unknown interval');


   }

      var chart = new ApexCharts(document.querySelector(".salechart-new"), options);
      chart.render();
    }


/// totalorders //////////

    var options = {
     series: {{$allseries}}, // Change the series to match your country values
      labels: {!! json_encode($labels) !!}, // Country names
      // series: {!! json_encode($labels) !!}, // Change the series to match your country values
      // labels: {!! json_encode($series) !!}, // Country names
      chart: {
        width: 380,
        type: 'donut',
      },
      plotOptions: {
        pie: {
          startAngle: -90,
          endAngle: 270
        }
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'gradient',
      },
      legend: {
        formatter: function(val, opts) {
          return val + " - " + opts.w.globals.series[opts.seriesIndex];
        }
      },
      // title: {
      //   text: 'Gradient Donut with custom Start-angle'
      // },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },
          legend: {
            position: 'bottom'
          }
        }
      }]
    };

    var chart = new ApexCharts(document.querySelector("#totalorders"), options);
    chart.render();

</script>

@endsection



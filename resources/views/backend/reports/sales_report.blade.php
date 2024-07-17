@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">

        <div class="align-items-center">

            <h1 class="h3">{{translate('Sales Report')}}</h1>

        </div>

    </div>

    <div class="card">

        <form class="" id="sort_customers" action="" method="GET">

            <div class="card-header row gutters-5">

                <div class="col-lg-2">

                    <div class="form-group mb-0">

                        <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="partner" >

                            <option value="">{{ translate('Select Partner') }}</option>

                            @foreach ($sellers as $key => $seller)

                                <option value="{{ $seller->user->partner_code }}"  {{ isset($partner) && $partner == $seller->user->partner_code ? 'selected' : '' }} >{{ $seller->user->name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="col-lg-2">

                    <div class="form-group mb-0">

                        <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="user_id" >

                            <option value="">{{ translate('Select customer') }}</option>

                            @foreach ($users as $key => $val)
                                
                                <option value="{{ $val->id }}"  {{ isset($user) && $user == $val->id ? 'selected' : '' }} >{{ $val->name }}</option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="col-lg-2">

                    <div class="form-group mb-0">

                        <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country_id" >

                            <option value="">{{ translate('Select your country') }}</option>

                            @foreach (get_active_countries() as $key => $country)

                            <option value="{{ str_replace(' ', '_' , $country->name)  }}" {{ isset($country_id) && $country_id == str_replace(' ', '_', $country->name) ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="col-lg-2">

                    <div class="form-group mb-0">

                        <input type="text" class="aiz-date-range form-control" @isset($date) value="{{ $date }}" @endisset name="date" placeholder="Filter by date" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">

                    </div>

                </div>

                <div class="col-auto">

                    <div class="form-group mb-0">

                        <button type="submit" class="btn btn-primary">Filter</button>

                    </div>

                </div>

                <div class="col-lg-2">

                    <div class="form-group mb-0">

                       <a href="{{route('sales_report_export.index')}}" class="btn btn-soft-danger">export</a>

                    </div>

                </div>    

            </div>

          
        </form>

        <div class="card-body">

            <table class="table aiz-table mb-0">

                <thead>

                    <tr>

                        <th data-breakpoints="md">#</th>

                        <th >{{translate('Order Code:')}}</th>

                        <th data-breakpoints="lg">{{translate('Num. of Products')}}</th>

                        <th data-breakpoints="md">{{translate('Customer')}}</th>

                        <th data-breakpoints="lg">{{translate('Country')}}</th>

                        <th data-breakpoints="md">{{translate('Seller')}}</th>

                        <th data-breakpoints="md">{{ translate('Amount') }}</th>

                        <th data-breakpoints="md">{{ translate('Delivery Status') }}</th>

                        <th data-breakpoints="lg">{{ translate('Payment method') }}</th>

                        <th data-breakpoints="md">{{ translate('Payment Status') }}</th>

                        <th data-breakpoints="lg">{{translate('Date')}}</th>

                    </tr>

                </thead>

                <tbody>
                   
                        @php
                          $name = null;
                        @endphp
                        @foreach ($orders as $key => $order)

                            @php
                               $address = json_decode($order->shipping_address)->country ;
                            @endphp

                            @if(isset($order->orderDetails[0]['product_referral_code']) && $order->orderDetails[0]['product_referral_code'] != null)

                                @php

                                    $name = DB::table('users')->where('partner_code', base64_decode($order->orderDetails[0]['product_referral_code']))->select('name','id')->first();
                       
                                @endphp

                            @endif


                            <tr>

                                <!-- @if (auth()->user()->can('delete_order')) -->

                                    <td>{{ $key + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>

                                <!-- @endif -->

                                <td>

                                    {{ $order->code }}

                                    @if ($order->viewed == 0)

                                        <span class="badge badge-inline badge-info">{{ translate('New') }}</span>

                                    @endif

                                    @if (addon_is_activated('pos_system') && $order->order_from == 'pos')

                                        <span class="badge badge-inline badge-danger">{{ translate('POS') }}</span>

                                    @endif

                                </td>

                                <td>

                                    {{ count($order->orderDetails) }}

                                </td>

                                <td>

                                    @if ($order->user != null)

                                        {{ $order->user->name }}

                                    @else

                                        Guest ({{ $order->guest_id }})

                                    @endif

                                </td>

                                <td> {{$address}} </td>

                                <td>    
                                    @if($name != null)

                                        {{$name->name}}

                                    @else
                                        @if ($order->shop)

                                            {{ $order->shop->name }}

                                        @else

                                            {{ translate('Inhouse Order') }}

                                        @endif
                                    @endif

                                </td>

                                <td>

                                    {{ single_price(($order->product_price > 0) ? $order->product_price : $order->grand_total) }}

                                </td>
                              
                                <td>

                                    {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}

                                </td>

                                <td>

                                    {{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}

                                </td>

                                <td>

                                    @if ($order->payment_status == 'paid')

                                        <span class="badge badge-inline badge-success">{{ translate('Paid') }}</span>

                                    @else

                                        <span class="badge badge-inline badge-danger">{{ translate('Unpaid') }}</span>

                                    @endif

                                </td>

                                <td>{{date('m-d-Y' , strtotime($order->created_at))}}</td>
                                {{-- <td class="text-right">

                                    @if (addon_is_activated('pos_system') && $order->order_from == 'pos')

                                        <a class="btn btn-soft-success btn-icon btn-circle btn-sm"

                                            href="{{ route('admin.invoice.thermal_printer', $order->id) }}" target="_blank"

                                            title="{{ translate('Thermal Printer') }}">

                                            <i class="las la-print"></i>

                                        </a>

                                    @endif

                                    @can('view_order_details')

                                        @php

                                            $order_detail_route = route('orders.show', encrypt($order->id));

                                            if (Route::currentRouteName() == 'seller_orders.index') {

                                                $order_detail_route = route('seller_orders.show', encrypt($order->id));

                                            } elseif (Route::currentRouteName() == 'pick_up_point.index') {

                                                $order_detail_route = route('pick_up_point.order_show', encrypt($order->id));

                                            }

                                            if (Route::currentRouteName() == 'inhouse_orders.index') {

                                                $order_detail_route = route('inhouse_orders.show', encrypt($order->id));

                                            }

                                        @endphp

                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"

                                            href="{{ $order_detail_route }}" title="{{ translate('View') }}">

                                            <i class="las la-eye"></i>

                                        </a>

                                    @endcan

                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm"

                                        href="{{ route('invoice.download', $order->id) }}"

                                        title="{{ translate('Download Invoice') }}">

                                        <i class="las la-download"></i>

                                    </a>

                                    @can('delete_order')

                                        <a href="#"

                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"

                                            data-href="{{ route('orders.destroy', $order->id) }}"

                                            title="{{ translate('Delete') }}">

                                            <i class="las la-trash"></i>

                                        </a>

                                    @endcan

                                </td> --}}

                            </tr>

                        @endforeach

                    </tbody>

            </table>

            <div class="aiz-pagination">

            {{ $orders->appends(request()->input())->links() }}

            </div>

        </div>

        
    </div>

@endsection

@extends('backend.layouts.app')



@section('content')

    <div class="card">

        <form class="" action="{{ route('service_sales_report.index') }}" id="sort_orders" method="GET">

            <div class="card-header row gutters-5">

                <div class="col">

                    <h5 class="mb-md-0 h6">{{ translate('All Orders') }}</h5>

                </div>

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

               {{-- <div class="col-lg-2">

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

                </div> --}}

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

                       <a href="{{route('service_sales_report_export.index')}}" class="btn btn-soft-danger">export</a>

                    </div>

                </div>

            </div>



            <div class="card-body">

                <table class="table aiz-table mb-0">

                    <thead>

                        <tr>

                            <!--<th>#</th>-->

                            @if (auth()->user()->can('delete_order'))

                                <th>

                                    <div class="form-group">

                                        <div class="aiz-checkbox-inline">

                                            <label class="aiz-checkbox">

                                                <input type="checkbox" class="check-all">

                                                <span class="aiz-square-check"></span>

                                            </label>

                                        </div>

                                    </div>

                                </th>

                            @else

                                <th data-breakpoints="lg">#</th>

                            @endif



                            <th>{{ translate('Order Code') }}</th>

                            <th data-breakpoints="md">{{ translate('Num. of Products') }}</th>

                            <th data-breakpoints="md">{{ translate('Customer') }}</th>

                            <th data-breakpoints="md">{{ ($seller_type != null) ? translate('Selling Partner') : translate('Seller') }}</th>

                            <th data-breakpoints="md">{{ translate('Amount') }}</th>

                            @if($seller_type != null)

                             <th data-breakpoints="md">{{ translate('Commission Amount') }}</th>

                            @endif

                            <th data-breakpoints="md">{{ translate('Status') }}</th>

                            <th data-breakpoints="md">{{ translate('Payment method') }}</th>

                            <th data-breakpoints="md">{{ translate('Payment Status') }}</th>

                            @if (addon_is_activated('refund_request'))

                                <th>{{ translate('Refund') }}</th>

                            @endif

                            <th class="text-right" width="15%">{{ translate('options') }}</th>

                        </tr>

                    </thead>

                    <tbody>
                        
                        @php
                         $name = null;
                        @endphp
                        @foreach ($orders as $key => $order)

                            @php
                                 $related = App\Models\Order::where('code' , $order->order_id)->first();  
                                
                                 if(isset($related->orderDetails[0]['product_referral_code']) && $related->orderDetails[0]['product_referral_code'] != null && $seller_type != null){

                                     $name = DB::table('users')->where('partner_code', base64_decode($related->orderDetails[0]['product_referral_code']))->select('name','id')->first();

                                 }
                                 
                            @endphp

                            <tr>

                                @if (auth()->user()->can('delete_order'))

                                    <td>

                                        <div class="form-group">

                                            <div class="aiz-checkbox-inline">

                                                <label class="aiz-checkbox">

                                                    <input type="checkbox" class="check-one" name="id[]"

                                                        value="{{ $order->id }}">

                                                    <span class="aiz-square-check"></span>

                                                </label>

                                            </div>

                                        </div>

                                    </td>

                                @else

                                    <td>{{ $key + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>

                                @endif

                                <td>

                                    {{ $order->order_id }}

                                    {{-- @if ($order->viewed == 0)

                                        <span class="badge badge-inline badge-info">{{ translate('New') }}</span>

                                    @endif --}}

                                    {{-- @if (addon_is_activated('pos_system') && $order->order_from == 'pos')

                                        <span class="badge badge-inline badge-danger">{{ translate('POS') }}</span>

                                    @endif --}}

                                </td>

                                <td>

                                    @php
                                        $detail = json_decode($order->camera_detail); 
                                        $count = 0;
                                        
                                        foreach ($detail as $key => $value) {
                                            if ($value->qty > 0) {
                                                $count++;
                                            }
                                        }
                                        echo $count;
                                    @endphp

                                </td>

                                <td>
                                    @if(isset($related->user))

                                        @if ($related->user != null)

                                            {{ $related->user->name }}

                                        @else

                                            Guest ({{ $related->guest_id }})

                                        @endif

                                    @else

                                         Guest

                                    @endif
                                </td>

                                <td>    
                                    @if($name != null)

                                        {{$name->name}}

                                    @else

                                        @if(isset($related->user))

                                            @if ($related->shop)

                                                {{ $related->shop->name }}

                                            @else

                                                {{ translate('Inhouse Order') }}

                                            @endif

                                        @else
                                                {{ translate('Inhouse Order') }}
                                        @endif

                                    @endif

                                </td>

                                <td>

                                    {{ single_price($order->amount) }}

                                </td>

                                @if($seller_type != null)
                                    <td>

                                        {{ single_price( get_total_service_commission($name->id,$order->amount)) }}

                                    </td>
                                @endif

                                <td>
                                    @if($order->payment_status == 2)
                                    {{ translate('Active') }}
                                    @else
                                    {{ translate('Inactive') }}
                                    @endif
                                </td>

                                <td>
                                    @if(isset($related->payment_type))
                                     {{ translate(ucfirst(str_replace('_', ' ', $related->payment_type))) }}
                                    @endif
                                </td>

                                <td>
                                @if(isset($related->payment_status))
                                    @if ($related->payment_status == 'paid')

                                        <span class="badge badge-inline badge-success">{{ translate('Paid') }}</span>

                                    @else

                                        <span class="badge badge-inline badge-danger">{{ translate('Unpaid') }}</span>

                                    @endif
                                @else

                                    <span class="badge badge-inline badge-danger">{{ translate('Unpaid') }}</span>

                                @endif

                                </td>

                                {{-- @if (addon_is_activated('refund_request'))

                                    <td>

                                        @if (count($order->refund_requests) > 0)

                                            {{ count($order->refund_requests) }} {{ translate('Refund') }}

                                        @else

                                            {{ translate('No Refund') }}

                                        @endif

                                    </td>

                                @endif --}}

                                <td class="text-right">

                                    @if (addon_is_activated('pos_system') && $related->order_from == 'pos')

                                        <a class="btn btn-soft-success btn-icon btn-circle btn-sm"

                                            href="{{ route('admin.invoice.thermal_printer', $order->id) }}" target="_blank"

                                            title="{{ translate('Thermal Printer') }}">

                                            <i class="las la-print"></i>

                                        </a>

                                    @endif

                                    @can('view_order_details')

                                        @php

                                            $order_detail_route = route('orders.show', encrypt($order->id));

                                            if (Route::currentRouteName() == 'seller_service_orders.index') {

                                                $order_detail_route = route('seller_service_orders.show', encrypt($order->id));

                                            } elseif (Route::currentRouteName() == 'pick_up_point.index') {

                                                $order_detail_route = route('pick_up_point.order_show', encrypt($order->id));

                                            }

                                            if (Route::currentRouteName() == 'inhouse_orders.index') {

                                                $order_detail_route = route('inhouse_orders.show', encrypt($order->id));

                                            }

                                            if (Route::currentRouteName() == 'all_service_orders.index') {

                                                 $order_detail_route = route('all_service_orders.show', encrypt($order->id));

                                            }

                                        @endphp

                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"

                                            href="{{ $order_detail_route }}" title="{{ translate('View') }}">

                                            <i class="las la-eye"></i>

                                        </a>

                                    @endcan

                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm"

                                        href="{{ route('service_invoice.download', $order->id) }}"

                                        title="{{ translate('Download Invoice') }}">

                                        <i class="las la-download"></i>

                                    </a>

                                    @can('delete_order')

                                        <a href="#"

                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"

                                            data-href="{{ route('service-orders.destroy', $order->id) }}"

                                            title="{{ translate('Delete') }}">

                                            <i class="las la-trash"></i>

                                        </a>

                                    @endcan

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>



                <div class="aiz-pagination">

                    {{ $orders->appends(request()->input())->links() }}

                </div>



            </div>

        </form>

    </div>

@endsection








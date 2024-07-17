@extends('seller.layouts.app')



@section('panel_content')


    <div class="card">

        <form id="sort_orders" action="" method="GET">

            <div class="card-header row gutters-5">

                <div class="col text-center text-md-left">

                    <h5 class="mb-md-0 h6">{{ translate('Orders') }}</h5>

                </div>

                <div class="col-md-3 ml-auto">

                    <select class="form-control aiz-selectpicker"

                        data-placeholder="{{ translate('Filter by Payment Status') }}" name="payment_status"

                        onchange="sort_orders()">

                        <option value="">{{ translate('Filter by Payment Status') }}</option>

                        <option value="paid"

                            @isset($payment_status) @if ($payment_status == 'paid') selected @endif @endisset>

                            {{ translate('Paid') }}</option>

                        <option value="unpaid"

                            @isset($payment_status) @if ($payment_status == 'unpaid') selected @endif @endisset>

                            {{ translate('Unpaid') }}</option>

                    </select>

                </div>



                <div class="col-md-3 ml-auto">

                    <select class="form-control aiz-selectpicker"

                        data-placeholder="{{ translate('Filter by Payment Status') }}" name="delivery_status"

                        onchange="sort_orders()">

                        <option value="">{{ translate('Filter by Deliver Status') }}</option>

                        <option value="pending"

                            @isset($delivery_status) @if ($delivery_status == 'pending') selected @endif @endisset>

                            {{ translate('Pending') }}</option>

                        <option value="confirmed"

                            @isset($delivery_status) @if ($delivery_status == 'confirmed') selected @endif @endisset>

                            {{ translate('Confirmed') }}</option>

                        <option value="on_the_way"

                            @isset($delivery_status) @if ($delivery_status == 'on_the_way') selected @endif @endisset>

                            {{ translate('On The Way') }}</option>

                        <option value="delivered"

                            @isset($delivery_status) @if ($delivery_status == 'delivered') selected @endif @endisset>

                            {{ translate('Delivered') }}</option>

                    </select>

                </div>

                <div class="col-md-3">

                    <div class="from-group mb-0">

                        <input type="text" class="form-control" id="search" name="search"

                            @isset($sort_search) value="{{ $sort_search }}" @endisset

                            placeholder="{{ translate('Type Order code & hit Enter') }}">

                    </div>

                </div>

            </div>

        </form> 

        {{-- @dd($orders) --}}

        @if (count($orders) > 0)

            <div class="card-body p-3">

                <table class="table aiz-table mb-0">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>{{ translate('Order Code') }}</th>

                            <th data-breakpoints="md">{{ translate('Num. of Products') }}</th>

                            <th data-breakpoints="md">{{ translate('Amount') }}</th>

                            <th data-breakpoints="md">{{ translate('Commission Amount') }}</th>

                            <th>{{ translate('Payment Status') }}</th>

                            <th class="text-right">{{ translate('Options') }}</th>

                        </tr>

                    </thead>

                    <tbody>


                        @foreach ($orders as $key => $order)
                       
                            @if ($order != null)

                                <tr>

                                    <td>

                                        {{ $key + 1 }}

                                    </td>

                                    <td>

                                        {{$order->order_id}}
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

                                        {{ single_price($order->amount) }}

                                    </td>

                                    <td>
                                        {{ single_price( get_total_service_commission(Auth::user()->id,$order->amount)) }}
                                    </td>

                                    <td>
                                        
                                        @if ($order->payment_status == 2)

                                            <span class="badge badge-inline badge-success">{{ translate('Paid') }}</span>

                                        @else

                                            <span class="badge badge-inline badge-danger">{{ translate('Unpaid') }}</span>

                                        @endif

                                    </td>

                                    <td class="text-right">

                                        <a href="{{ route('seller.service.service_show', encrypt($order->id)) }}"

                                            class="btn btn-soft-info btn-icon btn-circle btn-sm"

                                            title="{{ translate('Order Details') }}">

                                            <i class="las la-eye"></i>

                                        </a>

                                        {{-- <a href="{{ route('seller.invoice.download', $order->id) }}"

                                            class="btn btn-soft-warning btn-icon btn-circle btn-sm"

                                            title="{{ translate('Download Invoice') }}">

                                            <i class="las la-download"></i>

                                        </a> --}}

                                    </td>

                                </tr>

                            @endif
                            
                        @endforeach

                    </tbody>

                </table>

                <div class="aiz-pagination">

                    {{ $orders->links() }}

                </div>

            </div>

        @endif

    </div>



@endsection



@section('script')

    <script type="text/javascript">

        function sort_orders(el) {

            $('#sort_orders').submit();

        }

    </script>

@endsection


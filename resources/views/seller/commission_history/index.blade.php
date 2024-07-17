@extends('seller.layouts.app')



@section('panel_content')

    <div class="card">

        <form class="" action="" id="sort_commission_history" method="GET">

            <div class="card-header row gutters-5">

                <div class="col">

                    <h5 class="mb-md-0 h6">{{ translate('Commission History') }}</h5>

                </div>

                <div class="col-lg-2">

                    <div class="form-group mb-0">

                        <input type="text" class="form-control form-control-sm aiz-date-range" id="search" name="date_range"@isset($date_range) value="{{ $date_range }}" @endisset placeholder="{{ translate('Daterange') }}" autocomplete="off">

                    </div>

                </div>

                <div class="col-auto">

                    <div class="form-group mb-0">

                        <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>

                    </div>

                </div>

            </div>

        </form>

        <div class="card-body">

            <table class="table aiz-table mb-0">

                <thead>

                    <tr>

                        <th>#</th>

                        <th data-breakpoints="lg">{{ translate('Order Code') }}</th>

                        <!-- <th>{{ translate('Admin Commission') }}</th> -->

                        <th>{{ translate('Amount') }}</th>

                        <th>{{ translate('Residual Commission') }}</th>

                        <th>{{ translate('Product Commission') }}</th>

                        <th>{{ translate('Total Earning') }}</th>

                        <th data-breakpoints="lg">{{ translate('Created At') }}</th>

                    </tr>

                </thead>

                <tbody>
                    
                    @foreach ($orders as $key => $order_id)
                    
                        @php

                           $history = \App\Models\Order::find($order_id->id);

                           $service_order = DB::table('cloude_service')->where('order_id' , $history->code)->first();

                            if(isset($service_order->amount) && $service_order->amount != null ){

                                $service = $service_order->amount;

                            }else{

                                $service = 0;
                            }
                        @endphp

                    <tr>

                        <td>{{ ($key+1) }}</td>

                        <td>

                            @if(isset($history->code))

                                {{ $history->code }}

                            @else

                                <span class="badge badge-inline badge-danger">

                                    {{ translate('Order Deleted') }}

                                </span>

                            @endif

                        </td>

                        <td> {{ single_price($history->grand_total) }} </td>

                        <td>
                             @if($service != 0)

                                 {{ single_price(get_total_service_commission(Auth::user()->id,$service) )}}
                                 
                             @else

                                 {{ single_price($service)}}
                                 
                             @endif
                        </td>

                        <td> {{ single_price( get_total_order_commission(Auth::user()->id,($history->product_price > 0) ? $history->product_price : $history->grand_total))}}</td>

                        <td>
                            @if($service != 0)

                                {{ single_price(intval(get_total_service_commission(Auth::user()->id,$service)) + intval(get_total_order_commission(Auth::user()->id,($history->product_price > 0) ? $history->product_price : $history->grand_total))) }}

                            @else

                                {{ single_price($service + intval(get_total_order_commission(Auth::user()->id,($history->product_price > 0) ? $history->product_price : $history->grand_total))) }}
                                
                            @endif
                        </td>

                        <td> {{ $history->created_at }}</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            <div class="aiz-pagination mt-4">

                {{ $orders->links() }}

            </div>

        </div>

    </div>

@endsection



@section('script')

<script type="text/javascript">

    function sort_commission_history(el){

        $('#sort_commission_history').submit();

    }

</script>

@endsection


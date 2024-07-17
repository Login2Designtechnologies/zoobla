@extends('frontend.layouts.user_panel')

<style>
    .footable-empty {
    display: none;
}
</style>
{{-- @dd($service); --}}

@section('panel_content')

    <div class="card shadow-none rounded-0 border">

        <div class="card-header border-bottom-0">

            <h5 class="mb-0 fs-20 fw-700 text-dark">{{ translate('Service History') }}</h5>

        </div>

        <div class="card-body">

            <table class="table aiz-table mb-0">

                <thead class="text-gray fs-12">

                    <tr>

                        <th class="pl-0">{{ translate('Subscription')}}</th>

                        <th data-breakpoints="md">{{ translate('Status')}}</th>

                        <th>{{ translate('Next payment')}}</th>

                        <th data-breakpoints="md">{{ translate('Total')}}</th>

                        <th class="text-right pr-0">{{ translate('Options')}}</th>

                    </tr>

                </thead>

                <tbody class="fs-14">

                  @if($service->isNotEmpty())
                        <?php
                        $i = 1;
                        ?>
                        @foreach ($service as $key => $order)

                        {{-- @dd($order); --}}
                           <?php
                                $renew_date = null;

                                $today = new DateTime(); 
                                
                                if ($order->expired_date == null){
                                    
                                    if ($order->renew_date != null) {
                                        $create_date = date('Y-m-d H:i:s', $order->renew_date);
                                    } else {
                                        $create_date = $order->created_at;
                                    }

                                    $next_payment = (new DateTime($create_date))->modify("+" . $order->storage_duration . " days");
                                
                                    $renew_date = $next_payment->format('F j, Y') ;

                                }else{

                                    $renew_date = date('F j, Y', strtotime($order->expired_date)) ;
                                }

                            ?>
                                <tr>

                                    <!-- Code -->

                                    <td class="pl-0">
                                      
                                        <a href="{{route('service-detail', encrypt($order->id))}}">#{{  $i }}</a>

                                    </td>
                                    
                                    <!-- Payment Status -->

                                    <td>

                                        @if ($order->payment_status == 2)

                                            @if($next_payment > $today)

                                                <span class="badge badge-inline badge-success p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{translate('Paid')}}</span>

                                            @else

                                                <span class="badge badge-inline badge-danger p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{translate('Unpaid')}}</span>

                                            @endif
                                        @else

                                            <span class="badge badge-inline badge-danger p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{translate('Unpaid')}}</span>

                                        @endif

                                        {{-- @if($order->payment_status_viewed == 0)

                                            <span class="ml-2" style="color:green"><strong>*</strong></span>

                                        @endif --}}

                                    </td>

                                    <!-- Date -->
                                        
                                    <td class="text-secondary">
                                        @if ($renew_date != null)
                                            {{$renew_date}}
                                        @else
                                            --
                                        @endif

                                    </td>

                                    <!-- Amount -->

                                    <td class="fw-700">

                                        {{ single_price($order->amount) }}

                                    </td>

                               

                                    <!-- Options -->

                                    <td class="text-right pr-0">

                                        <!-- Details -->
                                        {{--  --}}
                                        <a href="{{route('service-detail', encrypt($order->id))}}" class="btn btn-soft-info btn-icon btn-circle btn-sm hov-svg-white mt-2 mt-sm-0" title="{{ translate('Order Details') }}">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10">

                                                <g id="Group_24807" data-name="Group 24807" transform="translate(-1339 -422)">

                                                    <rect id="Rectangle_18658" data-name="Rectangle 18658" width="12" height="1" transform="translate(1339 422)" fill="#3490f3"/>

                                                    <rect id="Rectangle_18659" data-name="Rectangle 18659" width="12" height="1" transform="translate(1339 425)" fill="#3490f3"/>

                                                    <rect id="Rectangle_18660" data-name="Rectangle 18660" width="12" height="1" transform="translate(1339 428)" fill="#3490f3"/>

                                                    <rect id="Rectangle_18661" data-name="Rectangle 18661" width="12" height="1" transform="translate(1339 431)" fill="#3490f3"/>

                                                </g>

                                            </svg>

                                        </a>

                                    </td>

                                </tr>
                            <?php
                            $i++;
                            ?>  
                        @endforeach

                    @else
                      
                      <p class="text-center">Nothing found</p>
                      
                  @endif

                </tbody>

            </table>

            <!-- Pagination -->

            <div class="aiz-pagination mt-2">

                {{ $service->links() }}

            </div>

        </div>

    </div>

@endsection



@section('modal')

    <!-- Delete modal -->

    @include('modals.delete_modal')



@endsection




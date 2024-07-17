@extends('frontend.layouts.user_panel')



@section('panel_content')

<style>
    .footable-empty {
        display:none;
    }
</style>
    <!-- Order id -->

    <div class="aiz-titlebar mb-4">

        <div class="row align-items-center">

            <div class="col-md-6">

                <h1 class="fs-20 fw-700 text-dark">{{ translate('Order id') }}: {{ $order->id }}</h1>

            </div>

        </div>

    </div>



    <!-- Order Summary -->

    <div class="card rounded-0 shadow-none border mb-4">

        <div class="card-header border-bottom-0">

            <h5 class="fs-16 fw-700 text-dark mb-0">{{ translate('Order Summary') }}</h5>

        </div>

        <div class="card-body">

            <div class="row">



                <div class="col-lg-6">

                    <table class="table-borderless table">

                        <tr>

                            <td class="w-50 fw-600">{{ translate('Order Id') }}:</td>

                            <td>{{ $order->order_id }}</td>

                        </tr>

                         <tr>

                            <td class="w-50 fw-600">{{ translate('Customer') }}:</td>

                            <td>{{ json_decode($info->shipping_address)->name }}</td>

                        </tr> 

                         <tr>

                            <td class="w-50 fw-600">{{ translate('Email') }}:</td>

                            @if ($info->user_id != null)

                                <td>{{ $info->user->email }}</td>

                            @endif

                        </tr>

                        <tr>

                            <td class="w-50 fw-600">{{ translate('Shipping address') }}:</td>

                            <td>{{ json_decode($info->shipping_address)->address }},

                                {{ json_decode($info->shipping_address)->city }},

                                @if(isset(json_decode($info->shipping_address)->state)) {{ json_decode($info->shipping_address)->state }} - @endif

                                {{ json_decode($info->shipping_address)->postal_code }},

                                {{ json_decode($info->shipping_address)->country }}

                            </td>

                        </tr> 

                    </table>

                </div>

                <div class="col-lg-6">

                    <table class="table-borderless table">

                        <tr>

                            <td class="w-50 fw-600">{{ translate('Order date') }}:</td>

                            <td>{{ date('m-d-Y H:i A', strtotime($order->created_at)) }}</td>

                        </tr>

                        <tr>

                            <td class="w-50 fw-600">{{ translate('Total order amount') }}:</td>

                            <td>{{ single_price($order->amount) }}

                            </td>

                        </tr>

                        <tr>

                            <td class="w-50 fw-600">{{ translate('Shipping method') }}:</td>

                            <td>{{ translate('Flat shipping rate') }}</td>

                        </tr>

                        <tr>

                            <td class="w-50 fw-600">{{ translate('Payment method') }}:</td>

                            <td>{{ translate(ucfirst(str_replace('_', ' ', $info->payment_type))) }}</td>

                        </tr> 

                        <tr>

                            <td class="w-50 fw-600">{{ translate('Next payment') }}:</td>

                            <td>   
                                @if($order->expired_date == null)
                                    @php
                                        if ($order->renew_date != null) {
                                            $create_date = date('Y-m-d H:i:s', $order->renew_date);
                                        } else {
                                            $create_date = $order->created_at;
                                        }
                                       
                                    $next_payment = (new DateTime($create_date))->modify("+" . $order->storage_duration . " days");
                                    
                                    @endphp
                                
                                    {{ $next_payment->format('F j, Y') }}
                            

                                @else

                                    {{ date('F, j, Y' , strtotime($order->expired_date))}}

                                @endif
                            </td>

                        </tr>

                        
                        <tr>

                            <td class="w-50 fw-600">{{ translate('Order status') }}:</td>

                            <td>
                                <?php
                                    
                                    $today = new DateTime(); 

                                    if ($next_payment < $today) {
                                        $badgeClass = 'badge-danger';
                                        $badgeText = 'Renew';
                                        DB::table('cloude_service')->where('id' ,$order->id)->update(['payment_status' => 1]);
                                    } else {
                                        $badgeClass = 'badge-success';
                                        $badgeText = 'Active';
                                    }

                                ?>
                                @if ($order->order_status == 2)

                                    <span class="badge badge-inline <?php echo $badgeClass; ?>  fs-122" style="border-radius: 25px; min-width: 80px !important;">
                                    
                                        @if($badgeText == 'Renew')
                                            <?php
                                            DB::table('cloude_service')->where('id' ,$order->id)->update(['order_status' => 1]);
                                            ?>
                                            <a href="{{route('renew' , encrypt($order->id))}}"> ReNew</a>
                                        @else

                                        <?php  echo translate($badgeText); ?>

                                        @endif
                                    </span>


                                @else
                                  <span class="badge badge-inline <?php echo $badgeClass; ?>  fs-121" style="border-radius: 25px; min-width: 80px !important;">
                                    <a href="{{route('renew' , encrypt($order->id))}}"> ReNew </a>
                                  </span>
                                @endif
                            </td> 
                                
                        </tr> 
                 

                    </table>

                </div>

            </div>

        </div>

    </div>



    <!-- Order Details -->

    <div class="row gutters-16">

        <div class="col-md-9">

            <div class="card rounded-0 shadow-none border mt-2 mb-4">

                <div class="card-header border-bottom-0">

                    <h5 class="fs-16 fw-700 text-dark mb-0">{{ translate('Order Details') }}</h5>

                </div>

                <div class="card-body table-responsive">

                    <table class="aiz-table table">

                        <thead class="text-gray fs-12">

                            <tr>

                                <th class="pl-0">#</th>

                                <th width="30%">{{ translate('Service Name') }}</th>

                                <th data-breakpoints="md">{{ translate('Shipping') }}</th>

                                <th>{{ translate('Quantity') }}</th>

                                <th data-breakpoints="md">{{ translate('Price') }}</th>

                                <th>{{ translate('Total') }}</th>

                            </tr>

                        </thead>

                        <tbody class="fs-14">

                            @php
                                $i = 1;
                            @endphp
                            
                            @foreach (json_decode($order->camera_detail)  as $key => $orderDetail)

                                @if($orderDetail->qty == 0)

                                    @continue

                                @endif

                                <tr>

                                    <td>{{  $i }}</td>

                                    <td>

                                        @if ($orderDetail->cam_name != null)

                                            {{$orderDetail->cam_name}}

                                        @else

                                            <strong>{{ translate('N/A') }}</strong>

                                        @endif

                                    </td>

                                    <td>

                                           Free shipping

                                    </td>

                                    <td class="text-center">{{ $orderDetail->qty}}</td>

                                    <td class="text-center">

                                        {{ single_price($orderDetail->cam_price) }}</td>

                                    <td class="text-center">{{ single_price($orderDetail->cam_price * $orderDetail->qty) }}</td>

                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>



        <!-- Order Ammount -->

        <div class="col-md-3">

            <div class="card rounded-0 shadow-none border mt-2">

                <div class="card-header border-bottom-0">

                    <b class="fs-16 fw-700 text-dark">{{ translate('Order Ammount') }}</b>

                </div>

                <div class="card-body pb-0">

                    <table class="table-borderless table">

                        <tbody>

                            <tr>

                                <td class="w-50 fw-600">{{ translate('Subtotal') }}</td>

                                <td class="text-right">

                                    <span class="strong-600"> {{ single_price($order->amount) }}</span>

                                </td>

                            </tr>

                            {{-- <tr>

                                <td class="w-50 fw-600">{{ translate('Shipping') }}</td>

                                <td class="text-right">

                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>

                                </td>

                            </tr> --}}

                            <tr>

                                <td class="w-50 fw-600">{{ translate('Tax') }}</td>

                                <td class="text-right">

                                    {{-- <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span> --}}
                                    <span class="text-italic">{{ single_price(0) }}</span>

                                </td>

                            </tr>

                            <tr>

                                <td class="w-50 fw-600">{{ translate('Coupon') }}</td>

                                <td class="text-right">

                                    <span class="text-italic">{{ single_price($info->coupon_discount) }}</span>

                                </td>

                            </tr>

                            <tr>

                                <td class="w-50 fw-600">{{ translate('Total') }}</td>

                                <td class="text-right">

                                    <strong>{{ single_price($order->amount) }}</strong>

                                </td>

                            </tr>

                        </tbody> 

                    </table>

                </div>

            </div>

            {{-- @if ($order->manual_payment && $order->manual_payment_data == null)

                <button onclick="show_make_payment_modal({{ $order->id }})"

                    class="btn btn-block btn-primary">{{ translate('Make Payment') }}</button>

            @endif --}}

        </div>

    </div>

@endsection



@section('modal')

    <!-- Product Review Modal -->

    <div class="modal fade" id="product-review-modal">

        <div class="modal-dialog">

            <div class="modal-content" id="product-review-modal-content">



            </div>

        </div>

    </div>



    <!-- Payment Modal -->

    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

            <div class="modal-content">

                <div id="payment_modal_body">



                </div>

            </div>

        </div>

    </div>

@endsection





@section('script')

    <script type="text/javascript">

        function show_make_payment_modal(order_id) {

            $.post('{{ route('checkout.make_payment') }}', {

                _token: '{{ csrf_token() }}',

                order_id: order_id

            }, function(data) {

                $('#payment_modal_body').html(data);

                $('#payment_modal').modal('show');

                $('input[name=order_id]').val(order_id);

            });

        }



        function product_review(product_id) {

            $.post('{{ route('product_review_modal') }}', {

                _token: '{{ @csrf_token() }}',

                product_id: product_id

            }, function(data) {

                $('#product-review-modal-content').html(data);

                $('#product-review-modal').modal('show', {

                    backdrop: 'static'

                });

                AIZ.extra.inputRating();

            });

        }

    </script>

@endsection


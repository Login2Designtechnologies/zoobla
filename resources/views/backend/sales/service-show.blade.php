@extends('backend.layouts.app')

@section('content')

    <div class="card">

        <div class="card-header">

            <h1 class="h2 fs-16 mb-0">{{ translate('Order Details') }}</h1>

        </div>

        <div class="card-body">

            <div class="row gutters-5">

                <div class="col text-md-left text-center">

                </div>

                @php

                    $delivery_status = $info->delivery_status;

                    $payment_status = $info->payment_status;

                    $admin_user_id = App\Models\User::where('user_type', 'admin')->first()->id;

                @endphp


                <!--Assign Delivery Boy-->
                @if ($info->seller_id == $admin_user_id || get_setting('product_manage_by_admin') == 1)
                    
                    @if (addon_is_activated('delivery_boy'))

                        <div class="col-md-3 ml-auto">

                            <label for="assign_deliver_boy">{{ translate('Assign Deliver Boy') }}</label>

                            @if (($delivery_status == 'pending' || $delivery_status == 'confirmed' || $delivery_status == 'picked_up') && auth()->user()->can('assign_delivery_boy_for_orders'))

                                <select class="form-control aiz-selectpicker" data-live-search="true"

                                    data-minimum-results-for-search="Infinity" id="assign_deliver_boy">

                                    <option value="">{{ translate('Select Delivery Boy') }}</option>

                                    @foreach ($delivery_boys as $delivery_boy)

                                        <option value="{{ $delivery_boy->id }}"

                                            @if ($order->assign_delivery_boy == $delivery_boy->id) selected @endif>

                                            {{ $delivery_boy->name }}

                                        </option>

                                    @endforeach

                                </select>

                            @else

                                <input type="text" class="form-control" value="{{ optional($order->delivery_boy)->name }}"

                                    disabled>

                            @endif

                        </div>

                    @endif


                    <div class="col-md-3 ml-auto">

                        <label for="update_payment_status">{{ translate('Payment Status') }}</label>

                        @if (auth()->user()->can('update_order_payment_status'))

                            <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"

                                id="update_payment_status">

                                <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>

                                    {{ translate('Unpaid') }}

                                </option>

                                <option value="paid" @if ($payment_status == 'paid') selected @endif>

                                    {{ translate('Paid') }}

                                </option>

                            </select>

                        @else

                            <input type="text" class="form-control" value="{{ $payment_status }}" disabled>

                        @endif

                    </div>

                    <div class="col-md-3 ml-auto">

                        <label for="update_delivery_status">{{ translate('Delivery Status') }}</label>

                        @if (auth()->user()->can('update_order_delivery_status') && $delivery_status != 'delivered' && $delivery_status != 'cancelled')

                            <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"

                                id="update_delivery_status">

                                <option value="pending" @if ($delivery_status == 'pending') selected @endif>

                                    {{ translate('Pending') }}

                                </option>

                                <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>

                                    {{ translate('Confirmed') }}

                                </option>

                                <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>

                                    {{ translate('Picked Up') }}

                                </option>

                                <option value="on_the_way" @if ($delivery_status == 'on_the_way') selected @endif>

                                    {{ translate('On The Way') }}

                                </option>

                                <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>

                                    {{ translate('Delivered') }}

                                </option>

                                <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>

                                    {{ translate('Cancel') }}

                                </option>

                            </select>

                        @else

                            <input type="text" class="form-control" value="{{ $delivery_status }}" disabled>

                        @endif

                    </div>

                    {{-- <div class="col-md-3 ml-auto">
                        <label for="update_tracking_code">
                            {{ translate('Tracking Code (optional)') }}
                        </label>
                        <input type="text" class="form-control" id="update_tracking_code"
                            value="{{ $order->tracking_code }}">
                    </div> --}}
                @endif
            </div>
            <div class="mb-3">

                @php
                    $removedXML = '<?xml version="1.0" encoding="UTF-8"?>';
                @endphp

                {!! str_replace($removedXML, '', QrCode::size(100)->generate($order->id)) !!}
            </div>

            <div class="row gutters-5">

                <div class="col text-md-left text-center">

                    @if(json_decode($info->shipping_address))

                        <address>

                            <strong class="text-main">

                                {{ json_decode($info->shipping_address)->name }}

                            </strong><br>

                            {{ json_decode($info->shipping_address)->email }}<br>

                            {{ json_decode($info->shipping_address)->phone }}<br>

                            {{ json_decode($info->shipping_address)->address }}, {{ json_decode($info->shipping_address)->city }}, @if(isset(json_decode($info->shipping_address)->state)) {{ json_decode($info->shipping_address)->state }} - @endif {{ json_decode($info->shipping_address)->postal_code }}<br>

                            {{ json_decode($info->shipping_address)->country }}

                        </address>

                    @else

                        <address>

                            <strong class="text-main">

                                {{ $info->user->name }}

                            </strong><br>

                            {{ $info->user->email }}<br>

                            {{ $info->user->phone }}<br>

                        </address>

                    @endif

                    @if ($info->manual_payment && is_array(json_decode($info->manual_payment_data, true)))

                        <br>

                        <strong class="text-main">{{ translate('Payment Information') }}</strong><br>

                        {{ translate('Name') }}: {{ json_decode($info->manual_payment_data)->name }},

                        {{ translate('Amount') }}:

                        {{ single_price(json_decode($info->manual_payment_data)->amount) }},

                        {{ translate('TRX ID') }}: {{ json_decode($info->manual_payment_data)->trx_id }}

                        <br>

                        <a href="{{ uploaded_asset(json_decode($info->manual_payment_data)->photo) }}" target="_blank">

                            <img src="{{ uploaded_asset(json_decode($info->manual_payment_data)->photo) }}" alt=""

                                height="100">

                        </a>

                    @endif

                </div>

                <div class="col-md-4 ml-auto">

                    <table>

                        <tbody>

                            <tr>

                                <td class="text-main text-bold">{{ translate('Order #') }}</td>

                                <td class="text-info text-bold text-right"> {{ $order->order_id }}</td>

                            </tr>

                            <tr>

                                <td class="text-main text-bold">{{ translate('Order Status') }}</td>

                                <td class="text-right">

                                    @if ($delivery_status == 'delivered')

                                        <span class="badge badge-inline badge-success">

                                            {{ translate(ucfirst(str_replace('_', ' ', $delivery_status))) }}

                                        </span>

                                    @else

                                        <span class="badge badge-inline badge-info">

                                            {{ translate(ucfirst(str_replace('_', ' ', $delivery_status))) }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <td class="text-main text-bold">{{ translate('Order Date') }} </td>

                                <td class="text-right">{{ date('d-m-Y h:i A', strtotime($order->created_at)) }}</td>

                            </tr>

                            <tr>

                                <td class="text-main text-bold">

                                    {{ translate('Total amount') }}

                                </td>

                                <td class="text-right">

                                    {{ single_price($order->amount) }}

                                </td>

                            </tr>

                            <tr>

                                <td class="text-main text-bold">{{ translate('Payment method') }}</td>

                                <td class="text-right">

                                    {{ translate(ucfirst(str_replace('_', ' ', $info->payment_type))) }}</td>

                            </tr>


                        </tbody>

                    </table>

                </div>

            </div>

            <hr class="new-section-sm bord-no">

            <div class="row">

                <div class="col-lg-12 table-responsive">

                    <table class="table-bordered aiz-table invoice-summary table">

                        <thead>

                            <tr class="bg-trans-dark">

                                <th data-breakpoints="lg" class="min-col">#</th>

                                <th width="30%" class="text-uppercase">{{ translate('Service Name') }}</th>

                                <th class="text-uppercase">{{ translate('Shipping') }}</th>

                                <th data-breakpoints="md" class="min-col text-uppercase text-center">

                                    {{ translate('Qty') }}

                                </th>

                                <th data-breakpoints="md" class="min-col text-uppercase text-center">

                                    {{ translate('Price') }}</th>

                                <th data-breakpoints="md" class="min-col text-uppercase text-center">

                                    {{ translate('Total') }}</th>

                            </tr>

                        </thead>

                        <tbody>
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

            <div class="clearfix float-right">

                <table class="table">

                    <tbody>

                        <tr>

                            <td>

                                <strong class="text-muted">{{ translate('Sub Total') }} :</strong>

                            </td>

                            <td>

                                {{ single_price($order->amount) }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <strong class="text-muted">{{ translate('Tax') }} :</strong>

                            </td>

                            <td>

                                <!-- {{ single_price($info->orderDetails->sum('tax')) }} -->
                                {{ single_price(0) }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <strong class="text-muted">{{ translate('Shipping') }} :</strong>

                            </td>

                            <td>

                                {{ single_price($info->orderDetails->sum('shipping_cost')) }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <strong class="text-muted">{{ translate('Coupon') }} :</strong>

                            </td>

                            <td>

                                {{ single_price($info->coupon_discount) }}

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <strong class="text-muted">{{ translate('TOTAL') }} :</strong>

                            </td>

                            <td class="text-muted h5">

                                {{ single_price($order->amount) }}

                            </td>

                        </tr>

                    </tbody>

                </table>

                <div class="no-print text-right">

                    <a href="{{ route('service_invoice.download', $order->id) }}" type="button"

                        class="btn btn-icon btn-light"><i class="las la-print"></i></a>

                </div>

            </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#assign_deliver_boy').on('change', function() {
            var order_id = {{ $order->id }};
            var delivery_boy = $('#assign_deliver_boy').val();
            $.post('{{ route('orders.delivery-boy-assign') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                delivery_boy: delivery_boy
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Delivery boy has been assigned') }}');
            });
        });
        $('#update_delivery_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Delivery status has been updated') }}');
            });
        });
        $('#update_payment_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Payment status has been updated') }}');
            });
        });
        $('#update_tracking_code').on('change', function() {
            var order_id = {{ $order->id }};
            var tracking_code = $('#update_tracking_code').val();
            $.post('{{ route('orders.update_tracking_code') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                tracking_code: tracking_code
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Order tracking code has been updated') }}');
            });
        });
    </script>
@endsection
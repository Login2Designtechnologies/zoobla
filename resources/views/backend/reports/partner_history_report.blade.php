@extends('backend.layouts.app')

@section('content')


<div class="aiz-titlebar text-left mt-2 mb-3">

    <div class="row align-items-center">

        <div class="col-md-6">

            <h1 class="h3">{{translate('All Partners')}}</h1>

        </div>

    </div>

</div>



<div class="card">

    <form class="" id="sort_sellers" action="" method="GET">

        <div class="card-header row gutters-5">


            <div class="col-lg-2">

                <div class="form-group mb-0">

                    <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country_id" >

                        <option value="">{{ translate('Select your country') }}</option>

                        @foreach (get_active_countries() as $key => $country)

                            <option value="{{ $country->id }}" >{{ $country->name }}</option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div class="col-lg-2">

                <div class="form-group mb-0">

                    <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" name="state_id" >
                        

                    </select>

                </div>

            </div>

            <div class="col-lg-2">

                <div class="form-group mb-0">

                    <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" name="city_id" >

                    </select>

                </div>

            </div>
        
            <div class="col-md-2 ml-auto">

                <select class="form-control aiz-selectpicker" name="approved_status" id="approved_status" onchange="sort_sellers()">

                    <option value="">{{translate('Filter by Approval')}}</option>

                    <option value="1"  @isset($approved) @if($approved == '1') selected @endif @endisset>{{translate('Approved')}}</option>

                    <option value="0"  @isset($approved) @if($approved == '0') selected @endif @endisset>{{translate('Non-Approved')}}</option>

                </select>

            </div> 

            <div class="col-md-3">

                <div class="form-group mb-0">

                  <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name or email & Enter') }}">

                </div>

            </div>

            <div class="col-auto">

                <div class="form-group mb-0">

                    <button type="submit" class="btn btn-primary">Filter</button>

                </div>

            </div>


            <div class="col-lg-2">

                <div class="form-group mb-0">

                    <a href="{{route('partners_report_export.index')}}" class="btn btn-primary">Export</a>

                </div>

            </div>


        </div>

    </form>

    <div class="card-body">

        <table class="table aiz-table mb-0">

            <thead>

            <tr>

                

                <!-- <th>

                    @if(auth()->user()->can('delete_seller'))

                        <div class="form-group">

                            <div class="aiz-checkbox-inline">

                                <label class="aiz-checkbox">

                                    <input type="checkbox" class="check-all">

                                    <span class="aiz-square-check"></span>

                                </label>

                            </div>

                        </div>

                    @else

                        #

                    @endif

                </th> -->

                <th>#</th>

                <th>{{translate('Reg. Date')}}</th>

                <th>{{translate('Name')}}</th>

                <th data-breakpoints="lg">{{translate('Phone')}}</th>

                <th data-breakpoints="lg">{{translate('Email Address')}}</th>

                <th data-breakpoints="lg">{{translate('Address')}}</th>

                {{-- <th data-breakpoints="lg">{{translate('Verification Info')}}</th> --}}

                <th data-breakpoints="lg">{{translate('Approval')}}</th>

                {{-- <th data-breakpoints="lg">{{ translate('Num. of Products') }}</th> --}}

                {{-- <th data-breakpoints="lg">{{ translate('Due to seller') }}</th> --}}
                
                {{-- <th width="10%">{{translate('Options')}}</th> --}}

            </tr>

            </thead>

            <tbody>

            @foreach($shops as $key => $shop)
            
                @php
                    $city        = '';
                    $state       = '';
                    $country     = '';
                    $address     = '';
                    $postal_code = '';
                    
                    if(isset($shop->user) && $shop->user->address != null){

                            $address     = $shop->user->address;

                    }

                    if(isset($shop->user) && $shop->user->postal_code != null){

                        $postal_code = $shop->user->postal_code;

                    }

                    if(isset($shop->user) && $shop->user->city != null ){

                        $city = DB::table('cities')->where('id' ,$shop->user->city)->first()->name;

                    }

                    if(isset($shop->user) && $shop->user->state != null ){

                            $state = DB::table('states')->where('id' ,$shop->user->state)->first()->name;

                    }

                    if(isset($shop->user) && $shop->user->country != null ){

                            $country = DB::table('countries')->where('id' ,$shop->user->country)->first()->name;

                    }

                @endphp

                <tr>

                    <!-- <td>

                        @if(auth()->user()->can('delete_seller'))

                            <div class="form-group">

                                <div class="aiz-checkbox-inline">

                                    <label class="aiz-checkbox">

                                        <input type="checkbox" class="check-one" name="id[]" value="{{$shop->id}}">

                                        <span class="aiz-square-check"></span>

                                    </label>

                                </div>

                            </div>

                        @else

                            {{ ($key+1) + ($shops->currentPage() - 1)*$shops->perPage() }}

                        @endif

                    </td> -->
                    
                    <td>{{ ($key+1) + ($shops->currentPage() - 1)*$shops->perPage() }}</td>

                    <td>{{ date('m-d-Y' , strtotime($shop->created_at)) }}</td>

                    <td>@if($shop->user->banned == 1) <i class="fa fa-ban text-danger" aria-hidden="true"></i> @endif {{$shop->name}}</td>

                    <td>{{$shop->user->phone}}</td>

                    <td>{{$shop->user->email}}</td>

                    <td> 
                        {{ $address ? $address . ',' : '' }}
                        {{ $city ? $city . ',' : '' }}
                        {{ $state ? $state . ',' : '' }}
                        {{ $postal_code ? $postal_code . ',' : '' }}
                        {{ $country ?? '' }}
                    </td>

                    <!-- <td>

                        @if ($shop->verification_status != 1 && $shop->verification_info != null)

                            <a href="{{ route('sellers.show_verification_request', $shop->id) }}">

                                <span class="badge badge-inline badge-info">{{translate('Show')}}</span>

                            </a>

                        @endif

                    </td> -->

                    <td>

                        <label class="aiz-switch aiz-switch-success mb-0">

                            <input 

                                @can('approve_seller') onchange="update_approved(this)" @endcan

                                value="{{ $shop->id }}" type="checkbox" 

                                <?php if($shop->verification_status == 1) echo "checked";?> 

                                @cannot('approve_seller') disabled @endcan

                            >

                            <span class="slider round"></span>

                        </label>

                    </td>

                    <!-- <td>{{ $shop->user->products->count() }}</td> -->

                    <!-- <td>

                        @if ($shop->admin_to_pay >= 0)

                            {{ single_price($shop->admin_to_pay) }}

                        @else

                            {{ single_price(abs($shop->admin_to_pay)) }} ({{ translate('Due to Admin') }})

                        @endif

                    </td> -->

                    <!-- <td>

                        <div class="dropdown">

                            <button type="button" class="btn btn-sm btn-circle btn-soft-primary btn-icon dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">

                                <i class="las la-ellipsis-v"></i>

                            </button>

                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">

                                @can('view_seller_profile')

                                    <a href="#" onclick="show_seller_profile('{{$shop->id}}');"  class="dropdown-item">

                                        {{translate('Profile')}}

                                    </a>

                                @endcan

                                @can('login_as_seller')

                                    <a href="{{route('sellers.login', encrypt($shop->id))}}" class="dropdown-item">

                                        {{translate('Log in as this Seller')}}

                                    </a>

                                @endcan

                                @can('pay_to_seller')

                                    <a href="#" onclick="show_seller_payment_modal('{{$shop->id}}');" class="dropdown-item">

                                        {{translate('Go to Payment')}}

                                    </a>

                                @endcan

                                @can('seller_payment_history')

                                    <a href="{{route('sellers.payment_history', encrypt($shop->user_id))}}" class="dropdown-item">

                                        {{translate('Payment History')}}

                                    </a>

                                @endcan

                                @can('edit_seller')

                                    <a href="{{route('sellers.edit', encrypt($shop->id))}}" class="dropdown-item">

                                        {{translate('Edit')}}

                                    </a>

                                @endcan

                                @can('ban_seller')

                                    @if($shop->user->banned != 1)

                                        <a href="#" onclick="confirm_ban('{{route('sellers.ban', $shop->id)}}');" class="dropdown-item">

                                            {{translate('Ban this seller')}}

                                            <i class="fa fa-ban text-danger" aria-hidden="true"></i>

                                        </a>

                                    @else

                                        <a href="#" onclick="confirm_unban('{{route('sellers.ban', $shop->id)}}');" class="dropdown-item">

                                            {{translate('Unban this seller')}}

                                            <i class="fa fa-check text-success" aria-hidden="true"></i>

                                        </a>

                                    @endif

                                @endcan

                                @can('delete_seller')

                                    <a href="#" class="dropdown-item confirm-delete" data-href="{{route('sellers.destroy', $shop->id)}}" class="">

                                        {{translate('Delete')}}

                                    </a>

                                @endcan

                            </div>

                        </div>

                    </td> -->

                </tr>

            @endforeach

            </tbody>

        </table>

        <div class="aiz-pagination">

            {{ $shops->appends(request()->input())->links() }}

        </div>

    </div>


</div>


@endsection

@section('script')

<script type="text/javascript">

    $(document).on('change', '[name=country_id]', function() {

        var country_id = $(this).val();

        get_states(country_id);

    });

    $(document).on('change', '[name=state_id]', function() {

        var state_id = $(this).val();

        get_city(state_id);

    });

    function get_states(country_id) {

        $('[name="state"]').html("");

        $.ajax({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            url: "{{route('get-state')}}",

            type: 'POST',

            data: {




                country_id  : country_id

            },

            success: function (response) {

                var obj = JSON.parse(response);

                if(obj != '') {

                    $('[name="state_id"]').html(obj);

                    AIZ.plugins.bootstrapSelect('refresh');

                }

            }

        });

    }

    function get_city(state_id) {

        $('[name="city"]').html("");

        $.ajax({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            url: "{{route('get-city')}}",

            type: 'POST',

            data: {

                state_id: state_id

            },

            success: function (response) {

                var obj = JSON.parse(response);

                if(obj != '') {

                    $('[name="city_id"]').html(obj);

                    AIZ.plugins.bootstrapSelect('refresh');

                }

            }

        });

    }
</script>

@endsection

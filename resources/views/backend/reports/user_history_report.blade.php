@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">

        <div class="align-items-center">

            <h1 class="h3">{{translate('Users Report')}}</h1>

        </div>

    </div>

    <div class="card">

        <form class="" id="sort_customers" action="" method="GET">

            <div class="card-header row gutters-5">


                <div class="col-lg-2">

                    <div class="form-group mb-0">

                        <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country_id" >

                            <option value="">{{ translate('Select your country') }}</option>

                            @foreach (get_active_countries() as $key => $country)

                                <option value="{{ $country->id }}" @isset($country) Selected @endisset>{{ $country->name }}</option>

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



                <div class="col-lg-2">

                    <div class="form-group mb-0">

                        <input type="text" class="aiz-date-range form-control" @isset($date) value="{{ $date }}" @endisset name="date" placeholder="Filter by date" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">

                    </div>

                </div>
                
                <div class="col-md-3">

                    <div class="form-group mb-0">

                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email or name & Enter') }}">

                    </div>

                </div>

                <div class="col-auto">

                    <div class="form-group mb-0">

                        <button type="submit" class="btn btn-primary">Filter</button>

                    </div>

                </div>

                 <div class="col-lg-2">

                    <div class="form-group mb-0">

                      <a href="{{route('users_report_export.index')}}" class="btn btn-primary"> export</a>

                    </div>

                </div>

            </div>

          
        </form>

        <div class="card-body">

            <table class="table aiz-table mb-0">

                <thead>

                    <tr>

                        <th data-breakpoints="lg">#</th>

                        <!-- <th>

                            <div class="form-group">

                                <div class="aiz-checkbox-inline">

                                    <label class="aiz-checkbox">

                                        <input type="checkbox" class="check-all">

                                        <span class="aiz-square-check"></span>

                                    </label>

                                </div>

                            </div>

                        </th> -->

                        <th >{{translate('Reg. Date')}}</th>

                        <th>{{translate('Name')}}</th>

                        <th data-breakpoints="lg">{{translate('Email Address')}}</th>

                        <th data-breakpoints="lg">{{translate('Phone')}}</th>

                        <th data-breakpoints="lg">{{translate('Address')}}</th>

                        <!-- <th data-breakpoints="lg">{{translate('Package')}}</th> -->

                        <!-- <th data-breakpoints="lg">{{translate('Wallet Balance')}}</th> -->

                        <!-- <th class="text-right">{{translate('Options')}}</th> -->

                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $key => $user)

                        @if ($user != null)

                            @php

                                $address = DB::table('addresses')->where('user_id' ,$user->id)->first();

                                $city        = '';
                                $state       = '';
                                $country     = '';
                                $addressf     = '';
                                $postal_code = '';

                                if(isset($address) && $address->address != null){

                                    $addressf     = $address->address;
                                    
                                }

                                if(isset($address) && $address->postal_code != null){

                                    $postal_code = $address->postal_code;

                                }

                                if(isset($address) && $address->city_id != null ){

                                    $city = DB::table('cities')->where('id' ,$address->city_id)->first()->name;

                                }

                                if(isset($address) && $address->state_id != null ){

                                    $state = DB::table('states')->where('id' ,$address->state_id)->first()->name;

                                }

                                if(isset($address) && $address->country_id != null ){
                                    
                                    $country = DB::table('countries')->where('id' ,$address->country_id)->first()->name;
                                    
                                }

                            @endphp

                            <tr>

                                <td>{{ ($key+1) + ($users->currentPage() - 1)*$users->perPage() }}</td>

                                <!-- <td>

                                    <div class="form-group">

                                        <div class="aiz-checkbox-inline">

                                            <label class="aiz-checkbox">

                                                <input type="checkbox" class="check-one" name="id[]" value="{{$user->id}}">

                                                <span class="aiz-square-check"></span>

                                            </label>

                                        </div>

                                    </div>

                                </td> -->
                                <td>{{ date('m-d-Y' , strtotime($user->created_at)) }}</td>

                                <td>@if($user->banned == 1) <i class="fa fa-ban text-danger" aria-hidden="true"></i> @endif {{$user->name}}</td>

                                <td>{{$user->email}}</td>

                                <td>
                                    @if ($user->phone != '') 

                                        {{ $user->phone}}

                                    @else 

                                        @if(isset($address->phone)) 

                                            {{$address->phone}}

                                        @endif

                                    @endif
                                </td>   
                                <td> 
                                    {{ $addressf ? $addressf . ',' : '' }}
                                    {{ $city ? $city . ',' : '' }}
                                    {{ $state ? $state . ',' : '' }}
                                    {{ $postal_code ? $postal_code . ',' : '' }}
                                    {{ $country ?? '' }}
                                </td>
                                <!-- <td>

                                    @if ($user->customer_package != null)

                                    {{$user->customer_package->getTranslation('name')}}

                                    @endif

                                </td> -->

                                <!-- <td>{{single_price($user->balance)}}</td> -->

                                <!-- <td class="text-right">

                                    @can('login_as_customer')

                                        <a href="{{route('customers.login', encrypt($user->id))}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('Log in as this Customer') }}">

                                            <i class="las la-edit"></i>

                                        </a>

                                    @endcan

                                    @can('ban_customer')

                                        @if($user->banned != 1)

                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="confirm_ban('{{route('customers.ban', encrypt($user->id))}}');" title="{{ translate('Ban this Customer') }}">

                                                <i class="las la-user-slash"></i>

                                            </a>

                                            @else

                                            <a href="#" class="btn btn-soft-success btn-icon btn-circle btn-sm" onclick="confirm_unban('{{route('customers.ban', encrypt($user->id))}}');" title="{{ translate('Unban this Customer') }}">

                                                <i class="las la-user-check"></i>

                                            </a>

                                        @endif

                                    @endcan

                                    @can('delete_customer')

                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('customers.destroy', $user->id)}}" title="{{ translate('Delete') }}">

                                            <i class="las la-trash"></i>

                                        </a>

                                    @endcan

                                </td> -->

                            </tr>

                        @endif

                    @endforeach

                </tbody>

            </table>

            <div class="aiz-pagination">

                {{ $users->appends(request()->input())->links() }}

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

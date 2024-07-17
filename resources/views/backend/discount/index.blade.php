@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">

	<div class="row align-items-center">

		<div class="col-md-6">

			<h1 class="h3">{{translate('All Discount')}}</h1>

		</div>
        
        <div class="col-md-6 text-md-right">

            <a href="{{url('admin/discount/create')}}" class="btn btn-circle btn-info">

                <span>{{translate('Add New Discount')}}</span>

            </a>

        </div>

	</div>

</div>

<div class="card">

  <div class="card-header">

      <h5 class="mb-0 h6">{{translate('Discount Information')}}</h5>

  </div>

   <div class="card-body">

        <table class="table aiz-table p-0">

            <thead>

                <tr>

                    <th data-breakpoints="md">#</th>

                    <th data-breakpoints="md">{{translate('Discount Name')}}</th>

                    <th data-breakpoints="md">{{translate('Discount Type')}}</th>

                    <th data-breakpoints="md">{{translate('Discount')}}</th>

                    <th width="10%">{{translate('Options')}}</th>

                </tr>

            </thead>

            <tbody>
                
                @foreach($discounts as $key => $discount)

                    <tr>

                        <td>{{$key+1}}</td>

                        <td>
                            @switch($discount->discount_name)

                                @case(1)

                                    {{translate('add on and product')}}

                                    @break

                                @case(2)

                                     {{translate('cloud product and product')}}

                                    @break

                                @default

                                     {{translate('cloud product and product, add on')}}

                            @endswitch

                        </td>

                        <td> {{ translate(Str::headline($discount->discount_type)) }}</td>

                        <td>{{$discount->discount}}</td>

						<td class="text-center">

                            <a href="{{url('admin/discount/edit' , ['id' => $discount->id ])}}" class="btn btn-soft-danger"  title="{{ translate('Edit') }}">

                                <i class="las la-edit"></i>

                            </a>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

   </div>

</div>


@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

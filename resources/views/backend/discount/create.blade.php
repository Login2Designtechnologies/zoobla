@extends('backend.layouts.app')



@section('content')



    <div class="col-lg-8 mx-auto">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0 h6">{{translate('Discount Information Adding')}}</h5>

            </div>

            <div class="card-body">

              <form class="form-horizontal" action="{{ url('admin/discount/store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mt-3">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif
                
                {{-- @if (old('type') == 'cart_base') selected @endif --}}
                <div class="form-group row">

                    <label class="col-lg-3 col-from-label" for="name">{{translate('Discount Name')}}</label>

                    <div class="col-lg-9">

                        <select name="discount_name" id="discount_name" class="form-control aiz-selectpicker"  required>

                            <option value="">{{translate('Select One') }}</option>

                            <option value="1" @if (old('discount_name') == '1') selected @endif>{{translate('add on and product')}}</option>

                            <option value="2" @if (old('discount_name') == '2') selected @endif>{{translate('cloud product and product')}}</option>
                            
                            <option value="3" @if (old('discount_name') == '3') selected @endif>{{translate('cloud product and product, add on')}}</option>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="col-6">

                        <div class="form-group">

                            <label class="col-from-label" for="name">{{translate('Discount')}}</label>

                            <input type="number" value="{{old('discount')}}" name="discount" id="discount" class="form-control aiz-selectpicker" placeholder="discount"  required>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="form-group">

                            <label class="col-from-label" for="name">{{translate('Discount Type')}}</label>

                            <select name="discount_type" id="discount_type" class="form-control aiz-selectpicker"  required>

                                <option value="">{{translate('Select One') }}</option>

                                <option value="Amount" @if (old('discount_type') == 'Amount') selected @endif>{{translate('Amount')}}</option>

                                <option value="Percent" @if (old('discount_type') == 'Percent') selected @endif>{{translate('Percent')}}</option>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="form-group mb-0 text-right">

                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>

                </div>

              </form>

            </div>

        </div>

    </div>



@endsection

@section('script')



<script type="text/javascript">



    // function coupon_form(){

    //     var coupon_type = $('#coupon_type').val();

	// 	$.post('{{ route('coupon.get_coupon_form') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type}, function(data){

    //         $('#coupon_form').html(data);

	// 	});

    // }



    // @if($errors->any())

    //     coupon_form();

    // @endif



</script>



@endsection


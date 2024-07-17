@extends('backend.layouts.app')



@section('content')



<div class="aiz-titlebar text-left mt-2 mb-3">

    <h5 class="mb-0 h6">{{translate('Cloud Product')}}</h5>

</div>



<div class="row">

    <div class="col-lg-6 mx-auto">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0 h6">{{translate('update Cloud Product')}}</h5>

            </div>

            <div class="card-body p-0">

                <form class="p-4" action="{{ route('tax.cloud_product_update', $cloud_data->id) }}" method="POST">

                    @csrf

                    <div class="form-group row">

                        <div class="col-lg-3">

                            <label class="control-label">{{ translate('Product') }}</label>

                        </div>

                        <div class="col-lg-9">

                            <input type="text" class="form-control" name="product" placeholder="{{ translate('product') }}" value="{{ $cloud_data->product }}" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-3">

                            <label class="control-label">{{ translate('7 Days') }}</label>

                        </div>

                        <div class="col-lg-9">

                            <input type="text" class="form-control" name="first_days" placeholder="{{ translate('Amount') }}" value="{{ $cloud_data->first_days }}" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-3">

                            <label class="control-label">{{ translate('30 Days') }}</label>

                        </div>

                        <div class="col-lg-9">

                            <input type="text" class="form-control" name="secound_days" placeholder="{{ translate('Amount') }}" value="{{ $cloud_data->secound_days }}" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-3">

                            <label class="control-label">{{ translate('90 Days') }}</label>

                        </div>

                        <div class="col-lg-9">

                            <input type="text" class="form-control" name="third_days" placeholder="{{ translate('Amount') }}" value="{{ $cloud_data->third_days }}" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-3">

                            <label class="control-label">{{ translate('180 Days') }}</label>

                        </div>

                        <div class="col-lg-9">

                            <input type="text" class="form-control" name="fourth_days" placeholder="{{ translate('Amount') }}" value="{{ $cloud_data->fourth_days }}" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-3">

                            <label class="control-label">{{ translate('365 Days') }}</label>

                        </div>

                        <div class="col-lg-9">

                            <input type="text" class="form-control" name="fifth_days" placeholder="{{ translate('Amount') }}" value="{{ $cloud_data->fifth_days }}" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-3">

                            <label class="control-label">{{ translate('Status') }}</label>

                        </div>

                        <div class="col-lg-9">

                            <select name="status" id="status" class="form-control">
                              <option value="1" @if($cloud_data->status == 1) selected @endif>Active</option>
                              <option value="2" @if($cloud_data->status == 2) selected @endif>In Active</option>
                            </select>

                        </div>

                    </div>

                    

                    <div class="form-group mb-0 text-right">

                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



@endsection


@extends('backend.layouts.app')



@section('content')



<div class="row">

    <div class="col-lg-8 mx-auto">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0 h6">{{translate('Cloud Product')}}</h5>

            </div>

            <form action="{{ route('tax.cloud_product_store') }}" method="POST">

            	@csrf

                <div class="card-body">

                    <div class="form-group row">

                        <label class="col-sm-3 col-from-label" for="name">{{translate('product')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('product')}}" id="product" name="product" class="form-control" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-sm-3 col-from-label" for="7_days">{{translate('7 Days')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('7 Days Amount')}}" id="7_days" name="first_days" class="form-control" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-sm-3 col-from-label" for="30_days">{{translate('30 Days')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('30 Days Amount')}}" id="30_days" name="secound_days" class="form-control" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-sm-3 col-from-label" for="90_days">{{translate('90 Days')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('90 Days Amount')}}" id="90_days" name="third_days" class="form-control" required>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-sm-3 col-from-label" for="180_days">{{translate('180 Days')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('180 Days Amount')}}" id="180_days" name="fourth_days" class="form-control" required>

                        </div>

                    </div>

                    <!-- <div class="form-group row">

                        <label class="col-sm-3 col-from-label" for="180_days">{{translate('180 Days')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('180 Days Amount')}}" id="180_days" name="180_days" class="form-control" required>

                        </div>

                    </div> -->

                    <div class="form-group row">

                        <label class="col-sm-3 col-from-label" for="365_days">{{translate('365 Days')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('365 Days Amount')}}" id="365_days" name="fifth_days" class="form-control" required>

                        </div>

                    </div>

                    <div class="form-group mb-0 text-right">

                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



@endsection


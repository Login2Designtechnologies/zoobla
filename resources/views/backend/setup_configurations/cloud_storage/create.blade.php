@extends('backend.layouts.app')



@section('content')



<div class="row">

    <div class="col-lg-8 mx-auto">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0 h6">{{translate('Cloud Storage')}}</h5>

            </div>

            <form action="{{ route('tax.cloud_store') }}" method="POST">

            	@csrf

                <div class="card-body">

                    <div class="form-group row row">

                        <label class="col-sm-3 col-from-label" for="name">{{translate('Days')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('Days')}}" id="days" name="days" class="form-control" required>

                        </div>

                    </div>

                    <div class="form-group row row">

                        <label class="col-sm-3 col-from-label" for="address">{{translate('Amount')}}</label>

                        <div class="col-sm-9">

                            <input type="text" placeholder="{{translate('Amount')}}" id="amount" name="amount" class="form-control" required>

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


@extends('backend.layouts.app')



@section('content')

    <div class="row">

        <div class="col-lg-6">

            <div class="card">

                <div class="card-header">

                    <h3 class="mb-0 h6 text-center">{{translate('Partner Residual Commission Activatation')}}</h3>

                </div>

                <div class="card-body text-center">

                    <label class="aiz-switch aiz-switch-success mb-0">

                        <input type="checkbox" onchange="updateSettings(this, 'service_commission_activation')" <?php if(get_setting('service_commission_activation') == 1) echo "checked";?>>

                        <span class="slider round"></span>

                    </label>

                </div>

            </div>

        </div>  

        <div class="col-lg-6">

            <div class="">

                <div class="card">

                <div class="card-header">

                    <h5 class="mb-0 h6">{{translate('Payout Condition')}}</h5>

                </div>

                <div class="card-body"> 

                    <form class="form-horizontal" action="{{ route('business_settings.payout_transaction.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group row">

                            <!-- <label class="col-md-4 col-from-label">{{translate('Partner Commission')}}</label> -->
                            <div class="col-md-4 col-from-label">
                                Transaction Day + 
                            </div>

                            <div class="col-md-8">

                                <input type="hidden" name="types[]" value="payout_service_transaction">

                                <div class="input-group">

                                    <input type="number" lang="en" min="0" step="0.01" value="{{ get_setting('payout_service_transaction') }}" placeholder="{{translate('Transaction Day')}}" name="payout_service_transaction" class="form-control">

                                    <div class="input-group-append">

                                        <span class="input-group-text">Day</span>

                                    </div>

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

        </div>



        {{-- <div class="col-lg-6">

            <div class="card">

                <div class="card-header">

                    <h3 class="mb-0 h6 text-center">{{translate('Category Based Commission')}}</h3>

                </div>

                <div class="card-body text-center">

                    <label class="aiz-switch aiz-switch-success mb-0">

                        <input type="checkbox" onchange="updateSettings(this, 'category_wise_commission')" <?php if(get_setting('category_wise_commission') == 1) echo "checked";?>>

                        <span class="slider round"></span>

                    </label>

                </div>

            </div>

        </div> --}}



        <div class="col-lg-6">

            <div class="card">

              <div class="card-header">

                  <h5 class="mb-0 h6">{{translate('Commission Level')}}</h5>

              </div>

              <div class="card-body">

                  <form class="form-horizontal" action="{{ route('business_settings.vendor_commission.update') }}" method="POST" enctype="multipart/form-data">

                  	@csrf

                    <div class="form-group row">

                        <label class="col-md-4 col-from-label">{{translate('Silver (1-5000)')}}</label>

                        <div class="col-md-8">

                            <input type="hidden" name="types[]" value="se_silver">

                            <div class="input-group">

                                <input type="number" lang="en" min="0" step="0.01" value="{{ get_setting('se_silver') }}" placeholder="" name="se_silver" class="form-control">

                                <div class="input-group-append">

                                    <span class="input-group-text">%</span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-md-4 col-from-label">{{translate('Gold (5001-10000)')}}</label>

                        <div class="col-md-8">

                            <input type="hidden" name="types[]" value="se_gold">

                            <div class="input-group">

                                <input type="number" lang="en" min="0" step="0.01" value="{{ get_setting('se_gold') }}" placeholder="" name="se_gold" class="form-control">

                                <div class="input-group-append">

                                    <span class="input-group-text">%</span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-md-4 col-from-label">{{translate('Diamond (10000 Onwards)')}}</label>

                        <div class="col-md-8">

                            <input type="hidden" name="types[]" value="se_diamond">

                            <div class="input-group">

                                <input type="number" lang="en" min="0" step="0.01" value="{{ get_setting('se_diamond') }}" placeholder="" name="se_diamond" class="form-control">

                                <div class="input-group-append">

                                    <span class="input-group-text">%</span>

                                </div>

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



        {{-- <div class="col-lg-6">

            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0 h6">{{translate('Note')}}</h5>

                </div>

                <div class="card-body">

                    <ul class="list-group">

                        <li class="list-group-item text-muted">

                            1. {{ get_setting('vendor_commission') }}% {{translate('of seller product price will be deducted from seller earnings') }}.

                        </li>

                        <li class="list-group-item text-muted">

                            2. {{translate('If Category Based Commission is enbaled, Set seller commission percentage 0.') }}.

                        </li>

                    </ul>

                </div>

            </div>

        </div>  --}}



        <div class="col-lg-6">

            <div class="card">

              <div class="card-header">

                  <h5 class="mb-0 h6">{{translate('Withdraw Partner Amount')}}</h5>

              </div>

              <div class="card-body">

                  <form class="form-horizontal" action="{{ route('business_settings.vendor_commission.update') }}" method="POST" enctype="multipart/form-data">

                  	@csrf

                    <div class="form-group row">

                        <label class="col-md-4 col-from-label">{{translate('Minimum Auto Withdraw Amount')}}</label>

                        <div class="col-md-8">

                            <input type="hidden" name="types[]" value="minimum_ser_amount_withdraw">

                            <div class="input-group">

                                <input type="number" lang="en" min="0" step="0.01" value="{{ get_setting('minimum_ser_amount_withdraw') }}" placeholder="{{translate('Minimum Seller Amount Withdraw')}}" name="minimum_ser_amount_withdraw" class="form-control" required>

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



    </div>



@endsection



@section('script')

    <script type="text/javascript">

        function updateSettings(el, type){

            if($(el).is(':checked')){

                var value = 1;

            }

            else{

                var value = 0;

            }

            

            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){

                if(data == '1'){

                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');

                }

                else{

                    AIZ.plugins.notify('danger', 'Something went wrong');

                }

            });

        }

    </script>

@endsection


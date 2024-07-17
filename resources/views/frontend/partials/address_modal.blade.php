<style>
    /* .modal-content .form-default .modal-body .row{
        margin-top: 9px !important;
        background: #1eb3e6!important;
    }
    
   .modal-content{
    background-color: #1eb3e6;
    width: 82% !important
   }
   #new-address-modal #exampleModalLabel,#new-address-modal label {
  color: #fff;
   }
   #new-address-modal .btn.btn-primary{
  background: #4040a6 !important;
}
#new-address-modal .btn-close.close{
    position: relative;
    top: -10px;
}
   .modal-content .dropdown {
    margin-top: 16px !important
   }
   .modal-content .form-control{
    margin-top: 16px !important
   }
   .modal-content .row{
     padding: 0px 34px !important;   
   }
   .modal-content .form-group{
    margin-top: 33px
   }
   .modal-content .modal-body{
    padding: 0px 25px !important
   }
   .modal-content button{
    padding: 5px 11px !important
   }
   .modal-content .modal-body input.form-control{
    padding: 2px 10px !important
   }
 .form-control{
    font-weight: 500;
    height: calc(0.75rem + 1.2rem + 2px) !important
   }
   .modal-content .modal-body .label{
    margin-bottom: .4rem !important
   }
.modal-body .button{
    border: 1px solid;
}
    */

</style>



<!-- New Address Modal -->

<div class="modal fade" id="new-address-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h5>

                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" >&times;</span>

                </button>

            </div>

            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">

                @csrf

                <div class="modal-body c-scrollbar-light">

                    <div class="">

                        <!-- Address -->

                        <div class="row">

                           
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>{{ translate('add Address')}}</label>
                                    <input type="text" class="form-control mb-3 rounded-2" placeholder="{{ translate('Nothing selected')}}" name="" value="" required>
                                    
                                </div>
                            </div>
                        
                       
                            <!-- Country -->
                            <div class="col-md-12">
                                <div class="form-group">

                            
                                        <label>{{ translate('Country')}}</label>

                                        <select class="form-control aiz-selectpicker rounded-2" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country_id" required>

                                            <option value="">{{ translate('Select your country') }}</option>

                                            @foreach (get_active_countries() as $key => $country)

                                                <option value="{{ $country->id }}">{{ $country->name }}</option>

                                            @endforeach

                                        </select>
                                </div>

                            </div>



                            <!-- State -->
                            <div class="col-md-12">
                                <div class="form-group">

                            

                            
                                    <label>{{ translate('Select State')}}</label>
                                    <select class="form-control mb-3 aiz-selectpicker rounded-2" data-live-search="true" name="state_id" required>



                                    </select>

                                </div>

                            </div>



                            <!-- City -->

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>{{ translate('Select City')}}</label>

                                    <select class="form-control mb-3 aiz-selectpicker rounded-2" data-live-search="true" name="city_id" required>



                                    </select>

                                </div>

                            </div>



                        @if (get_setting('google_map') == 1)

                            <!-- Google Map

                            <div class="row mt-3 mb-3">

                                <input id="searchInput" class="controls" type="text" placeholder="{{translate('Enter a location')}}">

                                <div id="map"></div>

                                <ul id="geoData">

                                    <li style="display: none;">Full Address: <span id="location"></span></li>

                                    <li style="display: none;">Postal Code: <span id="postal_code"></span></li>

                                    <li style="display: none;">Country: <span id="country"></span></li>

                                    <li style="display: none;">Latitude: <span id="lat"></span></li>

                                    <li style="display: none;">Longitude: <span id="lon"></span></li>

                                </ul>

                            </div> -->

                            <!-- Longitude -->

                            <!-- <div class="row">

                                <div class="col-md-3" id="">

                                    <label for="exampleInputuname">{{ translate('Longitude')}}</label>

                                </div>

                                <div class="col-md-9" id="">

                                    <input type="text" class="form-control mb-3 rounded-2" id="longitude" name="longitude" readonly="">

                                </div>

                            </div> -->

                            <!-- Latitude -->
                                <!-- 
                            <div class="row">

                                <div class="col-md-3" id="">

                                    <label for="exampleInputuname">{{ translate('Latitude')}}</label>

                                </div>

                                <div class="col-md-9" id="">

                                    <input type="text" class="form-control mb-3 rounded-2" id="latitude" name="latitude" readonly="">

                                </div>

                            </div> -->


                        @endif

                        

                        <!-- Postal code -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>{{ translate('Code')}}</label>
                                <input type="text" class="form-control mb-3 rounded-2" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>

                            </div>

                        </div>



                        <!-- Phone -->

                        <div class="col-lg-12">

                            

                            <div class="form-group">
                                <label>{{ translate('Phone')}}</label>
                                <input type="text" class="form-control mb-3 rounded-2" placeholder="{{ translate('+880')}}" name="phone" value="" required>

                            </div>

                        </div>

                        <!-- Save button -->

                        <div class="btn-block text-right">

                            <button type="submit" class="btn btn-primary rounded-2 w-100px">{{translate('Save')}}</button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



<!-- Edit Address Modal -->

<div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            

            <div class="modal-body c-scrollbar-light" id="edit_modal_body">



            </div>

        </div>

    </div>

</div>



@section('script')

    <script type="text/javascript">

        function add_new_address(){

            $('#new-address-modal').modal('show');

        }



        function edit_address(address) {

            var url = '{{ route("addresses.edit", ":id") }}';

            url = url.replace(':id', address);

            

            $.ajax({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                url: url,

                type: 'GET',

                success: function (response) {

                    $('#edit_modal_body').html(response.html);

                    $('#edit-address-modal').modal('show');

                    AIZ.plugins.bootstrapSelect('refresh');



                    @if (get_setting('google_map') == 1)

                        var lat     = -33.8688;

                        var long    = 151.2195;



                        if(response.data.address_data.latitude && response.data.address_data.longitude) {

                            lat     = parseFloat(response.data.address_data.latitude);

                            long    = parseFloat(response.data.address_data.longitude);

                        }



                        initialize(lat, long, 'edit_');

                    @endif

                }

            });

        }

        

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

<!-- <script>
    var ModalLabel = document.querySelector(".ModalLabel");
var close = document.querySelector(".close");
var true = document.querySelector(".true");

function toggleModal() {
    modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

close.addEventListener("click", toggleModal);
true.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

</script> -->


    

    @if (get_setting('google_map') == 1)

        @include('frontend.partials.google_map')

    @endif

@endsection
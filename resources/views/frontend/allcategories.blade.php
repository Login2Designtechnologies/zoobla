@extends('frontend.layouts.app')



@section('content')




    <main>
        <section class="py-5">
            <div class="container">
                <div class="row g-3 align-items-center justify-content-center">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="position-relative">
                            <div class="input-group mb-3 border border-main px-3 py-2 rounded-pill">
                                <input type="text" id="search_input" class="form-control border-0 bg-transparent p-0" placeholder="Search Category By Name Here....." aria-label="Enter Email" aria-describedby="basic-addon2">
                                <span class="input-group-text bg-transparent text-capitalize fw-semibold  p-0 border-0" id="basic-addon2">
                                <a href="#">
                                    <img src="https://login2design.in/zoobla_reference//public/assets/images/search.png" class="img-fluid" style="width: 28px">
                                </a>
                            </span>
                            </div>
                            <div id="categoryList" class="suggesstion shadow rounded-5 p-4 bg-white" style="display:none">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3" id="defaultBoxCategory">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <h2 class="text-center">
                            All <span class="text-main">Categories</span>.
                        </h2>
                    </div>
                  @if(!$products->isEmpty())
				    @foreach($products as $product)
				        @if($product->featured == 0)
				            <!-- Handle unpublished products here -->
				        @else
				            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
				                <div data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="1500">
				                    <div class="card bg-light-main all_category_card border-0 shadow py-3">
				                        <div class="d-flex justify-content-center overflow-hidden">
				                            <div class="all_category_card_img">
				                                <img class="card-img-top" src="{{ uploaded_asset($product->cover_image) }}" alt="Card image cap">
				                            </div>
				                        </div>
				                        <div class="card-body text-center">
				                            <h5 class="card-title">{{$product->category_name}}</h5>
				                            <p class="card-text fs-12 mb-0">{{$product->category_name}}</p>
				                             <div class="mt-3">
		                                    </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        @endif
				    @endforeach
				@endif


                </div>
                <div class="row g-3" id="searchoCategory">

                </div>

            </div>
        </section>
    </main>








@endsection
@extends('backend.layouts.app')



@section('content')



@php

    CoreComponentRepository::instantiateShopRepository();

    CoreComponentRepository::initializeCache();

@endphp



<div class="aiz-titlebar text-left mt-2 mb-3">

    <h5 class="mb-0 h6">{{translate('Add New Product')}}</h5>

</div>

<div class="">

    <!-- Error Meassages -->

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">

        <div class="row gutters-5">

            <div class="col-lg-8">

                @csrf

                <input type="hidden" name="added_by" value="admin">

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Information')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Product Name')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="name" placeholder="{{ translate('Product Name') }}" onchange="update_sku()" required>

                            </div>

                        </div>

                        <div class="form-group row" id="category">

                            <label class="col-md-3 col-from-label">{{translate('Category')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>

                                    @foreach ($categories as $category)

                                    <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>

                                    @foreach ($category->childrenCategories as $childCategory)

                                    @include('categories.child_category', ['child_category' => $childCategory])

                                    @endforeach

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="form-group row" id="brand">

                            <label class="col-md-3 col-from-label">{{translate('Brand')}}</label>

                            <div class="col-md-8">

                                <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">

                                    <option value="">{{ translate('Select Brand') }}</option>

                                    @foreach (\App\Models\Brand::all() as $brand)

                                    <option value="{{ $brand->id }}">{{ $brand->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Unit')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="unit" placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}" required>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Weight')}} <small>({{ translate('In Kg') }})</small></label>

                            <div class="col-md-8">

                                <input type="number" class="form-control" name="weight" step="0.01" value="0.00" placeholder="0.00">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Minimum Purchase Qty')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <input type="number" lang="en" class="form-control" name="min_qty" value="1" min="1" required>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Resolution')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="resolution" placeholder="{{ translate('Resolution') }}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Battery Life')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="battery_life" placeholder="{{ translate('Battery Life') }}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Local Storage')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="local_storage" placeholder="{{ translate('Local Storage') }}" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Field of view')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="field_view" placeholder="{{ translate('Field of view') }}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('HomeBase Compatibility')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="homebase_compatibility" placeholder="{{ translate('HomeBase Compatibility') }}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Tags')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="{{ translate('Type and hit enter to add a tag') }}">

                                <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>

                            </div>

                        </div>


                        @if (addon_is_activated('pos_system'))

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">{{translate('Barcode')}}</label>

                                <div class="col-md-8">

                                    <input type="text" class="form-control" name="barcode" placeholder="{{ translate('Barcode') }}">

                                </div>

                            </div>

                        @endif



                        @if (addon_is_activated('refund_request'))

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">{{translate('Refundable')}}</label>

                                <div class="col-md-8">

                                    <label class="aiz-switch aiz-switch-success mb-0">

                                        <input type="checkbox" name="refundable" checked value="1">

                                        <span></span>

                                    </label>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Images')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Gallery Images')}} <small>(600x600)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="photos" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                                <small class="text-muted">{{translate('These images are visible in product details page gallery. Use 600x600 sizes images.')}}</small>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}} <small>(300x300)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="thumbnail_img" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                                <small class="text-muted">{{translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')}}</small>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Banner Image')}} <small>(1075x487)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="banner_img" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                                <small class="text-muted">{{translate('This image is visible in product detail page. Use 1075x487 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')}}</small>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Videos')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Video Provider')}}</label>

                            <div class="col-md-8">

                                <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">

                                    <option value="youtube">{{translate('Youtube')}}</option>

                                    <option value="dailymotion">{{translate('Dailymotion')}}</option>

                                    <option value="vimeo">{{translate('Vimeo')}}</option>

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Video Link')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="video_link" placeholder="{{ translate('Video Link') }}">

                                <small class="text-muted">{{translate("Use proper link without extra parameter. Don't use short share link/embeded iframe code.")}}</small>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('About the Product')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <div class="col-12">
                                
                                <div class="row ">

                                    <div class="col-12 append-container">

                                        <div class="row" id="inputFieldsfirst1">

                                            <div class="col-5">

                                                <input type="text" class="form-control" name="heading[]" placeholder="{{ translate('heading') }}">

                                            </div>

                                            <div class="col-5">

                                                <input type="text" class="form-control" name="text[]" placeholder="{{ translate('text') }}">

                                            </div>
                                            
                                            <div class="col-2">

                                                <button type="button" onclick="removeField(1,'inputFieldsfirst')"  class="btn btn-danger action-btn">remove</button>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                                    
                                <div class="d-flex mt-2 justify-content-end">

                                    <button type="button" onclick="Addfild()" class="btn btn-success action-btn">Add Menu</button>

                                </div>

                           </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('SECTION THIRD')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Heading')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="sec_third_hedding" placeholder="{{ translate('heading Name') }}" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="sec_third_description" placeholder="{{ translate('Description') }}" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Image Box')}} <small>(300x300)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="sec_third_image" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                                {{-- <small class="text-muted">{{translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')}}</small> --}}

                            </div>

                        </div>

                    </div>

                </div>


            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0 h6">{{translate('Carousel Banner 1')}}</h5>

                </div>

                <div class="card-body">

                    <div class="form-group row">

                        <label class="col-md-3 col-from-label">{{translate('carousel banner 1')}}</label>

                        <div class="col-md-8 ">

                            <div class="row product-container">

                                
                            </div>
                            
                            <div class="d-flex mt-2 justify-content-end">

                                <button type="button" onclick="Addproductfild()" class="btn btn-success action-btn">Add banner</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0 h6">{{translate('Carousel Banner 2')}}</h5>

                </div>

                <div class="card-body">

                    <div class="form-group row">

                        <label class="col-md-3 col-from-label">{{translate('carousel banner 2')}}</label>

                        <div class="col-md-8 ">

                            <div class="row product-container2">

                                
                            </div>
                            
                            <div class="d-flex mt-2 justify-content-end">

                                <button type="button" onclick="Addproductfild2()" class="btn btn-success action-btn">Add banner</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0 h6">{{translate('Carousel Banner 3')}}</h5>

                </div>

                <div class="card-body">

                    <div class="form-group row">

                        <label class="col-md-3 col-from-label">{{translate('carousel banner 3')}}</label>

                        <div class="col-md-8 ">

                            <div class="row product-container3">

                                
                            </div>
                            
                            <div class="d-flex mt-2 justify-content-end">

                                <button type="button" onclick="Addproductfild3()" class="btn btn-success action-btn">Add banner</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0 h6">{{translate('Carousel Banner 4')}}</h5>

                </div>

                <div class="card-body">

                    <div class="form-group row">

                        <label class="col-md-3 col-from-label">{{translate('carousel banner 4')}}</label>

                        <div class="col-md-8 ">

                            <div class="row product-container4">

                                
                            </div>
                            
                            <div class="d-flex mt-2 justify-content-end">

                                <button type="button" onclick="Addproductfild4()" class="btn btn-success action-btn">Add banner</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card">

                <div class="card-header">

                    <h5 class="mb-0 h6">{{translate('Product Comparison')}}</h5>

                  </div>

                    <div class="card-body">

                         <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('First Product')}} </label>

                            <div class="col-md-8">

                                <select name="first_product_id" class="form-control product_id aiz-selectpicker" data-live-search="true" data-selected-text-format="count" >

                                    @foreach($products as $product)

                                        <option value="{{$product->id}}">{{ $product->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Second Product')}}</label>

                            <div class="col-md-8">

                                <select name="secound_product_id" class="form-control product_id aiz-selectpicker" data-live-search="true" data-selected-text-format="count" >

                                    @foreach($products as $product)

                                        <option value="{{$product->id}}">{{ $product->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Frequently Asked Questions')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Menu')}} </label>

                            <div class="col-md-8 ">

                                <div class="row faq-container">

                                    
                                </div>
                                
                                <div class="d-flex mt-2 justify-content-end">

                                    <button type="button" onclick="Addfildfrequently ()" class="btn btn-success action-btn">Add Menu</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>





              {{--  <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Smart Home')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Heading')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="smart_home_hedding" placeholder="{{ translate('heading Name') }}" onchange="update_sku()" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="smart_home_description" placeholder="{{ translate('Description') }}" onchange="update_sku()" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button First')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button[]" placeholder="{{ translate('Button name') }}">

                                <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small> -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url First')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button_url[]" placeholder="{{ translate('url') }}">

                              <!--   <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small> -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button Secound')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button[]" placeholder="{{ translate('Button name') }}">

                              <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url Secound')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button_url[]" placeholder="{{ translate('url') }}">

                               <!--  <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small> -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button Third')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button[]" placeholder="{{ translate('Button name') }}">

                            <!--   <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url Third')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button_url[]" placeholder="{{ translate('url') }}">

                              <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button Fourth')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button[]" placeholder="{{ translate('Button name') }}">

                           <!--  <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url Fourth')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control " name="smart_home_button_url[]" placeholder="{{ translate('url') }}">

                            <!--   <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Image Box')}} <small>(300x300)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="smart_home_image" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                                <!--  <small class="text-muted">{{translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')}}</small> --> 

                            </div>

                        </div>

                    </div>

                </div> --}}


                
                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Variation')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row gutters-5">

                            <div class="col-md-3">

                                <input type="text" class="form-control" value="{{translate('Colors')}}" disabled>

                            </div>

                            <div class="col-md-8">

                                <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple >

                                    @foreach (\App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)

                                    <option  value="{{ $color->code }}" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"></option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-1">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input value="1" type="checkbox" name="colors_active">

                                    <span></span>

                                </label>

                            </div>

                        </div>



                        <div class="form-group row gutters-5">

                            <div class="col-md-3">

                                <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>

                            </div>

                            <div class="col-md-8">

                                <select name="choice_attributes[]" id="choice_attributes" class="form-control aiz-selectpicker" data-selected-text-format="count" data-live-search="true" multiple data-placeholder="{{ translate('Choose Attributes') }}">

                                    @foreach (\App\Models\Attribute::all() as $key => $attribute)

                                    <option value="{{ $attribute->id }}">{{ $attribute->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div>

                            <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>

                            <br>

                        </div>



                        <div class="customer_choice_options" id="customer_choice_options">



                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product price + stock')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Unit price')}} <span class="text-danger">*</span></label>

                            <div class="col-md-6">

                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control" required>

                            </div>

                        </div>



                        <div class="form-group row">

	                        <label class="col-sm-3 control-label" for="start_date">{{translate('Discount Date Range')}}</label>

	                        <div class="col-sm-9">

	                          <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="{{translate('Select Date')}}" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">

	                        </div>

	                    </div>



                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Discount')}} <span class="text-danger">*</span></label>

                            <div class="col-md-6">

                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Discount') }}" name="discount" class="form-control" required>

                            </div>

                            <div class="col-md-3">

                                <select class="form-control aiz-selectpicker" name="discount_type">

                                    <option value="amount">{{translate('Flat')}}</option>

                                    <option value="percent">{{translate('Percent')}}</option>

                                </select>

                            </div>

                        </div>



                        @if(addon_is_activated('club_point'))

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">

                                    {{translate('Set Point')}}

                                </label>

                                <div class="col-md-6">

                                    <input type="number" lang="en" min="0" value="0" step="1" placeholder="{{ translate('1') }}" name="earn_point" class="form-control">

                                </div>

                            </div>

                        @endif



                        <div id="show-hide-div">

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">{{translate('Quantity')}} <span class="text-danger">*</span></label>

                                <div class="col-md-6">

                                    <input type="number" lang="en" min="0" value="100" step="1" placeholder="{{ translate('Quantity') }}" name="current_stock" class="form-control" required>

                                </div>

                            </div>

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">

                                    {{translate('SKU')}}

                                </label>

                                <div class="col-md-6">

                                    <input type="text" placeholder="{{ translate('SKU') }}" name="sku" class="form-control">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row d-none">

                            <label class="col-md-3 col-from-label">

                                {{translate('External link')}}

                            </label>

                            <div class="col-md-9">

                                <input type="text" placeholder="{{ translate('External link') }}" name="external_link" class="form-control">

                                <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>

                            </div>

                        </div>

                        <div class="form-group row d-none">

                            <label class="col-md-3 col-from-label">

                                {{translate('External link button text')}}

                            </label>

                            <div class="col-md-9">

                                <input type="text" placeholder="{{ translate('External link button text') }}" name="external_link_btn" class="form-control">

                                <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>

                            </div>

                        </div>

                        <br>

                        <div class="sku_combination" id="sku_combination">



                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Description')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}}</label>

                            <div class="col-md-8">

                                <textarea

                                class="aiz-text-editor form-control"
        
                                {{-- data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]' --}}
        
                                placeholder="Content.."
        
                                data-min-height="300"
        
                                name="description"
        
                            ></textarea>

                            </div>

                        </div>

                    </div>

                    {{-- <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Short description')}}</label>

                            <div class="col-md-8">

                                <textarea class="aiz-text-editor" name="shortdescription"></textarea>

                            </div>

                        </div>

                    </div> --}}

                </div>


                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Add On')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="product-choose-list">

                            <div class="product-choose">

                                <div class="form-group row">

                                    <label class="col-lg-3 col-from-label" for="name">{{translate('Product')}}</label>

                                    <div class="col-lg-9">

                                        <select name="add_on[]" class="form-control product_id aiz-selectpicker" data-live-search="true" data-selected-text-format="count"  multiple>

                                            @foreach($products as $product)

                                                <option value="{{$product->id}}">{{ $product->getTranslation('name') }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


             <!--   <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Shipping Cost')}}</h5>

                    </div>

                    <div class="card-body">



                    </div>

                </div>-->



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('PDF Specification')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('PDF Specification')}}</label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="document">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="pdf" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('SEO Meta Tags')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Meta Title')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="meta_title" placeholder="{{ translate('Meta Title') }}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}}</label>

                            <div class="col-md-8">

                                <textarea name="meta_description" rows="8" class="form-control"></textarea>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Meta Image') }}</label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="meta_img" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



            </div>



            <div class="col-lg-4">



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">

                            {{translate('Shipping Configuration')}}

                        </h5>

                    </div>



                    <div class="card-body">

                        @if (get_setting('shipping_type') == 'product_wise_shipping')

                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Free Shipping')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="shipping_type" value="free" checked>

                                    <span></span>

                                </label>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Flat Rate')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="shipping_type" value="flat_rate">

                                    <span></span>

                                </label>

                            </div>

                        </div>



                        <div class="flat_rate_shipping_div" style="display: none">

                            <div class="form-group row">

                                <label class="col-md-6 col-from-label">{{translate('Shipping cost')}}</label>

                                <div class="col-md-6">

                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost" class="form-control" required>

                                </div>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Is Product Quantity Mulitiply')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="checkbox" name="is_quantity_multiplied" value="1">

                                    <span></span>

                                </label>

                            </div>

                        </div>

                        @else

                        <p>

                            {{ translate('Product wise shipping cost is disable. Shipping cost is configured from here') }}

                            <a href="{{route('shipping_configuration.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">

                                <span class="aiz-side-nav-text">{{translate('Shipping Configuration')}}</span>

                            </a>

                        </p>

                        @endif

                    </div>

                </div>



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Low Stock Quantity Warning')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group mb-3">

                            <label for="name">

                                {{translate('Quantity')}}

                            </label>

                            <input type="number" name="low_stock_quantity" value="1" min="0" step="1" class="form-control">

                        </div>

                    </div>

                </div>



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">

                            {{translate('Stock Visibility State')}}

                        </h5>

                    </div>



                    <div class="card-body">



                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Show Stock Quantity')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="stock_visibility_state" value="quantity" checked>

                                    <span></span>

                                </label>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Show Stock With Text Only')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="stock_visibility_state" value="text">

                                    <span></span>

                                </label>

                            </div>

                        </div>



                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Hide Stock')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="stock_visibility_state" value="hide">

                                    <span></span>

                                </label>

                            </div>

                        </div>



                    </div>

                </div>



                <div class="card">

                    <!-- <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Cash On Delivery')}}</h5>

                    </div> -->

                    <div class="card-body">

                        @if (get_setting('cash_payment') == '1')

                            <div class="form-group row">

                                <label class="col-md-6 col-from-label">{{translate('Status')}}</label>

                                <div class="col-md-6">

                                    <label class="aiz-switch aiz-switch-success mb-0">

                                        <input type="checkbox" name="cash_on_delivery" value="1" checked="">

                                        <span></span>

                                    </label>

                                </div>

                            </div>

                        @else

                            <!-- <p>

                                {{ translate('Cash On Delivery option is disabled. Activate this feature from here') }}

                                <a href="{{route('activation.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">

                                    <span class="aiz-side-nav-text">{{translate('Cash Payment Activation')}}</span>

                                </a>

                            </p> -->

                        @endif

                    </div>

                </div>



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Featured')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Status')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="checkbox" name="featured" value="1">

                                    <span></span>

                                </label>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Todays Deal')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Status')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="checkbox" name="todays_deal" value="1">

                                    <span></span>

                                </label>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Flash Deal')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group mb-3">

                            <label for="name">

                                {{translate('Add To Flash')}}

                            </label>

                            <select class="form-control aiz-selectpicker" name="flash_deal_id" id="flash_deal">

                                <option value="">{{ translate('Choose Flash Title') }}</option>

                                @foreach(\App\Models\FlashDeal::where("status", 1)->get() as $flash_deal)

                                    <option value="{{ $flash_deal->id}}">

                                        {{ $flash_deal->title }}

                                    </option>

                                @endforeach

                            </select>

                        </div>



                        <div class="form-group mb-3">

                            <label for="name">

                                {{translate('Discount')}}

                            </label>

                            <input type="number" name="flash_discount" value="0" min="0" step="0.01" class="form-control">

                        </div>

                        <div class="form-group mb-3">

                            <label for="name">

                                {{translate('Discount Type')}}

                            </label>

                            <select class="form-control aiz-selectpicker" name="flash_discount_type" id="flash_discount_type">

                                <option value="">{{ translate('Choose Discount Type') }}</option>

                                <option value="amount">{{translate('Flat')}}</option>

                                <option value="percent">{{translate('Percent')}}</option>

                            </select>

                        </div>

                    </div>

                </div>



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Estimate Shipping Time')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group mb-3">

                            <label for="name">

                                {{translate('Shipping Days')}}

                            </label>

                            <div class="input-group">

                                <input type="number" class="form-control" name="est_shipping_days" min="1" step="1" placeholder="{{translate('Shipping Days')}}">

                                <div class="input-group-prepend">

                                    <span class="input-group-text" id="inputGroupPrepend">{{translate('Days')}}</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('VAT & Tax')}}</h5>

                    </div>

                    <div class="card-body">

                        @foreach(\App\Models\Tax::where('tax_status', 1)->get() as $tax)

                        <label for="name">

                            {{$tax->name}}

                            <input type="hidden" value="{{$tax->id}}" name="tax_id[]">

                        </label>



                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>

                            </div>

                            <div class="form-group col-md-6">

                                <select class="form-control aiz-selectpicker" name="tax_type[]">

                                    <option value="amount">{{translate('Flat')}}</option>

                                    <option value="percent">{{translate('Percent')}}</option>

                                </select>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>



            </div>

            <div class="col-12">

                <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">

                    <div class="btn-group mr-2" role="group" aria-label="Third group">

                        <button type="submit" name="button" value="unpublish" class="btn btn-primary action-btn">{{ translate('Save & Unpublish') }}</button>

                    </div>

                    <div class="btn-group" role="group" aria-label="Second group">

                        <button type="submit" name="button" value="publish" class="btn btn-success action-btn">{{ translate('Save & Publish') }}</button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

    var counter = 1;

    function Addfildfrequently () {

        counter ++;
        var inputFields = `
                <div class="row mt-2" id="inputFields${counter}">

                    <div class="col-5">
                        <input type="text" class="form-control" name="faq_questions[]" placeholder="{{ translate('Faq questions') }}" onchange="update_sku()" required>
                    </div>

                    <div class="col-5">
                        <input type="text" class="form-control" name="faq_answers[]" placeholder="{{ translate('Faq Answers') }}" onchange="update_sku()" required>
                    </div>

                    <div class="col-2">
                        <button type="button" onclick="removeField(${counter},'inputFields')" class="removeButton btn btn-danger action-btn" data-id="${counter}">Remove</button>
                    </div>
                </div>
                 `;
       

            $(".faq-container").append(inputFields);

    }

    function Addfild() {

        counter ++;
        var inputFields = `
                    <div class="row mt-2" id="inputFieldsfirst${counter}">

                        <div class="col-5">

                            <input type="text" class="form-control" name="heading[]" placeholder="{{ translate('heading') }}" >

                        </div>

                        <div class="col-5">

                            <input type="text" class="form-control" name="text[]" placeholder="{{ translate('text ') }}">

                        </div>

                        <div class="col-2">
                            <button type="button" onclick="removeField(${counter},'inputFieldsfirst')" class="btn btn-danger action-btn">remove</button>
                        </div>

                    </div>
                 `;
       

            $(".append-container").append(inputFields);

    }

    // var seccounter = 0;
    // function Addpartnerfild() {
    //     seccounter++;

    //     var inputFields = '<div class="row mt-2" id="inputFieldsp' + seccounter + '">';

    //     inputFields += '<div class="col-5">';
    //     inputFields += '<div class="input-group" data-toggle="aizuploader" data-type="image">';
    //     inputFields += '<div class="input-group-prepend">';
    //     inputFields += '<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>';
    //     inputFields += '</div>';
    //     inputFields += '<div class="form-control file-amount">{{ translate('Choose File') }}</div>';
    //     inputFields += '<input type="hidden" name="home_security_image[]" class="selected-files">';
    //     inputFields += '</div>';
    //     inputFields += '<div class="file-preview box sm"> </div> </div>';
    //     inputFields += '<div class="col-5">';
    //     inputFields += '<input type="text" class="form-control" name="home_security_menu_name[]" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>';
    //     inputFields += ' </div> ';

    //     inputFields += ' <div class="col-2">';
    //     inputFields += '<button type="button" onclick="removefild('+seccounter+')" class="removeButton btn btn-danger action-btn" data-id="p'+seccounter+'">Remove</button> </div></div>';

    //     $(".store-container").append(inputFields);
    // }

    function Addproductfild(){

        counter ++;
        
        var inputFields = `
                <div class="row mt-2" id="inputFieldsfirst${counter}">
                    <div class="col-6">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="carousel_img1[]" class="selected-files">
                        </div>
                        <div class="file-preview box sm"> </div>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="carousel_title[]" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="removeField(${counter},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="${counter}">Remove</button>
                    </div>
                </div>
            `;

    $(".product-container").append(inputFields);

    }

    function Addproductfild2(){

        counter ++;
        
        var inputFields = `
                <div class="row mt-2" id="inputFieldsfirst${counter}">
                    <div class="col-6">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="carousel_img2[]" class="selected-files">
                        </div>
                        <div class="file-preview box sm"> </div>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="carousel_title2[]" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="removeField(${counter},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="${counter}">Remove</button>
                    </div>
                </div>
            `;

    $(".product-container2").append(inputFields);

    }

    function Addproductfild3(){

        counter ++;
        
        var inputFields = `
                <div class="row mt-2" id="inputFieldsfirst${counter}">
                    <div class="col-6">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="carousel_img3[]" class="selected-files">
                        </div>
                        <div class="file-preview box sm"> </div>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="carousel_title3[]" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="removeField(${counter},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="${counter}">Remove</button>
                    </div>
                </div>
            `;

    $(".product-container3").append(inputFields);

    }

    function Addproductfild4(){

        counter ++;
        
        var inputFields = `
                <div class="row mt-2" id="inputFieldsfirst${counter}">
                    <div class="col-6">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="carousel_img4[]" class="selected-files">
                        </div>
                        <div class="file-preview box sm"> </div>
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="carousel_title4[]" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="removeField(${counter},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="${counter}">Remove</button>
                    </div>
                </div>
            `;

    $(".product-container4").append(inputFields);

    }

    function removeField(id, name) {

        $("#" + name + id).remove();

    }
   
</script>


@endsection


@section('script')



<script type="text/javascript">

   
    $('form').bind('submit', function (e) {

		if ( $(".action-btn").attr('attempted') == 'true' ) {

			//stop submitting the form because we have already clicked submit.

			e.preventDefault();

		}

		else {

			$(".action-btn").attr("attempted", 'true');

		}

        // Disable the submit button while evaluating if the form should be submitted

        // $("button[type='submit']").prop('disabled', true);

        

        // var valid = true;



        // if (!valid) {

            // e.preventDefault();

            

            ////Reactivate the button if the form was not submitted

            // $("button[type='submit']").button.prop('disabled', false);

        // }

    });

    

    $("[name=shipping_type]").on("change", function (){

        $(".flat_rate_shipping_div").hide();



        if($(this).val() == 'flat_rate'){

            $(".flat_rate_shipping_div").show();

        }



    });


    function add_more_customer_choice_option(i, name) {
        
         $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '{{ route('products.add-more-choice-option') }}',
        data: {
            attribute_id: i
        },
        success: function(data) {
            var obj = JSON.parse(data);
            
            // Construct the HTML for the new customer choice option
            var newOptionHtml = '\
                <div class="form-group row">\n\
                    <div class="col-md-3">\n\
                        <input type="hidden" name="choice_no[]" value="' + i + '">\n\
                        <input type="text" class="form-control" name="choice[]" value="' + name +
                '" placeholder="{{ translate('Choice Title') }}" readonly>\n\
                    </div>\n\
                    <div class="col-md-8">\n\
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_' + i + '[]" multiple>\n\
                            ' + obj + '\n\
                        </select>\n\
                    </div>\n\
                </div>';
            
            
            $('#customer_choice_options').append(newOptionHtml);

            AIZ.plugins.bootstrapSelect('refresh');
        }
        });
     }



    // function add_more_customer_choice_option(i, name){

    //     $.ajax({

    //         headers: {

    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    //         },

    //         type:"POST",

    //         url:'{{ route('products.add-more-choice-option') }}',

    //         data:{

    //            attribute_id: i

    //         },

    //         success: function(data) {

    //             var obj = JSON.parse(data);

    //             $('#customer_choice_options').append('\

    //             <div class="form-group row">\

    //                 <div class="col-md-3">\

    //                     <input type="hidden" name="choice_no[]" value="'+i+'">\

    //                     <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="{{ translate('Choice Title') }}" readonly>\

    //                 </div>\

    //                 <div class="col-md-8">\

    //                     <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" multiple>\

    //                         '+obj+'\

    //                     </select>\

    //                 </div>\

    //             </div>');

    //             AIZ.plugins.bootstrapSelect('refresh');

    //        }

    //    });





    // }



    $('input[name="colors_active"]').on('change', function() {

        if(!$('input[name="colors_active"]').is(':checked')) {

            $('#colors').prop('disabled', true);

            AIZ.plugins.bootstrapSelect('refresh');

        }

        else {

            $('#colors').prop('disabled', false);

            AIZ.plugins.bootstrapSelect('refresh');

        }

        update_sku();

    });



    $(document).on("change", ".attribute_choice",function() {

        update_sku();

    });



    $('#colors').on('change', function() {

        update_sku();

    });



    $('input[name="unit_price"]').on('keyup', function() {

        update_sku();

    });



    $('input[name="name"]').on('keyup', function() {

        update_sku();

    });



    function delete_row(em){

        $(em).closest('.form-group row').remove();

        update_sku();

    }



    function delete_variant(em){

        $(em).closest('.variant').remove();

    }



    function update_sku(){

        $.ajax({

           type:"POST",

           url:'{{ route('products.sku_combination') }}',

           data:$('#choice_form').serialize(),

           success: function(data) {

                $('#sku_combination').html(data);

                AIZ.uploader.previewGenerate();

                AIZ.plugins.fooTable();

                if (data.length > 1) {

                   $('#show-hide-div').hide();

                }

                else {

                    $('#show-hide-div').show();

                }

           }

       });

    }



    $('#choice_attributes').on('change', function() {

        $('#customer_choice_options').html(null);

        $.each($("#choice_attributes option:selected"), function(){

            add_more_customer_choice_option($(this).val(), $(this).text());

        });



        update_sku();

    });

    function coupon_form(){

        var coupon_type = $('#coupon_type').val();

        $.post('{{ route('coupon.get_coupon_form') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type}, function(data){

            $('#coupon_form').html(data);

        });

    }

</script>



@endsection


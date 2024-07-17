@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">

    <h1 class="mb-0 h6">{{ translate('Edit Product') }}</h5>

</div>
{{-- @dd( $product->product_translations[0]->short_desc) --}}

<div class="">
    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>
    @endif
    <form class="form form-horizontal mar-top" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">

        <div class="row gutters-5">

            <div class="col-lg-8">

                <input name="_method" type="hidden" value="POST">

                <input type="hidden" name="id" value="{{ $product->id }}">

                <input type="hidden" name="lang" value="{{ $lang }}">

                @csrf

                <div class="card">

                    <ul class="nav nav-tabs nav-fill border-light">

                        @foreach (get_all_active_language() as $key => $language)

                        <li class="nav-item">

                            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('products.admin.edit', ['id'=>$product->id, 'lang'=> $language->code] ) }}">

                                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">

                                <span>{{$language->name}}</span>

                            </a>

                        </li>

                        @endforeach

                    </ul>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Product Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>

                            <div class="col-lg-8">

                                <input type="text" class="form-control" name="name" placeholder="{{translate('Product Name')}}" value="{{ $product->getTranslation('name', $lang) }}" required>

                            </div>

                        </div>

                        <div class="form-group row" id="category">

                            <label class="col-lg-3 col-from-label">{{translate('Category')}} <span class="text-danger">*</span></label>

                            <div class="col-lg-8">

                                <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-selected="{{ $product->category_id }}" data-live-search="true" required>

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

                            <label class="col-lg-3 col-from-label">{{translate('Brand')}}</label>

                            <div class="col-lg-8">

                                <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">

                                    <option value="">{{ translate('Select Brand') }}</option>

                                    @foreach (\App\Models\Brand::all() as $brand)

                                    <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Unit')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i> </label>

                            <div class="col-lg-8">

                                <input type="text" class="form-control" name="unit" placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}" value="{{$product->getTranslation('unit', $lang)}}" required>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Weight')}} <small>({{ translate('In Kg') }})</small></label>

                            <div class="col-md-8">

                                <input type="number" class="form-control" name="weight" value="{{ $product->weight }}" step="0.01" placeholder="0.00">

                            </div>

                        </div>
                        
                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Minimum Purchase Qty')}} <span class="text-danger">*</span></label>

                            <div class="col-lg-8">

                                <input type="number" lang="en" class="form-control" name="min_qty" value="@if($product->min_qty <= 1){{1}}@else{{$product->min_qty}}@endif" min="1" required>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Resolution')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="resolution"  value="{{ $product->product_translations[0]->resolution }}"  placeholder="{{ translate('Resolution') }}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Battery Life')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="battery_life" value="{{ $product->product_translations[0]->battery }}" placeholder="{{ translate('Battery') }}" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Local Storage')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="local_storage" placeholder="{{ translate('Local Storage') }}" value="{{ $product->product_translations[0]->local_storage }}" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Field of view')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="field_view" placeholder="{{ translate('Field of view') }}" value="{{ $product->product_translations[0]->field_view }}" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('HomeBase Compatibility')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="homebase_compatibility" placeholder="{{ translate('HomeBase Compatibility') }}" value="{{ $product->product_translations[0]->homebase_compatibility }}" >

                            </div>

                        </div>
                        
                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Tags')}}</label>

                            <div class="col-lg-8">

                                <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}" data-role="tagsinput">

                            </div>

                        </div>


                        @if (addon_is_activated('pos_system'))

                            <div class="form-group row">

                                <label class="col-lg-3 col-from-label">{{translate('Barcode')}}</label>

                                <div class="col-lg-8">

                                    <input type="text" class="form-control" name="barcode" placeholder="{{ translate('Barcode') }}" value="{{ $product->barcode }}">

                                </div>

                            </div>

                        @endif


                        @if (addon_is_activated('refund_request'))

                            <div class="form-group row">

                                <label class="col-lg-3 col-from-label">{{translate('Refundable')}}</label>

                                <div class="col-lg-8">

                                    <label class="aiz-switch aiz-switch-success mb-0" style="margin-top:5px;">

                                        <input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif value="1">

                                        <span class="slider round"></span></label>

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

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Gallery Images')}}</label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="photos" value="{{ $product->photos }}" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}} <small>(290x300)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="thumbnail_img" value="{{ $product->thumbnail_img }}" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

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

                                    <input type="hidden" name="banner_img" value="{{ $product->product_translations[0]->banner_image }}" class="selected-files">

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

                            <label class="col-lg-3 col-from-label">{{translate('Video Provider')}}</label>

                            <div class="col-lg-8">

                                <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">

                                    <option value="youtube" <?php if ($product->video_provider == 'youtube') echo "selected"; ?> >{{translate('Youtube')}}</option>

                                    <option value="dailymotion" <?php if ($product->video_provider == 'dailymotion') echo "selected"; ?> >{{translate('Dailymotion')}}</option>

                                    <option value="vimeo" <?php if ($product->video_provider == 'vimeo') echo "selected"; ?> >{{translate('Vimeo')}}</option>

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Video Link')}}</label>

                            <div class="col-lg-8">

                                <input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}" placeholder="{{ translate('Video Link') }}">

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
                                        <?php
                                          $counter = 1;
                                          $specifications = json_decode($product->product_translations[0]->specification);

                                        ?>
                                        @if($specifications)
                                            @foreach($specifications as $key => $value)

                                                <div class="row @if($counter != 1) mt-2 @endif" id="inputFieldsfirst{{$counter}}">

                                                    <div class="col-5">
        
                                                        <input type="text" class="form-control" name="heading[]" value="{{ $key}}" placeholder="{{ translate('heading') }}">
        
                                                    </div>
        
                                                    <div class="col-5">
        
                                                        <input type="text" class="form-control" name="text[]" value="{{$value}}" placeholder="{{ translate('text') }}">
        
                                                    </div>
                                                    
                                                    <div class="col-2">
        
                                                        <button type="button" onclick="removeField({{$counter}},'inputFieldsfirst')"  class="btn btn-danger action-btn">remove</button>
        
                                                    </div>
        
                                                </div>
                                                <?php
                                                 $counter++;
                                                ?>
                                            @endforeach
                                        @endif
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

                        <h5 class="mb-0 h6">{{translate('Carousel Banner 1')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <div class="col-12">
                                
                                <div class="row ">

                                    <div class="col-12 product-container">
                                        <?php
                                          $counter = 1;
                                          $carousel1 = json_decode($product->product_translations[0]->carousel1);

                                        ?>
                                        @if($carousel1)
                                            @foreach($carousel1 as $key2 => $value2)

                                                <div class="row @if($counter != 1) mt-2 @endif" id="inputFieldsfirst{{$counter}}">
                                                    <div class="col-6">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="carousel_img1[]" class="selected-files" value="{{$value2}}">
                                                        </div>
                                                        <div class="file-preview box sm"> </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control" name="carousel_title[]" value="{{$key2 }}" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" onclick="removeField({{$counter}},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="${counter}">Remove</button>
                                                    </div>
                                                </div>
                                                <?php
                                                 $counter++;
                                                ?>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                    
                                <div class="d-flex mt-2 justify-content-end">

                                    <button type="button" onclick="Addproductfild()" class="btn btn-success action-btn">Add Menu</button>

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

                            <div class="col-12">
                                
                                <div class="row ">

                                    <div class="col-12 product-container2">
                                        <?php
                                          $counter = 1;
                                          $carousel2 = json_decode($product->product_translations[0]->carousel2);

                                        ?>
                                        @if($carousel2)
                                            @foreach($carousel2 as $key3 => $value3)

                                                <div class="row @if($counter != 1) mt-2 @endif" id="inputFieldsfirst{{$counter}}">
                                                    <div class="col-6">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="carousel_img2[]" class="selected-files" value="{{$value3}}">
                                                        </div>
                                                        <div class="file-preview box sm"> </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control" name="carousel_title2[]" value="{{$key3 }}" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" onclick="removeField({{$counter}},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="{{$counter}}">Remove</button>
                                                    </div>
                                                </div>
                                                <?php
                                                 $counter++;
                                                ?>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                    
                                <div class="d-flex mt-2 justify-content-end">

                                    <button type="button" onclick="Addproductfild2()" class="btn btn-success action-btn">Add Menu</button>

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

                            <div class="col-12">
                                
                                <div class="row ">

                                    <div class="col-12 product-container3">
                                        <?php
                                          $counter = 1;
                                          $carousel3 = json_decode($product->product_translations[0]->carousel3);

                                        ?>
                                        @if($carousel3)
                                            @foreach($carousel3 as $key4 => $value4)

                                                <div class="row @if($counter != 1) mt-2 @endif" id="inputFieldsfirst{{$counter}}">
                                                    <div class="col-6">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="carousel_img3[]" class="selected-files" value="{{$value4}}">
                                                        </div>
                                                        <div class="file-preview box sm"> </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control" name="carousel_title3[]" value="{{$key4 }}" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" onclick="removeField({{$counter}},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="{{$counter}}">Remove</button>
                                                    </div>
                                                </div>
                                                <?php
                                                 $counter++;
                                                ?>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                    
                                <div class="d-flex mt-2 justify-content-end">

                                    <button type="button" onclick="Addproductfild3()" class="btn btn-success action-btn">Add Menu</button>

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

                            <div class="col-12">
                                
                                <div class="row ">

                                    <div class="col-12 product-container4">
                                        <?php
                                          $counter = 1;
                                          $carousel4 = json_decode($product->product_translations[0]->carousel4);

                                        ?>
                                        @if($carousel4)
                                            @foreach($carousel4 as $key5 => $value5)

                                                <div class="row @if($counter != 1) mt-2 @endif" id="inputFieldsfirst{{$counter}}">
                                                    <div class="col-6">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="carousel_img4[]" class="selected-files" value="{{$value5}}">
                                                        </div>
                                                        <div class="file-preview box sm"> </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control" name="carousel_title4[]" value="{{$key5 }}" placeholder="{{ translate('menu name') }}" onchange="update_sku()" required>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" onclick="removeField({{$counter}},'inputFieldsfirst')" class="removeButton btn btn-danger action-btn" data-id="{{$counter}}">Remove</button>
                                                    </div>
                                                </div>
                                                <?php
                                                 $counter++;
                                                ?>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                    
                                <div class="d-flex mt-2 justify-content-end">

                                    <button type="button" onclick="Addproductfild3()" class="btn btn-success action-btn">Add Menu</button>

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

                                <input type="text" class="form-control" name="sec_third_hedding" value="{{$product->product_translations[0]->sec_third_hedding}}" placeholder="{{ translate('heading Name') }}" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="sec_third_description" value="{{$product->product_translations[0]->sec_third_details}}" placeholder="{{ translate('Description') }}" >

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

                                    <input type="hidden" name="sec_third_image" value="{{$product->product_translations[0]->sec_third_image}}" class="selected-files">

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

                    <h5 class="mb-0 h6">{{translate('Product Comparison')}}</h5>

                  </div>

                    <div class="card-body">

                         <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('First Product')}}</label>

                            <div class="col-md-8">

                                <select name="first_product_id" class="form-control product_id aiz-selectpicker" data-live-search="true" data-selected-text-format="count" >

                                     @foreach($products as $productsec)

                                        <option value="{{$productsec->id}}"{{($product->product_translations[0]->first_product_id == $productsec->id) ? 'Selected' : ''}} >{{ $productsec->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Second Product')}} </label>

                            <div class="col-md-8">

                                <select name="secound_product_id" class="form-control product_id aiz-selectpicker" data-live-search="true" data-selected-text-format="count" >

                                      @foreach($products as $productsec)

                                        <option value="{{$productsec->id}}"{{($product->product_translations[0]->secound_product_id == $productsec->id) ? 'Selected' : ''}} >{{ $productsec->getTranslation('name') }}</option>

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
                                @php
                                    $menu_name = json_decode($product->product_translations[0]->faq_questions);
                                    $menu_answers = json_decode($product->product_translations[0]->faq_answers);
                                @endphp

                                @if($menu_name != null)
                                    @foreach ($menu_name as $key => $question)
                                        @php $a = $key+1; @endphp
                                        <div class="row mt-2" id="inputFields{{$a.'0'}}">
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="faq_questions[]" value="{{$question}}" placeholder="{{ translate('Faq Questions') }}" onchange="update_sku()" >
                                            </div>

                                            <div class="col-5">
                                                @if(isset($menu_answers[$key]))
                                                    <input type="text" class="form-control" name="faq_answers[]" value="{{$menu_answers[$key]}}" placeholder="{{ translate('Faq Answers') }}" onchange="update_sku()" >
                                                @else
                                                    <input type="text" class="form-control" name="faq_answers[]" value="" placeholder="{{ translate('Faq Answers') }}" onchange="update_sku()" >
                                                @endif
                                            </div>

                                            <div class="col-2">
                                                <button type="button" onclick="removefild({{$a.'0'}})" class="removeButton btn btn-danger action-btn" data-id="{{$a.'0'}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                                
                                <div class="d-flex mt-2 justify-content-end">

                                    <button type="button" onclick="Addfildfrequently()" class="btn btn-success action-btn">Add Menu</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>





            {{--    <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Smart Home')}}</h5>

                    </div>

                    @php
                    $button_name = json_decode($product->product_translations[0]->smart_home_button);
                    $button_url = json_decode($product->product_translations[0]->smart_home_button_url);
                    @endphp

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Heading')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="smart_home_hedding" value="{{$product->product_translations[0]->smart_home_hedding}}" placeholder="{{ translate('heading Name') }}" onchange="update_sku()" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}} </label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="smart_home_description" value="{{$product->product_translations[0]->smart_home_description}}" placeholder="{{ translate('Description') }}" onchange="update_sku()" >

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button First')}} </label>

                            <div class="col-md-8">
                              @if(!empty($button_name))
                                <input type="text" class="form-control " name="smart_home_button[]" value="{{$button_name[0]}}" placeholder="{{ translate('Button name') }}">
                              @endif
                               <!--  <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url First')}} </label>

                            <div class="col-md-8">
                              @if(!empty($button_url))
                                <input type="text" class="form-control " name="smart_home_button_url[]" value="{{$button_url[0]}}" placeholder="{{ translate('url') }}">
                              @endif
                               <!--  <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button Secound')}} </label>

                            <div class="col-md-8">
                              @if(!empty($button_name))
                                <input type="text" class="form-control " name="smart_home_button[]" value="{{$button_name[1]}}" placeholder="{{ translate('Button name') }}">
                               @endif
                                 <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url Secound')}} </label>

                            <div class="col-md-8">
                              @if(!empty($button_url))
                                <input type="text" class="form-control " name="smart_home_button_url[]" value="{{$button_url[1]}}"  placeholder="{{ translate('url') }}">
                              @endif
                                <!--  <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button Third')}} </label>

                            <div class="col-md-8">
                              @if(!empty($button_name))
                                <input type="text" class="form-control " name="smart_home_button[]" value="{{$button_name[2]}}" placeholder="{{ translate('Button name') }}">
                              @endif
                                <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small> --> 

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url Third')}} </label>

                            <div class="col-md-8">
                              @if(!empty($button_url))
                                <input type="text" class="form-control " name="smart_home_button_url[]" value="{{$button_url[2]}}" placeholder="{{ translate('url') }}">
                              @endif
                               <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Button Fourth')}} </label>

                            <div class="col-md-8">
                               @if(!empty($button_name))
                                <input type="text" class="form-control " name="smart_home_button[]" value="{{$button_name[3]}}" placeholder="{{ translate('Button name') }}">
                               @endif
                              <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small> --> 

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Url Fourth')}} </label>

                            <div class="col-md-8">
                             @if(!empty($button_url))
                                <input type="text" class="form-control " name="smart_home_button_url[]" value="{{$button_url[3]}}" placeholder="{{ translate('url') }}">
                             @endif
                                <!-- <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>  -->

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

                                    <input type="hidden" name="smart_home_image" value="{{$product->product_translations[0]->smart_home_image}}" class="selected-files">

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

                            <div class="col-lg-3">

                                <input type="text" class="form-control" value="{{translate('Colors')}}" disabled>

                            </div>

                            <div class="col-lg-8">

                                <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple>

                                    @foreach (\App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)

                                    <option

                                        value="{{ $color->code }}"

                                        data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"

                                        <?php if (in_array($color->code, json_decode($product->colors))) echo 'selected' ?>

                                        ></option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="col-lg-1">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input value="1" type="checkbox" name="colors_active" <?php if (count(json_decode($product->colors)) > 0) echo "checked"; ?> >

                                    <span></span>

                                </label>

                            </div>

                        </div>


                        <div class="form-group row gutters-5">

                            <div class="col-lg-3">

                                <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>

                            </div>

                            <div class="col-lg-8">

                                <select name="choice_attributes[]" id="choice_attributes" data-selected-text-format="count" data-live-search="true" class="form-control aiz-selectpicker" multiple data-placeholder="{{ translate('Choose Attributes') }}">

                                    @foreach (\App\Models\Attribute::all() as $key => $attribute)

                                    <option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        <div class="">

                            <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>

                            <br>

                        </div>


                        <div class="customer_choice_options" id="customer_choice_options">

                            @foreach (json_decode($product->choice_options) as $key => $choice_option)

                            <div class="form-group row">

                                <div class="col-lg-3">

                                    <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">

                                    <input type="text" class="form-control" name="choice[]" value="{{ optional(\App\Models\Attribute::find($choice_option->attribute_id))->getTranslation('name') }}" placeholder="{{ translate('Choice Title') }}" disabled>

                                </div>

                                <div class="col-lg-8">

                                    <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_{{ $choice_option->attribute_id }}[]" multiple>

                                        @foreach (\App\Models\AttributeValue::where('attribute_id', $choice_option->attribute_id)->get() as $row)

                                        <option value="{{ $row->value }}" @if( in_array($row->value, $choice_option->values)) selected @endif>

                                            {{ $row->value }}

                                        </option>

                                        @endforeach

                                    </select>

                                    {{-- <input type="text" class="form-control aiz-tag-input" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="{{ translate('Enter choice values') }}" value="{{ implode(',', $choice_option->values) }}" data-on-change="update_sku"> --}}

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product price + stock')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Unit price')}} <span class="text-danger">*</span></label>

                            <div class="col-lg-6">

                                <input type="text" placeholder="{{translate('Unit price')}}" name="unit_price" class="form-control" value="{{$product->unit_price}}" required>

                            </div>

                        </div>


                        @php

                          $start_date = date('d-m-Y H:i:s', $product->discount_start_date);

                          $end_date = date('d-m-Y H:i:s', $product->discount_end_date);

                        @endphp


                        <div class="form-group row">

                            <label class="col-sm-3 col-from-label" for="start_date">{{translate('Discount Date Range')}} <span class="text-danger">*</span></label>

                            <div class="col-sm-9">

                              <input type="text" class="form-control aiz-date-range" @if($product->discount_start_date && $product->discount_end_date) value="{{ $start_date.' to '.$end_date }}" @endif name="date_range" placeholder="{{translate('Select Date')}}" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">

                            </div>

                        </div>


                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Discount')}} <span class="text-danger">*</span></label>

                            <div class="col-lg-6">

                                <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Discount')}}" name="discount" class="form-control" value="{{ $product->discount }}" required>

                            </div>

                            <div class="col-lg-3">

                                <select class="form-control aiz-selectpicker" name="discount_type" required>

                                    <option value="amount" <?php if ($product->discount_type == 'amount') echo "selected"; ?> >{{translate('Flat')}}</option>

                                    <option value="percent" <?php if ($product->discount_type == 'percent') echo "selected"; ?> >{{translate('Percent')}}</option>

                                </select>

                            </div>

                        </div>


                        @if(addon_is_activated('club_point'))

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">

                                    {{translate('Set Point')}}

                                </label>

                                <div class="col-md-6">

                                    <input type="number" lang="en" min="0" value="{{ $product->earn_point }}" step="0.01" placeholder="{{ translate('1') }}" name="earn_point" class="form-control">

                                </div>

                            </div>

                        @endif


                        <div id="show-hide-div">

                            <div class="form-group row" id="quantity">

                                <label class="col-lg-3 col-from-label">{{translate('Quantity')}} <span class="text-danger">*</span></label>

                                <div class="col-lg-6">

                                    <input type="number" lang="en" value="{{ optional($product->stocks->first())->qty }}" step="1" placeholder="{{translate('Quantity')}}" name="current_stock" class="form-control" required>

                                </div>

                            </div>

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">

                                    {{translate('SKU')}}

                                </label>

                                <div class="col-md-6">

                                    <input type="text" placeholder="{{ translate('SKU') }}" value="{{ optional($product->stocks->first())->sku }}" name="sku" class="form-control">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row d-none">

                            <label class="col-md-3 col-from-label">

                                {{translate('External link')}}

                            </label>

                            <div class="col-md-9 ">

                                <input type="text" placeholder="{{ translate('External link') }}" name="external_link" value="{{ $product->external_link }}" class="form-control">

                                <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>

                            </div>

                        </div>

                        <div class="form-group row d-none">

                            <label class="col-md-3 col-from-label">

                                {{translate('External link button text')}}

                            </label>

                            <div class="col-md-9">

                                <input type="text" placeholder="{{ translate('External link button text') }}" name="external_link_btn" value="{{ $product->external_link_btn }}" class="form-control">

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

                            <label class="col-lg-3 col-from-label">{{translate('Description')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>

                            <div class="col-lg-9">
                                <textarea

                                class="aiz-text-editor form-control"
        
                                {{-- data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]' --}}
        
                                placeholder="Content.."
        
                                data-min-height="300"
        
                                name="description"
        
        
                            >{{ $product->getTranslation('description', $lang) }}</textarea>
                                {{-- <textarea class="aiz-text-editor" name="description">{{ $product->getTranslation('description', $lang) }}</textarea> --}}

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Short Description')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>

                            <div class="col-lg-9">

                                <textarea class="aiz-text-editor" name="shortdescription">{{ $product->getTranslation('short_desc', $lang) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Add On')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-lg-3 control-label" for="name">{{translate('Product')}}</label>

                            <div class="col-lg-9">

                                <select name="product_ids[]" class="form-control product_id aiz-selectpicker" data-live-search="true" data-selected-text-format="count"  multiple>
                                    
                                    <?php $prouct_id = json_decode($product->product_translations[0]->add_on) ?? [] ?>

                                    @foreach($products as $key => $productall)

                                            @if($productall->id == $product->id) @continue @endif

                                        <option value="{{$productall->id}}"

                                            @foreach ($prouct_id as $key => $details)

                                                @if ($details == $productall->id)

                                                    selected

                                                @endif

                                            @endforeach

                                            >{{$productall->getTranslation('name')}}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


<!--                <div class="card">

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

                                <div class="input-group" data-toggle="aizuploader">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="pdf" value="{{ $product->pdf }}" class="selected-files">

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

                            <label class="col-lg-3 col-from-label">{{translate('Meta Title')}}</label>

                            <div class="col-lg-8">

                                <input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}" placeholder="{{translate('Meta Title')}}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-lg-3 col-from-label">{{translate('Description')}}</label>

                            <div class="col-lg-8">

                                <textarea name="meta_description" rows="8" class="form-control">{{ $product->meta_description }}</textarea>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Meta Images')}}</label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="meta_img" value="{{ $product->meta_img }}" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label">{{translate('Slug')}}</label>

                            <div class="col-md-8">

                                <input type="text" placeholder="{{translate('Slug')}}" id="slug" name="slug" value="{{ $product->slug }}" class="form-control">

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">


                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6" class="dropdown-toggle" data-toggle="collapse" data-target="#collapse_2">

                            {{translate('Shipping Configuration')}}

                        </h5>

                    </div>

                    <div class="card-body collapse show" id="collapse_2">

                        @if (get_setting('shipping_type') == 'product_wise_shipping')

                        <div class="form-group row">

                            <label class="col-lg-6 col-from-label">{{translate('Free Shipping')}}</label>

                            <div class="col-lg-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free') checked @endif>

                                    <span></span>

                                </label>

                            </div>

                        </div>


                        <div class="form-group row">

                            <label class="col-lg-6 col-from-label">{{translate('Flat Rate')}}</label>

                            <div class="col-lg-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type == 'flat_rate') checked @endif>

                                    <span></span>

                                </label>

                            </div>

                        </div>


                        <div class="flat_rate_shipping_div" style="display: none">

                            <div class="form-group row">

                                <label class="col-lg-6 col-from-label">{{translate('Shipping cost')}}</label>

                                <div class="col-lg-6">

                                    <input type="number" lang="en" min="0" value="{{ $product->shipping_cost }}" step="0.01" placeholder="{{ translate('Shipping cost') }}" name="flat_shipping_cost" class="form-control">

                                </div>

                            </div>

                        </div>


                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Is Product Quantity Mulitiply')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="checkbox" name="is_quantity_multiplied" value="1" @if($product->is_quantity_multiplied == 1) checked @endif>

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

                            <input type="number" name="low_stock_quantity" value="{{ $product->low_stock_quantity }}" min="0" step="1" class="form-control">

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

                                    <input type="radio" name="stock_visibility_state" value="quantity" @if($product->stock_visibility_state == 'quantity') checked @endif>

                                    <span></span>

                                </label>

                            </div>

                        </div>


                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Show Stock With Text Only')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="stock_visibility_state" value="text" @if($product->stock_visibility_state == 'text') checked @endif>

                                    <span></span>

                                </label>

                            </div>

                        </div>


                        <div class="form-group row">

                            <label class="col-md-6 col-from-label">{{translate('Hide Stock')}}</label>

                            <div class="col-md-6">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="radio" name="stock_visibility_state" value="hide" @if($product->stock_visibility_state == 'hide') checked @endif>

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

                            <div class="col-md-12">

                                <div class="form-group row">

                                    <label class="col-md-6 col-from-label">{{translate('Status')}}</label>

                                    <div class="col-md-6">

                                        <label class="aiz-switch aiz-switch-success mb-0">

                                            <input type="checkbox" name="cash_on_delivery" value="1" @if($product->cash_on_delivery == 1) checked @endif>

                                            <span></span>

                                        </label>

                                    </div>

                                </div>

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

                            <div class="col-md-12">

                                <div class="form-group row">

                                    <label class="col-md-6 col-from-label">{{translate('Status')}}</label>

                                    <div class="col-md-6">

                                        <label class="aiz-switch aiz-switch-success mb-0">

                                            <input type="checkbox" name="featured" value="1" @if($product->featured == 1) checked @endif>

                                            <span></span>

                                        </label>

                                    </div>

                                </div>

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

                            <div class="col-md-12">

                                <div class="form-group row">

                                    <label class="col-md-6 col-from-label">{{translate('Status')}}</label>

                                    <div class="col-md-6">

                                        <label class="aiz-switch aiz-switch-success mb-0">

                                            <input type="checkbox" name="todays_deal" value="1" @if($product->todays_deal == 1) checked @endif>

                                            <span></span>

                                        </label>

                                    </div>

                                </div>

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

                            <select class="form-control aiz-selectpicker" name="flash_deal_id" id="video_provider">

                                <option value="">{{ translate('Choose Flash Title') }}</option>

                                @foreach(\App\Models\FlashDeal::where("status", 1)->get() as $flash_deal)

                                    <option value="{{ $flash_deal->id }}" @if($product->flash_deal_product && $product->flash_deal_product->flash_deal_id == $flash_deal->id) selected @endif>

                                        {{ $flash_deal->title }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="form-group mb-3">

                            <label for="name">

                                {{translate('Discount')}}

                            </label>

                            <input type="number" name="flash_discount" value="{{ $product->discount }}" min="0" step="0.01" class="form-control">

                        </div>

                        <div class="form-group mb-3">

                            <label for="name">

                                {{translate('Discount Type')}}

                            </label>

                            <select class="form-control aiz-selectpicker" name="flash_discount_type" id="">

                                <option value="">{{ translate('Choose Discount Type') }}</option>

                                <option value="amount" @if($product->discount_type == 'amount') selected @endif>

                                    {{translate('Flat')}}

                                </option>

                                <option value="percent" @if($product->discount_type == 'percent') selected @endif>

                                    {{translate('Percent')}}

                                </option>

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

                                <input type="number" class="form-control" name="est_shipping_days" value="{{ $product->est_shipping_days }}" min="1" step="1" placeholder="{{translate('Shipping Days')}}">

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


                        @php

                        $tax_amount = 0;

                        $tax_type = '';

                        foreach($tax->product_taxes as $row) {

                            if($product->id == $row->product_id) {

                                $tax_amount = $row->tax;

                                $tax_type = $row->tax_type;

                            }

                        }

                        @endphp


                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <input type="number" lang="en" min="0" value="{{ $tax_amount }}" step="0.01" placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>

                            </div>

                            <div class="form-group col-md-6">

                                <select class="form-control aiz-selectpicker" name="tax_type[]">

                                    <option value="amount" @if($tax_type == 'amount') selected @endif>

                                        {{translate('Flat')}}

                                    </option>

                                    <option value="percent" @if($tax_type == 'percent') selected @endif>

                                        {{translate('Percent')}}

                                    </option>

                                </select>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>


            </div>

            <div class="col-12">

                <div class="mb-3 text-right">

                    <button type="submit" name="button" class="btn btn-info">{{ translate('Update Product') }}</button>

                </div>

            </div>

        </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

    var counter = {{$counter}};

    function Addfildfrequently() {

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
                    <div class="col-5">
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
                    <div class="col-5">
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
                    <div class="col-5">
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
                    <div class="col-5">
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

    $(document).ready(function (){

        show_hide_shipping_div();

    });

    $("[name=shipping_type]").on("change", function (){

        show_hide_shipping_div();

    });

    function show_hide_shipping_div() {

        var shipping_val = $("[name=shipping_type]:checked").val();


        $(".flat_rate_shipping_div").hide();


        if(shipping_val == 'flat_rate'){

            $(".flat_rate_shipping_div").show();

        }
    }


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

        if(!$('input[name="colors_active"]').is(':checked')){

            $('#colors').prop('disabled', true);

            AIZ.plugins.bootstrapSelect('refresh');

        }
        else{
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

    function delete_row(em){

        $(em).closest('.form-group').remove();

        update_sku();

    }

    function delete_variant(em){

        $(em).closest('.variant').remove();

    }

    function update_sku(){

        $.ajax({

           type:"POST",

           url:'{{ route('products.sku_combination_edit') }}',

           data:$('#choice_form').serialize(),

           success: function(data){

                $('#sku_combination').html(data);

                setTimeout(() => {

                        AIZ.uploader.previewGenerate();

                }, "2000");

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

    AIZ.plugins.tagify();


    $(document).ready(function(){

        update_sku();


        $('.remove-files').on('click', function(){

            $(this).parents(".col-md-4").remove();

        });
    });

    $('#choice_attributes').on('change', function() {

        $.each($("#choice_attributes option:selected"), function(j, attribute){

            flag = false;

            $('input[name="choice_no[]"]').each(function(i, choice_no) {

                if($(attribute).val() == $(choice_no).val()){

                    flag = true;

                }

            });

            if(!flag){

                add_more_customer_choice_option($(attribute).val(), $(attribute).text());

            }
        });

        var str = @php echo $product->attributes @endphp;


        $.each(str, function(index, value){

            flag = false;

            $.each($("#choice_attributes option:selected"), function(j, attribute){

                if(value == $(attribute).val()){

                    flag = true;

                }

            });

            if(!flag){

                $('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();

            }
        });

        update_sku();

    });

</script>

@endsection

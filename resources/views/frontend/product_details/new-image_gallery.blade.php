@php
    $photos = [];
@endphp
@if ($detailedProduct->photos != null)
    @php
         $photos = explode(',', $detailedProduct->photos);
    @endphp
@endif
    
<!-- <div class="product-dtl-img row">
<div id="sync2" class="owl-carousel owl-theme col-md-3">

@foreach ($photos as $key => $photo)

     <div class="item">

         <img src="{{ uploaded_asset($photo) }}" alt="landscape" />

     </div>

 @endforeach


</div>
    <div id="sync1" class="owl-carousel owl-theme col-md-9">
    @foreach ($photos as $key => $photo)
        <div class="item">

            <h4>
                <a href="{{ uploaded_asset($photo) }}" data-lightbox="product-gallery">
                    <img src="{{ uploaded_asset($photo) }}" alt="landscape" />
                </a>
                <i class="fa fa-search-plus" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="zoom image"></i>
            </h4>
        </div>
    @endforeach
    
    </div>

    
</div> -->
<style>
   .slider-for img {
            width: 100%;
            max-height: 600px;object-fit:contain;
        }
        .slider-nav {
            display: flex;
            flex-direction: column;
        }
        .slider-nav .slick-slide {
            cursor: pointer;
            /* margin: 5px 0; */
        }
       
        .slider-nav img {
            width: 60px;
  height: 60px;
  border: 1px solid #c6c6d0;
  border-radius: 10px;
  margin-left: 10px;object-fit: contain;
        }

        .slider-nav .slick-current img{  border: 1px solid #28d;}
        .zoom-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 50%;
            color: white;
        }
        .slider-for a {
            position: relative;
            display: block;padding: 100px;background: whitesmoke;
        }
        .slider-for a svg {
            width: 24px;
            height: 24px;
        }

        .slick-vertical{position: absolute;
  top: 50%;
  transform: translateY(-50%);}
</style>


<!-- Main Slider 9 -->
<div class="slider-for">
    @foreach ($photos as $key => $photo)
        <div>
            <a data-fancybox="gallery" href="{{ uploaded_asset($photo) }}">
                <img src="{{ uploaded_asset($photo) }}" alt="Image 1">
                <div class="zoom-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 448 512">
                        <path d="M416 176V86.63L246.6 256 416 425.4V336c0-8.844 7.156-16 16-16s16 7.156 16 16v128c0 8.844-7.156 16-16 16h-128c-8.844 0-16-7.156-16-16s7.156-16 16-16h89.38L224 278.6 54.63 448H144C152.8 448 160 455.2 160 464S152.8 480 144 480h-128C7.156 480 0 472.8 0 464v-128C0 327.2 7.156 320 16 320S32 327.2 32 336v89.38L201.4 256 32 86.63V176C32 184.8 24.84 192 16 192S0 184.8 0 176v-128C0 39.16 7.156 32 16 32h128C152.8 32 160 39.16 160 48S152.8 64 144 64H54.63L224 233.4 393.4 64H304C295.2 64 288 56.84 288 48S295.2 32 304 32h128C440.8 32 448 39.16 448 48v128C448 184.8 440.8 192 432 192S416 184.8 416 176z"></path>
                    </svg>
                </div>
            </a>
        </div>
    @endforeach
    <!-- Add more slides as needed -->
</div>

<!-- Thumbnail Slider 3-->
<div class="slider-nav">
    @foreach ($photos as $key => $photo)
        <div>
            <img src="{{ uploaded_asset($photo) }}" alt="Thumbnail 1">
        </div>
    @endforeach    
    <!-- Add more thumbnails as needed -->
</div>
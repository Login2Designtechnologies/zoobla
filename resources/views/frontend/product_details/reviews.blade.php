<div class="review-swiper-box">
    <ul class="rev-qus-sec reviews-area swiper-wrapper">

    @foreach ($reviews as $key => $review)

    @if ($review->user != null)


    

        <li class="swiper-slide">


            <div class="review-info-left">

                <div class="row align-items-center">
                    <div class="col-6">
                        <h6 class="name">{{$review->user->name }}</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="date">{{ date('M-d-Y', strtotime($review->created_at)) }}</h6>
                    </div>
                </div>

                <h6 class="verified-txt">Verified <span><i class="fa fa-check-circle" aria-hidden="true"></i></span></h6>

                <h4>
                    
                    <span class="rating rating-mr-1">

                        @for ($i = 0; $i < $review->rating; $i++)
                            <i class="las la-star active"></i>
                        @endfor
                        @for ($i = 0; $i < 5 - $review->rating; $i++)
                            <i class="las la-star"></i>
                        @endfor

                    </span>

                </h4>

            </div>



            <div class="review-info-right">

                <p> {{ $review->comment }}</p>

            </div>


        </li>

    @endif

    @endforeach
    </ul>
        <!-- If you need pagination -->
        <div class="swiper-pagination"></div>
        <!-- If you need navigation buttons -->
        <!-- <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> -->
</div>

        

  @if (count($reviews) <= 0)

        <div class="text-center fs-18 opacity-70">

            {{ translate('There have been no reviews for this product yet.') }}

        </div>

  @endif

    <!-- Pagination -->

    <div class="aiz-pagination product-reviews-pagination py-2 px-4 d-flex justify-content-center">

        {{ $reviews->links() }}

    </div>
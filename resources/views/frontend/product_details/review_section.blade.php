<!-- product-overview-section -->
<section class="product-overview-section">
    <div class="container p-0">
        @if ($detailedProduct->auction_product)
            @php
                $highest_bid = $detailedProduct->bids->max('amount');
                $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $detailedProduct->starting_bid;
            @endphp
            @if ($detailedProduct->auction_end_date >= strtotime('now'))
                <div class="mt-4">
                    @if (Auth::check() && $detailedProduct->user_id == Auth::user()->id)
                        <span
                            class="badge badge-inline badge-danger">{{ translate('Seller cannot Place Bid to His Own Product') }}</span>
                    @else
                        <button type="button" class="btn btn-primary buy-now  fw-600 min-w-150px rounded-0"
                            onclick="bid_modal()">
                            <i class="las la-gavel"></i>
                            @if (Auth::check() &&
                                    Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first() != null)
                                {{ translate('Change Bid') }}
                            @else
                                {{ translate('Place Bid') }}
                            @endif
                        </button>
                    @endif
                </div>
            @endif
        @else
            <!-- Add to cart & Buy now Buttons -->
            {{--<div class="mt-3">
                @if ($detailedProduct->digital == 0)
                    @if ($detailedProduct->external_link != null)
                        <a type="button" class="btn btn-primary buy-now fw-600 add-to-cart px-4 rounded-0"
                            href="{{ $detailedProduct->external_link }}">
                            <i class="la la-share"></i> {{ translate($detailedProduct->external_link_btn) }}
                        </a>
                    @else
                        <button type="button"
                            class="btn-dark mr-2 add-to-cart fw-600 border-0 rounded-2 p-2 text-white"
                            @if (Auth::check()) onclick="addToCart()" @else onclick="showLoginModal()" @endif>
                            <i class="las la-shopping-bag"></i>
                            <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                        </button>
                        <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0"
                            @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal()" @endif>
                            <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                        </button>
                    @endif
                    <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                        <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}
                    </button>
                @elseif ($detailedProduct->digital == 1)
                    <button type="button"
                        class="btn-dark mr-2 add-to-cart fw-600 border-0 rounded-2 p-2 text-white"
                        @if (Auth::check()) onclick="addToCart()" @else onclick="showLoginModal()" @endif>
                        <i class="las la-shopping-bag"></i>
                        <span class="d-none d-md-inline-block"> {{ translate('Add to cart') }}</span>
                    </button>
                    <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0"
                        @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal()" @endif>
                        <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                    </button>
                @endif
            </div>--}}
            <!-- Description -->
            <div class="row no-gutters pb-3 ml-0">
                <!-- Tabs -->
                <div class="nav aiz-nav-tabs">
                    <a href="#tab_default_1" data-toggle="tab"
                        class="mr-5 pb-2 fs-16 fw-700 text-reset active show">{{ translate('OverView') }}</a>
                    @if ($detailedProduct->video_link != null)
                        <a href="#tab_default_2" data-toggle="tab"
                            class="mr-5 pb-2 fs-16 fw-700 text-reset">{{ translate('Video') }}</a>
                    @endif
                    @if ($detailedProduct->pdf != null)
                        <a href="#tab_default_3" data-toggle="tab"
                            class="mr-5 pb-2 fs-16 fw-700 text-reset">{{ translate('Downloads') }}</a>
                    @endif
                </div>

                <!-- Description -->
                <div class="tab-content p-0">
                    <!-- Description -->
                    <div class="tab-pane fade active show" id="tab_default_1">
                        <div class="py-2">
                            <div class="mw-100 overflow-hidden text-left aiz-editor-data">
                                
                                <?php echo $detailedProduct->getTranslation('description'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Video -->
                    <div class="tab-pane fade" id="tab_default_2">
                        <div class="py-5">
                            <div class="embed-responsive embed-responsive-16by9">
                                @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                    <iframe class="embed-responsive-item"
                                        src="https://www.youtube.com/embed/{{ get_url_params($detailedProduct->video_link, 'v') }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                    <iframe class="embed-responsive-item"
                                        src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                    <iframe
                                        src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}"
                                        width="500" height="281" frameborder="0" webkitallowfullscreen
                                        mozallowfullscreen allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Download -->
                    <div class="tab-pane fade" id="tab_default_3">
                        <div class="py-5 text-center ">
                            <a href="{{ uploaded_asset($detailedProduct->pdf) }}"
                                class="btn btn-primary">{{ translate('Download') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Description -->
            <!-- Promote Link -->
            <div class="d-table width-100 mt-3">
                <div class="d-table-cell">
                    @if (Auth::check() &&
                            addon_is_activated('affiliate_system') &&
                            get_affliate_option_status() &&
                            Auth::user()->affiliate_user != null &&
                            Auth::user()->affiliate_user->status)
                        @php
                            if (Auth::check()) {
                                if (Auth::user()->referral_code == null) {
                                    Auth::user()->referral_code = substr(Auth::user()->id . Str::random(10), 0, 10);
                                    Auth::user()->save();
                                }
                                $referral_code = Auth::user()->referral_code;
                                $referral_code_url = URL::to('/product') . '/' . $detailedProduct->slug . "?product_referral_code=$referral_code";
                            }
                        @endphp
                        <div>
                            <button type="button" id="ref-cpurl-btn" class="btn btn-secondary w-200px rounded-0"
                                data-attrcpy="{{ translate('Copied') }}" onclick="CopyToClipboard(this)"
                                data-url="{{ $referral_code_url }}">{{ translate('Copy the Promote Link') }}</button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Refund -->
            @php
                $refund_sticker = get_setting('refund_sticker');
            @endphp
            @if (addon_is_activated('refund_request'))
                <div class="row no-gutters mt-3 ml-0">
                    <div class="col-sm-2">
                        <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Refund') }}</div>
                    </div>
                    <div class="col-sm-10">
                        @if ($detailedProduct->refundable == 1)
                            <a href="{{ route('returnpolicy') }}" target="_blank">
                                @if ($refund_sticker != null)
                                    <img src="{{ uploaded_asset($refund_sticker) }}" height="36">
                                @else
                                    <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">
                                @endif
                            </a>
                            <a href="{{ route('returnpolicy') }}" class="text-blue hov-text-primary fs-14 ml-3"
                                target="_blank">{{ translate('View Policy') }}</a>
                        @else
                            <div class="text-dark fs-14 fw-400 mt-2">{{ translate('Not Applicable') }}</div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Seller Guarantees -->
            @if ($detailedProduct->digital == 1)
                @if ($detailedProduct->added_by == 'seller')
                    <div class="row no-gutters mt-3 ml-0">
                        <div class="col-2">
                            <div class="text-secondary fs-14 fw-400">{{ translate('Seller Guarantees') }}</div>
                        </div>
                        <div class="col-10">
                            @if ($detailedProduct->user->shop->verification_status == 1)
                                <span class="text-success fs-14 fw-700">{{ translate('Verified seller') }}</span>
                            @else
                                <span class="text-danger fs-14 fw-700">{{ translate('Non verified seller') }}</span>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        @endif
    </div>
</section>
<!-- ./product-overview-section -->

<div class="bg-white border mb-4">

    <div class="p-3 p-sm-4">

        <h3 class="fs-16 fw-700 mb-0">

            <span class="mr-4">{{ translate('Reviews & Ratings') }}</span>

        </h3>

    </div>

    <!-- Ratting -->

    <div class="px-3 px-sm-4 mb-4">

        <div class="border border-warning bg-soft-warning p-3 p-sm-4">

            <div class="row align-items-center">

                <div class="col-md-8 mb-3">

                    <div class="d-flex align-items-center justify-content-between justify-content-md-start">

                        <div class="w-100 w-sm-auto">

                            <span class="fs-36 mr-3">{{ $detailedProduct->rating }}</span>

                            <span class="fs-14 mr-3">{{ translate('out of 5.0') }}</span>

                        </div>

                        <div class="mt-sm-3 w-100 w-sm-auto d-flex flex-wrap justify-content-end justify-content-md-start">

                            @php

                                $total = 0;

                                $total += $detailedProduct->reviews->count();

                            @endphp

                            <span class="rating rating-mr-1">

                                {{ renderStarRating($detailedProduct->rating) }}

                            </span>

                            <span class="ml-1 fs-14">({{ $total }}

                                {{ translate('reviews') }})</span>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 text-right">

                    <a  href="javascript:void(0);" onclick="product_review('{{ $detailedProduct->id }}')" 

                        class="btn btn-warning fw-400 rounded-0 text-white">

                        <span class="d-md-inline-block"> {{ translate('Rate this Product') }}</span>

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Reviews -->

    @include('frontend.product_details.reviews')

</div>
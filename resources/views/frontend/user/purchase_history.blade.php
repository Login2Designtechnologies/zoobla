@extends('frontend.layouts.user_panel')

<style>
    .footable-empty {
    display: none;
}
</style>

@section('panel_content')

    <div class="card shadow-none rounded-0 border">

        <div class="card-header border-bottom-0">

            <h5 class="mb-0 fs-20 fw-700 text-dark">{{ translate('Order History') }}</h5>

        </div>

        <div class="card-body">

            <table class="table aiz-table mb-0">

                <thead class="text-gray fs-12">

                    <tr>

                        <th class="pl-0">{{ translate('Code')}}</th>

                        <th data-breakpoints="md">{{ translate('Date')}}</th>

                        <th>{{ translate('Amount')}}</th>

                        <th data-breakpoints="md">{{ translate('Delivery Status')}}</th>

                        <th data-breakpoints="md">{{ translate('Payment Status')}}</th>

                        <th class="text-right pr-0">{{ translate('Options')}}</th>

                    </tr>

                </thead>

                <tbody class="fs-14">

                  @if($orders->isNotEmpty())
                    @foreach ($orders as $key => $order)
                      
                  @php
                    $userdata = Auth::user();
                    $orderdetails = DB::table('order_details')->where('order_id',$order->id)->first();
                    $review = DB::table('reviews')->where('product_id',$orderdetails->product_id)->where('user_id',$userdata->id)->first();
                  @endphp

                        @if (count($order->orderDetails) > 0)

                            <tr>

                                <!-- Code -->

                                <td class="pl-0">
                                    
                                    <a href="{{route('purchase_history.details', encrypt($order->id))}}">{{ $order->code }}</a>

                                </td>

                                <!-- Date -->

                                <td class="text-secondary">{{ date('m-d-Y', $order->date) }}</td>

                                <!-- Amount -->

                                <td class="fw-700">

                                    {{ single_price($order->grand_total) }}

                                </td>

                                <!-- Delivery Status -->

                                <td class="fw-700">

                                    {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}

                                    @if($order->delivery_viewed == 0)

                                        <span class="ml-2" style="color:green"><strong>*</strong></span>

                                    @endif

                                </td>

                                <!-- Payment Status -->

                                <td>

                                    @if ($order->payment_status == 'paid')

                                        <span class="badge badge-inline badge-success p-3 fs-12 d-inline-flex align-items-cente" style="border-radius: 25px; min-width: 80px !important;">{{translate('Paid')}}</span>

                                    @else

                                        <span class="badge badge-inline badge-danger p-3 fs-12 d-inline-flex align-items-cente" style="border-radius: 25px; min-width: 80px !important;">{{translate('Unpaid')}}</span>

                                    @endif

                                    @if($order->payment_status_viewed == 0)

                                        <span class="ml-2" style="color:green"><strong>*</strong></span>

                                    @endif

                                </td>

                                <!-- Options -->

                                <td class="text-right pr-0">

                                    <!-- Re-order -->

                                    <a class="btn-soft-white rounded-3 btn-sm mr-1" href="{{ route('re_order', encrypt($order->id)) }}">

                                        {{ translate('Reorder') }}

                                    </a>

                                    <!-- Cancel -->

                                    @if ($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')

                                        <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm hov-svg-white mt-2 mt-sm-0 confirm-delete" data-href="{{route('purchase_history.destroy', $order->id)}}" title="{{ translate('Cancel') }}">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="9.202" height="12" viewBox="0 0 9.202 12">

                                                <path id="Path_28714" data-name="Path 28714" d="M15.041,7.608l-.193,5.85a1.927,1.927,0,0,1-1.933,1.864H9.243A1.927,1.927,0,0,1,7.31,13.46L7.117,7.608a.483.483,0,0,1,.966-.032l.193,5.851a.966.966,0,0,0,.966.929h3.672a.966.966,0,0,0,.966-.931l.193-5.849a.483.483,0,1,1,.966.032Zm.639-1.947a.483.483,0,0,1-.483.483H6.961a.483.483,0,1,1,0-.966h1.5a.617.617,0,0,0,.615-.555,1.445,1.445,0,0,1,1.442-1.3h1.126a1.445,1.445,0,0,1,1.442,1.3.617.617,0,0,0,.615.555h1.5a.483.483,0,0,1,.483.483ZM9.913,5.178h2.333a1.6,1.6,0,0,1-.123-.456.483.483,0,0,0-.48-.435H10.516a.483.483,0,0,0-.48.435,1.6,1.6,0,0,1-.124.456ZM10.4,12.5V8.385a.483.483,0,0,0-.966,0V12.5a.483.483,0,1,0,.966,0Zm2.326,0V8.385a.483.483,0,0,0-.966,0V12.5a.483.483,0,1,0,.966,0Z" transform="translate(-6.478 -3.322)" fill="#d43533"/>

                                            </svg>

                                        </a>

                                    @endif

                                    <!-- Details -->

                                    <a href="{{route('purchase_history.details', encrypt($order->id))}}" class="btn btn-soft-info btn-icon btn-circle btn-sm hov-svg-white mt-2 mt-sm-0" title="{{ translate('Order Details') }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10">

                                            <g id="Group_24807" data-name="Group 24807" transform="translate(-1339 -422)">

                                                <rect id="Rectangle_18658" data-name="Rectangle 18658" width="12" height="1" transform="translate(1339 422)" fill="#3490f3"/>

                                                <rect id="Rectangle_18659" data-name="Rectangle 18659" width="12" height="1" transform="translate(1339 425)" fill="#3490f3"/>

                                                <rect id="Rectangle_18660" data-name="Rectangle 18660" width="12" height="1" transform="translate(1339 428)" fill="#3490f3"/>

                                                <rect id="Rectangle_18661" data-name="Rectangle 18661" width="12" height="1" transform="translate(1339 431)" fill="#3490f3"/>

                                            </g>

                                        </svg>

                                    </a>

                                    <!-- Invoice -->

                                    <a class="btn btn-soft-warning btn-icon btn-circle btn-sm hov-svg-white mt-2 mt-sm-0" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12.001" viewBox="0 0 12 12.001">

                                            <g id="Group_24807" data-name="Group 24807" transform="translate(-1341 -424.999)">

                                              <path id="Union_17" data-name="Union 17" d="M13936.389,851.5l.707-.707,2.355,2.355V846h1v7.1l2.306-2.306.707.707-3.538,3.538Z" transform="translate(-12592.95 -421)" fill="#f3af3d"/>

                                              <rect id="Rectangle_18661" data-name="Rectangle 18661" width="12" height="1" transform="translate(1341 436)" fill="#f3af3d"/>

                                            </g>

                                        </svg>

                                    </a>

                                    <!-- Review -->
                                    <a class="btn btn-soft-warning btn-icon btn-circle btn-sm hov-svg-white mt-2 mt-sm-0" href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#review{{$order->id}}">
                                        <svg version="1.1" width="15" height="15" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                                            </style>
                                            <path class="st0" d="M3,8v14c0,1.1,0.9,2,2,2h16.8l7.3,6v-6V8c0-1.1-0.9-2-2-2H5C3.9,6,3,6.9,3,8z"/>
                                            <polygon class="st0" points="12,9.9 13.5,13.1 17,13.6 14.5,16 15.1,19.4 12,17.8 8.9,19.4 9.5,16 7,13.6 10.5,13.1 "/>
                                            <line class="st0" x1="20" y1="13" x2="25" y2="13"/>
                                            <line class="st0" x1="22" y1="17" x2="25" y2="17"/>
                                        </svg>
                                    </a>

                                    <div class="modal" id="review{{$order->id}}">
                                      <div class="modal-dialog">
                                        <div class="modal-content">

                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                            <h4 class="modal-title">Write Your Review</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                          </div>

                                          <!-- Modal body -->
                                          <div class="modal-body text-left m-0">
                                            <div class="review-modal">
                                      @if($review == null)
                                              <form action="{{ route('reviews.store') }}" method="POST" >

                                            @csrf

                                            <input type="hidden" name="product_id" value="{{ $orderdetails->product_id }}">

                                            <div class="modal-body p-0">

                                                <!-- Rating -->

                                                <div class="form-group">

                                                    <label class="opacity-60">{{ translate('Rating')}}</label>

                                                    <div class="rating rating-input">

                                                        <label>

                                                            <input type="radio" name="rating" value="1" required>

                                                            <i class="las la-star"></i>

                                                        </label>

                                                        <label>

                                                            <input type="radio" name="rating" value="2">

                                                            <i class="las la-star"></i>

                                                        </label>

                                                        <label>

                                                            <input type="radio" name="rating" value="3">

                                                            <i class="las la-star"></i>

                                                        </label>

                                                        <label>

                                                            <input type="radio" name="rating" value="4">

                                                            <i class="las la-star"></i>

                                                        </label>

                                                        <label>

                                                            <input type="radio" name="rating" value="5">

                                                            <i class="las la-star"></i>

                                                        </label>

                                                    </div>

                                                </div>

                                                <!-- Comment -->

                                                <div class="form-group">

                                                    <label class="opacity-60">{{ translate('Comment')}}</label>

                                                    <textarea class="form-control rounded-0" rows="4" name="comment" placeholder="{{ translate('Your review')}}" required></textarea>

                                                </div>

                                                <!-- Review Images -->


                                            </div>

                                            <div class="modal-footer">

                                                <button type="submit" class="btn btn-sm btn-primary rounded-0">{{translate('Submit Review')}}</button>

                                            </div>

                                        </form>

                                         @else

                                  <!-- Review -->

                                  <li class="media list-group-item d-flex">

                                      <div class="media-body text-left">

                                          <!-- Rating -->

                                          <div class="form-group">

                                              <label class="opacity-60">{{ translate('Rating')}}</label>

                                              <p class="rating rating-sm">

                                                  @for ($i=0; $i < $review->rating; $i++)

                                                      <i class="las la-star active"></i>

                                                  @endfor

                                                  @for ($i=0; $i < 5-$review->rating; $i++)

                                                      <i class="las la-star"></i>

                                                  @endfor

                                              </p>

                                          </div>

                                          <!-- Comment -->

                                          <div class="form-group">

                                              <label class="opacity-60">{{ translate('Comment')}}</label>

                                              <p class="comment-text">

                                                  {{ $review->comment }}

                                              </p>

                                          </div>

                                      </div>

                                  </li>

                              @endif

                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                    </div>


                                </td>

                            </tr>

                        @endif

                    @endforeach

                    @else
                      
                      <p class="text-center">Nothing found</p>
                      
                     @endif

                </tbody>

            </table>

            <!-- Pagination -->

            <div class="aiz-pagination mt-2">

                {{ $orders->links() }}

            </div>

        </div>

    </div>

@endsection



@section('modal')

    <!-- Delete modal -->

    @include('modals.delete_modal')



<!-- The Modal -->
<!-- <div class="modal" id="reviewModal">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Write Your Review</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

     
      <div class="modal-body">
        <div class="review-modal">
        <form action="{{ route('reviews.store') }}" method="POST" >
           @csrf
            <div id="rating" class="mb-2">
                <svg class="star" id="1" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
                    <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                </svg>
                <svg class="star" id="2" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
                    <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                </svg>
                <svg class="star" id="3" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
                    <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                </svg>
                <svg class="star" id="4" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f39c12;">
                    <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                </svg>
                <svg class="star" id="5" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #808080;">
                    <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                </svg>
            </div>
            <span id="starsInfo" class="help-block">
                Click on a star to change your rating 1 - 5, where 5 = great! and 1 = really bad
            </span>
            <div class="form-group mt-2">
                <label class="control-label" for="review">Your Review:</label>
                <textarea class="form-control" rows="10" placeholder="Your Reivew" name="review" id="review"></textarea>
                <span id="reviewInfo" class="help-block d-inline-block justify-content-end"> <span id="remaining">999</span> Characters remaining </span>
            </div>
            
            <div class="btn-block text-right">
               <button type="submit" class="btn btn-sm btn-primary rounded-0">{{translate('Submit')}}</button>
            </div>
        </form>

        </div>
      </div>

    </div>
  </div>
</div> -->


<script>
    function starsReducer(state, action) {
    switch (action.type) {
      case 'HOVER_STAR': {
        return {
          starsHover: action.value,
          starsSet: state.starsSet
        }
      }
      case 'CLICK_STAR': {
        return {
          starsHover: state.starsHover,
          starsSet: action.value
        }
      }
        break;
      default:
        return state
    }
  }

  var StarContainer = document.getElementById('rating');
  var StarComponents = StarContainer.children;

  var state = {
    starsHover: 0,
    starsSet: 4
  }

  function render(value) {
    for(var i = 0; i < StarComponents.length; i++) {
      StarComponents[i].style.fill = i < value ? '#f39c12' : '#808080'
    }
  }

  for (var i=0; i < StarComponents.length; i++) {
    StarComponents[i].addEventListener('mouseenter', function() {
      state = starsReducer(state, {
        type: 'HOVER_STAR',
        value: this.id
      })
      render(state.starsHover);
    })

    StarComponents[i].addEventListener('click', function() {
      state = starsReducer(state, {
        type: 'CLICK_STAR',
        value: this.id
      })
      render(state.starsHover);
    })
  }

  StarContainer.addEventListener('mouseleave', function() {
    render(state.starsSet);
  })

  var review = document.getElementById('review');
  var remaining = document.getElementById('remaining');
  review.addEventListener('input', function(e) {
    review.value = (e.target.value.slice(0,999));
    remaining.innerHTML = (999-e.target.value.length);
  })

  

  var reviews = {
    reviews: [
      {
        stars: 3,
        name: 'bob',
        city: 'Noosk',
        review: '1 Thompson Greenspon is so grateful to have worked with CPASiteSolutions on our'
      },{
        stars: 4,
        name: 'bobbo',
        city: 'WinNoosk',
        review: '2 Thompson Greenspon is so grateful to have worked with CPASiteSolutions on our'
      },{
        stars: 2,
        name: 'bobster',
        city: 'NooSKI',
        review: '3 Thompson Greenspon is so grateful to have worked with CPASiteSolutions on our'
      },
    ]
  }

  function ReviewStarContainer(stars) {
    var div = document.createElement('div');
    div.className = "stars-container";
    for (var i = 0; i < 5; i++) {
      var svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      svg.setAttribute('viewBox',"0 12.705 512 486.59");
      svg.setAttribute('x',"0px");
      svg.setAttribute('y',"0px");
      svg.setAttribute('xml:space',"preserve");
      svg.setAttribute('class',"star");
      var svgNS = svg.namespaceURI;
      var star = document.createElementNS(svgNS,'polygon');
      star.setAttribute('points', '256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566');
      star.setAttribute('fill', i < stars ? '#f39c12' : '#808080');
      svg.appendChild(star);
      div.appendChild(svg);
    }
    return div;
  }

  function ReviewContentContainer(name, city, review) {

    var reviewee = document.createElement('div');
    reviewee.className = "reviewee footer";
    reviewee.innerHTML  = '- ' + name + ', ' + city

    var comment = document.createElement('p');
    comment.innerHTML = review;

    var div = document.createElement('div');
    div.className = "review-content";
    div.appendChild(comment);
    div.appendChild(reviewee);

    return div;
  }

  function ReviewsContainer(review) {
    var div = document.createElement('blockquote');
    div.className = "review";
    div.appendChild(ReviewStarContainer(review.stars));
    div.appendChild(ReviewContentContainer(review.name,review.city,review.review));
    return div;
  }

  for(var i = 0; i < reviews.reviews.length; i++) {
    document.getElementById('review-container').appendChild(ReviewsContainer(reviews.reviews[i]))
  }
</script>

@endsection




@php
    $cart_added = [];
@endphp
<div class="aiz-card-box h-auto bg-white card card-product my-2">
    <div class="card-body">
        <div class="card-body position-relative h-140px h-md-200px img-fit overflow-hidden">
            @php
                $product_url = route('product', $product->slug);
                if ($product->auction_product == 1) {
                    $product_url = route('auction-product', $product->slug);
                }
            @endphp
            <!-- Image -->
            <a href="{{ $product_url }}" class="d-block h-100">
                <img class="lazyload mx-auto img-fit has-transition"
                    src="{{ uploaded_asset($product->thumbnail_img)?? static_asset('assets/img/placeholder.jpg') }}"
                    alt="{{ $product->getTranslation('name') }}" title="{{ $product->getTranslation('name') }}"
                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
            </a>
            <!-- Discount percentage tag -->
            @if (discount_in_percentage($product) > 0)
                <span class="absolute-top-left bg-primary ml-1 mt-1 fs-11 fw-700 text-white w-35px text-center"
                    style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($product) }}%</span>
            @endif
            <!-- Wholesale tag -->
            @if ($product->wholesale_product)
                <span class="absolute-top-left fs-11 text-white fw-700 px-2 lh-1-8 ml-1 mt-1"
                    style="background-color: #455a64; @if (discount_in_percentage($product) > 0) top:25px; @endif">
                    {{ translate('Wholesale') }}
                </span>
            @endif
            @if ($product->auction_product == 0)
                <!-- wishlisht & compare icons -->
                <div class="absolute-top-right aiz-p-hov-icon">
                    <a href="javascript:void(0)" class="hov-svg-white" onclick="addToWishList({{ $product->id }})"
                        data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </a>
                </div>
            @endif
            @if (
                $product->auction_product == 1 &&
                    $product->auction_start_date <= strtotime('now') &&
                    $product->auction_end_date >= strtotime('now'))
                <!-- Place Bid -->
                @php
                    $carts = get_user_cart();
                    if (count($carts) > 0) {
                        $cart_added = $carts->pluck('product_id')->toArray();
                    }
                    $highest_bid = $product->bids->max('amount');
                    $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $product->starting_bid;
                @endphp
                <a class="cart-btn absolute-bottom-left w-100 h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column justify-content-center align-items-center @if (in_array($product->id, $cart_added)) active @endif"
                    href="javascript:void(0)" onclick="bid_single_modal({{ $product->id }}, {{ $min_bid_amount }})">
                    <span class="cart-btn-text">{{ translate('Place Bid') }}</span>
                    <br>
                    <span><i class="las la-2x la-gavel"></i></span>
                </a>
            @endif
        </div>

        <div class="p-2 p-md-2 text-left">
            @if ($product->main_category != null)
                <!-- Category name -->
                <div class="text-small mb-1">
                    <a href="{{ $product->main_category->slug }}" class="text-decoration-none text-muted"><small>{{ $product->main_category->getTranslation('name') }}</small></a>
                </div>
            @endif
            <!-- Product name -->
            <h2 class="fw-400 fs-13 text-truncate-2 lh-1-4 h-35px">
                <a href="{{ $product_url }}" class="text-inherit text-decoration-none"title="{{ $product->getTranslation('name') }}">{{ $product->getTranslation('name') }}</a>
            </h2>
            <!-- <div>
                <span class="rating text-warning">
                    {{-- renderStarRating($product->rating) --}}
                </span>
            </div> -->
            <div class="d-flex justify-content-between align-items-center mt-3 mbs">
                @if ($product->auction_product == 0)
                    <!-- Previous price -->
                    @if (home_base_price($product) != home_discounted_base_price($product))
                        <del class="fw-400 text-secondary mr-1">{{ home_base_price($product) }}</del>
                    @endif
                    <!-- price -->
                    <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                @endif
                
                @if ($product->auction_product == 1)
                    <!-- Bid Amount -->
                    <div class="">
                        <span class="fw-700 text-primary">{{ single_price($product->starting_bid) }}</span>
                    </div>
                @endif
<div class="add_to_cart">       
  <a id="add-to-cart-{{ $product->id }}" class="btn btn-primary new-btn-sm @if (in_array($product->id, $cart_added)) active @endif"
    href="javascript:void(0)"
    @if (Auth::check()) onclick="addToCart2({{ $product->id }})" @else onclick="showLoginModal()" @endif>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
    <span class="cart-btn-text">
        {{ translate('Add') }}
    </span>
</a>

<div id="quantity-controls-p-{{ $product->id }}" class="quantity-controls-p" style="display: none;">
    <a class="quantity-btn-p" onclick="updateQuantityp({{ $product->id }}, 'increase-p')">+</a>
    <input type="number" id="quantity-product-p-{{ $product->id }}" value="1" readonly>
    <a class="quantity-btn-p" onclick="updateQuantityp({{ $product->id }}, 'decrease-p')">-</a>
</div>

</div>
                
            </div>
        </div>
    </div>
</div>



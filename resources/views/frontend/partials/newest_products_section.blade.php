@if (count($newest_products) > 0)
    <section class="mb-2 mb-md-3 mt-2 mt-md-3">
        <div class="container">
            <!-- Top Section -->
            <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                <!-- Title -->
                <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                    <span class="">{{ translate('Fresh Arrivals') }}</span>
                </h3>
            </div>
            <!-- Products Section -->
            <div class="row sm-gutters-16">
                @foreach ($newest_products as $key => $new_product)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-6 px-2">
                        @include('frontend.partials.product_box_1',['product' => $new_product])
                    </div>
                    @endforeach
            </div>
        </div>
    </section>
@endif
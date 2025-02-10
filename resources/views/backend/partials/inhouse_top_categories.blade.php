@if(count($categories))
    @foreach($categories as $category)
        <div class="d-flex flex-lg-wrap flex-xxl-nowrap align-items-center justify-content-between" style="margin-bottom: 0.75rem;">
            <div class="d-flex align-items-center mr-2">
                <div class="rounded-2 border overflow-hidden mr-3" style="min-height: 48px !important; min-width: 48px !important;max-height: 48px !important; max-width: 48px !important;">
                    <img src="{{ uploaded_asset($category->category_icon) }}" alt="Category" class="h-100 img-fit ls-is-cached lazyloaded" onerror="this.onerror=null;this.src='{{ static_asset("assets/img/placeholder.jpg") }}';">
                </div>
                <h4 class="fs-13 fw-600 text-dark mb-0 text-truncate-2">
                    {{ $category->category_name }}
                </h4>
            </div>
            <h4 class="fs-13 fw-600 text-danger mb-0 py-2">
                {{ single_price($category->total_price) }}
            </h4>
        </div>
    @endforeach
@endif
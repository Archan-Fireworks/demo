@extends('frontend.layouts.app')

@section('content')
<style>
    .quantity-controls-p {
  display: initial !important;
}
.mobile_show{
              display: none !important;

  }
@media only screen and (max-width: 767px) {
  .quantity-controls-p {
    display: inline-flex !important;
  }
  input[type="number"]{
      width: 50px !important;
  }
  .mobile_hide{
        display: none !important;

      
  }
  .mobile_show{
              display: revert !important;

  }
  .table td{
  padding: 0.55rem !important;
}

</style>
    <!-- Breadcrumb -->
    <section class="pt-4 mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark">
                        {{ translate('All Categories') }}
                    </h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item has-transition opacity-60 hov-opacity-100">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            "{{ translate('All Categories') }}"
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- All Categories -->
    <section class="mb-5 pb-3">
        <div class="container mt-5">
            <h2>Quick Purchase</h2>
            @foreach($categories as $category)
                @if(count($category->products) > 0)
                    <h3>{{ $category->name }}</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Product Name (Packing)</th>
                                <th style="width: 12%;" class="mobile_hide">Image</th>
                                                                <th class="mobile_show">Image</th>

                                <th>MRP</th>
                                <th>Quantity</th>
                                <th>Billing Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td class="mobile_show">
    @if(isset($product->thumbnail->file_name))
        <a href="#" data-toggle="modal" data-target="#imageModal" data-image="{{ asset('public/' . $product->thumbnail->file_name) }}">
                                  <i class="las la-camera"></i>
        </a>
    @else
        <a href="#" data-toggle="modal" data-target="#imageModal" data-image="{{ asset('path/to/default/image.jpg') }}">
                                  <i class="las la-camera"></i>
        </a>
    @endif
</td>

                                    <td class="mobile_hide">
                                        @if(isset($product->thumbnail->file_name))
                                            <img src="{{ asset('public/' . $product->thumbnail->file_name) }}" alt="{{ $product->name }}" width="100">
                                        @else
                                            <img src="{{ asset('path/to/default/image.jpg') }}" alt="No image available" width="100">
                                        @endif
                                    </td>
                                    <td class="product-mrp">
                                        @if($product->discount)
                                             <del class="fs-14 opacity-60 ml-2">
                                {{ home_price($product) }}
                            </del>
                                        @endif
                                        <strong class="fs-16 fw-700 text-primary unit-price">
                                {{ home_discounted_price($product) }}
                            </strong>
                                    </td>
                                    <td>
                                        @auth
                                        <div class="add_to_cart">
                                            <a id="add-to-cart-{{ $product->id }}" class="btn btn-primary new-btn-sm"
                                                href="javascript:void(0)"
                                                @if (Auth::check()) onclick="addToCart3({{ $product->id }})" @else onclick="showLoginModal()" @endif>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                                <span class="cart-btn-text">
                                                    {{ translate('Add') }}
                                                </span>
                                            </a>
                                            <div id="quantity-controls-p-{{ $product->id }}" class="quantity-controls-p" style="display: none !important;">
                                                                                                <a class="quantity-btn-p" onclick="updateQuantityp3({{ $product->id }}, 'decrease-p')">-</a>

                                                <input type="number" id="quantity-product-p-{{ $product->id }}" value="1" readonly>
                                                                                                <a class="quantity-btn-p" onclick="updateQuantityp3({{ $product->id }}, 'increase-p')">+</a>

                                            </div>
                                        </div>
                                        @else
                                        <div class="add_to_cart">
                                            <a  class="btn btn-primary new-btn-sm" onclick="showLoginModal()" style="color: #fff;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                                <span class="cart-btn-text">
                                                    {{ translate('Add') }}
                                                </span>
                                            </a>
                                           
                                        </div>
                                        
                                        @endif
                                    </td>
                                    <td id="billing-price-{{ $product->id }}" class="billing-price-total">
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endforeach
            <table class="table table-bordered">
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total Billing Price:</strong></td>
                        <td id="total-billing-price">Rs0</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Image preview" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var imageSrc = button.data('image'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('#modalImage').attr('src', imageSrc);
    });
</script>

    <script>
        $('.show-hide-cetegoty').on('click', function() {
            var el = $(this).siblings('ul');
            if (el.hasClass('less')) {
                el.removeClass('less');
                $(this).html('{{ translate('Less') }} <i class="las la-angle-up"></i>');
            } else {
                el.addClass('less');
                $(this).html('{{ translate('More') }} <i class="las la-angle-down"></i>');
            }
        });
    </script>
@endsection

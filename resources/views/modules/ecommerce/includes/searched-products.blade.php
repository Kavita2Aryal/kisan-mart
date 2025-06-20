@if(count($products) > 0)
@foreach($products as $product)
    <div class="media-masonry-item option-prod-item-{{$product->id}} m-r-5" style="width: auto;">
        <div class="media-image">
            @if ($product->thumbnail != null)
            <a href="{{ secure_img_product($product->thumbnail->image, '1200') }}" target="_blank">
                <img src="{{ secure_img_product($product->thumbnail->image, '480X320') }}" height="150px" class="full-width lozad">
            </a>
            @else
            <a href="{{ url('storage/website/default.jpg') }}" target="_blank">
                <img src="{{ url('storage/website/default.jpg') }}" height="150px" class="full-width lozad">
            </a>
            @endif
        </div>
        <div class="media-options">
            <div>
                <p class="font-montserrat m-b-0 fs-18"><strong>{{ ucwords($product->name) }}</strong></p>
                <p class="font-montserrat m-b-0 text-mute"><small>{{ Str::limit($product->brand->name, 20) }}</small></p>
                <p class="font-montserrat m-b-0 text-mute">
                    @foreach($product->product_categories as $row)
                    <small>{{ $row->category->name }} |</small>
                    @endforeach
                </p>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left">
                <a href="#" class="btn btn-link">
                    <div class="form-check info m-b-0">
                        <input type="checkbox" class="product-search" name="products[{{ $product->id }}][index]" id="product-selected-{{ $product->uuid }}" value="{{ $product->id }}">
                        <label for="product-selected-{{ $product->uuid }}">SELECT</label>
                    </div>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endforeach
@endif
@php
$currency = get_currency();
$rate = $currency->rate;
@endphp
@if(!$products->isEmpty())
<div id="grid-lightbox" class="uk-margin uk-text-left@s uk-text-center">
    <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-grid-match" uk-grid uk-lightbox="toggle: a[data-type];">
        @foreach($products as $row)
            <div>
                <a
                    class="el-item uk-panel uk-margin-remove-first-child uk-display-block"
                    href="{!! $domain.$row->alias !!}"
                >
                @if(isset($thumbnails[$row->product_id]) && $thumbnails[$row->product_id]['image'] != null)
                    <img
                        src="{{ secure_img_product($thumbnails[$row->product_id]['image'], 'main') }}"
                        sizes="(min-width: 610px) 610px"
                        data-width="610"
                        data-height="610"
                        class="el-image lozad img-400"
                        alt
                    />
                @else
                    <img
                        src="{{ url('/storage/website/default.jpg') }}"
                        sizes="(min-width: 610px) 610px"
                        data-width="610"
                        data-height="610"
                        class="el-image lozad img-400"
                        alt
                    />
                @endif
                    <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! ucwords($row->name) !!}</h3>
                    @php $pricing = ($offers != null && count($offers) > 0 && isset($offers[$row->product_id])) ? get_pricing($row->selling_price, $offers[$row->product_id]) : null; @endphp
                    @if($pricing != null && $pricing->current_offer != null)
                        <div class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($pricing->current_price/$rate), 2) !!}</div>
                        <s class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($pricing->original_price/$rate), 2) !!}</s>
                        @if($pricing->discount_rate > 0)
                            <span class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">-{{ $pricing->discount_rate }} %</span>
                        @endif        
                    @else
                        <div class="el-meta uk-h6 uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($row->selling_price/$rate), 2) !!}</div>
                    @endif
                </a>
            </div>
        @endforeach
    </div>
</div>
<div class="uk-panel uk-margin-large">
    @include('includes.product-paginate', ['data' => $products])
</div>
@else
<div id="grid-lightbox" class="uk-margin uk-text-left@s uk-text-center">
    <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-grid-match" uk-grid uk-lightbox="toggle: a[data-type];">
        <h3>We are adding product here!</h3>
    </div>
</div>
@endif
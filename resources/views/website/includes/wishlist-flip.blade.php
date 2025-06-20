@php
$currency = get_currency();
$rate = $currency->rate;
@endphp
<div class="uk-child-width-1-1 uk-grid-small uk-grid-match uk-grid uk-grid-stack" uk-grid="">
    @foreach($wishlists as $wishlist)
    <div class="uk-first-column wishlist-item-list" id="wishlist-item-list-{{ $wishlist['id'] }}">
        <div class="el-item uk-card uk-card-default uk-card-small uk-card-body uk-margin-remove-first-child">
            <div class="uk-child-width-expand uk-grid" uk-grid="">
                @isset($wishlist['gift_voucher_uuid'])
                    <div class="uk-width-auto uk-first-column">
                        <a href="{{ $domain.$wishlist['alias'] }}">
                            @if($wishlist['image'] != null)
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ secure_img_ecom($wishlist['image'], 'main') }}" />
                            @else
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" />
                            @endif
                        </a>
                    </div>
                    <div class="uk-margin-remove-first-child">
                        <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove">
                            <a href="javascript:void(0);" class="uk-icon-link uk-text-muted uk-position-top-right uk-margin-small-right uk-margin-small-top remove-from-wishlist" data-uuid="{{ $wishlist['uuid'] }}">
                                <span class="uk-icon" uk-icon="close"></span>
                            </a>

                            <a class="uk-link-reset" href="{{ $domain.$wishlist['alias'] }}">{!! $wishlist['title'] !!}</a>
                        </h4>
                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                            <div class="el-meta uk-text-meta uk-text-emphasis uk-margin-small-top">{!! $currency->name . ' ' . number_format(($wishlist['price']/$rate), 2) !!}</div>
                        </div>
                    </div>
                @else
                    <div class="uk-width-auto uk-first-column">
                        <a href="{{ $domain.$wishlist['alias'] }}">
                            @if($wishlist['image'] != null)
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ secure_img_product($wishlist['image']->image, 'main') }}" />
                            @else
                            <img class="el-image lozad hw-90" alt="" uk-img="" src="{{ url('storage/website/default.jpg') }}" />
                            @endif
                        </a>
                    </div>
                    <div class="uk-margin-remove-first-child">
                        <h4 class="el-title uk-h5 uk-margin-top uk-margin-remove">
                            <a href="javascript:void(0);" class="uk-icon-link uk-text-muted uk-position-top-right uk-margin-small-right uk-margin-small-top remove-from-wishlist" data-uuid="{{ $wishlist['uuid'] }}">
                                <span class="uk-icon" uk-icon="close"></span>
                            </a>

                            <a class="uk-link-reset" href="{{ $domain.$wishlist['alias'] }}">{!! $wishlist['name'] !!}</a>
                        </h4>
                        <div class="el-meta uk-h6 uk-margin-small-top uk-margin-remove-bottom">
                            @php $pricing = $wishlist['pricing']; @endphp
                            @if($pricing->current_offer != null)
                            {{ $currency->name .' '. number_format(($pricing->current_price/$rate), 2) }}<br>
                            <s class="uk-text-small uk-text-muted uk-margin-small-left uk-text-normal">{{ $currency->name .' '. number_format(($pricing->original_price/$rate), 2) }}</s>
                            <span class="uk-text-italic uk-text-light uk-text-discount">-{{ $pricing->discount_rate }} %</span>
                            @else
                            <div class="el-meta uk-text-meta uk-text-emphasis uk-margin-small-top">{!! $currency->name . ' ' . number_format(($wishlist['selling_price']/$rate), 2) !!}</div>
                            @endif
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="uk-text-center uk-margin-large">
    <p>
        <a class="uk-button uk-button-default uk-width-1-1" href="{{ route('wishlist.index') }}"> Go to Wishlist Page </a>
    </p>
</div>
@extends('layout.app')

@section('title')
    Checkout
@endsection

@push('seo')
    @include('includes.seo.seo',
    [
    'seo' => null,
    'url' => url()->current()
    ])
@endpush

@section('frontend-content')
    @php
        $currency_preferences = get_currency_preferences();
        $currencies = $currency_preferences->currencies;
        $currency = $currency_preferences->currency;
        $session_data = Session::has($_auth->_customer->uuid) ? Session::get($_auth->_customer->uuid) : null;
        $has_gift_voucher =( $session_data != null) ? $session_data['has_gift_voucher'] : $has_gift_voucher;
        $has_product =( $session_data != null) ? $session_data['has_product'] : $has_product;
        $gift_voucher_option = ($session_data != null) ? $session_data['gift_voucher_option'] : 'deliver-gift-voucher';
        $delivery_option = ($session_data != null) ? $session_data['delivery_option'] : '1';
        $auth = Auth::user();
    @endphp

    @include('includes.cms.headers.header_1')

    <div class="uk-section-muted uk-section uk-section-xsmall">
        <div class="uk-container">
            <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
                <div>
                    <h1 class="uk-text-center">CHECKOUT</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="uk-section-default uk-section uk-section-small">
        <div class="uk-container">
            <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
                <div>
                    <div class="uk-margin">
                        <a class="el-content uk-button uk-button-text" href="{{ route('cart.index') }}">
                            Back to Cart Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="form-checkout" method="post" action="{{ route('checkout.proceed.to.payment') }}" autocomplete="off">
        @csrf
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <div class="amount-detail-items" style="display:none"
             data-vat-amount="{{ $vat['amount']/$currency->rate }}"
             data-vat-rate="{{ $vat['rate'] }}"
             data-subtotal="{{ $subtotal/$currency->rate }}"
             data-discount-amount="0"
             data-delivery-charge="0"
             data-grand-total="{{ $sum/$currency->rate }}"
             data-exchange-rate="{{ $currency->id }}">
        </div>
        <input type="hidden" class="input_promo_code_id" name="hidden_promo_code_id" value="0">
        <input type="hidden" class="input_promo_code" name="hidden_promo_code" value="">
        <input type="hidden" class="input_gift_voucher_id" name="hidden_gift_voucher_id" value="0">
        <input type="hidden" class="input_gift_voucher_code" name="hidden_gift_voucher_code" value="">
        <input type="hidden" class="input_gift_voucher_vcode" name="hidden_gift_voucher_vcode" value="">
        <input type="hidden" class="input_gift_voucher_sale_id" name="hidden_gift_voucher_sale_id" value="0">
        <input type="hidden" class="exchange_rate_id" name="exchange_rate_id" value="{{ $currency->id }}">
        <input type="hidden" class="exchange_rate" name="exchange_rate" value="{{ $currency->rate }}">
        <input type="hidden" class="currency" name="currency" value="{{ $currency->name }}">
        <input type="hidden" class="has-gift-voucher" name="has_gift_voucher" value="{{ $has_gift_voucher }}">
        <input type="hidden" class="has-product" name="has_product" value="{{ $has_product }}">
        <input type="hidden" class="checkout-option" name="checkout_option" value="proceed_to_payment">

        <div class="uk-section-default uk-section uk-section-large uk-padding-remove-top">

            <div class="uk-container">
                <div class="tm-grid-expand uk-grid-column-medium uk-grid-divider uk-grid-margin" uk-grid>
                    <div class="uk-width-2-5@m">
                        <h3>YOUR BAG ITEMS</h3>
                        @if(session()->has('direct-checkout'))
                            @include('ecommerce.checkout.includes.direct-checkout', ['product', 'data', 'variant', 'currency', 'pricing', 'price', 'gift_voucher'])
                        @else
                            @include('ecommerce.checkout.includes.cart-checkout', ['carts', 'currency'])
                        @endif
                        <div class="uk-panel uk-margin use-container uk-grid-small" uk-grid>
                            <div>
                                <button class="uk-width-1-1 uk-button uk-button-primary" id="use-promo-code" type="button" style="margin-bottom: 5px;">Have a Promo Code ?</button>
                            </div>
                            <div style="display:none;">
                                <button class="uk-width-1-1 uk-button uk-button-secondary" id="use-gift-voucher" type="button">Have a Gift Voucher ?</button>
                            </div>
                        </div>
                        <div class="uk-panel uk-card uk-card-default uk-card-body uk-card-small uk-margin promo-code-container" style="display: none;">
                            <h3>PROMO CODE</h3>
                            <form>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-expand">
                                        <input class="uk-input" type="text" name="promo_code" id="promo-code" value="{{ ($session_data != null) ? $session_data['promo_code'] : '' }}" placeholder="Enter Promo Code" />
                                        <span class="uk-text-danger uk-margin-small" id="promo-code-msg-container" role="alert">
                                        <strong class="promo-code-msg"></strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="uk-child-width-1-2@s uk-grid-small" uk-grid>
                                    <div>
                                        <button class="uk-button uk-button-primary uk-width-1-1" id="apply-promo-code" type="button">APPLY</button>
                                    </div>
                                    <div>
                                        <button class="uk-button uk-button-default uk-width-1-1" id="cancel-promo-code" type="button">CANCEL</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="uk-panel uk-card uk-card-default uk-card-body uk-card-small uk-margin gift-voucher-container" style="display:none;">
                            <h3>GIFT VOUCHER</h3>
                            <form>
                                <div class="uk-grid-small" uk-grid>
                                    <div class="uk-width-expand">
                                        <div class="uk-margin">
                                            <input class="uk-input" type="text" name="gift_voucher_code" id="gift-voucher-code" value="{{ ($session_data != null) ? $session_data['gift_voucher_code'] : '' }}" placeholder="Enter Gift Voucher Code" />
                                        </div>
                                        <div class="uk-margin">
                                            <input class="uk-input" type="text" name="gift_voucher_verification_code" id="gift-voucher-verification-code" value="{{ ($session_data != null) ? $session_data['gift_voucher_vcode'] : '' }}" placeholder="Enter Verification Code" />
                                        </div>
                                        <span class="uk-text-danger uk-margin-small" id="gift-voucher-msg-container" role="alert">
                                        <strong class="gift-voucher-msg"></strong>
                                    </span>
                                    </div>
                                </div>
                                <div uk-grid class="uk-grid-small uk-child-width-1-2@s">
                                    <div>
                                        <button class="uk-button uk-button-primary uk-width-1-1" id="apply-gift-voucher" type="button">APPLY</button>
                                    </div>
                                    <div>
                                        <button class="uk-button uk-button-default uk-width-1-1" id="cancel-gift-voucher" type="button">CANCEL</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr />
                        <h3>ORDER SUMMARY</h3>
                        <hr />
                        <ul class="uk-list" id="page#3-0-0-6">
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="uk-margin-remove uk-text-bold">Subtotal</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right sub_total_text">{{ $currency->name .' '. number_format(($subtotal/$currency->rate), 2) }}</div>
                                    </div>
                                </div>
                            </li>
                            <li class="vat-amount-item" @if($vat['amount']==0 && $vat['rate']==null) style="display:none;" @endif>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">VAT({{$vat['rate']}}%)</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right vat_amount_text">{{ $currency->name .' '. number_format(($vat['amount']/$currency->rate), 2) }}</div>
                                    </div>
                                </div>
                            </li>
                            <li class="promo-code-item" style="display:none;">
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">Discount</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right promo_discount_amount_text">{{ $currency->name . ' 0.00' }}</div>
                                    </div>
                                </div>
                            </li>
                            <li class="gift-voucher-item" style="display:none;">
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">Gift Voucher Discount</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right gift_discount_amount_text">{{ $currency->name . ' 0.00' }}</div>
                                    </div>
                                </div>
                            </li>
                            <li class="delivery-charge-item" style="display:none;">
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">Shipping & Handling Fee</div>
                                    </div>
                                    <div>
                                        <div class="uk-text-right delivery_charge_text">{{ $currency->name . ' 0.00' }}</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <hr class="bold-line" />
                        <ul class="uk-list" id="page#3-0-0-8">
                            <li>
                                <div class="uk-child-width-expand uk-grid-row-small uk-grid" uk-grid="">
                                    <div class="uk-width-auto uk-first-column">
                                        <div class="el-title uk-margin-remove uk-text-bold">Total</div>
                                    </div>
                                    <div>
                                        <div class="uk-h4 uk-margin-remove uk-text-right grand_total_text">{{ $currency->name .' '. number_format(($sum/$currency->rate), 2) }}</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @if($settings['delivery-partner-status'] == 'ON')
                            <div class="uk-card uk-card-default uk-card-body uk-margin-medium-top uk-padding-remove-bottom">
                                <div>
                                    <div class="uk-h6 uk-margin-remove-bottom">Logistics partner</div>
                                    <div class="uk-h2 uk-text-emphasis uk-margin-small">
                                    <!--{{ $settings['delivery-partner-title'] }}-->
                                        <img src="https://citycargo.upaya.com.np/assets/citycargo-logo-dark.PNG" style="width: 250px;">
                                    </div>
                                    <div class="uk-h4 uk-text-muted uk-margin-top">
                                        {!! $settings['delivery-partner-description'] !!}
                                    </div>
                                    <div class="uk-margin-medium-top">
                                        <img src="{{ url('storage/website/lady.svg') }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="uk-width-3-5@m uk-flex-first@s">
                        @if($has_gift_voucher && $gift_voucher_options != null)
                            <div class="uk-margin-medium">
                                <h3 class="" for="form-horizontal-text">GIFT VOUCHER OPTIONS</h3>
                                <div uk-grid="" class="uk-margin-top uk-grid">
                                    @foreach($gift_voucher_options as $key => $row)
                                        <div>
                                            <div class="uk-form-controls">
                                                <label style="cursor: pointer;">
                                                    <div class="uk-padding-small uk-background-muted uk-border-rounded">
                                                        <input class="uk-radio {{ (!$has_product) ? 'gift-voucher-option' : '' }}" type="radio" name="gift_voucher_option" @if($gift_voucher_option == $key) checked @endif value="{{ $key }}"> {{ $row }}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(auth()->user()->phone == null)
                            <div class="address-parent">
                                <h3> PERSONAL DETAILS </h3>

                                <div class="uk-margin user-phone">
                                    <label class="uk-form-label" for="user-phone">Phone Number</label>
                                    <input class="uk-input user-phone"  name="phone" value="{{ old('phone') }}" type="text" placeholder="Enter Phone Number" rows="5" value="{{ old('phone') }}" autocomplete="nope" required>
                                    @if ($errors->has('phone'))
                                        <span class="uk-text-danger" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                        @endif

                        <div class="uk-margin-medium">
                            <h3 class="" for="form-horizontal-text">DELIVERY OPTIONS</h3>
                            <div uk-grid="" class="uk-margin-top uk-grid">
                                <div class="uk-first-column">
                                    <div class="uk-form-controls">
                                        <label style="cursor: pointer;">
                                            <div class="uk-padding-small uk-background-muted uk-border-rounded">
                                                <input class="uk-radio delivery-option" type="radio" name="delivery_option" value="1" @if($delivery_option == 1) checked @endif> Home Deliver
                                                <div class="uk-text-meta" style="margin-left: 20px;">Pay according to the location of your delivery.</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <div class="uk-form-controls">
                                        <label style="cursor: pointer;">
                                            <div class="uk-padding-small uk-background-muted uk-border-rounded">
                                                <input class="uk-radio delivery-option" type="radio" name="delivery_option" value="0" @if($delivery_option == 0) checked @endif> Pick up from store
                                                <div class="uk-text-meta" style="margin-left:  20px;">Pick up from our store and save delivery charges</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="address-parent shipping-address">
                            <h3> SHIPPING DETAILS </h3>
                            <div>
                                @if ($_auth->_customer)
                                    <div class="uk-margin shipping-options">
                                        <label class="uk-form-label" for="form-horizontal-text">Select Address</label>
                                        <div class="uk-form-controls">
                                            <select class="uk-input address-options shipping-address-data" name="shipping_address">
                                                <option value="0">Add New</option>
                                                @if ($shipping_options)
                                                    @foreach($shipping_options as $opt)
                                                        <option value='{{ json_encode($opt) }}'>@isset($opt['full_name']) {{ $opt['full_name'] . ',' }} @endisset @isset($opt['address_line_1']) {{ $opt['address_line_1'] }} @endisset</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="uk-margin shipping-country">
                                <label class="uk-form-label" for="selectShippingCountry">Country *</label>
                                <div class="uk-form-controls">
                                    <select class="uk-input select_ship_country" name="shipping[country]" id="selectShippingCountry" required autocomplete="off">
                                        @isset($countries)
                                            <option value="">Select Country</option>
                                            <option value="0" data-id="0">Others</option>
                                            @foreach($countries as $country)
                                                <option value='{{ $country->id }}' data-id="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @if ($errors->has('shipping.country'))
                                        <span class="uk-text-danger" role="alert">
                                    <strong>{{ $errors->first('shipping.country') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" class="select_ship_name" name="shipping[name]" value="">
                            <input type="hidden" class="select_ship_phone" name="shipping[phone]" value="">
                            <div class="uk-margin shipping-region">
                                <label class="uk-form-label" for="selectShippingRegion">State/Zone *</label>
                                <div class="uk-form-controls">
                                    <select class="uk-input select_ship_region" name="shipping[region]" id="selectShippingRegion" required autocomplete="off">
                                        <option value="">Select State/Zone</option>
                                    </select>
                                    @if ($errors->has('shipping.region'))
                                        <span class="uk-text-danger" role="alert">
                                    <strong>{{ $errors->first('shipping.region') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="uk-margin shipping-city">
                                <label class="uk-form-label" for="customerShippingCity">Town / City *</label>
                                <select class="uk-input select_ship_city" name="shipping[city]" id="customerShippingCity" required autocomplete="off">
                                    <option value="">Select City</option>

                                </select>
                                @if ($errors->has('shipping.city'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('shipping.city') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin shipping-area">
                                <label class="uk-form-label" for="customerShippingStreet">Area *</label>
                                <select class="uk-input select_ship_area" for="customerShippingStreet" name="shipping[area]" required autocomplete="off">
                                    <option value="">Select Area</option>
                                </select>
                                @if ($errors->has('shipping.area'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('shipping.area') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin shipping-zip">
                                <label class="uk-form-label" for="select-ship-zip">Zip / Postal Code</label>
                                <input class="uk-input shipping-zip" id="select-ship-zip" name="shipping[zip]" value="{{ old('shipping.zip') }}" type="text" placeholder="Enter Zip/Postal Code" rows="5" value="{{ old('shipping.zip') }}" autocomplete="nope">
                                @if ($errors->has('shipping.zip'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('shipping.zip') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin shipping-address-line">
                                <label class="uk-form-label" for="shippingAddress">Full Address *</label>
                                <textarea class="uk-textarea shipping-address-line-1" required id="shippingAddress" name="shipping[address_line_1]" type="text" placeholder="Enter Full Address" rows="5" autocomplete="nope">{{ old('shipping.address_line_1') }}</textarea>
                                @if ($errors->has('shipping.address_line_1'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('shipping.address_line_1') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin shipping-delivery-instructions">
                                <label class="uk-form-label" for="deliveryInstruction">Delivery Instruction</label>
                                <textarea class="uk-textarea delivery-instructions" id="deliveryInstruction" name="shipping[delivery_instructions]" type="text" placeholder="Enter Delivery Instruction" rows="5" autocomplete="off">{{ old('shipping.delivery_instructions') }}</textarea>
                                @if ($errors->has('shipping.delivery_instructions'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('shipping.delivery_instructions') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin">
                                <label>
                                    <input class="uk-checkbox uk-margin-small-right shipping-as-billing" type="checkbox" checked>Bill to same address
                                </label>
                            </div>
                        </div>
                        <hr />
                        <div class="address-parent billing-address" style="display: none;">
                            <h3>BILLING DETAILS</h3>
                            @if ($_auth->_customer)
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="form-horizontal-text">Select Address</label>
                                    <div class="uk-form-controls">
                                        <select class="uk-input required address-options billing-address-data" name="billing_address">
                                            <option value="0">Add New</option>
                                            @if ($billing_options)
                                                @foreach($billing_options as $opt)
                                                    <option value='{{ json_encode($opt) }}'>@isset($opt['full_name']) {{ $opt['full_name'] . ',' }} @endisset @isset($opt['address_line_1']) {{ $opt['address_line_1'] }} @endisset</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-stacked-select">Country*</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select select_country" name="billing[country]" id="form-stacked-select" autocomplete="off">
                                        @isset($countries)
                                            <option value="">Select Country</option>
                                            <option value='0' data-id="0">Others</option>
                                            @foreach($countries as $country)
                                                <option value='{{ $country->id }}' data-id="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @if ($errors->has('billing.country'))
                                        <span class="uk-text-danger" role="alert">
                                    <strong>{{ $errors->first('billing.country') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" class="select_name" name="billing[name]" value="">
                            <input type="hidden" class="select_phone" name="billing[phone]" value="">
                            <div class="uk-margin billing-region">
                                <label class="uk-form-label" for="customerBillingRegion">State / Zone *</label>
                                <select class="uk-select select_region" name="billing[region]" id="customerBillingRegion" autocomplete="off">
                                    <option value="">Select State/Zone</option>

                                </select>
                                @if ($errors->has('billing.region'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('billing.region') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin billing-city">
                                <label class="uk-form-label" for="customerBillingCity">Town / City *</label>
                                <select class="uk-select select_city" name="billing[city]" id="customerBillingCity" autocomplete="off">
                                    <option value="">Select City</option>

                                </select>
                                @if ($errors->has('billing.city'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('billing.city') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin billing-area">
                                <label class="uk-form-label" for="customerBillingStreet">Area *</label>
                                <select class="uk-input select_area" id="customerBillingStreet" name="billing[area]" autocomplete="off">
                                    <option value="">Select Area</option>
                                </select>
                                @if ($errors->has('billing.area'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('billing.area') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin billing-zip">
                                <label class="uk-form-label" for="select_zip">Zip / Postal Code</label>
                                <input class="uk-textarea billing-zip" id="select_zip" name="billing[zip]" value="{{ old('billing.zip') }}" type="text" placeholder="Enter Zip/Postal Code" rows="5" value="old('billing.zip') }}" autocomplete="nope">
                                @if ($errors->has('billing.zip'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('billing.zip') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="billingAddress">Full Address *</label>
                                <textarea class="uk-textarea billing-address-line-1" name="billing[address_line_1]" id="billingAddress" type="text" placeholder="Enter Full Address" rows="5" autocomplete="nope">{{ old('billing.address_line_1') }}</textarea>
                                @if ($errors->has('billing.address_line_1'))
                                    <span class="uk-text-danger" role="alert">
                                <strong>{{ $errors->first('billing.address_line_1') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        @if(config('services.recaptcha.key_v2'))
                            <div class="uk-margin">
                                <div class="g-recaptcha" data-type="image" data-sitekey="{{config('services.recaptcha.key_v2')}}"></div>
                                @if($errors->first('g-recaptcha-response'))
                                    <span class="uk-text-danger" role="alert">
                                            <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if($auth->has_agreed != 10)
                            <div class="uk-margin">
                                <label><input class="uk-checkbox uk-margin-small-right" required type="checkbox" name="has_agreed" checked>I accept the <a href="{{ route('terms.and.conditions') }}" target="_blank">terms of service</a>.</label>
                            </div>
                        @endif
                        <div class="uk-margin">
                            <button class="el-content uk-width-1-1 uk-button uk-button-primary uk-button-large btn-checkout-submit" type="submit">
                                PROCEED TO PAYMENT
                            </button>
                        </div>
                        <div class="uk-panel uk-margin">By clicking "Proceed to Payment" you will be redirected to our payment option page.</div>
                        <div class="uk-panel uk-margin-remove-first-child uk-margin-medium">
                            <div class="el-meta uk-text-meta uk-margin-top">We Accept</div>

                            <img
                                src="{{ url('storage/website/esewa.png') }}"
                                width="150"
                                class="el-image uk-margin-small-top lozad"
                                alt
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@push('styles')
@endpush

@push('scripts')
    <script>
        var apply_promo_code = "{{ route('promo.code.apply') }}",
            apply_gift_voucher = "{{ route('gift.voucher.apply') }}",
            subtotal_checkout = "{{ $subtotal }}",
            countries = "{{ $countries }}",
            regions = "{{ $regions }}",
            cities = "{{ $cities }}",
            areas = "{{ $areas }}",
            currency = "{{ $currency->name }}",
            ex_rate = "{{ $currency->rate }}";
        session_data = @json($session_data);
        has_gift_voucher = "{{ $has_gift_voucher }}";
        gift_voucher_option = "{{ $gift_voucher_option }}";
        delivery_option = "{{ $delivery_option }}";
    </script>
    <script type="text/javascript" src="{{ asset('ecommerce/custom/checkout.min.js') }}"></script>
@endpush

@php
    $offer_title = get_setting('offer-title');
    $offer_link_title = get_setting('offer-link-title');
    $offer_link = get_setting('offer-link');
    $offer_status = get_setting('offer-status');
@endphp
<form action="{{ route('set.currency.preference') }}" method="post">
    @csrf
    <input type="hidden" class="currency-preference" name="currency" value="{{ $currency != null ? $currency->preference : 0 }}">
</form>

<div class="tm-toolbar tm-toolbar-default">
    <div class="uk-container uk-flex uk-flex-middle uk-container-xlarge uk-flex-center">
        <div>
            <div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid="margin: uk-margin-small-top">
                <div>
                    <div class="uk-panel uk-text-center" id="module-101">
                        @if($offer_status == "ON")
                            <div class="uk-margin-remove-last-child custom">{!! $offer_title !!} | <a href="{!! $offer_link !!}">{!! $offer_link_title !!}</a></div>
                        @else
                            <div class="uk-margin-remove-last-child custom">Welcome To {{ $settings['website-title'] }}! | <a href="{!! $domain.'search?collection_type=new-arrival' !!}">Check Our New Arrivals</a></div>
                        @endif
                    </div>
                </div>
                @if($currencies != null && $currencies->count() > 0)
                    <div class="uk-visible@m">
                        <div class="uk-panel uk-text-center" id="module-103">
                            <div class="uk-margin-remove-last-child custom">
                                <div class="uk-margin-remove uk-text-small">

                                    <div uk-form-custom="target: > * > span:last-child">
                                        <select class="preferred-currency-dropdown-item">
                                            @foreach($currencies as $row)
                                                <option value="{{ $row->id }}" @if($row->id == $currency->preference) selected @endif>{!! strtoupper($row->currency) !!}</option>
                                            @endforeach
                                        </select>
                                        <span class="uk-link">
                                            <span uk-icon="icon:  triangle-down"></span>
                                            <span></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
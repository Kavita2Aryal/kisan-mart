@extends('layout.app')

@section('title')
Gift Voucher
@endsection

@push('seo')
@include('includes.seo.seo',
[
'seo' => null,
'url' => url()->current()
]
)
@endpush
@php
    $currency = get_currency();
    $rate = $currency->rate;
@endphp
@section('frontend-content')
@include('includes.cms.headers.header_1')

<div class="uk-section-muted uk-section uk-section-xsmall">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
            <div class="uk-first-column">
                <div class="uk-h1 uk-text-secondary uk-position-relative uk-text-center">Gift Vouchers</div>
            </div>
        </div>
    </div>
</div>
<div class="uk-section-default" tm-header-transparent="dark" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-small; delay: false;">
    <div style="background-image: url('/storage/website/home-shape-00.svg');" class="uk-background-norepeat uk-background-bottom-right uk-section uk-padding-remove-top">
        <div class="uk-container uk-container-large">
            <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
            <div id="fonts" class="tm-grid-expand uk-child-width-1-1 uk-margin-large uk-grid uk-grid-stack" uk-grid="">
                <div class="uk-width-1-1@m uk-first-column">
                    <div class="uk-h3 uk-text-emphasis uk-scrollspy-inview" uk-scrollspy-class="" style=""></div>
                    <div class="uk-margin-medium">
                        <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-grid-match uk-grid" uk-grid="">
                            @if($gift_vouchers->count() > 0)
                                @foreach($gift_vouchers as $row)
                                    <div>
                                        <a class="el-item uk-card uk-card-default uk-card-small uk-card-hover uk-margin-remove-first-child uk-link-toggle uk-display-block uk-scrollspy-inview" href="{!! $row->alias->alias !!}" uk-scrollspy-class>
                                            <div class="uk-card-media-top">
                                                @if($row->image != null)
                                                    <img
                                                        src="{{ secure_img_ecom($row->image, 'main') }}"
                                                        class="el-image lozad"
                                                        alt=""
                                                    />
                                                @endif
                                            </div>
                                            <div class="uk-card-body uk-margin-remove-first-child">
                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $row->title !!}</h3>
                                                <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($row->price/$rate), 2) !!}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                @foreach($gift_vouchers as $row)
                                    <div>
                                        <a class="el-item uk-card uk-card-default uk-card-small uk-card-hover uk-margin-remove-first-child uk-link-toggle uk-display-block uk-scrollspy-inview" href="{!! $row->alias->alias !!}" uk-scrollspy-class>
                                            <div class="uk-card-media-top">
                                                @if($row->image != null)
                                                    <img
                                                        src="{{ secure_img_ecom($row->image, 'main') }}"
                                                        class="el-image lozad"
                                                        alt=""
                                                    />
                                                @endif
                                            </div>
                                            <div class="uk-card-body uk-margin-remove-first-child">
                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $row->title !!}</h3>
                                                <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($row->price/$rate), 2) !!}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                @foreach($gift_vouchers as $row)
                                    <div>
                                        <a class="el-item uk-card uk-card-default uk-card-small uk-card-hover uk-margin-remove-first-child uk-link-toggle uk-display-block uk-scrollspy-inview" href="{!! $row->alias->alias !!}" uk-scrollspy-class>
                                            <div class="uk-card-media-top">
                                                @if($row->image != null)
                                                    <img
                                                        src="{{ secure_img_ecom($row->image, 'main') }}"
                                                        class="el-image lozad"
                                                        alt=""
                                                    />
                                                @endif
                                            </div>
                                            <div class="uk-card-body uk-margin-remove-first-child">
                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $row->title !!}</h3>
                                                <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($row->price/$rate), 2) !!}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                @foreach($gift_vouchers as $row)
                                    <div>
                                        <a class="el-item uk-card uk-card-default uk-card-small uk-card-hover uk-margin-remove-first-child uk-link-toggle uk-display-block uk-scrollspy-inview" href="{!! $row->alias->alias !!}" uk-scrollspy-class>
                                            <div class="uk-card-media-top">
                                                @if($row->image != null)
                                                    <img
                                                        src="{{ secure_img_ecom($row->image, 'main') }}"
                                                        class="el-image lozad"
                                                        alt=""
                                                    />
                                                @endif
                                            </div>
                                            <div class="uk-card-body uk-margin-remove-first-child">
                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $row->title !!}</h3>
                                                <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($row->price/$rate), 2) !!}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div>
                                    <h3 class="el-title uk-margin-top uk-margin-remove-bottom">Gift Voucher Not Found!</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.cms.footers.footer_1')
@endsection
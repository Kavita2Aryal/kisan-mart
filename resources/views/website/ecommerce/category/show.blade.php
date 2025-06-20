@extends('layout.app')

@section('title')
{!! $category->name !!}
@endsection

@push('seo')
@include('includes.seo.seo',
[
'seo' => null,
'url' => url()->current()
]
)
@endpush

@section('frontend-content')
@include('includes.cms.headers.header_1')
@php
$currency = get_currency();
$rate = $currency->rate;
@endphp
<div class="uk-section-muted uk-section uk-section-xsmall">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
            <div class="uk-first-column">
                <div class="uk-h1 uk-text-secondary uk-position-relative uk-text-center">{!! $category->name !!}</div>
            </div>
        </div>
    </div>
</div>
@if($data != null)
    @foreach($data as $row)
        @if($row['products'] != null)
            @if(count($data) > 1 && $loop->last)
                <div class="uk-section-default" tm-header-transparent="dark" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-small; delay: false;">
                    <div style="background-image: url('/storage/website/home-shape-00.svg');" class="uk-background-norepeat uk-background-bottom-right uk-section uk-padding-remove-top">
                        <div class="uk-container uk-container-large">
                            <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
                            <div id="fonts" class="tm-grid-expand uk-child-width-1-1 uk-margin-large uk-grid uk-grid-stack" uk-grid="">
                                <div class="uk-width-1-1@m uk-first-column">
                                    <div class="uk-h3 uk-text-emphasis uk-scrollspy-inview" uk-scrollspy-class="" style="">{!! $row['name'] !!}</div>
                                    <div class="uk-margin-medium">
                                        <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-grid-match uk-grid" uk-grid="">
                                            @foreach($row['products'] as $product)
                                                @if($product['image'] != null)
                                                    <div>
                                                        <a class="el-item uk-card uk-card-default uk-card-small uk-card-hover uk-margin-remove-first-child uk-link-toggle uk-display-block uk-scrollspy-inview" href="{!! $product['alias'] !!}" uk-scrollspy-class>
                                                            <div class="uk-card-media-top">
                                                                <img
                                                                    src="{{ secure_img_product($product['image'], 'main') }}"
                                                                    class="el-image lozad img-300"
                                                                    alt=""
                                                                />
                                                            </div>
                                                            <div class="uk-card-body uk-margin-remove-first-child">
                                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $product['name'] !!}</h3>
                                                                @php $pricing = $product['pricing']; @endphp
                                                                @if($pricing != null && $pricing->current_offer != null)
                                                                    <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">
                                                                        {!! $currency->name . ' ' . number_format(($pricing->current_price/$rate), 2) !!}<br>
                                                                        <s>{!! $currency->name . ' ' . number_format(($pricing->original_price/$rate), 2) !!}</s>
                                                                        <span class="uk-text-italic uk-text-light uk-text-discount">-{{ $pricing->discount_rate }} %</span>
                                                                    </h6>
                                                                @else
                                                                    <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($product['selling_price']/$rate),2) !!}</h6>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="uk-margin-xlarge uk-margin-remove-top uk-text-right@m uk-scrollspy-inview" uk-scrollspy-class="" style="">
                                        <a class="el-content uk-button uk-button-primary" href="{{ route('search') .'?categories='.$row['slug'] }}">
                                        View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="uk-section-default" tm-header-transparent="dark" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-small; delay: false;">
                    <div class="uk-section">
                        <div class="uk-container uk-container-large">
                            <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
                            <div id="fonts" class="tm-grid-expand uk-child-width-1-1 uk-margin-large uk-grid uk-grid-stack" uk-grid="">
                                <div class="uk-width-1-1@m uk-first-column">
                                    <div class="uk-h3 uk-text-emphasis uk-scrollspy-inview" uk-scrollspy-class="" style="">{!! $row['name'] !!}</div>
                                    <div class="uk-margin-medium">
                                        <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-grid-match uk-grid" uk-grid="">
                                            @foreach($row['products'] as $product)
                                                @if($product['image'] != null)
                                                    <div>
                                                        <a class="el-item uk-card uk-card-default uk-card-small uk-card-hover uk-margin-remove-first-child uk-link-toggle uk-display-block uk-scrollspy-inview" href="{!! $product['alias'] !!}" uk-scrollspy-class>
                                                            <div class="uk-card-media-top">
                                                                <img
                                                                    src="{{ secure_img_product($product['image'], 'main') }}"
                                                                    class="el-image lozad img-300"
                                                                    alt=""
                                                                />
                                                            </div>
                                                            <div class="uk-card-body uk-margin-remove-first-child">
                                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $product['name'] !!}</h3>
                                                                @php $pricing = $product['pricing']; @endphp
                                                                @if($pricing != null && $pricing->current_offer != null)
                                                                    <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">
                                                                        {!! $currency->name . ' ' . number_format(($pricing->current_price/$rate), 2) !!}<br>
                                                                        <s>{!! $currency->name . ' ' . number_format(($pricing->original_price/$rate), 2) !!}</s>
                                                                        @if($pricing->discount_rate > 0)
                                                                            <span class="uk-text-italic uk-text-light uk-text-discount">-{{ $pricing->discount_rate }} %</span>
                                                                        @endif
                                                                    </h6>
                                                                @else
                                                                    <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $currency->name . ' ' . number_format(($product['selling_price']/$rate),2) !!}</h6>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="uk-margin-xlarge uk-margin-remove-top uk-text-right@m uk-scrollspy-inview" uk-scrollspy-class="" style="">
                                        <a class="el-content uk-button uk-button-primary" href="{{ route('search') .'?categories='.$row['slug'] }}">
                                        View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
                                <div class="uk-first-column">
                                    <hr uk-scrollspy-class="" class="uk-scrollspy-inview" style="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
@endif
@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
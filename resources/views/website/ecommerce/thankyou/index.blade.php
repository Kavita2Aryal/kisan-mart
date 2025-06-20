@extends('layout.app')

@section('title')
Thank You
@endsection

@push('seo')
{!! SEO::generate(true) !!}
@endpush

@section('frontend-content')
<!-- working body container -->

@include('includes.cms.headers.header_1')

<div class="uk-section-default uk-section uk-padding-remove-vertical">
    <div class="uk-position-relative">
        <div class="uk-grid-margin" uk-grid="" uk-height-viewport="offset-top: true;">
            <div class="uk-grid-item-match uk-width-expand@m">
                <div class="uk-flex">
                    <div class="uk-tile uk-width-1-1 uk-tile-xlarge uk-flex uk-flex-middle uk-background-norepeat uk-background-cover uk-background-top-center" style="background-image: url({{ url('storage/website/contactbanner.jpeg') }});">
                        <div class="uk-panel uk-width-1-1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid-item-match uk-width-expand@m">
                <div class="uk-tile-default uk-tile uk-tile-xlarge uk-flex uk-flex-middle">
                    <div class="uk-panel uk-width-1-1">
                        <h1 class="uk-h2 uk-width-large uk-margin-auto uk-text-left@m uk-text-center">Thank You!</h1>
                        <h4 class="uk-h5 uk-margin-small uk-width-large uk-margin-auto uk-text-left@m uk-text-center">{!! $message !!}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.cms.footers.footer_1')

<!-- working body container -->
@endsection


@push('styles')

@endpush

@push('scripts')

@endpush
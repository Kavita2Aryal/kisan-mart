@extends('layout.app')
@section('title')
Dashboard
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

@include('includes.customer-nav',
[
'title' => 'Dashboard',
]
)

<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container uk-container-xsmall">
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div class="uk-grid-item-match">
                    <div class="uk-tile-muted uk-tile uk-flex uk-flex-middle">
                        <div class="uk-panel uk-width-1-1">
                            <h3>Hello {!! Auth::user()->name !!}</h3>
                            <div class="uk-panel uk-margin">From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
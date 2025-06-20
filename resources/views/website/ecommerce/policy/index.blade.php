@extends('layout.app')

@section('title')
{!! $policy->title !!}
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
<div class="uk-section-default uk-section">
    <div class="uk-container uk-container-xsmall">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-h5 uk-text-muted uk-margin-remove-bottom">Effective Date: {!! date('F j, Y', strtotime($policy->effective_date)) !!}</div>
                <h1 class="uk-h1 uk-margin-remove-top">{!! $policy->title !!}</h1>
            </div>
        </div>
        <div class="tm-grid-expand uk-child-width-1-1 uk-margin-large" uk-grid>
            <div class="uk-width-1-1@m">
                {!! $policy->description !!}
            </div>
        </div>
    </div>
</div>
@include('includes.cms.footers.footer_1')
@endsection
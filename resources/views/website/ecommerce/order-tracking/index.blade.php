@extends('layout.app')

@section('title')
Order Tracking
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
<div id="page#0" class="uk-section-muted uk-position-relative" tm-header-transparent="dark">
    <div
        style="background-image: url('{{url('storage/website/babyfoot.svg')}}');"
        class="uk-background-norepeat uk-background-cover uk-background-center-center uk-section uk-padding-remove-top uk-flex uk-flex-middle"
        uk-height-viewport="offset-top: true;"
    >
        <div class="uk-position-cover" style="background-color: rgba(255, 255, 255, 0.73);"></div>
        <div class="uk-width-1-1">
            <div class="uk-container uk-position-relative">
                <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
                <div class="uk-grid-margin uk-container uk-container-xsmall">
                    <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                        <h1 class="uk-text-center">Order Tracking</h1>
                        <div class="uk-grid-item-match">
                            <div class="uk-tile-default uk-tile uk-tile-small">
                                <div class="uk-panel uk-margin-remove-first-child uk-margin">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <form class="uk-form-stacked" action="{{ route('order.tracking.submit') }}" method="post">
                                            @csrf
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="email">
                                                    Email Address
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <input class="uk-input {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" type="text" />
                                                    </div>
                                                    @if ($errors->has('email'))
                                                    <div class="uk-alert-danger" uk-alert>
                                                        <span>{{ $errors->first('email') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="orderid">
                                                    Order Code
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <input class="uk-input {{ $errors->has('order_code') ? ' is-invalid' : '' }}" id="orderid" name="order_code" type="text" />
                                                    </div>
                                                    @if ($errors->has('order_code'))
                                                    <div class="uk-alert-danger" uk-alert>
                                                        <span>{{ $errors->first('order_code') }}</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">TRACK MY ORDER</button>
                                            <div class="uk-margin uk-text-center"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
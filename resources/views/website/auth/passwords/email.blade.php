@extends('layout.app')

@section('title')
Reset Password
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
                        <div class="uk-grid-item-match">
                            <div class="uk-tile-default uk-tile uk-tile-small">

                                <h2 class="uk-h4 uk-text-muted uk-text-center">Reset Password</h2>
                                <h2 class="uk-h5 uk-text-muted uk-margin-remove-top uk-text-center">Enter your email to receive instructions on how to reset your password.</h2>
                                <div class="uk-panel uk-margin-remove-first-child uk-margin">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <form class="uk-form-stacked" method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="email">
                                                    Email Address
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <input class="uk-input {{ $errors->has('password') ? ' is-invalid' : '' }}" id="email" name="email" type="text" />
                                                    </div>
                                                </div>
                                                @if ($errors->has('email'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('email') }}</span>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="uk-margin">
                                                <button class="uk-button uk-button-secondary uk-button-large uk-width-1-1" type="submit">SEND</button>
                                            </div>
                                            <div class="uk-text-bold uk-text-center">OR RETURN TO <a href="{{ route('login') }}">LOGIN</a></div>
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

<div class="uk-section-default uk-section uk-padding-remove-vertical">
    <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
        <div>
            <hr id="page#2-0-0-0" />
        </div>
    </div>
</div>

@include('includes.cms.footers.footer_1')
@endsection
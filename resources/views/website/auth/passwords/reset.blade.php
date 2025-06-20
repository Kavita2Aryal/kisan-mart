@extends('layout.app')

@section('title')
Password Recovery
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

                                <h2 class="uk-h4 uk-text-muted uk-text-center">Password Recovery</h2>
                                <h2 class="uk-h5 uk-text-muted uk-margin-remove-top uk-text-center">Enter your email to receive instructions on how to reset your password.</h2>
                                <div class="uk-panel uk-margin-remove-first-child uk-margin">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <form class="uk-form-stacked" method="POST" action="{{ route('password.request') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="uk-margin">
                                                <div class="uk-inline uk-width-1-1">
                                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                                    <input class="uk-input uk-form-large {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"/>
                                                </div>
                                                @if ($errors->has('email'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('email') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="uk-margin">
                                                <div class="uk-inline uk-width-1-1">
                                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                                    <input class="uk-input uk-form-large {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password" />
                                                </div>
                                                @if ($errors->has('password'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('password') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="uk-margin">
                                                <div class="uk-inline uk-width-1-1">
                                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                                    <input class="uk-input uk-form-large {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" placeholder="Confirm Password" />
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('password_confirmation') }}</span>
                                                </div>
                                                @endif
                                            </div>
    
                                            <div class="uk-margin">
                                                <button class="uk-button uk-button-secondary uk-button-large uk-width-1-1" type="submit">RESET PASSWORD</button>
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
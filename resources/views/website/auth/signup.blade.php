@extends('layout.app')

@section('title')
Register
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
                                <div class="uk-margin uk-text-center">
                                    <img src="{{ url('storage/website/logo.svg') }}" width="200" class="el-image" alt />
                                </div>
                                <h2 class="uk-h4 uk-text-muted uk-text-center">Register</h2>
                                <div class="uk-panel uk-margin-remove-first-child uk-margin">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <form class="uk-form-stacked" method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="name">
                                                    Full Name
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <input class="uk-input {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" type="text" required value="{{ old('name') }}"/>
                                                    </div>
                                                </div>
                                                @if ($errors->has('name'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('name') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="email">
                                                    Email
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <input class="uk-input {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" type="email" required value="{{ old('email') }}"/>
                                                    </div>
                                                </div>
                                                @if ($errors->has('email'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('email') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="phone">
                                                    Phone
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <input class="uk-input {{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" name="phone" type="text" required value="{{ old('phone') }}"/>
                                                    </div>
                                                </div>
                                                @if ($errors->has('phone'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('phone') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="password">
                                                    Password
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <a class="uk-form-icon uk-form-icon-flip" uk-tooltip="title: Minimum 8 characters.<br>This field is required.; pos: bottom-right"><span uk-icon="icon: info"></span></a>
                                                        <input class="uk-input {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" type="password" required />
                                                    </div>
                                                </div>
                                                @if ($errors->has('password'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('password') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="uk-margin">
                                                <label class="uk-form-label" for="password_confirmation">
                                                    Confirm Password
                                                </label>
                                                <div class="uk-form-controls">
                                                    <div class="uk-inline uk-width-1-1">
                                                        <input class="uk-input {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" type="password" required />
                                                    </div>
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                <div class="uk-alert-danger" uk-alert>
                                                    <span>{{ $errors->first('password') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="uk-margin">
                                                <label> <input class="uk-checkbox" name="has_agreed" required type="checkbox" /> I accept the <a href="{{ route('terms.and.conditions') }}" target="_blank">terms and conditions</a>. </label>
                                            </div>
                                            <div class="uk-margin">
                                                <button class="uk-button uk-button-secondary uk-button-large uk-width-1-1" type="submit">REGISTER</button>
                                            </div>
                                            <div class="uk-text-bold uk-text-center">ALREADY HAVE AN ACCOUNT? <a href="{{ route('login') }}">LOGIN</a></div>
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
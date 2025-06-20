@extends('layout.app')

@section('title')
Login
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

                                <h2 class="uk-h4 uk-text-muted uk-text-center">Verify Your Email Address</h2>
                                <h2 class="uk-h5 uk-text-muted uk-margin-remove-top">Please check your email for a verification link. If you did not receive the email, click the button to request another.</h2>
                                <div class="uk-panel uk-margin-remove-first-child uk-margin">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <a href="{{ route('verification.resend') }}" class="uk-button uk-button-secondary uk-button-medium">Click here to request another</a>
                                        <a class="uk-button uk-button-danger uk-button-medium" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <div class="sub_heading uk-margin">
                                            @if (session('resent'))
                                            <div class="alert alert-success" role="alert">
                                                {{ __('A fresh verification link has been sent to your email address.') }}
                                            </div>
                                            @endif
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
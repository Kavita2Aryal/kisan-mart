@extends('layout.app')

@section('title')
Account Details
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
'title' => 'Account Details',
]
)

<div class="uk-section-default uk-section uk-padding-remove-top">
    <div class="uk-container">
        <div class="uk-grid-margin uk-container">
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div>
                    <h3>Your Details</h3>
                    <div>
                        <form class="uk-form-stacked" action="{{ route('profile.update') }}" method="post">
                            @csrf
                            <div class="uk-margin uk-child-width-expand@s uk-grid-small" uk-grid>
                                <div class="email">
                                    <label class="uk-form-label" for="form-stacked-text">Email</label>
                                    <div class="uk-form-controls">
                                        <input readonly class="uk-input" id="form-stacked-text" type="email" name="email" placeholder="PHONE" value="{{ Auth::user()->email }}" />
                                    </div>
                                </div>
                                <div></div>
                            </div>
                            <div class="uk-margin uk-child-width-expand@s uk-grid-small" uk-grid>
                                <div class="name">
                                    <label class="uk-form-label" for="form-stacked-text">Full Name</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="form-stacked-text" type="text" name="name" placeholder="NAME" value="{{ Auth::user()->name }}" />
                                    </div>
                                </div>
                                <div class="phone">
                                    <label class="uk-form-label" for="form-stacked-text">Phone </label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="form-stacked-text" type="number" name="phone" placeholder="PHONE" value="{{ Auth::user()->phone }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <button class="uk-button uk-button-primary uk-button-large">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
                <div>
                    <h3>Change Password</h3>
                    <div>
                        <form class="uk-form-stacked" action="{{ route('password.update') }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="uk-margin uk-child-width-expand@s uk-grid-small" uk-grid>
                                <div class="oldpassword">
                                    <label class="uk-form-label" for="form-stacked-text">Old Password</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input {{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" required type="password" placeholder="" value="" />
                                        @if ($errors->has('old_password'))
                                        <div class="uk-alert-danger" uk-alert>
                                            <span>{{ $errors->first('old_password') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                            <div class="uk-margin uk-child-width-expand@s uk-grid-small" uk-grid>
                                <div class="password">
                                    <label class="uk-form-label" for="form-stacked-text">New Password</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required type="password" placeholder="" value="" />
                                        @if ($errors->has('password'))
                                        <div class="uk-alert-danger" uk-alert>
                                            <span>{{ $errors->first('password') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="confirmpassword">
                                    <label class="uk-form-label" for="form-stacked-text">Confirm Password</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" type="password" placeholder="" value="" required />
                                    </div>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <button class="uk-button uk-button-primary uk-button-large">UPDATE</button>
                            </div>
                        </form>
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
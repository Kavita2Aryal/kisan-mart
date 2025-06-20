@extends('layouts.auth')
@section('title', 'Password Reset')

@section('content')
<div class="row full-width-fix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="font-montserrat">Reset your password</div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.auth-notifications')
                <form role="form" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <div class="form-group form-group-default @error('email') has-error @enderror">
                        <label>Registered Email (Username)</label>
                        <div class="controls">
                            <input type="email" class="form-control" name="email" placeholder="Username (email)" required autocomplete="off" autofocus value="{{ request()->email ?? old('email') }}">
                            @error('email')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-group-default @error('password') has-error @enderror">
                        <label>Password</label>
                        <div class="controls">
                            <input type="password" class="form-control" name="password" placeholder="Credentials" required autocomplete="new-password">
                            @error('password')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-group-default @error('password_confirmation') has-error @enderror">
                        <label>Confirm Password</label>
                        <div class="controls">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Credentials" required autocomplete="new-password">
                            @error('password_confirmation')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right parent-loading">
                                <button type="submit" class="btn btn-link btn-link-fix p-l-10 p-r-10">RESET PASSWORD</button>
                                <a class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" href="{{ route('login') }}">CANCEL</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
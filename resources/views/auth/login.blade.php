@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<div class="row full-width-fix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="font-montserrat">Sign in to your account</div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.auth-notifications')
                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group form-group-default @error('email') has-error @enderror">
                        <label>Login</label>
                        <div class="controls">
                            <input type="email" class="form-control" name="email" placeholder="Email (Username)" required autocomplete="off" value="{{ old('email') }}">
                            @error('email')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-group-default @error('password') has-error @enderror">
                        <label>Password</label>
                        <div class="controls">
                            <input type="password" class="form-control" name="password" placeholder="Credentials" required autocomplete="off">
                            @error('password')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check danger">
                                <input type="checkbox" name="remember" value="1" id="checkbox-remember" checked>
                                <label for="checkbox-remember font-montserrat">Remember me</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-t-10">
                            <a href="{{ route('password.request') }}" class="normal text-complete font-montserrat">Forgot Password?</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right parent-loading">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">SIGN IN</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

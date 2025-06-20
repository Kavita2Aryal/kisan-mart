@extends('layouts.auth')
@section('title', 'Password Recovery')

@section('content')
<div class="row full-width-fix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="font-montserrat">Request for password reset</div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.auth-notifications')
                <form role="form" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group form-group-default @error('email') has-error @enderror">
                        <label>Registered Email (Username)</label>
                        <div class="controls">
                            <input type="email" class="form-control" name="email" required autocomplete="off" autofocus value="{{ old('email') }}">
                            @error('email')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right parent-loading">
                                <button type="submit" class="btn btn-link btn-link-fix p-l-10 p-r-10">SEND PASSWORD RESET LINK</button>
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
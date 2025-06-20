@extends('layouts.auth')
@section('title', 'Screen Locked')

@section('content')
<div class="row full-width-fix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="font-montserrat">Your session has ended - <span class="text-primary">{{ auth()->user()->name }}</span></div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.auth-notifications')
                <form role="form" method="post" action="{{ route('lockscreen.unlock') }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group form-group-default @error('password') has-error @enderror">
                        <label>Enter your password to unlock.</label>
                        <div class="controls">
                            <input type="password" class="form-control" name="password" placeholder="Credentials" required autofocus autocomplete="off">
                            @error('password')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="text-right parent-loading">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">SIGN ME IN</button>
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">NOT ME, SIGN OUT</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </div>
    </div>
</div>
@endsection
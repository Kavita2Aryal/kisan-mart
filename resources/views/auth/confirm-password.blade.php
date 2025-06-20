@extends('layouts.auth')
@section('title', 'Confirm Password')

@section('content')
<div class="row m-t-30 full-width">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="font-montserrat">Please confirm your password before continuing</div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ url('/user/confirm-password') }}">
                    @csrf  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('password') has-error @enderror">
                                <label>Your Password</label>
                                <input type="password" name="password" class="form-control" autofocus required autocomplete="off"/>
                                @error('password')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">CONFIRM</button>
                                <a class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" href="{{ url()->previous() }}">CANCEL</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

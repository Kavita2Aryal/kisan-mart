@extends('layouts.app')
@section('title', 'Create Customer')

@section('content')
<div class="container-fluid">
    <form role="form" class="m-t-20" method="POST" action="{{ route('customer.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xlg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Customer
                            <a href="{{ route('customer.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') error @enderror" name="name" required autocomplete="off" autofocus value="{{ old('name') }}">
                            @error('name')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default @error('email') has-error @enderror">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') error @enderror" name="email" autocomplete="off" value="{{ old('email') }}">
                            @error('email')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group required form-group-default @error('phone') has-error @enderror">
                            <label>Phone</label>
                            <input type="text" class="form-control @error('phone') error @enderror" name="phone" required autocomplete="off" value="{{ old('phone') }}">
                            @error('phone')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group required form-group-default @error('password') has-error @enderror">
                            <label>Password</label>
                            <input type="password" class="form-control @error('password') error @enderror" name="password" required autocomplete="off">
                            @error('password')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group required form-group-default @error('password_confirmation') has-error @enderror">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') error @enderror" name="password_confirmation" required autocomplete="off">
                            @error('password_confirmation')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 m-t-10">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-submit pull-right" type="submit">
                                    CREATE <span class="visible-x-inline m-l-5">CUSTOMER</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
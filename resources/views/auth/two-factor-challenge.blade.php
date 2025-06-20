@extends('layouts.auth')
@section('title', 'Two Factor Challenge')

@section('content')
<div class="row full-width-fix">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="font-montserrat">Please authenticate by entering the code provided by your authenticator app</div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.auth-notifications')
                <form role="form" method="POST" action="{{ url('/two-factor-challenge') }}">
                    @csrf
                    <div class="form-group form-group-default @error('code') has-error @enderror">
                        <label>Authentication Code</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="code" autocomplete="off" autofocus>
                            @error('code')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 p-t-10">
                            <a href="#" class="normal text-complete font-montserrat btn-use-instead">Use a recovery code</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    VERIFY
                                </button>
                                <a class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" href="{{ route('login') }}">CANCEL</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card" style="display:none;">
            <div class="card-header">
                <div class="card-title">
                    <div class="font-montserrat">Please authenticate by entering your emergency recovery codes.</div>
                </div>
            </div>
            <div class="card-body">
                @include('includes.auth-notifications')
                <form role="form" method="POST" action="{{ url('/two-factor-challenge') }}">
                    @csrf
                    <div class="form-group form-group-default @error('recovery_code') has-error @enderror">
                        <label>Recovery Code</label>
                        <div class="controls">
                            <input type="text" class="form-control" name="recovery_code" autocomplete="off">
                            @error('recovery_code')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-t-10">
                            <a href="#" class="normal text-complete font-montserrat btn-use-instead">Use an authentication code</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right parent-loading">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">VERIFY</button>
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

@push('scripts')
<script>
$(document)
.on('click', '.btn-use-instead', function (e) { e.preventDefault();
    $('.card').show(); $(this).parents('.card').hide();
});
</script>
@endpush

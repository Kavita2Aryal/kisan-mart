@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="container-fluid">
	@include('auth.includes.update-profile')
	@include('auth.includes.change-password')
	@include('auth.includes.two-factor-auth')
	@include('auth.includes.logout-other-browser-session')
	@include('auth.includes.deactivate-account')
</div>
@endsection

@push('scripts')
<script>
$(document)
.on('click', '.btn-show-recovery-codes', function (e) { e.preventDefault();
    $(this).hide(); $('.show-recovery-codes').show();
})
.on('click', '#btn-generate-password', function (e) { e.preventDefault();
    $('#password-suggestion').val(Math.random().toString(36).slice(2));
})
.on('click', '#btn-use-password', function (e) { e.preventDefault();
    $('.use-password').val($('#password-suggestion').val());
});
</script>
@endpush
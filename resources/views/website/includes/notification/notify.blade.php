<script>
@php $notify_postion = 'top-right'; @endphp
@if (session('status-notify'))
UIkit.notification({
	message: '<p class="uk-margin-remove uk-text-center uk-text-bold" style="color: #fff;">{!! session('status') !!}</p>', 
	status: 'success',
	pos: "{{ $notify_postion }}",
	timeout: 3000
});
@endif
@if(session('success-notify'))
UIkit.notification( {
	message: '<p class="uk-margin-remove uk-text-center uk-text-bold" style="color: #fff;">{!! session('success-notify') !!}</p>', 
	status: 'success',
	pos: "{{ $notify_postion }}",
	timeout: 3000
});
@endif
@if(session('error-notify'))
UIkit.notification( {
	message: '<p class="uk-margin-remove uk-text-center uk-text-bold uk-light" style="color: #fff;">{!! session('error-notify') !!}</p>', 
	status: 'danger',
	pos: "{{ $notify_postion }}",
	timeout: 3000
});
@endif
</script>
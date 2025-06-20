<script>
@if (session('status'))
	@if (session('status') == 'two-factor-authentication-enabled')
		notify_bar('info', "Two factor authentication has been enabled."); 
    @elseif (session('status') == 'two-factor-authentication-disabled')
		notify_bar('info', "Two factor authentication has been disabled.");
	@elseif (session('status') == 'profile-information-updated')
		notify_bar('info', "Your profile has been updated.");
	@elseif (session('status') == 'password-updated')
		notify_bar('info', "Your password has been updated.");
	@else
		notify_bar('info', "{{ session('status') }}");
	@endif
@elseif (session('info'))

	notify_bar('info', "{{ session('info') }}");

@elseif (session('success'))

	notify_bar('info', "{{ session('success') }}");

@elseif (session('warning'))

	notify_bar('warning', "{{ session('warning') }}");

@elseif (session('error'))

	notify_bar('danger', "{{ session('error') }}");

@elseif (session('info-circle'))

	@php $info = session('info-circle'); @endphp
	notify_circle('info', "{{ $info['title'] }}", "{{ $info['msg'] }}", "{!! $info['icon'] !!}");

@endif
</script>
<script>
var notify_bar_bottom = function(type, message) { $('body').pgNotification({ style: 'bar', message: message, position: 'bottom', timeout: 5000, type: type }).show() } 

@if (session('info'))

	notify_bar_bottom('info', "{{ session('info') }}");

@elseif (session('status'))

	notify_bar_bottom('info', "{{ session('status') }}");

@elseif (session('success'))

	notify_bar_bottom('success', "{{ session('success') }}");

@elseif (session('warning'))

	notify_bar_bottom('warning', "{{ session('warning') }}");

@elseif (session('error'))

	notify_bar_bottom('danger', "{{ session('error') }}");
@endif
</script>
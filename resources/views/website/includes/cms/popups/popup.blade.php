@isset($page->popups)
	@if($settings['popup-display-per-session'] == "OFF" && session()->has('popup'))
		{{ session()->forget('popup') }}
	@endif
	@php $i = 0; $count = $page->popups->count(); $current_dateTime = date('Y-m-d H:i:s'); $session_time_options = config('app.addons_config.session_time_options'); @endphp
	@foreach($page->popups as $popup)
		@if($popup->is_active == 10)
			@php $i++; @endphp
			<div class="popup-contents uk-flex-top uk-modal-container" id="modal-close-default-{{ $i }}" uk-modal="bg-close:false">
				<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-padding uk-text-center">
					<div><a href="javascript:void(0);" class="btn-close-modal" data-index="{{ $i }}" uk-icon="icon: close"></a></div>
					<h2 class="uk-modal-title uk-text-primary uk-h3 uk-font-tertiary uk-margin-small-top">{!! $popup->title !!}</h2>
					@if($popup->image_id != null && $popup->image_id > 0)
					<div class="uk-text-center">
						<a href="{{ secure_img($popup->image->image, 'main') }}" target="_blank">
							<img class="el-image lozad" alt="" data-src="{{ secure_img($popup->image->image, 'main') }}" uk-img>
						</a>
					</div>
					@endif

					@if($popup->description != null)
					<div class="uk-margin-top">{!! $popup->description !!} </div>
					@endif
				</div>
			</div>
		@endif
	@endforeach
	<script>
		var session_popup = "{{ session()->has('popup') }}";
		$(function() {
			if(session_popup === "") {
				UIkit.modal('#modal-close-default-1').show();
			}
			$(document).on('click', '.btn-close-modal', function(e) {
				e.preventDefault();
				var index = parseInt($(this).data('index'));
				UIkit.modal('#modal-close-default-' + index).hide();
				if ($('.popup-contents').length > index) {
					UIkit.modal('#modal-close-default-' + (++index)).show();
				}
			});
		});
	</script>
	@if($settings['popup-display-per-session'] == "ON" && !session()->has('popup'))
		{{ session()->put('popup', $current_dateTime) }}
	@endif
	@if(session()->has('popup'))
		@php 
			$popup_set_time = session()->get('popup');
			$time = '+' . $session_time_options[$settings['popup-display-per-session-time']];
			$modified_time = date('Y-m-d H:i:s', strtotime($time, strtotime($popup_set_time)));
		@endphp
		@if($modified_time <= $current_dateTime)
			{{ session()->forget('popup') }}
		@endif
	@endif
@endisset
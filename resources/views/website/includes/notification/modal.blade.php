@if (session('status-modal'))
<div id="status-modal" class="uk-flex-top uk-open" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">INFO</h2>
        <p>{{ session('status-modal') }}</p>
    </div>
</div>
<script>
$(document).ready(function() {
    setTimeout( function () {
        UIkit.modal("#status-modal").show();
    }, 1000);
});
</script>
@endif
@if (session('success-modal'))
<div id="success-modal" class="uk-flex-top uk-modal uk-flex uk-open" uk-modal>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <button class="uk-modal-close-outside uk-icon uk-close" type="button" uk-close></button>
        <div class="uk-modal-header">
            <img src="{{ url('storage/website/logo.svg') }}" sizes="(min-width: 300px) 300px" data-width="300" data-height="123" class="el-image" width="200" alt="">
        </div>
        <div class="uk-modal-body">
            <div class="el-content uk-panel uk-margin-top uk-padding">
                {!! session('success-modal') !!}
                <p>Sincerely,<br>{!! $settings['contact-title'] !!}<br><br>{!! $settings['contact-address'] !!}
                </p>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">

            <a class="uk-button uk-button-primary" href="{{ route('home') }}">Continue</a>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    setTimeout( function () {
        UIkit.modal("#success-modal").show();
    }, 1000);
});
</script>
@endif
@if (session('danger-modal'))
<div id="danger-modal" class="uk-flex-top uk-open" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">DANGER</h2>
        <p>{{ session('danger-modal') }}</p>
    </div>
</div>
<script>
$(document).ready(function() {
    setTimeout( function () {
        UIkit.modal("#danger-modal").show();
    }, 1000);
});
</script>
@endif
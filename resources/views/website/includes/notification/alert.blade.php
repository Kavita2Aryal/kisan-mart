@if (session('status-alert'))
<div class="uk-alert-primary" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ session('status-alert') }}</p>
</div>
@endif
@if (session('success-alert'))
<div class="uk-alert-success" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ session('success-alert') }}</p>
</div>
@endif
@if (session('danger-alert'))
<div class="uk-alert-danger" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p>{{ session('danger-alert') }}</p>
</div>
@endif

{{ --
    use case for block alert notification inside the form
    @include('includes.notification.alert')
-- }}
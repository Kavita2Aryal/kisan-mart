@if (session()->has('status'))
<div class="alert alert-info" role="alert">
    <button class="close" data-dismiss="alert"></button>
    <strong>Info: </strong>{{ session()->get('status') }}
</div>
@endif
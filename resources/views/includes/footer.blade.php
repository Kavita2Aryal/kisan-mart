<div class="container-fluid footer">
    <div class="copyright">
        <div>
            <span class="first-line">
                <a href="{{ config('app.config.system.website') }}" class="text-complete" target="_blank">
                    <img src="{{ asset('assets/img/tc-logo.png') }}" alt="logo" width="25" class="m-r-5">
                    {{ config('app.config.system.name') }}
                </a>
                &copy; {{ now()->year }} All Rights Reserved.
            </span>
            <span class="second-line">{{ config('app.config.system.version') }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
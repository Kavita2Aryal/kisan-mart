<div class="row">
    <div class="col-xl-5 col-lg-5">
        <h4>Browser Sessions</h4>
        <p>Manage and logout your active sessions on other browsers and devices.</p>
    </div>
    <div class="col-xl-7 col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="m-b-0">If necessary, you may logout of all of your other browser sessions across all of your devices.</p>
                        <p>If you feel your account has been compromised, you should also update your password.</p>
                    </div>
                </div>
                @if (count($browserSessions) > 0)
                @foreach ($browserSessions as $session)
                <div class="row m-t-15">
                    <div class="col-md-12">
                        <div class="d-flex">
                            <span class="icon-thumbnail pull-left">
                                @if ($session->agent->isDesktop())
                                    <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                        <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                        <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                    </svg>
                                @endif
                            </span>
                            <div class="flex-1 full-width">
                                <p class="no-margin font-montserrat">
                                    {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                                </p>
                                <p class="hint-text font-montserrat small no-margin">
                                    {{ $session->ip_address }},
                                    @if ($session->is_current_device)
                                    <span class="text-success">This device</span>
                                    @else
                                    Last active {{ $session->last_active }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <div class="row m-t-15">
                    <div class="col-md-12">
                        <form method="get" action="{{ route('profile.logout.other') }}">
                            @csrf
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" type="submit">LOGOUT OTHER BROWSER SESSIONS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
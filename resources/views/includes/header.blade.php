@php 
$string_split = explode(" ", Auth::user()->name);
$inititals = $string_split[0][0] . (isset($string_split[1][0]) ? $string_split[1][0] : (isset($string_split[0][1]) ? $string_split[0][1] : ''));
@endphp
<div class="header">
    <div class="inline">
        <div class="visible-x">
            <a href="{{ route('dash.index') }}" class="p-l-15">
                <img src="{{ asset('assets/img/tccms-logo.svg') }}" alt="logo" style="width: 47%;">
            </a>
        </div>
        <div class="hidden-x">
            <a href="{{ route('dash.index') }}">
                <img src="{{ asset('assets/img/tccms-logo.svg') }}" alt="logo" style="width: 47%;">
            </a>
        </div>
    </div>
    <div class="inline">
        <div class="dropdown profile-menu">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown">
                <span class="thumbnail-wrapper d32 circular inline" style="background-color: #007a9f;">
                    <span class="text-white">{{ strtoupper($inititals) }}</span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                <span class="dropdown-item fs-12 hint-text">
                    Signed in as <br />
                    <strong>{{ \Str::limit(auth()->user()->name, 30) }},</strong> <br />
                    <strong>{{ \Str::limit(auth()->user()->email, 30) }}</strong>
                </span>
                @if (session()->has('login-datetime'))
                <div class="dropdown-divider"></div>
                <span class="dropdown-item fs-12 hint-text">
                    Signed in at:<br />
                    <span>{{ \Carbon\Carbon::parse(session()->get('login-datetime'))->format('Y F j') }}</span><br />
                    <span>{{ \Carbon\Carbon::parse(session()->get('login-datetime'))->format('l, h:i A') }}</span><br />
                    <span>{{ \Carbon\Carbon::parse(session()->get('login-datetime'))->diffForHumans() }}</span>
                </span>
                @endif
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile') }}" class="dropdown-item">My Profile</a>
                <a href="{{ route('log.me') }}" class="dropdown-item">My Activity</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); locking();">Lock Screen</a>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <div class="dropdown-divider"></div>
                <a href="{{ config('app.config.system.website') }}" target="_blank" class="dropdown-item fs-12 hint-text">{{ strtoupper(config('app.config.system.version')) }}</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-5 col-lg-5">
        <h4>Two Factor Authentication</h4>
        <p>Add additional security to your account using two factor authentication.</p>
    </div>
    <div class="col-xl-7 col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h6>You have {{ $profile->two_factor_secret == NULL ? 'not enabled' : 'enabled' }} two factor authentication.</h6>
                        <p class="m-b-0">When two factor authentication is enabled, you will be prompted for a secure, random token during authentication.</p>
                        <p>You may retrieve this token from your phone's Google Authenticator application.</p>
                    </div>
                </div>
                @if ($profile->two_factor_secret != NULL)
                <div class="row m-t-20">
                    <div class="col-md-12">
                        <p class="m-b-20"><strong>Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.</strong></p>
                        {!! $profile->twoFactorQrCodeSvg() !!}
                    </div>
                </div>
                <div class="row m-t-30 show-recovery-codes" style="display:none;">
                    <div class="col-md-12">
                        <p class="m-b-20"><strong>Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.</strong></p>
                        <div class="fake-pre">
                            @forelse($profile->recoveryCodes() as $recoveryCode)
                                <span>{{ $recoveryCode }}</span><br/>
                            @empty
                                No recovery codes available at the moment.
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-md-12">
                        <div class="inline">
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-show-recovery-codes" type="submit">SHOW RECOVERY CODES</button>
                        </div>
                        <form method="post" class="inline" action="{{ url('user/two-factor-recovery-codes') }}">
                            @csrf
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 show-recovery-codes" type="submit" style="display:none;">REGENERATE RECOVERY CODES</button>
                        </form>
                        <form method="post" class="inline" action="{{ route('two-factor.disable') }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" type="submit">DISABLE</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="row m-t-20">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('two-factor.enable') }}">
                            @csrf
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 text-success" type="submit">ENABLE</button>                          
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
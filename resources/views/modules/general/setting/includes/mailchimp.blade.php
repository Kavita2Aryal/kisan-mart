@can('mailchimp.status')
<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Mailchimp: Newsletter System</h4>
        <p>Activate mailchimp newsletter system on the website.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6>This feature is used to activate or deactivate the mailchimp newsletter system .</h6>
                <p class="m-b-20">When activated, system will be able to subscribe/unsubscribe and send bulk email to clients.</p>

                @if ($data['mailchimp-status'] == 'ON')
                <form method="POST" action="{{ route('setting.update.status', ['mailchimp-status']) }}">
                    @csrf
                    @method('PUT')
                    <p class="m-b-20"><strong>Mailchimp Newsletter System is Activated.</strong></p>
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            DISABLE
                        </button>
                    </div>
                </form>
                @else
                <form method="POST" action="{{ route('setting.update.status', ['mailchimp-status']) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix text-danger p-l-10 p-r-10" type="submit">
                            ENABLE
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endcan
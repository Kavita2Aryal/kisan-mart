@cannot('super.auth')
<div class="row p-b-10">
    <div class="col-xl-5 col-lg-5">
        <h4>Deactivate Account</h4>
        <p>Permanently deactivate your account.</p>
    </div>
    <div class="col-xl-7 col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="m-b-0">Once your account is deactivated, all of its resources and data will be permanently deleted.</p>
                        <p>Before deactivating your account, please download any data or information that you wish to retain.</p>
                    </div>
                </div>
                <div class="row m-t-5">
                    <div class="col-md-12">
                        <form method="get" action="{{ route('profile.deactivate') }}">
                            @csrf
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" type="submit">DEACTIVATE YOUR ACCOUNT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcannot
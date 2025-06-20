@can('maintenance.mode')
<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Website Maintenance Mode</h4>
        <p>Website maintenance mode activation.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6>This feature is used to put website on maintenance mode.</h6>
                <p class="m-b-20">When maintenance mode is enabled, the website will show a disclaimer stating the website is currently on maintenance mode.</p>
                
                @if ($data['maintenance-mode'] == 'ON')	
                <form method="POST" action="{{ route('setting.update.status', ['maintenance-mode']) }}">
                    @csrf
                    @method('PUT')
                    <p class="m-b-20"><strong>The website is in maintenance mode.</strong></p>
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            DISABLE
                        </button>
                    </div>  
                </form>
                @else
                <form method="POST" action="{{ route('setting.update.status', ['maintenance-mode']) }}">
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
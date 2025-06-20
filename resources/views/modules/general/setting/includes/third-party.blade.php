@can('third.party.status')
<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Other Third Party:</h4>
        <p>Activate Other Third Party tools on the website.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6>This feature is used to activate or deactivate the Other Third Party tools.</h6>
                <p class="m-b-20">When activated, you will be able to embed any Other Third Party tools to the website.</p>
                
                @if ($data['third-party-status'] == 'ON')	
                <form method="POST" action="{{ route('setting.update.status', ['third-party-status']) }}">
                    @csrf
                    @method('PUT')
                    <p class="m-b-20"><strong>Other Third Party Tools is Activated.</strong></p>
                    <div class="form-group m-b-20">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            DISABLE
                        </button>
                    </div>  
                </form>
                <form method="POST" action="{{ route('setting.update.value', ['third-party-embed']) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-group-default">
                        <textarea name="value" class="form-control" placeholder="Paste your embed code here" required style="height:150px;">{{ $data['third-party-embed'] }}</textarea>
                    </div>
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            SAVE
                        </button>
                    </div>  
                </form>
                @else
                <form method="POST" action="{{ route('setting.update.status', ['third-party-status']) }}">
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

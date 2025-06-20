@can('google.analytics.status')
<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Google Analytics:</h4>
        <p>Activate Google Analytics on the website.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6>This feature is used to activate or deactivate the Google Analytics tool .</h6>
                <p class="m-b-20">When activated, Google Analytics gives you the free tools you need to analyze data for your business in one place.</p>
                
                @if ($data['google-analytics-status'] == 'ON')	
                <form method="POST" action="{{ route('setting.update.status', ['google-analytics-status']) }}">
                    @csrf
                    @method('PUT')
                    <p class="m-b-20"><strong>Google Analytics Tools is Activated.</strong></p>
                    <div class="form-group m-b-20">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            DISABLE
                        </button>
                    </div>  
                </form>
                <form method="POST" action="{{ route('setting.update.value', ['google-analytics-embed']) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-group-default">
                        <textarea name="value" class="form-control" placeholder="Paste your embed code here" required style="height:75px;">{{ $data['google-analytics-embed'] }}</textarea>
                    </div>
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            SAVE
                        </button>
                    </div>  
                </form>
                @else
                <form method="POST" action="{{ route('setting.update.status', ['google-analytics-status']) }}">
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

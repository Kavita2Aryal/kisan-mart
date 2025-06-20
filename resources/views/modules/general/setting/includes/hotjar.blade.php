@can('hotjar.status')
<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Hotjar: Website Heatmaps & Behavior Analytics</h4>
        <p>Activate Hotjar Analytics on the website.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6>This feature is used to activate or deactivate the Hotjar Analytics tool .</h6>
                <p class="m-b-20">When activated, system will be able to understand how users behave on your site, what they need, and how they feel, fast.</p>
                
                @if ($data['hotjar-status'] == 'ON')	
                <form method="POST" action="{{ route('setting.update.status', ['hotjar-status']) }}">
                    @csrf
                    @method('PUT')
                    <p class="m-b-20"><strong>Hotjar: Website Heatmaps & Behavior Analytics Tools is Activated.</strong></p>
                    <div class="form-group m-b-20">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            DISABLE
                        </button>
                    </div>  
                </form>
                <form method="POST" action="{{ route('setting.update.value', ['hotjar-embed']) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-group-default">
                        <textarea name="value" class="form-control" placeholder="Paste your embed code here" required style="height:75px;">{{ $data['hotjar-embed'] }}</textarea>
                    </div>
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            SAVE
                        </button>
                    </div>  
                </form>
                @else
                <form method="POST" action="{{ route('setting.update.status', ['hotjar-status']) }}">
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

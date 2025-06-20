@can('chatbot.status')
<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Chat Bot:</h4>
        <p>Activate Chat Bot system on the website.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6>This feature is used to activate or deactivate the Chat Bot tool .</h6>
                <p class="m-b-20">When activated, website visitor can chat with your representative through prefered chat bot interface.</p>
                
                @if ($data['chatbot-status'] == 'ON')	
                <form method="POST" action="{{ route('setting.update.status', ['chatbot-status']) }}">
                    @csrf
                    @method('PUT')
                    <p class="m-b-20"><strong>Chat Bot system is Activated.</strong></p>
                    <div class="form-group m-b-20">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            DISABLE
                        </button>
                    </div>  
                </form>
                <form method="POST" action="{{ route('setting.update.value', ['chatbot-embed']) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-group-default">
                        <textarea name="value" class="form-control" placeholder="Paste your embed code here" required style="height:75px;">{{ $data['chatbot-embed'] }}</textarea>
                    </div>
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                            SAVE
                        </button>
                    </div>  
                </form>
                @else
                <form method="POST" action="{{ route('setting.update.status', ['chatbot-status']) }}">
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

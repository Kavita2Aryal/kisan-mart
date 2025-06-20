<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Happy Customer Details</h4>
        <p>Manage and update the details that will appear on the website's product page.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.happy-customer-title') has-error @enderror">
                                <label>Title</label>
                                <textarea class="form-control @error('setting.isrequired.happy-customer-title') error @enderror" name="setting[isrequired][happy-customer-title]" required style="height:60px;">{{ $data['happy-customer-title'] }}</textarea>
                                @error('setting.isrequired.happy-customer-title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.happy-customer-description') has-error @enderror">
                                <label>Description</label>
                                <textarea class="form-control @error('setting.isrequired.happy-customer-description') error @enderror" name="setting[isrequired][happy-customer-description]" required style="height:100px;">{{ $data['happy-customer-description'] }}</textarea>
                                @error('setting.isrequired.happy-customer-description')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-check-group p-t-15 p-b-15">
                                <div class="form-check switch switch-lg info full-width right m-b-0 p-r-10">
                                    <input type="checkbox" class="setting-toggle" id="happy-customer-status" @if ($data['happy-customer-status']=='ON' ) checked @endif>
                                    <label for="happy-customer-status">Display on Website? </label>
                                    <input type="hidden" class="form-value" name="setting[notrequired][happy-customer-status]" value="{{ $data['happy-customer-status'] }}">
                                </div>
                            </div>
                        </div>
                    </div>  
                    @can('setting.update')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">SETTINGS</span>
                                </button>
                            </div> 
                        </div>
                    </div>
                    @endcan 
                </form>
            </div>
        </div>
    </div>
</div>
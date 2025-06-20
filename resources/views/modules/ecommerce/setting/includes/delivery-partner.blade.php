<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Delivery Partner Details</h4>
        <p>Manage and update the descriptions that will appear on the website's checkout page.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.delivery-partner-title') has-error @enderror">
                                <label>Title</label>
                                <textarea class="form-control @error('setting.isrequired.delivery-partner-title') error @enderror" name="setting[isrequired][delivery-partner-title]" required style="height:60px;">{{ $data['delivery-partner-title'] }}</textarea>
                                @error('setting.isrequired.delivery-partner-title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.delivery-partner-description') has-error @enderror">
                                <label>Description</label>
                                <textarea class="form-control @error('setting.isrequired.delivery-partner-description') error @enderror" name="setting[isrequired][delivery-partner-description]" required style="height:100px;">{{ $data['delivery-partner-description'] }}</textarea>
                                @error('setting.isrequired.delivery-partner-description')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-check-group p-t-15 p-b-15">
                                <div class="form-check switch switch-lg info full-width right m-b-0 p-r-10">
                                    <input type="checkbox" class="setting-toggle" id="delivery-partner-status" @if ($data['delivery-partner-status']=='ON' ) checked @endif>
                                    <label for="delivery-partner-status">Display on Website? </label>
                                    <input type="hidden" class="form-value" name="setting[notrequired][delivery-partner-status]" value="{{ $data['delivery-partner-status'] }}">
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
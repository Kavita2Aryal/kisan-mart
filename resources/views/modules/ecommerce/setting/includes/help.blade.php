<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Help Details</h4>
        <p>Manage and update the descriptions that will appear on the website's order detail page.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.help-title') has-error @enderror">
                                <label>Title</label>
                                <textarea class="form-control @error('setting.isrequired.help-title') error @enderror" name="setting[isrequired][help-title]" required style="height:60px;">{{ $data['help-title'] }}</textarea>
                                @error('setting.isrequired.help-title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.help-description') has-error @enderror">
                                <label>Description</label>
                                <textarea class="form-control @error('setting.isrequired.help-description') error @enderror" name="setting[isrequired][help-description]" required style="height:100px;">{{ $data['help-description'] }}</textarea>
                                @error('setting.isrequired.help-description')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-check-group p-t-15 p-b-15">
                                <div class="form-check switch switch-lg info full-width right m-b-0 p-r-10">
                                    <input type="checkbox" class="setting-toggle" id="help-status" @if ($data['help-status']=='ON' ) checked @endif>
                                    <label for="help-status">Display on Website? </label>
                                    <input type="hidden" class="form-value" name="setting[notrequired][help-status]" value="{{ $data['help-status'] }}">
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
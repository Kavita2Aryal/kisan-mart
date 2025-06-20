<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Made With Love</h4>
        <p>Manage and update the section, which appears on product pages.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.made-with-love-title') has-error @enderror">
                                <label>Title</label>
                                <textarea class="form-control @error('setting.isrequired.made-with-love-title') error @enderror" name="setting[isrequired][made-with-love-title]" required style="height:60px;">{{ $data['made-with-love-title'] }}</textarea>
                                @error('setting.isrequired.made-with-love-title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.made-with-love-description') has-error @enderror">
                                <label>Description</label>
                                <textarea class="form-control @error('setting.isrequired.made-with-love-description') error @enderror" name="setting[isrequired][made-with-love-description]" required style="height:100px;">{{ $data['made-with-love-description'] }}</textarea>
                                @error('setting.isrequired.made-with-love-description')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-check-group p-t-15 p-b-15">
                                <div class="form-check switch switch-lg info full-width right m-b-0 p-r-10">
                                    <input type="checkbox" class="setting-toggle" id="made-with-love-status" @if ($data['made-with-love-status']=='ON' ) checked @endif>
                                    <label for="made-with-love-status">Display on Website? </label>
                                    <input type="hidden" class="form-value" name="setting[notrequired][made-with-love-status]" value="{{ $data['made-with-love-status'] }}">
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
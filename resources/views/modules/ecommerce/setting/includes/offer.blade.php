<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Offer Details</h4>
        <p>Manage and update the offer link and description that appears in the website's header.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.offer-title') has-error @enderror">
                                <label>Offer Title</label>
                                <input type="text" class="form-control @error('setting.isrequired.offer-title') error @enderror" name="setting[isrequired][offer-title]" required autocomplete="off" value="{{ $data['offer-title'] }}">
                                @error('setting.isrequired.offer-title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.offer-link-title') has-error @enderror">
                                <label>Offer Link Title</label>
                                <input type="text" class="form-control @error('setting.isrequired.offer-link-title') error @enderror" name="setting[isrequired][offer-link-title]" required autocomplete="off" value="{{ $data['offer-link-title'] }}">
                                @error('setting.isrequired.offer-link-title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required form-group-default @error('setting.isrequired.offer-link') has-error @enderror">
                                <label>Offer Link</label>
                                <input type="url" class="form-control @error('setting.isrequired.offer-link') error @enderror" name="setting[isrequired][offer-link]" required autocomplete="off" value="{{ $data['offer-link'] }}">
                                @error('setting.isrequired.offer-link')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-check-group p-t-15 p-b-15">
                                <div class="form-check switch switch-lg info full-width right m-b-0 p-r-10">
                                    <input type="checkbox" class="setting-toggle" id="offer-status" @if ($data['offer-status']=='ON' ) checked @endif>
                                    <label for="offer-status">Activate Offer? </label>
                                    <input type="hidden" class="form-value" name="setting[notrequired][offer-status]" value="{{ $data['offer-status'] }}">
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
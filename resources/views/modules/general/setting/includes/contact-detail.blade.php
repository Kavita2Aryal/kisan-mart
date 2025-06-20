<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Contact Details</h4>
        <p>Manage and update website's contact infromations.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('setting.isrequired.contact-title') has-error @enderror">
                                <label>Contact Title</label>
                                <input type="text" name="setting[isrequired][contact-title]" class="form-control" required autocomplete="off" value="{{ $data['contact-title'] }}"/>
                                @error('setting.isrequired.contact-title')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('setting.isrequired.contact-email') has-error @enderror">
                                <label>Contact Email(s)</label>
                                <input type="text" name="setting[isrequired][contact-email]" class="form-control" required autocomplete="off" value="{{ $data['contact-email'] }}"/>
                                @error('setting.isrequired.contact-email')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default @error('setting.notrequired.contact-phone') has-error @enderror">
                                <label>Contact Phone(s)</label>
                                <input type="text" name="setting[notrequired][contact-phone]" class="form-control" autocomplete="off" value="{{ $data['contact-phone'] }}"/>
                                @error('setting.notrequired.contact-phone')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default @error('setting.notrequired.contact-mobile') has-error @enderror">
                                <label>Contact Mobile(s)</label>
                                <input type="text" name="setting[notrequired][contact-mobile]" class="form-control" autocomplete="off" value="{{ $data['contact-mobile'] }}"/>
                                @error('setting.notrequired.contact-mobile')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default @error('setting.notrequired.contact-address') has-error @enderror">
                                <label>Contact Address</label>
                                <textarea name="setting[notrequired][contact-address]" class="form-control">{{ $data['contact-address'] }}</textarea>
                                @error('setting.notrequired.contact-address')
                                    <label class="error">{{ $message }}</label>
                                @enderror
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
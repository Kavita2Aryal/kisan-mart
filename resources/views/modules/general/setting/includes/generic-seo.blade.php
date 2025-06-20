<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Generic Seo Details</h4>
        <p>Manage and update website's generic seo.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('setting.isrequired.generic-meta-title') has-error @enderror">
                                <label>Meta Title</label>
                                <input type="text" name="setting[isrequired][generic-meta-title]" class="form-control" required autocomplete="off" value="{{ $data['generic-meta-title'] }}"/>
                                @error('setting.isrequired.generic-meta-title')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('setting.isrequired.generic-meta-description') has-error @enderror">
                                <label>Meta Description</label>
                                <textarea oninput="auto_grow(this)" name="setting[isrequired][generic-meta-description]" class="form-control">{{ $data['generic-meta-description'] }}</textarea>
                                @error('setting.isrequired.generic-meta-description')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default form-group-tagsinput required @error('setting.isrequired.generic-meta-keywords') has-error @enderror">
                                <label>Type Meta Keywords & press enter</label>
                                <input type="text" name="setting[isrequired][generic-meta-keywords]" data-role="tagsinput" class="form-control ignore-navigate-away" required autocomplete="off" value="{{ $data['generic-meta-keywords'] }}"/>
                                @error('setting.isrequired.generic-meta-keywords')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('setting.isrequired.generic-meta-image-alt') has-error @enderror">
                                <label>Meta Image Alt</label>
                                <input type="text" name="setting[isrequired][generic-meta-image-alt]" class="form-control" required autocomplete="off" value="{{ $data['generic-meta-image-alt'] }}"/>
                                @error('setting.isrequired.generic-meta-image-alt')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-seo" data-populate-media=".populate-container-seo" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Meta Image</button>
                            @error('setting.isrequired.generic-meta-image')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="row m-t-10 m-b-10">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="hidden" name="setting[isrequired][generic-meta-image]" class="populate-value-seo" value="{{ $image['generic-meta-image'] ?? 0 }}">
                            <div class="populate-container populate-container-seo">
                                @if ($image != null &&  $image['generic-meta-image'])
                                <div class="populate-media">
                                    <a href="{{ secure_img($image['generic-meta-image'], '1200') }}" target="_blank">
                                        <img src="{{ secure_img($image['generic-meta-image'], '480X320') }}" class="full-width">
                                    </a>
                                </div>
                                @endif
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
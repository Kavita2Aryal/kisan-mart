<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Logo & Favicon</h4>
        <p>Manage and update website's logo and favicon.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-logo" data-populate-media=".populate-container-logo" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Logo Image</button>
                            @error('setting.isrequired.logo-image')
                            <label class="error">{{ $message }}</label>
                            @enderror
                            <input type="hidden" name="setting[isrequired][logo-image]" class="populate-value-logo" value="{{ $image['logo-image'] ?? 0 }}">
                            <div class="populate-container populate-container-logo m-t-10">
                                @if ($image != null &&  $image['logo-image'])
                                <div class="populate-media">
                                    <a href="{{ secure_img($image['logo-image'], '1200') }}" target="_blank">
                                        <img src="{{ secure_img($image['logo-image'], '480X320') }}" class="full-width">
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-favicon" data-populate-media=".populate-container-favicon" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Favicon Image</button>
                            @error('setting.isrequired.favicon-image')
                            <label class="error">{{ $message }}</label>
                            @enderror
                            <input type="hidden" name="setting[isrequired][favicon-image]" class="populate-value-favicon" value="{{ $image['favicon-image'] ?? 0 }}">
                            <div class="populate-container populate-container-favicon m-t-10">
                                @if ($image != null && $image['favicon-image'])
                                <div class="populate-media">
                                    <a href="{{ secure_img($image['favicon-image'], '1200') }}" target="_blank">
                                        <img src="{{ secure_img($image['favicon-image'], '480X320') }}" class="full-width">
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
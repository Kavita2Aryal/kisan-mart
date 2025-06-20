<div class="seo-content">
    <div class="form-group required form-group-default @error('seo.meta_title') has-error @enderror">
        <label>Meta Title</label>
        <div class="controls">
            <textarea class="form-control @error('seo.meta_title') error @enderror" name="seo[meta_title]" placeholder="Meta Title" required style="height:60px;">{{ $seo->meta_title ?? old('seo.meta_title') }}</textarea>
            @error('seo.meta_title')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group required form-group-default @error('seo.meta_description') has-error @enderror">
        <label>Meta Description</label>
        <div class="controls">
            <textarea class="form-control @error('seo.meta_description') error @enderror" name="seo[meta_description]" placeholder="Meta Description" required style="height:60px;">{{ $seo->meta_description ?? old('seo.meta_description') }}</textarea>
            @error('seo.meta_description')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group required form-group-default form-group-tagsinput seo-keywords @error('seo.meta_keywords') has-error @enderror" style="height:100px;">
        <label>Meta Keywords: Type & press enter</label>
        <div class="controls">
            <input type="text" class="form-control @error('seo.meta_keywords') error @enderror" name="seo[meta_keywords]" data-role="tagsinput" placeholder="Meta Keywords" required autocomplete="off" value="{{ $seo->meta_keywords ?? old('seo.meta_keywords') }}">
            @error('seo.meta_keywords')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group required form-group-default @error('seo.meta_twitter') has-error @enderror">
        <label>Meta Twitter</label>
        <div class="controls">
            <input type="text" class="form-control @error('seo.meta_twitter') error @enderror" name="seo[meta_twitter]" placeholder="Meta Twitter" autocomplete="off" required value="{{ $seo->meta_twitter ?? old('seo.meta_twitter') }}">
            @error('seo.meta_twitter')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <button type="button" class="btn btn-outline-info btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-seo" data-populate-media=".populate-container-seo" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Select Meta Image</button>
        </div>
    </div>
    @php 
    if (isset($seo->image_id) && $seo->image_id > 0) {
        $seo_img_min = isset($seo->image->image) ? secure_img($seo->image->image, '480X320'): ''; 
        $seo_img_max = isset($seo->image->image) ? secure_img($seo->image->image, '1200') : '';
    }
    else {
        $seo_img_min = '';
        $seo_img_max = '';
    }
    @endphp
    <div class="row m-t-10">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-4">
            <input type="hidden" name="seo[meta_image]" class="populate-value-seo" value="{{ $seo->image_id ?? 0 }}">
            <div class="populate-container populate-container-seo">
                <div class="populate-media">
                    <a href="{{ $seo_img_max }}" target="_blank">
                        <img src="{{ $seo_img_max }}" class="full-width">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
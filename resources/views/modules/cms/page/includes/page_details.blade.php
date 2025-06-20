<div class="form-group required form-group-default @error('name') has-error @enderror">
    <label>Page Name</label>
    <input type="text" name="name" class="form-control alias-source @error('name') error @enderror" required autocomplete="off" value="{{ $page->name ?? old('name') }}">
    @error('name')
        <label class="error">{{ $message }}</label>
    @enderror
</div>
<div class="form-group form-group-default required input-group alias-edit @error('alias') has-error @enderror">
    <div class="input-group-append">
        <span class="input-group-text"><i class="pg-icon m-r-5">globe</i> {{ get_setting('website-domain') }}</span>
    </div>
    <div class="form-input-group">
        <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ $page->alias->alias ?? old('alias') }}">
        <input type="hidden" class="alias-index" name="alias_id" value="{{ $page->alias->id ?? 0 }}">
    </div>
</div>
@error('alias')
<div class="alias-error">
    <label class="error">{{ $message }}</label>
</div>
@enderror
<div class="form-check info">
    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($page != null && $page->is_active == 10) checked @endif>
    <label for="checkbox-active">Publish ?</label>
</div>

<div class="page-seo-content m-t-25">
    <div class="font-montserrat m-b-10 fs-11 text-info">SEO DETAILS</div>
    <div class="form-group required form-group-default @error('seo.meta_title') has-error @enderror">
        <label>Meta Title</label>
        <div class="controls">
            <textarea class="form-control @error('seo.meta_title') error @enderror" name="seo[meta_title]" required style="height:60px;">{{ $page->seo->meta_title ?? old('seo.meta_title') }}</textarea>
            @error('seo.meta_title')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group required form-group-default @error('seo.meta_description') has-error @enderror">
        <label>Meta Description</label>
        <div class="controls">
            <textarea class="form-control @error('seo.meta_description') error @enderror" name="seo[meta_description]" required style="height:60px;">{{ $page->seo->meta_description ?? old('seo.meta_description') }}</textarea>
            @error('seo.meta_description')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group required form-group-default form-group-tagsinput @error('seo.meta_keywords') has-error @enderror" style="height:100px;">
        <label>Meta Keywords: Type & press enter</label>
        <div class="controls">
            <input type="text" class="form-control @error('seo.meta_keywords') error @enderror ignore-navigate-away" name="seo[meta_keywords]" data-role="tagsinput" placeholder="Meta Keywords" required autocomplete="off" value="{{ $page->seo->meta_keywords ?? old('seo.meta_keywords') }}">
            @error('seo.meta_keywords')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="form-group form-group-default @error('seo.image_alt') has-error @enderror">
        <label>Meta Image Alt</label>
        <div class="controls">
            <input type="text" class="form-control @error('seo.image_alt') error @enderror" name="seo[image_alt]" placeholder="Meta Image Alt" autocomplete="off" value="{{ $page->seo->image_alt ?? old('seo.image_alt') }}">
            @error('seo.image_alt')
            <label class="error">{{ $message }}</label>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-seo" data-populate-media=".populate-container-seo" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Meta Image</button>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-4">
            <input type="hidden" name="seo[meta_image]" class="populate-value-seo" value="{{ $page->seo->image_id ?? 0 }}">
            <div class="populate-container populate-container-seo">
                @if (isset($page->seo->image_id) && $page->seo->image_id > 0 && isset($page->seo->image->image))
                <div class="populate-media">
                    <a href="{{ secure_img($page->seo->image->image, '1200') }}" target="_blank">
                        <img src="{{ secure_img($page->seo->image->image, '480X320') }}" class="full-width">
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
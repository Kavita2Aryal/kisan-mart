@php $index = indexing(); @endphp
<div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6 item-slide">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Slide <span class="sn-index"></span></div>
            <a href="#" class="normal btn btn-link pull-right m-r-5 btn-remove-slide text-danger m-b-0">
                <i class="pg-icon">close_lg</i>
            </a>
            <a href="#" class="normal btn btn-link pull-right m-r-5 m-b-0">
                <div class="form-check info m-t-0 m-b-0">
                    <input type="checkbox" id="publish-slide-{{ $index }}" name="items[{{ $index }}][is_active]" value="10" @if(isset($item->is_active) && $item->is_active==10) checked @endif>
                    <label for="publish-slide-{{ $index }}">Publish ?</label>
                </div>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-default @error('items.{{ $index }}.title') has-error @enderror">
                        <label>Slide Title</label>
                        <input type="text" class="form-control @error('items.{{ $index }}.title') error @enderror" name="items[{{ $index }}][title]" autocomplete="off" value="{{ $item->title ?? '' }}">
                        @error('items.{{ $index }}.title')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group form-group-default @error('items.{{ $index }}.description') has-error @enderror">
                        <label>Slide Description</label>
                        <textarea class="form-control @error('items.{{ $index }}.description') error @enderror" name="items[{{ $index }}][description]" style="height:75px;">{{ $item->description ?? '' }}</textarea>
                        @error('items.{{ $index }}.description')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group form-group-default @error('items.{{ $index }}.link') has-error @enderror">
                        <label>Slide Link</label>
                        <input type="url" class="form-control @error('items.{{ $index }}.link') error @enderror" name="items[{{ $index }}][link]" autocomplete="off" value="{{ $item->link ?? '' }}">
                        @error('items.{{ $index }}.link')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media m-b-10" data-type-media="single" data-populate-value=".populate-value-slide-{{ $index }}" data-populate-media=".populate-container-slide-{{ $index }}" id="{{ $index }}">
                        <i class="pg-icon m-r-5">image</i> Browse Slide Image
                    </button>
                    @error('items.{{ $index }}.image_id')
                    <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row m-b-0">
                <div class="col-md-12">
                    <input type="hidden" name="items[{{ $index }}][image_id]" class="populate-value-slide-{{ $index }}" value="{{ $item->image_id ?? 0 }}">
                    <div class="populate-container populate-container-slide-{{ $index }}">
                        @if (isset($item->image_id) && $item->image_id > 0 && isset($item->image->image))
                        <div class="populate-media">
                            <a href="{{ secure_img($item->image->image, '1200') }}" target="_blank">
                                <img src="{{ secure_img($item->image->image, '480X320') }}" class="full-width">
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
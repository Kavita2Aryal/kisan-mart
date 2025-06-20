@php $indexing = indexing(); @endphp
<div class="content-content content-image-gallery m-t-20">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <button class="btn btn-link btn-link-fix btn-lg p-r-10 p-l-10 open-use-media" type="button" data-type-media="multiple" data-populate-name="contents[{{ $indexing }}][image_gallery][]" data-populate-media=".populate-container-{{ $indexing }}" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i>Browse Gallery Images</button>
            <button class="btn btn-link text-danger btn-lg btn-remove"><i class="pg-icon">close_lg</i></button>
        </div>
    </div>
    @error('contents.{{ $indexing }}.image_gallery')
    <label class="error">{{ $message }}</label>
    @enderror
    <div class="row m-t-10">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
            <div class="permission-masonry">
                <input type="hidden" name="contents[{{ $indexing }}][display_order]" value="{{ $index }}">
                <div class="populate-container populate-container-{{ $indexing }} sortable sortable-image sortable-image-{{ $indexing }} m-b-10" data-sort-index="{{ $indexing }}">
                    @if (isset($content) && $content != null)
                        @php $display_order = 0; @endphp
                        @forelse($content->image_gallery() as $image)
                            @if (isset($image->image))
                            @php $display_order++; @endphp
                            <div class="media-masonry-item populate-media populate-media-{{ $image->id }}" id="{{ indexing() }}">
                                <div class="media-image">
                                    <input type="hidden" class="is-required" name="contents[{{ $indexing }}][image_gallery][]" value="{{ $image->id }}" data-name="contents[{{ $indexing }}][image_gallery]">
                                    <a href="{{ secure_img($image->image, '1200') }}" target="_blank">
                                        <img src="{{ secure_img($image->image, '480X320') }}" class="full-width">
                                    </a>
                                </div>
                                <div class="media-options">
                                    <div class="pull-left">
                                        <strong class="media-display-order">{{ $display_order }}</strong>
                                    </div>
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-link text-danger remove-use-media">
                                            <i class="pg-icon">close_lg</i>
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            @endif
                        @empty
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
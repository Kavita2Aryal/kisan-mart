<div class="card m-b-10">
    <div class="card-header">
        <div class="card-title">Section Image(s)</div>
        <div class="card-controls">
            <ul>
                <li>
                    <a href="#" class="btn-collapse" data-target=".section-image-parent-{{ $index }}"><i class="pg-icon">chevron_up</i></a>
                </li>
            </ul>
        </div>
    </div>
    @php $indexing = indexing(); @endphp
    <div class="card-body section-image-parent section-image-parent-{{ $index }}">
        <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media is-required m-b-10" data-type-media="multiple" data-populate-media=".populate-container-{{ $indexing }}" data-populate-name="section[{{ $index }}][image][]" data-limit="{{ $count }}" data-min="{{ $count }}" id="{{ $indexing }}" data-tippy-content="Exactly: {{ $count }}" data-tippy-placement="right">
            <i class="pg-icon m-r-5">image</i> Browse Images 
        </button>
        <div class="section-image">
            <div class="permission-masonry">
                <div class="populate-container populate-container-{{ $indexing }} sortable sortable-image {{ indexing() }}" id="{{ indexing() }}">
                    @forelse ($section->image_contents as $row)
                        @if (isset($row->image_id) && $row->image_id > 0 && isset($row->image->image))
                            <div class="media-masonry-item populate-media" id="{{ indexing() }}">
                                <div class="media-image">
                                    <input type="hidden" class="is-required" name="section[{{ $index }}][image][]" value="{{ $row->image_id }}" data-name="section[{{ $index }}][image]">
                                    <a href="{{ secure_img($row->image->image, '1200') }}" target="_blank">
                                        <img src="{{ secure_img($row->image->image, '480X320') }}" class="full-width">
                                    </a>
                                </div>
                                <div class="media-options">
                                    <div class="pull-left">
                                        <strong class="media-display-order">{{ $row->display_order }}</strong>
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
                </div>
            </div>
        </div>
    </div>
</div>
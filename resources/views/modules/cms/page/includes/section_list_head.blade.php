@php $indexing = indexing(); @endphp
<div class="list-head-section">
    <div class="card m-b-10">
        <div class="card-header">
            <div class="card-title">List Head</div>
            <div class="card-controls">
                <ul>
                    <li>
                        <a href="#" class="btn-collapse" data-target=".section-list-head-parent-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body section-list-head-parent section-list-head-parent-{{ $indexing }}">
            @if ($list_config_head->has_title == 1)
            <div class="form-group form-group-default">
                <label>Title</label>
                <input type="text" name="section[{{ $index }}][list][{{ $group }}][head][title]" class="form-control" autocomplete="off" required value="{{ $list_content_head->title ?? '' }}">
            </div>
            @endif
            @if ($list_config_head->has_subtitle == 1)
            <div class="form-group form-group-default">
                <label>Subtitle</label>
                <textarea name="section[{{ $index }}][list][{{ $group }}][head][subtitle]" class="form-control" autocomplete="off" required style="height: 60px;">{{ $list_content_head->subtitle ?? '' }}</textarea>
            </div>
            @endif
            @if ($list_config_head->has_description == 1)
            <div class="list-head-section-description editor-description parent-section m-b-10" data-index="{{ $indexing }}">
                <textarea class="editor-container editor-container-{{ $indexing }}" name="section[{{ $index }}][list][{{ $group }}][head][description]">{{ $list_content_head->description ?? "" }}</textarea>
            </div>
            @endif
            @if ($list_config_head->has_link == 1)
            <div class="form-group form-group-default">
                <label>Link Title</label>
                <input type="text" name="section[{{ $index }}][list][{{ $group }}][head][link_title]" class="form-control" autocomplete="off" value="{{ $list_content_head->link_title ?? '' }}">
            </div>
            <div class="form-group form-group-default">
                <label>Link URL</label>
                <input type="url" name="section[{{ $index }}][list][{{ $group }}][head][link]" class="form-control" autocomplete="off" required value="{{ $list_content_head->link ?? '' }}">
            </div>
            @endif
            @if ($list_config_head->has_image == 1)
            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media is-required m-b-10" data-type-media="multiple" data-populate-media=".populate-container-list-head-{{ $indexing }}" data-populate-name="section[{{ $index }}][list][{{ $group }}][head][image][]" data-limit="{{ $list_config_head->no_of_images }}" data-min="0" id="{{ $indexing }}" data-tippy-content="Min: 0, Max: {{ $list_config_head->no_of_images }}" data-tippy-placement="right">
                <i class="pg-icon m-r-5">image</i> Browse Images 
            </button>
            <div class="section-list-head-image">
                <div class="permission-masonry">
                    <div class="populate-container populate-container-list-head-{{ $indexing }} sortable sortable-image {{ indexing() }}" id="{{ indexing() }}">
                    @if ($list_content_head)
                        @forelse ($list_content_head->image_contents as $row)
                            @if (isset($row->image_id) && $row->image_id > 0 && isset($row->image->image))
                                <div class="media-masonry-item populate-media" id="{{ indexing() }}">
                                    <div class="media-image">
                                        <input type="hidden" class="is-required" name="section[{{ $index }}][list][{{ $group }}][head][image][]" value="{{ $row->image_id }}" data-name="section[{{ $index }}][list][{{ $group }}][head][image]">
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
                    @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
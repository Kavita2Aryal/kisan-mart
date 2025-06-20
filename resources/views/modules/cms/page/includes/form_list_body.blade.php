@php 
$index = $request->index;
$k = $request->group;
$l = $request->count;
$list_config_body = (object) $request->list_config_body;
$indexing = $request->indexing; 
@endphp
<div class="list-body-item parent-section" id="{{ indexing() }}">
    <input type="hidden" name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][display_order]" class="display-order-value" value="{{ $l }}">
    <div class="card m-b-10">
        <div class="card-header">
            <div class="card-title">List Item</div>
            <div class="card-controls">
                <ul>
                    <li>
                        <a href="#" class="btn-collapse" data-target=".section-list-item-parent-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                        <a href="#" class="btn-remove text-danger"><i class="pg-icon">close_lg</i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body section-list-item-parent section-list-item-parent-{{ $indexing }}">
            @if ($list_config_body->has_icon == 1)
            <div class="icon-picker-parent m-b-10">
                <button class="btn btn-lg btn-default btn-icon-picker" type="button">
                    <span class="icon-content"><strong>no icon</strong></span>
                    <span class="m-l-10">- &nbsp; Browse Icon</span>
                </button>
                <input type="hidden" name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][icon]" class="selected-icon" value="no-icon">
            </div>
            @endif
            @if ($list_config_body->has_title == 1)
            <div class="form-group form-group-default">
                <label>Title</label>
                <input type="text" name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][title]" class="form-control" autocomplete="off" required>
            </div>
            @endif
            @if ($list_config_body->has_subtitle == 1)
            <div class="form-group form-group-default">
                <label>Subtitle</label>
                <textarea name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][subtitle]" class="form-control" autocomplete="off" required style="height: 60px;"></textarea>
            </div>
            @endif
            @if ($list_config_body->has_description == 1)
            <div class="list-body-section-description editor-description parent-section m-b-10" data-index="{{ $indexing }}">
                <textarea class="editor-container editor-container-{{ $indexing }}" name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][description]"></textarea>
            </div>
            @endif
            @if ($list_config_body->has_link == 1)
            <div class="form-group form-group-default">
                <label>Link Title</label>
                <input type="text" name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][link_title]" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-group form-group-default">
                <label>Link URL</label>
                <input type="url" name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][link]" class="form-control" autocomplete="off" required>
            </div>
            @endif
            @if ($list_config_body->has_image == 1)
            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media is-required m-b-10" data-type-media="multiple" data-populate-media=".populate-container-list-{{ $indexing }}" data-populate-name="section[{{ $index }}][list][{{ $k }}][body][{{ $l }}][image][]" data-limit="{{ $list_config_body->no_of_images }}" data-min="0" id="{{ $indexing }}" data-tippy-content="Min: 0, Max: {{ $list_config_body->no_of_images }}" data-tippy-placement="right">
                <i class="pg-icon m-r-5">image</i> Browse Images 
            </button>
            <div class="section-list-body-image">
                <div class="permission-masonry">
                    <div class="populate-container populate-container-list-{{ $indexing }} sortable sortable-image {{ indexing() }}" id="{{ indexing() }}"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
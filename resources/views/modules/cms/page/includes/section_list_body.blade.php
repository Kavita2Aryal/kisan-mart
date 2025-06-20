@php $body_indexing = indexing(); @endphp
<div class="list-body-section" data-group="{{ $group }}">
    <div class="card bg-contrast-lower m-b-10">
        <div class="card-header">
            <div class="card-title">List Body</div>
            <div class="card-controls">
                <ul>
                    <li>
                        <a href="#" class="btn-list-body-add" data-config='@json($list_config_body)' data-tippy-content="Add List Item" data-tippy-placement="left"><i class="pg-icon">plus</i></a>
                    </li>
                    <li>
                        <a href="#" class="btn-collapse" data-target=".section-list-body-parent-{{ $body_indexing }}"><i class="pg-icon">chevron_up</i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body section-list-body-parent section-list-body-parent-{{ $body_indexing }} sortable sortable-list {{ indexing() }}" id="{{ indexing() }}" style="padding: 0px 20px 10px;">
            @php $k=0; @endphp
            @forelse ($list_content_body as $list_body)
                @php $k++; $indexing = indexing(); @endphp
                <div class="list-body-item parent-section" id="{{ indexing() }}">
                    <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][display_order]" class="display-order-value" value="{{ $row->display_order ?? $k }}">  
                    <div class="card m-b-10">
                        <div class="card-header">
                            <div class="card-title">List Item</div>
                            <div class="card-controls">
                                <ul>
                                    <li>
                                        <a href="#" class="btn-collapse" data-target=".section-list-item-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                                        <a href="#" class="btn-remove text-danger"><i class="pg-icon">close_lg</i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body section-list-item-parent section-list-item-{{ $indexing }}">
                            @if ($list_config_body->has_icon == 1)
                            <div class="icon-picker-parent m-b-10">
                                <button class="btn btn-lg btn-default btn-icon-picker" type="button">
                                    <span class="icon-content">
                                    @if (isset($list_body->icon) && $list_body->icon == 'no-icon')
                                        <strong>no icon</strong>
                                    @elseif (isset($icons[$list_body->icon]))
                                        <i uk-icon="{{ $icons[$list_body->icon] }}"></i>
                                    @elseif (isset($social_icons[$list_body->icon]))
                                        <i uk-icon="{{ $social_icons[$list_body->icon] }}"></i>
                                    @else
                                        <strong>no icon</strong>
                                    @endif
                                    </span>
                                    <span class="m-l-10">- &nbsp; Browse Icon</span>
                                </button>
                                <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][icon]" class="selected-icon"  value="{{ $list_body->icon ?? 'no-icon' }}">
                            </div>
                            @endif
                            @if ($list_config_body->has_title == 1)
                            <div class="form-group form-group-default">
                                <label>Title</label>
                                <input type="text" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][title]" class="form-control" autocomplete="off" required value="{{ $list_body->title }}">
                            </div>
                            @endif
                            @if ($list_config_body->has_subtitle == 1)
                            <div class="form-group form-group-default">
                                <label>Subtitle</label>
                                <textarea name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][subtitle]" class="form-control" autocomplete="off" required style="height: 60px;">{{ $list_body->subtitle }}</textarea>
                            </div>
                            @endif
                            @if ($list_config_body->has_description == 1)
                            <div class="list-body-section-description editor-description parent-section m-b-10" data-index="{{ $indexing }}">
                                <textarea class="editor-container editor-container-{{ $indexing }}" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][description]">{{ $list_body->description }}</textarea>
                            </div>
                            @endif
                            @if ($list_config_body->has_link == 1)
                            <div class="form-group form-group-default">
                                <label>Link Title</label>
                                <input type="text" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][link_title]" class="form-control" autocomplete="off" value="{{ $list_body->link_title }}">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Link URL</label>
                                <input type="url" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][link]" class="form-control" autocomplete="off" required value="{{ $list_body->link }}">
                            </div>
                            @endif
                            @if ($list_config_body->has_image == 1)
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media is-required m-b-10" data-type-media="multiple" data-populate-media=".populate-container-list-{{ $indexing }}" data-populate-name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][image][]" data-limit="{{ $list_config_body->no_of_images }}" id="{{ $indexing }}" data-tippy-content="Exactly: {{ $list_config_body->no_of_images }}" data-tippy-placement="right">
                                <i class="pg-icon m-r-5">image</i> Browse Images 
                            </button>
                            <div class="section-list-body-image">
                                <div class="permission-masonry">
                                    <div class="populate-container populate-container-list-{{ $indexing }} sortable sortable-image {{ indexing() }}" id="{{ indexing() }}">
                                        @forelse ($list_body->image_contents as $row)
                                            @if (isset($row->image_id) && $row->image_id > 0 && isset($row->image->image))
                                            <div class="media-masonry-item populate-media" id="{{ indexing() }}">
                                                <div class="media-image">
                                                    <input type="hidden" class="is-required" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][image][]" value="{{ $row->image_id }}" data-name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][image]">
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
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                @php $k=1; $indexing = indexing(); @endphp
                <div class="list-body-item parent-section" id="{{ indexing() }}">
                    <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][display_order]" class="display-order-value" value="{{ $k }}">
                    <div class="card m-b-10">
                        <div class="card-header">
                            <div class="card-title">List Item</div>
                            <div class="card-controls">
                                <ul>
                                    <li>
                                        <a href="#" class="btn-collapse" data-target=".section-list-item-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                                        <a href="#" class="btn-remove text-danger"><i class="pg-icon">close_lg</i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body section-list-item-parent section-list-item-{{ $indexing }}">
                            @if ($list_config_body->has_icon == 1)
                            <div class="icon-picker-parent m-b-10">
                                <button class="btn btn-lg btn-default btn-icon-picker" type="button">
                                    <span class="icon-content"><strong>no icon</strong></span>
                                    <span class="m-l-10">- &nbsp; Browse Icon</span>
                                </button>
                                <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][icon]" class="selected-icon" value="no-icon">
                            </div>
                            @endif
                            @if ($list_config_body->has_title == 1)
                            <div class="form-group form-group-default">
                                <label>Title</label>
                                <input type="text" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][title]" class="form-control" autocomplete="off" required>
                            </div>
                            @endif
                            @if ($list_config_body->has_subtitle == 1)
                            <div class="form-group form-group-default">
                                <label>Subtitle</label>
                                <textarea name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][subtitle]" class="form-control" autocomplete="off" required style="height: 60px;"></textarea>
                            </div>
                            @endif
                            @if ($list_config_body->has_description == 1)
                            <div class="list-body-section-description editor-description parent-section m-b-10" data-index="{{ $indexing }}">
                                <textarea class="editor-container editor-container-{{ $indexing }}" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][description]"></textarea>
                            </div>
                            @endif
                            @if ($list_config_body->has_link == 1)
                            <div class="form-group form-group-default">
                                <label>Link Title</label>
                                <input type="text" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][link_title]" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group form-group-default">
                                <label>Link URL</label>
                                <input type="url" name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][link]" class="form-control" autocomplete="off" required>
                            </div>
                            @endif
                            @if ($list_config_body->has_image == 1)
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media is-required m-b-10" data-type-media="multiple" data-populate-media=".populate-container-list-{{ $indexing }}" data-populate-name="section[{{ $index }}][list][{{ $group }}][body][{{ $k }}][image][]" data-limit="{{ $list_config_body->no_of_images }}" data-min="0" id="{{ $indexing }}" data-tippy-content="Min: 0, Max: {{ $list_config_body->no_of_images }}" data-tippy-placement="right">
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
            @endforelse
        </div>
    </div>
</div>
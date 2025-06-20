<div class="card m-b-10">
    <div class="card-header">
        <div class="card-title">Section Link(s)</div>
        <div class="card-controls">
            <ul>
                <li>
                    <a href="#" class="btn-link-add" data-tippy-content="Add Link Item" data-tippy-placement="left"><i class="pg-icon">plus</i></a>
                </li>
                <li>
                    <a href="#" class="btn-collapse" data-target=".section-link-parent-{{ $index }}"><i class="pg-icon">chevron_up</i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body section-link-parent-{{ $index }}">
        <div class="card bg-contrast-low m-b-0">
            <div class="card-body section-link-parent sortable sortable-list-link {{ indexing() }}" id="{{ indexing() }}" style="padding: 10px 10px 0 10px;">
                @php $k=0; @endphp
                @forelse($section->list_links as $row)
                    @php $k++; $indexing = indexing(); @endphp
                    <div class="section-link parent-section" id="{{ $indexing }}">
                        <input type="hidden" name="section[{{ $index }}][link][{{ $k }}][display_order]" class="display-order-value" value="{{ $row->display_order ?? $k }}">
                        <div class="card m-b-10">
                            <div class="card-header">
                                <div class="card-title">List Link</div>
                                <div class="card-controls">
                                    <ul>
                                        <li>
                                            <a href="#" class="btn-collapse" data-target=".section-list-link-item-parent-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                                            <a href="#" class="btn-remove text-danger"><i class="pg-icon">close_lg</i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body section-list-link-item-parent-{{ $indexing }}">
                                <div class="form-group form-group-default">
                                    <label>Link Title</label>
                                    <input type="text" name="section[{{ $index }}][link][{{ $k }}][title]" class="form-control" autocomplete="off" required value="{{ $row->title }}">
                                </div>
                                <div class="form-group form-group-default m-b-0">
                                    <label>Link URL</label>
                                    <input type="url" name="section[{{ $index }}][link][{{ $k }}][link]" class="form-control" autocomplete="off" required value="{{ $row->value }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @php $k=1; $indexing = indexing(); @endphp
                    <div class="section-link parent-section" id="{{ $indexing }}">
                        <input type="hidden" name="section[{{ $index }}][link][{{ $k }}][display_order]" class="display-order-value" value="{{ $k }}">
                        <div class="card m-b-10">
                            <div class="card-header">
                                <div class="card-title">List Link</div>
                                <div class="card-controls">
                                    <ul>
                                        <li>
                                            <a href="#" class="btn-collapse" data-target=".section-list-link-item-parent-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                                            <a href="#" class="btn-remove text-danger"><i class="pg-icon">close_lg</i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body section-list-link-item-parent-{{ $indexing }}">
                                <div class="form-group form-group-default">
                                    <label>Link Title</label>
                                    <input type="text" name="section[{{ $index }}][link][{{ $k }}][title]" class="form-control" autocomplete="off" required>
                                </div>
                                <div class="form-group form-group-default m-b-0">
                                    <label>Link URL</label>
                                    <input type="url" name="section[{{ $index }}][link][{{ $k }}][link]" class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
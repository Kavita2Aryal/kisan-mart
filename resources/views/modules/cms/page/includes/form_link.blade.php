@php 
$indexing = indexing();
$index = $request->index;
$k = $request->count;
@endphp
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
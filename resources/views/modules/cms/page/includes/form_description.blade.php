@php 
$index = $request->index;
$k = $request->count;
$indexing = $request->indexing; 
@endphp
<div class="section-description editor-description parent-section" data-index="{{ $indexing }}">
    <button class="btn btn-link text-danger btn-lg btn-editor-remove btn-remove" type="button"><i class="pg-icon">close_lg</i></button>
    <textarea class="editor-container editor-container-{{ $indexing }}" name="section[{{ $index }}][description][{{ $k }}]"></textarea>
</div>
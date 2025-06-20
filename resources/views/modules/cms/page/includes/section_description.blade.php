<div class="card m-b-10">
    <div class="card-header">
        <div class="card-title">Section Description(s)</div>
        <div class="card-controls">
            <ul>
                <li>
                    <a href="#" class="btn-description-add" data-tippy-content="Add Description" data-tippy-placement="left"><i class="pg-icon">plus</i></a>
                </li>
                <li>
                    <a href="#" class="btn-collapse" data-target=".section-description-parent-{{ $index }}"><i class="pg-icon">chevron_up</i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body section-description-parent section-description-parent-{{ $index }}">
        @php $k=0; @endphp
        @forelse($section->descriptions as $row)
        @php $indexing = indexing(); $k++; @endphp
        <div class="section-description editor-description parent-section" data-index="{{ $indexing }}">
            @if($k > 1)
                <button class="btn btn-link text-danger btn-lg btn-editor-remove btn-remove" type="button"><i class="pg-icon">close_lg</i></button>
            @endif
            <textarea class="editor-container editor-container-{{ $indexing }}" name="section[{{ $index }}][description][{{ $k }}]">{{ $row->description }}</textarea>
            @error('section.'.$index.'.description.'.$k.'.value')
                <label class="error m-t-10 m-b-0">{{ $message }}</label>
            @enderror
        </div>
        @empty
        @php $indexing = indexing(); $k=1; @endphp
        <div class="section-description editor-description parent-section" data-index="{{ $indexing }}">
            <textarea class="editor-container editor-container-{{ $indexing }}" name="section[{{ $index }}][description][{{ $k }}]"></textarea>
            @error('section.'.$index.'.description.'.$k.'.value')
                <label class="error m-t-10 m-b-0">{{ $message }}</label>
            @enderror
        </div>
        @endforelse
    </div>
</div>
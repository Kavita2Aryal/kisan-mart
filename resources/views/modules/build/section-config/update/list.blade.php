@php $config = 'list'; @endphp
<div class="form-group row list-content">
    <div class="col-lg-12">
        <div class="row">
            <label class="col-md-5 control-label p-t-0">List</label>
            <div class="col-md-7 text-right">
                <div class="form-check m-b-0 form-check-inline success">
                    <input type="radio" 
                        value="1" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="yes-{{ $indexing }}-{{ $config }}" 
                        class="has-list ignore-config-count" 
                        @if ($section['config'][$config] == 1) checked @endif
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-list ignore-config-count" 
                        @if ($section['config'][$config] == 0) checked @endif
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 list-btn" @if (count($section['list_config']) == 0) style="display: none;" @endif>
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-link btn-link-fix p-l-15 p-r-15 btn-add-list" data-indexing="{{ $indexing }}">
                    <i class="pg-icon m-r-5">add</i> ADD LIST
                </button>
                <input type="hidden" class="list-count" value="{{ count($section['list_config']) }}">
            </div>
        </div>
        <div class="list-items list-option" @if (count($section['list_config']) == 0) style="display: none;" @endif>
            @if (count($section['list_config']) > 0)
                @php $i=1; @endphp
                @foreach ($section['list_config'] as $list_config)
                    @include('modules.build.section-config.update.list-item', ['count' => $i++, 'list_config' => $list_config])
                @endforeach
            @endif
        </div>
    </div>
</div>
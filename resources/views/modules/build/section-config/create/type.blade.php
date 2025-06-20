@php $config = 'type'; @endphp
<div class="form-group row type-content">
    <div class="col-lg-12">
        <div class="row">
            <label class="col-md-5 control-label p-t-0">Type Config</label>
            <div class="col-md-7 text-right">
                <div class="form-check m-b-0 form-check-inline success">
                    <input type="radio" 
                        value="1" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="yes-{{ $indexing }}-{{ $config }}" 
                        class="has-type"
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-type" 
                        checked
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 type-title" style="display: none;">
            <label class="col-md-12 control-label p-t-0">Select one or more Content Types:</label>
        </div>
        <div class="row m-t-10 type-option" style="display: none;">
            <div class="col-md-12">
                @if (count($type_contents) > 0)
                @foreach ($type_contents as $key => $type)
                <div class="form-check info form-check-inline">
                    <input type="checkbox" 
                        value="{{ $key }}" 
                        name="config[{{ $indexing }}][type_config][]" 
                        id="types-{{ $indexing }}-{{ $type }}"
                    />
                    <label for="types-{{ $indexing }}-{{ $type }}">{{ ucwords(str_replace('_', ' ', $type)) }}</label>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
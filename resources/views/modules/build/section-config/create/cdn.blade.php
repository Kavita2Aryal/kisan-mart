@php $config = 'style'; @endphp
<div class="form-group row style-content">
    <div class="col-lg-12">
        <div class="row">
            <label class="col-md-5 control-label p-t-0">Stylesheet Plugins Config</label>
            <div class="col-md-7 text-right">
                <div class="form-check m-b-0 form-check-inline success">
                    <input type="radio"  
                        value="1"
                        name="config[{{ $indexing }}][style]" 
                        id="yes-{{ $indexing }}-{{ $config }}" 
                        class="has-style ignore-config-count"
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0" 
                        name="config[{{ $indexing }}][style]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-style ignore-config-count" 
                        checked
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 style-title" style="display: none;">
            <label class="col-md-12 control-label p-t-0">Select one or more plugins:</label>
        </div>
        <div class="row m-t-10 style-option" style="display: none;">
            <div class="col-md-12">
                @if (count($website_styles) > 0)
                @foreach ($website_styles as $key => $style)
                @php $style_array = explode('/', $style); $style = end($style_array); @endphp
                <div class="form-check info form-check-inline">
                    <input type="checkbox" 
                        value="{{ $key }}" 
                        name="config[{{ $indexing }}][style_config][]" 
                        id="style-{{ $indexing }}-{{ $style }}" 
                        class="ignore-config-count"
                    />
                    <label for="style-{{ $indexing }}-{{ $style }}">{{ $style }}</label>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@php $config = 'script'; @endphp
<div class="form-group row script-content">
    <div class="col-lg-12">
        <div class="row">
            <label class="col-md-5 control-label p-t-0">Script Plugins Config</label>
            <div class="col-md-7 text-right">
                <div class="form-check m-b-0 form-check-inline success">
                    <input type="radio" 
                        value="1"
                        name="config[{{ $indexing }}][script]" 
                        id="yes-{{ $indexing }}-{{ $config }}" 
                        class="has-script ignore-config-count"
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0"
                        name="config[{{ $indexing }}][script]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-script ignore-config-count" 
                        checked
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 script-title" style="display: none;">
            <label class="col-md-12 control-label p-t-0">Select one or more plugins:</label>
        </div>
        <div class="row m-t-10 script-option" style="display: none;">
            <div class="col-md-12">
                @if (count($website_scripts) > 0)
                @foreach ($website_scripts as $key => $script)
                @php $script_array = explode('/', $script); $script = end($script_array); @endphp
                <div class="form-check info form-check-inline">
                    <input type="checkbox" 
                        value="{{ $key }}" 
                        name="config[{{ $indexing }}][script_config][]" 
                        id="script-{{ $indexing }}-{{ $script }}" 
                        class="ignore-config-count"
                    />
                    <label for="script-{{ $indexing }}-{{ $script }}">{{ $script }}</label>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
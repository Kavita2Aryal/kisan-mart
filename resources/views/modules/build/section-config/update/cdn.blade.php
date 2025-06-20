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
                        @if (count($section['styles']) > 0) checked @endif
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0"
                        name="config[{{ $indexing }}][style]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-style ignore-config-count" 
                        @if (count($section['styles']) == 0) checked @endif >

                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 style-title"@if (count($section['styles']) == 0) style="display:none;" @endif>
            <label class="col-md-12 control-label p-t-0">Select one or more plugins:</label>
        </div>
        <div class="row m-t-10 style-option" @if (count($section['styles']) == 0) style="display:none;" @endif>
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
                        @if (count($section['styles']) > 0 
                        && in_array($key, $section['styles'])) checked @endif
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
                        @if (count($section['scripts']) > 0) checked @endif>

                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0"
                        name="config[{{ $indexing }}][script]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-script ignore-config-count" 
                        @if (count($section['scripts']) == 0) checked @endif
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 script-title" @if (count($section['scripts']) == 0) style="display:none;" @endif>
            <label class="col-md-12 control-label p-t-0">Select one or more plugins:</label>
        </div>
        <div class="row m-t-10 script-option" @if (count($section['scripts']) == 0) style="display:none;" @endif>
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
                        @if (count($section['scripts']) > 0 
                        && in_array($key, $section['scripts'])) checked @endif
                    />
                    <label for="script-{{ $indexing }}-{{ $script }}">{{ $script }}</label>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@php $config = 'title'; @endphp
<div class="form-group row">
    <label class="col-md-5 control-label p-t-0">{{ ucwords($config) }}</label>
    <div class="col-md-7 text-right">
        <div class="form-check m-b-0 form-check-inline success">
            <input type="radio" 
                value="1" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="yes-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 1) checked @endif
            />
            <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
        </div>
        <div class="form-check m-b-0 form-check-inline danger m-r-0">
            <input type="radio" 
                value="0" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="no-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 0) checked @endif
            />
            <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
        </div>
    </div>
</div>
@php $config = 'subtitle'; @endphp
<div class="form-group row">
    <label class="col-md-5 control-label p-t-0">{{ ucwords($config) }}</label>
    <div class="col-md-7 text-right">
        <div class="form-check m-b-0 form-check-inline success">
            <input type="radio" 
                value="1" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="yes-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 1) checked @endif
            />
            <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
        </div>
        <div class="form-check m-b-0 form-check-inline danger m-r-0">
            <input type="radio" 
                value="0" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="no-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 0) checked @endif
            />
            <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
        </div>
    </div>
</div>
@php $config = 'description'; @endphp
<div class="form-group row">
    <label class="col-md-5 control-label p-t-0">{{ ucwords($config) }}</label>
    <div class="col-md-7 text-right">
        <div class="form-check m-b-0 form-check-inline success">
            <input type="radio" 
                value="1" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="yes-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 1) checked @endif
            />
            <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
        </div>
        <div class="form-check m-b-0 form-check-inline danger m-r-0">
            <input type="radio" 
                value="0" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="no-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 0) checked @endif
            />
            <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
        </div>
    </div>
</div>
@php $config = 'link'; @endphp
<div class="form-group row">
    <label class="col-md-5 control-label p-t-0">{{ ucwords($config) }}</label>
    <div class="col-md-7 text-right">
        <div class="form-check m-b-0 form-check-inline success">
            <input type="radio" 
                value="1" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="yes-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 1) checked @endif
            />
            <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
        </div>
        <div class="form-check m-b-0 form-check-inline danger m-r-0">
            <input type="radio" 
                value="0" 
                name="config[{{ $indexing }}][{{ $config }}]" 
                id="no-{{ $indexing }}-{{ $config }}" 
                @if ($section['config'][$config] == 0) checked @endif
            />
            <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
        </div>
    </div>
</div>
@php $config = 'image'; @endphp
<div class="form-group row number-content">
    <div class="col-lg-12">
        <div class="row">
            <label class="col-md-5 control-label p-t-0">{{ ucwords($config) }}</label>
            <div class="col-md-7 text-right">
                <div class="form-check m-b-0 form-check-inline success">
                    <input type="radio" 
                        value="1" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="yes-{{ $indexing }}-{{ $config }}" 
                        class="has-number" 
                        @if ($section['config'][$config] == 1) checked @endif
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-number" 
                        @if ($section['config'][$config] == 0) checked @endif
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 number-option" @if ($section['config'][$config] == 0) style="display: none;" @endif>
            <label class="col-md-8 col-lg-8 col-xl-8 control-label p-t-0">No. of {{ ucwords($config) }}</label>
            <div class="col-md-4 col-lg-4 col-xl-4">
                <input type="number" 
                    value="{{ $section['config']['no_of_'.$config.'s'] }}"
                    class="form-control input-sm" 
                    name="config[{{ $indexing }}][no_of_{{ $config }}s]" 
                    placeholder="Count" 
                />
            </div>
        </div>
    </div>
</div>
@php $config = 'slider'; @endphp
<div class="form-group row number-content">
    <div class="col-lg-12">
        <div class="row">
            <label class="col-md-5 control-label p-t-0">{{ ucwords($config) }}</label>
            <div class="col-md-7 text-right">
                <div class="form-check m-b-0 form-check-inline success">
                    <input type="radio" 
                        value="1" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="yes-{{ $indexing }}-{{ $config }}" 
                        class="has-number" 
                        @if ($section['config'][$config] == 1) checked @endif
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-number" 
                        @if ($section['config'][$config] == 0) checked @endif
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 number-option" @if ($section['config'][$config] == 0) style="display: none;" @endif>
            <label class="col-md-8 col-lg-8 col-xl-8 control-label p-t-0">No. of {{ ucwords($config) }}</label>
            <div class="col-md-4 col-lg-4 col-xl-4">
                <input type="number" 
                    value="{{ $section['config']['no_of_'.$config.'s'] }}"
                    class="form-control input-sm" 
                    name="config[{{ $indexing }}][no_of_{{ $config }}s]" 
                    placeholder="Count" 
                />
            </div>
        </div>
    </div>
</div>
@php $config = 'video'; @endphp
<div class="form-group row number-content">
    <div class="col-lg-12">
        <div class="row">
            <label class="col-md-5 control-label p-t-0">{{ ucwords($config) }}</label>
            <div class="col-md-7 text-right">
                <div class="form-check m-b-0 form-check-inline success">
                    <input type="radio" 
                        value="1" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="yes-{{ $indexing }}-{{ $config }}" 
                        class="has-number" 
                        @if ($section['config'][$config] == 1) checked @endif
                    />
                    <label for="yes-{{ $indexing }}-{{ $config }}">YES</label>
                </div>
                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                    <input type="radio" 
                        value="0" 
                        name="config[{{ $indexing }}][{{ $config }}]" 
                        id="no-{{ $indexing }}-{{ $config }}" 
                        class="has-number" 
                        @if ($section['config'][$config] == 0) checked @endif
                    />
                    <label for="no-{{ $indexing }}-{{ $config }}">NO</label>
                </div>
            </div>
        </div>
        <div class="row m-t-10 number-option" @if ($section['config'][$config] == 0) style="display: none;" @endif>
            <label class="col-md-8 col-lg-8 col-xl-8 control-label p-t-0">No. of {{ ucwords($config) }}</label>
            <div class="col-md-4 col-lg-4 col-xl-4">
                <input type="number" 
                    value="{{ $section['config']['no_of_'.$config.'s'] }}"
                    class="form-control input-sm" 
                    name="config[{{ $indexing }}][no_of_{{ $config }}s]" 
                    placeholder="Count" 
                />
            </div>
        </div>
    </div>
</div>